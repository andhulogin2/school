<?php echo form_open(base_url() . 'index.php/admin/class_migrate/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="from_year" value="<?php echo $from_year; ?>" />
<div class="table-responsive" style="padding:20px">
<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
	<thead>
		<tr>
            <th class="table-header"><center><input type="checkbox" name="select_all" id="select_all" checked="checked" onclick="select_all_data();" /></center></th>
            <th class="table-header"><center>Sl No.</center></th>
            <th class="table-header"><center>Name</center></th>
            <th class="table-header"><center>Class/Section</center></th>
            <th class="table-header"><center>Admission No.</center></th>
            <th class="table-header"><center>Roll No.</center></th>
            <th class="table-header"><center>Image</center></th>
        </tr>
    </thead>
    
    <tbody>

<?php
$running_year = get_running_year();
$j=1;
$i=0;

foreach($student as $stud){
?>

<input type="hidden" name="roll[]" value="<?php echo $stud["roll"] ?>"  />
<input type="hidden" name="student[]" value="<?php echo $stud["student_id"] ?>"  />
        <tr>
            <td><center><input type="checkbox" name="num[]" checked="checked" value="<?php echo $i; ?>"></center></td>
            <td><center><?php echo $j++;?></center></td>
            <td><center><?php echo $stud["name"] ?></center></td>
            <td><center><?php echo get_class_name($stud["class_id"])."/".get_section_name($stud["section_id"]);?></center></td>
            <td><center><?php echo $stud["admission_number"];?></center></td>
            <td><center><?php echo $stud["roll"] ?></center></td>
            <td><center><img src="<?php echo $this->crud_model->get_image_url('student',$stud["student_id"]);?>" alt="user" height="60px" width="60px"></center></td>
        </tr>
<?php 
$i++;
} ?>
    </tbody>
</table>
</div>
<br/>
<br>
<input type="hidden" name="branch" id="branch" value="<?php echo $branch ?>" />
<input type="hidden" name="dept" id="dept" value="<?php echo $dept ?>" />
<div class="mail-compose">
    <div class="row">
    <div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label">Academic Year</label>
		                    <div >
		                      <select name="academic_year"  class="form-control" id="academic_year1" onChange="get_academic_class(this.value)">
		                            <option value="0">Select</option>
                                    <?php 
									$this->db->where('is_deleted','N');
									$year=$this->db->get('tbl_academic_year')->result_array();
							  foreach ($year as $year1)
							  {
							  ?><option value="<?php echo $year1['acdemic_year_id'];?>"><?php echo $year1['academic_year'];?></option>
                              <?php }?>
			                    </select>
			                </div>
					</div>
</div>
    <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label">Class:</label>
						<div >
							<select name="class1" id="class_selector_holder2" class="form-control" required="" onchange="return get_class_sections(this.value)">
                              <option value="">Select</option>
                             
					  </select>
						</div> 
					</div>
    </div>  <div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
		                        <select name="section1" onchange="get_details1()"  class="form-control" id="section_selector_holder1">
		                            <option value="0">Select-Class</option>
			                    </select>
			                </div>
					</div>
</div>

 
</div>

    <button type="submit" class="btn btn-success btn-icon pull-right">
        Migrate
        <i class="entypo-mail"></i>
    </button>

<?php echo form_close(); ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
		var year_id	=	$('#academic_year1').val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id +'/'+year_id,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
	function get_academic_class(year) 
	{

	var branch = $('#branch').val();
		var department = $('#dept').val();
		//var academic_year = $('#academic_year1').val();
	
	
    	$.ajax({

            url: '<?php echo base_url();?>index.php/Admin/get_class_students1/'+year + '/'+branch +'/'+department ,
            success: function(response)
            {
                jQuery('#class_selector_holder2').html(response);
            }
        });
    }
	
function select_all_data()
{
	var select_all	=	document.getElementById("select_all");
	var check_box 	= 	document.getElementsByName('num[]');

	for (var i=0;i<check_box.length;i++)
	{
		if(select_all.checked==true)
		{
			
		   check_box[i].checked	=	true;
		}
		else
		{
			check_box[i].checked	=	false;
		}

	}
}
	
</script>
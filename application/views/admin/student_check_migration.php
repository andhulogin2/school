<?php echo form_open(base_url() . 'index.php/admin/student_migrate/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

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

        <tr>
            <td><center><input type="checkbox" name="student[]" checked="checked" value="<?php echo $stud["student_id"] ?>"></center></td>
            <td><center><?php echo $j++;?></center></td>
            <td><center><?php echo $stud["name"] ?></center></td>
            <td><center><?php echo get_class_name($stud["class_id"])."/".get_section_name($stud["section_id"]);?></center></td>
            <td><center><?php echo $stud["admission_number"];?></center></td>
            <td><center><?php echo $stud["roll"] ?></center></td>
            <td><center><img src="<?php echo $this->crud_model->get_image_url('student',$stud["student_id"]);?>" alt="user" height="60px" width="60px"></center></td>
        </tr>
<?php 
$i++;
} 
	if(count($student)==0)
	{
	?>
    	<tr>
        	<td colspan="7" style="color:#FF0000;text-align:center"><b>No Data Found...</b></td>
        </tr>
    <?php
	}
?>
	
    </tbody>
</table>
</div>

<br>
<input type="hidden" name="branch" id="branch" value="<?php echo $branch ?>" />
<input type="hidden" name="dept" id="dept" value="<?php echo $dept ?>" />
<input type="hidden" name="academic_year" id="academic_year" value="<?php echo $academic_year ?>" />
<input type="hidden" name="class1" id="class_selector_holder2" value="<?php echo $class ?>" />
<input type="hidden" name="section" value="<?php echo $section; ?>" />
<?php
if(count($student)>0)
{
?>
<!--    <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label">Class:</label>
						<div >
							<select name="class1" id="class_selector_holder2" class="select2" required="" onchange="return get_class_sections1(this.value)" required>
                            <option value="">Select</option>
                            <?php 
							$this->db->where('branch_id',$branch);
							$this->db->where('dept_id',$dept);
							$this->db->where('academic_year',$academic_year);
							$class=$this->db->get('class')->result_array();
							foreach($class as $class1)
							{
							?>
                             <option value="<?php echo $class1['class_id']?>"><?php echo $class1['name']?></option>
                             <?php } ?>
                              
                             
					  </select>
						</div> 
					</div>
    </div>  
-->    			<div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
		                        <select name="section1" onchange="get_details1()"  class="select2" id="section_selector_holder1" required>
		                            <option value="0">Select-Class</option>
			                    </select>
			                </div>
					</div>
</div>

 
</div>

	<div class="col-md-12">   
        <button type="submit" class="btn btn-success btn-icon pull-left">
            Migrate
            <i class="entypo-mail"></i>
        </button>
	</div>        
<?php
}
?>
<?php echo form_close(); ?>

<script type="text/javascript">
	$(document).ready(function () {
		//$("#class_selector_holder2").val($('#class_selector_holder').val());
		get_class_sections1($('#class_selector_holder2').val());
	});
	function get_class_sections1(class_id) 
	{
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });
    }
	function select_all_data()
	{
		var select_all	=	document.getElementById("select_all");
		var check_box 	= 	document.getElementsByName('student[]');
	
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
<script type="text/javascript">
	function get_academic_class(year) 
	{

	var branch = $('#branch').val();
		var department = $('#dept').val();
		//var academic_year = $('#academic_year1').val();
	
	
    	$.ajax({

            url: '<?php echo base_url();?>index.php/Admin/get_class_students1/' +year + '/'+branch +'/'+department ,
            success: function(response)
            {
                jQuery('#class_selector_holder2').html(response);
            }
        });
    }
</script>
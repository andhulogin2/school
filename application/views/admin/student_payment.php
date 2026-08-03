<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?><body>
        
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Fee Payment</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Pay Fee
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/FeeManagement/student_payment/'; ?>"><button class="btn-info">Choose Another</button></a></div>
 <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
    </div> 
</div>
<br />	<br />	

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
    </div> 
</div>
<br />	<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>
<br />	<br />
	
 
	

<?php }?>
 <?php if($this->session->userdata('role')==3)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
            <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
    </div> 
    <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />
</div>
<br />	<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>
<br />	<br />
<?php }?>

 <?php if($this->session->userdata('role')>=4)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Admission Number <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="admission_num" onChange="get_student_data()"  class="select2" id="admission_num" >
            <option value="">Select</option>
                <?php 
					 $branch =  $this->session->userdata('branch_id');
					 $dept	 =	$this->session->userdata('dept_id');
					 $this->db->select('a.student_id,a.class_id,a.class_name,a.section_name,a.section_id,a.name,a.year,b.dept_id,b.branch_id,b.admission_number');
					 $this->db->from('view_students a');
					 $this->db->join('student b','b.student_id=a.student_id and b.student_status_id=0');
					 $this->db->where('b.branch_id',$branch);
					 $this->db->where('b.dept_id',$dept);
					 $this->db->where('a.year',$running_year);
					 $student_data 	=	$this->db->get()->result_array();
					 foreach($student_data as $data)
					 {
				?>            
            <option value="<?php echo $data['student_id']."_".$data['class_id']."_".$data['section_id']?>"><?php echo $data['admission_number']." - ".$data['name']."(".$data['class_name']."/".$data['section_name'].")"; ?></option>
                      <?php  } ?>
        </select>
    </div>
</div>
<br />	<br />


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
    	<?php								 
			 $branch	=$this->session->userdata('branch_id');
			 $dept	=	$this->session->userdata('dept_id');
			 $this->db->where('branch_id',$branch);
			 $this->db->where('dept_id',$dept);
			 $this->db->where('academic_year',$running_year);
			 $class 	=	$this->db->get('class')->result_array();
			 ?>

       <select  name="class"  onchange="get_class_sections(this.value)" id="class" class="select2">
				<option value="">Select</option>
                <?php 
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
    </div> 
        <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />
        <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id'); ?>" />
</div>
<br />	<br />
<?php } ?>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section" onChange="get_student_details()"  class="select2" id="section_selector" required>
            <option value="">Select</option>
        </select>
    </div>
</div>
<br>
<div  class="form-group" id="payment"> </div>

       <div id="payment_student1" style="padding-left:50px;padding-right:50px"></div>                    

                                    </div></div></div></body>

			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="transaction_success")
{
echo "<script>toastr.success('". "Fee details updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="transaction_failed")
{
echo "<script>toastr.error('". "Fee details not updated...', 'Failed', {timeOut: 5000})</script>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

   

});
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector').html(response);
            }
        });
    }
</script>

<script type="text/javascript">	
 function get_student_details(){
	 jQuery('#payment').html("");
        var branch_id 	= $('#branch').val();		//This branch_id is needed in student_payment_details_print page.This branch_id should be passed to get receipt number.
		var dept_id 	= $('#department').val();
        var classid 	= $('#class').val();
        var section 	= $('#section_selector').val();
		console.log(section);

		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_payment_details/' + classid + '/' + section + '/' + dept_id + '/' + branch_id ,
            success: function(response)
            {
				console.log(response);
                jQuery('#payment').html(response);
				document.getElementById("class_selector").disabled = true;
				document.getElementById("section_selector").disabled = true;
            }
   });
}
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
 <script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
</script>


<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>              

 <script type="text/javascript">	
 function get_student_data(){
	 jQuery('#payment_student1').html("");
	 	var branch_id 	= $('#branch').val();
	 	var dept_id 	= $('#department').val();
        var str 	= $('#admission_num').val();
		var res = str.split("_");
		var student = res[0];
        var classid 	= res[1];
		 var section 	= res[2];
		if(student == ""){
				document.getElementById("section_selector").disabled = false;				
				document.getElementById("class").disabled = false;
				return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_payment_details1/' + student + '/' + classid + '/' + section + '/' + dept_id + '/' + branch_id,
            success: function(response)
            {
				//console.log(response);
				document.getElementById("section_selector").disabled = true;				
				document.getElementById("class").disabled = true;
                jQuery('#payment_student1').html(response);
				
            }
   });
}
</script>

 
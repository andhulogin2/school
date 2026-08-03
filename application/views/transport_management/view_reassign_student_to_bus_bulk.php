<?php include_once APPPATH . 'views/head.php';?><body>
        
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
							<li class="active">Bulk Reassign Students</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Transportation
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Bulk Reassign Students
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Transport_management/view_reassign_student_to_bus/'; ?>"><button class="btn-info">Choose Another</button></a></div>
 <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php
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
<input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id');?>" />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
            <option value="">Select</option>
            
                              <?php 
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
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

 <?php if($this->session->userdata('role')==4)
{?>
<input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id');?>" />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select  name="class"  onchange="get_class_sections(this.value)" id="class" class="select2">
				<option value="">Select</option>
                <?php 
									 
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
    </div> 
</div>
<br />	<br />
<?php } ?>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section" onChange="get_details()"  class="select2" id="section_selector" required>
            <option value="">Select</option>
        </select>
    </div>
</div>
<br>
<div  class="form-group" id="payment"> </div>
                                    </div></div></div></body>

			<?php include_once APPPATH . 'views/footer.php'; ?>




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
 function get_details(){
	 jQuery('#payment').html("");
	 	var branch_id 	= $('#branch').val();
        var classid 	= $('#class').val();
        var section 	= $('#section_selector').val();
		//console.log(section);

		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/Transport_management/get_students_for_reassign/' + classid + '/' + section  + '/' + branch_id,
//	    url: '<?php echo base_url();?>index.php/Transport_management/get_student_details_for_reassign/' + classid + '/' + section  + '/' + branch_id,
            success: function(response)
            {
                jQuery('#payment').html(response);
				//document.getElementById("class_selector").disabled = true;
				//document.getElementById("section_selector").disabled = true;
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<?php
$action = $this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}

else if($action=="failed")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}

?>


  <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script> 
 

 
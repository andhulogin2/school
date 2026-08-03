<?php include_once APPPATH . 'views/main_head.php';?><body>
        
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
							<li class="active">Edit Employee Master</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								TRANSPORTATION
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Edit Employee Master
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_employee_master/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/employee_master_update/'.$employee_master_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                <?php
									foreach($employee_master as $master)
									{
									
									
								?>
                                
                                 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch: </label>
										<div class="col-sm-9">
                                            <select name="branch_id" class="select2" id="branch_id" onChange="return get_dept(this.value)">
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $branch1)
													  		{
							  						?>
                              					<option value="<?php echo $branch1['branch_id'];?>" <?php if($branch1['branch_id'] == $master['branch_id']) { ?> selected <?php } ?>><?php echo $branch1['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                  
                                
                                
                                
                                
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name :</label>

										<div class="col-sm-9">
											<input type="text" id="first_name" placeholder="First Name" class="col-xs-10 col-sm-5" name="first_name" value="<?php echo $master['first_name'] ?>" />
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name :</label>

										<div class="col-sm-9">
											<input type="text" id="last_name" placeholder="Last Name" class="col-xs-10 col-sm-5" name="last_name"  value="<?php echo $master['last_name'] ?>"/>
										</div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">House Name :</label>

										<div class="col-sm-9">
											<input type="text" id="house_name" placeholder="House Name" class="col-xs-10 col-sm-5" name="house_name"  value="<?php echo $master['house_name'] ?>" />
										</div>
									</div>
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Post :</label>

										<div class="col-sm-9">
											<input type="text" id="post" placeholder="Post" class="col-xs-10 col-sm-5" name="post"  value="<?php echo $master['post'] ?>" />
										</div>
									</div>
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address :</label>

										<div class="col-sm-9">
											<textarea id="address" placeholder="Address" class="col-xs-10 col-sm-5" name="address" ><?php echo $master['address'] ?> </textarea>
										</div>
									</div>
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Birth :</label>

										<div class="col-sm-9">
											<input type="text" id="date_of_birth" placeholder="Date of Birth" class="col-xs-10 col-sm-5" name="date_of_birth"  value="<?php echo date('d-m-Y',strtotime($master['date_of_birth'])); ?>" />
										</div>
									</div>
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Sex :</label>

										<div class="col-sm-9">
											<select name="sex" class="select2" id="sex" >
                              					<option value="">Select</option>
                              					<option value="M" <?php if($master['sex']==M){ ?> selected <?php } ?>>Male</option>
                              					<option value="F" <?php if($master['sex']==F){ ?> selected <?php } ?>>Female</option>
                                             </select>   
										</div>
									</div>
								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Marital Status :</label>
										<div class="col-sm-9">
											<select name="marital_status_id" class="select2" id="marital_status_id" >
                              					<option value="">Select</option>
                              <?php 
							  foreach ($marital_status as $status)
							  				{
							  
											   ?>
                                               <option value="<?php echo $status['marital_status_id']?>" <?php if($master['marital_status_id']==$status['marital_status_id']){ ?> selected <?php } ?>><?php echo $status['marital_status']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Employee Designation :</label>
										<div class="col-sm-9">
											<select name="employee_designation_id" class="select2" id="employee_designation_id" >
                              					<option value="">Select</option>
                              <?php 
							  foreach ($employee_designation as $designation)
							  				{
							  
											   ?>
                                               <option value="<?php echo $designation['employee_designation_id']?>" <?php if($master['employee_designation_id']==$designation['employee_designation_id']){ ?> selected <?php } ?>><?php echo $designation['employee_designation']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Licence Number: </label>

										<div class="col-sm-9">
											<input type="text" id="licence_number" name="licence_number" placeholder="Licence Number" class="col-xs-10 col-sm-5" value="<?php echo $master['licence_number'] ?>" />
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Badge Number: </label>

										<div class="col-sm-9">
											<input type="text" id="badge_number" name="badge_number" placeholder="Badge Number" class="col-xs-10 col-sm-5" value="<?php echo $master['badge_number'] ?>" />
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Licence Details: </label>

										<div class="col-sm-9">
											<input type="text" id="licence_details" name="licence_details" placeholder="Licence Details" class="col-xs-10 col-sm-5" value="<?php echo $master['licence_details'] ?>" />
											
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Joining: </label>

										<div class="col-sm-9">
											<input type="text" id="date_of_joining" name="date_of_joining" placeholder="Date of Joining" class="col-xs-10 col-sm-5" value="<?php echo date('d-m-Y',strtotime($master['date_of_joining'])); ?>" />
											
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Salary: </label>

										<div class="col-sm-9">
											<input type="text" id="salary" name="salary" placeholder="Salary" class="col-xs-10 col-sm-5" value="<?php echo $master['salary'] ?>" />
											
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone: </label>

										<div class="col-sm-9">
											<input type="text" id="phone" name="phone" placeholder="Phone" class="col-xs-10 col-sm-5" value="<?php echo $master['phone'] ?>" />
											
										</div>
									</div>
                                   
									
                                   
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    
                                     
                                    <?php } echo form_close(); ?>
                                    </div></body>
                                  
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

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
/*	function get_branch(role) 
	{
	
	if(role==2)
	{
	$('#branch_role').hide();
	$('#dept_role').hide();
	}
	if(role==3)
	{
	$('#branch_role').show();
	$('#dept_role').hide();
	}
	if(role==4)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==5)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==6)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==7)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
    }
	
*/
	
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">
    $(document).ready(function () {
        $('#date_of_birth').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
    $(document).ready(function () {
        $('#date_of_joining').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
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

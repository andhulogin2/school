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
							<li class="active">Edit Vehicle Master</li>
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
								 Edit
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Vehicle Master
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_master_update/'.$vehicle_master_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                <?php
									foreach($log as $master)
									{
                                   
									$role = $this->session->userdata('role');
									if($role == 3 || $role == 4)
									{
									
									?>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch :<font color="#FF0000"></font> </label>
										<div class="col-sm-9">
                                        	<input type="hidden" id="branch_id" name="branch_id" value="<?php echo $master['branch_id']; ?>" />
                                            <select name="branch_id" class="select2" id="branch_id" onChange="return get_dept(this.value)" disabled >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $branch1)
													  		{
							  						?>
                              					<option value="<?php echo $branch1['branch_id'];?>"<?php if($branch1['branch_id'] == $master['branch_id']) { ?> selected <?php } ?>><?php echo $branch1['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                    <?php
									}
									else
									{
									?>
								
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch :<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
                                            <select name="branch_id" class="select2" id="branch_id" onChange="return get_dept(this.value)" required >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $branch1)
													  		{
							  						?>
                              					<option value="<?php echo $branch1['branch_id'];?>"<?php if($branch1['branch_id'] == $master['branch_id']) { ?> selected <?php } ?>><?php echo $branch1['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                    <?php
									}
									?>
                                                                   
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="vehicle_registration_number" placeholder="Registration Number"  class="col-xs-10 col-sm-5" name="vehicle_registration_number" value="<?php echo $master['vehicle_registration_number']; ?>"  required />
										</div>
                                        
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus Number :</label>

										<div class="col-sm-9">
											<input type="text" id="bus_number" placeholder="Bus Number"  class="col-xs-10 col-sm-5" name="bus_number" value="<?php echo $master['bus_number']; ?>"  />
										</div>
                                        
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Date :</label>

										<div class="col-sm-9">
											<input type="text" id="registration_date" placeholder="Registration Date" class="col-xs-10 col-sm-5" name="registration_date" value="<?php echo date('d-m-Y',strtotime($master['registration_date'])); ?>" />
										</div>
									</div>
                                    
                                    
                                   
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Name :</label>

										<div class="col-sm-9">
											<input type="text" id="owner_name" placeholder="Owner Name" class="col-xs-10 col-sm-5" name="owner_name" value="<?php echo $master['owner_name']; ?>" />
										</div>
									</div>

								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ownership Type :</label>
										<div class="col-sm-9">
											<select name="ownership_type_id" class="select2" id="ownership_type_id" >
                              					<option value="">Select</option>
                              <?php 
							  foreach ($ownership as $ownership_type)
							  				{
							  
											   ?>
                                               <option value="<?php echo $ownership_type['ownership_type_id'];?>" <?php if($ownership_type['ownership_type_id'] == $master['ownership_type_id']){ ?> selected <?php } ?>><?php echo $ownership_type['ownership_type']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                      
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category :</label>

										<div class="col-sm-9">
											<select name="vehicle_category_id" class="select2" id="vehicle_category_id" >
                              					<option value="">Select</option>
                              <?php 
							  foreach ($category as $category1)
							  				{
							  
											   ?>
                                               <option value="<?php echo $category1['vehicle_category_id'];?>" <?php if($category1['vehicle_category_id'] == $master['vehicle_category_id']) { ?> selected <?php } ?>><?php echo $category1['vehicle_category_name']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Vehicle Class:</label>

										<div class="col-sm-9">
											<select name="vehicle_class_id" class="select2" id="vehicle_class_id" >
                                            	<option value="">Select</option>
													<?php
                                                    foreach($class as $vehicle_class1)
                                                    {
                                                	?>
                                                <option value="<?php echo $vehicle_class1['vehicle_class_id']?>"<?php if($vehicle_class1['vehicle_class_id'] == $master['vehicle_class_id']) { ?> selected <?php } ?>><?php echo $vehicle_class1['vehicle_class_name']; ?></option>
                                                	<?php    
                                                    }
                                                    ?>
                                            </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Vehicle Maker: </label>

										<div class="col-sm-9">
											<select name="vehicle_maker_id" class="select2" id="vehicle_maker_id" >
                                            	<option value="">Select</option>
													<?php
                                                    foreach($maker as $vehicle_maker)
                                                    {
                                                	?>
                                                <option value="<?php echo $vehicle_maker['vehicle_maker_id']?>"<?php if($vehicle_maker['vehicle_maker_id'] == $master['vehicle_maker_id']) { ?> selected <?php } ?>><?php echo $vehicle_maker['vehicle_maker_name']; ?></option>
                                                	<?php    
                                                    }
                                                    ?>
                                            </select>
										</div>
									</div>

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Seat Capacity: </label>

										<div class="col-sm-9">
											<input type="text" id="seat_capacity" name="seat_capacity" onKeyPress="return mask(this,event);" placeholder="Seat Capacity" class="col-xs-10 col-sm-5" value="<?php echo $master['seat_capacity']; ?>" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tax Licence Number:</label>

										<div class="col-sm-9">
											<input type="text" id="tax_licence_number" name="tax_licence_number" placeholder="Tax Licence Number" class="col-xs-10 col-sm-5" value="<?php echo $master['tax_licence_number']; ?>" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Year of Manufacture: </label>
										<div class="col-sm-9">
                                            <select name="year_of_manufacture" id="year_of_manufacture" class="select2">
                                            	<option value="">Select Year</option>
                                                <?php
												for($i=date('Y');$i>=1980;$i--)
												{
												?>
                                                <option value="<?php echo $i; ?>"<?php if($i== $master['year_of_manufacture']) { ?> selected <?php } ?>><?php echo $i; ?></option>
                                                <?php
												}
												?>
                                            </select>
										</div>
									</div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Month of Manufacture: </label>
										<div class="col-sm-9">
											<select id="month_of_manufacture" name="month_of_manufacture" class="select2" >
                                            	<option value="">Select Month</option>
                                                <?php
												for($i=0;$i<sizeof($months);$i++)
												{
												?>
                                                <option value="<?php echo $months[$i]; ?>"<?php if($i== $master['month_of_manufacture']) { ?> selected <?php } ?>><?php echo $months[$i]; ?></option>
												<?php
                                                }
												?>
                                            </select>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remarks: </label>
										<div class="col-sm-9">
											<textarea  id="remarks" name="remarks" class="col-xs-10 col-sm-5" placeholder="Remarks"><?php echo $master['remarks']; ?></textarea>
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
        $('#registration_date').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
	 
	 function mask(textbox, e) {

      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode == 46 || charCode > 31&& (charCode < 48 || charCode > 57)) 
         {
            alert("Only Numbers Allowed");
            return false;
         }
     else
         {
             return true;
         }
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
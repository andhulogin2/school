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
							<li class="active">Add Vehicle Pollution Test Details</li>
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
								Transportation
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Vehicle Pollution Test Details
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_pollution_test_details/<?php echo $vehicle_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_pollution_test_details_add', array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number :</label>

										<div class="col-sm-9">
                                        	<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $vehicle_master_id; ?>" />
											<select name="vehicle_master_name" class="select2" id="vehicle_master_name" disabled >
                              					<option value="">Select</option>
                              						<?php 
							 	 					foreach ($vehicle_master as $master)
							  				{
							  
											   ?>
                                               <option value="<?php echo $master['vehicle_master_id']?>"<?php if($master['vehicle_master_id']==$vehicle_master_id){ echo "selected"; } ?>><?php echo $master['vehicle_registration_number']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Test:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="date_of_test" placeholder="Date of Test" class="col-xs-10 col-sm-5 datepick" name="date_of_test" required />
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">RPM Minimum:</label>

										<div class="col-sm-9">
											<input type="text" id="rpm_minimum" placeholder="RPM Minimum" class="col-xs-10 col-sm-5" name="rpm_minimum"/>
										</div>
									</div>
								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">RPM Maximum:</label>
										<div class="col-sm-9">
											<input type="text" id="rpm_maximum" placeholder="RPM Maximum" class="col-xs-10 col-sm-5" name="rpm_maximum"/>
										</div>
									</div>
                                      
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Status:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select id="status" placeholder="Status" class="select2" name="status" required >
                                            	<option value="">Select</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Valid Upto:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="valid_upto" placeholder="Valid Upto" class="col-xs-10 col-sm-5 datepick" name="valid_upto" required />
										</div>
									</div>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Amount:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="number" step="0.01" id="amount" placeholder="Amount" class="col-xs-10 col-sm-5" name="amount" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Paid By:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="paid_by" placeholder="Paid By" class="col-xs-10 col-sm-5" name="paid_by" required />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Test Done From:</label>

										<div class="col-sm-9">
											<input type="text" id="test_done_from" placeholder="Test Done From" class="col-xs-10 col-sm-5" name="test_done_from"/>
										</div>
									</div>
                                    

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									
                                    
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit' > 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div></body>
                                  
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepick').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
	 
	 function allDecimals(insurance_amount)
		{ 
		
	    var decimal = /^[0-9.]+$/; 
		if(insurance_amount.value.match(decimal))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		insurance_amount.focus();
		return false;
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

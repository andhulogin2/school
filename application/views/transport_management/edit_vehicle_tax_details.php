<?php include_once APPPATH . 'views/main_head.php';?>
<?php 
foreach($log as $tax_details):
endforeach;
?>
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
							<li class="active">Transportation</li>
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
									 Tax Details 
                                    
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_tax_details/<?php echo $tax_details['vehicle_master_id'];?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Transport_management/vehicle_tax_details_update/'.$vehicle_tax_details_id, array('class' => 'form-horizontal'));?>
					                                                                      
													<form>
														<!-- <legend>Form</legend> -->
                                                        
                                                             <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $tax_details['vehicle_master_id'];?>" />
									<select name="vehicle_master_name" id="vehicle_master_name"   class="col-xs-10 col-sm-5" disabled="disabled" >
                                   <option>select</option>
                                    <?php foreach($master as $master_type)
											{
											?>
                                            <option value= "<?php echo $master_type['vehicle_master_id'] ?>"<?php if($master_type['vehicle_master_id']==$tax_details['vehicle_master_id']){ echo "selected"; } ?>><?php echo $master_type['vehicle_registration_number'] ?> </option>
                                            <?php }
											?>
                                            </select>
										</div>
									</div>
														
                                                        
                                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tax Paid On:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="tax_paid_on"   class="col-xs-10 col-sm-5" name="tax_paid_on" value="<?php echo date('d-m-Y',strtotime($tax_details['tax_paid_on'])); ?>" required=""/>
                                   
										</div>
									</div>
                                    
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tax Paid From :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="tax_paid_from"   class="col-xs-10 col-sm-5" name="tax_paid_from"  value="<?php echo date('d-m-Y',strtotime($tax_details[tax_paid_from])); ?>"   required=""/>
                                   
										</div>
									</div>


                        

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Tax Paid To:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="tax_paid_to" name="tax_paid_to" value="<?php echo date('d-m-Y',strtotime($tax_details[tax_paid_to])); ?>" placeholder="" class="col-xs-10 col-sm-5" required />
										</div>
									</div>
                                   

									<!-- /section:elements.form -->
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Tax Amount:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
										<input type="text" id="tax_amount" name="tax_amount" onkeyUp="allDecimals(this)" value="<?php echo $tax_details[tax_amount]; ?>" placeholder="" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>

									

									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tax Paid Office:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<input type="text" id="tax_paid_office" name="tax_paid_office" value="<?php echo $tax_details[tax_paid_office]; ?>" placeholder="" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>
                                     <div class="space-4"></div>

									
                                                        

														<div class="clearfix form-actions">
                    									<div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn btn-sm btn-success">
																Update
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
                                                         </div></div>
                                                            <div></div>
														<br />
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">
    $(document).ready(function () {
        $('#tax_paid_on').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
    $(document).ready(function () {
        $('#tax_paid_from').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
    $(document).ready(function () {
        $('#tax_paid_to').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });  
	 
	 
	 function allDecimals(tax_amount)
		{ 
		
		var decimal = /^[0-9.]+$/; 
		if(tax_amount.value.match(decimal))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		tax_amount.focus();
		return false;
		}
		} 
	  
	 
	 
	 
 </script>



		
<?php include_once APPPATH . 'views/main_head.php';?>
  <?php
 foreach($log as $fuel_log)
			{
			}
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
							<li class="active">Edit category</li>
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
								Vehicle Fuel	
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_fuel_log/<?php echo $fuel_log['vehicle_master_id'];?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Transport_management/vehicle_fuel_log_update/'.$fuel_log_book_id, array('class' => 'form-horizontal'));?>
					                                                                      
                                		<form>
														<!-- <legend>Form</legend> -->
														
                                                     
                                                           <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $fuel_log['vehicle_master_id']; ?>"  />
									<select name="vehicle_master_name" id="vehicle_master_name"   class="col-xs-10 col-sm-5" disabled="disabled" >
                                   <option>select</option>
           <?php foreach($master as $master_type)
			{
			
			?>
            
                                 
            <option value= "<?php echo $master_type['vehicle_master_id'] ?>" <?php if($master_type['vehicle_master_id']==$fuel_log['vehicle_master_id']){ echo "selected"; } ?>><?php echo $master_type['vehicle_registration_number'] ?> </option>
                                            <?php 
											}
											?>
                                            </select>
										</div>
									</div>
                                                        
                                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fuel Filled date:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="date_filled"   class="col-xs-10 col-sm-5" name="date_filled" value="<?php echo date('d-m-Y',strtotime($fuel_log[date_filled])); ?>" required=""/>
                                   
										</div>
									</div>
                                    
                                    			
                                   <div class="form-group">
									      
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  Meter Reading: <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="meter_reading"  name="meter_reading" value="<?php echo $fuel_log[meter_reading]; ?>" placeholder="reason for trip" class="col-xs-10 col-sm-5" required=""/>
											
										</div>
									</div>  
                                    
                                 
                                  
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  Fuel Quantity : </label>
                                          
										<div class="col-sm-9">
											<input type="text" id="quantity_of_fuel_filled" name="quantity_of_fuel_filled" onkeyUp="allNumbers(this)" value="<?php echo $fuel_log[quantity_of_fuel_filled]; ?>" placeholder="quantity of fuel filled" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                 
                                    
                                   
								
                                     
                                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Price(R/L): </label>
                                         
										<div class="col-sm-9">
											<input type="text" id="fuel_rate_per_litre" name="fuel_rate_per_litre" onkeyUp="allNumbers1(this)" value="<?php echo  $fuel_log[fuel_rate_per_litre]; ?>" placeholder="fuel price per liter" class="col-xs-10 col-sm-5" />

											
										</div>
									</div>
						
                        
                           <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Cost: </label>
                                         
										<div class="col-sm-9">

											<input type="text" id="fuel_price" name="fuel_price" value="<?php echo $fuel_log[fuel_price]; ?>" placeholder="fuel price" class="col-xs-10 col-sm-5" />

											
										</div>
									</div>
                        
                        
								<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled From: </label>
                               
								<div class="col-sm-9">
								<input type="text" id="fuel_filled_from"  name="fuel_filled_from" value="<?php echo  $fuel_log[fuel_filled_from]; ?>" class="col-xs-10 col-sm-5"> 
								</div>
								</div>
                                    
 					                         
                                 
                                 <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled By: </label>
                               
								<div class="col-sm-9">
								<input type="text" id="fuel_filled_by"  name="fuel_filled_by" onkeyUp="allLetter(this)" value="<?php echo  $fuel_log[fuel_filled_by]; ?>" class="col-xs-10 col-sm-5"> 
								</div>
								</div>
                             
                                
                                                        

														
															<center><button type="submit" class="btn btn-sm btn-success">
																Update
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
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
        $('#date_filled').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
   
   $('#quantity_of_fuel_filled, #fuel_rate_per_litre').change(function(){
    var quant = parseFloat($('#quantity_of_fuel_filled').val()) || 0;
    var litr_price = parseFloat($('#fuel_rate_per_litre').val()) || 0;

    $('#fuel_price').val(quant * litr_price);    
});
   
   
   
   
   
   function allNumbers(quantity_of_fuel_filled)
		{ 
		
	    var decimal = /^[0-9.]+$/; 
		if(quantity_of_fuel_filled.value.match(decimal))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		uname.focus();
		return false;
		}
		}
		function allNumbers1(fuel_rate_per_litre)
		{ 
		
		var decimal = /^[0-9.]+$/; 
		if(fuel_rate_per_litre.value.match(decimal))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		uname.focus();
		return false;
		}
		}
		
  function allLetter(fuel_filled_by)
{ 

var letters = /^[A-Z a-z]+$/;
if(fuel_filled_by.value.match(letters))
{
return true;
}
else
{
alert('it must have alphabet characters only');
uname.focus();
return false;
}
}
   
   
   
   
   
   
   
   
 </script>





		
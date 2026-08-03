<?php include_once APPPATH . 'views/main_head.php';?>
<?php 
	foreach($log as $running_log):
	
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
								Vehicle Running Log	
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_running_log/<?php echo $running_log['vehicle_master_id'];?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Transport_management/vehicle_running_log_update/'.$running_log_id, array('class' => 'form-horizontal'));?>
					                                                                      
													<form>
														<!-- <legend>Form</legend> -->
														
                                                             <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" name="vehicle_master_id" id="vehicle_master_id" value="<?php echo $running_log['vehicle_master_id'] ?>" />
									<select name="vehicle_master_name" id="vehicle_master_name"   class="select2"  disabled />
                                   <option>select</option>
                                    <?php foreach($master as $master_type)
											{
											?>
                                            <option value= "<?php echo $master_type['vehicle_master_id'] ?>"<?php if($master_type['vehicle_master_id'] == $running_log['vehicle_master_id']) { echo "selected"; } ?>><?php echo $master_type['vehicle_registration_number'] ?> </option>
                                            <?php 
											}
											?>
                                            </select>
										</div>
									</div>
                                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Entry:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" name="date_of_entry" id="date_of_entry" value="<?php echo date('d-m-Y',strtotime($running_log['date_of_entry'])); ?>"  class="col-xs-10 col-sm-5"   required />
                                   
										</div>
									</div>
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start Meter Reading :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
	<input type="text" id="starting_meter_reading"   class="col-xs-10 col-sm-5" name="starting_meter_reading" onKeyPress="return mask(this,event);"                               value="<?php echo $running_log[starting_meter_reading]; ?>"   required=""/>
                                   
										</div>
									</div>


                        

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> End Meter Reading :<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="ending_meter_reading" name="ending_meter_reading" onBlur="myFunction()" 
                                            value="<?php echo $running_log[ending_meter_reading]; ?>" placeholder="ending meter reading Name" class="col-xs-10 col-sm-5" required />
										</div>
									</div>
                                   

									<!-- /section:elements.form -->
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Driver :<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
										<select id="driver_id" name="driver_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php
											foreach($driver as $driver1):
											?>
                                            <option value="<?php echo $driver1['employee_master_id']; ?>"<?php if($running_log['driver_id']==$driver1['employee_master_id']){ echo "selected"; } ?>><?php echo $driver1['first_name']." ".$driver1['last_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
											
										</div>
									</div>

									

									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Journey From:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
<input type="text" id="journey_from" name="journey_from" value="<?php echo $running_log[journey_from]; ?>"  placeholder="Journey From" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>
                                     <div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Journey To:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<input type="text" id="journey_to" name="journey_to"  value="<?php echo $running_log[journey_to]; ?>" placeholder="Journey To" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>


                            <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Trip Reason:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<input type="text" id="reason_for_trip" name="reason_for_trip"  value="<?php echo $running_log[reason_for_trip]; ?>" placeholder="Journey To" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>




														 <div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn btn-info">
																Update
																
															</button>
                                                           </div>	 
                                                            
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
        $('#date_of_entry').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
	 
function allLetter(journey_from)
{ 

var letters = /^[A-Z a-z]+$/;
if(journey_from.value.match(letters))
{
return true;
}
else
{
alert('it must have alphabet characters only');
journey_from.focus();
return false;
}
} 

function allLetter1(journey_to)
{ 

var letters = /^[A-Z a-z]+$/;
if(journey_to.value.match(letters))
{
return true;
}
else
{
alert('it must have alphabet characters only');
journey_to.focus();
return false;
}
}

function allLetter2(reason_for_trip)
{ 

var letters = /^[A-Z a-z]+$/;
if(reason_for_trip.value.match(letters))
{
return true;
}
else
{
alert('it must have alphabet characters only');
reason_for_trip.focus();
return false;
}
}

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
	 
 function myFunction() 
  {
  
   	var x = parseInt(document.getElementById("starting_meter_reading").value);
  	var y =  parseInt(document.getElementById("ending_meter_reading").value);
	//alert(x);
	   if(y<x)
	   {
	   alert("enter a value greater than previous entry");
	   
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

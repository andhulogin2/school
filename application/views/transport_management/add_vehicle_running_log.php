<?php include_once APPPATH . 'views/main_head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<body>
        
        	<div class="main-content col-md-10">
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
							<li class="active">Admission</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
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
									 Vehicle Running Log 
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_running_log/<?php echo $vehicle_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
                     
                     <?php error_reporting(0);   echo form_open('Transport_management/vehicle_running_log_add/', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $vehicle_master_id; ?>" />
									<select name="vehicle_master_name" id="vehicle_master_name"   class="select2" name="vehicle_master_id" disabled >
                                     <option>select</option>
                                      <?php foreach($result as $result1)
											{
											?>
                                            <option value= "<?php echo $result1['vehicle_master_id'] ?>"<?php if($result1['vehicle_master_id'] == $vehicle_master_id){ echo "selected"; } ?>><?php echo $result1['vehicle_registration_number'] ?> </option>
                                            <?php }
											?>
                                            </select>
                                   
										</div>
									</div>
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Entry:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="date_of_entry"   class="col-xs-10 col-sm-5" name="date_of_entry" placeholder="Date of Entry" required=""/>
                                   
										</div>
									</div>
                                    
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start Meter Reading :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   <input type="text" id="starting_meter_reading"  placeholder="Start Meter Reading"  onKeyPress="return mask(this,event);"   
                                    class="col-xs-10 col-sm-5" name="starting_meter_reading" required=""/>
                                   
										</div>
									</div>


                        

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> End Meter Reading :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
	          <input type="text" id="ending_meter_reading" name="ending_meter_reading" placeholder="End Meter Reading"    
                 class="col-xs-10 col-sm-5"  onBlur="myFunction()" required="" />
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
                                            <option value="<?php echo $driver1['employee_master_id']; ?>"><?php echo $driver1['first_name']." ".$driver1['last_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
											
										</div>
									</div>

									

									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Journey From:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
						<input type="text" id="journey_from" name="journey_from"   placeholder="Journey From" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>
                                     <div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Journey To:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
					<input type="text" id="journey_to" name="journey_to"   placeholder="Journey To" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>

                                       <div class="form-group">
									      
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Trip Reason: <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="reason_for_trip"  name="reason_for_trip"  placeholder="Trip Reason" class="col-xs-10 col-sm-5" required=""/>
											
										</div>
									</div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> </label>

										<div class="col-sm-9">
                                        <div class="space-4"></div>
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                                
                                 <input type="submit" class="btn btn-info" name="submit"  value='Submit' > 											
                               
                        
							        
			</div>
          
          
                  
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>
          <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>

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
    
  function myFunction() 
  {
  
   	var x = parseInt(document.getElementById("starting_meter_reading").value);
  	var y =  parseInt(document.getElementById("ending_meter_reading").value);
	
	
	   if(y<x)
	   {
	  alert("enter a value greater than previous entry");
	   }
	//   y="";
	//   x="";
	   //starting_meter_reading.focus();
	  
	    
  
	}

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
uname.focus();
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
    
    
	</script>   

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','340px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   

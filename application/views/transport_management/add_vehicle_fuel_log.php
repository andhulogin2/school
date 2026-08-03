<?php include_once APPPATH . 'views/main_head.php';?>
<?php foreach($result as $result3)
		{
		 }
		?>


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
									  Vehicle Fuel Log 
								
							</h1>
						</div><!-- /.page-header -->
                        
                       <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_fuel_log/<?php echo $vehicle_master_id; ?>"data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
             </div>
          
                     
                     <?php error_reporting(0);   echo form_open('Transport_management/vehicle_fuel_log_add/', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form --> 
									                                    
                                  	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $vehicle_master_id; ?>" />
									<select name="vehicle_master_id" id="vehicle_master_name"   class="col-xs-10 col-sm-5" name="vehicle_master_name" disabled >
                                   <option>select</option>
                                    <?php foreach($result as $master_type)
											{
											?>
                                            <option value= "<?php echo $master_type['vehicle_master_id'] ?>"<?php if($master_type['vehicle_master_id'] == $vehicle_master_id){ echo "selected"; } ?>><?php echo $master_type['vehicle_registration_number'] ?> </option>
                                            <?php }
											?>
                                            </select>
										</div>
									</div>
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fuel Filled date:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="date_filled" placeholder="Fuel Filled Date"  class="col-xs-10 col-sm-5" name="date_filled" required=""/>
                                   
										</div>
									</div>
                                    
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Meter Reading :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="meter_reading"   class="col-xs-10 col-sm-5" placeholder="Meter reading" name="meter_reading" required=""/>
                                   
										</div>
									</div>


                        

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Fuel Quantity :<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="quantity_of_fuel_filled" name="quantity_of_fuel_filled" onkeyUp="allNumbers(this)" placeholder="Quntity of fuel" class="col-xs-10 col-sm-5" required="" />
										</div>
									</div>
                                   

									<!-- /section:elements.form -->
									<div class="space-4"></div>
                                    
                                       <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Rate(P/L):<font color="#FF0000"> *</font> </label>

										<div class="col-sm-9">
		<input type="text" id="fuel_rate_per_litre" name="fuel_rate_per_litre" placeholder="Fuel rate per litre" onkeyUp="allNumbers1(this)" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                     <div class="space-4"></div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Fuel Cost:<font color="#FF0000"> </font> </label>

										<div class="col-sm-9">
						<input type="text" id="fuel_price" name="fuel_price" placeholder="Fuel price"  class="col-xs-10 col-sm-5" required="" readonly/>
											
										</div>
									</div>

									

									<div class="space-4"></div>
                                    
                                 
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled From: </label>

										<div class="col-sm-9">
					<input type="text" id="fuel_filled_from" name="fuel_filled_from"  placeholder="Fuel filled from" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>

                                       <div class="form-group">
									      
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled By: <font color="#FF0000"> </font></label>

										<div class="col-sm-9">
											<input type="text" id="fuel_filled_by"  name="fuel_filled_by" placeholder="Fuel filled by" onkeyUp="allLetter(this)" 
                                            class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                 <!--
                                  
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Quantity of Fuel Filled: </label>
                                          
										<div class="col-sm-9">
											<input type="text" id="quantity_of_fuel_filled"name="quantity_of_fuel_filled" placeholder="quantity of fuel filled" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Price: </label>
                                         
										<div class="col-sm-9">
											<input type="text" id="fuel_price" name="fuel_price" placeholder="fuel price" class="col-xs-10 col-sm-5" />

											
										</div>
									</div>
                                     
                                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Price(R/L): </label>
                                         
										<div class="col-sm-9">
											<input type="text" id="fuel_rate_per_liter" name="fuel_rate_per_liter" placeholder="fuel price per liter" class="col-xs-10 col-sm-5" />

											
										</div>
									</div>
						
								<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled From: </label>
                               
								<div class="col-sm-9">
								<input type="text" id="fuel_filled_from"  name="fuel_filled_from" class="col-xs-10 col-sm-5"> 
								</div>
								</div>
                                    
 					                         
                                 
                                 <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fuel Filled By: </label>
                               
								<div class="col-sm-9">
								<input type="text" id="fuel_filled_by"  name="fuel_filled_by" class="col-xs-10 col-sm-5"> 
								</div>
								</div>  !--> 
                                    
                                   
                                            
                                  
                         
															
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> </label>

										<div class="col-sm-9">
                                        <div class="space-4"></div>
											
                                             <?php 
								 //$this->load->Model('crud_model');
								  //$query=$this->crud_model->additional_message_content();
								$this->db->select('content,title');
		$this->db->from('sms_template');
		 $this->db->where('title','admission');
	 	  $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
								
								?>
                                 <?php  
								 // $this->load->Model('crud_model');
								  //$result=$this->crud_model->additional_message_content1();
								  $this->db->select('content');
   		 $this->db->from('sms_template');
		 $this->db->where('title','admission');
$result=$this->db->get()->result_array();
								  foreach($result as $r){?>
			                  <input type="text" name="message" id="message" class="form-control" value="<?php echo $r['content'];}?>" style="display: none"/><?php }
							  else
							  {?>
                              <input type="text" name="message" id="message" class="form-control" value=""  style="display: none"/>
							 <?php } ?>
										</div>
									</div>
                                    
                                    
                                     
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$('#quantity_of_fuel_filled, #fuel_rate_per_litre').change(function(){
    var quant = parseFloat($('#quantity_of_fuel_filled').val()) || 0;
    var litr_price = parseFloat($('#fuel_rate_per_litre').val()) || 0;

    $('#fuel_price').val(quant * litr_price);    
});
</script>
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
		quantity_of_fuel_filled.focus();
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
		fuel_rate_per_litre.focus();
		return false;
		}
		}
		
		
	</script>   

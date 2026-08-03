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
								Transportaion
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									  Vehicle Tax Details
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_tax_details/<?php echo $vehicle_master_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
                     
                     <?php error_reporting(0);   echo form_open('Transport_management/vehicle_tax_details_add/'.$enquiry_id, array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->	
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration No:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
									<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $vehicle_master_id; ?>" />
									<select name="vehicle_master_id" id="vehicle_master_name"   class="col-xs-10 col-sm-5" name="vehicle_master_name" disabled>
                                   <option>select</option>
                                    <?php foreach($result as $result2)
											{
											?>
                                            <option value= "<?php echo $result2['vehicle_master_id'] ?>"<?php if($result2['vehicle_master_id'] == $vehicle_master_id){ echo "selected"; } ?>><?php echo $result2['vehicle_registration_number'] ?> </option>
                                            <?php }
											?>
                                            </select>
										</div>
									</div>


							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tax Paid On:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="tax_paid_on"   class="col-xs-10 col-sm-5" placeholder="Tax Paid On" name="tax_paid_on" required=""/>
                                   
										</div>
									</div>
                                    
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tax Paid From:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                   
							
									<input type="text" id="tax_paid_from"  placeholder="Tax Paid From" class="col-xs-10 col-sm-5" name="tax_paid_from" required=""/>
                                   
										</div>
									</div>


                        

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Tax Paid To:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="tax_paid_to" name="tax_paid_to" placeholder="Tax Paid To" class="col-xs-10 col-sm-5" required />
										</div>
									</div>
                                   

									<!-- /section:elements.form -->
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Tax Amount:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
										<input type="text" id="tax_amount" name="tax_amount" placeholder="Tax Amount" onkeyUp="allDecimals(this)" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>

									

									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tax Paid Office:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<input type="text" id="tax_paid_office" name="tax_paid_office" placeholder="Tax Paid Office" class="col-xs-10 col-sm-5" required />
											
										</div>
									</div>
                                     <div class="space-4"></div>

									
                                               
                                  
                         
															
                                    
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

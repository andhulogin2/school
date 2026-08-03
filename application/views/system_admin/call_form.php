<?php include_once APPPATH . 'views/head.php';?>
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
								<a href="#">Home</a>							</li>
							<li class="active">Call Details</li>
						    <li class="active">Add Call Details</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>Call Details <small> <i class="ace-icon fa fa-angle-double-right"></i> Add Call Details</small></h1>
					  </div><!-- /.page-header -->
                        
				 <!--   <div class="row">
							<div class="col-xs-12">
								
								<form class="form-horizontal" role="form">
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :* </label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> School Name: </label>

										<div class="col-sm-9">
											<input type="text" id="School-Name" name="School-Name" placeholder="School Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									
									<div class="space-2"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:* </label>

										<div class="col-sm-9">
											<input type="text" id="class" name="class" placeholder="Class" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: </label>

										<div class="col-sm-9">
											<input type="text" id="Section" name="Section" placeholder="Section" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Roll Number: </label>

										<div class="col-sm-9">
											<input type="text" id="roll-number" name="roll-number" placeholder="Roll Number" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                       <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>

										<div class="col-sm-2">
										<input type="text" id="datepicker" class="form-control" />
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
										</div>
									</div>
                                    
                             </form>
                      </div>
                     </div>     -->  
                     
                     <?php   echo form_open('enquiry_controller/add_call_details/'.$enquiry_id, array('class' => 'form-horizontal'));?>
                     
					  <!-- PAGE CONTENT BEGINS -->
								
	    <!-- #section:elements.form -->
	       
                 

			   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Call: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text" id="mydatepicker" class="form-control mydatepicker" name="date" required="" placeholder="Date of Enquiry" value="<?php echo date('d-m-Y')?>"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
<div class="space-2"></div>
             
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="timepicker1"> Time :</label>
                                    <div class="col-sm-2">
                                    <div class="clearfix">
                                    <div class="input-group bootstrap-timepicker">
									<input id="timepicker" type="text" name="time" class="form-control" required="" placeholder="Time of Enquiry" value="<?php echo date('H:s a')?>"/> 
                                    <span class="input-group-addon">
                                    <i class="fa fa-clock-o bigger-110"></i>
                                    </span>
                                    </div>
									</div>
									</div>
                                    </div>
                                      
<div class="space-2"></div>


                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Called By :<font color="#FF0000">*</font></label>
									<div class="col-sm-9">
									<input type="text" id="name" value="<?php echo $username?>" class="col-xs-10 col-sm-5" name="name" />
									</div>
									</div>
                                      
                                    

                                    
<div class="space-2"></div>
                                  					   
								   
								   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark: </label>
								   <div class="col-sm-9">
								   <textarea cols="10" rows="10" class="col-xs-10 col-sm-5" id="remark" name="remark" ></textarea>
								   </div>
					               </div>
 


<div class="space-2"></div>
                      
                                  
									
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-4 col-md-9">
                        <input type="submit" class="btn btn-info"  value="Submit"> 

                       <a class="btn btn-info "  href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/">Back</a> 
											
						
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
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>
          <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.js"></script>
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
        $(document).ready(function () {
        $('#states-dropdown select').change(function () {
        var selState = $(this).attr('value');
        console.log(selState);
                    $.ajax({   
                        url: "enquiry_form/ajax_call", //The url where the server req would we made.
                        async: false,
                        type: "POST", //The type which you want to use: GET/POST
                        data: "state="+selState, //The variables which are going.
                        dataType: "html", //Return data type (what we expect).
                          
                        //This is the function which will be called if ajax call is successful.
                        success: function(data) {
                            //data is the html of the page where the request is made.
                            $('#district').html(data);
                        }
                    })
                });
            });
        </script>   
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	

	});
				
	
	
	
	
	</script>
	
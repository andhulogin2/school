<?php include_once APPPATH . 'views/library_head.php';?>
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
							<li class="active">New Publisher</li>
						</ul>
                        <form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					<!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Publisher
								</small>
							</h1>
                             <div align="right" style="padding-right:100px"> 
                                 
                              <a href="<?php echo base_url();?>index.php/Library/view_publisher/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                     <?php echo form_open('Library/add_new_publisher', array('class' => 'form-horizontal'));?>
                     <br/> <br/>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Publisher Name :</label>

										<div class="col-sm-8">
											<input type="text" id="author_name" placeholder="Publisher Name" class="col-xs-10 col-sm-5" name="publisher_name" />
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Address :</label>

										<div class="col-sm-8">
											<input type="text" id="publisher_address" placeholder="Address" class="col-xs-10 col-sm-5" name="publisher_address" />
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone Number 1 :</label>

										<div class="col-sm-8">
											<input type="text" id="publisher_phone1" placeholder="Phone Number 1" class="col-xs-10 col-sm-5" name="publisher_phone1" />
										</div>
									</div>
						

							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone Number 2 :</label>

										<div class="col-sm-8">
											<input type="text" id="publisher_phone2" placeholder="Phone Number 2" class="col-xs-10 col-sm-5" name="publisher_phone2" />
										</div>
									</div>
							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email 1:</label>

										<div class="col-sm-8">
											<input type="text" id="publisher_email1" placeholder="Email 1" class="col-xs-10 col-sm-5" name="publisher_email1" />
										</div>
									</div>		
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email 2:</label>

										<div class="col-sm-8">
											<input type="text" id="publisher_email2" placeholder="Email 2" class="col-xs-10 col-sm-5" name="publisher_email2" />
										</div>
									</div>		

								
                                  <br/>  
                                     
									 <div class="clearfix form-actions">
		<div class="col-md-offset-4 col-md-8">
                         <input type="submit" class="btn btn-info" value="Save"> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div>

			<?php include_once APPPATH . 'views/footer.php'; ?>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace/elements.scroller.js"></script>
		<script src="../assets/js/ace/elements.colorpicker.js"></script>
		<script src="../assets/js/ace/elements.fileinput.js"></script>
		<script src="../assets/js/ace/elements.typeahead.js"></script>
		<script src="../assets/js/ace/elements.wysiwyg.js"></script>
		<script src="../assets/js/ace/elements.spinner.js"></script>
		<script src="../assets/js/ace/elements.treeview.js"></script>
		<script src="../assets/js/ace/elements.wizard.js"></script>
		<script src="../assets/js/ace/elements.aside.js"></script>
		<script src="../assets/js/ace/ace.js"></script>
		<script src="../assets/js/ace/ace.ajax-content.js"></script>
		<script src="../assets/js/ace/ace.touch-drag.js"></script>
		<script src="../assets/js/ace/ace.sidebar.js"></script>
		<script src="../assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="../assets/js/ace/ace.submenu-hover.js"></script>
		<script src="../assets/js/ace/ace.widget-box.js"></script>
		<script src="../assets/js/ace/ace.settings.js"></script>
		<script src="../assets/js/ace/ace.settings-rtl.js"></script>
		<script src="../assets/js/ace/ace.settings-skin.js"></script>
		<script src="../assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="../assets/js/ace/ace.searchbox-autocomplete.js"></script>

		<!-- inline scripts related to this page -->

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="../docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="../assets/js/ace/elements.onpage-help.js"></script>
		<script src="../assets/js/ace/ace.onpage-help.js"></script>
		<script src="../docs/assets/js/rainbow.js"></script>
		<script src="../docs/assets/js/language/generic.js"></script>
		<script src="../docs/assets/js/language/html.js"></script>
		<script src="../docs/assets/js/language/css.js"></script>
		<script src="../docs/assets/js/language/javascript.js"></script>
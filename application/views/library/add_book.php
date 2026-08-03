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
							<li class="active">Books</li>
                            <li class="active">New Book</li>
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
		<h1>Add<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Book
		</small>
		</h1>
		</div>
                             <div align="right" style="padding-right:100px"> 
                                 
                              <a href="<?php echo base_url();?>index.php/library/view_book_details/"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                     <?php echo form_open('Library/add_book_data', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    <div class="form-group">
										
										<div class="col-sm-9">
											 <input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>
										</div>
									</div>
                                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Book Number:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="book_number" placeholder="Book Number" class="col-xs-10 col-sm-5" name="book_number" required/>
										</div>
									</div>
									   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><font color="#FF0000">*</font> Book Name:</label>

										<div class="col-sm-9">
											<input type="text" id="book_name" placeholder="Book Name" class="col-xs-10 col-sm-5" name="book_name" required/>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Shelf Number:</label>

										<div class="col-sm-9">
											<select id="shelf" data-placeholder="Choose a Author..." name="shelf_id" style="width:300px;">
										      <option value=""></option>
												
												<?php foreach($shelf as $x)
																{ ?>
   																	 <option value="<?php echo $x->shelf_id ?>"><?php echo $x->shelf_number ?></option>
																	<?php 
																} ?>
										
										
											</select>
										</div>
									</div>
                                    
                                  
								
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author:</label>

										<div class="col-sm-9">
											<select id="author" data-placeholder="Choose a Author..." name="author_id" style="width:300px;">
										      <option value=""></option>
												
												<?php foreach($list_data as $x)
																{ ?>
   																	 <option value="<?php echo $x['author_id'] ?>"><?php echo $x['author_name'] ?></option>
																	<?php 
																} ?>
										
										
											</select>
										</div>
									</div>
							
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Language :</label>

										<div class="col-sm-9">
											<select id="language" data-placeholder="Choose a Language..." name="language_id" style="width:300px;">
										      <option value=""></option>
												
												<?php foreach($languagedata as $x)
																{ ?>
   																	 <option value="<?php echo $x->book_language_id ?>"><?php echo $x->book_language_name ?></option>
																	<?php 
																} ?>
										
										
											</select>
										</div>
									</div>
						
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category :</label>

										<div class="col-sm-9">
											<select id="category" data-placeholder="Choose a Category..." name="category_id" style="width:300px;">
										      <option value=""></option>
												
												<?php foreach($categorydata as $x)
																{ ?>
   																	 <option value="<?php echo $x->book_category_id ?>"><?php echo $x->book_category_name ?></option>
																	<?php 
																} ?>
										
										
											</select>
										</div>
									</div>
						
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stream :</label>

										<div class="col-sm-9">
											<select id="stream" data-placeholder="Choose a stream..." name="stream_id" style="width:300px;">
										      <option value=""></option>
												
												<?php foreach($streamdata as $x)
																{ ?>
   																	 <option value="<?php echo $x->book_stream_id ?>"><?php echo $x->book_stream_name ?></option>
																	<?php 
																} ?>
										
										
											</select>
										</div>
						</div>
						 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ISBN:</label>

										<div class="col-sm-9">
											<input type="text" id="isbn" placeholder="ISBN" class="col-xs-10 col-sm-5" name="isbn" />
										</div>
									</div>
								
                                <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Edition:</label>

										<div class="col-sm-9">
											<input type="text" id="edition" placeholder="Edition" class="col-xs-10 col-sm-5" name="edition" />
										</div>
									</div>
								
                                <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price:</label>

										<div class="col-sm-9">
											<input type="text" id="price" placeholder="Price" class="col-xs-10 col-sm-5" name="price" />
										</div>
									</div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No.of Pages:</label>

										<div class="col-sm-9">
											<input type="text" id="no_of_pages" placeholder="Pages" class="col-xs-10 col-sm-5" name="no_of_pages" />
										</div>
									</div>
								
							
							
							
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                         <input type="submit" class="btn btn-info"  value='Save'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div>

			<?php include_once APPPATH . 'views/footer.php'; ?>
            

<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() 
		{
			$("#author").select2({
				  });
		});
		
		
		
		
		
		 </script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>/js/ace/ace.searchbox-autocomplete.js"></script>

	

        <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
</script>
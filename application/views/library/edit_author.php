<?php include_once APPPATH . 'views/library_head.php';?>
 

<body>
        
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
							<li class="active">New Author</li>
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
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Author
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				  <?php $edit_data = $this->db->get_where('tbl_lib_authors' , array('author_id' => $author_id))->result_array();
                      foreach ($edit_data as $row2):
                ?>
                     
                     <?php echo form_open('Library/edit_author', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
                                     
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="author_name" value="<?php echo $row2['author_name'];?>" class="col-xs-10 col-sm-5" name="author_name" />
                                            
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author Address:<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="author_address" value="<?php echo $row2['author_address'];?>" class="col-xs-10 col-sm-5" name="author_address" />
                                            
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author Phone1 :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="author_phone1" value="<?php echo $row2['author_phone1'];?>" class="col-xs-10 col-sm-5" name="author_phone1" />
                                            
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author Phone2:<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="author_phone2" value="<?php echo $row2['author_phone2'];?>" class="col-xs-10 col-sm-5" name="author_phone2" />
                                            
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Author Email:<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="author_email"value="<?php echo $row2['author_email'];?>" class="col-xs-10 col-sm-5" name="author_email" />
                                            
										</div>
									</div>
                          											<input type="hidden" id="author_id" value="<?php echo $author_id;?>" class="col-xs-10 col-sm-5" name="author_id" />

									

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                        <?php
                endforeach;
                ?>   
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

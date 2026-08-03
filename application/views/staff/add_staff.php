<?php include_once APPPATH . 'views/staff_head.php';?>
 

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
								STAFF
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admission Form
								</small>
							</h1>
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

									
									<div class="space-4"></div>

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

										<div class="col-sm-4">
										<input type="text" id="datepicker" class="form-control" />
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
										</div>
									</div>
                                    
                             </form>
                      </div>
                     </div>     -->  
                     
                     <?php echo form_open('Admin/add_staff', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Name: </label>

										<div class="col-sm-9">
											<input type="text" id="user_name" name="user_name" placeholder="User Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email: </label>

										<div class="col-sm-9">
											<input type="text" id="email" name="email" placeholder="Email" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>

									

											

								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Password: </label>

										<div class="col-sm-9">
											<input type="password" id="password" name="password" placeholder="Password" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="phone" name="phone" placeholder="Phone number" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>

										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-5" id="address" name="address" placeholder="Address"></textarea>
											
										</div>
									</div>
									
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Salary: </label>

										<div class="col-sm-9">
											<input type="text" id="salary" name="salary" placeholder="Salary" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>

										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-5" id="sex" name="sex" data-placeholder="Select one">
                                               <option value="">Select one</option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										
             
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> PHOTO: </label>
                           <div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new">Upload</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Delete</a>
								</div>
							</div>
						</div>
                        </div>
                                   <div align="right">     
                              <a href="<?php echo base_url();?>index.php/staff/staff_view" class="btn btn-success fileinput-exists" data-dismiss="fileinput">View Staff</a>       
                                   </div> 
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
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

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/staff/get_class_section/' + class_id ,
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

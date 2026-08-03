<?php include_once APPPATH . 'views/main_head.php';?>
 

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
							<li class="active">New Class</li>
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
									New Class
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                     <?php echo form_open('staff/update_section', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
                                     
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section Name :<font color="#FF0000">* </font></label>
                                     <?php $p=$this->db->get_where('section',array('section_id'=>$section_id))->result_array();
									 foreach($p as $row){?>
										<div class="col-sm-9">
											<input type="text" id="name" value="<?php echo $row['name'];?>" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>
  											<input type="hidden" id="section" value="<?php echo $row['section_id'];?>" class="col-xs-10 col-sm-5" name="section" />

                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="class_id" class="col-xs-10 col-sm-5" data-validate="required">
                                             <?php $p=$this->db->get_where('class',array('class_id'=>$row['class_id']))->result_array();
									 foreach($p as $row2){?>
                              <option value=""><?php echo $row2['name'];}?></option>
                              <?php  $classes = $this->db->get('class')->result_array();
								foreach($classes as $row1){ ?>
                            		<option value="<?php echo $row1['class_id'];?>">
									<?php echo $row1['name'];?>
                                    </option>
                                <?php
								}
							  ?>
                          </select>
										</div>
									</div>
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Teacher :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="teacher_id" class="col-xs-10 col-sm-5" data-validate="required">
                                           <?php $w=$this->db->get_where('teacher',array('teacher_id'=>$row['teacher_id']))->result_array();
										   foreach($w as $row3){?>
                              <option value=""><?php echo $row3['name'];}?></option>
                              <?php 
									$teachers = $this->db->get('teacher')->result_array();
									foreach($teachers as $row4){
										?>
                                		<option value="<?php echo $row4['teacher_id'];?>">
												<?php echo $row4['name'];?>
                                                </option>
                                    <?php
									}
									}
								?>
                          </select>
										</div>
									</div>
									

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
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

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
							<li class="active">Admin Settings</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Settings
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admin Settings
								
							</h1>
						</div>
                        <div class="row">
                       <?php 
                $info = $this->db->get('sms_settings', array('id' => '1'))->row();
                 
                 ?>
<?php echo form_open(base_url() . 'index.php/admin/admin_settings/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">SMS Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                     <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">URL</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="url" data-validate="required" data-message-required="Required" value="<?php echo $info->url;?>" autofocus>
						</div>
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="username" data-validate="required" data-message-required="Required" value="<?php echo $info->username;?>" autofocus>
						</div>
					</div>
                  <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password" data-validate="required" data-message-required="Required" value="<?php echo $info->password;?>" autofocus>
						</div>
					</div>
                     <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Sender ID</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="sender_id" data-validate="required" data-message-required="Required" value="<?php echo $info->sender_id;?>" autofocus>
						</div>
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Common Word</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="common_word" data-validate="required" data-message-required="Required" value="<?php echo $info->common_word;?>" autofocus>
						</div>
					</div>
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Web URL</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="web_url" data-validate="required" data-message-required="Required" value="<?php echo $info->web_url;?>" autofocus>
						</div>
					</div>
					<!--<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php //echo get_phrase('Description'); ?></label>
						<div class="col-sm-8">
							<textarea class="textarea_editor form-control"  name="description" rows="15" placeholder="<?php //echo get_phrase('Description'); ?>..."></textarea>
						</div>
					</div>
--> 
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Update</button>
						</div>
					</div>
                <?php echo form_close();?>
            
        </div>
 
          </div>

     </div>
     
    </div>
   
    
    
                        
                        
                        
<div class="row">
    <?php echo form_open(base_url() . 'index.php/admin/admin_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-4">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Admin Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  

                 
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Parent Login</label>
                      
                      
                      
                      <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="True" <?php if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True') echo 'checked';?> name="parent_login" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                      
                          
                      
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-5 control-label">School</label>
                      
                      <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="True" <?php if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True') echo 'checked';?> name="school" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                  </div>
                   
                   <div class="form-group">
                      <label  class="col-sm-5 control-label">Common word allign Front</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="First" <?php if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First') echo 'checked';?> name="pos_common_word" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                      
                     
                  </div>
            
                  <div class="form-group">
                      <label  class="col-sm-5 control-label">Rank</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'rank'))->row()->description == 'yes') echo 'checked';?> name="rank" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      

                      
                     
                  </div>
                   
                  
                   
                   
                  
            		<div class="form-group">
                    <label  class="col-sm-5 control-label">Student-Name In Message</label>
                    
                    
                    
                    <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes') echo 'checked';?> name="msg_student_name" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                      
                      </div>
                      
                      
                     
                       </div>
                      
                       
                    
            
            
                  <br />
                  
                  
                  
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                  <br><br><br><br>
                    <?php echo form_close();?>
                </div>
            </div>
            
            
   
<div class="row">
    <?php echo form_open(base_url() . 'index.php/admin/admin_settings_att_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-4">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Attendance Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  

                 
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Diary</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="1" <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') echo 'checked';?> name="diary" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                      
                  </div>
                   
                  <div class="form-group">
                   <label  class="col-sm-5 control-label">Full-Attendance</label>
                   
                   <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'full_attendance'))->row()->description == 'yes') echo 'checked';?> name="full_attendance" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                   
                   
                      
                      </div>
            		
                      
                      
                     
                      
                        
                    


<div class="form-group">
                    <label  class="col-sm-5 control-label">Attendance</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes') echo 'checked';?> name="attendance" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">Hourly Attendance</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes') echo 'checked';?> name="h_attendance" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">Teacher Attendance</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'teacher_attendance'))->row()->description == 'yes') echo 'checked';?> name="teacher_attendance" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      
                       
                      
                     
                       </div>
                      
                       
                    
            
            
                  <br />
                  
                  
                  
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                  <br><br><br><br><br>
                    <?php echo form_close();?>
                </div>
            </div>
            
   
      
    <div class="row">
    <?php echo form_open(base_url() . 'index.php/admin/admin_settings_menu_update' ,  
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-4">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Menu Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  

                 
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Fee-Details</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes') echo 'checked';?> name="fee_details" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                     
                  </div>
                   
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Special Fee</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes') echo 'checked';?> name="special_fee" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                     
                  </div>
                   
                    
                    
                    
                    
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Transportation</label>
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes') echo 'checked';?> name="transportation" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                  	</div>
                   
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Stock Manager</label>
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'stock'))->row()->description == 'yes') echo 'checked';?> name="stock" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                  	</div>
                   
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Home Test</label>
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'home_test'))->row()->description == 'yes') echo 'checked';?> name="home_test" class="ace ace-switch ace-switch-2" data-color="#13dafe" /><?php //echo $this->db->last_query();die(); ?> 
														<span class="lbl"></span>
													</label>
												</div>
                  	</div>
                   
                    <div class="form-group">
                      <label  class="col-sm-5 control-label">Entrance Test</label>
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'entrance_test'))->row()->description == 'yes') echo 'checked';?> name="entrance_test" class="ace ace-switch ace-switch-2" data-color="#13dafe" /><?php //echo $this->db->last_query();die(); ?> 
														<span class="lbl"></span>
													</label>
												</div>
                  	</div>
                   
                   
                   
                  <div class="form-group">
                    <label  class="col-sm-5 control-label">Complaint view</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'complaint_view'))->row()->description == 'yes') echo 'checked';?> name="complaint_view" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                      
                      </div>
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">Course Enquiry</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'enquiry_view'))->row()->description == 'yes') echo 'checked';?> name="enquiry_view" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">Students Enquiry</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'students_enquiry'))->row()->description == 'yes') echo 'checked';?> name="students_enquiry" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                       <div class="form-group">
                    <label  class="col-sm-5 control-label">Homework</label>
                    
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'homework'))->row()->description == 'yes') echo 'checked';?> name="homework" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                      
                      </div>
                       <div class="form-group">
                    <label  class="col-sm-5 control-label">Study_Meterials</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'study_meterial'))->row()->description == 'yes') echo 'checked';?> name="study_meterial" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      
                      
                      
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">News</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'news'))->row()->description == 'yes') echo 'checked';?> name="news" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      <div class="form-group">
                    <label  class="col-sm-5 control-label">Time Table</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'time_table'))->row()->description == 'yes') echo 'checked';?> name="time_table" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                     
                      
                      
                     
                      
                        
                    



                      
                      
                       <div class="form-group">
                    <label  class="col-sm-5 control-label">Expense</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'expense'))->row()->description == 'yes') echo 'checked';?> name="expense" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                    
                    
                     
                      </div>
                      
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Admission(class teacher login)</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'admission'))->row()->description == 'yes') echo 'checked';?> name="admission" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Migrate Class Section</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'migrate_class_section'))->row()->description == 'yes') echo 'checked';?> name="migrate_class_section" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
           <!-- Show all dues of a student/Show first due only -->          
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Show Multiple Dues in Due Report</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_multiple_dues'))->row()->description == 'yes') echo 'checked';?> name="show_multiple_dues" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                    
             <!-- Add fee balance of all dues of a student and display in single row/Show all dues of a student.-->        
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Show Sum of All Dues of a Student in One Row</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'single_row_for_all_dues'))->row()->description == 'yes') echo 'checked';?> name="single_row_for_all_dues" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">View Inactive Students to All</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'view_inactive_for_others'))->row()->description == 'yes') echo 'checked';?> name="view_inactive_for_others" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Internal Mark</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'internal_mark'))->row()->description == 'yes') echo 'checked';?> name="internal_mark" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Fee 2</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'fee2'))->row()->description == 'yes') echo 'checked';?> name="fee2" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div>
                    </div>                      
                     
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Afternoon Attendance</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'afternoon_attendance'))->row()->description == 'yes') echo 'checked';?> name="afternoon_attendance" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Completed and Discontinued Button</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'completed_discontinued_button'))->row()->description == 'yes') echo 'checked';?> name="completed_discontinued_button" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Photo Gallery</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'photo_gallery'))->row()->description == 'yes') echo 'checked';?> name="photo_gallery" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Student Delete Option</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'student_delete'))->row()->description == 'yes') echo 'checked';?> name="student_delete" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Mark In Graph</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'mark_in_graph'))->row()->description == 'yes') echo 'checked';?> name="mark_in_graph" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Auto Increment Admission No.</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'auto_inc_adm_no'))->row()->description == 'yes') echo 'checked';?> name="auto_inc_adm_no" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Academic Year Changing Option</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'acc_year_change'))->row()->description == 'yes') echo 'checked';?> name="acc_year_change" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">TC</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'tc'))->row()->description == 'yes') echo 'checked';?> name="tc" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Exam Timetable</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'exam_timetable'))->row()->description == 'yes') echo 'checked';?> name="exam_timetable" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Hall Ticket</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'hall_ticket'))->row()->description == 'yes') echo 'checked';?> name="hall_ticket" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Half Day Leave</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes') echo 'checked';?> name="half_day_leave" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Attendance Summary</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'attendance_summary'))->row()->description == 'yes') echo 'checked';?> name="attendance_summary" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Admission Report</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'admission_report'))->row()->description == 'yes') echo 'checked';?> name="admission_report" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Year Changing In Settings Menu</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'year_change_in_settings'))->row()->description == 'yes') echo 'checked';?> name="year_change_in_settings" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Receipt Number In Textbox</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_receipt_number_in_textbox'))->row()->description == 'yes') echo 'checked';?> name="show_receipt_number_in_textbox" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Directly Added Students List</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'non_migrated_students_list'))->row()->description == 'yes') echo 'checked';?> name="non_migrated_students_list" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Today's collection in dashboard</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_todays_collection_in_dashboard'))->row()->description == 'yes') echo 'checked';?> name="show_todays_collection_in_dashboard" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Field for Mother's name and Parent id</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes') echo 'checked';?> name="parent_id_mother_name" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">OTP for expense add</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'otp_for_expense_add'))->row()->description == 'yes') echo 'checked';?> name="otp_for_expense_add" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Show Transport Fee with Normal Fee</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_transport_fee_with_normal_fee_pay'))->row()->description == 'yes') echo 'checked';?> name="show_transport_fee_with_normal_fee_pay" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Installment Wise Receipt</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'installment_wise_receipt'))->row()->description == 'yes') echo 'checked';?> name="installment_wise_receipt" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Installments Row In Receipt</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'installments_row_in_receipt'))->row()->description == 'yes') echo 'checked';?> name="installments_row_in_receipt" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      

                    <div class="form-group">
                        <label  class="col-sm-5 control-label">View Deleted For Others</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'view_deleted_for_others'))->row()->description == 'yes') echo 'checked';?> name="view_deleted_for_others" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Accounts</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'account'))->row()->description == 'yes') echo 'checked';?> name="account" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Add Transport Due with Fee Due</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'transport_due_with_fee_due'))->row()->description == 'yes') echo 'checked';?> name="transport_due_with_fee_due" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Double Receipt per Page</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_double_receipt_per_page'))->row()->description == 'yes') echo 'checked';?> name="show_double_receipt_per_page" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                    <div class="form-group">
                        <label  class="col-sm-5 control-label">Double Receipt Minhaj</label>
                        <div class="col-xs-3">
                            <label>
                            <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'show_double_receipt_minhaj'))->row()->description == 'yes') echo 'checked';?> name="show_double_receipt_minhaj" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                            <span class="lbl"></span>
                            </label>
                        </div> 
                    </div>                      
                     
                       
                       
                  
                 </div>
                      
                       
                    
            
            
                  <br />
                  
                  
                  
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                  <br>
                    <?php echo form_close();?>
                </div>
            </div></div>
            
           
              
   
 
    
<?php include_once APPPATH . 'views/footer.php'; ?>
    <script>
jQuery(document).ready(function () 
  {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () 
    {
       new Switchery($(this)[0], $(this).data());
    });
});
</script>
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
							<li class="active">Settings</li>
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
								SETTINGS
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admin settings
								</small>
							</h1>
						</div>
<div class="row">
    <?php echo form_open(base_url() . 'index.php/staff/staff_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Admin Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  

                  <div class="form-group">
                      <label  class="col-sm-5 control-label">RTL</label>
                      
                      <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="rtl" <?php if($this->db->get_where('settings' , array('type' =>'rtl'))->row()->description == 'rtl') echo 'checked';?> name="rtl" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                         
                     
                  </div>
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
                      <label  class="col-sm-5 control-label">Diary</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="1" <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') echo 'checked';?> name="diary" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
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
                      <label  class="col-sm-5 control-label">Bus-Details</label>
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'bus_details'))->row()->description == 'yes') echo 'checked';?> name="bus_details" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                      
                  </div>
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
                      <label  class="col-sm-5 control-label">Expence</label>
                      
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'expence'))->row()->description == 'yes') echo 'checked';?> name="expence" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
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
                    <label  class="col-sm-5 control-label">Student-Name In Message</label>
                    
                    
                    
                    <div class="col-xs-3">
													<label>
														 <input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes') echo 'checked';?> name="msg_student_name" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
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
                    <label  class="col-sm-5 control-label">Enquiry view</label>
                    
                    
                    <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'enquiry_view'))->row()->description == 'yes') echo 'checked';?> name="enquiry_view" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
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
                      <label  class="col-sm-5 control-label">Delete</label>
                      
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'delete'))->row()->description == 'yes') echo 'checked';?> name="delete" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
														<span class="lbl"></span>
													</label>
												</div>
                      
                      
                     
                      
                       
                      </div>

            
                  <br />
                  
                  
                  
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                  <br><br><br><br><br><br><br>
                    <?php echo form_close();?>
                </div>
            </div>
            
   

      
    
           
              <?php 
                $info = $this->db->get('sms_settings', array('id' => '1'))->row();
                 
                 ?>
<?php echo form_open(base_url() . 'index.php/staff/sms_settings/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
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
  
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
<?php /*
/////////////////////////////////////////////////////////////**************************************************/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////***************************************************/////////////////////////////////////////////////////////////////////
/*	   
	   ?> <div class="panel panel-info" >
         <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Skin');?></font>
                      </div>
                  </div>
              <div class="panel-body">
               <?php echo form_open(base_url() . 'index.php?staff/system_settings/skin_colour' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>   
                <div class="radio radio-custom">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'dark') echo 'checked';?> name="skin_colour" id="radio2" value="dark">
                  <label for="radio2"> White </label>
                </div>
                <div class="radio radio-primary">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'purple') echo 'checked';?> name="skin_colour" id="radio3" value="purple">
                  <label for="radio3"> Purple </label>
                </div>
                <div class="radio radio-info">
                  <input type="radio" name="skin_colour" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'blue') echo 'checked';?> id="radio5" value="blue">
                  <label for="radio5"> Blue </label>
                </div>
                <div class="radio radio-danger">
                  <input type="radio" name="skin_colour"  <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'danger') echo 'checked';?> id="radio6" value="danger">
                  <label for="radio6"> Danger </label>
                </div>
                <div class="radio radio-success">
                  <input type="radio" name="skin_colour"  <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'megna') echo 'checked';?> id="radio7" value="megna">
                  <label for="radio7"> Megna </label>
                </div>
                <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                      </div>
                    </div>
                    <?php echo form_close();?>
                </div>
      </div><?php */?>
          </div>

       <?php /*?> <div class="col-md-6">
            <?php echo form_open(base_url() . 'index.php?staff/system_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Logo');?></font>
                      </div>
                  </div>
                  
                  <div class="panel-body">   
                      <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Logo');?></label>
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                  <div>
                                      <span class="btn btn-info btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
         </div>

        <div class="col-md-6">
            <?php echo form_open(base_url() . 'index.php?staff/system_settings/ad' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Quick-ad');?></font>
                      </div>
                  </div>
                  
                  <div class="panel-body">
                     <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="7" name="ad" id="post_content"><?php echo $this->db->get_where('settings' , array('type' =>'ad'))->row()->description;?></textarea>
                    </div>
                </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Send');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
         </div>
        </div>

 <div class="row">
    <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?staff/system_settings/upload_slider' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider1');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider1.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?staff/system_settings/upload_slider2' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider2');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider2.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
              
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?staff/system_settings/upload_slider3' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider3');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider3.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div><?php */?>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    
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
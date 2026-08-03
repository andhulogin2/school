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
    <?php echo form_open(base_url() . 'index.php/admin/admin_settings/do_update' , 
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
                      <label  class="col-sm-5 control-label">Fee-Details</label>
                      
                      
                      <div class="col-xs-3">
													<label>
														<input type="checkbox" value="yes" <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes') echo 'checked';?> name="fee_details" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
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
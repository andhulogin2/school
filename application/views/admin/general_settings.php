<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 

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
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									General Settings
								
							</h1>
						</div>

<div class="row">
    <?php echo form_open(base_url() . 'index.php/admin/general_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">General Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"> School Name</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_name" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">System-Title</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_title" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
                      </div>
                  </div>
                
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Address</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="address" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
                      </div>
                  </div>
          
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Language</label>
                      <div class="col-sm-9">
                          <select name="language" class="form-control selectboxit">
                                <?php $fields = $this->db->list_fields('language');
                                  foreach ($fields as $field)
                                {
                    if ($field == 'phrase_id' || $field == 'phrase') continue;
                    $current_default_language = $this->db->get_where('settings' , array('type'=>'language'))->row()->description; ?>
                              <option value="<?php echo $field;?>"
                                <?php if ($current_default_language == $field) echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php } ?>
                           </select>
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Phone</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
                      </div>
                  </div>
                  
                 
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                      </div>
                  </div>

                  <?php if($this->session->userdata('role')==1) 
				  {
				  ?>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Year</label>
                      <div class="col-sm-9">
                          <select name="running_year" class="form-control selectboxit">
                          <?php
						   $acdemic_year=$this->db->get_where('settings',array('type'=>'running_year'))->row()->description;

						  $this->db->where('is_deleted','N'); 
						  $running_year = $this->db->get('tbl_academic_year')->result_array();
						  ?>
                          <option value="">Select</option>
                          <?php foreach($running_year as $data){
						  if($acdemic_year==$data['acdemic_year_id'])
						  {
						  ?><option value="<?php echo $data['acdemic_year_id'];?>" selected="selected"><?php echo $data['academic_year'];?></option><?php
						  }
						  else
						  {
						  ?><option value="<?php echo $data['acdemic_year_id'];?>"><?php echo $data['academic_year'];?></option>
                          <?php
						  }
						  } ?>
                          </select>
                      </div>
                  </div>
                  
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Header Title</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="header_title" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'header_title'))->row()->description;?>">
                      </div>
                  </div>
                  
                  
                  
                  
                  
                  <?php }?>
                  <br>

                 
                    <?php /*?><div class="form-group">
                      <label  class="col-sm-5 control-label">Parent Login</label>
                      <div class="col-sm-5">
                          <input type="checkbox" value="True" <?php if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True') echo 'checked';?> name="parent_login" class="js-switch" data-color="#13dafe" />
                      </div>
                  </div><?php */?>
                   <?php /*?><div class="form-group">
                      <label  class="col-sm-5 control-label">Common word allign Front</label>
                      <div class="col-sm-5">
                          <input type="checkbox" value="First" <?php if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First') echo 'checked';?> name="pos_common_word" class="js-switch" data-color="#13dafe" />
                      </div>
                  </div><?php */?>
                <br>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
        
        
        
        
        

      
        <div class="col-md-6">
           <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Logo</font>
                      </div>
                  </div>
                  
                  <div class="panel-body">   
                      <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label">Logo</label>
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                                  </div>
                                  <div class="col-md-9">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				<div><font color="#FF0000">Note: Photo Must Be In 135x90 Size</font></div>

				<div class="hr hr-12 dotted"></div>

				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>                           
                                
                          </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Update</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
            </div>
        </div>    
            
         
		 
		 
		 <div class="row">
		  
          
          <div class="col-md-3">
           <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_front_image' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Front Image</font>
                      </div>
                  </div>
                  
                 
                                  
                                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/front_image.jpg" alt="...">
                                  </div>
                                   <div class="col-sm-5">
											
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>

				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>                           
                                
                          </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Update</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
            </div>
            
             <div class="col-md-3">
           <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_dashboard_slider' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Dashboard Slider</font>
                      </div>
                  </div>
                  
                  
                                  
                                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                       <img src="<?php echo base_url();?>assets/images/slider_1.jpg" alt="..." >
                                  </div>
                                   <div class="col-sm-5">
											
				
		
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />

				<div class="hr hr-12 dotted"></div>

				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>                           
                                
                          </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Update</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
            </div>
            
            
            
            <?php if($this->session->userdata('role')==1){ ?>
 <div class="col-md-3" >
           <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_file' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Upload APK File</font>
                      </div>
                  </div>
                  
                  <br>
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Title:<font color="#FF0000">*</font></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="title" id="title" required="">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">File:<font color="#FF0000">*</font></label>
                      <div class="col-sm-9">
                          <input  type="file" name="userfile" required=""  />
                      </div>
                  </div>
                  
    
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                     
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Update</button>
                      </div>
                    </div>
                 
                 
                  </div>
            <?php echo form_close();?>
            </div>
                 
<?php } ?>		 
		 
		 
         
 
 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 <?php /*?>   <?php echo form_open(base_url() . 'index.php?admin/system_settings/socials' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Site Settings</font>
                    </div>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Facebook URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="facebook_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'facebook_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Google+ URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="google_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'google_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">LinkedIn URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="linkedin_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'linkedin_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Instagram URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="instagram_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'instagram_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">YouTube URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="youtube_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'youtube_url'))->row()->description;?>">
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>
                </div>
            </div><?php */?>
              <?php 
                $info = $this->db->get('sms_settings', array('id' => '1'))->row();
                 
                 ?>
<?php echo form_open(base_url() . 'index.php/admin/sms_settings/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
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
               <?php echo form_open(base_url() . 'index.php?admin/system_settings/skin_colour' , array(
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
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_logo' , array(
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
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/ad' , array(
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

 <div class="row">*/?>
    <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_slider' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Slider1</font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 111px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider1.png" alt="...">
                                  </div>
                                   <div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>     
                          </div>
                      </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Upload</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_slider2' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Slider2</font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 111px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider2.png" alt="...">
                                  </div>
                                   <div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>     
                          </div>
                      </div>
              
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Upload</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php/admin/general_settings/upload_slider3' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white">Slider3</font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 111px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider3.png" alt="...">
                                  </div>
                                  <div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>     
                          </div>
                      </div>
                    
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info">Upload</button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
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
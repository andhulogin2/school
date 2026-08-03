<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <?php $running_year = get_running_year();
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
							<li class="active">Message</li>
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
								Admin
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Messages
								
							</h1>
						</div>
                       
                        
<div class="col-sm-12 widget-container-col">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4 class="widget-title lighter"><font color="#FFFFFF">Message</font></h4>

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab2">
														<li class="active">
															<a data-toggle="tab" href="#home1"><font color="#FFFFFF">New</font></font></a>
														</li>
														<li>
															<a data-toggle="tab" href="#home2"><font color="#FFFFFF">Multiple Class</font></font></a>
														</li>
														
													<?php  if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True')
	 {?>
														<li>
															<a data-toggle="tab" href="#info2"><font color="#FFFFFF">Login Details</font></a>
														</li>
                                                        <?php } ?>
                                                        <li>
															<a data-toggle="tab" href="#info3"><font color="#FFFFFF">Send All</font></a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info4"><font color="#FFFFFF">Special Message</font></a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info5"><font color="#FFFFFF">Malayalam SMS</font></a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info6"><font color="#FFFFFF">Group SMS</font></a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info7"><font color="#FFFFFF">Staff</font></a>
														</li>
                                                        <?php
														if($this->db->get_where('settings' , array('type' =>'sms_without_name'))->row()->description == 'yes')
														{
														?>
                                                        <li>
															<a data-toggle="tab" href="#info8"><font color="#FFFFFF">Sms Without Names</font></a>
														</li>
                                                        <?php
														}
														?>
													</ul>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-12 no-padding-left no-padding-right">
													<div class="tab-content padding-4">
                                                    
														<div id="home1" class="tab-pane in active">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
																<?php echo form_open(base_url() . 'index.php/admin/new_private_message/');?>

 <div class="row">
    
    <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch" class="select2" required=""  onChange="return get_dept(this.value)" id="branch">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
                    <div class="form-group" >
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
			<select name="class" class="select2"  required=""    onChange="return get_class_sections(this.value);" id="class" >
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div> <?php } 
    if($role==3)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                               <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
                         
                       
						</div> 
					</div>
                   
                    <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
					<select name="class" class="select2" required="" onChange="return get_class_sections(this.value)" id="class" >
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div>
                    <?php }?>
                    <?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>
<div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return get_class_sections(this.value)" id="class">
                             <option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                         
                       
						</div> 
					</div>
    </div>
<?php } ?>
     <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section<font color="#FF0000">*</font></label>
		                    <div >
                           
		                        <select name="section" class="select2" id="section_selector_holder" onChange="return get_student_details(this.value,class.value)" required="">
		                            <option value="">Select Section</option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
<div class="row">
			<div class="form-group">
				
				<label for="field-2" class=" control-label"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                </div></div>
 <div class="col-md-12">
          <div class="form-group">
						<label for="field-2" class="control-label">SMS Template</label>
						<div >
							<select name="template" class="select2"  onchange="return get_template_content(this.value)">
                              <option value="">Select</option>
                              <?php $template = $this->db->get('sms_template')->result_array();
								foreach($template as $row){ 
		                        if($row['title']!= 'admission' && $row['title']!='attendance' && $row['title']!='birthday'){?>
	<option value="<?php echo $row['id'];?>">
									<?php echo $row['title'];}}?>
                                    </option>
                               </select>
                          
						</div> 
					</div> 
           </div>
</div>

    <div class="compose-message-editor">
                 <textarea class=" form-control" name="message" id="message" rows="10"  placeholder="Write-Message..." onChange="return get_count(this.value)" required></textarea>
    </div>
   
  
 
    <div id="msgcount" align="right">
                        </div>
                        
                        
    <br>
    <!--Send push Notification: <input type="checkbox" id="notification" name="notification" onClick="push_notification()">-->
    <button type="submit" class="btn btn-success btn-icon pull-right" name="submit" id="submit" >
       Send
        <i class="entypo-mail"></i>
    </button>
    <br>
    
    
<?php echo form_close(); ?>
</div>
</div>

<!------------ home2 Start ------------------------>
<div id="home2" class="tab-pane in">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
																<?php echo form_open(base_url() . 'index.php/admin/new_multiple_class_message/');?>

 <div class="row">
    
    <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch" class="select2" required=""  onChange="return get_dept(this.value)" id="branch">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
                    <div class="form-group" >
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
			<select name="class[]" class="select2"  required=""    onChange="get_class_count(this);" id="class" multiple="multiple">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div> <?php } 
    if($role==3)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                               <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
                         
                       
						</div> 
					</div>
                   
                    <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
					<select name="class[]" class="select2" required="" onChange="get_class_count(this);" id="class" multiple="multiple">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div>
                    <?php }?>
                    <?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>
<div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class[]" class="select2" required="" onChange="get_class_count(this);" id="class" multiple="multiple">
                             <option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                         
                       
						</div> 
					</div>
    </div>
<?php } ?>
     
<div class="row">
			<div class="form-group">
				
				<label for="field-2" class=" control-label"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                </div></div>
 <div class="col-md-12">
          <div class="form-group">
						<label for="field-2" class="control-label">SMS Template</label>
						<div >
							<select name="template" class="select2"  onchange="return get_template_content1(this.value)">
                              <option value="">Select</option>
                              <?php $template = $this->db->get('sms_template')->result_array();
								foreach($template as $row){ 
		                        if($row['title']!= 'admission' && $row['title']!='attendance' && $row['title']!='birthday'){?>
	<option value="<?php echo $row['id'];?>">
									<?php echo $row['title'];}}?>
                                    </option>
                               </select>
                          
						</div> 
					</div> 
           </div>
</div>

    <div class="compose-message-editor">
                 <textarea class=" form-control" name="message2" id="message2" rows="10"  placeholder="Write-Message..." onChange="return get_count(this.value)" required></textarea>
    </div>
   
  
 
    <div id="msgcount" align="right">
                        </div>
                        
                        
    <br>
    <button type="submit" class="btn btn-success btn-icon pull-right" name="submit" id="submit"  >
       Send
        <i class="entypo-mail"></i>
    </button>
    <br>
    
    
<?php echo form_close(); ?>
</div>
</div>
<!------------ home2 End --------------------------->

 
                                                        <div id="info3" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
                                                            
                                                            <?php echo form_open(base_url() . 'index.php/admin/new_sendall_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                                                            <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch1" class="select2" required="" onChange="return get_dept2(this.value)" id="branch2">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department1" class="select2" required="" onChange="return get_class_dept2(this.value)" id="department2">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                     <div class="col-md-3">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""  id="class2">
                              <option value="All">All</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
    <?php } 
	if($role==3)
{ ?> 
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="dept_id" class="select2" required="" onChange="return get_class_dept2(this.value)" id="department2">
                               <option value="">Select</option>
                               <option value="all">All</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
                         
                       
						</div> 
					</div>
                
                     <div class="col-md-3">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""  id="class2">
                              <option value="0">Select Class</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
    
          <?php } 
		  if($role==4 || $role==12){?>
          <div class="col-md-3">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""  id="class2">
                             <option value="All">All</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									  $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                         <input type="hidden" name="dept_id" value="<?php echo $dept; ?>" >
                       
						</div> 
					</div>
                    </div>
          <?php } ?>
                    
   
    <div class="col-md-6">
         
						 <div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('Message'); ?></span></label>
                <div class="col-md-12">
                    <textarea class="form-control" name="message_send" onChange="return msg_count1(this.value)" id="message_send" required></textarea>
            <!--<input type="text" name="message_send" class="form-control" />-->                
                   </div>
           
                         
                       
						
                        <div >
                       	<label class="switch switch-success"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                        </div>
					</div>
                     <div id="msgcount1" align="right">
                        </div>
                    <br><br>
                    
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-success" >
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
    </div>
    
   </div>  
    
    </div>
     <?php echo form_close(); ?>
    </div>
    
    
    
    
    
    										
    
    
    
    
    
    
    
    
    
    								
    <div id="info4" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
                                                            <?php echo form_open(base_url() . 'index.php/admin/special_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                                                            
                                                           <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-4">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch1" class="select2" required="" onChange="return get_dept3(this.value)" id="branch3">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-4">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department1" class="select2" required="" onChange="return get_class_dept3(this.value)" id="department3">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                     <div class="col-md-4">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""    onChange="return get_class_sections4(this.value)" id="class3">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
    <?php } 
	if($role==3)
{?> 
<div class="col-md-4">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department1" class="select2" required="" onChange="return get_class_dept3(this.value)" id="department3">
                              <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                     <div class="col-md-4">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""    onChange="return get_class_sections4(this.value)" id="class3">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
<?php } 
if($role==4 || $role==12)
{?>
<div class="col-md-4">
                      <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required=""    onChange="return get_class_sections4(this.value)" id="class3">
                              <option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									  $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                         
                       
						</div> 
					</div>
                    </div>
<?php } ?>
<div class="col-md-4">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section<font color="#FF0000">*</font></label>
		                    <div >
		                        <select name="section" onChange="get_details3()"  class="select2" id="section_selector_holder4" required="">
		                            <option value="0">Select-Section</option>
			                    </select>
			                </div>
					</div>
                   
			<div class="form-group">
				
				<label class="switch switch-success"><input type="checkbox" name="phone2" id="phone2" value="1" checked><span></span> phone2</label> 
                </div>
</div>
<div class="row" id="absent1" style="padding-left:10px;">
</div>

<?php echo form_close(); ?>

                                                            </div></div>
                                                            <div id="info5" class="tab-pane">
															<div class="scrollable" data-size="100">
                                                            <?php echo form_open(base_url() . 'index.php/admin/new_malayalam_message/');?>
                                                             <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch" class="select2" required="" onChange="return get_dept4(this.value)" id="branch">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept4(this.value)" id="department4">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return  get_class_sections5(this.value)" id="class4">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div> <?php } 
	if($role==3)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="dept_id" class="select2" required="" onChange="return get_class_dept4(this.value)" id="department4">
                             <option value="">Select</option>
                             <option value="all">All</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return  get_class_sections5(this.value)" id="class4">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div>  
<?php  }
if($role==4 || $role==12)
{?>
<div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return  get_class_sections5(this.value)" id="class4">
                             <option value="">Select</option>
							 <option value="all">All</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									  $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                       <input type="hidden" name="dept_id" value="<?php echo $dept; ?>" >
						</div> 
					</div>
    </div>  
<?php } ?>
 <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class=" control-label"><?php echo get_phrase('Section'); ?><font color="#FF0000">*</font></label>
		                    <div >
                           
		                        <select name="section" class="select2"  required="" id="section_selector_holder5" onChange="get_all_students()">
		                            <option value=""><?php echo get_phrase('Select-Section'); ?></option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
<div class="row">
			<div class="form-group">
				
				<label class="switch switch-success"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                </div></div>
	<div class="row">
		<div class="col-md-5" id="list_all_students" style="padding:10px;">
		
		</div>
	</div>				
				
<div class="compose-message-editor">
                <textarea class=" select2" name="message" id="message" rows="10"  placeholder="<?php echo get_phrase('Write-Message'); ?>..." onChange="return get_count(this.value)" required></textarea>
    </div>
    <div style="padding-top:30px"></div>
    <a href="https://www.google.com/intl/ml/inputtools/try/" target="_blank"><font color="#0033FF"> Type in Malayalam </font></a>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
    <?php echo form_close(); ?>
                                                            </div></div>
                                                            
<!------ Info6 Start---------------> 
                                                           
<div id="info6" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
<div class="scrollable-horizontal" data-size="800">
	<?php echo form_open(base_url() . 'index.php/admin/send_message_to_student_group', array('id' => 'grp_msg', 'class' => 'form', 'enctype' => 'multipart/form-data')); ?>
    <?php  $role=$this->session->userdata('role');
    if($role==1 || $role==2)
    {?>
    <div class="col-md-4">
        <div class="form-group">
            <label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
            <div >
                <select name="branch4" class="select2" required="" onChange="return get_dept5(this.value)" id="branch4">
                <option value="0">Select</option>
                <?php 
                $branch=$this->db->get('tbl_branch')->result_array();
                foreach ($branch as $branch1)
                {
                ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                <?php }?>
                </select>
            </div> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
            <div >
                <select name="department5" class="select2" required="" onChange="return get_student_group(this.value)" id="department5">
                <option value="0">Select</option>
                
                </select>
            </div> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="field-2" class="control-label"><?php echo get_phrase('Group'); ?><font color="#FF0000">*</font></label>
            <div >
                <select name="students_group_master_id" class="select2" required="" id="students_group_master_id" onChange="change_form_action(this.value)">
                    <option value="0">Select</option>
                </select>
            </div> 
        </div>
    </div>
        <?php } 
        if($role==3)
    {?> 
    <div class="col-md-4">
        <div class="form-group">
                            <label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
                            <div >
                                <select name="department1" class="select2" required="" onChange="return get_student_group(this.value)" id="department3">
                                  <option value="">Select</option>
                                  <?php 
                                  $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                  $dept=$this->db->get('tbl_department')->result_array();
                                  foreach ($dept as $dept1)
                                  {
                                  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                                  <?php }?>
                              </select>
                             
                           
                            </div> 
                        </div>
                        </div>
                         <div class="col-md-4">
                          <div class="form-group">
            <label for="field-2" class="control-label"><?php echo get_phrase('Group'); ?><font color="#FF0000">*</font></label>
            <div >
                <select name="students_group_master_id" class="select2" required="" id="students_group_master_id" onChange="change_form_action(this.value)">
                    <option value="0">Select</option>
                </select>
            </div> 
                        </div>
                        </div>
    <?php } 
    if($role==4 || $role==12)
    {?>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="field-2" class="control-label"><?php echo get_phrase('Group'); ?><font color="#FF0000">*</font></label>
                    <div >
                        <select name="students_group_master_id" class="select2" required="" id="students_group_master_id" onChange="change_form_action(this.value)">
                        <option value="">Select</option>
                        <?php 
                        $branch	=	$this->session->userdata('branch_id');
                        $dept	=	$this->session->userdata('dept_id');
                        $this->db->where('branch_id',$branch);
                        $this->db->where('department_id',$dept);
                        $this->db->where('academic_year_id',$running_year);
                        $this->db->where('is_deleted','N'); 
                        $group 	=	$this->db->get('tbl_students_group_master')->result_array();
                        foreach($group as $data){?>
                        <option value="<?php echo $data['students_group_master_id']?>"><?php echo $data['students_group_master_name']?></option>
                        <?php } ?>
                        </select>
                    </div> 
                </div>
            </div>
    <?php } ?>
                       
                <div class="form-group">
                    
                    <label class="switch switch-success"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                    </div>
    
    <div class="compose-message-editor">
                 <textarea class=" form-control" name="message_content" id="message_content" rows="10"  placeholder="Write-Message..." onChange="return get_count(this.value)" required></textarea>
    </div>
    <br>
    <div>
        <button type="submit" class="btn btn-success btn-icon pull-right" >
            Send
            <i class="entypo-mail"></i>
        </button>
    </div>
    <div class="row" id="absent1" style="padding-left:10px;">
    </div>
    <?php echo form_close(); ?>
    
    </div>
</div>                                                            
                                                            
<!------ Info6 End--------------->


<!------ Info7 Start---------------> 
                                                           
<div id="info7" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
<div class="scrollable-horizontal" data-size="800">
	<?php echo form_open(base_url() . 'index.php/admin/new_staff_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
    <div class="row">
    
    <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="sbranch" class="select2" required="" onChange="return sget_dept(this.value)" id="sbranch">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="sdepartment" class="select2" required="" onChange="return get_staff(this.value)" id="sdepartment">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Staff<font color="#FF0000">*</font></label>
                         <div style="padding:10px;" id="staff_div">        

                         </div>	
					</div>
    </div> <?php } 
    if($role==3)
{?>
<div class="col-md-12">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="sdepartment" class="select2" required="" onChange="return get_staff(this.value)" id="sdepartment">
                               <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
                         
                       
						</div> 
					</div>
                   
                      <div class="col-md-6">
                       <div class="form-group">
						<label for="field-2" class="control-label">Staff<font color="#FF0000">*</font></label>
                         <div style="padding:10px;" id="staff_div">        

                         </div>	
					    </div>
                       </div>
                    <?php }?>
                    <?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
                        {?>
           <div class="col-md-6">
                       <div class="form-group">
						<label for="field-2" class="control-label">Staff<font color="#FF0000">*</font></label>
						
                        	 
                                      <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 //$this->db->where('academic_year',$running_year);
									 $staff 	=	$this->db->get('staff')->result_array();
									 ?>
                         <div style="padding:10px;">        
                         	<?php
							if(count($staff)>0)
							{	
							?>   
                            <input type="checkbox" name="check_all" id="check_all" onChange="check_uncheck_all()"><b> Select all </b><br><br>            
                                     <?php
									 foreach($staff as $data){?>
                               
                            <input type="checkbox" name="staff[]" id="staff" value="<?php echo $data['staff_id']; ?>" > <?php echo $data['name']."<br>"; ?>
                            <?php 
									} 
							}
							else
							{
							?>
                            <span>No staff found...</span>
                            <?php
							}
							?>
                         </div>	
                       
			 
		    </div>
            </div>
          <?php } ?>
                   
             <div class="row">
			<div class="form-group">
            </div></div>
           <div class="col-md-12">
          <div class="form-group">
						<label for="field-2" class="control-label">SMS Template</label>
			<div >
							<select name="stemplate" class="select2"  onchange="return sget_template_content(this.value)">
                              <option value="">Select</option>
                              <?php $template = $this->db->get('sms_template')->result_array();
								foreach($template as $row){ 
		                        if($row['title']!= 'admission' && $row['title']!='attendance' && $row['title']!='birthday'){?>
	       <option value="<?php echo $row['id'];?>">
									<?php echo $row['title'];}}?>
                                    </option>
                               </select>
		</div> 
		</div> 
        </div>
        </div>
       <div class="compose-message-editor">
       <textarea class=" form-control" name="smessage" id="smessage" rows="10"  placeholder="Write-Message..." onChange="return get_count(this.value)" required></textarea>
         </div>
    <div id="msgcount" align="right">
                        </div>
                        
                        
    <br>
    <button type="submit" class="btn btn-success btn-icon pull-right" name="submit" id="submit" onClick="return check_staff();">
       Send
        <i class="entypo-mail"></i>
    </button>
    <br>
    
    
<?php echo form_close(); ?>
</div>
</div>
                                                         
<!------ Info7 End---------------> 
<!------ Info8 Start---------------> 
	<div id="info8" class="tab-pane">
		<!--
        <div class="row">
			<div class="col-md-9">
				<div class="col-md-12" style="height:auto;border:1px solid black;">
					<div class="col-md-6">
						<span>Send Message To:</span>
						<div style="padding-left:25px;">
								<input type="radio" name="message_type" id="message_type" class="message_type">&nbsp;All Students.
						</div>
						<div style="padding-left:25px;">
								<input type="radio" name="message_type" id="message_type" class="message_type">&nbsp;Multiple Class.
						</div>
						<div style="padding-left:25px;">
								<input type="radio" name="message_type" id="message_type" class="message_type">&nbsp;Single Class.
						</div>
					</div>
					<div class="col-md-6">
					
					</div>	
				</div>
				<div class="col-md-12" style="height:auto;border:1px solid black;">
					<textarea name="stud_message_content" id="stud_message_content" placeholder="Write Message..." style="width:100%" rows="5"></textarea>
				</div>
			</div>
			<div class="col-md-3" style="height:400px;border:1px solid black;">
			
			</div>
		</div>
        -->
        
        
        
        
        
        
        <?php 	
		echo form_open(base_url() . 'index.php/admin/sms_without_name', array('class' => 'form', 'enctype' => 'multipart/form-data')); 
        $role=$this->session->userdata('role');	
        if($role==1 || $role==2)
        {
		?>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
        			<div >
                        <select name="branch1" class="select2" required="" onChange="return get_dept2(this.value)" id="branch2">
                        	<option value="0">Select</option>
							<?php 
                            $branch=$this->db->get('tbl_branch')->result_array();
                            foreach ($branch as $branch1)
                            {
                            ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                            <?php }?>
                        </select>
			        </div> 
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="form-group">
        			<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
        			<div >
                        <select name="department1" class="select2" required="" onChange="return get_class_dept2(this.value)" id="department2">
                            <option value="0">Select</option>
                        </select>
                    </div> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
                    <div >
                        <select name="class" class="select2" required=""  id="class2">
                            <option value="All">All</option>
                        </select>
                    </div> 
                </div>
            </div>
        	<?php 
		} 
        if($role==3)
        { 
		?> 
            <div class="col-md-6">
                <div class="form-group">
                    <label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
                    <div >
                        <select name="dept_id" class="select2" required="" onChange="return get_class_dept2(this.value)" id="department2">
                            <option value="">Select</option>
                            <option value="all">All</option>
                            <?php 
                            $this->db->where('branch_id',$this->session->userdata('branch_id'));
                            $dept=$this->db->get('tbl_department')->result_array();
                            foreach ($dept as $dept1)
                            {
                            ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                            <?php }?>
                        </select>
                	</div>
                </div> 
            </div>
        
            <div class="col-md-3">
                <div class="form-group">
                    <label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
                    <div >
                        <select name="class" class="select2" required=""  id="class2">
	                        <option value="0">Select Class</option>
                        </select>
			        </div> 
        		</div>
        	</div>
        	<?php 
		} 
        if($role==4 || $role==12)
		{
		?>
        	<div class="col-md-3">
                <div class="form-group">
                    <label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
                    <div >
                        <select name="class" class="select2" required=""  id="class2">
                            <option value="All">All</option>
                            <?php 
                            $branch	=$this->session->userdata('branch_id');
                            $dept	=	$this->session->userdata('dept_id');
                            $this->db->where('branch_id',$branch);
                            $this->db->where('dept_id',$dept);
                            $this->db->where('academic_year',$running_year);
                            $class 	=	$this->db->get('class')->result_array();
                            foreach($class as $data){?>
                            <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                            <?php } ?>
				        </select>
                        <input type="hidden" name="dept_id" value="<?php echo $dept; ?>" >
                    </div> 
                </div>
            </div>
        <?php 
		}
		?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('Message'); ?></span></label>
                <div class="col-md-12">
                    <textarea class="form-control" name="message_send" onChange="return msg_count1(this.value)" id="message_send" required></textarea>
                </div>
                <div >
                    <label class="switch switch-success"><input type="checkbox" checked name="phone2" id="phone2" value="1"><span></span> phone2</label> 
                </div>
            </div>
            <div id="msgcount1" align="right">
            </div>
            <br><br>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success"  onclick="return confirm('Are you sure?');">
					<?php echo get_phrase('Send');?>
                    <i class="entypo-mail"></i>
                </button>
            </div>
        </div>  
        <?php echo form_close(); ?>
        
        
        
        
        
        
        
        
        
        
	</div>
<!------ Info8 End---------------> 







 
                                 	<?php  if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True')
	 {?> 

														<div id="info2" class="tab-pane">
															<div class="scrollable" data-size="100">
																<?php echo form_open(base_url() . 'index.php/admin/new_notification_message/');?>

 <div class="row">
  <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" >Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch1" class="select2" required="" onChange="return get_dept1(this.value)" id="branch1">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" >Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department1" class="select2" required="" onChange="return get_class_dept1(this.value)" id="department1">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" >Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return get_class_sections3(this.value)" id="class1">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div> <?php } 
	if($role==3)
{?> 
 <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" >Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department1" class="select2" required="" onChange="return get_class_dept1(this.value)" id="department1">
                              <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" >Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return get_class_sections3(this.value)" id="class1">
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div>
<?php } 
if($role==4 || $role==12)
{?>

                     <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" >Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="select2" required="" onChange="return get_class_sections3(this.value)" id="class1">
                             <option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									  $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
                         
                       
						</div> 
					</div>
    </div>
<?php } ?>
    <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" >Section<font color="#FF0000">*</font></label>
		                    <div >
                           
		                        <select name="section" class="select2" id="section_selector_holder3" onChange="return get_student_details(this.value,class.value)" required="">
		                            <option value="">Select-Class</option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
 
</div>

    
   
  
    
    </div>
 <td></td>
   
    <button type="submit" class="btn btn-success btn-icon pull-right" onClick="preloader()">
        Send
        <i class="entypo-mail"></i>
    </button>
    <br>
    
</form>
</div>
<?php }?>
															</div>
                                                            <?php echo form_close(); ?>
                                                            
														</div>
                                                        
													</div>
                                                    
                                                  
                                                    
                                                    
                                                    
                                                    
												</div></div></div></div></div>
                                            <?php include_once APPPATH . 'views/footer.php'; ?>
                                            <link rel="stylesheet" href="css/bootstrap-3.1.1.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
                                            
<script type="text/javascript">

	function check_staff()
	{
		var staff	=	document.getElementsByName('staff[]');
		var count	=	0;
		for(var i=0;i<staff.length;i++)
		{
			if(staff[i].checked == true)
			{
				count++;
				
			}
		}
		if(count==0)
		{
			alert("Please select atleast one staff...");
			return false;
		}
		else
		{
			//preloader();
		}
	}
	function check_uncheck_all()
	{
		var staff	=	document.getElementsByName('staff[]');
		for(var i=0;i<staff.length;i++)
		{
			staff[i].checked	=	$('#check_all').prop('checked');
		}
	}

	function get_all_students(){
		jQuery('#list_all_students').html("");
		var classid = $('#class4').val();
		var section = $('#section_selector_holder5').val();
		if(section == ""){
			jQuery('#list_all_students').html("");
			return false;
		}
		else if(section == "all")
		{
			jQuery('#list_all_students').html("");
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_malayalam_message_students/' + classid + '/' + section  ,
				success: function(response)
				{
					jQuery('#list_all_students').html(response);
				}
			});
		}	
	}
    function change_form_action(group_master_id)
    {
        if(group_master_id!='')
        {
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/get_group_for/' + group_master_id ,
                success: function(response)
                {
                    var result = $.trim(response);
                    if(result === "staffs")
                    {
                        $("#grp_msg").attr('action', '<?php echo base_url() . 'index.php/admin/send_message_to_staff_group' ?>');
                    }
                    else
                    {
                        $("#grp_msg").attr('action', '<?php echo base_url() . 'index.php/admin/send_message_to_student_group' ?>');
                    }
                }
            });
        }
    }
    function change_form_action2(response)
    {
        alert(response);
        if(response == "1")
        {
            alert();
            $("#grp_msg").attr('action', '<?php echo base_url() . 'index.php/admin/send_message_to_staff_group' ?>');
        }
    }
	function get_class_sections(class_id) 
	{
	            //  alert('jhgjhh');
		if(class_id=='')
		{
			jQuery('#section_selector_holder').html('');
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
				success: function(response)
				{
					jQuery('#section_selector_holder').html(response);
					$('#section_selector_holder').children('option:first').remove();
					if($('select#section_selector_holder option').length > 0)
					{
						jQuery('#section_selector_holder').prepend('<option value="" selected>Select Section</option><option value="all">All</option>');
					}
				}
			});
		}
    }
</script>

<script type="text/javascript">
function get_class_count(class_id) 
	{
	
	
		  var opts = [],
		  opt;
		  var len = class_id.options.length;
		//var cnt= count(len);
		  var count = 0;
	for (var i = 0; i < len; i++) 
	{
		  opt = class_id.options[i];
		  if (opt.selected) 
		  {
		  opts.push(opt);
		  //alert(opt.value);
		  count++;
          }
	
  }
  //return opts;
 //alert(count);
}
</script>

<script type="text/javascript">
	function get_staff(department) 
	{
		if(department=='')
		{
			jQuery('#staff_div').html('');
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_staff/' + department ,
				success: function(response)
				{
					jQuery('#staff_div').html(response);
					
				}
			});
		}	
    }
</script>
<script type="text/javascript">
	function get_student_details(section_id,class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_student_details/' + class_id +'/' + $section_id,
            success: function(response)
            {
                jQuery('#reciever').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    function sget_template_content(id)
  { 
  
  
 			$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_template_content/' + id ,
            success: function(response)
            {
                jQuery('#smessage').html(response);
				
            }
        });
    }
</script>
<script type="text/javascript">
    function get_template_content(id)
  {
  
 			$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_template_content/' + id ,
            success: function(response)
            {
                jQuery('#message').html(response);
				
            }
        });
    }
    function get_template_content1(id)
  {
  
 			$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_template_content/' + id ,
            success: function(response)
            {
                jQuery('#message2').html(response);
				
            }
        });
    }
</script>
<script type="text/javascript">
    function get_count(message)
  {
 
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_count/' +message,
            success: function(response)
            {
                jQuery('#msgcount').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    function msg_count1(message_send)
  {
 
 
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_count/' +message_send,
            success: function(response)
            {
                jQuery('#msgcount1').html(response);
            }
        });
    }
</script>

<script>
        $(document).ready(function () {
			<?php
			if($this->session->flashdata('action')=='not_enough_balance')
			{
			?>
				alert("You don't have enough balance to send sms");
			<?php
			}
			?>
            $('.textarea_editor').wysihtml5();
        });
    </script>
    
    <script type="text/javascript">
	function get_class_sections1(class_id) 
	{
		jQuery('#absent').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });
    }
</script>
 <script type="text/javascript">
	function get_class_sections7(class_id) 
	{
		jQuery('#absent10').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder7').html(response);
            }
        });
    }
</script>


<script type="text/javascript">	
 function get_details1(){
 
	 jQuery('#absent10').html("");
	 
        var classid = $('#class_selector_holder7').val();
        var section = $('#section_selector_holder7').val();
		var date = $("#timestamp7").val();
		//alert(date);
		console.log(section);
		console.log(date);
		if(section == "0" || date==""){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/get_absent_student_for_message/' + classid + '/' + section + '/' + date ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent10').html(response);
            }
   });
}
</script>
<script>
 
    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
		})

    </script>
    <script type="text/javascript">
	function get_class_sections3(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder3').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
	function get_class_sections4(class_id) 
	{
		jQuery('#absent').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder4').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details3(){
	 jQuery('#absent1').html("");
        var classid = $('#class3').val();
        var section = $('#section_selector_holder4').val();
		//alert("section " +section);
		//alert("class " +classid);
		//var date = $("#timestamp").val();
		//console.log(section);
		//console.log(date);
		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/get_special_message_students/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent1').html(response);
            }
   });
}
</script>
<script type="text/javascript">
	function get_class_sections5(class_id) 
	{
		if(class_id!='')
		{
			if(class_id=='all')
			{
				jQuery('#section_selector_holder5').html('');
				jQuery('#section_selector_holder5').prop('disabled',true);
				jQuery('#list_all_students').html('');
			}
			else
			{
				jQuery('#section_selector_holder5').prop('disabled',false);
				$.ajax({
					url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
					success: function(response)
					{
						jQuery('#section_selector_holder5').html(response);
						$('#section_selector_holder5').children('option:first').remove();
						if($('select#section_selector_holder5 option').length > 0)
						{
							jQuery('#section_selector_holder5').prepend('<option value="" selected>Select Section</option><option value="all">All</option>');
						}
					}
				});
			}
		}
		else
		{
			jQuery('#section_selector_holder5').html('');
		}
    }
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
   <script type="text/javascript">

function select_deselcet_all()
{
var check = document.getElementById('selectall');
var students = document.getElementsByName('student[]');
 for(var i =0; i< students.length;i++)
        students[i].checked=check.checked;

}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
<script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
</script>
<script type="text/javascript">
	function sget_dept(branch_id) 
	{
	
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#sdepartment').html(response);
			//	alert(response);
            }
        });
    }
	

	
</script>


<script type="text/javascript">
	function get_dept(branch_id) 
	{
	
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
			//	alert(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_dept1(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>
    
    <script type="text/javascript">
	function get_class_dept(dept_id) 
	{
	//alert("sss");
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
			console.log(response);
                jQuery('#class').html(response);
				
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_dept1(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department1').html(response);
            }
        });
    }
	

	
</script>
    
    <script type="text/javascript">
	function get_class_dept1(dept_id) 
	{
	//alert("sss");
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class1').html(response);
            }
        });
    }
	

	
</script>


<script type="text/javascript">
	function get_dept2(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department2').html(response);
            }
        });
    }
	

	
</script>
    
    <script type="text/javascript">
	function get_class_dept2(dept_id) 
	{
	//alert("sss");
	//alert(dept_id);
		
		if(dept_id!='')
		{
			if(dept_id=='all')
			{
				jQuery('#class2').prop('disabled',true);
			}
			else
			{
				jQuery('#class2').prop('disabled',false);
				jQuery('#class2').html('');
				$.ajax({
					url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
					success: function(response)
					{
						jQuery('#class2').html(response);
						$('#class2').children('option:first').remove();
						if($('select#class2 option').length > 0)
						{
							jQuery('#class2').prepend('<option value="" selected>Select Class</option><option value="all">All</option>');
						}
					}
				});
			}
		}
		else
		{
			jQuery('#class2').html('');
		}	
    }
	

	
</script>  
<script type="text/javascript">
	function get_dept3(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department3').html(response);
            }
        });
    }
	
	function get_dept5(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department5').html(response);
            }
        });
    }
	
	function get_student_group(dept_id)
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_student_group_by_dept/' + dept_id ,
            success: function(response)
            {
                jQuery('#students_group_master_id').html(response);
            }
        });
	}
	
</script>
    
    <script type="text/javascript">
	function get_class_dept3(dept_id) 
	{
	//alert("sss");
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class3').html(response);
            }
        });
    }
	

	
</script> 
<script type="text/javascript">
	function get_dept4(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department4').html(response);
            }
        });
    }
	

	
</script>
    
    <script type="text/javascript">
	function get_class_dept4(dept_id) 
	{
	//alert("sss");
	//alert(dept_id);
		if(dept_id=='')
		{
			jQuery('#class4').html('');
			jQuery('#section_selector_holder5').html('');
		}
		else if(dept_id=='all')
		{
			jQuery('#class4').prop('disabled',true);
			jQuery('#section_selector_holder5').prop('disabled',true);
		}
		else
		{
			jQuery('#class4').prop('disabled',false);
			jQuery('#section_selector_holder5').prop('disabled',false);
			
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
				success: function(response)
				{
					jQuery('#class4').html(response);
					$('#class4').children('option:first').remove();
					if($('select#class4 option').length > 0)
					{
						jQuery('#class4').prepend('<option value="" selected>Select Class</option><option value="all">All</option>');
					}
				}
			});
		}	
    }
</script> 
<script>
$(function() {

$('#class').multiselect({

includeSelectAllOption: true

});


});
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   
 
 <script>
     
     function push_notification()
     {
          var checkBox = document.getElementById("notification");
          
          if(checkBox.checked == true)
          {
              checkBox.value=1;
          }
          else
          {
             checkBox.value=0; 
          }
     }
         
 </script>
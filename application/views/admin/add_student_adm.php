<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year=get_running_year();?>
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
							<li class="active">Admission</li>
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
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admission Form
								
							</h1>
						</div><!-- /.page-header -->
                     
                     <?php echo form_open_multipart('Admin/add_student', array('class' => 'form-horizontal','id'=>"myform"));?>
                     
                                    
                                    <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   { 
					   if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2"  id="branch" onChange="return get_dept(this.value)" required="">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="department" class="select2"  id="department" onChange="return get_class(this.value)" required="">
												  <option value="">Select</option>
											 </select>
										</div>
									</div>
                                    <?php } }?>
                                     <?php if($this->session->userdata('role')==3){?>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="department" class="select2"  id="department" onChange="return get_class(this.value)" required=""/>
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
                                    <?php }?>
									<!-- /section:elements.form -->
									<div class="space-4"></div>
							 <?php if($this->session->userdata('role')<4){?>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class_id" class="select2" required="" onChange="get_class_sections(this.value);get_admn_number_by_class_category(this.value);">
                                     <option value="">Select</option>
                          </select>
                          &nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#add_class_modal" style="font-size:12px"><i class="fa fa-plus"></i> New Class</a>
											
										</div>
									</div>
<?php } ?>
									<div class="space-4"></div>
                                    
                                   <?php if($this->session->userdata('role')>=4)
											{                                    
                               ?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class_id" class="select2"  onChange="get_class_sections(this.value);get_admn_number_by_class_category(this.value);" required  />
                                     <option value=" ">Select</option>
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
                          <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" >
                          <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id'); ?>" >
                          &nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#add_class_modal" style="font-size:12px"><i class="fa fa-plus" ></i> New Class</a>
                                       	
										</div>
									</div>
  <?php } ?>	
	
  <!----------------------class Modal begins ------------------------->

  <div class="modal fade" id="add_class_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Class</h4>
        </div>
        <div class="modal-body">
          
          
		<?php if($this->session->userdata('role')==1  || $this->session->userdata('role')==2) { ?>
        
        <div class="form-group">
        <div class="col-sm-4">Branch:</div>
        <div class="col-sm-8">
          <select name="branch1" class="col-xs-10 col-sm-6 form-control"  id="branch1" onChange="get_dept1(this.value);" >
          <option value="">Select</option>
          <?php $branch=$this->db->get('tbl_branch')->result_array();
          foreach ($branch as $branch1)
          {
          ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
          <?php }?>
          </select>
		  </div>
          </div>
          
        <div class="form-group">
         <div class="col-sm-4"> Department:</div>
         <div class="col-sm-8">
            <select name="department1" class="col-xs-10 col-sm-6 form-control"  id="department1"  >
            <option value="">Select</option>
            </select>
          </div>
          </div>
          
          <?php }
		  if($this->session->userdata('role')==3) { ?>
          
        <div class="form-group">
          <div class="col-sm-4">Department:</div>
          <div class="col-sm-8">
            <select name="department1" class="col-xs-10 col-sm-6 form-control"  id="department1" />
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
            <input type="hidden" name="branch1" id="<?php echo $this->session->userdata('branch_id'); ?>"  >

            <?php }
			  if($this->session->userdata('role')>=4) { 
			 ?>
            <input type="hidden" name="branch1" id="branch1" value="<?php echo $this->session->userdata('branch_id'); ?>" >
            <input type="hidden" name="department1" id="department1" value="<?php echo $this->session->userdata('dept_id'); ?>" >
        	<?php } ?>

        <div class="form-group">
          <div class="col-sm-4">Class:</div>
          <div class="col-sm-8">
			<input id="new_class" name="new_class" placeholder="Class Name" type="text" class="form-control form-control" onBlur="check_class_exist(this.value)">
	    <label id="errMsg" style="display:none;color:red;font-size:12px">Class Name already exist.</label>
        </div>
        </div>
         
         <div style="padding-top:5px;padding-left:36%"><button type="button" class="btn btn-info" id="btn_insert" onClick="insert_new_class();" >Insert</button></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- --------------------class modal ends--------------------------------- -->                          



    								<div class="space-4"></div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: <font color="#FF0000">* </font></label>

										 <div class="col-sm-9">
		                        <select name="section_id"  class="select2"    id="section_selector_holder" required />
		                            <option value="">Select</option>
			                    </select>
                          &nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#add_section_modal" style="font-size:12px"><i class="fa fa-plus"></i> New Section</a>
			                </div>
									</div>

<!----------------------section Modal begins ------------------------->

  <div class="modal fade" id="add_section_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Section</h4>
        </div>
        <div class="modal-body">
          <p>
          
		<?php if($this->session->userdata('role')==1  || $this->session->userdata('role')==2) { ?>
        <div class="form-group">
        <div class="col-sm-4">Branch:</div>
        <div class="col-sm-8">
          <select name="branch2" class="col-xs-10 col-sm-6 form-control"  id="branch2" onChange="get_dept2(this.value);" >
          <option value="">Select</option>
          <?php $branch=$this->db->get('tbl_branch')->result_array();
          foreach ($branch as $branch1)
          {
          ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
          <?php }?>
          </select>
         </div>
		</div>
        
        <div class="form-group">
         <div class="col-sm-4"> Department:</div>
         <div class="col-sm-8">
            <select name="department2" class="col-xs-10 col-sm-6 form-control"  id="department2" onChange="return get_class2(this.value)"  >
            <option value="">Select</option>
            </select>
          </div>
          </div>

        <div class="form-group">
         <div class="col-sm-4"> Class:</div>
         <div class="col-sm-8">
            <select name="class2" class="col-xs-10 col-sm-6 form-control"  id="class2"  >
            <option value="">Select</option>
            </select>
          </div>
          </div>
          
          <?php }
		  if($this->session->userdata('role')==3) { ?>

        <div class="form-group">
          <div class="col-sm-4">Department:</div>
          <div class="col-sm-8">
            <input type="hidden" name="branch2" id="<?php echo $this->session->userdata('branch_id'); ?>"  >
            <select name="department2" class="col-xs-10 col-sm-6 form-control"  id="department2" onChange="return get_class2(this.value)" />
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
         
        <div class="form-group">
         <div class="col-sm-4"> Class:</div>
         <div class="col-sm-8">
            <select name="class2" class="col-xs-10 col-sm-6 form-control"  id="class2"  >
            <option value="">Select</option>
            </select>
          </div>
          </div>

            <?php }
			  if($this->session->userdata('role')>=4) { 
			 ?>
            <input type="hidden" name="branch2" id="branch2" value="<?php echo $this->session->userdata('branch_id'); ?>" >
            <input type="hidden" name="department2" id="department2" value="<?php echo $this->session->userdata('dept_id'); ?>" >
          
        <div class="form-group">
          <div class="col-sm-4"> Class:</div>
         <div class="col-sm-8">
            <select name="class2" class="col-xs-10 col-sm-6 form-control"  id="class2"  >
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

        	<?php } ?>

        <div class="form-group">
          <div class="col-sm-4">Section:</div>
          <div class="col-sm-8">
			<input id="new_section" name="new_section" placeholder="Section Name" type="text" class="form-control" onBlur="check_section_exist(this.value);">
             <label id="errorMsg" style="display:none;color:red;font-size:12px">Section Name already exist.</label>
         </div>
         </div>
         
         <div style="padding-left:36%"><button type="button" class="btn btn-info" id="btnSubmit" onClick="insert_new_section();" >Insert</button>
        </div>
        </p>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  <!-- --------------------section modal ends--------------------------------- -->                          

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" required=""/>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Admission no: </label>
										<!--onKeyPress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" -->
										<div class="col-sm-9">
											<input type="text" id="admission_no" placeholder="Admission number" class="col-xs-10 col-sm-5" name="admission_no" onChange="admission_no_chk(this.value)" value="" />
									        
										</div>
										<div class="col-sm-offset-3 col-sm-9" id="check_admission_number"></div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Roll Number: </label>

										<div class="col-sm-9">
											<input type="text" id="roll-number" name="roll_number" placeholder="Roll Number" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                    
                                    <?php 
					   if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
					   {?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> School Name: </label>

										<div class="col-sm-9">
											<input type="text" id="school" name="school" placeholder="School Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    <?php } ?>

										<?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
												{
												?>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fee Structure:</label>

										 <div class="col-sm-9">
		                       	 <select name="fee_master" class="select2" id="fee_master">
		                         
			                    </select>
                                    </div>
                                    </div>
                                    <?php }?>
					   			<?php
								$transportation=$this->db->get_where('settings' , array('type' => 'transportation'))->row()->description;
								if($transportation=='yes')
								{
								if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){ ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bus Route: </label>

										<div class="col-sm-9">
										  <select name="route_master_id" id="bus_route"  class="select2" onChange="get_bus(this);get_pick_up(this);"  >
                                            <option value="">Select</option>
                                          </select>
										</div>
					  </div>
                                    <?php } ?>

					   			<?php
									if($this->session->userdata('role')!=1  && $this->session->userdata('role')!=2){ ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bus Route: </label>

										<div class="col-sm-9">
                                        <select name="route_master_id" id="route_master_id"  class="select2" onChange="get_bus(this);get_pick_up(this);"  >
                                            <option value="">Select</option>
                                            <?php 
											$this->db->where('branch_id',$this->session->userdata('branch_id'));
											$route_master = $this->db->get('view_transport_route_master')->result_array();
                                            foreach($route_master as $route):
                                            ?>
                                            <option value="<?php echo $route['route_master_id'];?>"><?php echo $route['route_master_name'];?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
										</div>
									</div>
                                    <?php }
									 ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bus Number: </label>

										<div class="col-sm-9">
                                            <select name="route_register_id" id="route_register_id" onChange="check_checkbox();get_bus_seats(this);" class="select2"  >
                                                                        
                                             </select>
                                            <div id="msg_bus" style="color:#FF0000"></div>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pick-up Point: </label>

										<div class="col-sm-9">
                                            <select name="pickup_point" id="pickup_point"  class="select2" onChange="get_base_fare(this);"  >
                                              
                                            </select>
										</div>
									</div>
                                <input type="hidden" name="base_fare" id="base_fare"  class="col-xs-10 col-sm-5"  />
									<?php
									}
									?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">
                                         <?php
										 if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
										 {
										 	echo "Father Name";
										 }
										 else
										 {
										 	echo "Parent Name";
										 }
										 ?>
                                         </label>

										<div class="col-sm-9">
											<input type="text" id="parent" name="parent" placeholder="Parent Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									 <?php
                                     if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
                                     {
                                     ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Mother Name</label>

										<div class="col-sm-9">
											<input type="text" id="mother" name="mother_name" placeholder="Mother Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Parent Id</label>

										<div class="col-sm-9">
											<input type="text" id="parent_id" name="parent_id" placeholder="Parent Id" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<?php
									 }
									?>
								  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone Number 1: <font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="phone1" name="phone1" placeholder="Phone number" class="col-xs-10 col-sm-5" onChange="return check_phone_number(this.value)" required="" value="<?php echo $q->phone1;?>"/>
											
										</div>
									</div>
                                    <div id="check_phone_number" align="left"></div> 
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Phone Number 2: &nbsp;&nbsp; </label>

										<div class="col-sm-9">
											<input type="text" id="phone2" name="phone2" placeholder="Phone number" class="col-xs-10 col-sm-5" value="<?php echo $q->phone2;?>"/>
											
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Phone Number 3: &nbsp;&nbsp; </label>

										<div class="col-sm-9">
											<input type="text" id="phone3" name="phone3" placeholder="Phone number" class="col-xs-10 col-sm-5" value="<?php echo $q->phone3;?>"/>
											
										</div>
									</div>
									 <?php
                                     if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
                                     {
                                     ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> WhatsApp Number: </label>

										<div class="col-sm-9">
											<input type="text" id="whatsapp_number" name="whatsapp_number" placeholder="WhatsApp Number" class="col-xs-10 col-sm-5" />											
										</div>
									</div>
									<?php
									 }
									?>
                                    <div class="space-4"></div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>
                                         <?php 
										 $w=$q->date_of_birth;
										/* $p=DateTime::createFromFormat('d/m/Y',$w);*/
										
											//$r=$p->format('Y/m/d');?>
										<div class="col-sm-4">
			 								<div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
											<div class="input-group input-group-sm">
													<input type="text"  id="mydatepicker"  class="form-control mydatepicker"  name="birthday" value="<?php echo $w;?>"/>
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
												</div>

											<div class="space-2"></div>

											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>

										<div class="col-sm-9">
											<select class="select2" id="sex" name="sex" data-placeholder="Select">
                                               <option value="<?php echo $q->sex;?>"><?php echo $q->sex;?></option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>

								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>

										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-5" id="address" name="address" placeholder="Address"><?php echo $q->address;?></textarea>
											
										</div>
									</div>
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Aadhaar Number: </label>

										<div class="col-sm-9">
											<input type="text" id="aadhaar_number" name="aadhaar_number" placeholder="Aadhaar Number" class="col-xs-10 col-sm-5" value="<?php echo $q->aadhaar_number;?>"/>
											
										</div>
									</div>

                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email ID: </label>

										<div class="col-sm-9">
											<input type="text" id="email" name="email" placeholder="Email ID" class="col-xs-10 col-sm-5" value="<?php echo $q->email;?>"/>
											
										</div>
									</div>
 											<input type="hidden" id="id" name="id" placeholder="Email ID" class="col-xs-10 col-sm-5" value="<?php echo $q->enquiry_id;?>"/>

                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Certificate submitted: </label>

										<div class="col-sm-9">
										<?php if(count($certificate)=='0'){
										echo "No Certificates Added<br>"; } else { ?>
										<?php foreach($certificate as $cert){ ?>
											<input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $cert['certificate_id'] ?>">
											<span class="lbl"> <?php echo $cert['certificate_name'] ?></span>
                                            &nbsp;
											<?php } } ?>											
										</div>
									</div>

                                    <div class="form-group">
										<label for="field-1" class="col-sm-3 control-label">Photo</label>
                        
									<div class="col-sm-5">
											
									<!-- our form -->
										<input  type="file" name="userfile" width="100px" height="120px"/>
										
										<div class="hr hr-12 dotted"></div>
											 <div>
												 <font color="#FF0000">Note: Photo Must Be In 150x150 Size</font></div>
											</div>                           
										</div>                           
                                                   
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> </label>

										<div class="col-sm-9">
                                        <div class="space-4"></div>
											<input type="checkbox" name="notification" id="notification" value="1">
											<span class="lbl"> Send notification</span>
                                            &nbsp;
											<input type="checkbox" name="additional_msg" id="additional_msg"  value="1"/>
											<span class="lbl"> Send Additional Message</span>
                                             <?php 
								 //$this->load->Model('crud_model');
								  //$query=$this->crud_model->additional_message_content();
								$this->db->select('content,title');
		$this->db->from('sms_template');
		 $this->db->where('title','admission');
	 	  $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
								
								?>
                                 <?php  
								 // $this->load->Model('crud_model');
								  //$result=$this->crud_model->additional_message_content1();
								  $this->db->select('content');
   		 $this->db->from('sms_template');
		 $this->db->where('title','admission');
$result=$this->db->get()->result_array();
								  foreach($result as $r){?>
			                  <input type="text" name="message" id="message" class="form-control" value="<?php echo $r['content'];}?>" style="display: none"/><?php }
							  else
							  {?>
                              <input type="text" name="message" id="message" class="form-control" value=""  style="display: none"/>
							 <?php } ?>
										</div>
									</div>
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" id="btnSubmit" value='Submit'> 
				<button type="reset" class="btn">Reset</button>
										</div>
                                        
									</div>
                                    </div>
                                   
              </body>  
                         
				  <?php echo form_close(); ?>
                                   
			<?php include_once APPPATH . 'views/footer.php'; ?>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

if ($action=="failed")
{
echo "<script>toastr.error('". "Invalid...', 'Failed', {timeOut: 5000})</script>";
}
?>
            
          <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
		
		
		<!--<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>-->
		
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.js"></script>
				
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>



<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">


function get_bus(route_master_id) 
	{
	var id= route_master_id.name.substr(15);
	$("#msg_bus"+id).html("");
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#route_register_id'+id).html(response);
            }
     });
   }
	
function get_bus_seats(route_register_id) 
	{
		var id= route_register_id.name.substr(17);
		$("#msg_bus").show();
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_seats/' + route_register_id.value ,
            success: function(response)
            {
            	jQuery('#msg_bus').html(response);
            }
        });
    }
	
function get_base_fare(pickup_point) 
	{
		var id= pickup_point.name.substr(12);
		//alert(route_master_id.value);
		if(pickup_point.value>0)
		{
		    document.getElementById("base_fare"+id).value = "";
    		$.ajax({
                url: '<?php echo base_url();?>index.php/Transport_management/get_base_fare/' + pickup_point.value ,
                success: function(response)
                {
    			//alert(response);
    				document.getElementById("base_fare"+id).value = response;
                    //jQuery('#base_fare'+id).val(response) ;
                }
            });
		}
		else
		{
		    document.getElementById("base_fare"+id).value = "";
		}
    }
	function get_bus_route(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_bus_route/' + branch_id ,
            success: function(response)
            {
                jQuery('#bus_route').html(response);
            }
        });
    }
	
function get_pick_up(route_master_id) 
	{
		var id= route_master_id.name.substr(15);
		//alert(route_master_id.value);
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pick_up/' + route_master_id.value ,
            success: function(response)
            {
			
                jQuery('#pickup_point'+id).html(response);
            }
        });
    }

	function get_class_sections(class_id) 
	{
	//alert(class_id);
	get_fee_master(class_id) ;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
	
function get_fee_master(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/get_class_fee_master/' + class_id ,
            success: function(response)
            {
                jQuery('#fee_master').html(response);
            }
        });
    }	
</script>


<script type="text/javascript">
			jQuery(function($) {
				var $form = $('#myform');
				//you can have multiple files, or a file input with "multiple" attribute
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;

				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Select or drop files here',
					btn_change: null,
					droppable: true,
					thumbnail: 'large',
					
					maxSize: 110000,//bytes
					allowExt: ["jpeg", "jpg", "png", "gif"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],

					before_remove: function() {
						if(upload_in_progress)
							return false;//if we are in the middle of uploading a file, don't allow resetting file input
						return true;
					},

					preview_error: function(filename , code) {
						//code = 1 means file load error
						//code = 2 image load error (possibly file is not an image)
						//code = 3 preview failed
					}
				})
				file_input.on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
					if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
					
				});
				
				
				var ie_timeout = null;//a time for old browsers uploading via iframe
				
				$form.on('submit', function(e) {
					e.preventDefault();
				
					var files = file_input.data('ace_input_files');
					if( !files || files.length == 0 ) return false;//no files selected
										
					var deferred ;
					if( "FormData" in window ) {
						formData_object = new FormData();//create empty FormData object
						
						//serialize our form (which excludes file inputs)
						$.each($form.serializeArray(), function(i, item) {
							//add them one by one to our FormData 
							formData_object.append(item.name, item.value);							
						});
						//and then add files
						$form.find('input[type=file]').each(function(){
							var field_name = $(this).attr('name');
							//for fields with "multiple" file support, field name should be something like `myfile[]`

							var files = $(this).data('ace_input_files');
							if(files && files.length > 0) {
								for(var f = 0; f < files.length; f++) {
									formData_object.append(field_name, files[f]);
								}
							}
						});
	

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);
						
						deferred = $.ajax({
							        url: $form.attr('action'),
							       type: $form.attr('method'),
							processData: false,//important
							contentType: false,//important
							   dataType: 'json',
							       data: formData_object
						})

					}
					else {
						//for older browsers that don't support FormData and uploading files via ajax
						//we use an iframe to upload the form(file) without leaving the page

						deferred = new $.Deferred //create a custom deferred object
						
						var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
						var temp_iframe = 
								$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
								frameborder="0" width="0" height="0" src="about:blank"\
								style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
								.insertAfter($form)

						$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');
						
						temp_iframe.data('deferrer' , deferred);
						//we save the deferred object to the iframe and in our server side response
						//we use "temporary-iframe-id" to access iframe and its deferred object
						
						$form.attr({
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
									});

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);//display an overlay with loading icon
						$form.get(0).submit();
						
						
						//if we don't receive a response after 30 seconds, let's declare it as failed!
						ie_timeout = setTimeout(function(){
							ie_timeout = null;
							temp_iframe.attr('src', 'about:blank').remove();
							deferred.reject({'status':'fail', 'message':'Timeout!'});
						} , 30000);
					}


					////////////////////////////
					//deferred callbacks, triggered by both ajax and iframe solution
					deferred
					.done(function(result) {//success
						//format of `result` is optional and sent by server
						//in this example, it's an array of multiple results for multiple uploaded files
						var message = '';
						for(var i = 0; i < result.length; i++) {
							if(result[i].status == 'OK') {
								message += "File successfully saved. Thumbnail is: " + result[i].url
							}
							else {
								message += "File not saved. " + result.message;
							}
							message += "\n";
						}

						alert(message);
					})
					.fail(function(result) {//failure
						alert("There was an error");
					})
					.always(function() {//called on both success and failure
						if(ie_timeout) clearTimeout(ie_timeout)
						ie_timeout = null;
						upload_in_progress = false;
						file_input.ace_file_input('loading', false);
					});

					deferred.promise();
				});


				//when "reset" button of form is hit, file field will be reset, but the custom UI won't
				//so you should reset the ui on your own
				$form.on('reset', function() {
					$(this).find('input[type=file]').ace_file_input('reset_input_ui');
				});


				if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

			});
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
	function get_dept(branch_id) 
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
	function get_dept1(branch_id) 
	{
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department1').html(response);
				$('#branchMsg').hide();
            }
        });
    }

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
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
    }
	
	function get_class2(dept_id) 
	{
	//alert(dept_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class2').html(response);
            }
        });
    }
	
	function get_admn_number_by_class_category(class_id){
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_admn_number_by_class_category/' + class_id ,
            success: function(response)
            {
                $('#admission_no').val(response);
            }
        });
	}

</script>

<script type="text/javascript">
  function check_phone_number(phone1)
  {
 
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/check_phone_number/' +phone1,
            success: function(response)
            {
                jQuery('#check_phone_number').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
  function admission_no_chk(admission_no)
  {
  
        if(admission_no!='')
        {
        	$.ajax({
                url: '<?php echo base_url();?>index.php/Admin/check_admission_no/' +admission_no,
                success: function(response)
                {
                    if(response=="0")
                    {
                        jQuery('#check_admission_number').html("<span style='color:green'>&#10004;</span>");
                        $('#btnSubmit').prop('disabled',false);
                    }
                    else if(response=="1")
                    {
                        jQuery('#check_admission_number').html("<span style='color:red'>Admission Number already exist.</span>");
                        $('#btnSubmit').prop('disabled',true);
                    }
                    
                }
            });
        }
        else
        {
            jQuery('#check_admission_number').html("");
            $('#btnSubmit').prop('disabled',false);
        }
    }
</script>

 <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','335px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   

 <script>
function insert_new_class()
{
		
		var branch_id = $('#branch1').val();
		var dept_id = $('#department1').val();
		var class_name = $('#new_class').val();
		$(".error").remove();
		if(branch_id=="")
		{
       $('#branch1').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(dept_id==""){
       $('#department1').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(class_name==""){
       $('#new_class').after('<span id="class_name1" class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else{
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/insert_new_class/' + class_name +'/'+ dept_id +'/'+ branch_id,
            success: function(response)
            {
				if(response == "1")
				{
					$("#add_class_modal .close").click();
					reload_class();
				}
				else if(response == "0")
				{
					alert("Class Not Added.");
					$("#add_class_modal .close").click()
				}
            }
        });
	}
}
function reload_class()
{
	//var branch_id	=	$("#branch").val();
	var dept_id		=	$("#department").val();
	if(dept_id!='')
	{
		get_class(dept_id);
		get_class2(dept_id);
	}
}
 </script>

 <script>
function insert_new_section()
{
		
		var branch_id = $('#branch2').val();
		var dept_id = $('#department2').val();
		var class_id = $('#class2').val();
		var section_name = $('#new_section').val();
		$(".error").remove();
		if(branch_id=="")
		{
       $('#branch2').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(dept_id==""){
       $('#department2').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(class_id==""){
       $('#class2').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(section_name==""){
       $('#new_section').after('<span id="section_name1" class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else{
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/insert_new_section/' + section_name +'/'+ class_id +'/'+ dept_id +'/'+ branch_id,
            success: function(response)
            {
				if(response == "1")
				{
					$("#add_section_modal .close").click();
					reload_section();
				}
				else if(response == "0")
				{
					alert("Section Not Added.");
					$("#add_section_modal .close").click()
				}
            }
        });
	}
}
function reload_section()
{
	//var branch_id	=	$("#branch").val();
	var class_id		=	$("#class_id").val();
	if(class_id!='')
	{
		get_class_sections(class_id);
	}
}
 </script>
 
 <script>
    function check_class_exist(class_name)
    {
        if(class_name!='')
        {
			$('#class_name1').hide();
            var branch_id       =   $('#branch1').val();
            var dept_id         =   $('#department1').val();
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/check_class_exist/' + class_name +'/'+dept_id +'/'+branch_id,
                success: function(response)
                {
                    if(response==1)
                    {
                        $('#errMsg').show();
                        $('#btn_insert').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#errMsg').hide();
                        $('#btn_insert').prop('disabled',false);
                    }
                    //jQuery('#section_selector_holder').html(response);
                }
            });
        }
        else
        {
            $('#errMsg').hide();
            $('#btn_insert').prop('disabled',false);
        }
    }
	
    function check_section_exist(section_name)
    {
        if(section_name!='')
        {
			$('#section_name1').hide();
            var class_id    =   $('#class2').val();
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/check_section_exist/' + section_name +'/'+class_id,
                success: function(response)
                {
                    if(response==1)
                    {
                        $('#errorMsg').show();
                        $('#btnSubmit').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#errorMsg').hide();
                        $('#btnSubmit').prop('disabled',false);
                    }
                    //jQuery('#section_selector_holder').html(response);
                }
            });
        }
        else
        {
            $('#errorMsg').hide();
            $('#btnSubmit').prop('disabled',false);
        }
    }
	
</script>

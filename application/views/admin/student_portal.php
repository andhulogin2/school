<?php 
$role=$this->session->userdata('role');
  include_once APPPATH . 'views/main_head.php';  
?>
<?php $running_year = get_running_year();?>
<?php //include_once APPPATH . 'views/top_bar.php';?>

<div class="main-content">
  <div class="main-content-inner">
    <!-- #section:basics/content.breadcrumbs -->
    <div class="breadcrumbs" id="breadcrumbs">
      <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
      <ul class="breadcrumb">
        <li> <i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a> </li>
        <li class="active">Student Portal</li>
      </ul>
      <!-- /.breadcrumb -->
      <!-- #section:basics/content.searchbox -->
      <div class="nav-search" id="nav-search">
        <form>
          <span class="input-icon"> </span>
        </form>
      </div>
      <!-- /.nav-search -->
      <!-- /section:basics/content.searchbox -->
    </div>
    <!-- /section:basics/content.breadcrumbs -->
    <div class="page-header">
      <h1> Student Profile <i class="ace-icon fa fa-angle-double-right"></i>
        <?php 
              $student_name=$this->db->get_where('student',array('student_id'=>$student_id))->row()->name;
              echo $student_name;?>
      </h1>
      <div class="col-md-offset-7">
        <div class="col-md-2"> </div>
        <div style="float:right;margin-right:30px;padding-top:30px">
          <?php $running_year = get_running_year(); ?>
          <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row()->class_id;?>
          <a href="<?php echo base_url();?>index.php/admin/students_area/<?php echo $cls;?>" data-dismiss="fileinput">
          <button class="btn-info">Back</button>
          </a>
          <?php if($this->db->get_where("settings",array('type'=>'tc'))->row()->description=="yes"){ ?>
          <a href="<?php echo base_url();?>index.php/admin/issue_tc/<?php echo $student_id; ?>/<?php echo $cls;?>">
          <button class="btn-info">ISSUE TC</button>
          </a>
          <?php } ?>
          <a href="<?php echo base_url();?>index.php/report/student_print_report/<?php echo $student_id;?>" data-dismiss="fileinput">
          <button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Download</button>
          </a>
          <input type="hidden" name="year" value="<?php echo $running_year; ?>">
        </div>
      </div>
    </div>
    <!-- /.page-header -->
    <div class="row">
      <div class="col-xs-12">
        <?php
          $student_id= $student_id; 
          $year		=	get_running_year();
          $class_id     = $this->db->get_where('enroll' , array(
          'student_id' => $student_id,'year'=>$year))->row()->class_id;
          // echo $class_id;
          $monthly_attendance = array();
          $student_portal_model=$this->crud_model->student_portal_data($student_id);
        ?>
        <div class="col-sm-12 col-xs-12">
          <!-- #section:elements.tab.option -->
          <div class="tabbable">
            <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
              <li class="active"> <a data-toggle="tab" href="#home4">PROFILE</a> </li>
              <li> <a data-toggle="tab" href="#dropdown14">MARK REPORT</a> </li>
              <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
												{
												?>
              <li> <a data-toggle="tab" href="#dropdown15">ATTENDANCE REPORT</a> </li>
              <?php } ?>
              <?php if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes')
												{
												?>
              <li> <a data-toggle="tab" href="#dropdown16"> ATTENDANCE REPORT</a> </li>
              <?php } ?>
              <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
												{
												?>
              <!-- <li> <a data-toggle="tab" href="#profile4">FEE DETAILS</a> </li> -->
              <li><a href="<?=base_url();?>index.php/Admin/student_portal_fee/<?=$student_id?>/<?=$class_id?>">FEE DETAILS</a></li>
              <?php }?>
              <?php
                if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
                { ?>
                <li> <a data-toggle="tab" href="#profile5">SPECIAL FEE DETAILS</a> </li>
              <?php } ?>
            </ul>
            <div class="tab-content row col-md-12 col-xs-12" style="padding-top:0px;">
              <div id="home4" class="tab-pane in active">
                <div  class=" row col-md-4 col-xs-4">
                  <div  class="white-box">
                    <table>
                      <?php
                        $student_info = $this->db->get_where('enroll', array('student_id' => $student_id,'year'=> $running_year))->result_array();
                        foreach ($student_info as $row){
                        //echo $row['student_id'];
                      ?>
                      <div class="profile-user-info profile-user-info-striped">
                        <center>
                          <?php if (file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                          <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-responsive"/>
                          <?php endif; ?>
                          <?php if (!file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                          <img src="<?php echo base_url('uploads/user.jpg'); ?>" class="img-rounded img-responsive" style="height: 150px;width: 150px;"/>
                          <?php endif; ?>
                        </center>
                        <div class="white-box" >
                          <center> 
                            <h4>
                              <?php foreach($student_portal_model as $student_view) {
					                    echo $student_view['name'];
                              ?>
                            </h4>
                          </center>
                          
                          <center>
                            <div class="profile-info-name">
                              <center>
                                Registered
                              </center>
                            </div>
                            <div class="profile-info-value" > <span class="editable" id="username" >
                              <?php echo (date('m/d/Y', $student_view['date'])); ?>
                              </span> </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Admission Number
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php echo $student_view['admission_number']; ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Phone1
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php echo $student_view['phone1'];  ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Phone2
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="country">
                                <?php  echo $student_view['phone2'];  ?>
                                </span> </div>
                            </div>
                            <?php
											if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
											{
											?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  WhatsApp Number
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="country"> <?php echo $student_view['whatsapp_number'];?> </span> </div>
                            </div>
                            <?php
											}
											?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Sex
                                </center>
                              </div>
                              <div class="profile-info-value" > <span class="editable" id="username" >
                                <?php
                        echo $student_view['sex'];
                        ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Email
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username"><?php echo $student_view['email']; ?></span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Class
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username"><?php echo $this->crud_model->get_class_name($row['class_id']); ?></span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Section
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php $sec = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; $sec_id =$row['section_id']; echo $sec?>
                                </span> </div>
                            </div>
                            <?php if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
                            {?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  School Name
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
                       echo $student_view['school'];
                        ?>
                                </span> </div>
                            </div>
                            <?php  }?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  <?php
														if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
														{
															echo "Father";
														}
														else
														{
															echo "Parent";
														}
														?>
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
															echo $student_view['parent'];
															?>
                                </span> </div>
                            </div>
                            <?php
												if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
												{
												?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Mother
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
															echo $student_view['mother_name'];
                                                        ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Parent ID
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
															echo $student_view['parent_id'];
                                                        ?>
                                </span> </div>
                            </div>
                            <?php
												}
												?>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Birthday
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
														$birthday =  str_replace('/','-',$student_view['birthday']);
                       echo date('d-m-Y',strtotime($birthday));
                        ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Address
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <?php
                        echo $student_view['address'];
                        ?>
                                </span> </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name">
                                <center>
                                  Active
                                </center>
                              </div>
                              <div class="profile-info-value"> <span class="editable" id="username">
                                <input type="checkbox" value="true" <?php if($this->db->get_where('student' , array('student_id' =>$student_id))->row()->student_status_id != '2') echo 'checked';?> name="active" id="active1" class="ace ace-switch ace-switch-2" data-color="#13dafe" />
                                <span class="lbl"></span>
                                <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id;?>" />
                                <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>" />
                                <!--   <a href="<?php echo base_url();?>index.php/admin/inactive_student/<?php echo $student_id;?>/<?php echo $class_id;?>"  onClick="return confirm('Are-you-sure');">Update
                    </a>-->
                                </span> </div>
                            </div>
                            <!-- Completed and Discontinued buttons -->
                            <?php
											if($this->db->get_where('settings' , array('type' =>'completed_discontinued_button'))->row()->description == 'yes')
											{
												$paid="yes";
												if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')//If fee is there...
												{
													$fee_det	=	$this->db->get_where('tbl_students_fee_master',array('admission_number'=>$student_id,'academic_year_id'=>$running_year,'is_deleted'=>'N'))->row();
													if(isset($fee_det))
													{
														if($fee_det->fee_balance>0)
														{
															$paid="no";
														}
													}
												}
											?>
                            <form method="post" action="<?php echo base_url(); ?>index.php/admin/update_course_status">
                              <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id;?>" />
                              <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>" />
                              <div class="profile-info-row">
                                <?php	
												if($paid=="yes")
												{
											?>
                                <div class="">
                                  <center>
                                    <button type="submit" name="status" value="completed" class="btn btn-success" onclick="if(confirm('Do you want to proceed?')){ return true; }else{ return false; }">Completed</button>
                                  </center>
                                </div>
                                <?php
												}
											?>
                                <div class="profile-info-value">
                                  <center>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Discontinued</button>
                                  </center>
                                </div>
                              </div>
                              <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Click Submit to proceed.</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Reason</p>
                                      <textarea name="reason"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-danger" name="status" value="discontinued">Submit</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                            <?php
											}
											?>
                            
                          </center>
                          <br>
                          <br>
                        </div>
                       
                        
                      </div>
                      <br/>
                      <br/>
                      <?php $student_id = $student_id; ?>
                      <?php } 
				          ?>
                    </table>
                  </div>
                </div>
                <?php
               $yr=get_running_year();
    $edit_data = $this->db->get_where('enroll', array('student_id' => $row['student_id'], 'year' => $yr
            ))->result_array();
    foreach ($edit_data as $row3){
        ?>
                <div class="row col-md-8" >
                  <div class="table-responsive" >
                    <table>
                      <h3><?php echo get_phrase('Update-Information'); ?></h3>
                      <?php echo form_open(base_url() . 'index.php/admin/update_student/' . $row3['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                      <?php $student_id = $row3['student_id']; ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Roll NO'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="roll" value="<?php echo $this->db->get_where('enroll', array('student_id' => $row3['student_id'],'year'=>$running_year))->row()->roll; ?>"
 class="form-control" placeholder="<?php echo get_phrase('Roll No'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Admission Number'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="admission_number" value="<?php echo $student_view['admission_number'];?>"
 class="form-control" placeholder="<?php echo get_phrase('Admission No'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Name'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="name" value="<?php echo $student_view['name'];  ?> " class="form-control" placeholder="<?php echo get_phrase('Name'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Class'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <?php
                          $is_fee_paid 	= 	is_fee_paid($student_id);
                          // $have_data		=	$this->crud_model->have_data($student_id,$row['class_id'],$running_year);
                          if($is_fee_paid=='y')// || $have_data=='1'
                          {
                          ?>
                                        <input type="text" value="<?php echo $this->crud_model->get_class_name($row['class_id']); ?>" class="col-md-12" disabled="disabled" title="Can not change Class, because data exist"  />
                                        <input type="hidden" name="class" value="<?php echo $row['class_id'];?>" />
                                        <?php
                          }
                          else
                          {
                          ?>
                              <select name="class" class="select2"  onchange="get_class_sections(this.value);get_fee_structure(this.value);">
                                <option value="">Select Class</option>
                                <?php 
                                $qry="SELECT s.branch_id,s.dept_id from student as s inner join enroll as e on e.student_id=s.student_id where s.student_id='".$row['student_id']."'";
                                
                                $query=$this->db->query($qry)->row();
                                // $branch_id=$query->branch_id;
                                // $department_id=$query->dept_id;
                                $this->db->where('academic_year',$running_year);
                                // $this->db->where('branch_id',$branch_id);
                                // $this->db->where('dept_id',$department_id);
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row1): ?>
                                  <option value="<?php echo $row1['class_id'];?>" <?php if($row['class_id'] == $row1['class_id']){ echo "selected"; } ?>> <?php echo $row1['name'];?> </option>
                                  <?php
                                endforeach;
                              ?>
                              </select>
                              <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Section'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <div id="section_selector1" name="section_selector1">
                            <input type="hidden" name="from_section" value="<?php echo $sec_id;?>" />
                            <?php
                              $this->db->where('class_id',$row['class_id']);
                              $this->db->where('academic_year',$running_year);
                              $sections	=	$this->db->get('section')->result_array();
                            ?>
                            <select name="section" class="select2" id="section1">
                              <?php
                              foreach($sections as $sect):
                              ?>
                              <option value="<?php echo $sect['section_id'];?>" <?php if($sect['section_id']==$sec_id){ echo "selected"; } ?>><?php echo $sect['name']; ?></option>
                              <?php
                              endforeach;
                              ?>
                            </select>
                          </div>
                          <div id="section_selector" style="display:none" name="section_selector">
                            <select name="section" class="select2" id="section_selector_holder">
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php
                      if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
                      {
                      ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Fee Structure'); ?></label>
                        <div class="col-md-12">
                          <div>
                            <?php
								
								//$assigned_fee_id = 0;
								$assigned_fee_id = is_fees_assigned($student_id);//echo $this->db->last_query();
								$is_fee_paid = is_fee_paid($student_id);
								
								if($is_fee_paid=='y')
								{
								 foreach($fee_master as $fee):
								 	if($assigned_fee_id==$fee['fee_master_id'])
									{
								?>
                            <input type="text" name="" id="" value="<?php echo $fee['fee_master_name']; ?>" class="form-control" disabled title="Fee paid,can not modify" />
                            <!--<input type="hidden" name="fee_master_id" value="fee_master_id" />-->
                            <?php
									}
								endforeach;
								}
								else
								{
								?>
                            <select name="fee_master_id" class="form-control" id="fee_master_id">
                              <option value="">Select</option>
                              <?php
                                foreach($fee_master as $fee):
								
								?>
                              <option value="<?php echo $fee['fee_master_id']; ?>" <?php if($assigned_fee_id==$fee['fee_master_id']){ echo ' selected="selected"';} ?>><?php echo $fee['fee_master_name']; ?></option>
                              <?php	
								endforeach;
								?>
                            </select>
                            <?php
								}
								?>
                          </div>
                        </div>
                      </div>
                      <?php
				}
				?>
                      <!-- ------------student bus route details start----------------- -->
                      <?php
            $transportation=$this->db->get_where('settings' , array('type' => 'transportation'))->row()->description;
            if($transportation=='yes')
            {
				$this->db->where('student_id',$student_id);
				$bus_fee = $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();
				if(count($bus_fee)>0){
				$bus_fee_paid = 'y'; }
				
				$qry="SELECT s.branch_id,s.dept_id from student as s inner join enroll as e on e.student_id=s.student_id where s.student_id='".$student_id."'";
				$query=$this->db->query($qry)->row();
				$branch_id=$query->branch_id;
				?>
                      <input type="hidden" value="<?php echo $branch_id; ?>" name="branch_id" />
                      <?php
                                $this->db->select('route_master_name,route_master_id,bus_number,route_register_id,pickup_point,route_details_id,fee_amount');
				$this->db->where('student_id',$student_id);
				$this->db->where('is_deleted','N');
				$this->db->where('academic_year',$running_year);
				$this->db->group_by('student_id');
				$route1 = $this->db->get('view_transport_students_bus_fee_master')->result_array();
				if(count($route1)>0){
                 foreach($route1 as $r1){
				
				if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){ ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Bus Route:'); ?></label>
                        <div class="col-md-12">
                          <?php 
								if($bus_fee_paid == 'y'){ ?>
                          <input type="hidden" value="<?php echo $bus_fee_paid; ?>" name="bus_fee_paid"  />
                          <input type="text"  name="route_master_id" id="bus_route" value="<?php echo $r1['route_master_name'];?>" class="form-control" disabled title="Fee paid,can not modify" />
                          <?php } else { ?>
                          <select name="route_master_id" id="bus_route"  class="select2" onChange="get_bus(this);get_pick_up(this);"  >
                            <?php
                                    $this->db->where('branch_id',$branch_id);
                                    $route_master = $this->db->get('view_transport_route_master')->result_array();
                                    foreach($route_master as $route): ?>
                            <option value="<?php echo $route['route_master_id'];?>" <?php if($route['route_master_id'] == $r1['route_master_id']) { echo "selected"; } ?>><?php echo $route['route_master_name'];?></option>
                            <?php 
                                    endforeach;
                                    ?>
                          </select>
                          <?php } 
							} ?>
                        </div>
                      </div>
                      <?php
                if($this->session->userdata('role')!=1  && $this->session->userdata('role')!=2){ ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Bus Route:'); ?></label>
                        <div class="col-md-12">
                          <?php 
                            if($bus_fee_paid == 'y'){ ?>
                          <input type="hidden" value="<?php echo $bus_fee_paid; ?>" name="bus_fee_paid"  />
                          <input type="text"  name="route_master_id" id="bus_route" value="<?php echo $r1['route_master_name'];?>" class="form-control" disabled title="Fee paid,can not modify" />
                          <?php } else { ?>
                          <select name="route_master_id" id="bus_route"  class="select2" onChange="get_bus(this);get_pick_up(this);"  >
                            <?php
                                    $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                    $route_master = $this->db->get('view_transport_route_master')->result_array();
                                    foreach($route_master as $route): ?>
                            <option value="<?php echo $route['route_master_id'];?>" <?php if($route['route_master_id'] == $r1['route_master_id']) { echo "selected"; } ?>><?php echo $route['route_master_name'];?></option>
                            <?php 
                                    endforeach;
                                    ?>
                          </select>
                          <?php } 
							 ?>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Bus Number:'); ?></label>
                        <div class="col-md-12">
                          <?php
                            if($bus_fee_paid == 'y'){ ?>
                          <input type="text"  name="route_register_id" id="route_register_id" value="<?php echo $r1['bus_number'];?>" class="form-control" disabled title="Fee paid,can not modify" />
                          <?php }
						 else { 
						
							$bus_no = $this->db->get_where('view_transport_route_register' , array('route_master_id' => $r1['route_master_id'],'is_deleted' => 'N'))->result_array(); ?>
                          <select name="route_register_id" id="route_register_id" onChange="check_checkbox();get_bus_seats(this);" class="select2"  >
                            <?php foreach($bus_no as $bus){ ?>
                            <option value="<?php echo $bus['route_register_id'];?>" <?php if($r1['route_register_id'] == $bus['route_register_id']) { echo "selected"; } ?>><?php echo $bus['bus_number'];?></option>
                            <?php } ?>
                          </select>
                          <?php }
						 ?>
                          <div id="msg_bus" style="color:#FF0000"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Pick-up Point:'); ?></label>
                        <div class="col-md-12">
                          <?php 
                            if($bus_fee_paid == 'y'){ ?>
                          <input type="text"  name="route_register_id" id="route_register_id" value="<?php echo $r1['pickup_point'];?>" class="form-control" disabled title="Fee paid,can not modify" />
                          <?php }
						 else { 
                            $pick_up= $this->db->get_where('view_transport_route_details' , array('route_master_id' => $r1['route_master_id'],'is_deleted' => 'N'))->result_array(); ?>
                          <select name="pickup_point" id="pickup_point"  class="select2" onChange="get_base_fare(this);"  >
                            <?php foreach($pick_up as $p){ 
                            ?>
                            <option value="<?php echo $p['route_details_id'];?>" <?php if($r1['route_details_id'] == $p['route_details_id']) { echo "selected"; } ?>><?php echo $p['pickup_point'];?></option>
                            <?php } 
							} ?>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" name="base_fare" id="base_fare"  class="col-xs-10 col-sm-5" value="<?php echo $r1['fee_amount']; ?>" />
                      <?php
            }
		 }
		 else
		 { 
								if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){ ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Bus Route:'); ?></label>
                        <div class="col-md-12">
                          <select name="route_master_id" id="route_master_id"  class="select2" onChange="get_bus(this);get_pick_up(this);"  >
                            <option value="">Select</option>
                            <?php 
											$this->db->where('branch_id',$branch_id);
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
                      <?php } ?>
                      <?php
									if($this->session->userdata('role')!=1  && $this->session->userdata('role')!=2){ ?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Bus Route:'); ?></label>
                        <div class="col-md-12">
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
                        <label class="col-md-12"><?php echo get_phrase('Bus Number:'); ?></label>
                        <div class="col-md-12">
                          <select name="route_register_id" id="route_register_id" onChange="check_checkbox();get_bus_seats(this);" class="select2"  >
                            <option value="">select</option>
                          </select>
                          <div id="msg_bus" style="color:#FF0000"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Pick-up Point:'); ?></label>
                        <div class="col-md-12">
                          <select name="pickup_point" id="pickup_point"  class="select2" onChange="get_base_fare(this);"  >
                            <option value="">select</option>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" name="base_fare" id="base_fare"  class="col-xs-10 col-sm-5"  />
                      <?php }
		 }
        ?>
                      <!-- ------------student bus route details end----------------- -->
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Phone1'); ?>
                        </span>
                        <font color="#FF0000">*</font></label>
                        <div class="col-md-12">
                          <input type="text" name="phone1" required="" value="<?php echo $student_view['phone1'];?>" class="form-control" placeholder="<?php echo get_phrase('Phone1'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Phone2'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="phone2" value="<?php echo $student_view['phone2']; ?>" class="form-control" placeholder="<?php echo get_phrase('Phone2'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Phone3'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="phone3" value="<?php echo $student_view['phone3']; ?>" class="form-control" placeholder="<?php echo get_phrase('Phone3'); ?>">
                        </div>
                      </div>
                      <?php
				if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
				{
				?>
                      <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('WhatsApp');?></label>
                        <div class="col-sm-12">
                          <input type="text" name="whatsapp_number" value="<?php echo $student_view['whatsapp_number']; ?>" class="form-control" placeholder="<?php echo get_phrase('WhatsApp Name'); ?>">
                        </div>
                      </div>
                      <?php
				}
				?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Sex'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <select name="sex" class="select2">
                            <option value=""><?php echo $student_view['sex']; ?></option>
                            <option value="male"><?php echo get_phrase('Male'); ?></option>
                            <option value="female"><?php echo get_phrase('Female'); ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Address'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <textarea  name="address" class="form-control" placeholder="<?php echo get_phrase('Address'); ?>"><?php echo $student_view['address']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Email'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="email" value="<?php echo $student_view['email'];?>" class="form-control" placeholder="<?php echo get_phrase('Email'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Aadhaar Number'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="aadhaar_number" value="<?php echo $student_view['aadhaar_number'];?>" class="form-control" placeholder="<?php echo get_phrase('Aadhaar Number'); ?>">
                        </div>
                      </div>
                      <?php if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
                {
				?>
                      <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('School Name'); ?></label>
                        <div class="col-sm-12">
                          <input type="text" name="school_name" value="<?php echo $student_view['school']; ?>" class="form-control">
                        </div>
                      </div>
                      <?php 
				}
				
				?>
                      <div class="form-group">
                        <label class="col-sm-12">
                        <?php 
						if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
						{
							echo get_phrase('Father');
						}
						else
						{
							echo get_phrase('Parent');
						} 
					?>
                        </label>
                        <div class="col-sm-12">
                          <input type="text" name="parent" value="<?php echo $student_view['parent']; ?>" class="form-control" placeholder="<?php echo get_phrase('Parent Name'); ?>">
                        </div>
                      </div>
                      <?php
				if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
				{
				?>
                      <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('Mother');?></label>
                        <div class="col-sm-12">
                          <input type="text" name="mother_name" value="<?php echo $student_view['mother_name']; ?>" class="form-control" placeholder="<?php echo get_phrase('Mother Name'); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-12"><?php echo get_phrase('Parent ID');?></label>
                        <div class="col-sm-12">
                          <input type="text" name="parent_id" value="<?php echo $student_view['parent_id']; ?>" class="form-control" placeholder="<?php echo get_phrase('Parent ID');?>">
                        </div>
                      </div>
                      <?php
				}
				?>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Birthday'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <input type="text" name="birthday" class="form-control mydatepicker" placeholder="<?php echo get_phrase('Birthday'); ?>" value="<?php echo date('d-m-Y',strtotime($birthday)); ?>" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('Certificate submitted'); ?>
                        </span></label>
                        <div class="col-md-12">
                          <?php if(count($certificate)=='0'){
					echo "No Certificates Added<br>"; } else { ?>
                          <?php foreach($certificate as $cert){ 
						$check = strpos($student_view['certificates_submitted'], "'".$cert['certificate_id']."'")!== false;
					$query  = "(select a.student_id,b.certificate_id,b.issue_details_id"
				. " from tbl_certificate_issue_master a "
				. "join tbl_certificate_issue_details b on b.issue_master_id=a.issue_master_id "
				. "where b.return_date='0000-00-00 00:00:00' and a.student_id=".$student_id." and b.certificate_id=".$cert['certificate_id'].")";
				$issued = $this->db->query($query)->result_array(); 
				if(count($issued)>0){ ?>
                          <input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $cert['certificate_id'] ?>" >
                          <span class="lbl"> <?php echo $cert['certificate_name'] ?></span> &nbsp;
                          <?php }else{ ?>
                          <input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $cert['certificate_id'] ?>" <?php if($check=='1') { echo "checked='checked'";} ?>>
                          <span class="lbl"> <?php echo $cert['certificate_name'] ?></span> &nbsp;
                          <?php } } } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12"><?php echo get_phrase('photo'); ?>
                        </span></label>
                        <div class="col-sm-5">
                          <!-- our form -->
                          <input  type="file" name="userfile"  />
                          <div><font color="#FF0000">Note: Photo Must Be In 150x150 Size</font></div>
                          <br>
                          <button type="reset" class="btn btn-sm">Reset</button>
                        </div>
                      </div>
                      <?php }?>
                      <button type="submit" onclick="return validate();" class="btn btn-info waves-effect waves-light m-r-10">Update</button>
                      <?php
				if($this->db->get_where('settings' , array('type' =>'student_delete'))->row()->description == 'yes')
				{
				?>
                      <a href="<?php echo base_url();?>index.php/admin/delete_student/<?php echo $student_id;?>/<?php echo $class_id;?>" class="btn btn-danger waves-effect waves-light m-r-10" onClick="return confirm('Are-you-sure');">Delete </a>
                      <?php
				 }
				 ?>
                      <!--   <a href="<?php echo base_url();?>index.php/admin/inactive_student/<?php echo $student_id;?>/<?php echo $class_id;?>" class="btn btn-success waves-effect waves-light m-r-10" onClick="return confirm('Are-you-sure');">In Active
                           
                    </a>	-->
                      <?php echo form_close();} ?>
                    </table>
                  </div>
                </div>
                <div> </div>
                <div class="row">
                  <div  class=" row col-md-4 col-xs-4">
                    <div  class="white-box">
                    <table>
                      <div class="profile-user-info profile-user-info-striped" >
                        <h3 ><?php echo  "Uploaded Documents" ; ?></h3>
                        <?php echo form_open(base_url() . 'index.php/admin/upload_student_document/' .$student_id, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                        <?php
	   $this->db->where('student_id',$student_id);
	   $this->db->where('is_deleted','N');
	   $documents=$this->db->get('tbl_student_documents')->result_array(); 
	   foreach($documents as $document)
	   { 
	   ?>
                        <div class="row">
                          <div class="form-group">
                            <div class="col-md-9"><a href="<?php echo base_url();?>uploads/student_documents/<?php echo $document['document_id']?>.jpg" target="_blank"><?php echo $document['title']; ?> </a> <a href="<?php echo base_url();?>index.php/admin/delete_student_document/<?php echo $document['document_id']?>/<?php echo $student_id?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');" title="delete"><i class="fa fa-close text-danger"></i></a> </div>
                          </div>
                        </div>
                        <br />
                        <?php
	   }
	   ?>
                        <br />
                        <div class="row">
                          <div class="form-group">
                            <label class="col-md-5"><?php echo "Title" ; ?>:
                            </span></label>
                            <div class="col-md-4">
                              <input  type="text" name="title" id="title" required="" />
                            </div>
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="form-group">
                            <label class="col-md-5"><?php echo "Upload Document" ; ?>:
                            </span></label>
                            <div class="col-md-4">
                              <input  type="file" name="userfile" id="userfile" required=""  />
                            </div>
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <center>
                            <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Upload</button>
                          </center>
                        </div>
                        <br />
                      </div>
                      <br/>
                      <br/>
                      <?php echo form_close(); ?>
                      </div>
                      
                    </table>
                    </center>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="panel" style="border-color:#0099FF">
                      <div class="panel-heading table-header" >
                        <div class="panel-title"> Update-Password </div>
                      </div>
                      <div class="panel-body">
                        <?php 
                  // $edit_datas = $this->db->get_where('staff' , array('staff_id' => $staff_id))->result_array();
                  //  foreach($edit_datas as $row3):
                        ?>
                        <?php echo form_open(base_url() . 'index.php/Admin/student_password_update/'.$student_id, array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">New-Password</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control" name="new_password" value=""/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Confirm-Password</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control" name="confirm_new_password" value=""/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info">Update</button>
                          </div>
                        </div>
                        <?php
						echo form_close();
                 //   endforeach;
                    ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="panel"  style="padding-bottom:90px;border-color:#0099FF">
                      <div class="panel-heading table-header" >
                        <div class="panel-title"> Update-Username </div>
                      </div>
                      <div class="panel-body">
                        <?php 
                  // $edit_datas = $this->db->get_where('staff' , array('staff_id' => $staff_id))->result_array();
                  //  foreach($edit_datas as $row3):
                        ?>
                        <?php echo form_open(base_url() . 'index.php/Admin/student_username_update/'.$student_id, array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                          <?php
									$user_id	=	$this->db->get_where('student',array('student_id'=>$student_id))->row()->user_id;
								?>
                          <label class="col-sm-3 control-label">Username</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" name="username" value="<?php echo $this->db->get_where('tbl_users',array('user_id'=>$user_id))->row()->username; ?>"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info">Update</button>
                          </div>
                        </div>
                        <?php
						echo form_close();
                 //   endforeach;
                    ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!--  Profile5 Start-------->
            <div id="profile5" class="tab-pane">
              <div style="padding-left:50px;padding-right:50px;">
                <!----- Fee Payment Details-->
                <h5> Fee Payment Details</h5>
                <?php
		$this->db->select('student_id,date_paid,receipt_number,fee_head,fee_amount,description');
		$this->db->where('student_id', $student_id);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id', $section_id);
		$this->db->where('is_deleted', 'N');
		$this->db->from('view_special_fee_collection_master');
		$this->db->order_by('receipt_number','asc');
		
		
		$fee_details		=	$this->db->get()->result_array();
?>
                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" width="60%">
                  <thead>
                    <tr>
                      <th style="text-align: center;" class="table-header"><b>SlNo</b></th>
                      <th style="text-align: center;" class="table-header"><div align="center"><b>Date Paid</b></div></th>
                      <th style="text-align: right;" class="table-header"><div align="center"><b>Receipt No.</b></div></th>
                      <th style="text-align: right;" class="table-header"><div align="center"><b> Fee Head</b></div></th>
                      <th style="text-align: right;" class="table-header"><div align="center"><b> Description</b></div></th>
                      <th style="text-align: right;" class="table-header"><b> Amount</b></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$total_amount_paid = 0;
$count=0;
foreach($fee_details as $data)
{
$count=$count+1;
}
if($count==0)
{
echo "<tr><th style='text-align: center;' colspan='6'><font color='red'><b>No Fee Payment Details Found</b></font></th></table>";
}
else
{
$sno=1;
foreach($fee_details as $data)
{
?>
                    <tr>
                      <th style="text-align: right;"><?php echo  $sno ;?></th>
                      <th style="text-align: right;"><div align="center"><?php echo date('d-m-Y',strtotime($data['date_paid']));?></div></th>
                      <th style="text-align: right;"><div align="center"><?php echo $data['receipt_number'] ;?></div></th>
                      <th style="text-align: right;"><div align="center"><?php echo $data['fee_head'] ;?></div></th>
                      <th style="text-align: right;"><div align="center"><?php echo $data['description'] ;?></div></th>
                      <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
                    </tr>
                    <?php
$total_amount_paid		 = $total_amount_paid+$data['fee_amount'];
$sno=$sno+1;
}
?>
                    <tr>
                      <td style="text-align: center;" colspan="5"><b>Total</b></td>
                      <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
                    </tr>
                  </tbody>
                </table>
                <?php
}
?>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($this->session->flashdata('action')=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if ($this->session->flashdata('action')=="failed")
{
echo "<script>toastr.error('". "Updation Failed...', 'Something went wrong', {timeOut: 5000})</script>";
}

?>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
			
			
			
                if ($.isFunction($.fn.selectBoxIt))s
                {
                    $("select.selectboxit").each(function (i, el)
                    {
                        var $this = $(el),
                                opts = {
                                    showFirstOption: attrDefault($this, 'first-option', true),
                                    'native': attrDefault($this, 'native', false),
                                    defaultText: attrDefault($this, 'text', ''),
                                };

                        $this.addClass('visible');
                        $this.selectBoxIt(opts);
                    });
                }
            });
        </script>
<script type="text/javascript">
            function select_section(class_id) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
                    success: function (response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        </script>
<script type="text/javascript">
            function select_attendance(month) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/admin/get_attendance/' + month,
                    success: function (response)
                    {
                        jQuery('#section_holder').html(response);
                    }
					}).complete(function () {
                $(".preloader").hide();
                });
            }
        </script>
<script type="text/javascript">
function send_sms(class_id,section_id, student_id){
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/attendance_sms/' + class_id + '/' + section_id + '/' + student_id ,
            success: function(response)
            {
				alert(response);
            }
			}).complete(function () {
                $(".preloader").hide();
  });
}
</script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
			   $("#section_selector").show();
               $("#section_selector1").hide();
                jQuery('#section_selector_holder').html(response);
				 
            }
        });
    }
	function get_fee_structure(class_id)
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_fee_structure/' + class_id ,
            success: function(response)
            {
                jQuery('#fee_master_id').html(response);
				 
            }
        });
	}
	function validate()
	{
		if(jQuery('#fee_master_id').val()=='')
		{
			if(confirm("No fee structure selected, do you want to continue?")) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
				return true;
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
	

//////////////////
		
function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
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
<script>
function view_attendance_list1() 
	{
	
		var subject = $('#subject_id').val();
		var from_date = $('#mydatepicker').val();
		var to_date = $('#mydatepicker1').val();
		var student = $('#student').val();
		
		
    	$.ajax({
        url: '<?php echo base_url();?>index.php/admin/view_attendance_list_hourly/'+subject +'/'+from_date+'/'+to_date+'/'+student,
            success: function(response)
            {
                jQuery('#show_hourly_list').html(response);
			}
        });
    }
	</script>
<script type="text/javascript">
      $(document).ready(function(){
          $('#active1').click(function(){
		 var result = confirm("Want to inactivate?");
         if (result) {
          window.location='<?php echo base_url();?>index.php/admin/inactive_student/<?php echo $student_id;?>/<?php echo $class_id;?>';
		  } // link of your desired page.  
          });
      });
  </script>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
        $('.select2').css('width','700px').select2({allowClear:true})
                        $('#select2-multiple-style .btn').on('click', function(e){
                            var target = $(this).find('input[type=radio]');
                            var which = parseInt(target.val());
                            if(which == 2) $('.select2').addClass('tag-input-style');
                             else $('.select2').removeClass('tag-input-style');
                        });                                    
         </script>
<script>
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
	
</script>

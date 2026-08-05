<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year();?><body> 
   
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
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								
									
							</form>
						</div><!-- /.nav-search -->

					</div>

					
						<div class="page-header">
							<h1>
								Dashboard
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Admin
							</h1>
						</div>
                        <!-- /.page-header -->
                        
                         
 <div style="position:absolute; z-index:2;">
 <?php /*$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
							// $api = 'http://bulksms.login2itsolutions.com';
		//$api = 'http://sms4add.in';
		$api = $url;
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		 $balance = stream_get_contents($handle);
		 // $sms_balance	=	count($handle);*/
		//$balance=100;
		//if($balance <=1000){ ?><script>alert("Low SMS Alert. You Have Only "+<?php echo $balance;?>+" SMS Left In Your SMS Balance Please Contact 0497 276 46 26 for Refill")</script><?php // }?></div>
						<div class="row">
							<div class="col-xs-12">
								
									<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">News</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
                                                 <marquee direction="rtl">
													<?php   $role=$this->session->userdata('role');
													  $branch=$this->session->userdata('branch_id');
													   $dept=$this->session->userdata('dept_id');
													 
													   if($role==3)
													{
													$this->db->where('branch_id',$branch);
													}
													if($role==4 || $role==12)
													{
													$this->db->where('branch_id',$branch);
													$this->db->where('dept_id',$dept);
													}
													
													$this->db->where('academic_year',$running_year);
													//$this->db->order_by('news_status','desc');
													$this->db->limit(15);
													$query=$this->db->get('news')->result_array();
													$slno=1;
													
													
													 foreach($query as $news){
													 ?>
													 <a href="<?php echo base_url();?>index.php/Admin/news_view/details/<?php echo $news['news_code'];?>" role="button" class="green" data-toggle="modal"><?php 
													 echo  $slno .") ".$news['title'];
													 $slno++;?>
                                                     </a><?php } ?>
                                                </marquee> 
												</div>
											</div>
										</div>
								<div class="row">
									
<?php //echo $this->session->userdata('dept_id'); ?>
									<div class="col-sm-5 infobox-container">
										<!-- #section:pages/dashboard.infobox -->
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php 
												
												$role=$this->session->userdata('role');
												
												$this->db->select('count(s.student_id) as student_count');
												if($role ==3)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												}
												if($role ==4 || $role==12)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												$this->db->where('dept_id',$this->session->userdata('dept_id'));
												}
												
												$this->db->where('e.year',$running_year);
												$this->crud_model->check_student_status();
						 //$year=$this->db->get_where('tbl_academic_year',array('acdemic_year_id'=> $running_year))->row()->academic_year;
												$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
												$query=$this->db->get('student s')->row();
												echo $query->student_count;?></span>
												<div class="infobox-content">all students</div>
											</div>

											<!-- #section:pages/dashboard.infobox.stat 
											<div class="stat stat-success">8%</div>-->

											<!-- /section:pages/dashboard.infobox.stat -->
										</div>

										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-users"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(staff_id) as staff_count');
												if($role ==3)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												}
												if($role ==4 || $role==12)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												$this->db->where('dept_id',$this->session->userdata('dept_id'));
												}
												$this->db->where('is_deleted','N');
												$this->db->where('role',6);
												$this->db->or_where('role',5);
												$query=$this->db->get('staff')->row();
												echo $query->staff_count;?></span>
												<div class="infobox-content">Teachers</div>
											</div>
<!--
											<div class="badge badge-success">
												+32%
												<i class="ace-icon fa fa-arrow-up"></i>
											</div>-->
										</div>

										<div class="infobox infobox-pink">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-user"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(staff_id) as staff_count');
												if($role ==3)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												}
												if($role ==4 || $role==12)
												{
												//$this->crud_model->test_branch();
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												$this->db->where('dept_id',$this->session->userdata('dept_id'));
												}
												
												$query=$this->db->get('staff')->row();
												echo $query->staff_count;?></span>
												<div class="infobox-content">Staff</div>
											</div>
											<!--<div class="stat stat-important">4%</div>-->
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-flask"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(homework_id) as homework');
												if($role ==3)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												}
												if($role ==4 || $role==12)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												$this->db->where('dept_id',$this->session->userdata('dept_id'));
												}
												$this->db->where('is_deleted','N');
												$this->db->where('academic_year',$running_year);
												$query1=$this->db->get('homework')->row(); 
												echo $query1->homework;?></span>
												<div class="infobox-content">Home Work</div>
											</div>
										</div>

										<div class="infobox infobox-orange2">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-chart">
												<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
											</div>

											<!-- /section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(document_id) as homework');
												if($role ==3)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												}
												if($role ==4 || $role==12)
												{
												$this->db->where('branch_id',$this->session->userdata('branch_id'));
												$this->db->where('dept_id',$this->session->userdata('dept_id'));
												}
												$this->db->where('is_deleted','N');
												$this->db->where('academic_year',$running_year);
												$query1=$this->db->get('document')->row(); 
												echo $query1->homework;?></span>
												<div class="infobox-content">Study Material</div>
											</div>

											
										</div>
										
                                            <div class="infobox infobox-blue">
											 <div class="infobox-icon">
												<i class="ace-icon fa fa-envelope"></i>
											</div>
                                            

											<div class="infobox-data">
                                            
												<span class="infobox-text"><?php 
												
												
												/*$sms = $this->db->get('sms_settings')->row();
		$sender = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
//$username = "xxxxxx"; //your username
//$password = "xxxxxx"; //your password
//$sender = "xxxxxx"; //Your senderid
//$mobile = "xxxxxxxxxx,xxxxxxxxxx "; //enter Mobile numbers comma seperated
$username = urlencode($username);
$password = urlencode($password);
//$messagecontent = "xxxxxx "; //Type Of Your Message
//$message = urlencode($messagecontent);
$route = "T"; //your route id
//$peid = "xxxxxxxxxxxxxxxxxxx"; //your 19-digit Entity ID
//$tempid = "xxxxxxxxxxxxxxxxxxx"; //your 19-digit Template ID
$url =
"http://bulksms.login2itsolutions.com/creditsleft?uname=$username&pwd=$password&senderid=$sender&route=$route";
//echo $url;die;
$data=fopen($url,"r");*/



		 echo '--';
		?></span>

												<div class="infobox-content">
													<span class="bigger-110"></span>
													Message Balance
												</div>
											</div>
										</div>
                                        
									<?php
									if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
									{
										if($this->db->get_where('settings' , array('type' =>'show_todays_collection_in_dashboard'))->row()->description == 'yes')
										{
										?>	                                        	
											
											<div class="infobox infobox-blue">
												<div class="infobox-icon">
													<i class="ace-icon fa fa-inr"></i>
												</div>
												<div class="infobox-data">                                            
													<span class="infobox-text">
														<?php 
														$year				=	get_running_year();
														$this->db->select('SUM(a.fee_amount) as fee_amount');
														$this->db->join('student b','b.student_id=a.admission_number');
														if($role ==3)
														{
															$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
														}
														if($role >=4)
														{
															$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
															$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
														}
														$this->db->from('view_fee_collection_details a');
														$this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")',date('Y-m-d'));
														$this->db->where('a.academic_year_id',$year);
														$fee				=	$this->db->get()->row()->fee_amount;
														$special_fee		=	0;
														$transport_fee		=	0;
														if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
														{
															$this->db->select('SUM(a.fee_amount) as fee_amount');
															$this->db->join('student b','b.student_id=a.student_id');
															if($role ==3)
															{
																$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
															}
															if($role >=4)
															{
																$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
															}
															$this->db->from('tbl_special_fee_collection_master a');
															$this->db->where('a.date_paid',date('Y-m-d'));
															$this->db->where('a.academic_year_id',$year);
															$special_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
														if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
														{
															$this->db->select('SUM(a.amount_paid) as fee_amount');
															$this->db->join('tbl_transport_students_bus_fee_collection_master b','b.bus_fee_collection_master_id = a.bus_fee_collection_master_id');
															if($role ==3)
															{
																$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
															}
															if($role >=4)
															{
																$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
															}
															$this->db->from('view_transport_students_bus_fee_collection_details a');
															$this->db->where('a.date_paid',date('Y-m-d'));
															$this->db->where('b.academic_year',$year);
															$transport_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
                                                                                                                //Opening balance
                                                                                                                $select =   "sum(amount_paid) as amount_paid";
                                                                                                                $where  =   " DATE_FORMAT(date_paid,'%Y-%m-%d') = '" . date('Y-m-d') . "' and paid_year_id=".$year." and is_deleted='N'";
                                                                                                                if($role >= 4 && $this->session->userdata('dept_id'))
                                                                                                                {
                                                                                                                    $where  =   $where." and dept_id=". $this->session->userdata('dept_id');
                                                                                                                }
                                                                                                                $query_result3                  =       $this->Fee_management_model->view_opening_balance_collection($select,$where);
                                                                                                                $op_bal                         =       ($query_result3 && $query_result3->num_rows() > 0 && isset($query_result3->row()->amount_paid)) ? $query_result3->row()->amount_paid : 0;
														$tot				=	$special_fee+$transport_fee+$fee+$op_bal;
														if($tot=='')
														{
															echo "0 Rs";
														}
														else
														{
															echo $tot." Rs";
														}
														?>
													</span>
													
													<div class="infobox-content">
														<span class="bigger-110"></span>
														Today's Fee Collection
													</div>
												</div>
											</div>
                                                                            <!-- Collection till today -->
                                                                                        <div class="infobox infobox-blue">
												<div class="infobox-icon">
													<i class="ace-icon fa fa-inr"></i>
												</div>
												<div class="infobox-data">                                            
													<span class="infobox-text">
														<?php 
														$year				=	get_running_year();
														$this->db->select('SUM(a.fee_amount) as fee_amount');
														$this->db->join('student b','b.student_id=a.admission_number');
														if($role ==3)
														{
															$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
														}
														if($role >=4)
														{
															$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
															$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
														}
														$this->db->from('view_fee_collection_details a');
														$this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")<=',date('Y-m-d'));
														$this->db->where('a.academic_year_id',$year);
														$fee				=	$this->db->get()->row()->fee_amount;
														$special_fee		=	0;
														$transport_fee		=	0;
														if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
														{
															$this->db->select('SUM(a.fee_amount) as fee_amount');
															$this->db->join('student b','b.student_id=a.student_id');
															if($role ==3)
															{
																$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
															}
															if($role >=4)
															{
																$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
															}
															$this->db->from('tbl_special_fee_collection_master a');
															$this->db->where('a.date_paid<=',date('Y-m-d'));
															$this->db->where('a.academic_year_id',$year);
															$special_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
														if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
														{
															$this->db->select('SUM(a.amount_paid) as fee_amount');
															$this->db->join('tbl_transport_students_bus_fee_collection_master b','b.bus_fee_collection_master_id = a.bus_fee_collection_master_id');
															if($role ==3)
															{
																$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
															}
															if($role >=4)
															{
																$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
															}
															$this->db->from('view_transport_students_bus_fee_collection_details a');
															$this->db->where('a.date_paid<=',date('Y-m-d'));
															$this->db->where('b.academic_year',$year);
															$transport_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
                                                                                                                //Opening balance
                                                                                                                $select =   "sum(amount_paid) as amount_paid";
                                                                                                                $where  =   " DATE_FORMAT(date_paid,'%Y-%m-%d') <= '" . date('Y-m-d') . "' and paid_year_id=".$year." and is_deleted='N'";
                                                                                                                if($role >= 4 && $this->session->userdata('dept_id'))
                                                                                                                {
                                                                                                                    $where  =   $where." and dept_id=". $this->session->userdata('dept_id');
                                                                                                                }
                                                                                                                $query_result3                  =       $this->Fee_management_model->view_opening_balance_collection($select,$where);
                                                                                                                $op_bal                         =       ($query_result3 && $query_result3->num_rows() > 0 && isset($query_result3->row()->amount_paid)) ? $query_result3->row()->amount_paid : 0;
														$tot				=	$special_fee+$transport_fee+$fee+$op_bal;
														if($tot=='')
														{
															echo "0 Rs";
														}
														else
														{
															echo $tot." Rs";
														}
														?>
													</span>
													
													<div class="infobox-content">
														<span class="bigger-110"></span>
														Collection Till Today
													</div>
												</div>
											</div>    
                                                                            <!-- Pending Till Today -->            
                                                                                        <div class="infobox infobox-blue">
												<div class="infobox-icon">
													<i class="ace-icon fa fa-inr"></i>
												</div>
												<div class="infobox-data">                                            
													<span class="infobox-text">
                                                                                                            
                                                                                                            <?php
                                                                                                            $fee_balance    =   $this->Fee_management_model->get_pending_fee("","",$till_today="yes");   //echo $this->db->last_query();die;
                                                                                                            echo $fee_balance." Rs";
                                                                                                            ?>
                                                                                                            
                                                                                                            
                                                                                                        </span>
													
													<div class="infobox-content">
														<span class="bigger-110"></span>
														Pending Till Today
													</div>
												</div>
											</div> 
                                                                           <!-- Total Balance -->            
                                                                                        <div class="infobox infobox-blue">
												<div class="infobox-icon">
													<i class="ace-icon fa fa-inr"></i>
												</div>
												<div class="infobox-data">                                            
													<span class="infobox-text">
                                                                                                            
                                                                                                            <?php
                                                                                                            $fee_balance    =   $this->Fee_management_model->get_pending_fee("","",$till_today="no");   //echo $this->db->last_query();die;
                                                                                                            echo $fee_balance." Rs";
                                                                                                            ?>
                                                                                                            
                                                                                                            
                                                                                                        </span>
													
													<div class="infobox-content">
														<span class="bigger-110"></span>
														Total Balance
													</div>
												</div>
											</div> 
                                                                                
                                                                                
										<?php
										}
									}
									?>
										<!-- /section:pages/dashboard.infobox -->
                                        <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
					   {?>
										<div class="space-6"></div>

										<!-- #section:pages/dashboard.infobox.dark -->
                                           

										<div class="infobox infobox-green infobox-small infobox-dark">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-chart">
												<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
											</div>
                             

											<div class="infobox-data">
												   <?php 
                                            $check  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                                            if($role==3)
											{
											    $this->db->where('branch_id',$branch);
											}
											if($role==4 || $role==12)
											{
											    $this->db->where('branch_id',$branch);
											    $this->db->where('dept_id',$dept);
											}
											
                                            $query = $this->db->get_where('attendance' , $check);
                                            $present_today      =   $query->num_rows();
                                            ?>
											<div class="infobox-content">Present</div>
												<div class="infobox-content"><?php echo $present_today;?></div>
											</div>
										</div>

										<div class="infobox infobox-red infobox-small infobox-dark">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-chart">
												<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
											</div>

											<!-- /section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-data">
																 <?php 
                                            $check  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                                            
                                            $query = $this->db->get_where('attendance' , $check);
                                            $present_today      =   $query->num_rows(); //echo $this->db->last_query();
                                            
                                             $check1  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '2' );
                                            if($role==3)
											{
											$this->db->where('branch_id',$branch);
											}
											if($role==4 || $role==12)
											{
											$this->db->where('branch_id',$branch);
											$this->db->where('dept_id',$dept);
											}
											
                                            $query = $this->db->get_where('attendance' , $check1);
                                            $absent_today      =   $query->num_rows(); //echo $this->db->last_query();
                                            ?>
												<a href="<?php echo base_url();?>index.php/Admin/get_absent_students" style="text-decoration:none">
                                                <div class="infobox-content">Absent</div>
												<div class="infobox-content"><?php echo $absent_today;?></div>
                                                </a>
											</div>
										</div>

										<div class="infobox infobox-blue infobox-small infobox-dark">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-chart">
												<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
											</div>


											<div class="infobox-data">
                                            <?php 
                      
						
						 $check2  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '3' );
						 	if($role==3)
							{
							$this->db->where('branch_id',$branch);
							}
							if($role==4 || $role==12)
							{
							$this->db->where('branch_id',$branch);
							$this->db->where('dept_id',$dept);
							}

                        $query = $this->db->get_where('attendance' , $check2); 
                        $late_today      =   $query->num_rows();
                        ?>						<a href="<?php echo base_url();?>index.php/Admin/get_late_students" style="text-decoration:none">
												<div class="infobox-content">Late</div>
												<div class="infobox-content"><?php echo $late_today;?></div>
                                                </a>
											</div>
										</div>
                                         <?php } ?>

										<!-- /section:pages/dashboard.infobox.dark -->
									</div>
                                   
 <!--<div class="table-responsive">-->
								
									<div class="col-md-7">
                             
                                    <img src="<?php echo base_url(); ?>assets/images/slider_1.jpg" class="img-responsive" style="height:260px;">
                                   
										
									</div><!-- /.col -->
								
                                </div>
                                <!--</div>--><!-- /.row -->

								<!-- #section:custom/extra.hr -->
								<div class="hr hr32 hr-dotted"></div>

								<!-- /section:custom/extra.hr -->
								<div class="row" style="padding-left:20px">
                                <?php echo form_open(base_url() . 'index.php/admin/birthday_message/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

									<div class="col-md-5 col-xs-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#FFFFFF"></i>
													&nbsp;&nbsp;<font color="#FFFFFF">Birth Day Today</font>
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped" border="1" bordercolordark="#000000">
														<thead class="thin-border-bottom">
															<tr>
																<th class="table-header" style="background-color:#66CCFF">
																	Name
																</th>

																<th class="table-header" style="background-color:#66CCFF">
																	Class
																</th>

																<th class="table-header" style="background-color:#66CCFF">
																	Send Wish
                                                                    

																</th>
															</tr>
														</thead>

														<tbody>
															
                                                            <?php
													        $birth_month=date("m-d");//echo $birth_month;die();
													  //$birth_day=date("d");
															$this->db->select('s.student_id,s.name as student,s.birthday as month,c.name as class,t.name as section');
															$this->db->from('student s');
															$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
															$this->db->join('class c','c.class_id=e.class_id','LEFT');
															$this->db->join('section t','t.section_id=e.section_id','LEFT');
															
															$this->db->where('e.year',$running_year);
															$this->crud_model->check_student_status();
															$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
															$this->db->where('s.dept_id',$this->session->userdata('dept_id'));
													//$this->db->like('s.name','JUMANA.C.M');		
															$query=$this->db->get()->result_array();//echo $this->db->last_query();die();
															//print_r($query);die();
															foreach($query as $birth_day1){
															    
															//$unixtime = strtotime($birth_day1['month']);
															$unixtime	=	str_replace("/","-",$birth_day1['month']);
													//echo $unixtime."<br>";
                                                            $time = date("m-d",strtotime($unixtime));
                                                    //echo $time;die();        
															if($time==$birth_month){
															
															?>

																<tr><td><?php echo $birth_day1['student'];?></td>

																<td>
																	
																
																	<?php echo $birth_day1['class']."-".$birth_day1['section'];?>
																</td>
                                                                


																<td>
                                                               <input type="checkbox" name="student[]" id="student[]" value=" <?php echo $birth_day1['student_id'];?>"/>
<!--																	<span class="label label-info arrowed-right arrowed-in">SEND SMS</span>
-->																</td>
                                                                
															</tr>
                                                            <?php }}?>

															
														</tbody></table><hr />
                                                        
                                                        <?php
														 $this->db->select('content');
								 $this->db->from('sms_template');
								 $this->db->where('title','birthday');
								 $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
														
                                                        $v=$this->db->get_where('sms_template',array('title'=>'birthday'))->row()->content;
														
														
														
														?>
                                                        <div class="row col-xs-12" align="right">
                                                        Message:&nbsp;<input type="text" name="wish_message" value="<?php echo $v;?>" style="width:300px;"/>
                                                        <?php }else
							  {?>
                            <input type="text"  name="wish_message" value="" style="display: none">
							 <?php } ?>
                                                      <button type="submit" class="btn btn-sm btn-yellow" onClick="preloader()">
   <i class="ace-icon fa fa-check"></i>
  SEND SMS
 </button><br>
 <a href="<?php echo base_url(); ?>index.php/admin/get_birthday_details/">Get Birthdays</a></div>
													<?php echo form_close(); ?>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->


											<div class="col-md-6" align="center">
                                      <?php echo form_open(base_url() . 'index.php/admin/report/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

                                            <h3>Delivery Report</h3>
											<button type="submit" class="btn btn-warning btn-xlg">Click Here</button>
                                            <?php echo form_close(); ?>
											</div>
								<div class="hr hr32 hr-dotted"></div>
<div></div>
</div>


						<?php
						if(get_setting('test_sms') == 'yes')
						{
							echo form_open(base_url() . 'index.php/admin/send_test_sms/', array('class' => 'form', 'enctype' => 'multipart/form-data'));
						?>
                            <div class="col-md-5" style="padding-left:20px;padding-top:10px;">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title lighter">
                                            &nbsp;&nbsp;<font color="#FFFFFF">Test SMS</font>
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <input type="text" name="phone" class="form-control col-md-12" placeholder="Mobile Number" style="margin-top:1%" >
                                            <textarea name="message" placeholder="Messge" class="form-control col-md-12" style="margin-top:1%"></textarea>
                                            Is Malayalam?&nbsp;<input type="checkbox" name="is_malayalam" id="is_malayalam" style="margin-top:1%" onClick="show_mal()"> 
                                            <span id="type_mal" style="display:none"><a href="https://www.google.com/intl/ml/inputtools/try/" target="_blank">Type In Malayalam</a></span>
                                            <br>
                                            <input type="submit" class="btn btn-info" value="Send SMS" name="send_sms" style="margin-top:1%">
                                        </div>
                                  	</div>
                             	</div>
                            </div>
						<?php
							echo form_close();
						}
						if(get_setting('upcoming_birthdays') == 'yes')
						{
						?>
                        
                            <div class="col-md-5" style="padding-left:20px;padding-top:10px;">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title lighter">
                                            &nbsp;&nbsp;<font color="#FFFFFF">Search Upcoming Birthdays</font>
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <div class="col-md-8" style="padding-left:0px;">
                                                <input type="text" id="datepicker" class="form-control" style="margin-top:1%" value="<?php echo date('d-m-Y',strtotime("tomorrow")); ?>" >
                                            </div>
                                            <div class="col-md-4">
                                                <input type="submit" class="btn btn-info btn-sm" value="Search" name="search" style="margin-top:1%" onClick="get_birthday()">
                                            </div>
                                            <div id="result_data"></div>    
                                            
                                        </div>
                                  	</div>
                             	</div>
                            </div>
						<?php                        
						}
						?>


</div></div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 

<script type="text/javascript">  
   $(window).load(function() {  
      $("#loader").fadeOut(1000);  
   });
   function show_mal()
   {
   		if($('#is_malayalam').prop('checked')==true)
		{ 
			//$('#type_mal').prop('display','block');
			$('#type_mal').show();
		}
		else
		{
			//$('#type_mal').prop('display','none');
			$('#type_mal').hide();
		}
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


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
		dateFormat: 'dd-mm-yy'
	});
  } );
	function get_birthday()
  	{
  		var date	=	$('#datepicker').val();
		if(date!='')
		{
			 $.ajax({
                url: '<?php echo base_url('index.php/admin/get_birthday'); ?>',
                type: 'post',
                data: {date:date},
                success: function( data){
                	$('#result_data').html( data );    
                }
            });
		}	
  	}
  </script>
  <style>
  	#ui-datepicker-div{
		width:250px;	
	}
  </style>

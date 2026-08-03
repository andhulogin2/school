<?php include_once APPPATH . 'views/staff_head.php';?>

	
	
		
		<?php //include_once APPPATH . 'views/top_bar.php';?>
       
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
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; status
								</small>
							</h1>
						</div><!-- /.page-header -->
 <div style="position:absolute; z-index:2;"> <script><?php $sms = $this->db->get('sms_settings')->row();
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
		if($balance <1000){ ?>alert("Low SMS Alert. You Have Only "+<?php echo $balance;?>+" SMS Left In Your SMS Balance Please Contact 0497 276 46 26 for Refill")<?php }?></script></div>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!--<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Welcome to
									<strong class="green">
										Login2 School
										
									</strong>,
	Student staffistration System Software.
								</div>-->
                                
									<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">News</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
                                                <marquee dir="rtl" >
													<strong class="green">Login2 School News :</strong><?php $this->db->select('news_code,title');
													$this->db->from('news');
													$this->db->order_by('news_status','desc');
													$query=$this->db->get()->result_array();
													$slno=1;
													 foreach($query as $news){
													 ?>
													 <a href="<?php echo base_url();?>index.php/staff/news_view/details/<?php echo $news['news_code'];?>" role="button" class="green" data-toggle="modal"><?php 
													 echo  $slno .") ".$news['title'];
													 $slno++;?>
                                                     </a><?php }?>
                                                 </marquee>
												</div>
											</div>
										</div>
								<div class="row">
									<div class="space-12"></div>

									<div class="col-sm-6 infobox-container">
										<!-- #section:pages/dashboard.infobox -->
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo $this->db->count_all('enroll');?></span>
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
												<span class="infobox-data-number"><?php echo $this->db->count_all('teacher');?></span>
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
												<span class="infobox-data-number"><?php echo $this->db->count_all('staff');?></span>
												<div class="infobox-content">Staff</div>
											</div>
											<!--<div class="stat stat-important">4%</div>-->
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-flask"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo $this->db->count_all('homework');?></span>
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
												<span class="infobox-data-number"><?php echo $this->db->count_all('document');?></span>
												<div class="infobox-content">Study Meterial</div>
											</div>

											
										</div>

										
                                            <div class="infobox infobox-blue">
											 <div class="infobox-icon">
												<i class="ace-icon fa fa-envelope"></i>
											</div>
                                            

											<div class="infobox-data">
                                            
												<span class="infobox-text"><?php 
							$sms = $this->db->get('sms_settings')->row();
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
		 echo $balance;
		?></span>

												<div class="infobox-content">
													<span class="bigger-110"></span>
													Message Balance
												</div>
											</div>
										</div>

										<!-- /section:pages/dashboard.infobox -->
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
                        $present_today      =   $query->num_rows();
						
						 $check1  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '2' );
                        $query = $this->db->get_where('attendance' , $check1);
                        $absent_today      =   $query->num_rows();
                        ?>
												<div class="infobox-content">Absent</div>
												<div class="infobox-content"><?php echo $absent_today;?></div>
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
                        $query = $this->db->get_where('attendance' , $check2);
                        $late_today      =   $query->num_rows();
                        ?>
												<div class="infobox-content">Late</div>
												<div class="infobox-content"><?php echo $late_today;?></div>
											</div>
										</div>

										<!-- /section:pages/dashboard.infobox.dark -->
									</div>

									<div class="vspace-12-sm"></div>

									<div class="col-sm-6 col-xs-6">
                                    <img src="<?php echo base_url(); ?>assets/images/slider 1.jpg" width="500px;" height="250px;">
										<!--<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Traffic Sources
												</h5>

												<div class="widget-toolbar no-border">
													<div class="inline dropdown-hover">
														<button class="btn btn-minier btn-primary">
															This Week
															<i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
															<li class="active">
																<a href="#" class="blue">
																	<i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
																	This Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	This Month
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Month
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<!-- #section:plugins/charts.flotchart 
													<div id="piechart-placeholder"></div>

													<!-- /section:plugins/charts.flotchart
													<div class="hr hr8 hr-double"></div>

													<div class="clearfix">
														<!-- #section:custom/extra.grid 
														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
																&nbsp; likes
															</span>
															<h4 class="bigger pull-right">1,255</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
																&nbsp; tweets
															</span>
															<h4 class="bigger pull-right">941</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
																&nbsp; pins
															</span>
															<h4 class="bigger pull-right">1,050</h4>
														</div>

														<!-- /section:custom/extra.grid 
													</div>
												</div><!-- /.widget-main
											</div><!-- /.widget-body 
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								<!-- #section:custom/extra.hr -->
								<div class="hr hr32 hr-dotted"></div>

								<!-- /section:custom/extra.hr -->
								<div class="row">
									<div class="col-sm-5">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-star orange"></i>
													Birth Day
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Name
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Class
																</th>

																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Status
																</th>
															</tr>
														</thead>

														<tbody>
															<tr>
                                                            <?php
													   $birth_month=date("m");
													  $birth_day=date("d");
															$this->db->select('s.name as student,MONTH(s.birthday) as month,c.name as class,t.name as section');
															$this->db->from('student s');
															$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
															$this->db->join('class c','c.class_id=e.class_id','LEFT');
															$this->db->join('section t','t.section_id=e.section_id','LEFT');
															
															$this->db->where('month(s.birthday)=',$birth_month);
															$this->db->where('DAY(s.birthday)',$birth_day);
															$query=$this->db->get()->result_array();
															foreach($query as $birth_day1){?>
																<td><?php echo $birth_day1['student'];?></td>

																<td>
																	
																
																	<?php echo $birth_day1['class']."-".$birth_day1['section'];?>
																</td>
                                                                


																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">SEND SMS</span>
																</td>
                                                                
															</tr>
                                                            <?php }?>

															
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<!--<div class="col-sm-7">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-signal"></i>
													Sale Stats
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-4">
													<div id="sales-charts"></div>
												</div><!-- /.widget-main 
											</div><!-- /.widget-body 
										</div><!-- /.widget-box 
									</div><!-- /.col 
								</div><!-- /.row -->
                                
                                <!--<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-money"></i>
													Fees Details
												</h5>

												<div class="widget-toolbar no-border">
													<div class="inline dropdown-hover">
														<button class="btn btn-minier btn-primary">
															This Week
															<i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
															<li class="active">
																<a href="#" class="blue">
																	<i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
																	This Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	This Month
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Month
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<!-- #section:plugins/charts.flotchart -->
													<!--<div id="piechart-placeholder"></div>

													<!-- /section:plugins/charts.flotchart-->
													<!--<div class="hr hr8 hr-double"></div>-->

													<!--<div class="clearfix">-->
														<!-- #section:custom/extra.grid -->
														<!--<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
																&nbsp; likes
															</span>
															<h4 class="bigger pull-right">1,255</h4>
														</div>-->

														<!--<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
																&nbsp; tweets
															</span>
															<h4 class="bigger pull-right">941</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
																&nbsp; pins
															</span>
															<h4 class="bigger pull-right">1,050</h4>
														</div>

														<!-- /section:custom/extra.grid -->
													<!--</div>
												</div><!-- /.widget-main-->
											<!--</div><!-- /.widget-body -->
										<!--</div>--><!-- /.widget-box -->
												<!-- /section:plugins/charts.easypiechart -->
										<!--	</div><!-- /.col -->
										<!--</div><!-- -->
									<!--</div>--><!-- /.col -->
								<!--</div>--><!-- /.row -->

								<!--<div class="hr hr32 hr-dotted"></div>

								<div class="row">
									<div class="col-sm-6">
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-user orange"></i>ATTENDANCE
												</h4>
-->
												<!--<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="recent-tab">
														<li class="active">
															<a data-toggle="tab" href="#task-tab">All students</a>
														</li>

														<li>
															<a data-toggle="tab" href="#member-tab">Presents</a>
														</li>

														<li>
															<a data-toggle="tab" href="#comment-tab">Absents</a>
														</li>
													</ul>
												</div>
											</div>-->

											<!--<div class="widget-body">
                                            <div class="space-12"></div>
                                          
                                            
												<div class="widget-main padding-4">
													<div class="tab-content padding-8">
														<div id="task-tab" class="tab-pane active">
                                                        
                                                          <div class="infobox infobox-orange2">-->
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<!--<div class="infobox-chart">
												<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
											</div>-->

											<!-- /section:pages/dashboard.infobox.sparkline -->
											<!--<div class="infobox-data">
												<span class="infobox-data-number">6,251</span>
												<div class="infobox-content">All Students</div>
											</div></div>-->
															<!--<h4 class="smaller lighter green">
																<i class="ace-icon fa fa-list"></i>
																Class wise Count
															</h4>

															 #section:pages/dashboard.tasks 
															<ul id="tasks" class="item-list">
																<li class="item-orange clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl"> Plus two Science</span>
																	</label>

																	<div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">50</span>
																	</div>
																</li>

																<li class="item-red clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl"> Plus two Computer scince</span>
																	</label>
-->
																	<!-- #section:custom/extra.action-buttons -->
															<!--	<<!--div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">56</span>
																	</div>-->

																	<!-- /section:custom/extra.action-buttons -->
																<!--</li>

																<li class="item-default clearfix">
																	<label class="inline">-->
																		<!--<input type="checkbox" class="ace" />
																		<span class="lbl"> Plus two Commerce</span>
																	</label>-->

																	<!-- #section:elements.dropdown.hover -->
																	<!--<div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">54</span>
																	</div>-->

																	<!-- /section:elements.dropdown.hover -->
																<!--</li>

																<li class="item-blue clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl"> Plus one Science</span>
																	</label>
                                                                    <div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">50</span>
																	</div>
																</li>-->

																<!--<li class="item-grey clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl"> Plus one Computer science</span>
																	</label>
                                                                    <div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">54</span>
																	</div>
																</li>

																<li class="item-green clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl">Plus one Commerce</span>
																	</label>
                                                                    <div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">55</span>
																	</div>
																</li>
-->
																<!--<li class="item-pink clearfix">
																	<label class="inline">
																		<input type="checkbox" class="ace" />
																		<span class="lbl"> SSCLC</span>
																	</label>
                                                                    <div class="pull-right easy-pie-chart percentage" data-size="30" data-color="#ECCB71" data-percent="42">
																		<span class="percent">45</span>
																	</div>
																</li>
															</ul>-->

															<!-- /section:pages/dashboard.tasks -->
														<!--</div>

														<div id="member-tab" class="tab-pane">
															<!-- #section:pages/dashboard.members -->
                                                            
															<!--<div class="clearfix">
																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Bob Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/user.jpg" />
																	</div>-->

																	<!--<div class="body">
																		<div class="name">
																			<a href="#">Bob Doe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">20 min</span>
																		</div>

																		<div>-->
																			<!--<<!--span class="label label-warning label-sm">pending</span>

																			<div class="inline position-relative">
																				<button class="btn btn-minier btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown" data-position="auto">
																					<i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
																				</button>

																				<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																					<li>-->
																						<!--<a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
																						</a>
																					</li>-->

																					<!--<li>
																						<a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
																						</a>
																					</li>
-->
																					<!--<li>
																						<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
																						</a>
																					</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>-->

																<!--<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Joe Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar2.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Joe Doe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">1 hour</span>
																		</div>-->

																		<!--<div>
																			<span class="label label-warning label-sm">pending</span>

																			<div class="inline position-relative">
																				<button class="btn btn-minier btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown" data-position="auto">
																					<i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
																				</button>

																				<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																					<li>-->
																						<!--<a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
																						</a>
																					</li>

																					<li>
																						<a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
																						</a>
																					</li>

																					<li>-->
																						<!--<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
																						</a>
																					</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>-->

																<!--<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Jim Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Jim Doe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">2 hour</span>
																		</div>

																		<div>-->
																			<!--<span class="label label-warning label-sm">pending</span>

																			<div class="inline position-relative">
																				<button class="btn btn-minier btn-yellow btn-no-border dropdown-toggle" data-toggle="dropdown" data-position="auto">
																					<i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
																				</button>

																				<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																					<li>-->
																						<!--<a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
																							<span class="green">
																								<i class="ace-icon fa fa-check bigger-110"></i>
																							</span>
																						</a>
																					</li>

																					<li>
																						<a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
																							<span class="orange">
																								<i class="ace-icon fa fa-times bigger-110"></i>
																							</span>
																						</a>
																					</li>

																					<li>
																						<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																							<span class="red">
																								<i class="ace-icon fa fa-trash-o bigger-110"></i>
																							</span>
																						</a>
																					</li>-->
																				<!--</ul>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Alex Doe's avatar" src="<?php //echo base_url(); ?>/assets/avatars/avatar5.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Alex Doe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">3 hour</span>
																		</div>

																		<div>
																			<span class="label label-danger label-sm">blocked</span>
																		</div>-->
																	<!--</div>
																</div>

																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Bob Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar2.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Bob Doe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">6 hour</span>
																		</div>

																		<div>
																			<span class="label label-success label-sm arrowed-in">approved</span>
																		</div>
																	</div>-->
																<!--</div>

																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Susan's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar3.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Susan</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">yesterday</span>
																		</div>

																		<div>
																			<span class="label label-success label-sm arrowed-in">approved</span>
																		</div>
																	</div>
																</div>

																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Phil Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar4.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Phil Doe</a>
																		</div>-->

																		<!--<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">2 days ago</span>
																		</div>

																		<div>
																			<span class="label label-info label-sm arrowed-in arrowed-in-right">online</span>
																		</div>
																	</div>
																</div>

																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Alexa Doe's avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar1.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Alexa Doe</a>
																		</div>-->

																		<!--<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">3 days ago</span>
																		</div>

																		<div>
																			<span class="label label-success label-sm arrowed-in">approved</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="center">
																<i class="ace-icon fa fa-users fa-2x green middle"></i>

																&nbsp;
																<a href="#" class="btn btn-sm btn-white btn-info">
																	See all members &nbsp;
																	<i class="ace-icon fa fa-arrow-right"></i>
																</a>
															</div>-->

															<!--<div class="hr hr-double hr8"></div>-->

															<!-- /section:pages/dashboard.members -->
														<!--</div><!-- /.#member-tab -->

														<!--<div id="comment-tab" class="tab-pane">
															<!-- #section:pages/dashboard.comments -->
															<!--<div class="comments">
																<div class="itemdiv commentdiv">
																	<div class="user">
																		<img alt="Bob Doe's Avatar" src="<?php// echo base_url(); ?>assets/avatars/avatar.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Bob Doe</a>
																		</div>-->


																	<!--	<div class="time">-->
																		<!--	<i class="ace-icon fa fa-clock-o"></i>
																			<span class="green">6 min</span>
																		</div>

																		<div class="text">
																			<i class="ace-icon fa fa-quote-left"></i>
																			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
																		</div>
																	</div>-->

																<!--	<div class="tools">
																		<div class="inline position-relative">
																			<button class="btn btn-minier bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="ace-icon fa fa-angle-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																				<li>-->
																					<!--<a href="#" class="tooltip-success" data-rel="tooltip" title="Approve">
																						<span class="green">
																							<i class="ace-icon fa fa-check bigger-110"></i>
																						</span>
																					</a>
																				</li>

																				<li>-->
																					<!--<a href="#" class="tooltip-warning" data-rel="tooltip" title="Reject">
																						<span class="orange">
																							<i class="ace-icon fa fa-times bigger-110"></i>
																						</span>
																					</a>
																				</li>

																				<li>-->
																					<!--<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="ace-icon fa fa-trash-o bigger-110"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>-->

																<!--<div class="itemdiv commentdiv">
																	<div class="user">
																		<img alt="Jennifer's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar1.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Jennifer</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="blue">15 min</span>
																		</div>

																		<div class="text">
																			<i class="ace-icon fa fa-quote-left"></i>
																			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
																		</div>
																	</div>-->

																	<!--<div class="tools">
																		<div class="action-buttons bigger-125">
																			<a href="#">
																				<i class="ace-icon fa fa-pencil blue"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-trash-o red"></i>
																			</a>
																		</div>
																	</div>
																</div>-->

																<!--<div class="itemdiv commentdiv">
																	<div class="user">
																		<img alt="Joe's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar2.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Joe</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="orange">22 min</span>
																		</div>
-->
																		<!--<div class="text">
																			<i class="ace-icon fa fa-quote-left"></i>
																			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
																		</div>
																	</div>

																	<div class="tools">
																		<div class="action-buttons bigger-125">
																			<a href="#">
																				<i class="ace-icon fa fa-pencil blue"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-trash-o red"></i>
																			</a>
																		</div>
																	</div>
																</div>
-->
																<!--<div class="itemdiv commentdiv">
																	<div class="user">
																		<img alt="Rita's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar3.png" />
																	</div>

																	<div class="body">
																		<div class="name">
																			<a href="#">Rita</a>
																		</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o"></i>
																			<span class="red">50 min</span>
																		</div>
-->
																		<!--<div class="text">
																			<i class="ace-icon fa fa-quote-left"></i>
																			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis &hellip;
																		</div>
																	</div>

																	<div class="tools">
																		<div class="action-buttons bigger-125">
																			<a href="#">
																				<i class="ace-icon fa fa-pencil blue"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-trash-o red"></i>
																			</a>
																		</div>
																	</div>
																</div>
															</div>-->

															<!--<div class="hr hr8"></div>

															<div class="center">
																<i class="ace-icon fa fa-comments-o fa-2x green middle"></i>

																&nbsp;
																<a href="#" class="btn btn-sm btn-white btn-info">
																	See all comments &nbsp;
																	<i class="ace-icon fa fa-arrow-right"></i>
																</a>
															</div>

															<div class="hr hr-double hr8"></div>

															<!-- /section:pages/dashboard.comments -->
														<!--</div>
													</div>
												</div><!-- /.widget-main -->
											<!--</div>--><!-- /.widget-body -->
										<!--</div>--><!-- /.widget-b-->
									<!--</div>--><!-- /.col --

									<div class="col-sm-6">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-comment blue"></i>
													Conversation
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<!-- #section:pages/dashboard.conversations -->
													<!--<div class="dialogs">
														<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Alexa's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar1.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="green">4 sec</span>
																</div>-->

																<!--<div class="name">
																	<a href="#">Alexa</a>
																</div>
																<div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

																<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>-->
														<!--</div>

														<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="John's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="blue">38 sec</span>
																</div>-->

																<!--<div class="name">
																	<a href="#">John</a>
																</div>
																<div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

																<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>
-->
														<!--<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Bob's Avatar" src="<?php //echo base_url(); ?>assets/avatars/user.jpg" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="orange">2 min</span>
																</div>-->

																<!--<div class="name">
																	<a href="#">Bob</a>
																	<span class="label label-info arrowed arrowed-in-right">staff</span>
																</div>
																<div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>

																<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>-->

														<!--<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Jim's Avatar" src="<?php// echo base_url(); ?>assets/avatars/avatar4.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="grey">3 min</span>
																</div>
-->
																<!--<div class="name">
																	<a href="#">Jim</a>
																</div>
																<div class="text">Raw denim you probably haven&#39;t heard of them jean shorts Austin.</div>

																<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>-->

														<!--<div class="itemdiv dialogdiv">
															<div class="user">
																<img alt="Alexa's Avatar" src="<?php //echo base_url(); ?>assets/avatars/avatar1.png" />
															</div>

															<div class="body">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="green">4 min</span>
																</div>
-->
																<!--<div class="name">
																	<a href="#">Alexa</a>
																</div>
																<div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>

																<div class="tools">
																	<a href="#" class="btn btn-minier btn-info">
																		<i class="icon-only ace-icon fa fa-share"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>-->

													<!-- /section:pages/dashboard.conversations -->
													<!--<form>
														<div class="form-actions">
															<div class="input-group">
																<input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
																<span class="input-group-btn">
																	<button class="btn btn-sm btn-info no-radius" type="button">
																		<i class="ace-icon fa fa-share"></i>
																		Send
																	</button>
																</span>
															</div>
														</div>
													</form>
                                                    <div class="hr hr-18 dotted hr-double"></div>-->

								
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								<!-- PAGE CONTENT ENDS -->
							<!-- /.col -->
						<!-- /.row -->
					<!-- /.page-content -->
			
            <!-- /.main-content -->

			<?php include_once APPPATH . 'views/footer.php'; ?>
	
</html>

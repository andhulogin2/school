<?php include_once APPPATH . 'views/head.php';?>


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
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
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
								
									<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">News</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
                                                <marquee dir="rtl" >
													<?php $this->db->select('news_code,title');
													$this->db->from('news');
													$this->db->order_by('news_status','desc');
													$query=$this->db->get()->result_array();
													$slno=1;
													 foreach($query as $news){
													 ?>
													 <a href="<?php echo base_url();?>index.php/admin/news_view/details/<?php echo $news['news_code'];?>" role="button" class="green" data-toggle="modal"><?php 
													 echo  $slno .") ".$news['title'];
													 $slno++;?>
                                                     </a><?php }?>
                                                 </marquee>
												</div>
											</div>
										</div>
								<div class="row">
									

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
 <!--<div class="table-responsive">-->
									<div class="vspace-12-sm"></div>
<div class="vspace-12-sm"></div>
									<div class="col-md-6 col-md-12">
                                    <img src="<?php echo base_url(); ?>assets/images/slider 1.jpg" class="img-responsive">
										
									</div><!-- /.col -->
								
                                </div>
                                <!--</div>--><!-- /.row -->

								<!-- #section:custom/extra.hr -->
								<div class="hr hr32 hr-dotted"></div>

								<!-- /section:custom/extra.hr -->
								<div class="row" style="padding-left:20px">
                                <?php echo form_open(base_url() . 'index.php/admin/birthday_message/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

									<div class="col-md-5">
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
													        $birth_month=date("m/d");
													  //$birth_day=date("d");
															$this->db->select('s.student_id,s.name as student,s.birthday as month,c.name as class,t.name as section');
															$this->db->from('student s');
															$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
															$this->db->join('class c','c.class_id=e.class_id','LEFT');
															$this->db->join('section t','t.section_id=e.section_id','LEFT');
															
															//$this->db->where('month(s.birthday)=',$birth_month);
															//$this->db->where('DAY(s.birthday)',$birth_day);
															$query=$this->db->get()->result_array();
															
															foreach($query as $birth_day1){
															$unixtime = strtotime($birth_day1['month']);
                                                            $time = date("m/d",$unixtime);
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
                                                        <div class="row" align="right">
                                                        Message:&nbsp;<input type="text" name="wish_message" value="<?php echo $v;?>" style="width:300px;"/>
                                                        <?php }else
							  {?>
                            <input type="text"  name="wish_message" value="" style="display: none">
							 <?php } ?>
                                                      <button type="submit" class="btn btn-sm btn-yellow" onClick="preloader()">
   <i class="ace-icon fa fa-check"></i>
  SEND SMS
 </button></div>
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
</div></div></div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 

<script type="text/javascript">  
   $(window).load(function() {  
      $("#loader").fadeOut(1000);  
   });
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


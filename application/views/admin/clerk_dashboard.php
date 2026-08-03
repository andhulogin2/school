<?php
$role=$this->session->userdata('role');
  include_once APPPATH . 'views/main_head.php';  
$running_year = get_running_year();?>

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
 <?php $sms = $this->db->get('sms_settings')->row();
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
		 // $sms_balance	=	count($handle);
		
		if($balance <=1000){ ?><script>alert("Low SMS Alert. You Have Only "+<?php echo $balance;?>+" SMS Left In Your SMS Balance Please Contact 0497 276 46 26 for Refill")</script><?php }?></div>
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
												
												echo $this->db->select('count(s.student_id) as student_count');
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
															$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
															$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
															$this->db->where('a.collected_by',$this->session->userdata('login_user_id'));
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
																$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
																$this->db->where('a.entered_by',$this->session->userdata('login_user_id'));
															$this->db->from('tbl_special_fee_collection_master a');
															$this->db->where('a.date_paid',date('Y-m-d'));
															$this->db->where('a.academic_year_id',$year);
															$special_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
														if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
														{
															$this->db->select('SUM(a.amount_paid) as fee_amount');
															$this->db->join('tbl_transport_students_bus_fee_collection_master b','b.bus_fee_collection_master_id = a.bus_fee_collection_master_id');
																$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
																$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
																$this->db->where('a.entered_by',$this->session->userdata('login_user_id'));
															$this->db->from('view_transport_students_bus_fee_collection_details a');
															$this->db->where('a.date_paid',date('Y-m-d'));
															$this->db->where('b.academic_year',$year);
															$transport_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
														}
														$tot				=	$special_fee+$transport_fee+$fee;
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
										<?php
										}
									}
									?>

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
								</div></div></div></div></body>
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


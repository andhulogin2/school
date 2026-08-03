<?php include_once APPPATH . 'views/library_head.php';?>


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
                        
                         
 <div style="position:absolute; z-index:2;">
<?php /*?> <?php $sms = $this->db->get('sms_settings')->row();
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
		
		if($balance <=1000){ ?><script>alert("Low SMS Alert. You Have Only "+<?php echo $balance;?>+" SMS Left In Your SMS Balance Please Contact 0497 276 46 26 for Refill")</script><?php }?>
<?php */?>        </div>
						<div class="row">
							<div class="col-xs-12">
								
									<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">News</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
                                                <marquee dir="rtl" >
                                              
													<?php
													  $role=$this->session->userdata('role');
													  $branch=$this->session->userdata('branch_id');
													   $dept=$this->session->userdata('dept_id');
													   $this->db->select('news_code,title');
													   if($role==3)
													{
													$this->db->where('branch_id',$branch_id);
													}
													if($role==4)
													{
													$this->db->where('branch_id',$branch_id);
													$this->db->where('dept_id',$dept);
													}
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
									
<?php //echo $this->session->userdata('dept_id'); ?>
									<div class="col-sm-6 infobox-container">
										<!-- #section:pages/dashboard.infobox -->
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(book_details_id) as book_count');
												$this->db->where('is_deleted','N');
												$query=$this->db->get('tbl_lib_book_details')->row();
												echo $query->book_count;?></span>
												<div class="infobox-content">Total Books</div>
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
												
												 $this->db->select('count(book_details_id) as book_count');
												$this->db->where('is_deleted','N');
												$this->db->where('is_available','Y');
												$query=$this->db->get('tbl_lib_book_details')->row();
												echo $query->book_count;?></span>
												<div class="infobox-content">Available Books</div>
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
												
												 $this->db->select('count(issue_id) as book_count');
												$this->db->where('is_available','N');
												$this->db->where('return_date',date('Y-m-d'));
												$query=$this->db->get('tbl_lib_issue_master')->row();
												echo $query->book_count;?></span>
												<div class="infobox-content">Due Books</div>
											</div>
											<!--<div class="stat stat-important">4%</div>-->
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-flask"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php $role=$this->session->userdata('role');
												
												 $this->db->select('count(issue_id) as book_count');
												$this->db->where('is_available','N');
												$this->db->where('return_date<=',date('Y-m-d'));
												$query=$this->db->get('tbl_lib_issue_master')->row();
												echo $query->book_count;?></span>
												<div class="infobox-content">Over Due Books</div>
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
												
												 $this->db->select('count(issue_id) as book_count');
												$this->db->where('is_available','N');
												$this->db->where('	issued_date',date('Y-m-d'));
												$query=$this->db->get('tbl_lib_issue_master')->row();
												echo $query->book_count;?></span>
												<div class="infobox-content">Issued Books</div>
											</div>

											
										</div>

										
                                            <div class="infobox infobox-blue">
											 <div class="infobox-icon">
												<i class="ace-icon fa fa-envelope"></i>
											</div>
                                            

											<div class="infobox-data">
                                            
												<span class="infobox-text">
												<?php 
//							$sms = $this->db->get('sms_settings')->row();
//		$sender_id = $sms->sender_id;
//		$username = $sms->username;
//		$password = $sms->password;
//		$common = $sms->common_word;
//		$url = $sms->url;
//							// $api = 'http://bulksms.login2itsolutions.com';
//		//$api = 'http://sms4add.in';
//		$api = $url;
//		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
//		$balance = stream_get_contents($handle);
//		 echo $balance;
		?>
        </span>

												<div class="infobox-content">
													<span class="bigger-110"></span>
													Message Balance
												</div>
											</div>
										</div>

										<!-- /section:pages/dashboard.infobox -->
										<div class="space-6"></div>

										<!-- #section:pages/dashboard.infobox.dark -->
										

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


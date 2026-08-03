<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Login2 school</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colorpicker.css" />

        
<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url(); ?>assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="/assets/js/html5shiv.js"></script>
		<script src="/assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
 <!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default ace-save-state">
			

			<div class="navbar-container ace-save-state" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="<?php echo base_url(); ?>" class="navbar-brand">
						<small>
							<img src="<?php echo base_url();?>uploads/logo.png" style="max-height : 40px;"></b><span class="hidden-xs"><strong></strong></span>
							Login2 School
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey">
							<!--<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>-->
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-comments-o icon-animated-bell"></i>
								<span class="badge badge-important"><?php $this->db->select('count(report_id) as id');
								$this->db->from('reporte_alumnos');
								$count=$this->db->get()->result_array();
								foreach($count as $count1){
								echo $count1['id'];}?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									Compliants
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="<?php echo base_url(); ?>index.php/Admin/view_complaints">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
													 Complaints
													</span>
													<span class="pull-right badge badge-info">+<?php $this->db->select('count(report_id) as id');
								$this->db->from('reporte_alumnos');
								$count=$this->db->get()->result_array();
								foreach($count as $count1){
								echo $count1['id'];}?></span>
												</div>
											</a>
										</li>

										
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php $this->db->select('count(enquiry_id) as id');
								$this->db->from('enquiry');
								$count=$this->db->get()->result_array();
								foreach($count as $count1){
								echo $count1['id'];}?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									 Enquiry
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="<?php echo base_url(); ?>index.php/Admin/view_enquiry">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
													  Enquiry
													</span>
													<span class="pull-right badge badge-info">+<?php $this->db->select('count(enquiry_id) as id');
								$this->db->from('enquiry');
								$count=$this->db->get()->result_array();
								foreach($count as $count1){
								echo $count1['id'];}?></span>
												</div>
											</a>
										</li>

										
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all enquireis
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small><b><?php
									$staff=$this->session->userdata('login_user_id');
									$this->db->select('name');
									$this->db->from('staff');
									$this->db->where('user_id',$staff);
									$query=$this->db->get()->row();
									
                        echo $query->name; ?></b></small>
								
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									 <?php
                echo anchor('Login/logout/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Logout</span>');
                ?>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
        
        <div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
    <li class="">
        <?php
                echo anchor('staff/staff_dashboard/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Dashboard</span>');
                ?>


        <b class="arrow"></b>
    </li>
   
    
    
     	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-search"></i>
							<span class="menu-text"> Students View </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						 <ul class="submenu">
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li> <a href="<?php echo base_url(); ?>index.php/staff/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                             <?php endforeach; ?>
                        </ul>
                    </li>

							
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Attendance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('staff/full_attendance/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Full Attendance</span>');
                ?>
								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/daily_attendance/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Daily Attendance</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/attendance_report/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');
                ?>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-graduation-cap"></i>
							<span class="menu-text"> Exam </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('staff/create_exam/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Create Exam</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/upload_marks/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Upload Marks</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/grade/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Grade</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('staff/rank/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Rank</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/tab_sheet/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Report</span>');
                ?>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> SMS </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('staff/message/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Message</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('staff/sms_template', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS Template</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<?php
                echo anchor('staff/add_template', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Template</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<?php
                echo anchor('staff/report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Delivery Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-graduation-cap"></i>
							<span class="menu-text"> Class </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								 <?php
                echo anchor('staff/view_class/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Classes</span>');
                ?>

								<b class="arrow"></b>
							</li>
                          


							<li class="">
								 <?php
                echo anchor('staff/section/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Division</span>');
                ?>
								<b class="arrow"></b>
							</li>

							

							
						</ul>
					</li>
                    
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Subject </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li> <a href="<?php echo base_url(); ?>index.php/staff/view_subject/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                             <?php endforeach; ?>
                        </ul>
                    </li>
                    
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-newspaper-o"></i>
							<span class="menu-text"> News </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('staff/news_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add News</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('staff/news/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View News</span>');
                ?>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Homework </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('staff/homework_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('staff/homework/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    
                     <li class="">
						<?php
                echo anchor('staff/study_material/', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Study Meterials</span>');
                ?>
					</li>
                    
                     
                    
                     
                    
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Fee Details </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="profile.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Student Details
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="inbox.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Fee heads
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="pricing.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Fee master
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="invoice.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Installment Fee Master
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="timeline.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Assign fee
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="email.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Student Payment
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Course Fee Details
								</a>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Fee Due Report
								</a>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Fee - Abstract Report
								</a>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Fee - Detailed Report
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
                    
                    <li class="">
						<?php
                echo anchor('staff/view_complaints/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Complaints</span>');
                ?>
					</li>
                    
                     <li class="">
						<?php
                echo anchor('staff/view_enquiry/', '<i class="menu-icon fa fa-envelope"></i><span>&nbsp;View Enquiry</span>');
                ?>
					</li>

					

						</ul>
					
					</li>
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
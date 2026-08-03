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

						
						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php  echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="user-img" width="36" class="img-circle" />
								<span class="user-info">
									<small><b><?php
									$admin=$this->session->userdata('login_user_id');
									$this->db->select('username');
									$this->db->from('tbl_users');
									$this->db->where('user_id',$admin);
									$query=$this->db->get()->row();
									
                        echo $query->username; ?></b></small>
									
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
                echo anchor('Class_teacher/Class_teacher_dashboard/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Dashboard</span>');
                ?>


        <b class="arrow"></b>
    </li>
<?php  if($this->db->get_where('settings' , array('type' =>'admission'))->row()->description == 'yes') {?>        
     <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text">
                Admission
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
                <?php
                echo anchor('Class_teacher/student_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Student</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>
            </li>
            
            <li class="">
                <?php
                echo anchor('Class_teacher/student_bulk/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Student Bulk</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>
            </li>
            
            <li class="">
                <?php
                echo anchor('Class_teacher/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import From Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>
            </li>
            
       </ul>
  </li>
<?php } ?>  
  
        <li class="">
            <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-pencil-square-o"></i>
            <span class="menu-text"> Student </span>
            
            <b class="arrow fa fa-angle-down"></b>
            </a>
            
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                <?php
                echo anchor('Class_teacher/student_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Class</span>');
                ?>
                <b class="arrow"></b>
                </li>
                
                <li class="">
                <?php
                echo anchor('Class_teacher/student_view_subject/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Subject</span>');
                ?>
                <b class="arrow"></b>
                </li>
                
							<li class="">
								<?php
                echo anchor('Admin/message/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS</span>');
                ?>

								<b class="arrow"></b>
							</li>

                <li class="">
                <?php
                echo anchor('Class_teacher/send_message_students/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Send Messages</span>');
                ?>
                <b class="arrow"></b>
                </li>

                <li class="">
                <?php
                echo anchor('Class_teacher/view_send_messages/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Send Messages</span>');
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
                echo anchor('Class_teacher/upload_marks/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Class</span>');
                ?>

								<b class="arrow"></b>
							</li> 
                            
                            <li class="">
								<?php
                echo anchor('Class_teacher/upload_marks_subject/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Subject</span>');
                ?>

								<b class="arrow"></b>
							</li>
							

					<!--		<li class="">
								<?php
                echo anchor('Class_teacher/upload_marks/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Upload Marks</span>');
                ?>

								<b class="arrow"></b>
							</li> -->

							<li class="">
                            	<a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-pencil-square-o"></i>
                                    <span class="menu-text"> Report </span>
        
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                
        
                                <ul class="submenu">
                                    <li class="">
                                        <?php
										echo anchor('Class_teacher/tab_sheet_class/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Class</span>');
                        ?>
        
                                        
                                    </li>
                                    
                                    <li class="">
                                        <?php
                        echo anchor('Class_teacher/tab_sheet/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;My Subject</span>');
                        ?>
        
                                        <b class="arrow"></b>
                                    </li>
        
                                </ul>
							</li>

							
						</ul>
					</li>
                    
 <?php  if($this->db->get_where('settings' , array('type' =>'homework'))->row()->description == 'yes') {?>    
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
                echo anchor('Class_teacher/homework_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('Class_teacher/homework/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>


                    
 <?php   if($this->db->get_where('settings' , array('type' =>'study_meterial'))->row()->description == 'yes') {?>                      
     <li class="">
                 <?php
                echo anchor('Class_teacher/study_material/', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Study Materials</span>');
                ?>
        <b class="arrow"></b>
    </li>
<?php } ?>


                 <?php }  if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes') {?>        
					
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
                echo anchor('Class_teacher/daily_attendance/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Daily Attendance</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('Class_teacher/attendance_report/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
         <?php } ?>
                    
                    

	
                
            
            
            <?php  if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes') {?>        
					
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Hourely Attendance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							

							<li class="">
								<?php
      echo anchor('Hourly_attendance/mark_hourly_attendance', '<i class="menu-icon fa fa-desktop"></i><span>&nbsp;Hourly Attendance</span>');                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
echo anchor('Hourly_attendance/view_hourly_attendance', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Hourly Attendance</span>');                ?>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
         <?php } ?>
                    
            
            
      
   <!-- 
    <li class="">
        <?php
                echo anchor('Class_teacher/message/', '<i class="menu-icon fa fa-envelope"></i><span>&nbsp;Message</span>');
                ?>


        <b class="arrow"></b>
    </li>
    -->
    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

					
					
					
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
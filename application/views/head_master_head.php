<?php
error_reporting(0);
//$admin=$this->session->userdata('login_user_id');

if(!isset($_SESSION['login_user_id']))
 redirect(base_url(), 'refresh');

defined('BASEPATH') OR exit('No direct script access allowed');
    $rtl          = get_setting('rtl');

?><!DOCTYPE html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - <?php echo get_setting('header_title', 'School Management System'); ?></title>

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
<?php if ($rtl == 'rtl') { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-rtl.css" />
<?php } ?>
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
     
<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
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
					<a href="<?php echo base_url();?>index.php/admin/index" class="navbar-brand">
						<small>
							<b><img src="<?php echo base_url();?>uploads/logo.png" style="max-height : 40px;"></b><span class="hidden-xs"><strong></strong></span>
							<?php echo $this->db->get_where('settings',array('type'=>'header_title'))->row()->description; ?>
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
                    
				</div>
  



				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation" >
					<ul class="nav ace-nav" >
						<li class="grey">
							
                            
                            <div class="nav-search pull right" id="nav-search" style="padding-top:10px;">
						<?php echo form_open(base_url() . 'index.php/admin/search' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
									<i class="ace-icon fa fa-search nav-search-icon" ></i>
								</span>
				<?php echo form_close(); ?>
						</div>
						</li>
                        
                        

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">
                                <?php 
								$this->db->select('enquiry_id as id');
								$this->db->from('enquiry');
								$count1=$this->db->get()->result_array();
								
								$this->db->select('report_id as id');
								$this->db->from('reporte_alumnos');
								$count2=$this->db->get()->result_array();
								
							    $this->db->select('enquiry_id as id');
								$this->db->from('enquiry');
								$count3=$this->db->get()->result_array();
								
								$count=count($count1)+count($count2)+count($count3);
								echo $count;
								
								?>
                                
                                </span>
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
                                
                                
                                <li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									 Complaints
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
                                

								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									 Sms Notification
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="<?php echo base_url(); ?>index.php/Admin/view_enquiry">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
													   Sms Notification
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
                                
							</ul>
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
									<?php
                echo anchor('Admin/general_settings/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Settings</span>');
                ?>
								</li>

								<li>
									<?php
									$this->db->where('user_id',$admin);
									$staff_profile=$this->db->get('staff')->row();
                echo anchor('Admin/staff_profile/'.$staff_profile->staff_id, '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Profile</span>');
                ?>
								</li>
                                <li>
									 <?php
                echo anchor('Admin/reset_password/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Reset Password</span>');
                ?>
								</li>

								<li class="divider"></li>

								<li>
									 <?php
                echo anchor('Login/logout/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Logout</span>');
                ?></li></ul></li></ul></div></div></div></body>
								
        
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
						 <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/Admin/daily_attendance/" title="Daily Attendace" >
							<i class="ace-icon fa fa-bar-chart">  </i>
                            </a>

							<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Admin/message/" title="Message" >
							<i class="ace-icon fa fa-envelope">  </i>
                            </a>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<a class="btn btn-warning" href="<?php echo base_url(); ?>index.php/Admin/report/" title="Delivery Report" >
							<i class="ace-icon fa fa-book">  </i>
                            </a>

						<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/FeeManagement/student_payment/" title="Pay Fees" >
							<i class="ace-icon fa fa-money">  </i>
                            </a>
                        

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
                echo anchor('Admin/index/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Dashboard</span>');
                ?>


        <b class="arrow"></b>
    </li>
    
   
    
    
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
                echo anchor('Admin/student_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Student</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <li class="">
                <?php
                echo anchor('Admin/student_bulk/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Student Bulk</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <?php  $role	=$this->session->userdata('role');
						if($role==4)
						{?>
            <li class="">
                <?php
                echo anchor('Admin/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import From Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <?php } ?>
            <!-- <li class="">
                <?php
                echo anchor('Admin/teacher_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Teacher</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
            
           <!-- <li class="">
                <?php
                echo anchor('Admin/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import To Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
        </ul>
    </li>
                    <li class="">
								<?php
                echo anchor('Admin/student_veiw/', '<i class="menu-icon fa fa-search"></i><span>&nbsp;Students</span>');
                ?>
								<b class="arrow"></b>
							</li>
           
                       
                       
                       <?php if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes')
					   {?>
     <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-bar-chart"></i>
            <span class="menu-text">  Attendance  </span> <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
     
	  <?php  if($role==1){?>
  <li class="">
                <?php
				 echo anchor('Hourly_attendance/set_week_days/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Set Week Days</span>');
              
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
        
              
            
             <li class="">
                <?php
                echo anchor('Hourly_attendance/set_class_timing/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Set Class Timing</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
              <?php }
              
              if($role==1|| $role==2 || $role==3 || $role==4){?>
              
                   
            
                   
                   
                   <li class="">
                <?php
                echo anchor('Hourly_attendance/mark_hourly_attendance', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
           
            <li class="">
                <?php
                echo anchor('Hourly_attendance/view_hourly_attendance', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Attendance</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
            
            
              <li class="">
                <?php
                 echo anchor('Hourly_attendance/set_working_days/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Set Holidays</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
                   
            
            <li class="">
                <?php
                echo anchor('Hourly_attendance/attendance_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
            
            <?php }?> 
            
       </ul>
    </li>
    <?php }?> 
                  
                  
                  <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
					   {?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bar-chart"></i>
							<span class="menu-text"> Attendance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                        <?php if($this->db->get_where('settings' , array('type' =>'full_attendance'))->row()->description == 'yes')
					   {?>
							<li class="">
								<?php
                echo anchor('Admin/full_attendance/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Full Attendance</span>');
                ?>
								<b class="arrow"></b>
							</li>
                            <?php }?>

							<li class="">
								<?php
                echo anchor('Admin/daily_attendance/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Daily Attendance</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('Admin/attendance_report/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');
                ?>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    <?php } ?>
                    
                    
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
                echo anchor('Admin/view_exam/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Create Exam</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('Admin/upload_marks/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Upload Marks</span>');
                ?>

								<b class="arrow"></b>
							</li>
				<?php
				if($this->db->get_where('settings' , array('type' =>'home_test'))->row()->description == 'yes')
				{ 
				?>			

							 <li class="">
								<?php
								
                echo anchor('Admin/view_home_test/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Home Test</span>');
                ?>

								<b class="arrow"></b>
							</li>
				<?php
				}
				?>			
							
				<?php
				if($this->db->get_where('settings' , array('type' =>'entrance_test'))->row()->description == 'yes')
				{ 
				?>			

							 <li class="">
								<?php
								
                echo anchor('Admin/view_entrance_test/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Entrance Test</span>');
                ?>

								<b class="arrow"></b>
							</li>
				<?php
				}
				?>			
							

							<li class="">
								<?php
                echo anchor('Admin/grade/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Grade</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <?php if($this->db->get_where('settings' , array('type' =>'rank'))->row()->description == 'yes')
					   {?>
                            <li class="">
								<?php
                echo anchor('Admin/rank/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Rank</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <?php } ?>

							<li class="">
								<?php
                echo anchor('Admin/tab_sheet/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Report</span>');
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
                echo anchor('Admin/message/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Message</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('admin/sms_template', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS Template</span>');
                ?>

								<b class="arrow"></b>
							</li>
                           
                            <li class="">
								<?php
                echo anchor('admin/report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Delivery Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                             <li class="">
								<?php
                echo anchor('admin/sms_settings', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS Settings</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<?php
                echo anchor('admin/sms_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp; SMS Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                             <li class="">
								<?php
                echo anchor('admin/sms_que_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp; SMS Que Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                             <li class="">
								<?php
               echo anchor('Admin/view_student_group/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Groups</span>');
                ?>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
                       
                       
                       



 

  <?php  if($this->db->get_where('settings' , array('type' =>'expense'))->row()->description == 'yes')
					   {?>
 <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog"></i>
							<span class="menu-text"> Expense </span>
						</a>
                        <b class="arrow"></b>

						<ul class="submenu">

							
                            
                            
                            <li class="">
								<?php
                echo anchor('Admin/add_expense/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add expense</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            
                            

                             
                             
    
            <li class="">
                <?php
                echo anchor('Admin/view_expense/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View expense</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
              
                       
            <li class="">
								<?php
                echo anchor('Admin/view_expense_category/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Expense Category</span>');
                ?>

								<b class="arrow"></b>
							</li>
                       
           
    
    
</ul>
</li>
<?php }?>
  <?php if($this->db->get_where('settings' , array('type' =>'news'))->row()->description == 'yes')
					   {?>
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
                echo anchor('Admin/news_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add News</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('Admin/news/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View News</span>');
                ?>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    
                    <?php } ?>
                    <?php  if($this->db->get_where('settings' , array('type' =>'homework'))->row()->description == 'yes')
					   {?>
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
                echo anchor('Admin/homework_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('Admin/homework_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    <?php }?>
                    <?php  if($this->db->get_where('settings' , array('type' =>'study_meterial'))->row()->description == 'yes')
					   {?>
                      <li class="">
        <a href="#" class="dropdown-toggle">
           <i class="menu-icon fa fa-file-text"></i>
            <span class="menu-text">
                Study Material
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            <li class="">
               <?php
                echo anchor('Admin/study_material_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Study Materials</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <li class="">
                <?php
                echo anchor('Admin/study_materials_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Study Materials</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
        
        </ul>
    </li>
                    <?php } ?>

                       
                       
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
                echo anchor('Admin/view_class/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Classes</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                             


							<li class="">
								 <?php
                echo anchor('Admin/section/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Division</span>');
                ?>
								<b class="arrow"></b>
							</li>

							<li class="">
								 <?php 
               // echo anchor('Admin/class_migration/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Class-Migrate</span>');
                ?>
								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    
                   
							
                            
                            
                            
                            
                            
                             <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Subjects </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
								echo anchor('Admin/subjects_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Subject</span>');
								?>
								<b class="arrow"></b>
							</li>
                            
                           

						</ul>
					</li>
                            
                            
                            
                            
    
    
     
                    <?php if($this->db->get_where('settings' , array('type' =>'complaint_view'))->row()->description == 'yes')
					   {?>
                    <li class="">
						<?php
                echo anchor('Admin/view_complaints/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Complaints</span>');
                ?>
					</li>
                    <?php } ?>
                    <?php if($this->db->get_where('settings' , array('type' =>'enquiry_view'))->row()->description == 'yes')
					   {?>
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Course Enquiry </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

                        <b class="arrow"></b>

						<ul class="submenu">
                        <?php if($this->session->userdata('role')==4)
								{?>
							<li class="">
								<?php
								
                echo anchor('enquiry_controller/enquiry/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Enquiry</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <?php }?>
                            
                            
                             <li class="">
								<?php
                echo anchor('enquiry_controller/approved_enquiry_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Admited Enquiry</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            
                            
                            
                            <li class="">
								<?php
                echo anchor('enquiry_controller/enquiry_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Enquiry</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('enquiry_controller/not_interested_enquiry_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Not Interested Enquiry</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('enquiry_controller/followup_enquiry/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Follow Up Enquiry</span>');
                ?>

								<b class="arrow"></b>
							</li>
                    
                    </ul>
                    
                    </li>
                    <?php } ?>
                     <?php if($this->db->get_where('settings' , array('type' =>'students_enquiry'))->row()->description == 'yes')
					   {?>
  					<li class="">
						<?php
                echo anchor('Admin/view_enquiry/', '<i class="menu-icon fa fa-envelope"></i><span>&nbsp;Students Enquiry</span>');
                ?>
					</li>
  					<?php }?>
    
    
             
           <!-- <li class="">
                <?php
                echo anchor('Admin/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import To Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
        
       <?php if($this->db->get_where('settings' , array('type' =>'time_table'))->row()->description == 'yes')
					   {?>
    				  
     <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text"> Time Table </span> <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
<li class="">
                <?php
                echo anchor('Hourly_attendance/set_time_table/', '<i class="menu-icon fa fa-bar-chart"></i><span>&nbsp; Time Table</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
            <li class="">
                <?php
                echo anchor('Hourly_attendance/show_time_table/', '<i class="menu-icon fa fa-bar-chart"></i><span>&nbsp; Show Time Table</span>');
                ?>
                <b class="arrow fa fa-angle-down"></b>
                <b class="arrow"></b>
            </li>
            
            </ul></li>
            <?php } ?>
     	
                      
                

					
					

					
                      
                   
                     
                    
                   
						
                       
  <li class="">                      
<a href="#" class="dropdown-toggle">
<i class="menu-icon fa fa-money"></i>
<span class="menu-text"> Reports </span>
<b class="arrow fa fa-angle-down"></b>
</a>
<b class="arrow"></b>

<ul class="submenu">
<li class=""><?php echo anchor('Admin/print_students_list/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Students Report</span>'); ?></li>


<b class="arrow"></b>

<b class="arrow"></b>
<li class=""> <?php echo anchor('Admin/progress_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Progress Report'); ?></li>
<b class="arrow"></b>
<?php /* if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes'){?>
<li class=""><?php echo anchor('Hourly_attendance/attendance_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');?> </li>
<?php } */ ?>
<b class="arrow"></b>
<?php if($this->session->userdata('role')==1){?>                
                    <li class="">
								 <?php
                echo anchor('Admin/deleted_students/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp; Deleted Students</span>');
                ?>
								
							</li>
                            <b class="arrow"></b>
                            
                             <li class="">
								 <?php
                echo anchor('Admin/inactive_students/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp; In Active Students</span>');
                ?>
								
							</li>
             <?php } 
             else
             {
                if($this->db->get_where('settings' , array('type' =>'view_inactive_for_others'))->row()->description == 'yes')    
                {
                    ?>
                    <li class="">
					    <?php
                        echo anchor('Admin/inactive_students/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp; In Active Students</span>');
                        ?>
								
					</li> 
					<?php
				}
             }
             ?>
</ul>
</li>
 
<li class="">
                <?php
                echo anchor('Admin/staff_view/', '<i class="menu-icon fa fa-users""></i><span>&nbsp; Staff</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
             <?php $role=$this->session->userdata('role'); ?>
 					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog"></i>
							<span class="menu-text"> Settings </span>
						</a>
                        <b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<?php
                echo anchor('Admin/general_settings/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;General Settings</span>');
                ?>

								<b class="arrow"></b>
							</li>
                              <?php if($role==1){?>
                            
                            <li class="">
								<?php
                echo anchor('Admin/settings2/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Advanced Settings</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                             <li class="">
								<?php
                echo anchor('Admin/view_acdemic_year/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Academic Year</span>');
                ?>

								<b class="arrow"></b>
							</li>
                           
                           
    
            <li class="">
                <?php
                echo anchor('Admin/view_branch/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Branch</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
           
    
    <?php }
	

									 
                       
                        
			if($role==1 || $role==2 ||$role==3){?>
     <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text">
                Department
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
            
            <?php
			if($role==1 || $role==2){
                        $branch = $this->db->get('tbl_branch')->result_array();
                        foreach ($branch as $row):
                            ?>
                            <li> <a href="<?php echo base_url(); ?>index.php/admin/view_department/<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></a></li>
                             <?php endforeach; 
							} else {?>
                               <li class="">
                <?php
                echo anchor('Admin/view_Department/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Department</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
           
            <?php } ?>
                        </ul></li>
                       
       <?php }?> 
       <?php
			if($role==1 || $role==2){?>
        <li class="">
                <?php
                echo anchor('Admin/bulk_password_set/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;password change</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <?php } ?>
       
       </ul>
          <?php if($this->db->get_where('settings' , array('type' =>'teacher_attendance'))->row()->description == 'yes')
					   {?>
                       
            <?php
			if($role==4){?>
         <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-bar-chart"></i>
            <span class="menu-text">
                Teacher Attendance
            </span>

            <b class="arrow fa fa-angle-down"></b>
        </a>

        <b class="arrow"></b>

        <ul class="submenu">
       <li class="">
                <?php
                echo anchor('Admin/teacher_attendance/','<span>&nbsp; Teacher Attendance</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
             <li class="">
                <?php
                echo anchor('Admin/teacher_attendance_report/', '<span>&nbsp; View Teacher Attendance</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
</ul></li>
<?php }} ?>
<?php if($this->db->get_where('settings' , array('type' =>'migrate_class_section'))->row()->description == 'yes')
					   {?>
		<li class="">
                <?php
                echo anchor('Admin/student_migration/','<i class="menu-icon fa fa-book"></i><span>&nbsp; Migrate</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


        </li> 
      <?php
	  }
	  ?>
       <li class="">
                <?php
                echo anchor('Admin/help/','<i class="menu-icon fa fa-book"></i><span>&nbsp; Help</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            
             <li class="">
                <?php
                echo anchor('Admin/apk_view/','<i class="menu-icon fa fa-download"></i><span>&nbsp;Download</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            
            
            
            
            
            
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
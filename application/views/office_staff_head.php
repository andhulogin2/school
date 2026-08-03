<?php
error_reporting(0);
//$Office_staff=$this->session->userdata('login_user_id');

if(!isset($_SESSION['login_user_id']))
 redirect(base_url(), 'refresh');

defined('BASEPATH') OR exit('No direct script access allowed');
    $rtl          = $this->db->get_where('settings' , array('type'=>'rtl'))->row()->description;

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
			

			<div class="navbar-container ace-save-state" id="navbar-container"s>
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
					<a href="<?php echo base_url();?>index.php/Office_staff/index" class="navbar-brand">
						<small>
							<b><img src="<?php echo base_url();?>uploads/logo.png" style="max-height : 40px;"></b><span class="hidden-xs"><strong></strong></span>
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
							
                            
                            <div class="nav-search pull right" id="nav-search" style="padding-top:10px;">
						<?php echo form_open(base_url() . 'index.php/Office_staff/search' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
									<i class="ace-icon fa fa-search nav-search-icon" ></i>
								</span>
				<?php form_close(); ?>
						</div>
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
											<a href="<?php echo base_url(); ?>index.php/Office_staff/view_enquiry">
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
											<a href="<?php echo base_url(); ?>index.php/Office_staff/view_complaints">
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
											<a href="<?php echo base_url(); ?>index.php/Office_staff/view_enquiry">
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
									$Office_staff=$this->session->userdata('login_user_id');
									$this->db->select('username');
									$this->db->from('tbl_users');
									$this->db->where('user_id',$Office_staff);
									$query=$this->db->get()->row();
									
                        echo $query->username; ?></b></small>
									
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>
                            
                            
                            
                            
                            
                            

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<?php
                echo anchor('Office_staff/general_settings/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Settings</span>');
                ?>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>
                                <li>
									 <?php
                echo anchor('Office_staff/reset_password/', '<i class="menu-icon fa fa-sign-out"></i><span>&nbsp;Reset Password</span>');
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
                echo anchor('Office_staff/office_dashboard/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Dashboard</span>');
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
                echo anchor('Office_staff/student_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Student</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <li class="">
                <?php
                echo anchor('Office_staff/student_bulk/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Student Bulk</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <!-- <li class="">
                <?php
                echo anchor('Office_staff/teacher_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Teacher</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
            
           <!-- <li class="">
                <?php
                echo anchor('Office_staff/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import To Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
        </ul>
    </li>
     <li class="">
								<?php
                echo anchor('Office_staff/student_veiw/', '<i class="menu-icon fa fa-search"></i><span>&nbsp;Students</span>');
                ?>
								<b class="arrow"></b>
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
                echo anchor('Office_staff/message/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Message</span>');
                ?>

								<b class="arrow"></b>
							</li>

							<li class="">
								<?php
                echo anchor('Office_staff/sms_template', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS Template</span>');
                ?>

								<b class="arrow"></b>
							</li>
                           
                            <li class="">
								<?php
                echo anchor('Office_staff/report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Delivery Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                             <li class="">
								<?php
                echo anchor('Office_staff/sms_settings', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;SMS Settings</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <li class="">
								<?php
                echo anchor('Office_staff/sms_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp; SMS Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                             <li class="">
								<?php
                echo anchor('Office_staff/sms_que_report', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp; SMS Que Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>
                       
                       
                        <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
					   { ?>
                    
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Fee Details </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
                        <ul class="submenu">  

	<li class="">
						
							
                            <li> <?php echo anchor('feeManagement/student_payment', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Pay Fees'); ?></li>
							
						
                            <ul class="submenu">                        
<b class="arrow"></b>
<li class=""></li>
<b class="arrow"></b>
</ul>


	<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Setup Fee </span>
							<b class="arrow fa fa-angle-down"></b>
<b class="arrow"></b>
<ul class="submenu">
<b class="arrow"></b>
<li class=""> <?php echo anchor('feeManagement/fee_plan_view', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Master'); ?></li>
<b class="arrow"></b>
<li class=""> <?php echo anchor('feeManagement/bulk_assign_fees/assign', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Assign Fee'); ?></li>
<b class="arrow"></b>
<li class=""> <?php echo anchor('feeManagement/bulk_assign_fees/assigned', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Structure'); ?></li>

</ul>

</ul>
<?php }?>


 <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog"></i>
							<span class="menu-text"> Expense </span>
						</a>
                        <b class="arrow"></b>

						<ul class="submenu">

							
                            
                            
                            <li class="">
								<?php
                echo anchor('Office_staff/add_expense/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add expense</span>');
                ?>

								<b class="arrow"></b>
							</li>


                             
                             
    
            <li class="">
                <?php
                echo anchor('Office_staff/view_expense/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View expense</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>
            <?php $role	=	$this->session->userdata('role');
			 if($role==3){?>
            <li class="">
								<?php
                echo anchor('Office_staff/view_expense_category/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Expense Category</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            <?php }?>
           
    
    
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
                echo anchor('Office_staff/news_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add News</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('Office_staff/news/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View News</span>');
                ?>
								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    
                    
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
                echo anchor('Office_staff/homework_add/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Add Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>
                            
                            <li class="">
								<?php
                echo anchor('Office_staff/homework_view/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;View Homework</span>');
                ?>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
                    <?php }?>
                   

                       
                       
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
                echo anchor('Office_staff/view_class/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Classes</span>');
                ?>

								<b class="arrow"></b>
							</li>


							<li class="">
								 <?php
                echo anchor('Office_staff/section/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Division</span>');
                ?>
								<b class="arrow"></b>
							</li>

							<li class="">
								 <?php 
               // echo anchor('Office_staff/class_migration/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Class-Migrate</span>');
                ?>
								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
                    
                   
							<li class="">
								<?php
                echo anchor('Office_staff/subjects_view/', '<i class="menu-icon fa fa-book"></i><span>&nbsp;Subjects</span>');
                ?>

								<b class="arrow"></b>
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
                echo anchor('Office_staff/view_exam/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Create Exam</span>');
                ?>

								<b class="arrow"></b>
							</li>

							

							<li class="">
								<?php
                echo anchor('Office_staff/tab_sheet/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Report</span>');
                ?>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li>
    
    
     
                    <?php if($this->db->get_where('settings' , array('type' =>'complaint_view'))->row()->description == 'yes')
					   {?>
                    <li class="">
						<?php
                echo anchor('Office_staff/view_complaints/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Complaints</span>');
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
                        <?php if($this->session->userdata('role')==7)
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
                echo anchor('Office_staff/view_enquiry/', '<i class="menu-icon fa fa-envelope"></i><span>&nbsp;Students Enquiry</span>');
                ?>
					</li>
  					<?php }?>
    
    
             
           <!-- <li class="">
                <?php
                echo anchor('Office_staff/excel_import/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Import To Excel</span>');
                ?>

                <b class="arrow fa fa-angle-down"></b>

                <b class="arrow"></b>


            </li>-->
        
      
    				  
    
                      
                

					
					

					
                      
                   
                     
                    
                   
						
                       
  <li class="">                      
<a href="#" class="dropdown-toggle">
<i class="menu-icon fa fa-money"></i>
<span class="menu-text"> Reports </span>
<b class="arrow fa fa-angle-down"></b>
</a>
<b class="arrow"></b>

<ul class="submenu">
<li class=""><?php echo anchor('Office_staff/print_students_list/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Students Report</span>'); ?></li>

<li class=""> <?php

	if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
	
 echo anchor('feeManagement/fee_due_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Due Report'); ?></li>
<b class="arrow"></b>
<li class=""> <?php
if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
		
 echo anchor('feeManagement/fee_collection_detailed_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Collection Report'); ?></li>
<b class="arrow"></b>
<li class=""> <?php echo anchor('Office_staff/progress_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Progress Report'); ?></li>
<b class="arrow"></b>
</ul>
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
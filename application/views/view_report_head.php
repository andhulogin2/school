<?php
error_reporting(0);
//$admin=$this->session->userdata('login_user_id');

if(!isset($_SESSION['login_user_id']))
 redirect(base_url(), 'refresh');

defined('BASEPATH') OR exit('No direct script access allowed');
    $rtl          = $this->db->get_where('settings' , array('type'=>'rtl'))->row()->description;

?><!DOCTYPE html>
<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - <?php echo $this->db->get_where('settings',array('type'=>'header_title'))->row()->description; ?></title>

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
                <div class="navbar-header pull-left" style="width:30%">
					&nbsp;
				</div>
                <div class="navbar-header pull-left">
					<?php
					if($this->db->get_where('settings' , array('type' =>'acc_year_change'))->row()->description == 'yes' && $this->session->userdata('role')<=4)
					{
						if($this->db->get_where('settings' , array('type' =>'year_change_in_settings'))->row()->description != 'yes')
						{
							echo form_open('admin/change_academic_year');
							$this->db->select('acdemic_year_id,academic_year');
							$ac_year   =   $this->db->get_where('tbl_academic_year',array('is_deleted'=>'N'))->result_array();
							$cur_year   =   get_running_year();
						?>
						<label style="padding-top:3%;">
							<select name="acc_year" id="acc_year" style="border-radius:5px;" class="form-control">
								<?php
								foreach($ac_year as $row):
								?>
								<option value="<?php echo $row['acdemic_year_id']; ?>"<?php if($cur_year==$row['acdemic_year_id']){ echo "selected"; } ?>><?php echo $row['academic_year']; ?></option>
								<?php
								endforeach;
								?>
							</select>
						</label>
						<span>
							<input type="submit" class="btn btn-info btn-sm" onClick="return check()" value="Reset Ac.Year" style="border-radius:5px;">
						</span>
						<script>
							function check()
							{
								if(confirm('Do you want to change academic year?'))
								{
									return true; 
								}
								else
								{
									return false;
								}
							}
						</script>
						<?php
							echo form_close();
						}
						else
						{
						$cur_year   =   get_running_year();
						$year_name	=	$this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>$cur_year))->row()->academic_year;
						?>
							<label style="margin-top:15%;background-color:#FFFFFF;padding:5px;border-radius:5px;">Ac.Year: <?php echo $year_name; ?></label>
						<?php
						}	
					}
                    ?>
                    
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
								<?php
                echo anchor('Admin/student_veiw/', '<i class="menu-icon fa fa-search"></i><span>&nbsp;Students</span>');
                ?>
								<b class="arrow"></b>
							</li>
           <!--TC start-->
			<?php 
            if($this->db->get_where('settings' , array('type' =>'tc'))->row()->description == 'yes')
            {
            ?>
                <li class="">
					<?php
                    echo anchor('Admin/view_tc_issued/', '<i class="menu-icon fa fa-search"></i><span>&nbsp;TC Issued</span>');
                    ?>
                    <b class="arrow"></b>
                </li>
         	 <?php
			 }
			 ?>      
           <!--TC end-->        
                       
                  
                  
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

							<li class="">
								<?php
                echo anchor('Admin/attendance_report/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Report</span>');
                ?>

								<b class="arrow"></b>
							</li>
                 <?php
				 if($this->db->get_where('settings' , array('type' =>'attendance_summary'))->row()->description == 'yes')
				 {
				 ?>           
                            <li class="">
                                <?php
                                echo anchor('Hourly_attendance/attendance_summary', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Attendance Summary</span>');
                                ?>
                                <b class="arrow fa fa-angle-down"></b>
                                <b class="arrow"></b>
                            </li>
            	<?php
				}
				?>	
							
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

        <!--Hallticket start-->
        <?php 
		if($this->db->get_where('settings' , array('type' =>'hall_ticket'))->row()->description == 'yes')
		{
		?>
							<li class="">
								<?php
                echo anchor('Admin/hall_ticket/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Hall Ticket</span>');
                ?>

								<b class="arrow"></b>
							</li>
        <?php
		}
		?>                    
		<!--Hallticket end-->



							<li class="">
								<?php
                echo anchor('Admin/tab_sheet/', '<i class="menu-icon fa fa-caret-right"></i><span>&nbsp;Report</span>');
                ?>

								<b class="arrow"></b>
							</li>

							

						</ul>
					</li>   
                    
                    
                    
                       
                        <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
					   { 
					   if($this->session->userdata('username')!='hm')
					   {
					   ?>
                    
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Fee Details </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
                        <ul class="submenu">  

	<li class="">
						
<b class="arrow"></b>

 <li class=""> <?php

	if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
	
 echo anchor('feeManagement/fee_due_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Due Report'); ?></li>
 
 <li class=""> 
 <?php
	if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')		
 		echo anchor('feeManagement/fee_collection_detailed_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Collection Report'); 
 ?>
 </li>
 
 <li class=""> 
 <?php
 		echo anchor('feeManagement/complete_fee_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Complete Fee Report'); 
 ?>
 </li>
 

</ul>
<?php }
}
?>



<?php 
if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
{ 
    if($this->session->userdata('username')!='hm')
    {
?>
<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Special Fee </span>
							<b class="arrow fa fa-angle-down"></b></a>
<b class="arrow"></b>
<ul class="submenu">
<b class="arrow"></b>

 <li class=""> <?php echo anchor('feeManagement/special_fee_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Report'); ?></li>


</ul>
</li>
<?php
}
}
?>

<?php 
if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
{ 
    if($this->session->userdata('username')!='hm')
    {
?>
<li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-desktop"></i>
            <span class="menu-text">Transportation </span> <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">


                <b class="arrow"></b>
                <li class=""> <?php echo anchor('Transport_management/bus_fee_class_wise', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Class Wise Students'); ?></li>
                <b class="arrow"></b>
                <li class=""> <?php echo anchor('Transport_management/bus_fee_bus_wise', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Bus Wise Students'); ?></li>
                <b class="arrow"></b>
                <li class=""> <?php echo anchor('Transport_management/bus_fee_route_wise', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Route Wise Students'); ?></li>
                <li class=""> <?php echo anchor('Transport_management/bus_fee_pickup_point_wise', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Pickup Point Wise Students'); ?></li>
                 <li class=""><?php echo anchor('transport_management/fee_collection_detailed_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Collection Report'); ?></li>
                <li class=""><?php echo anchor('transport_management/view_bus_fee_due_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Fee Due Report'); ?></li>
                <li class=""><?php echo anchor('transport_management/view_bus_fee_all_in_one_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;All In One Report'); ?></li>
                
                   
       </ul>
    </li>
<?php
}
}
?>

     
                    <?php if($this->db->get_where('settings' , array('type' =>'complaint_view'))->row()->description == 'yes')
					   {?>
                    <li class="">
						<?php
                echo anchor('Admin/view_complaints/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Complaints</span>');
                ?>
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
        
                    
                   
						
                       
  <li class="">                      
<a href="#" class="dropdown-toggle">
<i class="menu-icon fa fa-money"></i>
<span class="menu-text"> Reports </span>
<b class="arrow fa fa-angle-down"></b>
</a>
<b class="arrow"></b>

<ul class="submenu">
<li class=""><?php echo anchor('Admin/print_students_list/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Students Report</span>'); ?></li>

<?php
if($this->db->get_where('settings' , array('type' =>'admission_report'))->row()->description == 'yes')
{
?>
<b class="arrow"></b>
<li class=""><?php echo anchor('Admin/admission_report/', '<i class="menu-icon fa fa-hand-o-right"></i><span>&nbsp;Admission Report</span>'); ?></li>
<?php
}
?>

<b class="arrow"></b>
<li class=""> <?php echo anchor('Admin/progress_report', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Progress Report'); ?></li>
<b class="arrow"></b>
<!-- Completed and Discontinued buttons --> 	
	<?php
    if($this->db->get_where('settings' , array('type' =>'completed_discontinued_button'))->row()->description == 'yes')
	{
	?>
        <li class=""> <?php echo anchor('Admin/course_status_report/completed', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Course Completed Students'); ?></li>
        <b class="arrow"></b>
        <li class=""> <?php echo anchor('Admin/course_status_report/discontinued', '<i class="menu-icon fa fa-file-text"></i><span>&nbsp;Course Discontinued Students'); ?></li>
        <b class="arrow"></b>
    <?php
	}
    ?>
</ul>
</li>
 
						
       <li class="">
                <?php
                echo anchor('Admin/help/','<i class="menu-icon fa fa-book"></i><span>&nbsp; Help</span>');
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
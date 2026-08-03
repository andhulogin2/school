<?php include_once APPPATH . 'views/staff_head.php';?>
 

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
							<li class="active">Settings</li>
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
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								SETTINGS
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									General Settings
								</small>
							</h1>
						</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



 <div class="row" style="margin-top:30px;">
<div class="col-lg-4">
              
                <div class="btn btn-custom btn-block waves-effect waves-light">
                    <div class="icon">
                    </div>
                   
                    <h3><font color="white">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<a style="color:white;" href="<?php echo base_url(); ?>index.php/staff/attendance_delete" >DELETE ATTENDANCE </a></font>
                    </h3>
                   
                    <h3><font color="white"></font></h3>
                </div>
                </div>
                <div class="col-lg-4  ">
                <div class="btn btn-custom btn-block waves-effect waves-light" >
                    <div class="icon">
                    </div>
                   
                    <h3><font color="white">

<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<a style="color:white;" href="<?php echo base_url(); ?>index.php/staff/unit_test_delete" >DELETE UNIT TEST </a></font></h3>
                   
                    <h3><font color="white"></font></h3>
                </div>
                
                </div>
                
                <div class="col-lg-4 ">
                <div class="btn btn-custom btn-block waves-effect waves-light" >
                    <div class="icon">
                    </div>
                   
                    <h3><font color="white">
<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;<a style="color:white;" href="<?php echo base_url(); ?>index.php/staff/subject_unit_test_delete" >DELETE SUBJECT MARKS</a></font></h3>


                   
                    <h3><font color="white"></font></h3>
                </div>
                
                </div>
                
                <div class="col-lg-4" style="padding-top:30px;">
                <div class="btn btn-custom btn-block waves-effect waves-light" >
                    <div class="icon">
                    </div>
                   
                    <h3><font color="white">

<i class="fa fa-users" aria-hidden="true"></i>&nbsp;<a style="color:white;" href="<?php echo base_url(); ?>index.php?staff/attendance_report" >-----</a></font></h3>


                   
                    <h3><font color="white"></font></h3>
                </div>
                
                </div>
                
            </div>
           </div> 
 


</div>
</div>

<?php include_once APPPATH . 'views/footer.php'; ?>
 

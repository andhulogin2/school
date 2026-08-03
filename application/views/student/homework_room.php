<?php include_once APPPATH . 'views/student_head.php';?>

	
	<body class="no-skin">
		
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
								<a href="#">Student</a>
							</li>
							<li class="active">Homework</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Homework
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Details
								
							</h1>
						</div>

<div class="row">
	<div class="main_data">	
		<?php include $room_page . '.php';?>
	</div>
</div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
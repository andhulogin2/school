<?php include_once APPPATH . 'views/head.php';?>


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
							<li class="active">Homework</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Homework
							
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
															</h1>
						</div>

<div class="row">
	<div class="col-md-2">
		<a style="text-align: left;" href="<?php echo base_url();?>index.php/admin/homeworkroom/details/<?php echo $homework_code;?>" 
			class="<?php if ($room_page == 'homework_details') echo 'btn btn-info'; 
			else echo 'btn btn-warning';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Homework'); ?>
			<i class="fa fa-info"></i>
		</a>

        <a style="text-align: left;" href="<?php echo base_url();?>index.php/admin/homeworkroom_edit/edit/<?php echo $homework_code;?>" 
			class="<?php if ($room_page == 'homework_edit') echo 'btn btn-danger';
			else echo 'btn btn-info';?> btn-block btn-icon icon-left">
			Edit
			<i class="fa fa-edit"></i>
		</a>
	</div>
		<div class="main_data">	
			<?php include APPPATH . 'views/admin/homework_details.php';?>
		</div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>
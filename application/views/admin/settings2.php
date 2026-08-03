
<?php include_once APPPATH . 'views/main_head.php';?>

<!DOCTYPE html>  
<html lang="en">
<head>
	
</head>
<body>
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div class="main-content col-md-10">
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
							<li class="active">Advanced settings </li>
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
<script type="text/javascript">var baseurl = '<?php echo base_url();?>';</script>

<?php echo form_open(base_url() . 'index.php/admin/settings2_login');?>
   <div class="col-md-4"></div>
	<div class="login-box col-md-4">
    <div class="white-box" id="login" style="padding-top:100px;">
	<div class="form-horizontal form-material">
		<h3 class="box-title m-b-20"><?php echo get_phrase('Login'); ?></h3>
		

		

         <div class="form-group">
          <div class="col-xs-6">
            <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo get_phrase('Password'); ?>" autocomplete="off">
          </div>
        </div>

       

        <div class="form-group text-center m-t-20">
          <div class="col-xs-4">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?php echo get_phrase('Login'); ?></button>
          </div>
        </div>
       
<?php echo form_close();?>
</div>
</div></div></div></div>
<div class="col-md-4"></div></body>
<?php include_once APPPATH . 'views/footer.php'; ?>





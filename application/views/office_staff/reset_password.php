<?php include_once APPPATH . 'views/main_head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
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
							<li class="active">Reset Password</li>
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
								Admin
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Reset Password
								
							</h1>
						</div>


<?php echo form_open(base_url() . 'index.php/admin/change_password/'); ?>


<div class="row">
    
        <div class="col-md-12">
         <div class="form-group">
               <label class="col-md-2">New Password</label>
               <input type="password" id="new" name="new"  class="form-control" style="width:300px;"/>
    </div>
    </div>
    
     <div class="col-md-12">
         <div class="form-group">
               <label class="col-md-2">confirm Password</label>
               <input type="password" id="confirm" name="confirm"  class="form-control" style="width:300px;"/>
    </div>
    </div>
    
 
  
	<div class="col-md-3" style="margin-top: 20px; margin-left:300px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('Reset');?></button>
	
    </div>
</div>

<?php echo form_close(); ?>
</div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
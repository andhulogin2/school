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
								<a href="#">Home</a>							</li>
							<li class="active">Enquiry</li>
						    <li class="active">View Enquiry</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>View<small>
									<i class="ace-icon fa fa-angle-double-right"></i>Enquiry</small>
							</h1>
						</div>
        <?php  echo form_open(base_url() . 'index.php/enquiry_controller/enquiry_detailed_report/');?>


                                   <div class="form-group">
								   <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> <span class="col-sm-2">
								   <input type="checkbox" id="chk_date_from" name="chk_date_from" checked="checked"/>
								   </span>Date From :</label>
								   <div class="col-sm-2"><div class="clearfix">
								   <div class="input-group input-group-sm"><input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />	
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
				      </div>
                                      
 
                                   <div class="form-group">
								   <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> <span class="col-sm-2">
								   <input type="checkbox" id="chk_date_to" name="chk_date_to" checked="checked"/>
								   </span>Date To :</label>
								   <div class="col-sm-2">
								     <div class="clearfix">
								   <div class="input-group input-group-sm">
                                   <input type="text" name="date_to" id="date_to" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />
		                           <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
                                      

<input type="submit" class="btn-btn-info" name="view" value=" View ">

</div>


	
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script>  
<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/main_head.php';
?><body>
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
							<li class="active">expense Settings</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Expense
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Expense Settings
								
							</h1>
						</div><!-- /.page-header -->
                     
                                       
                <?php echo form_open(base_url() . 'index.php/admin/edit_expense_settings' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

            <?php foreach($expense as $row) { ?>
            
                <input type="hidden" name="id" value="<?php echo $row['id'];?>" style="width:350px;" >
          <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Daily Amount Notification Limit :</label>
    
                <div class="col-sm-9">
                <input type="text" name="expense_limit" style="width:350px;" value="<?php echo $row['amount'];?>" required >
                </div>
          </div>    
                 
          <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">OTP Mobile Number :</label>
    
                <div class="col-sm-9">
                <input type="text" name="phone_number1" style="width:350px;" value="<?php echo $row['mobile_number'];?>" required >
                </div>
          </div>
          
          <?php } ?>    
                            
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>
</div>
<?php echo form_close();?>
                    </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

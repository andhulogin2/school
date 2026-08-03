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
                     
                <?php echo form_open(base_url() . 'index.php/admin/set_expense_settings' , array('id'=>'expense_form_setting','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                                    
          <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Daily Amount Notification Limit :</label>
    
                <div class="col-sm-9">
                <input type="text" name="expense_limit" style="width:350px;" required >
                </div>
          </div>    
                 
          <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">OTP Mobile Number :</label>
    
                <div class="col-sm-9">
                <input type="text" name="phone_number1" style="width:350px;" required >
                </div>
          </div>
          
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Date: <font color="#FF0000">* </font> </label>
            <div class="col-sm-4">
                <div class="clearfix">
                    <!-- #section:plugins/date-time.datepicker -->
                    <div class="input-group input-group-sm">
                        <input type="text"  id="mydatepicker"  class="form-control mydatepicker" name="expense_date" value="<?php echo date('d-m-Y'); ?>" required/>
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>   
                                 
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <button type="button" class="btn btn-info" onClick="check_date_exist();">Submit</button>
    </div>
</div>

             <div id="expense_div" style="padding-top:60px;display:none">
                <div class="alert alert-danger">
                  <strong>Data exist on the selected date.</strong>
                </div>           
               </div>

<?php echo form_close();?>
                    </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
            
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

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script>
function check_date_exist()
{
		var expense_date    =   $('#mydatepicker').val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/check_date_exist/' + expense_date ,
            success: function(response)
            {
               if(response=="0")
			   {
				   $('#expense_form_setting').submit();
				   $('#expense_div').hide();
			   }
			   else if(response=="1")
			   {
				   $('#expense_div').show();
			   }

            }
        });
}
</script>

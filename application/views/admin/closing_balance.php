<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/main_head.php';
?>

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
					<li class="active">Close Balance</li>
				</ul><!-- /.breadcrumb -->
				
				<!-- #section:basics/content.searchbox -->
				<div class="nav-search" id="nav-search">
					<form class="form-search">
					<span class="input-icon">
					</span>
					</form>
				</div><!-- /.nav-search -->
			</div>
		
			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<div class="page-header">
					<h1>
					Close Balance
					</h1>
				</div><!-- /.page-header -->
			<div>
			<?php echo form_open('Admin/close_balance', array('class' => 'form-horizontal')); ?>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date :</label>
				<div class="col-sm-9">
					<input type="text" name="balance_date" id="balance_date" required class="col-xs-10 col-sm-5 mydatepicker" value="<?php echo date("d-m-Y", strtotime($balance_date));?>" onchange="get_balances(this.value)" />
				</div>
				<div class="col-sm-offset-3 col-sm-9" id="opening_date"></div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Opening Balance :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<input type="text" id="opening_balance" placeholder="Opening balance" readonly="" value="<?=$opening_balance?>" class="col-xs-10 col-sm-5" name="opening_balance" required/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Income :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<input type="text" id="income" placeholder="Income" class="col-xs-10 col-sm-5" readonly="" value="<?=$income?>" name="income" required/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Expense :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<input type="text" id="expense" placeholder="Expense" class="col-xs-10 col-sm-5" readonly="" value="<?=$expense?>" name="expense" required/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Closing Balance :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<input type="text" id="closing_balance" placeholder="Closing Balance" class="col-xs-10 col-sm-5" value="<?=$total_amount?>" name="closing_balance" required/>
				</div>
			</div>
			
			<button type="submit" id="btnSubmit" class="btn btn-info" style="margin-left:400px;" onfocus="get_balances()">
			Save
			</button>
			<div></div>
			<br />
		</div>
		<?php echo form_close(); ?>
	</div>

</div>
</center>

</div></div>

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

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
function get_dept(branch_id) 
{
	$.ajax({
		url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
		success: function(response)
		{
			jQuery('#department').html(response);
		}
	});
}

function get_balances(date)
{
	var date		=	$("#balance_date").val();
	$.ajax({
		url: '<?php echo base_url();?>index.php/admin/get_balances/' + date ,
		dataType: "json",
		success: function(response)
		{
			if(response.exist==0){
				jQuery('#opening_date').html("<span style='color:red'>Closing balance in this Date already exist.</span>");
				$('#btnSubmit').prop('disabled',true);
			} else {
				$('#opening_balance').val(response.opening_balance);
				$('#income').val(response.income);
				$('#expense').val(response.expense);
				$('#closing_balance').val(response.total_amount);
				jQuery('#opening_date').html("<span style='color:red'></span>");
				$('#btnSubmit').prop('disabled',false);
			}
		}
	});
}

</script>

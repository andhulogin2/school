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
					<li class="active">Closing Balance Report</li>
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
					Closing Balance Report
					</h1>
				</div><!-- /.page-header -->
			<div>
			<?php echo form_open('Admin/closing_balance_report', array('class' => 'form-horizontal')); ?>
			
					<div class="col-md-2">
					<div class="form-group">
							<label class="control-label" style="margin-bottom: 5px;">From Date</label>
							<input type="text" name="from_date" id="from_date" required class="form-control mydatepicker" value="<?php if($from_date!=''){ echo date("d-m-Y", strtotime($from_date)); }else{ echo date('d-m-Y'); } ?>" />
						</div>
					</div>
					<div class="col-md-2" style="padding-left:20px">
					<div class="form-group">
							<label class="control-label" style="margin-bottom: 5px;">To Date</label>
							<input type="text" name="to_date" id="to_date" required class="form-control mydatepicker" value="<?php if($from_date!=''){ echo date("d-m-Y", strtotime($to_date)); }else{ echo date('d-m-Y'); } ?>" />
						</div>
					</div>
					<div class="col-md-2" style="padding-top:30px;padding-left:20px">
					<div class="form-group">
						<button type="submit" id="btnSubmit" class="btn btn-info" >
						View
						</button>
						</div>
					</div>
		<?php echo form_close(); ?>
	<div class="form-group">
		<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
			<thead>
				<tr>
					<th class="table-header">Sl No.</th>
					<th class="table-header">Closing Date</th>
					<th class="table-header">Income</th>
					<th class="table-header">Expense</th>
					<th class="table-header">Opening Balance</th>
					<th class="table-header">Closing Balance</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 1;
				if(count($close)<=0){ ?>
				<tr><td colspan="6"><center><font color="#FF0000">No records found</font></center></td></tr></table>
				<?php }
				foreach($close as $row):?>
				<tr>
					<td><center><?php echo $count++;?></center></td>
					<td><center><?php echo date('d-m-Y',strtotime($row['closing_balance_date']));?></center></td>
					<td><center><?php echo $row['income'];?></center></td>
					<td><center><?php echo $row['expense'];?></center></td>
					<td><center><?php echo $row['opening_balance'];?></center></td>
					<td><center><?php echo $row['closing_balance'];?></center></td>
				</tr>
				<?php endforeach;?>	
			</tbody>
		</table>
	</div>
<div align="right">
<a href="<?php echo base_url(); ?>index.php/Admin/closing_balance_report_excel/<?php echo $from_date;?>/<?php echo $to_date;?>"><button name="fee_excel" class="btn-info">Download Excel</button></a>
</div>
			<div></div>
			<br />
		</div>
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


<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              


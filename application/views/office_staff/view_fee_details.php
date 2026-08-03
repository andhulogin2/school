<?php include_once APPPATH . 'views/main_head.php';?>
 

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
							<li class="active">Fee Details</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee Details 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $fee_master_name;?>
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
                      
                                        <div></div>
                       
   <div align="right" style="padding-right:10px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_master'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div>

   
                        

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Master Name </label>
<div class="col-sm-9">
<input type="text" name="name" id="name" class="col-xs-10 col-sm-5"  value="<?php echo $fee_master_name;?>" readonly="readonly"/>
</div>
</div>
<br /><br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class </label>
<div class="col-sm-9">
<input type="text" name="class_id" id="class_id" class="col-xs-10 col-sm-5"  value="<?php echo $class_name; ?>" readonly="readonly"/>
</div>
</div>
<br /><br />
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
  <thead>
  <tr>
  <th style="text-align: center;" class="table-header">Sl.No</th>
  <th style="text-align: center;" class="table-header">Installement</th>
   <th style="text-align: center;" class="table-header">Due Date</th>
 <th style="text-align: right;" class="table-header">Amount</th>
  <th style="text-align: right;" class="table-header">Action</th>
</tr>
</thead>
 <tbody>
<?php 
$total = 0;
$i=1;
foreach($installment_details as $details){
$total =$total+$details['fee_total'];
?>
<tr>
 <td style="text-align: center;"> <?php echo $i; ?></td>
 <td style="text-align: center;"> <?php  echo $details['fee_payment_options_details'];?></td>
 <td style="text-align: center;"> <?php echo get_installment_due_date($details['fee_installment_master_id']); ?></td>
 <td style="text-align: center;"> <?php  echo number_format( $details['fee_total'],2);?></td>
<td style="text-align: center;" class="text-nowrap">

<a href='<?php echo base_url().'index.php/feeManagement/set_fees/'. $fee_master_id."/".$class_id."/".$details['fee_payment_options_master_id']."/".$details['fee_payment_options_details_id']."/".$details['fee_installment_master_id'];?>'> <i>Set Fee</i> </a></td></tr>
<?php 
$i=$i+1;
}
?>
<tr> <td style="text-align: center;" colspan="3"><b> Total</b></td><td  style="text-align: center;"><b><?php  echo number_format( $total,2);?></b></td><td></td></tr>
</tbody></table>



</div>
</div>
</div></div>

	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

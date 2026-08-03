<?php include_once APPPATH . 'views/head.php';?>
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
							<li class="active">Set Installments</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Setup
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Installments
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

 
<div align="right" style="padding-right:10px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_details_view/'. $fee_master_id . "/". $class_id ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div>

<?php echo form_open(base_url() . 'index.php/FeeManagement/insert_set_fees', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="installment_master_id" id="installment_master_id" class="form-control"  value="<?php echo $installment_master_id;?>"/>
<input type="hidden" name="fee_master_id" id="fee_master_id" class="form-control"  value="<?php echo $fee_master_id;?>"/>
<input type="hidden" name="class_id" id="class_id" class="form-control"  value="<?php echo $class_id;?>"/>
<div style="padding-left:50px;">
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fee Master Name</label>
    <div class="col-sm-9">
        <input type="text" name="name" id="name"  class="col-xs-10 col-sm-5" value="<?php echo $fee_master_name; ?>" readonly="readonly"/>
    </div>
</div>

<br/><br />

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
		<input type="text" name="class_name" id="class_name"  class="col-xs-10 col-sm-5" value="<?php echo $class_name;?>" readonly="readonly"/>
	</div>
</div>
<br><br />

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payament Option </label>
    <div class="col-sm-9">
		<input type="text" name="payment_option" id="payment_option" class="col-xs-10 col-sm-5" style="width:300px;" value="<?php echo $option_master; ?>" readonly="readonly"/>
</div></div>

<br /><br />

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date </label>
    <div class="col-sm-9">
		<input type="text" name="due_date" id="due_date" class="form-control mydatepicker" style="width:300px;" required="" value="<?php echo get_installment_due_date($installment_master_id); ?>"/>
</div></div>

<br /><br /><br />
<?php 
		$total=0;
		$fee_total=0;
		foreach($fee_heads as $fee)
		{
        $fee_head_id= $fee['fee_head_id'];
		$fee_item_amount=get_installment_item_amount($installment_master_id,$fee_head_id);
		$total   = get_fee_item_total($fee_master_id,$fee_head_id);
		$balance = get_fee_item_balance($fee_master_id,$fee_head_id);
		$fee_total = $fee_total+$fee_item_amount;
       ?>
       
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $fee['fee_head']; ?></label>
    <div class="col-sm-9">
      <input type="number" name="fee_head[]" id="fee_head[]" class="col-xs-10 col-sm-5" style="width:200px;"  required="" onChange="feeTotal()"   
      value="<?php echo $fee_item_amount; ?>"/>
       <?php echo "&nbsp;&nbsp;&nbsp;<i>Balance : " . number_format($balance,2) . "/-<br>&nbsp;&nbsp;&nbsp;Total : " . number_format($total,2) ."/-"; ?></i>
     <input type="hidden" name="fee_head_id[]" id="fee_head_id[]" class="form-control" style="width:300px;"  value="<?php echo $fee_head_id;?>"/>
      </div></div>
       <br><br />
<?php
$total=$total+$fee['fee_amount'];
}?>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total </label>
    <div class="col-sm-9">
 		 <input type="text" name="total" id="total" class="col-xs-10 col-sm-5" style="width:300px;" value="<?php echo $fee_total;?>" readonly="readonly" required=""/>
 </div></div>
<br /><br />
<button type="submit" class="btn btn-success" style="margin-left:400px;" name="btn_save">
        Save
       
    </button>
<?php echo form_close(); ?>

 </div>                                   

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>




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
	

function feeTotal() {
		var fees = document.getElementsByName('fee_head[]');
		var chkfees = document.getElementsByName('chkfee_details[]');
		var total=0;
		for (var i = 0;  i < fees.length; i++)
		{
		total = total+Number(fees[i].value);
		}   
		document.getElementById('total').value=total;
}
</script>


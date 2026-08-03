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
                       
   <div align="right" style="padding-right:10px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_master'; ?>"><b><button class="btn-info">Back</button></b></a></div>

   
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-7">
    	<div class="row">
            <div class="form-group" style="padding-bottom:30px;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Master Name </label>
                <div class="col-sm-9" >
                    <input type="text" name="name" id="name" class="col-xs-10 col-sm-8"  value="<?php echo $fee_master_name;?>" readonly="readonly"/>
                </div>
            </div>
            <br>
            <div class="form-group" style="padding-bottom:50px;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class </label>
                <div class="col-sm-9">
                    <input type="text" name="class_id" id="class_id" class="col-xs-10 col-sm-8"  value="<?php echo $class_name; ?>" readonly="readonly"/>
                </div>
            </div>

            <div class="form-group" style="padding-bottom:50px;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Total Amount </label>
                <div class="col-sm-9">
                    <input type="text" name="total_amount" id="total_amount" class="col-xs-10 col-sm-8"  value="<?php echo $total_amount; ?>" readonly="readonly"/>
                </div>
            </div>
            
            
        </div>
    </div>
	<div class="col-md-4">
    	<div class="row">
        	<div class="col-md-12" style="visibility:hidden">dsf</div>
        	<div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" style="border:1px solid black;">
                    <?php
                        foreach($fee_head_details as $head):
                        ?>
                    <tr style="border:1px solid black;">
                        <td><?php echo $head['fee_head']; ?></td>
                        <td><?php echo $head['fee_amount']; ?></td>
                    </tr>	
                        <?php
                        endforeach;
                    ?>
                </table>
			</div>
        </div>
    </div>
</div>                        


<div id="msg" class="alert alert-danger" style="display:none;text-align:center" >
  <strong>You can not modify the fee because Fee master is assigned to students.</strong>
</div>
<div class="table-responsive">
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
 	<input type="hidden" name="fee_master_id" id="fee_master_id" value="<?php echo $fee_master_id; ?>" >
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

<span name="set_fee1[]"><a name="set_fee[]" href='<?php echo base_url().'index.php/feeManagement/set_fees/'. $fee_master_id."/".$class_id."/".$details['fee_payment_options_master_id']."/".$details['fee_payment_options_details_id']."/".$details['fee_installment_master_id'];?>'> <i>Edit Fee</i> </a></span></td></tr>
<?php 
$i=$i+1;
}
?>
<tr> <td style="text-align: center;" colspan="3"><b> Total</b></td><td  style="text-align: center;"><b><?php  echo number_format( $total,2);?></b></td><td></td></tr>
</tbody></table>
</div>


</div>
</div>
</div></body>

	 

			
<?php include_once APPPATH . 'views/footer.php'; ?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
		check_fee_master_assigned();
	});
	function check_fee_master_assigned()
	{
		var fee_master_id	=	document.getElementById("fee_master_id").value;

		  $.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/check_fee_master_assigned/' + fee_master_id ,
			async:false,
            success: function(response)
            {
			
				if(parseInt(response)==1)
				{
					disable_set_fee();
					/*set_fee1[0].title				=	"Can not update.This Fee Master is assigned to students";
					set_fee[0].style.pointerEvents	=	"none";
					set_fee[0].style.cursor			=	"default";
					alert(response);*/
					
				}	
            }
        });
	}
	function disable_set_fee()
	{
		var set_fee			=	document.getElementsByName("set_fee[]");
		var set_fee1		=	document.getElementsByName("set_fee1[]");
		var msg				=	document.getElementById("msg");
		
		msg.style.display	=	"block";
		for(var i=0;i<set_fee.length;i++)
		{
			set_fee1[i].title				=	"Can not update.Fee Master is assigned to students";
			set_fee[i].style.pointerEvents	=	"none";
			set_fee[i].style.cursor			=	"default";
			
		}
	}
 </script>

<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">Fee Payment</li>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Modify Fee
								</small>
							</h1>
						</div>  
                <div></div>
                            <!-- #section:elements.form -->
                <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/FeeManagement/student_payment/'; ?>">Choose Another</a></div>
    			<br>
            	<div>
				<?php echo form_open(base_url() . 'index.php/FeeManagement/student_fee_concession_update/'.$students_fee_master_id, array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                    <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                        <thead>
                    		<tr>
                                <td align="center" class="table-header" >SNo.</td>
                                <td align="center" class="table-header" >Fee Head</td>
                                <td align="center" class="table-header" >Total</td>
                                <td align="center" class="table-header" >Paid</td>
                                <td align="center" class="table-header" >Concession</td>
                                <td align="center" class="table-header" >Balance</td>
                                <td align="center" class="table-header" >Remarks</td>
                                <td align="center" class="table-header" ></td>
                            </tr>
                        </thead>
                        <tbody>
                        
                	<?php
					$i	=	1;
					foreach($fee_details as $row):
						$fee_head 		= 	get_fee_head_name($row['fee_head_id']);
						$fee_total 		=	$row['fee_amount'];
						$fee_concession = 	$row['fee_concession'];
						$fee_balance 	= 	$row['fee_balance'];
						$fee_paid		=	$row['fee_amount']-$row['fee_balance']-$row['fee_concession'];
					?>
                    		<tr name="rows[]">
                                <td ><?php echo $i;?></td> 
                                <td ><?php echo $fee_head;?></td> 
                                <td align="right" >
                                	<input type="hidden" name="students_fee_details_id[]" id="students_fee_details_id[]" value="<?php echo $row['students_fee_details_id'];?>" >
                                	<input type="text" name="total[]" id="total[]" value="<?php echo $fee_total;?>" readonly >
                                </td> 
                                <td align="right" >
                                	<input type="text" name="paid[]" id="paid[]" value="<?php echo $fee_paid;?>" readonly >
                                </td>
                                <td  align="right" >
                                	<input type="text" name="concession[]" id="concession[]" value="<?php echo $fee_concession;?>" <?php if($fee_balance==0){echo "readonly";} ?> onChange="calculate_fee();" >
                                
                                </td> 
                                <td align="right" >
                                	<input type="text" name="balance[]" id="balance[]" value="<?php echo $fee_balance ;?>" readonly />
                                </td>
                                <td align="right" >
                                	<input type="text" name="remarks[]" id="remarks[]" value="<?php echo $row['remarks']; ?>" <?php if($fee_balance==0){echo "readonly";} ?> />
                                </td>
                                <td align="center" >
                                	<input type="checkbox" name="fee_head_balance_check[]" id="fee_head_balance_check[]" onChange="calculate_fee();" <?php if($fee_balance==0){echo "disabled";} ?> >
                                    <input type="hidden" id="check_uncheck[]" name="check_uncheck[]" onChange="calculate_fee()">
                                </td>
                            </tr>
                    <?php
						$i=$i+1;	
					endforeach;
					?>
                                    <input type="hidden" id="total_balance" name="total_balance">
                                    <input type="hidden" id="total_concession" name="total_concession">
                            <tr>
                                <td colspan="8" align="center">
                                <button type="submit" class="btn btn-success" name="btn_pay_now" id="btn_pay_now" value="btn_pay_now" onClick="return validate_form()"><b>Update</b>   </button>
                                </td>
                            </tr>
                    	</tbody>
                    </table>
					<?php echo form_close(); ?>
               </div>
    
            </div>
        </div>
    </div>
</body>

			<br><?php include_once APPPATH . 'views/footer.php'; ?>




<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

$(document).ready(function()
	{
		show_popover();
	});

	function show_popover()
	{
		var total 					=  	document.getElementsByName('total[]');
		var fee_head_balance_check 	=  	document.getElementsByName('fee_head_balance_check[]');
		var rows 					=  	document.getElementsByName('rows[]');
		
		for(var i = 0;  i < total.length; i++)
		{
		
			if(fee_head_balance_check[i].disabled==true)
			{
				rows[i].title="Full fees paid,so can not give concession";
			}
			else
			{
				
			}
		}
	}
	
	
	
	function calculate_fee() 
	{
		var total_balance			=	0;
		var total_concession		=	0;
		var total 					=  	document.getElementsByName('total[]');
		var paid 					=  	document.getElementsByName('paid[]');
		var balance 				=  	document.getElementsByName('balance[]');
		var concession 				=  	document.getElementsByName('concession[]');
		var fee_head_balance_check 	=  	document.getElementsByName('fee_head_balance_check[]');
		var check_uncheck 			=  	document.getElementsByName('check_uncheck[]');
		for(var i = 0;  i < total.length; i++)
		{
			if(fee_head_balance_check[i].checked)
			{
				var fee_concession1	=	parseFloat(concession[i].value);
				var fee_balance1	=	parseFloat(balance[i].value);	
				var fee_total1		=	parseFloat(total[i].value);	
				if(fee_concession1 > fee_total1)
				{
					alert("Concession should be less than Amount to Pay");
					concession[i].value=parseFloat(0);
					//document.getElementById("btn_pay_now").disabled = true;
				}
				else
				{
					balance[i].value 		=	parseFloat(parseFloat(total[i].value).toFixed(2) - parseFloat(paid[i].value).toFixed(2) - parseFloat(concession[i].value).toFixed(2)).toFixed(2);
					concession[i].value		=	parseFloat(fee_concession1).toFixed(2);
					check_uncheck[i].value	=	1;
					document.getElementById('btn_pay_now').disabled = false;
				}
			}
			else
			{
				check_uncheck[i].value=0;
			}
			total_balance										=	+parseFloat(total_balance).toFixed(2) + +parseFloat(balance[i].value).toFixed(2);
			total_concession									=	+parseFloat(total_concession).toFixed(2) + +parseFloat(concession[i].value).toFixed(2);
			document.getElementById("total_balance").value		=	total_balance;
			document.getElementById("total_concession").value	=	total_concession;
		}   
		//document.getElementById('amount').value=total;
    }
	
function validate_form()
{
	var total 					=  	document.getElementsByName('total[]');
	var fee_head_balance_check 	=  	document.getElementsByName('fee_head_balance_check[]');
	var checked					=	0;
	for (var i = 0;  i < total.length; i++)
	{
		if(fee_head_balance_check[i].checked)
		{
			checked++;
		}
	}
	if(checked>0)
	{
		
		return true;
	}
	else
	{
		alert("Select atleast one checkbox");
		return false;
	}
}
	
</script>

 
 
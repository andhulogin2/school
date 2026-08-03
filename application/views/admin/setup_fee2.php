<style>
div.fixed {
  position: fixed;
  bottom: 20%;
  right: 0;
  width:10%;
  	  
}
</style> 
 <?php //echo form_open('FeeManagement/save_fee_master/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
 
<?php
if($payment_option==1)
{
?>

<div class="col-md-offset-2 col-md-12 col-md-offset-2">
					<div class="form-group">
						<label class="col-sm-1 for="form-field-1" control-label" style="padding-left:0px;"><?php echo "Due Date "; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-8" style="padding-left:17px;">
						<input type="text" name="due_date" id="due_date" value="<?php echo date('d-m-Y'); ?>" class="col-xs-10 col-sm-5 mydatepicker"  />		
                         </div> 
					</div>                  
<input type="hidden" name="lst_class"  id="class_id" value="<?php echo $class_id; ?>"> 
<input type="hidden"  name="txt_fee_plan_name"  id="txt_fee_plan_name" value="<?php echo $txt_fee_plan_name; ?>"  > 
<input type="hidden"  name="department"  id="department" value="<?php echo $dept_id; ?>"  >                    
<input type="hidden"  name="branch_id"  id="branch_id" value="<?php echo $branch_id; ?>"  >                    
     <div class="table-responsive">   
     
                          
    <table id="simple-table" class="table table-striped table-hover"  cellpadding="2" style="width:70%">
        <tr height="30px" >
        	<td class='table-header'>
            	<b>Fee Item</b>
            </td>
            <td class='table-header'>
            	<b>Amount</b>
            </td>
        </tr>
    <?php
    
    foreach($fee_heads as $items){
    ?>
        <tr height="30px">
        	<td>
        		<input type="checkbox" name="chkfee_details[]"  onClick="feeTotal();check_fields();" value="<?php echo $items["fee_head_id"] ?>"> <?php echo $items["fee_head"] ?>
        	</td>
            <td>
        		<input type="hidden" name="chk_status[]"  id="chk_status[]" value="0"> 
        		<input type="hidden" name="hdnfee_details[]"  value="<?php echo $items["fee_head_id"] ?>"> 
        		<input type="number" name="fee_details[]" id="fee_details[]" class="fee_details" min="0"  value="0">
        	</td>
        </tr>
    
    <?php } ?>
    	<tr>
        	<td>
    			<b>Total</b></label>
    		</td>
            <td align="left">
            	<input type="number"  name="total" id="total" value="0" readonly="readonly" >
    		</td>
        </tr>
    	<tr  height="50px">
        	<td colspan="2">
        
                <button type="submit" class="btn btn-success" style="margin-left:150px;" name="btn_Save" id="btn_Save" value="Save">
                    Save
                </button>
        	</td>
        </tr>
    </table>
    </div>
</div>
<?php
}
else if($payment_option==2)
{
	?>
<input type="hidden" name="lst_class"  id="class_id" value="<?php echo $class_id; ?>"> 
<input type="hidden"  name="txt_fee_plan_name"  id="txt_fee_plan_name" value="<?php echo $txt_fee_plan_name; ?>"  >   
<input type="hidden"  name="lst_payment_option"  id="lst_payment_option" value="<?php echo $payment_option; ?>"  >
<input type="hidden"  name="department"  id="department" value="<?php echo $dept_id; ?>"  > 
<input type="hidden"  name="branch_id"  id="branch_id" value="<?php echo $branch_id; ?>"  > 

        <div class="col-md-offset-2 col-md-8" style="text-align:center" >
        	
        	<?php
			//print_r($installments);
			$i=1;
            foreach($installments as $items)
            {
			?>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align:left;background-color:#FFAAA6;font-size:14px" id="heading_<?php echo $i; ?>">
                        	<span id="show_hide_btn_<?php echo $i; ?>" style="cursor:pointer;" title="Show Fee Heads" onclick="show_hide(<?php echo $i; ?>)"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>&nbsp;&nbsp;
                        	<input type="checkbox"  name="chk_installments[]" id="installment_<?php echo $i; ?>" onClick="show_hide1(<?php echo $i; ?>);check_installments(<?php echo $i; ?>,<?php echo $items["fee_payment_options_details_id"] ?>)" <?php if ($i==1){ echo 'required=""';}else{ echo 'disabled'; } ?> value="<?php echo $items["fee_payment_options_details_id"] ?>">
                            <input type="hidden" name="hdn_installments[]"  value="0"> 
                        	<b><?php echo $items["fee_payment_options_details"] ?></b>
                        </div>
                        <div class="panel-body" style="padding-left:6%;text-align:left;display:none;" id="body_<?php echo $i; ?>" >
                            	<div style="padding:2px 0px 40px 0px;"> 
									<div class="col-md-4">
                                    	Due Date
                                    </div>
                                    <div class="col-md-8"> 
                                    	<input type="text" class="form-control mydatepicker"  name="<?php echo $items["fee_payment_options_details_id"]; ?>_due_date" id="<?php echo $items["fee_payment_options_details_id"]; ?>_due_date" value="<?php echo date('d-m-Y'); ?>"  />
                                    </div>
                                </div>
							<?php
							$j=1;
                            foreach($fee_heads as $items1)
							{
                            ?>
                            	<div style="padding:2px 0px 40px 0px;"> 
									<div class="col-md-4">
                                    	
                                        <input type="checkbox" name="<?php echo $items["fee_payment_options_details_id"]; ?>_fee_head[]" id="<?php echo $items["fee_payment_options_details_id"].'_'.$j; ?>_fee_head"  onClick="check_uncheck(<?php echo $items["fee_payment_options_details_id"].','.$j.','.$i; ?>)" value="<?php echo $items1["fee_head_id"]; ?>"> 
                                        &nbsp;
                                        <?php echo $items1["fee_head"] ?>   
                                  	</div>   
                                    <div class="col-md-8"> 
                                        <input type="number" name="<?php echo $items["fee_payment_options_details_id"].'_'.$items1["fee_head_id"]; ?>_fee_amount" id="<?php echo $items["fee_payment_options_details_id"].'_'.$j; ?>_fee_amount" min="0" onclick="set_hidden_amount(<?php echo $items["fee_payment_options_details_id"]; ?>,this.value)" onChange="mark_tick(<?php echo $items["fee_payment_options_details_id"].','.$j.','.$i; ?>,this);"   value="0"  class="form-control">
                                    </div>           
                              	</div>     
                                              
							<?php
							$j++;
							}
							?>
                            	<div style="padding:2px 0px 40px 0px;"> 
									<div class="col-md-4">
                                    	Total
                                    </div>
                                    <div class="col-md-8"> 
                                    	<input type="text" name="<?php echo $items["fee_payment_options_details_id"]; ?>_fee_total" id="<?php echo $items["fee_payment_options_details_id"]; ?>_fee_total" readonly value="0"  class="form-control">
                                        <input type="hidden" name="<?php echo $items["fee_payment_options_details_id"]; ?>_hidden_amount" id="<?php echo $items["fee_payment_options_details_id"]; ?>_hidden_amount"  />
                                    </div>
                                </div>
                        </div>
                    </div>
                </div> 
            <?php
			$i++;
			}
			?>  
            <div style="text-align:center">
                <button type="submit" class="btn btn-success" name="btn_save_and_continue" id="btn_save_and_continue" value="btn_save_and_continue">
                    Save      
                </button>
                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse display">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
            </div>
        </div>   
        <div class="col-md-2 fixed" id="grand_total_div" style="text-align:center;vertical-align:middle;display:none;">
        	<div>Total Amount</div>
        	<input type="text" name="grand_total" id="grand_total" class="form-control" readonly="readonly" style="border:1px solid #999999" value="0" />
        </div>
<?php
}
else 
{
	echo $message;
}

?>

 <?php //echo form_close();?>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {
		$('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: "dd-mm-yy"
        });
		check_fields();
	});
	function check_uncheck(fee_payment_options_details_id,j,l)
	{	
		amount	=	0;
		if($('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked')==false)
		{	//alert();
			var chk_box			=	$('[name="'+fee_payment_options_details_id+'_fee_head[]"]');
			var chk_box_count	=	0;
			for(var k=0;k<chk_box.length;k++)
			{
				if(chk_box[k].checked==true)
				{
					chk_box_count++;
				}
			}
			if(chk_box_count==0)
			{	
				if($('#installment_'+(l+1)).length>0)
				{
					var next_fee_payment_options_details_id	=	$('#installment_'+(l+1)).val();
					var chk_box1							=	$('[name="'+next_fee_payment_options_details_id+'_fee_head[]"]');
					var chk_box_count1						=	0;
					for(var k=0;k<chk_box1.length;k++)
					{
						if(chk_box1[k].checked==true)
						{
							chk_box_count1++;
							break;
						}
					}
					if(chk_box_count1>0)
					{
						alert("Atleast one fee head checkbox must be ticked");
						$('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked',true);
						//elm.value	=	$('#'+fee_payment_options_details_id+'_hidden_amount').val();
					}
					else if(chk_box_count1==0)
					{
						//$('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked',false);
						//$('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val('0');
						amount		=	parseInt($('#'+fee_payment_options_details_id+'_fee_total').val())-parseInt($('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val());
						$('#'+fee_payment_options_details_id+'_fee_total').val(amount);
						$('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val('0')
						var tot_amount	=	0;
						<?php
						for($i=0;$i<count($installments);$i++)
						{
						?>
							var id			=	'<?php echo $installments[$i]['fee_payment_options_details_id']; ?>';
							tot_amount		=	parseInt(tot_amount)+parseInt($('#'+id+'_fee_total').val());
						<?php	
						}
						?>
						$('#grand_total_div').show();
						$('#grand_total').val(tot_amount);
						$('#installment_'+l).prop('checked',false);
						check_installments(l);
					}
				}
				else //If the fee head in last installment is unchecked...
				{
					amount		=	parseInt($('#'+fee_payment_options_details_id+'_fee_total').val())-parseInt($('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val());
					$('#'+fee_payment_options_details_id+'_fee_total').val(amount);
					$('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val('0')
					var tot_amount	=	0;
					<?php
					for($i=0;$i<count($installments);$i++)
					{
					?>
						var id			=	'<?php echo $installments[$i]['fee_payment_options_details_id']; ?>';
						tot_amount		=	parseInt(tot_amount)+parseInt($('#'+id+'_fee_total').val());
					<?php	
					}
					?>
					$('#grand_total_div').show();
					$('#grand_total').val(tot_amount);
					$('#installment_'+l).prop('checked',false);
					check_installments(l);
				}
			}
			else
			{
					amount		=	parseInt($('#'+fee_payment_options_details_id+'_fee_total').val())-parseInt($('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val());
					$('#'+fee_payment_options_details_id+'_fee_total').val(amount);
					$('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val('0')
					var tot_amount	=	0;
					<?php
					for($i=0;$i<count($installments);$i++)
					{
					?>
						var id			=	'<?php echo $installments[$i]['fee_payment_options_details_id']; ?>';
						tot_amount		=	parseInt(tot_amount)+parseInt($('#'+id+'_fee_total').val());
					<?php	
					}
					?>
					$('#grand_total_div').show();
					$('#grand_total').val(tot_amount);
			}
		}
		else
		{
			var chk_box			=	$('[name="'+fee_payment_options_details_id+'_fee_head[]"]');
			var chk_box_count	=	0;
			for(var k=0;k<chk_box.length;k++)
			{
				if(chk_box[k].checked==true)
				{
					chk_box_count++;
				}
			}
			if(chk_box_count>0)
			{	
				if($('#installment_'+(l-1)).length>0)
				{
					var next_fee_payment_options_details_id	=	$('#installment_'+(l-1)).val();
					var chk_box1							=	$('[name="'+next_fee_payment_options_details_id+'_fee_head[]"]');
					var chk_box_count1						=	0;
					for(var k=0;k<chk_box1.length;k++)
					{
						if(chk_box1[k].checked==true)
						{
							chk_box_count1++;
							break;
						}
					}
					if(chk_box_count1==0)
					{
						alert("Please select previous installment's fee head first.");
						$('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked',false);
						if(chk_box_count==1)
						{
							$('#installment_'+l).prop('checked',false); 
							check_installments(l);
						}
					}
					else
					{
						$('#installment_'+l).prop('checked',true); 
						check_installments(l);
					}
				}
			}
		
		}
	}
	
	function set_hidden_amount(fee_payment_options_details_id,amount)
	{
		$('#'+fee_payment_options_details_id+'_hidden_amount').val(amount);
	}
	
	function mark_tick(fee_payment_options_details_id,j,i,elm)
	{
		
		if($('#installment_'+i).prop('disabled')==false)									//If installment checkbox is enabled...
		{
			$('#installment_'+i).prop('checked',true);  									//Tick the installment checkbox
			$('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked',true);	//Tick the fee head checkbox
			check_installments(i);															//Enable the next installment checkbox
			calc_amount(fee_payment_options_details_id,j,i,elm);
			/*$('#grand_total_div').show();
			var tot_amount		=	parseInt($('#grand_total').val())+parseInt(elm.value);
			$('#grand_total').val(tot_amount);*/
		}
		else
		{
			alert("Plese tick the installment checkbox");
			elm.value	=	'0';
		}
		
	}
	function calc_amount(fee_payment_options_details_id,j,l,elm)
	{
		var amount	=	0;
		
		if($('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val()=='')
		{
			var chk_box			=	$('[name="'+fee_payment_options_details_id+'_fee_head[]"]');
			var chk_box_count	=	0;
			for(var k=0;k<chk_box.length;k++)
			{
				if(chk_box[k].checked==true)
				{
					chk_box_count++;
				}
			}
			if(chk_box_count==1)
			{
				if($('#installment_'+(l+1)).length>0)
				{
					var next_fee_payment_options_details_id	=	$('#installment_'+(l+1)).val();
					var chk_box1							=	$('[name="'+next_fee_payment_options_details_id+'_fee_head[]"]');
					var chk_box_count1						=	0;
					for(var k=0;k<chk_box1.length;k++)
					{
						if(chk_box1[k].checked==true)
						{
							chk_box_count1++;
							break;
						}
					}
					if(chk_box_count1>0)
					{
						alert("Atleast one fee head checkbox must be ticked");
						elm.value	=	$('#'+fee_payment_options_details_id+'_hidden_amount').val();
					}
					else if(chk_box_count1==0)
					{
						$('#'+fee_payment_options_details_id+'_'+j+'_fee_head').prop('checked',false);
						$('#'+fee_payment_options_details_id+'_'+j+'_fee_amount').val('0');
						$('#installment_'+l).prop('checked',false);
						check_installments(l);
					}
				}
			}
		}
		
		//Calculate total amount
		for(var i=1;i<=(<?php echo count($fee_heads); ?>);i++)
		{
			if($('#'+fee_payment_options_details_id+'_'+i+'_fee_head').prop('checked')==true)		//If fee head checkbox is ticked...
			{
				if($('#'+fee_payment_options_details_id+'_'+i+'_fee_amount').val()=='')				//If fee amount is blank...
				{
					$('#'+fee_payment_options_details_id+'_'+i+'_fee_amount').val('0');				//Set fee amount to 0
					//chk_box		=	$('[name="'+fee_payment_options_details_id+'_fee_head[]"]');
					
					$('#'+fee_payment_options_details_id+'_'+i+'_fee_head').prop('checked',false);	
				}
				amount	=	parseInt(amount)+parseInt($('#'+fee_payment_options_details_id+'_'+i+'_fee_amount').val());
			}
		}
		$('#'+fee_payment_options_details_id+'_fee_total').val(amount);
		var tot_amount	=	0;
		<?php
		for($i=0;$i<count($installments);$i++)
		{
		?>
			var id			=	'<?php echo $installments[$i]['fee_payment_options_details_id']; ?>';
			tot_amount		=	parseInt(tot_amount)+parseInt($('#'+id+'_fee_total').val());
		<?php	
		}
		?>
		$('#grand_total_div').show();
		$('#grand_total').val(tot_amount);
	}
	function show_hide(num)
	{
		if($('#body_'+num).css('display')=='none')
		{
			$('#body_'+num).show(500);	
			$('#show_hide_btn_'+num).html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
			$('#show_hide_btn_'+num).attr('title','Hide Fee Heads');
		}
		else
		{
			$('#body_'+num).hide(500);	
			$('#show_hide_btn_'+num).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
			$('#show_hide_btn_'+num).attr('title','Show Fee Heads');
		}
	}
	function show_hide1(num)
	{ 
		if($('#installment_'+num).prop('checked')==true)
		{
			$('#body_'+num).show(500);	
			$('#show_hide_btn_'+num).html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
			$('#show_hide_btn_'+num).attr('title','Hide Fee Heads');
		}
		if($('#installment_'+num).prop('checked')==false)
		{
			$('#body_'+num).hide(500);	
			$('#show_hide_btn_'+num).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
			$('#show_hide_btn_'+num).attr('title','Show Fee Heads');
		}
	}
	
	
function feeTotal() {

  var chk_staus 	= 	document.getElementsByName('chk_status[]');
  var check_box		=	document.getElementsByName('chkfee_details[]');
  var fees 			=	document.getElementsByName('fee_details[]');
  var total=0;
 
  for (var i = 0;  i < chk_staus.length; i++)
   {
  
	   if(check_box[i].checked)
	   {
		   total = total+Number(fees[i].value);
		   chk_staus[i].value=1;
	   }
	   else
	   {
		chk_staus[i].value=0;
		fees[i].value=0;
		}
	}   
  document.getElementById('total').value=total.toFixed(0);
}


function check_installments(num,fee_payment_options_details_id) {

// chk_installments
// hdn__installments
	//alert($('#installment_'+num).prop('checked'));
	if($('#installment_'+num).prop('checked')==true)
	{
		if($('#installment_'+(num+1)).length>0)
		{
			$('#installment_'+(num+1)).prop('disabled',false);
		}
	}
	else
	{
	
		if(typeof fee_payment_options_details_id !== 'undefined')
		{
			amount	=	0;
			for(var i=1;i<=(<?php echo count($fee_heads); ?>);i++)
			{
				if($('#'+fee_payment_options_details_id+'_'+i+'_fee_head').prop('checked')==true)		//If fee head checkbox is ticked...
				{
					$('#'+fee_payment_options_details_id+'_'+i+'_fee_amount').val('0');				//Set fee amount to 0
					//chk_box		=	$('[name="'+fee_payment_options_details_id+'_fee_head[]"]');
					
					$('#'+fee_payment_options_details_id+'_'+i+'_fee_head').prop('checked',false);	
					amount	=	parseInt(amount)+parseInt($('#'+fee_payment_options_details_id+'_'+i+'_fee_amount').val());
				}
			}
			$('#'+fee_payment_options_details_id+'_fee_total').val(amount);
			var tot_amount	=	0;
			<?php
			for($i=0;$i<count($installments);$i++)
			{
			?>
				var id			=	'<?php echo $installments[$i]['fee_payment_options_details_id']; ?>';
				tot_amount		=	parseInt(tot_amount)+parseInt($('#'+id+'_fee_total').val());
			<?php	
			}
			?>
			$('#grand_total_div').show();
			$('#grand_total').val(tot_amount);
		}
	
		//Make next installment checkbox disabled.	
		while($('#installment_'+(num+1)).length>0)
		{
		 	$('#installment_'+(num+1)).prop('checked',false);
			$('#installment_'+(num+1)).prop('disabled',true);
			num++;
		}
	}	
	var check_box		=	document.getElementsByName('chk_installments[]');
	var installments	=	document.getElementsByName('hdn_installments[]');
	var checked1		=	0;
	
	for (var i = 0;  i < installments.length; i++)
	{
		if(check_box[i].checked)
		{
			installments[i].value=check_box[i].value;
			checked1++;
		}
		else
		{
			installments[i].value=0;
		}
		
		/*if(i!=0)
		{
			if(check_box[i].checked == true && check_box[i-1].checked == false)		
			{
				//check_box[i].checked = false;
				alert("Please select continous installments");
			}
		}*/
	}
	if(checked1==0)
	{
		$( "#btn_save_and_continue" ).prop( "disabled", true );
	}
	else
	{
		//check_fields();
		$( "#btn_save_and_continue" ).prop( "disabled", false );
	}
	
}
function check_fields()
{
	//alert();
		if($('#lst_payment_option').val()== 1)
		{	
			var check_box		=	document.getElementsByName('chkfee_details[]');
			var checked			=	0;
			for(var i=0;i<check_box.length;i++)
			{
				if(check_box[i].checked)
				{
					checked++;
				}
			}
			
			if(checked==0 || $('#class').val()=='' || $('#txt_fee_plan_name').val()=='' ||  $('#due_date').val()=='' || $('#total').val()==0)
			{
				$( "#btn_Save" ).prop( "disabled", true );
			}
			else
			{
				$( "#btn_Save" ).prop( "disabled", false );
				checked = 0;
			}
		}	
		if($('#lst_payment_option').val()== 2)
		{
			var check_box		=	document.getElementsByName('chkfee_details[]');
			var checked			=	0;
			for(var i=0;i<check_box.length;i++)
			{
				if(check_box[i].checked)
				{
					checked++;
				}
			}
			if(checked==0 || $('#class').val()=='' || $('#txt_fee_plan_name').val()=='' ||  $('#due_date').val()=='' || $('#total').val()==0)
			{
				$( "#btn_save_and_continue" ).prop( "disabled", true );
			}
			else
			{
				$( "#btn_save_and_continue" ).prop( "disabled", false );
				checked = 0;
			}
		}	

} 
</script>



<?php
if($payment_option==1)
{
?>
  				<div class="form-group" style="margin-left:175px;">
						<label for="field-2" class="col-sm-4 control-label"><?php echo "Due Date "; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-6">
							<input type="text" name="due_date" id="due_date" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />		
                         </div> 
					</div>      
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="margin-left:200px;">
	<tr height="30px" ><td width="240" class='table-header'><b>Fee Item</b></td><td class='table-header'><b>Amount</b></td>
		</tr>
<?php

foreach($fee_heads as $items){
?>
<tr height="30px"><td>
<input type="checkbox" name="chkfee_details[]"  onClick="feeTotal()" value="<?php echo $items["fee_head_id"] ?>"> <?php echo $items["fee_head"] ?>
</td><td>
<input type="hidden" name="chk_status[]"  id="chk_status[]" value="0"> 
<input type="hidden" name="hdnfee_details[]"  value="<?php echo $items["fee_head_id"] ?>"> 
<input type="number" name="fee_details[]" id="fee_details[]"  onChange="feeTotal()"  value="0">
</td></tr>

<?php } ?>
<tr><td>
<b>Total</b></label>
</td><td align="left"><input type="number"  name="total" id="total" value="0" readonly="readonly">
</td></tr>
<tr  height="50px"><td colspan="2">

    <button type="submit" class="btn btn-success" style="margin-left:150px;" name="btn_Save" id="btn_Save" value="Save">
        Save
    </button>

</table>
<?php
}
else if($payment_option==2)
{
	?>
<table style="margin-left:200px;width:100%;padding-left:50px"  >    
  <tr>
    <td width="448" height="146" valign="top" >
   	  <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" >
		<tr height="30px"><td width="240" class='table-header'><b>Installments</b></td>
		</tr>
<?php
$i=1;
	foreach($installments as $items)
	{
	
	
	?>
    <tr height="30px"><td>
		<input type="checkbox"  name="chk_installments[]" onClick="check_installments()" <?php if ($i==1) echo 'required=""' ?> value="<?php echo $items["fee_payment_options_details_id"] ?>"> <?php echo $items["fee_payment_options_details"] ?>
		<input type="hidden" name="hdn__installments[]"  value="0"> 
		</td></tr>
     <?php
	 $i=$i+1;
	 }
	 ?>
</table></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td>
<td width="590" valign="top">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" >
  <tr height="30px"><td class='table-header'>Fee Items</td><td class='table-header'>Amount</td></tr>
<?php

foreach($fee_heads as $items){
?>
<tr height="30px"><td style="white-space: nowrap">
<input type="checkbox" name="chkfee_details[]"  onClick="feeTotal()" value="<?php echo $items["fee_head_id"] ?>"> <?php echo $items["fee_head"] ?>
</td><td width="68%">
<input type="hidden" name="chk_status[]"  id="chk_status[]" value="0"> 
<input type="hidden" name="hdnfee_details[]"  value="<?php echo $items["fee_head_id"] ?>"> 
<input type="number" name="fee_details[]" id="fee_details[]"  onChange="feeTotal()"  value="0">
</td></tr>

<?php } ?>
<tr><td>
<b>Total</b></label>
</td><td align="left"><input type="number"  name="total" id="total" value="0" readonly="readonly">
</td></tr>
</table>
<tr  height="50px"><td colspan="2">
        <button type="submit" class="btn btn-success" style="margin-left:150px;" name="btn_save_and_continue" id="btn_save_and_continue" value="btn_save_and_continue">
            Save and Continue        </button>

</table>

<?php
}
else 
{
	echo $message;
}

?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
		})

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
  document.getElementById('total').value=total.toFixed(0);;
}


function check_installments() {

// chk_installments
// hdn__installments

  var check_box		=	document.getElementsByName('chk_installments[]');
  var installments	=	document.getElementsByName('hdn__installments[]');
 
  for (var i = 0;  i < installments.length; i++)
   {
   if(check_box[i].checked)
		installments[i].value=check_box[i].value
   else
	    installments[i].value=0;
	}
}

</script>


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

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
        		<input type="number" name="fee_details[]" id="fee_details[]" class="fee_details" min="0"  value="0" onchange="feeTotal();check_fields();">
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
			//alert(checked);
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

} 
</script>




<?php echo form_open(base_url() . 'index.php/Transport_management/deassign_student_bus/', array('class' => 'form', 'enctype' => 'multipart/form-data','id' => 'reassign_payment')); ?>
<input type="hidden" name="class"      id="class"       value="<?php echo $class_id;?>">
<input type="hidden" name="section"    id="section"     value="<?php echo $section;?>">
<input type="hidden" name="student_id" id="student_id"  value="<?php echo $student_id;?>">
<input type="hidden" name="branch_id"  id="branch_id"   value="<?php echo $branch_id;?>">
<br />
<br />
<?php foreach($student as $data){?>
<table id="simple-table" class="table table-striped table-hover"  cellpadding="2">
<tr>
 <td style="text-align: left;">Name : <?php echo $data['name'];?></td>
 <td style="text-align: left;">Date Of Birth : <?php echo $data['birthday'];?></td> 
 <td style="text-align: left;">Gender : <?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: left;">Class  : <?php echo get_class_name($class_id); ?></td>
 <td style="text-align: left;">Section  : <?php echo get_section_name($section); ?></td>
 <td style="text-align: left;"></td>
 </tr>
<tr>
 <td style="text-align: left;">Address : <?php echo $data['address'];?></td>
 <td style="text-align: left;">Phone Number : <?php echo $data['phone1'];?></td>
 <td style="text-align: left;">Email : <?php echo $data['email'];?></td>
 </tr>
<?php }?>

<tr><td colspan="3">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
  <thead>
  <tr>
  <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
  <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
  <th style="text-align: right;" class="table-header"><b>Amount to Pay</b></th>
  <th style="text-align: right;" class="table-header"><b>Paid Amount</b></th>
  <th style="text-align: right;" class="table-header"><b>Balance</b></th>
  <th style="text-align: center;" class="table-header"><b>Status</b></th>
</tr>
</thead>
<tbody>
<?php
$no=1;

$total_amount_to_pay = 0;
$total_amount_paid = 0;
$total_amount_balance = 0;
$total_amount_concession = 0;


if (count($result)==0)
{
echo "<tr><th colspan='8'  style='text-align: center;'><font color='red'><b>No Fee Schedule Found</b></font> </th></tr></table>";
die();
}

foreach($result as $data){
?>
<tr>
<input type="hidden" name="students_bus_fee_master_id[]" id="students_bus_fee_master_id[]" value="<?php echo $data['students_bus_fee_master_id'];?>">
 <th style="text-align: center;" > <?php echo $no;?> &nbsp;&nbsp;</th>
 <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
 <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
<th style="text-align: left; padding-left:50px;">
<input type="checkbox" name="balance_check[]" id="balance_check[]" value="" onClick="Total()" <?php if(/*$data['fee_amount'] != $data['fee_balance']+$data['fee_concession'] || */$data['fee_balance'] == 0){ echo 'data-toggle="tooltip" title="Some or full payment is done.So can not reassign" disabled'; } ?>>
<?php if( $data['fee_balance']>0 )
echo " Pending";
else
echo " Paid    "; 
?>
</th>
<?php
$total_amount_to_pay		 = $total_amount_to_pay+$data['fee_amount'];
$total_amount_paid 			 = $total_amount_paid+$paid;
$total_amount_balance		 = $total_amount_balance+$data['fee_balance'];
$total_amount_concession	 = $total_amount_concession+$data['fee_concession'];

if( $data['fee_concession']>0)
$url = "index.php/modal/popup/view_payment_details/" .  $data['students_bus_fee_master_id']."/".$class_id  ."/". $section ."/". $student_id;
else
$url= "index.php/modal/popup/edit_payment_details/" .  $data['students_bus_fee_master_id']."/".$class_id  ."/". $section ."/". $student_id;

?>
<input type="hidden" id="check_balance[]" name="check_balance[]" value="<?php echo  $data['fee_balance'] ;?>" onChange="Total()">
<input type="hidden" name="check_uncheck[]" id="check_uncheck[]" onChange="Total()">
</th></tr>

<?php $no++;} ?>
<tr>
 <td style="text-align: center;" colspan="2"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
 <td style="text-align: right;" colspan="2"></td>
</tr>

<tr>
    <td colspan="8" align="center">
    <button type="button" class="btn btn-success" name="reassign" id="reassign" value="btn_pay_now" onclick="reassign_student_bus();"> <b>  Reassign </b>   </button>
    <button type="submit" class="btn btn-success" name="deassign" id="deassign" value="btn_pay_now" onclick="return confirm('Do you want to deassign student?');"><b>Deassign </b>   </button>
    </td>
</tr>
</tbody>
</table>
</td></tr></table>
<div id="reassign_to_bus"></div>



<?php echo form_close(); ?>


<script type="text/javascript">
$(document).ready(function(){
	document.getElementById("reassign").disabled = true;	
	document.getElementById("deassign").disabled = true;	
});	

function Total()
{
	//alert("Hi");
	var chkbalance 		=	document.getElementsByName('balance_check[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck[]');	
 	var count			=	0;
	for (var i = 0;  i < chkbalance.length; i++)
	{
		if(chkbalance[i].checked)
		{
			count++;
			check_uncheck[i].value=1;
		}
		else
		{
			
			check_uncheck[i].value=0;
		}
	}   
	if(count == 0)
	{
		alert("Please select atleast one checkbox");
		document.getElementById("reassign").disabled = true;
		document.getElementById("deassign").disabled = true;
	}
	else
	{
		document.getElementById("reassign").disabled = false;
		document.getElementById("deassign").disabled = false;
	}
}
function reassign_student_bus()
{
	var answer 		=	confirm('Do you want to reassign student?');
	if(answer)
	{
		var student_id			=	document.getElementById("student_id").value;
		var branch_id			=	document.getElementById("branch_id").value;
		
		var master_id 			=	document.getElementsByName('students_bus_fee_master_id[]');	
		var chkbalance 			=	document.getElementsByName('balance_check[]');	
		var check_uncheck		=	document.getElementsByName('check_uncheck[]');
		var student_master_id	=	[];	
		var count				=	0;
		for (var i = 0;  i < chkbalance.length; i++)
		{
			if(chkbalance[i].checked)
			{
				student_master_id.push(master_id[i].value); 
			}
		}  
		var myJSONText = JSON.stringify( student_master_id );
		$.ajax({
			type: "POST",
			url: '<?php echo base_url();?>index.php/Transport_management/reassign_student_bus/' + student_id + '/' + branch_id ,
			data: { checked_ids : myJSONText },
			success: function(response)
			{
				jQuery('#reassign_to_bus').html(response);
			}
		});
	}
	else
	{
		jQuery('#reassign_to_bus').hide();
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
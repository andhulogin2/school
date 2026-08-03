
<?php echo form_open(base_url() . 'index.php/Transport_management/bus_fee_concession_update/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="class"      id="class"       value="<?php echo $class_id;?>">
<input type="hidden" name="section"    id="section"     value="<?php echo $section;?>">
<input type="hidden" name="student_id" id="student_id"  value="<?php echo $student_id;?>">
<br />
<br />
<?php foreach($student as $data){?>
<table id="simple-table" class="table table-striped table-hover"  cellpadding="2">
<tr>
 <td style="text-align: left;">Name : <?php echo $data['name'];?></td>
 <td style="text-align: left;">Admission No. : <?php echo $data['admission_number']; ?></td>
 <td style="text-align: left;">Gender : <?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: left;">Date Of Birth : <?php echo $data['birthday'];?></td> 
 <td style="text-align: left;">Class  : <?php echo get_class_name($class_id); ?></td>
 <td style="text-align: left;">Section  : <?php echo get_section_name($section); ?></td>
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
  <th style="text-align: right;" class="table-header"><b>Concession</b></th>
  <th style="text-align: left;padding-left:50px;" class="table-header"><b><input type="checkbox" name="check_all" id="check_all" onClick="checkAll()"></b></th>
</tr>
</thead>
<tbody>
<?php
/*$this->db->select('students_bus_fee_master_id,due_date,fee_amount,fee_balance,fee_concession');
$this->db->from('tbl_transport_students_bus_fee_master');
//$this->db->where('class_id',$class_id);
$this->db->where('student_id',$student_id);
$this->db->where('fee_amount>0');
$this->db->order_by("due_date","asc");

$result=$this->db->get()->result_array();*/
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
 <th style="text-align: right;"><?php echo date('d-m-Y',strtotime($data['due_date']));?></th>
 <th style="text-align: right;"><input type="text" name="fee_amount[]" id="fee_amount[]" value="<?php echo  number_format($data['fee_amount'],2) ;?>" onkeyup="Total()" /></th>
 <th style="text-align: right;"><input type="text" name="paid_amount[]" id="paid_amount[]" value="<?php echo  number_format($data['fee_amount']-$data['fee_balance'],2) ;?>" readonly /></th>
 <th style="text-align: right;"><input type="text" name="fee_balance[]" id="fee_balance[]" value="<?php echo  number_format($data['fee_balance'],2) ;?>" readonly /></th>
 <th style="text-align: right;">
     <input type="text" name="fee_concession[]" id="fee_concession[]" value="<?php echo  number_format($data['fee_concession'],2) ;?>" onblur="Total()"/>
     <div style="color:red" name="msg[]"></div>
 </th>
<th style="text-align: left; padding-left:50px;">
<input type="checkbox" name="balance_check[]" id="balance_check[]" onClick="Total()">
</th>
<?php
$total_amount_to_pay		 = $total_amount_to_pay+$data['fee_amount'];
//$total_amount_paid 			 = $total_amount_paid+$paid;
$total_amount_balance		 = $total_amount_balance+$data['fee_balance'];
$total_amount_concession	 = $total_amount_concession+$data['fee_concession'];

?>
<input type="hidden" id="check_balance[]" name="check_balance[]" value="<?php echo  $data['fee_balance'] ;?>" onChange="Total()">
<input type="hidden" name="check_uncheck[]" id="check_uncheck[]" onChange="Total()">
</th></tr>

<?php $no++;} ?>



<tr>
    <td colspan="8" align="center">
    <button type="submit" class="btn btn-success" name="btn_pay_now" id="btn_pay_now" value="btn_pay_now" onclick="return validate();">      <b>  Update </b>   </button>
    </td>
</tr>
</tbody>
</table>
</td></tr></table>




<?php echo form_close(); ?>


<script type="text/javascript">
	

function Total()
{
//var fee_item_balance = document.getElementsByName('fee_head_balance_check[]');
//var count_item = fee_item_balance.length;
	var balance 		=  	document.getElementsByName('check_balance[]');
	var chkbalance 		=	document.getElementsByName('balance_check[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck[]');	
	var fee_amount		=	document.getElementsByName('fee_amount[]');	
	var paid_amount		=	document.getElementsByName('paid_amount[]');	
	var fee_balance		=	document.getElementsByName('fee_balance[]');	
	var fee_concession	=	document.getElementsByName('fee_concession[]');
	//var total=Number(late_fee.value);
  for (var i = 0;  i < balance.length; i++)
   	{
		if(chkbalance[i].checked)
		{
			var fee_concession1	=	parseFloat(fee_concession[i].value);	
			var fee_balance1	=	parseFloat(fee_balance[i].value);	
			var fee_amount1		=	parseFloat(fee_amount[i].value);	
			var paid_amount1		=	parseFloat(paid_amount[i].value);	
			if(fee_concession1 > fee_amount1)
			{
				alert("Concession should be less than Amount to Pay");
				document.getElementById("btn_pay_now").disabled = true;
			}else if(fee_amount1 < paid_amount1)
			{
				alert("Amount should Greater than Amount Paid");
				document.getElementById("btn_pay_now").disabled = true;
			}
			else
			{
			fee_balance[i].value 	=	parseFloat(parseFloat(fee_amount[i].value).toFixed(2) - parseFloat(fee_concession[i].value).toFixed(2) - parseFloat(paid_amount1).toFixed(2)).toFixed(2);
			fee_concession[i].value	=	parseFloat(fee_concession1).toFixed(2);
			check_uncheck[i].value=1;
			document.getElementById('btn_pay_now').disabled = false;
			}
			
		}
		else
			check_uncheck[i].value=0;
 	}   
  document.getElementById('amount').value=total;
}
function validate()
{
    var chk_count       =   0;
    var msg_count       =   0;
    var chkbalance 		=	document.getElementsByName('balance_check[]');
    var fee_concession	=	document.getElementsByName('fee_concession[]');
    var msg	            =	document.getElementsByName('msg[]');
    for (var i = 0;  i < chkbalance.length; i++)
   	{
   	    msg[i].innerHTML =  "";
		if(chkbalance[i].checked)
		{
		    chk_count++; 
		  //  if(fee_concession[i].value =='0.00')
		    if(fee_concession[i].value < 0)
		    {
		        msg_count++;
		        fee_concession[i].focus();
		      //  msg[i].innerHTML =  "Please enter amount greater than 0";
		        msg[i].innerHTML =  "Please enter a valid amount";
		        //return false;
		        //break;
		    }
		}  
   	}	
   	if(chk_count>0 && msg_count==0)
   	{
   	    return true;
   	}
   	else if(chk_count==0)
   	{
   	    alert("Please select atleast one checkbox");
   	    return false;
   	}
   	else
   	{
   	    return false;
   	} 
   	
}
function checkAll()
{
    var check_all   =   document.getElementById('check_all');
    var chkbalance 	=	document.getElementsByName('balance_check[]');
    for (var i = 0;  i < chkbalance.length; i++)
    {
        if(check_all.checked==true)
        {
            chkbalance[i].checked   =   true;    
        }
        else
        {
            chkbalance[i].checked   =   false; 
        }
    }

}
</script>



<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  
                                                         

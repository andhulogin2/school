<?php echo form_open(base_url() . 'index.php/Transport_management/student_fee_payment/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="class"      id="class"       value="<?php echo $class_id;?>">
<input type="hidden" name="section"    id="section"     value="<?php echo $section;?>">
<input type="hidden" name="student_id" id="student_id"  value="<?php echo $student_id;?>">
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
  <th style="text-align: right;" class="table-header"><b>Concession</b></th>
  <th style="text-align: right;" class="table-header"><b>Balance</b></th>
  <th style="text-align: center;" class="table-header"><b>Status</b></th>
</tr>
</thead>
<tbody>
<?php
$year	=	get_running_year();	

$this->db->select('students_bus_fee_master_id,due_date,fee_amount,fee_balance,fee_concession');
$this->db->from('tbl_transport_students_bus_fee_master');
//$this->db->where('class_id',$class_id);
$this->db->where('student_id',$student_id);
$this->db->where('academic_year',$year);
$this->db->where('is_deleted','N');
$this->db->where('fee_amount>0');
$this->db->order_by("due_date","asc");

$result=$this->db->get()->result_array();
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
 <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
<th style="text-align: left; padding-left:50px;">
<input type="checkbox" name="balance_check[]" id="balance_check[]" onClick="Total()" <?php if( $data['fee_balance'] == 0) { echo "disabled"; } ?> >
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
</tr>

<?php $no++;} ?>
<tr>
 <td style="text-align: center;" colspan="2"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
 <td style="text-align: right;" colspan="2"></td>
</tr>



<tr>
<td colspan="6" align="center"><b>Late Fee</b></td>
<td colspan="2"><b><input type="text" name="late_fee" id="late_fee" value="0" onchange="Total()"></b>
</td>
</tr>
<tr><td colspan="6" align="center"><b>Total</b></td>
<td colspan="2"><b><input type="text" name="amount" id="amount" value="0"></b>
</td>
</tr>
<tr><td colspan="8">
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Receipt Number <font color="#FF0000">* </font></label>
<div class="col-sm-9">
<input type="text" class="col-xs-10 col-sm-5" name="txtreceipt_number" id="txtreceipt_number" value="<?php echo get_receipt_number("Receipt",$branch_id)+1; ?>" onkeyup="check_receipt_exist();" >
</div> 
</div>
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label><div class="col-sm-9" id="msg" style="color:#FF0000"></div>
<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Payment Mode <font color="#FF0000">* </font></label>
<div class="col-sm-9">
        <select name="lstpayment_mode" id="lstpayment_mode" class="col-xs-10 col-sm-5" >
        <option value="Cash"> Cash</option>
        <option value="Card"> Card</option>
        </select>
</div> 
</div>
<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date <font color="#FF0000">* </font></label>
<div class="col-sm-4">
       <input type="text" name="txtdate_paid" id="txtdate_paid"  class="form-control mydatepicker"   value="<?php echo date('d-m-Y');  ?>" width="250px"/>
</div> 
</div>
</td>
</tr>

<tr>
    <td colspan="8" align="center">
    <input type="checkbox" name="chk_send_sms" id="chk_send_sms" /> <b>Send SMS</b>
    <button type="submit" class="btn btn-success" name="btn_pay_now" id="btn_pay_now" value="btn_pay_now">      <b>  Pay Now </b>   </button>
    </td>
</tr>
</tbody>
</table>
</td></tr></table>




<?php echo form_close(); ?>


<script type="text/javascript">
	
function check_receipt_exist()
{
	
	var receipt_number	=	document.getElementById("txtreceipt_number").value;
	var branch_id		=	document.getElementById("branch_id").value;
	var msg				=	document.getElementById("msg");
	var btn_pay_now		=	document.getElementById("btn_pay_now");
	//alert(receipt_number+branch_id);
	$.ajax({
		url: '<?php echo base_url();?>index.php/FeeManagement/check_receipt_exist/' + receipt_number + '/' + branch_id ,
		success: function(response)
		{
			if(parseInt(response) == '1')
			{
				msg.innerHTML			=	"This receipt number already exist.";
				btn_pay_now.disabled	=	true;
			}
			else
			{
				msg.innerHTML			=	"";
				btn_pay_now.disabled	=	false;
			}
		}
	});
}	
function Total()
{

//var fee_item_balance = document.getElementsByName('fee_head_balance_check[]');
//var count_item = fee_item_balance.length;

	var balance =  document.getElementsByName('check_balance[]');
	var chkbalance =document.getElementsByName('balance_check[]');	
	var check_uncheck=document.getElementsByName('check_uncheck[]');	
	var total=Number(late_fee.value);
 
  for (var i = 0;  i < balance.length; i++)
   {
   if(chkbalance[i].checked)
	{
 	   total = total+Number(balance[i].value);
	   check_uncheck[i].value=1;
	   //for(j=0;j<count_item;j++) fee_item_balance[j].checked=false;
	}
	else
	    check_uncheck[i].value=0;
 }   
  document.getElementById('amount').value=total;
}


//////////////////


/*function SubTotal()
{

var fee_item_balance = document.getElementsByName('fee_head_balance_check[]');
var item_count = fee_item_balance.length;
var chkbalance =document.getElementsByName('fee_head_balance_check[]');	
var balance = document.getElementsByName('item_balance[]');
var check =  document.getElementsByName('item_check[]');

var installments = document.getElementsByName('balance_check[]');
var installments_count = installments.length;
var total=Number(late_fee.value);
  for (var i = 0;  i < item_count; i++)
   {
   if(fee_item_balance[i].checked)
	{
 	   total = total+Number(balance[i].value);
	   for(j=0;j<installments_count;j++) 
	   {
	   	installments[j].checked=false;
		check [i].value = balance [i].value;
		}
	}
	else
	  check [i].value =0;
 }   
  document.getElementById('amount').value=total;
}
*/
		
		
/*function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
}*/
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

<?php echo form_open(base_url() . 'index.php/FeeManagement/student_fee_payment/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="branch_id"  id="branch_id"   value="<?php echo $branch_id;?>">
<input type="hidden" name="dept_id"  id="dept_id"   value="<?php echo $dept_id;?>">
<input type="hidden" name="class"      id="class"       value="<?php echo $class_id;?>">
<input type="hidden" name="section"    id="section"     value="<?php echo $section;?>">
<input type="hidden" name="student_id" id="student_id"  value="<?php echo $student_id;?>">
<br />
<br />
<?php foreach($student as $data){?>
<div class="table-responsive">
<table id="simple-table" class="table table-striped table-hover"  cellpadding="2">
<tr>
 <td style="text-align: left;">Name : <?php echo $data['name'];?></td>
 <td style="text-align: left;">Date Of Birth : <?php echo $data['birthday'];?></td> 
 <td style="text-align: left;">Gender : <?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: left;">Admission Number : <?php echo $data['admission_number'];?></td>
 <td style="text-align: left;">Section  : <?php echo get_section_name($section); ?></td>
 <td style="text-align: left;">Class  : <?php echo get_class_name($class_id); ?></td>
 </tr>
<tr>
 <td style="text-align: left;">Address : <?php echo $data['address'];?></td>
 <td style="text-align: left;">Phone Number : <?php echo $data['phone1'];?></td>
 <td style="text-align: left;">Email : <?php echo $data['email'];?></td>
 </tr>
<?php }
$run_year		=	get_running_year();
$run_year_name	=	$this->crud_model->get_year_name($run_year);	

?>


<tr><td colspan="3">

<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
<?php
/************ Opening Balance Start ***************/
/*$qry    =   "select DISTINCT(fee_from_year_id) as fee_from_year_id,academic_year,acdemic_year_id from "
        . "((select DISTINCT(a.fee_from_year_id) as fee_from_year_id,b.academic_year,b.acdemic_year_id from tbl_opening_balance a join tbl_academic_year b on b.acdemic_year_id=a.fee_from_year_id) "
        . "union all (select DISTINCT(a.fee_from_year_id) as fee_from_year_id,b.academic_year,b.acdemic_year_id from tbl_opening_balance_transport a join tbl_academic_year b on b.acdemic_year_id=a.fee_from_year_id)) tbl";   */
/*$this->db->select('DISTINCT(a.fee_from_year_id) as fee_from_year_id,b.academic_year,b.acdemic_year_id');
$this->db->join('tbl_academic_year b','b.acdemic_year_id=a.fee_from_year_id');
$this->db->where('student_id',$student_id);
$prev_years		=	$this->db->get('tbl_opening_balance a')->result_array();*/
$prev_years		=	$this->crud_model->get_op_bal_years($student_id);
//echo $this->db->last_query();die;
foreach($prev_years as $years):
	if($years['acdemic_year_id']<$run_year)
	{
		$op_bal		=	$this->crud_model->get_op_bal_details($student_id,$years['acdemic_year_id']);	
		/*$this->db->join('tbl_fee_heads b','b.fee_head_id=a.fee_head_id');
		$this->db->select('a.*,b.fee_head');
		$this->db->where('a.student_id',$student_id);
		$this->db->where('a.fee_from_year_id',$years['acdemic_year_id']);
		$this->db->where('a.fee_balance>',0);
		$op_bal		=	$this->db->get('tbl_opening_balance a')->result_array();*/
		?>
        <input type="hidden" name="op_bal_year[]" value="<?php echo $years['acdemic_year_id']; ?>"  />
		<tr>
			<th style="text-align: center;background-color:#FF7875;color:#FFFFFF" colspan="8">
				<b>OPENING BALANCE - <?php echo $years['academic_year']; ?></b>
			</th>
		</tr>
        <tr>
            <th style="text-align: center;" class="table-header" colspan="2">Fee Head</th>
            <th style="text-align: right;" class="table-header">Amount to Pay</th>
            <th style="text-align: right;" class="table-header">Paid Amount</th>
            <th style="text-align: right;" class="table-header" colspan="2">Balance</th>
            <th style="text-align: center;" class="table-header" colspan="2">
            	<input type="checkbox" id="op_bal_select_all_<?php echo $years['acdemic_year_id']; ?>" onclick="op_bal_select_all_data(this,<?php echo $years['acdemic_year_id']; ?>);op_bal_total(this,<?php echo $years['acdemic_year_id']; ?>);" /> Status
            </th>
        </tr>
        <?php
		$op_bal_tot		=	0;
		$op_bal_paid	=	0;
		$op_bal_balance	=	0;
		foreach($op_bal as $bal):
			?>
            <input type="hidden" name="op_bal_fee_head_<?php echo $years['acdemic_year_id']; ?>[]" value="<?php echo $bal['fee_head_id']; ?>"  />
            <input type="hidden" name="op_bal_id_<?php echo $years['acdemic_year_id']; ?>[]" value="<?php echo $bal['id']; ?>"  />
            <tr>
            	<th style="text-align: left;" colspan="2"><?php echo $bal['fee_head']; ?></th>
                <th style="text-align: right;"><?php echo number_format($bal['fee_amount'],2) ; ?></th>
                <th style="text-align: right;"><?php echo number_format(($bal['fee_amount']-$bal['fee_balance']),2) ; ?></th>
                <th style="text-align: right;" colspan="2"><?php echo number_format($bal['fee_balance'],2) ; ?></th>
                <th style="text-align: center;" colspan="2">
                    <input type="checkbox" name="op_bal_balance_check_<?php echo $years['acdemic_year_id']; ?>_<?php echo $bal['fee_head_id']; ?>" id="op_bal_balance_check_<?php echo $years['acdemic_year_id']; ?>_<?php echo $bal['fee_head_id']; ?>" onclick="op_bal_total1(this,<?php echo $years['acdemic_year_id']; ?>,<?php echo $bal['fee_head_id']; ?>)" value="<?php echo $bal['fee_balance']; ?>" <?php if($bal['fee_balance']==0){ echo "disabled"; } ?> /><?php if($bal['fee_balance']==0){ echo " Paid"; } ?>
                </th>
            </tr>
            <?php
			$op_bal_tot		+=	$bal['fee_amount'];
			$op_bal_paid	+=	($bal['fee_amount']-$bal['fee_balance']);
			$op_bal_balance	+=	$bal['fee_balance'];
		endforeach;
		?>
        <tr>
        	<th style="text-align: center;" colspan="2">Total</th>
            <th style="text-align: right;"><?php echo number_format($op_bal_tot,2) ; ?></th>
            <th style="text-align: right;"><?php echo number_format($op_bal_paid,2) ; ?></th>
            <th style="text-align: right;" colspan="2"><?php echo number_format($op_bal_balance,2) ; ?></th>
        </tr>
		<?php
	}
endforeach;

/************ Opening Balance End ***************/
?>




  

    <tr>
        <th style="text-align: center;background-color:#FF7875;color:#FFFFFF" colspan="8">
            <b>REGULAR FEE - <?php echo $run_year_name; ?></b>
        </th>
    </tr>  
<tr>
  <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
  <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
  <th style="text-align: right;" class="table-header"><b>Amount to Pay</b></th>
  <th style="text-align: right;" class="table-header"><b>Paid Amount</b></th>
  <th style="text-align: right;" class="table-header"><b>Concession</b></th>
  <th style="text-align: right;" class="table-header"><b>Balance</b></th>
  <th style="text-align: center;" class="table-header"><input type="checkbox" name="select_all" id="select_all" onclick="select_all_data(); Total();" /> <b>Status</b></th>
  <th style="text-align: center;" class="table-header"><b></b></th>
</tr>

<tbody>
<?php
$this->db->select('a.students_fee_master_id,a.due_date,a.fee_amount,a.fee_balance,a.fee_concession,a.opening_balance_reference_id,c.fee_payment_options_details');
$this->db->from('tbl_students_fee_master a');
$this->db->join('tbl_fee_installment_master b','b.fee_installment_master_id=a.fee_installment_master_id');
$this->db->join('tbl_fee_payment_options_details c','c.fee_payment_options_details_id=b.fee_payment_options_details_id');
$this->db->where('a.class_id',$class_id);
$this->db->where('a.admission_number',$student_id);
$this->db->where('a.fee_amount>0');
$this->db->where('a.is_deleted','N');
$this->db->order_by("a.due_date","asc");

$result=$this->db->get()->result_array();
$no=1;

$total_amount_to_pay = 0;
$total_amount_paid = 0;
$total_amount_balance = 0;
$total_amount_concession = 0;


if (count($result)==0)
{
echo "<tr><th colspan='8'  style='text-align: center;'><font color='red'><b>No Fee Schedule Found</b></font> </th>";

}

foreach($result as $data){
    $is_fee_migrated    =   $this->Fee_management_model->check_fee_migrated($data['opening_balance_reference_id'],"tbl_opening_balance");//echo $is_fee_migrated;die;
?>
<tr>
<input type="hidden" name="students_fee_master_id[]" id="students_fee_master_id[]" value="<?php echo $data['students_fee_master_id'];?>">
 <th style="text-align: center;"  onClick="ShowHide('<?php echo $no;?>')"> <?php echo $data['fee_payment_options_details'];?> &nbsp;&nbsp;<i class="fa fa-expand" aria-hidden="true"></i></th>
 <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
 <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo number_format($paid,2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
<th style="text-align: left; padding-left:50px;" <?php if($is_fee_migrated==1){ echo "title='Fee transferred to next year. So can not pay from here.'";  } ?> >
<input type="checkbox" name="balance_check[]" id="balance_check[]" onClick="Total()" <?php if($data['fee_balance']==0){ echo "disabled"; } if($is_fee_migrated==1){ echo "disabled";  } ?>>
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
$url = "index.php/modal/popup/view_payment_details/" .  $data['students_fee_master_id']."/".$class_id  ."/". $section ."/". $student_id;
else
$url= "index.php/modal/popup/edit_payment_details/" .  $data['students_fee_master_id']."/".$class_id  ."/". $section ."/". $student_id;
?>
 <th style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url() . 'index.php/FeeManagement/modify_fees/'.$data['students_fee_master_id']; ?>" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-edit text-info"></i>Modify </a>
<input type="hidden" id="check_balance[]" name="check_balance[]" value="<?php echo  $data['fee_balance'] ;?>" onChange="Total()">
<input type="hidden" name="check_uncheck[]" id="check_uncheck[]" onChange="Total()">
</th></tr>
<tr>
<td colspan="8" align="right">
            <table border="1"  id = "<?php echo $no;?>"  style="display:none;border-spacing:10px;width:80%" >
            <tr>
                <td class="table-header" >SNo.</td>
                <td class="table-header" >Fee Head</td>
                <td class="table-header" >Total</td>
                <td class="table-header" >Paid</td>
                <td class="table-header" >Concession</td>
                <td class="table-header" >Balance</td>
                <td class="table-header" ></td>    
            </tr>
            
            
<?php
$this->db->select('students_fee_master_id,students_fee_details_id,fee_head_id,fee_amount,fee_balance,fee_concession');
$this->db->from('tbl_students_fee_details');
$this->db->where('students_fee_master_id',$data['students_fee_master_id']);
$this->db->where('fee_amount>0');
$this->db->order_by("fee_head_id","asc");

$result=$this->db->get()->result_array();
$i=1;

foreach( $result as $row)
{

$fee_head = get_fee_head_name($row['fee_head_id']);
$fee_total =number_format($row['fee_amount'],2);
$fee_concession = number_format($row['fee_concession'],2);
$fee_balance = number_format($row['fee_balance'],2);
$fee_paid= number_format($row['fee_amount']-$row['fee_balance']-$row['fee_concession'],2);
			?>
            
     <TR>
    <td style="padding-left:20px;padding-right:20px;"><?php echo $i;?></td> 
    <td style="padding-left:20px;padding-right:20px;"><?php echo $fee_head;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_total;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_paid;?></td>
    <td  align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_concession;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_balance ;?></td>
    <td align="right" style="padding-left:20px;padding-right:20px;">
	<input type="checkbox" name="fee_head_balance_check[]" id="fee_head_balance_check[]" onChange="SubTotal();" <?php if($is_fee_migrated==1){ echo "disabled";  } ?> >
    <input type="hidden" id="item_balance[]" name="item_balance[]" value="<?php echo  $row['fee_balance'] ;?>">
    <input type="hidden" id="student_fee_master_id[]" name="student_fee_master_id[]" value="<?php echo  $data['students_fee_master_id'] ;?>">
    <input type="hidden" id="student_fee_details_id[]" name="student_fee_details_id[]" value="<?php echo  $row['students_fee_details_id'] ;?>">
    <input type="hidden" id="head_id[]" name="head_id[]" value="<?php echo  $row['fee_head_id'] ;?>">
   <input type="hidden" id="item_check[]" name="item_check[]" value="0">

    </td>

        
            </TR>
<?php $i=$i+1; } ?>
           
            </table>
</td>
</tr>
<?php $no++;} 
if (count($result)>0)
{
?>

<tr>
 <td style="text-align: center;" colspan="2"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
 <td style="text-align: right;" colspan="2"></td>
</tr>
<?php
}
?>




<?php
	if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
	{
	/******* Transportaion Fee Start************/
	?>
	<tr>
    	<th style="text-align: center;background-color:#FF7875;color:#FFFFFF" colspan="8">
        	<b>TRANSPORTATION FEE - <?php echo $run_year_name; ?></b>
        </th>
    </tr>
    <tr>
    	<td colspan="8" style="background-color:#CCCCCC">
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                <thead>
                    <tr>
                        <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
                        <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
                        <th style="text-align: right;" class="table-header"><b>Amount to Pay</b></th>
                        <th style="text-align: right;" class="table-header"><b>Paid Amount</b></th>
                        <th style="text-align: right;" class="table-header"><b>Concession</b></th>
                        <th style="text-align: right;" class="table-header"><b>Balance</b></th>
                        <th style="text-align: center;" class="table-header"><input type="checkbox" name="select_all_fee" id="select_all_fee" onclick="select_all_transp_fee(); total1();" /> <b>Status</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php
					$year = get_running_year();
					$this->db->select('students_bus_fee_master_id,due_date,fee_amount,fee_balance,fee_concession,opening_balance_reference_id');
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
					echo "<tr><th colspan='7'  style='text-align: center;'><font color='red'><b>No Fee Schedule Found</b></font> </th></tr>";
					
					}
					$i=0;
					foreach($result as $data){
                                            $is_fee_migrated    =   $this->Fee_management_model->check_fee_migrated($data['opening_balance_reference_id'],"tbl_opening_balance_transport");
                ?>
                <tr>
                	<input type="hidden" name="students_bus_fee_master_id[]" id="students_bus_fee_master_id[]" value="<?php echo $data['students_bus_fee_master_id'];?>">
                    <th style="text-align: center;" > <?php echo $no;?> &nbsp;&nbsp;</th>
                    <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");?></th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
                    <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
                    <th style="text-align: left; padding-left:50px;" <?php if($is_fee_migrated==1){ echo "title='Fee transferred to next year. So can not pay from here.'";  } ?> >
                        <input type="checkbox" name="balance_check1[]" id="balance_check1[]" onClick="total1();" <?php if( $data['fee_balance'] == 0) { echo "disabled"; }if($is_fee_migrated==1){ echo "disabled";  } ?> >
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
                    <input type="hidden" id="check_balance1[]" name="check_balance1[]" value="<?php echo  $data['fee_balance'] ;?>" onChange="total1()">
                    <input type="hidden" name="check_uncheck1[]" id="check_uncheck1[]" onChange="total1()">
                </tr>
                    
                    <?php $no++;$i++;} ?>
                <?php
					if (count($result)>0)
					{
					?>    
                <tr>
                    <td style="text-align: center;" colspan="2"><b>Total</b></td>
                    <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
                    <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
                    <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
                    <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
                    <td style="text-align: right;" colspan="2"></td>
                </tr>
                <?php
					}
				?>
           	</tbody>
      	</table>
  	</td>     
                <?php		
	/******* Transportaion Fee End**************/
	}
	?>
                
                <tr>
                <td colspan="6" align="center"><b>Late Fee</b></td>
                <td colspan="2"><b><input type="text" name="late_fee" id="late_fee" value="0" onchange="Total()"></b>
                </td>
                </tr>
                <tr><td colspan="6" align="center"><b>Total</b></td>
                <td colspan="2"><b><input type="text" name="amount" id="amount" value="0"><input type="hidden" name="op_bal_amount" id="op_bal_amount" value="0"></b>
                </td>
                </tr>
                <tr><td colspan="8">
                <div class="form-group">
                <?php
                if($this->db->get_where('settings', array('type' => 'show_receipt_number_in_textbox'))->row()->description!='yes')
                {
                ?>
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
                <div class="col-sm-9">
                Next Receipt No. Suggestion: <?php echo get_receipt_number("Receipt",$branch_id)+1; ?>
                </div> 
                <?php
                }
                ?>
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Receipt Number  <font color="#FF0000">* </font></label>
                <div class="col-sm-9">
                <input type="text" class="col-xs-10 col-sm-5" name="txtreceipt_number" id="txtreceipt_number" onkeyup="check_receipt_exist();" value="<?php if($this->db->get_where('settings', array('type' => 'show_receipt_number_in_textbox'))->row()->description=='yes'){ echo get_receipt_number("Receipt",$branch_id)+1; } ?>" required>
				
				
				<?php
				if($this->db->get_where('settings', array('type' => 'auto_gen_receipt'))->row()->description=='yes')
				{
				?>
				&nbsp;<input type="checkbox" name="auto_gen_receipt" checked="checked" value="1"/> Auto Generate Receipt Number
				<?php
				}
				?>
				
				
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
                <button type="submit" class="btn btn-success" name="btn_pay_now" id="btn_pay_now" value="btn_pay_now" onclick="return confirm('Are you sure?');this.disabled=true;this.form.submit();">      <b>  Pay Now </b>   </button>
                </td>
                </tr>
                </tbody>
            </table>
</td></tr></table>

</div>


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

var fee_item_balance = document.getElementsByName('fee_head_balance_check[]');
var count_item = fee_item_balance.length;

	var balance 		=  	document.getElementsByName('check_balance[]');
	var chkbalance 		=	document.getElementsByName('balance_check[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck[]');	
	var total=Number(late_fee.value);
 
  for (var i = 0;  i < balance.length; i++)
   {
   if(chkbalance[i].checked)
	{
 	   total = total+Number(balance[i].value);
	   check_uncheck[i].value=1;
	   for(j=0;j<count_item;j++) fee_item_balance[j].checked=false;
	}
	else
	    check_uncheck[i].value=0;
 }   
	document.getElementById('amount').value=total;
	
	var balance 		=  	document.getElementsByName('check_balance1[]');
	var chkbalance 		=	document.getElementsByName('balance_check1[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck1[]');	
	var total			=	0;
	if(balance.length>0)
	{
		for (var i = 0;  i < balance.length; i++)
		{
			if(chkbalance[i].checked)
			{
				total 	= 	total+Number(balance[i].value);
				check_uncheck[i].value=1;
			}
			else
				check_uncheck[i].value=0;
		}  
	document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+total;	 
	} 	
	document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+Number(document.getElementById('op_bal_amount').value);
}


//////////////////


function SubTotal()
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
  	
	var balance 		=  	document.getElementsByName('check_balance1[]');
	var chkbalance 		=	document.getElementsByName('balance_check1[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck1[]');	
	var total			=	0;
	if(balance.length>0)
	{
		for (var i = 0;  i < balance.length; i++)
		{
			if(chkbalance[i].checked)
			{
				total 	= 	total+Number(balance[i].value);
				check_uncheck[i].value=1;
			}
			else
				check_uncheck[i].value=0;
		} 
		 
	document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+total;	 
	} 	
        document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+Number(document.getElementById('op_bal_amount').value);
  
}

function total1()
{
	var fee_item_balance= 	document.getElementsByName('fee_head_balance_check[]');
	var count_item 		= 	fee_item_balance.length;
	
	var balance 		=  	document.getElementsByName('check_balance[]');
	var chkbalance 		=	document.getElementsByName('balance_check[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck[]');	
	
	var balance1 		= 	document.getElementsByName('item_balance[]');
	var check1 			=  	document.getElementsByName('item_check[]');
	
	var total			=	Number(late_fee.value);
	
	for (var i = 0;  i < balance.length; i++)
	{
		if(chkbalance[i].checked)
		{
			total 		= 	total+Number(balance[i].value);
			
		}
/*		else
		{
			//alert(total);
			for(j=0;j<count_item;j++) 
			{
				if(fee_item_balance[j].checked)
				{
					total 		= 	total+Number(balance1[j].value);alert(i);
				}
			}
		}
*/	
	}   
	document.getElementById('amount').value=total;
	
	
	var fee_item_balance 	= 	document.getElementsByName('fee_head_balance_check[]');
	var item_count 			= 	fee_item_balance.length;
	var chkbalance 			=	document.getElementsByName('fee_head_balance_check[]');	
	var balance 			= 	document.getElementsByName('item_balance[]');
	var check 				=  	document.getElementsByName('item_check[]');
	
	var installments 		= 	document.getElementsByName('balance_check[]');
	var installments_count 	= 	installments.length;
	var total				=	Number(document.getElementById('amount').value);
	
	for (var i = 0;  i < item_count; i++)
	{
		if(fee_item_balance[i].checked)
		{
			total = total+Number(balance[i].value);
		}
	}   
	
	document.getElementById('amount').value=total;
	
	
	
	//alert(document.getElementById('amount').value);
	var balance 		=  	document.getElementsByName('check_balance1[]');
	var chkbalance 		=	document.getElementsByName('balance_check1[]');	
	var check_uncheck	=	document.getElementsByName('check_uncheck1[]');	
	var total			=	0;
	if(balance.length>0)
	{
		for (var i = 0;  i < balance.length; i++)
		{
			if(chkbalance[i].checked)
			{
				total 	= 	total+Number(balance[i].value);
				check_uncheck[i].value=1;
			}
			else
				check_uncheck[i].value=0;
		} 
		 
	document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+total;	 
	} 
	document.getElementById('amount').value	=	Number(document.getElementById('amount').value)+Number(document.getElementById('op_bal_amount').value);
}		
		
function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
}

function select_all_data()
{
	var select_all	=	document.getElementById("select_all");
	var check_box 	= 	document.getElementsByName('balance_check[]');
	var balance 		=  	document.getElementsByName('check_balance[]');
	var fee_item_balance = document.getElementsByName('fee_head_balance_check[]');
	var total=Number(late_fee.value);

	for (var i=0;i<check_box.length;i++)
	{
		if(check_box[i].disabled==false)
		{
			if(select_all.checked==true)
			{
				
			   check_box[i].checked	=	true;
//			   total = total+Number(balance[i].value);
			}
			else
			{
				check_box[i].checked	=	false;
			}
				document.getElementById('amount').value=total;

		}
	}
}


function select_all_transp_fee()
{
	var select_all	=	document.getElementById("select_all_fee");
	var check_box 	= 	document.getElementsByName('balance_check1[]');
	var balance 		=  	document.getElementsByName('check_balance1[]');
	var total			=	Number(document.getElementById('amount').value);

	for (var i=0;i<check_box.length;i++)
	{
		if(check_box[i].disabled==false)
		{
			if(select_all.checked==true)
			{
				
			   check_box[i].checked	=	true;
//			   total = total+Number(balance[i].value);
			}
			else
			{
				check_box[i].checked	=	false;
			}
				document.getElementById('amount').value=total;

		}
	}
}
function op_bal_select_all_data(e,year_id)
{
    var total				=	parseFloat($("#amount").val());        
//    var op_total			=	parseFloat(0);
    var op_total			=	parseFloat($("#op_bal_amount").val());  
//    alert(total)
    $(":input[name='op_bal_fee_head_"+year_id+"[]']").map(function(){ 
        if($('#op_bal_select_all_'+year_id).prop("checked") === true)
        {
            if($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).prop("checked") === false)
            {
//                op_total		=	op_total+parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                total		=	total+parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                op_total		=	op_total+parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                $('#op_bal_balance_check_'+year_id+'_'+$(this).val()).prop("checked",true);
            }
        }
          
        if($('#op_bal_select_all_'+year_id).prop("checked") === false)
        {
            if($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).prop("checked") === true)
            {
//                op_total		=	op_total-parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                total		=	total-parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                op_total		=	op_total-parseFloat($('#op_bal_balance_check_'+year_id+'_'+$(this).val()).val());
                $('#op_bal_balance_check_'+year_id+'_'+$(this).val()).prop("checked",false);
            }
        }
          
            
    });
    
    if($(e).prop("checked") === true)
    {
//            tot_amount			=	total+op_total;	
            tot_amount			=	total;	
            
            $('#op_bal_amount').val(op_total);
            $('#amount').val(tot_amount);
    }
    else
    {
//            tot_amount			=	total-op_total;
            tot_amount			=	total;
//            $('#op_bal_amount').val(0);
            $('#op_bal_amount').val(op_total);
            $('#amount').val(tot_amount);
    }
}

//function op_bal_total(e,year)
//{
//	
//	//Total();
//	//SubTotal();
//	var total				=	parseFloat($("#amount").val());
//        
//	var op_total			=	parseFloat(0);
//	
//	//var op_bal_fee_heads	=	$(":input[name='op_bal_fee_head_"+year+"[]']").map(function(){return $(this).val();}).get();
//	$(":input[name='op_bal_fee_head_"+year+"[]']").map(function(){ 
//            //if($('#op_bal_balance_check_'+year+'_'+$(this).val()).prop("checked")==false)
//            //{
//		op_total			=	op_total+parseFloat($('#op_bal_balance_check_'+year+'_'+$(this).val()).val());
//            //}  
//            //alert(op_total)
//	});
//	
//	//alert(op_total);
//	if($(e).prop("checked")==true)
//	{
//		tot_amount			=	total+op_total;	
//		
//		$('#amount').val(tot_amount);
//		$('#op_bal_amount').val(op_total);
//	}
//	else
//	{
//		tot_amount			=	total-op_total;
//		$('#amount').val(tot_amount);
//		$('#op_bal_amount').val(0);
//	}
//}

function op_bal_total1(e,year,fee_head_id)
{
    var total				=	parseFloat($("#amount").val());
    var op_bal_total			=	parseFloat($("#op_bal_amount").val());
    var curr_amount                     =       parseFloat($(e).val());
    
    if($(e).prop("checked") === true)
    {   
        $('#op_bal_amount').val((op_bal_total+curr_amount));
        $('#amount').val((total+curr_amount));
    }
    else if($(e).prop("checked") === false)
    {
        $('#op_bal_amount').val((op_bal_total-curr_amount));
        $('#amount').val((total-curr_amount));        
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
    
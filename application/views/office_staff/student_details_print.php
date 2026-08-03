
<?php echo form_open(base_url() . 'index.php/FeeManagement/fees_assign/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="class" id="class" value="<?php echo $class_id;?>">
<input type="hidden" name="section" id="section" value="<?php echo $section;  ?>">
<input type="hidden" name="section" id="section" value="<?php echo $fee_plan;  ?>">

<br /><br />
<?php 
foreach($student as $data){?>

<div style="padding-left:50px; padding-right:50px;">
<div class="white-box">
<div class="table-responsive">
<table class="table">
<tr>
 <td style="text-align: center;">Name :<?php echo $data['name'];?></td>
 <td style="text-align: center;">Date Of Birth :<?php echo $data['birthday'];?></td> 
 <td style="text-align: center;">Gender :<?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: center;">Address :<?php echo $data['address'];?></td>
 <td style="text-align: center;">Phone Number :<?php echo $data['phone1'];?></td>
 <td style="text-align: center;">Email :<?php echo $data['email'];?></td>
 </tr>

<?php }?>
<tr><td colspan="3">
<div style="padding-left:50px; padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" border="0">
  <thead>
   <tr>
  <th style="text-align: center;">Payment Option</th>
  <th style="text-align: center;" colspan="2">Assign Fee</th>
</tr>
</thead>
<?php 


$sql = $this->db->query("SELECT class_id, admission_number FROM tbl_students_fee_master WHERE is_deleted='N' and admission_number =".$student_id );


if ( $sql->num_rows()>0)
{
	$assigned="yes";
	$url="index.php/FeeManagement/reassign_student_fees/";
	$text="View Details";
}
else
{
	$assigned="no";
	$url="index.php/FeeManagement/fees_assign/";
	$text="Assign";
}
$this->db->distinct('f.fee_payment_options_master_id');
$this->db->select('f.fee_payment_options_master_id,s.fee_payment_options_master');
$this->db->from('tbl_fee_installment_master f');
$this->db->join('tbl_fee_payment_options_master s','f.fee_payment_options_master_id=s.fee_payment_options_master_id','LEFT');
$this->db->where('f.fee_master_id',$fee_plan);
$query=$this->db->get()->result_array();


foreach($query as $details){
?>
<tr><td align="center"><?php echo $details['fee_payment_options_master']; ?> 

<input type="hidden" name="fee_payment_option_master_id" id="fee_payment_option_master_id" value="<?php echo $details['fee_payment_options_master_id']; ?>">
<input type="hidden" name="total_fee" id="total_fee" value="<?php // echo $details['fee_total']; ?>">
<input type="hidden" name="balance_fee" id="balance_fee" value="<?php //echo $details['fee_balance']; ?>">
<input type="hidden" name="due_date" id="due_date" value="<?php //echo $details['due_date']; ?>"></td>
  <td style="text-align: center;" class="text-nowrap"> 
  <?php
  if($assigned=="yes")
   echo  "<a href=". base_url(). $url . $class_id."/".$section."/".$student_id." <i>". $text ."</i> </a>";
    else
   echo "<a href=". base_url(). $url . $class_id."/".$section."/".$student_id."/".$details['fee_payment_options_master_id']."/". $fee_plan." <i>". $text ."</i> </a>";?></td>
   
   
   
<?php $this->session->flashdata('flashSuccess');?>
<?php }?></tr>
 </tbody>
</table>
 <tr><td colspan="3" align="right">   <div align="right"><a href="">Assign Another</a></div></td></tr>
</table>
</div>

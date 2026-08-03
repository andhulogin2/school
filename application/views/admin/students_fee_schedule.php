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
							<li class="active">Fee Schedule</li>
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
									Individual
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
<?php

$counter=$this->session->flashdata('counter');
if($counter==1)
{
	$this->session->set_flashdata('counter',$counter);
}

$role	=	$this->session->userdata('role');
if($role==1 || $role==2)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section_id .'/back/'.$department_id.'/'.$branch_id; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}
if($role==3)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section_id .'/back/'.$department_id; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}
if($role==4)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section_id .'/back'; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}

?>				 
<br/>
            
<div  style="padding-left:150px;padding-right:50px;">
<?php foreach($student as $data){?>

<table class="table  table-hover">
<tr>
 <td style="text-align: left;">Name :<?php echo $data['name'];?></td>
  <td style="text-align: left;">Admission No: <?php echo $data['admission_number']; ?></td>
 <td style="text-align: left;">Gender :<?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: left;">Class  :<?php echo get_class_name($class_id); ?></td>
 <td style="text-align: left;">Section  :<?php echo get_section_name($section); ?></td>
 <td style="text-align: left;">Date Of Birth :<?php echo $data['birthday'];?></td> 
 </tr>
<tr>
 <td style="text-align: left;">Address :<?php echo $data['address'];?></td>
 <td style="text-align: left;">Phone Number :<?php echo $data['phone1'];?></td>
 <td style="text-align: left;">Email :<?php echo $data['email'];?></td>
 </tr>
<?php }?>

<tr><td colspan="3">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="0">
  <thead>
  <tr>
  <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
  <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
  <th style="text-align: right;" class="table-header"><b>Amount to Pay</b></th>
  <th style="text-align: right;" class="table-header"><b>Paid Amount</b></th>
  <th style="text-align: right;" class="table-header"><b>Concession</b></th>
  <th style="text-align: right;" class="table-header"><b>Balance</b></th>
</tr>
</thead>
<tbody>
<?php
$this->db->select('students_fee_master_id,due_date,fee_amount,fee_balance,fee_concession');
$this->db->from('tbl_students_fee_master');
$this->db->where('class_id',$class_id);
$this->db->where('admission_number',$student_id);
$this->db->where('fee_amount>0');
$this->db->where('is_deleted','N');
$this->db->order_by("due_date","asc");

$result=$this->db->get()->result_array();	
$no=1;

$total_amount_to_pay = 0;
$total_amount_paid = 0;
$total_amount_balance = 0;
$total_amount_concession = 0;
$count=0;
foreach($result as $data)
{
$count=$count+1;
}
if($count==0)
{
echo "<tr><th style='text-align: center;' colspan='6'><font color='red'><b>Fee Structure Not Assigned</b></font></th></table>";
die();
}
foreach($result as $data){
?>
<tr>
 <th style="text-align: center;"  onClick="ShowHide('<?php echo $no;?>')"> <?php echo $no;?> &nbsp;&nbsp;<i class="fa fa-expand" aria-hidden="true"></i></th>
 <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
 <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
<?php
$total_amount_to_pay		 = $total_amount_to_pay+$data['fee_amount'];
$total_amount_paid 			 = $total_amount_paid+$paid;
$total_amount_balance		 = $total_amount_balance+$data['fee_balance'];
$total_amount_concession	 = $total_amount_concession+$data['fee_concession'];

?>
</th></tr>
<tr>
<td style="padding-left:100px;" colspan="8" align="right">
            <table width="100%" border="1"  id = "<?php echo $no;?>"  style="display:none;" >
            <TR>
            <td class="table-header">SNo.</td>            
            <td class="table-header">Fee Head</td>
            <td class="table-header">Total</td>
            <td class="table-header">Paid</td>
            <td class="table-header">Concession</td>
            <td class="table-header">Balance</td>
            </TR>
            
            
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
    <td align="center"><?php echo $i; $i=$i+1; ?></td>
    <td style="padding-left:20px;padding-right:20px;"><?php echo $fee_head;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_total;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_paid;?></td>
    <td  align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_concession;?></td> 
    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_balance ;?></td>
        
            </TR>
<?php } ?>
        
            </table>
</td>
</tr>
<?php $no++;} ?>
<tr>
 <td style="text-align: center;" colspan="2"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
</tr>
</tbody>
</table>
</td></tr>
<tr><td></td></tr>
</table>
                                    
</div>
												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	

//////////////////
		
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
</script>


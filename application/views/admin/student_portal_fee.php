<?php
$role = $this->session->userdata( 'role' );
include_once APPPATH . 'views/main_head.php';
?>
<?php $running_year = get_running_year();?>
<?php //include_once APPPATH . 'views/top_bar.php';?>
<div class="main-content">
<div class="main-content-inner">
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs"> 
  <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
  <ul class="breadcrumb">
    <li> <i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a> </li>
    <li class="active">Student Portal</li>
  </ul>
  <!-- /.breadcrumb --> 
  
  <!-- #section:basics/content.searchbox -->
  <div class="nav-search" id="nav-search">
    <form>
      <span class="input-icon"> </span>
    </form>
  </div>
  <!-- /.nav-search --> 
  
  <!-- /section:basics/content.searchbox --> 
</div>

<!-- /section:basics/content.breadcrumbs -->

<div class="page-header">
  <h1> Student Profile <i class="ace-icon fa fa-angle-double-right"></i>
    <?php
    $student_name = $this->db->get_where( 'student', array( 'student_id' => $student_id ) )->row()->name;
    echo $student_name;
    ?>
  </h1>
  <div class="col-md-offset-7">
    <div class="col-md-2"> </div>
    <div style="float:right;margin-right:30px;padding-top:30px">
      <?php $running_year = get_running_year(); ?>
      <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$running_year))->row()->class_id;?>
      <a href="<?php echo base_url();?>index.php/admin/students_area/<?php echo $cls;?>" data-dismiss="fileinput">
      <button class="btn-info">Back</button>
      </a>
      <?php if($this->db->get_where("settings",array('type'=>'tc'))->row()->description=="yes"){ ?>
      <a href="<?php echo base_url();?>index.php/admin/issue_tc/<?php echo $student_id; ?>/<?php echo $cls;?>">
      <button class="btn-info">ISSUE TC</button>
      </a>
      <?php } ?>
      <a href="<?php echo base_url();?>index.php/report/student_print_report/<?php echo $student_id;?>" data-dismiss="fileinput">
      <button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Download</button>
      </a>
      <input type="hidden" name="year" value="<?php echo $running_year; ?>">
    </div>
  </div>
</div>
<!-- /.page-header -->

<div class="row">
<div class="col-xs-12">
<?php


$student_id = $student_id;
$year = get_running_year();
$class_id = $this->db->get_where( 'enroll', array(
  'student_id' => $student_id, 'year' => $year ) )->row()->class_id;
// echo $class_id;
$monthly_attendance = $this->crud_model->get_attendance_monthly( $student_id );
$student_portal_model = $this->crud_model->student_portal_data( $student_id );
?>
<div class="col-sm-12 col-xs-12">
<!-- #section:elements.tab.option -->
<div class="tabbable">
<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
  <li > <a href="<?=base_url();?>index.php/Admin/student_portal/<?=$student_id?>/<?=$class_id?>#home4">PROFILE</a> </li>
  <li> <a data-toggle="tab" href="#dropdown14">MARK REPORT</a> </li>
  <?php
  if ( $this->db->get_where( 'settings', array( 'type' => 'attendance' ) )->row()->description == 'yes' ) {
    ?>
  <li> <a href="<?=base_url();?>index.php/Admin/student_portal/<?=$student_id?>/<?=$class_id?>#dropdown15">ATTENDANCE REPORT</a> </li>
  <?php } ?>
  <?php
  if ( $this->db->get_where( 'settings', array( 'type' => 'hourly_attendance' ) )->row()->description == 'yes' ) {
    ?>
  <li> <a href="<?=base_url();?>index.php/Admin/student_portal/<?=$student_id?>/<?=$class_id?>#dropdown16"> ATTENDANCE REPORT</a> </li>
  <?php } ?>
  <?php
  if ( $this->db->get_where( 'settings', array( 'type' => 'fee_details' ) )->row()->description == 'yes' ) {
    ?>
  <li class="active"> <a href="#">FEE DETAILS</a> </li>
  <?php }?>
  <?php
  if ( $this->db->get_where( 'settings', array( 'type' => 'special_fee' ) )->row()->description == 'yes' ) {
    ?>
  <li> <a href="<?=base_url();?>index.php/Admin/student_portal/<?=$student_id?>/<?=$class_id?>#profile5">SPECIAL FEE DETAILS</a> </li>
  <?php
  }
  ?>
</ul>
<div class="tab-content row col-md-12 col-xs-12" style="padding-top:0px;">
</div>
<div id="profile4" class="tab-pane">
<div style="padding-left:50px;padding-right:50px;">
<?php
if ( $this->db->get_where( 'settings', array( 'type' => 'fee_info_at_a_glance' ) )->row()->description == 'yes' ) {
  ?>
<div class="col-md-4" style="border:1px solid black;margin-top:5px;margin-bottom:5px;"> Paid this year: <span style="float:right;color:green;"><b><?php echo $total_paid_amount[0]['fee_amount']; ?></b></span> </div>
<div class="col-md-4" style="border:1px solid black;margin-top:5px;margin-bottom:5px;"> Pending till today: <span style="float:right;color:red;"><b><?php echo $pending_till_today; ?></b></span> </div>
<div class="col-md-4" style="border:1px solid black;margin-top:5px;margin-bottom:5px;"> Total balance: <span style="float:right;color:red;"><b><?php echo $total_pending; ?></b></span> </div>
<?php
}
$prev_years = $this->crud_model->get_op_bal_years( $student_id );
foreach ( $prev_years as $years ):
  if ( $years[ 'acdemic_year_id' ] < $running_year ) {
    $op_bal = $this->crud_model->get_op_bal_details( $student_id, $years[ 'acdemic_year_id' ] );
    ?>
<h5 style="margin-top:2px;margin-bottom:3px;">Opening Balance Fee Structure: <?php echo $years['academic_year']; ?></h5>
<table id="simple-table" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;"  cellpadding="0">
  <tr>
    <th style="text-align: center;" class="table-header"><b>Sl. No</b></th>
    <th style="text-align: center;" class="table-header"><b>Fee Head</b></th>
    <th style="text-align: right;" class="table-header"><b>Total </b></th>
    <th style="text-align: right;" class="table-header"><b>Paid </b></th>
    <th style="text-align: right;" class="table-header"><b>Balance</b></th>
  </tr>
  <?php
  $sl_no = 1;
  $op_total = 0;
  $op_paid = 0;
  $op_balance = 0;
  foreach ( $op_bal as $bal ):
    ?>
  <tr>
    <th style="text-align: center;" class=""><b><?php echo $sl_no++; ?></b></th>
    <th style="text-align: center;" class=""><b><?php echo $bal['fee_head']; ?></b></th>
    <th style="text-align: right;" class=""><b><?php echo number_format($bal['fee_amount'],2); ?></b></th>
    <th style="text-align: right;" class=""><b><?php echo number_format($bal['fee_amount']-$bal['fee_balance'],2); ?> </b></th>
    <th style="text-align: right;" class=""><b><?php echo number_format($bal['fee_balance'],2); ?></b></th>
  </tr>
  <?php
  $op_total += $bal[ 'fee_amount' ];
  $op_paid += $bal[ 'fee_amount' ] - $bal[ 'fee_balance' ];
  $op_balance += $bal[ 'fee_balance' ];
  endforeach;
  ?>
  <tr>
    <th colspan="2" style="text-align: center;">Total</th>
    <th style="text-align: right;" class=""><b><?php echo number_format($op_total,2); ?></b></th>
    <th style="text-align: right;" class=""><b><?php echo number_format($op_paid,2); ?> </b></th>
    <th style="text-align: right;" class=""><b><?php echo number_format($op_balance,2); ?></b></th>
  </tr>
</table>
<?php
}
endforeach;
?>
<h5 style="margin-top:2px;margin-bottom:3px;">Fee Structure</h5>
<table id="simple-table" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;" cellpadding="0">
  <tr>
    <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
    <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
    <th style="text-align: right;" class="table-header"><b>Total </b></th>
    <th style="text-align: right;" class="table-header"><b>Paid </b></th>
    <th style="text-align: right;" class="table-header"><b>Concession</b></th>
    <th style="text-align: right;" class="table-header"><b>Balance</b></th>
    <?php if($this->session->userdata('role')<=4) { ?>
    <th style="text-align: right;" class="table-header"><b></b></th>
    <?php } ?>
  </tr>
  <?php
  $this->db->select( 'students_fee_master_id,due_date,fee_amount,fee_balance,fee_concession,is_idle,opening_balance_reference_id' );
  $this->db->from( 'tbl_students_fee_master' );
  $this->db->where( 'class_id', $class_id );
  $this->db->where( 'admission_number', $student_id );
  $this->db->where( 'fee_amount>0' );
  $this->db->where( 'is_deleted', 'N' );
  $this->db->order_by( "due_date", "asc" );

  $result = $this->db->get()->result_array();
  $no = 1;

  $total_amount_to_pay = 0;
  $total_amount_paid = 0;
  $total_amount_balance = 0;
  $total_amount_concession = 0;
  $count = 0;

  foreach ( $result as $data ) {
    $count = $count + 1;
  }
  if ( $count == 0 ) {
    echo "<tr><th style='text-align: center;' colspan='7'><font color='red'><b>Fee Structure Not Assigned</b></font></th>";
    //die();
  } else {

    foreach ( $result as $data ) {
      $is_fee_migrated = $this->Fee_management_model->check_fee_migrated( $data[ 'opening_balance_reference_id' ], "tbl_opening_balance" );
      ?>
  <tr>
    <th style="text-align: center;"  onClick="ShowHide('<?php echo $no;?>')"> <?php echo $no;?> &nbsp;&nbsp;<i class="fa fa-expand" aria-hidden="true"></i></th>
    <th style="text-align: center;"><?php echo  date_format ( date_create( $data[ 'due_date' ] ), "d-m-Y" );
    if ( $this->db->get_where( 'settings', array( 'type' => 'reset_due_idle' ) )->row()->description == 'yes' && $data[ 'is_idle' ] == 'Y' ) {
      echo "<b style='color:red'>(Idle)</b>";
    }
    ?></th>
    <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
    <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
    <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
    <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
    <?php if($this->session->userdata('role')<=4) { ?>
    <th style="text-align: right;" <?php if($is_fee_migrated == 1){ echo "title='Fee tranferred to next year. So can not delete.'"; } ?> ><?php if($paid != '0' || $is_fee_migrated == 1) { ?>
      <a href="#" data-toggle="tooltip" title="Delete" style="pointer-events: none;cursor:default;" ><i class="fa fa-trash" style="font-size:18px;color:#CCCCCC" ></i></a>
      <?php } else { ?>
      <a href="<?php echo  base_url();?>index.php/FeeManagement/delete_installments/<?php echo $data['students_fee_master_id']."/".$class_id."/".$student_id;?>" onClick="return confirm('Are you sure to delete this entry?');" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash" style="font-size:18px;color:red" ></i></a>
      <?php } ?>
    </th>
    <?php } ?>
  </tr>
  <?php
  $total_amount_to_pay = $total_amount_to_pay + $data[ 'fee_amount' ];
  $total_amount_paid = $total_amount_paid + $paid;
  $total_amount_balance = $total_amount_balance + $data[ 'fee_balance' ];
  $total_amount_concession = $total_amount_concession + $data[ 'fee_concession' ];

  ?>
  <tr>
    <td style="padding-left:100px;" colspan="8" align="right"><table width="100%" border="1"  id = "<?php echo $no;?>"  style="display:none;" >
        <TR>
          <td class="table-header">SNo.</td>
          <td class="table-header">Fee Head</td>
          <td class="table-header">Total</td>
          <td class="table-header">Paid</td>
          <td class="table-header">Concession</td>
          <td class="table-header">Balance</td>
        </TR>
        <?php
        $this->db->select( 'students_fee_master_id,students_fee_details_id,fee_head_id,fee_amount,fee_balance,fee_concession,remarks' );
        $this->db->from( 'tbl_students_fee_details a' );
        $this->db->where( 'students_fee_master_id', $data[ 'students_fee_master_id' ] );
        $this->db->where( 'fee_amount>0' );
        $this->db->order_by( "fee_head_id", "asc" );

        $result1 = $this->db->get()->result_array();

        $i = 1;
        foreach ( $result1 as $row ) {

          $fee_head = get_fee_head_name( $row[ 'fee_head_id' ] );
          $fee_total = number_format( $row[ 'fee_amount' ], 2 );
          $fee_concession = number_format( $row[ 'fee_concession' ], 2 );
          $fee_balance = number_format( $row[ 'fee_balance' ], 2 );
          $fee_paid = number_format( $row[ 'fee_amount' ] - $row[ 'fee_balance' ] - $row[ 'fee_concession' ], 2 );
          ?>
        <TR>
          <td align="center"><?php echo $i; $i=$i+1; ?></td>
          <td style="padding-left:20px;padding-right:20px;"><?php echo $fee_head;?></td>
          <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_total;?></td>
          <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_paid;?></td>
          <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_concession;if($row['remarks']!=NULL){ echo "({$row['remarks']})"; }?></td>
          <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_balance ;?></td>
        </TR>
        <?php } ?>
      </table></td>
  </tr>
  <?php $no++;} ?>
  <tr>
    <td style="text-align: center;" colspan="2"><b>Total</b></td>
    <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
    <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
    <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
    <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
    <?php if($this->session->userdata('role')<=4) { ?>
    <td></td>
    <?php } ?>
  </tr>
  <?php }?>
  </tbody>
  
</table>

<!----- Transportation fee Payment Details-->
<?php
if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
?>
<h5 style="margin-top:2px;margin-bottom:3px;">Transportation Fee Structure</h5>

<table id="simple-table" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;" cellpadding="2"> 
                <thead>
                    <tr>
                        <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
                        <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
                        <th style="text-align: right;" class="table-header"><b>Total</b></th>
                        <th style="text-align: right;" class="table-header"><b>Paid</b></th>
                        <th style="text-align: right;" class="table-header"><b>Concession</b></th>
                        <th style="text-align: right;" class="table-header"><b>Balance</b></th>
						 <?php if($this->session->userdata('role')<=4) { ?>
                        <th style="text-align: right;" class="table-header"><b></b></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php
					$this->db->select('students_bus_fee_master_id,due_date,fee_amount,fee_balance,fee_concession,is_idle,opening_balance_reference_id');
					$this->db->from('tbl_transport_students_bus_fee_master');
					$this->db->where('academic_year',$running_year);
					$this->db->where('student_id',$student_id);
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
                    <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");
						if($this->db->get_where('settings' , array('type' =>'reset_due_idle'))->row()->description == 'yes' && $data['is_idle']=='Y'){ echo "<b style='color:red'>(Idle)</b>"; }?>
                    </th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
                    <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
                    <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
					 <?php if($this->session->userdata('role')<=4) { ?>
                    <th style="text-align: right;" <?php if($is_fee_migrated == 1){ echo "title='Fee tranferred to next year. So can not delete.'"; } ?> ><?php if($paid != '0' || $is_fee_migrated == 1) { ?><a href="#" data-toggle="tooltip" title="Delete" style="pointer-events: none;cursor:default;" ><i class="fa fa-trash" style="font-size:18px;color:#CCCCCC" ></i></a><?php } else { ?> <a href="<?php echo  base_url();?>index.php/FeeManagement/delete_bus_fee_installments/<?php echo $data['students_bus_fee_master_id']."/".$student_id;?>" onClick="return confirm('Are you sure to delete this entry?');" data-toggle="tooltip" title="Delete" ><i class="fa fa-trash" style="font-size:18px;color:red" ></i></a> <?php } ?> </th>
                    <?php } ?>
                    
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
					 <?php if($this->session->userdata('role')<=4) { ?>
                    <td></td>
        			<?php } ?>
                </tr>
                <?php
					}
				?>
           	</tbody>
      	</table>

<?php
}
?>
<!----- Fee Payment Details-->
<h5 style="margin-top:2px;margin-bottom:3px;"> Fee Payment Details</h5>
<?php
		/*$this->db->where('admission_number', $student_id);
		$this->db->where('class_id', $class_id);
		$this->db->where('batch_id', $section_id);
		$this->db->select('admission_number,date_paid,receipt_number,fee_head,fee_amount');
		//$this->db->group_by('receipt_number','asc');
		$this->db->order_by('receipt_number','asc');
		$this->db->from('view_fee_collection_details');
		$fee_details		=	$this->db->get()->result_array();*/ 
                $fee_details		=	$this->Fee_management_model->progress_report_fee_data($student_id,$class_id,$section_id,$special_fee="no"); 
                //print_r($fee_details);
		$bus_fee_details	=	array();
		/*if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
			$this->db->where('student_id', $student_id);
			$this->db->where('class_id', $class_id);
			$this->db->where('section_id', $section_id);
			//$this->db->group_by('student_id'); 
			$this->db->select('date_paid,receipt_number,amount_paid ');
			$this->db->from('view_transport_students_bus_fee_collection_details');
			$bus_fee_details		=	$this->db->get()->result_array();
		}
		$this->db->select('student_id,date_paid,receipt_number,fee_head,amount_paid,fee_from_year');
		$this->db->where('student_id', $student_id);
		$this->db->where('paid_year_id', $running_year);
		$this->db->where('is_deleted', 'N');
                $op_balance_fee_details =   $this->db->get('view_opening_balance_collection')->result_array();*/
?>
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" width="60%">
              <thead>
              <tr>
              <th style="text-align: center;" class="table-header"><b>SlNo</b></th>
              <th style="text-align: center;" class="table-header"><div align="center"><b>Date Paid</b></div></th>
              <th style="text-align: right;" class="table-header"><div align="center"><b>Receipt No.</b></div></th>
             <th style="text-align: right;" class="table-header"><div align="center"><b> Fee Head</b></div></th>
              <th style="text-align: right;" class="table-header"><b> Amount</b></th>
            </tr>
            </thead>
            <tbody>
<?php
$total_amount_paid = 0;

//if(count($fee_details)==0 && count($bus_fee_details)==0 && count($op_balance_fee_details)==0)
if(count($fee_details)==0)
{
echo "<tr><th style='text-align: center;' colspan='5'><font color='red'><b>No Fee Payment Details Found</b></font></th></table>";
}
else
{
$sno=1;

/*foreach($op_balance_fee_details as $data):
    ?>
    <tr>
        <th style="text-align: right;"><?php echo  $sno ;?></th>
        <th style="text-align: right;"><div align="center"><?php echo date('d-m-Y',strtotime($data['date_paid']));?></div></th>
        <th style="text-align: right;"><div align="center"><?php echo $data['receipt_number'] ;?></div></th>
        <th style="text-align: right;"><div align="center"><?php echo $data['fee_head'].'(Due-'.$data['fee_from_year'].')' ;?></div></th>
        <th style="text-align: right;"><?php echo  number_format($data['amount_paid'],2) ;?></th>
    </tr>

    <?php   
    $total_amount_paid		 = $total_amount_paid+$data['amount_paid'];
    $sno=$sno+1;
endforeach;*/

foreach($fee_details as $data)
{
    $fee_due_year   =   '';
    if($data['fee_due_year']!=='0')
    {
        $fee_due_year=  '(Due:'.$data['fee_due_year'].')';
    }
?>
<tr>
 <th style="text-align: right;"><?php echo  $sno ;?></th>
 <th style="text-align: right;"><div align="center"><?php echo date('d-m-Y',strtotime($data['date_paid']));?></div></th>
 <th style="text-align: right;"><div align="center"><?php echo $data['receipt_number'] ;?></div></th>
 <th style="text-align: right;"><div align="center"><?php echo $data['fee_head'].$fee_due_year;?></div></th>

 <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
</tr>
<?php
$total_amount_paid		 = $total_amount_paid+$data['fee_amount'];
$sno=$sno+1;
}
/*if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
	$this->db->where('student_id', $student_id);
	$this->db->where('class_id', $class_id);
	$this->db->where('section_id', $section_id);
	//$this->db->group_by('student_id'); 
	$this->db->select('date_paid,receipt_number,amount_paid ');
	$this->db->from('view_transport_students_bus_fee_collection_details');
	$bus_fee_details		=	$this->db->get()->result_array();
	
foreach($bus_fee_details as $data1)
{ ?>
<tr>
 <th style="text-align: right;"><?php echo  $sno ;?></th>
 <th style="text-align: right;"><div align="center"><?php echo date('d-m-Y',strtotime($data1['date_paid']));?></div></th>
 <th style="text-align: right;"><div align="center"><?php echo $data1['receipt_number'] ;?></div></th>
 <th style="text-align: right;"><div align="center">Bus Fee</div></th>
 <th style="text-align: right;"><?php echo  number_format($data1['amount_paid'],2) ;?></th>
</tr>
<?php
$total_amount_paid		 = $total_amount_paid+$data1['amount_paid'];
$sno=$sno+1;
}
}	*/
?>
<tr>
 <td style="text-align: center;" colspan="4"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
</tr>
</tbody>
</table>
<?php
}
?>

</div>
</div>


<!--  Profile5 Start-------->
<!--  Profile5 end-------->

                                                

													

</div></div></div></div></div></div></div></div></div></div></div></div></div>
  

  
  <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($this->session->flashdata('action')=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if ($this->session->flashdata('action')=="failed")
{
echo "<script>toastr.error('". "Updation Failed...', 'Something went wrong', {timeOut: 5000})</script>";
}

?>
 <script src="<?php echo base_url(); ?>assets/js/select2.js"></script> 
        <script type="text/javascript">
            $(document).ready(function () {
			
			
			
                if ($.isFunction($.fn.selectBoxIt))s
                {
                    $("select.selectboxit").each(function (i, el)
                    {
                        var $this = $(el),
                                opts = {
                                    showFirstOption: attrDefault($this, 'first-option', true),
                                    'native': attrDefault($this, 'native', false),
                                    defaultText: attrDefault($this, 'text', ''),
                                };

                        $this.addClass('visible');
                        $this.selectBoxIt(opts);
                    });
                }
            });
        </script>
        <script type="text/javascript">
            function select_section(class_id) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
                    success: function (response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function select_attendance(month) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/admin/get_attendance/' + month,
                    success: function (response)
                    {
                        jQuery('#section_holder').html(response);
                    }
					}).complete(function () {
                $(".preloader").hide();
                });
            }
        </script>      
<script type="text/javascript">
function send_sms(class_id,section_id, student_id){
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/attendance_sms/' + class_id + '/' + section_id + '/' + student_id ,
            success: function(response)
            {
				alert(response);
            }
			}).complete(function () {
                $(".preloader").hide();
  });
}
</script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
			   $("#section_selector").show();
               $("#section_selector1").hide();
                jQuery('#section_selector_holder').html(response);
				 
            }
        });
    }
	function get_fee_structure(class_id)
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_fee_structure/' + class_id ,
            success: function(response)
            {
                jQuery('#fee_master_id').html(response);
				 
            }
        });
	}
	function validate()
	{
		if(jQuery('#fee_master_id').val()=='')
		{
			if(confirm("No fee structure selected, do you want to continue?")) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
				return true;
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
</script>
<script>
function view_attendance_list1() 
	{
	
		var subject = $('#subject_id').val();
		var from_date = $('#mydatepicker').val();
		var to_date = $('#mydatepicker1').val();
		var student = $('#student').val();
		
		
    	$.ajax({
        url: '<?php echo base_url();?>index.php/admin/view_attendance_list_hourly/'+subject +'/'+from_date+'/'+to_date+'/'+student,
            success: function(response)
            {
                jQuery('#show_hourly_list').html(response);
			}
        });
    }
	</script>

	



  <script type="text/javascript">
      $(document).ready(function(){
          $('#active1').click(function(){
		 var result = confirm("Want to inactivate?");
         if (result) {
          window.location='<?php echo base_url();?>index.php/admin/inactive_student/<?php echo $student_id;?>/<?php echo $class_id;?>';
		  } // link of your desired page.  
          });
      });
  </script>
  
  
  
  <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
        <script type="text/javascript">
        $('.select2').css('width','700px').select2({allowClear:true})
                        $('#select2-multiple-style .btn').on('click', function(e){
                            var target = $(this).find('input[type=radio]');
                            var which = parseInt(target.val());
                            if(which == 2) $('.select2').addClass('tag-input-style');
                             else $('.select2').removeClass('tag-input-style');
                        });                                    
         </script>              

<script>
function get_bus(route_master_id) 
	{
	var id= route_master_id.name.substr(15);
	$("#msg_bus"+id).html("");
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#route_register_id'+id).html(response);
            }
     });
   }

	function get_bus_route(branch_id) 
	{
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_bus_route/' + branch_id ,
            success: function(response)
            {
				jQuery('#bus_route').html(response);
            }
        });
    }
	
function get_pick_up(route_master_id) 
	{
		var id= route_master_id.name.substr(15);
		//alert(route_master_id.value);
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pick_up/' + route_master_id.value ,
            success: function(response)
            {
			
                jQuery('#pickup_point'+id).html(response);
            }
        });
    }
	
function get_bus_seats(route_register_id) 
	{
		var id= route_register_id.name.substr(17);
		$("#msg_bus").show();
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_seats/' + route_register_id.value ,
            success: function(response)
            {
            	jQuery('#msg_bus').html(response);
            }
        });
    }
	
	function get_base_fare(pickup_point) 
	{
		var id= pickup_point.name.substr(12);
		//alert(route_master_id.value);
		if(pickup_point.value>0)
		{
		    document.getElementById("base_fare"+id).value = "";
    		$.ajax({
                url: '<?php echo base_url();?>index.php/Transport_management/get_base_fare/' + pickup_point.value ,
                success: function(response)
                {
    			//alert(response);
    				document.getElementById("base_fare"+id).value = response;
                    //jQuery('#base_fare'+id).val(response) ;
                }
            });
		}
		else
		{
		    document.getElementById("base_fare"+id).value = "";
		}
    }
	
</script>
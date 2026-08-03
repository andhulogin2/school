<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school(); ?>, 
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
<div style="text-align:center;padding-bottom:20px;"><h3>All Fee Detailed Report <br> </h3></div>
<div>
<table id="simple-table" width="100%" class="table table-striped table-bordered table-hover"  style="border:1px solid black;border-collapse: collapse;">
    <thead>
    
    <tr>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">SI.NO. </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Student Name </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Admission Number </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Class/Section </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Total Amount </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Paid </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Concession </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Pending </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$total_amount_to_pay = 0;
    $total_amount_paid = 0;
    $total_amount_balance = 0;
    $total_amount_concession = 0;
    
	$no = 0;
	foreach($student_fee as $row)
	{
	
			$paid=$row['fee_amount']-$row['fee_balance']-$row['fee_concession'];
	?>
    <tr>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $no=$no+1; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['name']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo get_admission_number($row['student_id']); ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['class_name']."/".$row['section_name']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['fee_amount']; ?> </td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $paid; ?> </td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['fee_concession']; ?> </td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['fee_balance']; ?> </td>
    </tr>
	<?php } ?>
	</tbody>
    </table>
</div>

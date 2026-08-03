<head>
<title>FEE DUE DETAILS</title>
</head>
<body>
<div style="text-align:center;padding-top:20px;"><h3>Fee Due List</h3></div>
<?php
	if($this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
	{
		?>
			<table id="simple-table" class="table table-striped table-bordered table-hover" width="100%"  style="border:1px solid;border-collapse:collapse">
				<thead>
					<tr>
						<th style="border:1px solid" class='table-header'>Sl No.</th>
						<th style="border:1px solid" class='table-header'>Name</th>
						<th style="border:1px solid" class='table-header'>Admission No.</th>
						<th style="border:1px solid" class='table-header'>Class</th>
						<th style="border:1px solid" class='table-header'>Phone</th>
						<th style="border:1px solid" class='table-header'>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
					$total=0;
					foreach($fee_data as $row)
					{
					?>		
					<tr>
						<td style="border:1px solid;text-align:center"><?php echo $i=$i+1; ?></td>
						<td style="border:1px solid;text-align:center"><?php echo $row['name']; ?></td>
						<td style="border:1px solid;text-align:center"><?php echo get_admission_number($row['admission_number']); ?></td>
						<td style="border:1px solid;text-align:center"><?php echo get_student_class_name($row['admission_number'])."-".get_student_section_name($row['admission_number']);?></td>
						<td style="border:1px solid;text-align:center"><?php echo get_student_phone1($row['admission_number']); ?></td>
						<td style="border:1px solid;text-align: right"><?php echo number_format($row['fee_balance'],2); ?></td>
					</tr>
					<?php $total=$total+$row['fee_balance'];
					 } 
					 ?>
					<tr>
						<td style="border:1px solid;text-align:right" colspan="5">Total Amount</td>
						<td style="border:1px solid;text-align:right"><?php echo number_format($total,2); ?></td>
					</tr>
				</tbody>
			</table>
		<?php
	}
	else
	{
		?>
			<table id="simple-table" class="table table-striped table-bordered table-hover" width="100%"  style="border:1px solid;border-collapse:collapse">
				<thead>
					<tr>
						<th style="border:1px solid" class='table-header'>SL NO</th>
						<th style="border:1px solid" class='table-header'>Due Date</th>
						<th style="border:1px solid" class='table-header'>Name</th>
						<th style="border:1px solid" class='table-header'>Class</th>
						<th style="border:1px solid" class='table-header'>Phone</th>
						<th style="border:1px solid" class='table-header'>Amount</th>
                                                <?php
            			if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
            			{
            			    ?>
            			    <th style="border:1px solid" class='table-header'>Last Paid Date</th>
            			    <th style="border:1px solid" class='table-header'>Last Paid Amount</th>    
            			    <?php
            			}
            			?>

					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
					$total=0;
					foreach($fee_data as $row)
					{
					$class_name   	= get_class_name($row['class_id']);
					$section_name   = get_section_name($row['batch_id']);
					?>		
					<tr>
						<td style="border:1px solid;text-align:center"><?php echo $i=$i+1; ?></td>
                                                <td style="border:1px solid;text-align:center"><?php if($row['due_date'] == '0000-00-00'){ echo "-"; }else{ echo date('d-m-Y',strtotime($row['due_date'])); } ?></td>
						<td style="border:1px solid;text-align:center"><?php echo $row['name']; ?></td>
						<td style="border:1px solid;text-align:center"><?php echo get_student_class_name($row['admission_number'])."-".get_student_section_name($row['admission_number']);?></td>
						<td style="border:1px solid;text-align:center"><?php echo $row['phone']; ?></td>
						<td style="border:1px solid;text-align: right"><?php echo number_format($row['fee_balance'],2); ?></td>
                                                <?php
            			if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
            			{   
            			    $last_paid_info =   $this->Fee_management_model->get_last_paid_info($row['admission_number']);
            			    ?>
            			    <td style="border:1px solid;text-align: right"><?php echo $last_paid_info['last_paid_date']; ?></td>
            			    <td style="border:1px solid;text-align: right"><?php echo number_format((int)$last_paid_info['last_paid_amount'],2); ?></td>
            			    <?php
            			}
            			?>

					</tr>
					<?php $total=$total+$row['fee_balance'];
					 } 
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
					 echo "<tr><td colspan='6' style='border:1px solid;text-align:center'><b>Transportation Amount</b> </td></tr>";
					
					foreach($fee_data1 as $row)
					{
					?>		
					<tr>
						<td style="border:1px solid;text-align:center"><?php echo $i=$i+1; ?></td>
						<td style="border:1px solid;text-align:center"><?php echo date('d-m-Y',strtotime($row['due_date'])); ?></td>
						<td style="border:1px solid;text-align:center"><?php echo $row['name']; ?></td>
						<td style="border:1px solid;text-align:center"><?php echo $row['class_name']."-".$row['section_name'];?></td>
						<td style="border:1px solid;text-align:center"><?php echo get_student_phone1($row['student_id']); ?></td>
						<td style="border:1px solid;text-align: right"><?php echo number_format($row['fee_balance'],2); ?></td>
					</tr>
					<?php $total=$total+$row['fee_balance'];
					 }
					 } 
					 ?>
					<tr>
						<td style="border:1px solid;text-align:right" colspan="5">Total Amount</td>
						<td style="border:1px solid;text-align:right"><?php echo number_format($total,2); ?></td>
					</tr>
				</tbody>
			</table>
		<?php
	}	
	
	?>

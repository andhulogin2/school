<div>
    <table class="table table-bordered sortable">
    <thead>
    
    <tr>
    <th style="text-align: center;" class="table-header">SINO </th>
    <th style="text-align: center;" class="table-header">Student Name </th>
    <th style="text-align: center;" class="table-header">Admission Number </th>
    <th style="text-align: center;" class="table-header">Class/Section </th>
    <th style="text-align: center;" class="table-header">Total Amount </th>
    <th style="text-align: center;" class="table-header">Paid </th>
    <th style="text-align: center;" class="table-header">Concession </th>
    <th style="text-align: center;" class="table-header">Pending </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$no = 0;
			if(count($student_fee)==0)
			{
			echo "<tr><td colspan='7' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			}
	foreach($student_fee as $row)
	{
	
			$paid=$row['fee_amount']-$row['fee_balance']-$row['fee_concession'];
	?>
    <tr>
    <td><?php echo $no=$no+1; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo get_admission_number($row['student_id']); ?></td>
    <td><?php echo $row['class_name']."/".$row['section_name']; ?></td>
    <td><?php echo $row['fee_amount']; ?> </td>
    <td><?php echo $paid; ?> </td>
    <td><?php echo $row['fee_concession']; ?> </td>
    <td><?php echo $row['fee_balance']; ?> </td>
    </tr>
	<?php } ?>
	</tbody>
    </table>
</div>

<div align="center">
<a href="<?php echo base_url(); ?>index.php/FeeManagement/all_fee_pdf/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>/<?php echo $student_id; ?>" target="_blank"><button name="fee_pdf" class="btn btn-info">Download PDF</button></a>
<a href="<?php echo base_url(); ?>index.php/FeeManagement/all_fee_excel/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>/<?php echo $student_id; ?>"><button name="fee_excel" class="btn btn-info">Download Excel</button></a>
</div>






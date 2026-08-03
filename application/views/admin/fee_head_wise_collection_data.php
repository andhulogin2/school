<div>
    <table class="table table-bordered sortable">
    <thead>
    
    <tr>
    <th style="text-align: center;" class="table-header">SINO </th>
    <th style="text-align: center;" class="table-header">Fee Head </th>
    <th style="text-align: center;" class="table-header">Total Amount </th>
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
                        $total  =   0;
	foreach($student_fee as $row)
	{
	if($row['fee_amount']!=0){
	?>
    <tr>
    <td><?php echo $no=$no+1; ?></td>
    <td><?php if($row['title']=="op"){echo "Last Year";}echo " ".$row['fee_head']; ?></td>
    <td align="right"><?php echo number_format($row['fee_amount'],2); ?> </td>
    </tr>
	<?php 
        $total  +=  $row['fee_amount'];   
    }} ?>
    <tr>
        <th colspan="2" style="text-align: right;">Total</th>
        <th style="text-align: right;"><?php echo number_format($total,2); ?></th>
    </tr>
	</tbody>
    </table>
</div>

<div align="center">
<a href="<?php echo base_url(); ?>index.php/FeeManagement/fee_head_wise_report_pdf/<?php echo $from_date;?>/<?php echo $to_date;?>/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>" target="_blank"><button name="fee_pdf" class="btn btn-info">Download PDF</button></a>
<a href="<?php echo base_url(); ?>index.php/FeeManagement/fee_head_wise_report_excel/<?php echo $from_date;?>/<?php echo $to_date;?>/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>"><button name="fee_excel" class="btn btn-info">Download Excel</button></a>
</div>






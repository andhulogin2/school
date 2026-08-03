<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school(); ?>, 
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
<div style="text-align:center;padding-bottom:20px;"><h3>Fee Head wise Collection Report <br> </h3></div>
<div>
<table id="simple-table" width="100%" class="table table-striped table-bordered table-hover"  style="border:1px solid black;border-collapse: collapse;">
    <thead>
    
    <tr>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">SI.NO. </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Fee Head Name </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Total Amount </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$no = 0;
        $total  =   0;
	foreach($student_fee as $row)
	{
	if($row['fee_amount']!=0){
	?>
    <tr>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php echo $no=$no+1; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php if($row['title']=="op"){echo "Last Year";}echo " ".$row['fee_head']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;text-align:right"><?php echo number_format($row['fee_amount'],2); ?> </td>
    </tr>
	<?php 
        $total  +=  $row['fee_amount'];  
    } } ?>
    <tr>
        <th colspan="2" style="text-align: right;">Total</th>
        <th style="text-align: right;"><?php echo number_format($total,2); ?></th>
    </tr>
	</tbody>
    </table>
</div>

<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school(); ?>, 
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
<div style="text-align:center;padding-bottom:20px;"><h3>Certificate Issue Return Report <br> </h3></div>
<div>
<table id="simple-table" width="100%" class="table table-striped table-bordered table-hover"  style="border:1px solid black;border-collapse: collapse;">
    <thead>
    
    <tr>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">SI.NO. </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Student Name </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Class </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Section </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Certificate Issued </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Issue Date </th>
    <th style="border:1px solid black;border-collapse: collapse;" class="table-header">Return Date </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$no = 0;
	foreach($certificate as $row)
	{
	?>
    <tr>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php echo $no=$no+1; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $row['name']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php echo $row['class_name']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php echo $row['section_name']; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;"><?php echo $this->db->get_where('student_certificates',array('certificate_id'=>$row['certificate_id']))->row()->certificate_name; ?></td>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php echo date('d-m-Y',strtotime($row['issued_on'])); ?></td>
    <td style="border:1px solid black;border-collapse: collapse;text-align:center"><?php if($row['return_date']!='0000-00-00 00:00:00'){ echo date('d-m-Y',strtotime($row['return_date'])); } else { echo "-"; } ?></td>
    </tr>
	<?php } ?>
	</tbody>
    </table>
</div>

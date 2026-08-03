<div>
    <table class="table table-bordered sortable">
    <thead>
    
    <tr>
    <th style="text-align: center;" class="table-header">SINO </th>
    <th style="text-align: center;" class="table-header">Student Name </th>
    <th style="text-align: center;" class="table-header">Class </th>
    <th style="text-align: center;" class="table-header">Section </th>
    <th style="text-align: center;" class="table-header">Certificate Issued </th>
    <th style="text-align: center;" class="table-header">Issue Date </th>
    <th style="text-align: center;" class="table-header">Return Date </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$no = 0;
			if(count($certificate)==0)
			{
			echo "<tr><td colspan='7' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			}
	foreach($certificate as $row)
	{
	?>
    <tr>
    <td><?php echo $no=$no+1; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td align="center"><?php echo $row['class_name']; ?></td>
    <td align="center"><?php echo $row['section_name']; ?></td>
    <td><?php echo $this->db->get_where('student_certificates',array('certificate_id'=>$row['certificate_id']))->row()->certificate_name; ?></td>
    <td align="center"><?php echo date('d-m-Y',strtotime($row['issued_on'])); ?></td>
    <td align="center"><?php if($row['return_date']!='0000-00-00 00:00:00'){ echo date('d-m-Y',strtotime($row['return_date'])); } else { echo "-"; } ?></td>
    </tr>
	<?php } ?>
	</tbody>
    </table>
</div>

<div align="center">
<a href="<?php echo base_url(); ?>index.php/Admin/certificate_issue_return_pdf/<?php echo $from_date;?>/<?php echo $to_date;?>/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>" target="_blank"><button name="fee_pdf" class="btn btn-info">Download PDF</button></a>
<a href="<?php echo base_url(); ?>index.php/Admin/certificate_issue_return_excel/<?php echo $from_date;?>/<?php echo $to_date;?>/<?php echo $department; ?>/<?php echo $class_id; ?>/<?php echo $section_id;?>"><button name="fee_excel" class="btn btn-info">Download Excel</button></a>
</div>






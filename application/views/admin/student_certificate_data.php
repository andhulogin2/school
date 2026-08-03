<div>
    <table class="table table-bordered sortable">
    <thead>
    
    <tr>
    <th style="text-align: center;" class="table-header">SINO </th>
    <th style="text-align: center;" class="table-header">Student Name </th>
    <th style="text-align: center;" class="table-header">Class </th>
    <th style="text-align: center;" class="table-header">Section </th>
    <th style="text-align: center;" class="table-header">Certificate Issued </th>
    </tr>
    </thead>
    
    <tbody>
    <?php
	$no = 0;
			if(count($certificate_submitted)==0)
			{
			echo "<tr><td colspan='7' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			}
	foreach($certificate_submitted as $row)
	{
	?>
    <tr>
    <td><?php echo $no=$no+1; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td align="center"><?php echo $row['class_name']; ?></td>
    <td align="center"><?php echo $row['section_name']; ?></td>
    <td align="center">
                        <?php foreach($certificate as $cert){ 
						$check = strpos($row['certificates_submitted'], "'".$cert['certificate_id']."'")!== false;?>
						<input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $cert['certificate_id'] ?>" <?php if($check=='1') { echo "checked='checked'";} ?>>
						<span class="lbl"> <?php echo $cert['certificate_name'] ?></span>
						&nbsp;
						<?php } ?>
</td>
    </tr>
	<?php } ?>
	</tbody>
    </table>
</div>







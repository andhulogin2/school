<style>
table {
    border-collapse: collapse;
	width:80%;
}

table, th, td {
    border: 1px solid black;
}
</style>
<br />
<div style="text-align:center">
	<table align="center">
    	<tr>
        	<th>Branch:&nbsp;<?php echo $branch_name; ?></th>
            <?php
			if($department_id!=''):
			?>
        	<th>Department:&nbsp;<?php echo $department_name; ?></th>
            <?php
			endif;
			if($class_id!=''):
			?>
        	<th>Class:&nbsp;
			<?php 
				echo get_class_name($class_id); 
				if($section_id!=''):
					echo " ".get_section_name($section_id);
				endif;
			?></th>
            <?php
			endif;
			if($fee_head_id!=''):
			?>
        	<th>Fee Item:&nbsp;<?php echo $fee_item; ?></th>
            <?php
			endif;
			?>
        </tr>
    </table>
	<table align="center">
    	<tr>
        	<th><center>Sl.No.</center></th>
        	<th><center>Name</center></th>
            <?php
			if($class_id==''):
			?>
        	<th><center>Class</center></th>
            <?php
			elseif($section_id==''):
			?>
        	<th><center>Section</center></th>
            <?php
			endif;
			if($department_id==''):
			?>
        	<th><center>Department</center></th>
            <?php
			endif;
			if($fee_head_id==''):
			?>
        	<th><center>Fee Item</center></th>
            <?php
			endif;
			?>
        	<th><center>Description</center></th>
        	<th style="width:150px;"><center>Receipt Number</center></th>
        	<th><center>Date Paid</center></th>
        	<th><center>Fee Amount</center></th>
        </tr>
        <?php
			if(count($report)>0):
			$i			=	1;
			$total		=	0;
			$colspan	=	0;	
				foreach($report as $reports):
		?>
        <tr>
        	<td><center><?php echo $i++; $colspan++; ?></center></td>
        	<td><?php echo $reports['student_name']; $colspan++; ?></td>
            <?php
			if($class_id==''):
			?>
        	<td><center>
			<?php 
				echo get_class_name($reports['class_id']);  $colspan++;
				if($section_id==''):
					echo " ".get_section_name($reports['section_id']);
				endif;
			?></center></td>
            <?php
			elseif($section_id==''):
			?>
        	<td><center>
			<?php 
				echo get_section_name($reports['section_id']); $colspan++; 
			?></center></td>
            <?php
			endif;
			if($department_id==''):
			?>
        	<td><center><?php echo $reports['dept_name']; $colspan++; ?></center></td>
            <?php
			endif;
			if($fee_head_id==''):
			?>
        	<td><center><?php echo $reports['fee_head']; $colspan++; ?></center></td>
            <?php
			endif;
			?>
        	<td><center><?php echo $reports['description']; $colspan++; ?></center></td>
        	<td><center><?php echo $reports['receipt_number']; $colspan++; ?></center></td>
        	<td><center><?php echo date('d-m-Y',strtotime($reports['date_paid'])); $colspan++; ?></center></td>
        	<td><center>
				<?php 
					echo $reports['fee_amount']; 
					$total	=	$total+$reports['fee_amount'];
					$colspan++;
				?></center></td>
        </tr>
        <?php
				endforeach;
				$colspan	=	$colspan/count($report)-1;
		?>
        <tr>
        	<td colspan="<?php echo $colspan; ?>" style="text-align:right">Total</td>	
        	<td><center><?php echo number_format($total,2); ?></center></td>	
        </tr>
        <?php		
			else:
		?>
        <tr>
        	<td style="color:#FF0000" colspan="7"><center><b>No Records Found.</b></center></td>
        </tr>
        <?php
			endif;
		?>
    </table>
</div>

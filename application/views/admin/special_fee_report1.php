<?php echo form_open('FeeManagement/special_fee_report_pdf/' , array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>"  />
<input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>"  />
<input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>"  />
<input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>"  />
<input type="hidden" name="fee_head_id" id="fee_head_id" value="<?php echo $fee_head_id; ?>"  />
<br />
<?php 
if(count($report)>0):
?>
<div style="text-align:right;margin-bottom:5px;">
	<input type="submit" value="Download" class="btn btn-info btn-sm" formaction="<?php echo base_url();?>index.php/FeeManagement/special_fee_report_pdf/" formtarget="_blank" />
</div>
<?php
endif;
?>

<div class="table-responsive">
	<table class="table simple-table table-bordered table-hover" style="margin-bottom:0px;">
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
	<table class="table simple-table table-bordered table-hover">
    	<tr>
        	<th class="table-header"><center>Sl.No.</center></th>
        	<th class="table-header"><center>Name</center></th>
            <?php
			if($class_id==''):
			?>
        	<th class="table-header"><center>Class</center></th>
            <?php
			elseif($section_id==''):
			?>
        	<th class="table-header"><center>Section</center></th>
            <?php
			endif;
			if($department_id==''):
			?>
        	<th class="table-header"><center>Department</center></th>
            <?php
			endif;
			if($fee_head_id==''):
			?>
        	<th class="table-header"><center>Fee Item</center></th>
            <?php
			endif;
			?>
        	<th class="table-header"><center>Description</center></th>
        	<th class="table-header"><center>Receipt Number</center></th>
        	<th class="table-header"><center>Date Paid</center></th>
        	<th class="table-header"><center>Fee Amount</center></th>
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
        	<td style="color:#FF0000" colspan="7"><center><b>No Records Found.</b></center></td>
        <?php
			endif;
		?>
    </table>
</div>
<?php 
if(count($report)>0):
?>
<div style="text-align:right;margin-top:5px;">
	<input type="submit" value="Download" class="btn btn-info btn-sm" formaction="<?php echo base_url();?>index.php/FeeManagement/special_fee_report_pdf/" formtarget="_blank" />
</div>
<?php
endif;
?>
<?php echo form_close(); ?>

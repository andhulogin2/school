   <table id="dynamic-table" class="table table-striped table-bordered table-hover">
       <thead>
       		<tr>
            <th class="table-header" style="text-align:center">Sl No</th>
            <th class="table-header" style="text-align:center">Date</th>
            <th class="table-header" style="text-align:center">Collected By</th>
            <th class="table-header" style="text-align:center">Amount</th>
            </tr>       
       </thead>
       <tbody>
            <?php 
			$i=0;
			if(count($fee)==0){ ?>
			<tr><td colspan="4" align="center"><font color="#FF0000">No Data Found</font></td></tr>
			<?php } else {
			$total=0;
			
			 foreach($fee as $row) { 
			 ?>
       		<tr>
            <td align="center" width="20%"><?php echo $i=$i+1; ?></td>
            <td align="center" width="20%"><?php echo date('d-m-Y',strtotime($row['collected_date'])); ?></td>
            <td align="center" width="20%"><?php echo $this->db->get_where('staff',array('user_id'=>$row['collected_by']))->row()->name; ?></td>
            <td align="right" width="20%"><?php echo $row['amount_paid']; ?></td>
            <?php $total=$total+$row['amount_paid']; ?>
            </tr>
            <?php } ?>
            <tr><td colspan="3" align="right">Total Amount</td><td align="right"><?php echo number_format($total,2); ?></td></tr>
            <tr><td colspan="4" align="center">Total Amount By:</td></tr>
			 <?php 
			 foreach($total_fee as $row1) { 
			?>
            <tr><td colspan="3" align="right"><?php echo $this->db->get_where('staff',array('user_id'=>$row1['collected_by']))->row()->name; ?></td><td align="right"><?php echo $row1['amount_paid']; ?></td></tr>
            <?php } } ?>
       </tbody>
   </table>


<div style="text-align:center;padding-bottom:20px;padding-top:20px;"><h3>Fee Collection Detailed Report <br> <?php echo date('d-m-Y',strtotime($date_from))." to ".date('d-m-Y',strtotime($date_to)) ?></h3></div>

<table id="simple-table" width="100%" class="table table-striped table-bordered table-hover"  style="border:1px solid black;border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border:1px solid black;border-collapse: collapse;width:10%" class='table-header'>SlNO</th>
            <th style="border:1px solid black;border-collapse: collapse;width:20%" class='table-header'>Date Paid</th>
            <th style="border:1px solid black;border-collapse: collapse;width:10%" class='table-header'>Receipt Number</th>
            <th style="border:1px solid black;border-collapse: collapse;width:20%" class='table-header'>Name</th>
            <th style="border:1px solid black;border-collapse: collapse;width:20%" class='table-header'>Class</th>
            <th style="border:1px solid black;border-collapse: collapse;width:20%" class='table-header'>Fee Item</th>
            <th style="border:1px solid black;border-collapse: collapse;width:10%" class='table-header'>Amount</th>
            <!--<th class='table-header'>Print</th>-->
        </tr>
    </thead>
    <tbody>
    <?php 
	$total=0;
	$i=1;
	if(count($query_result)>0 || count($query_result1)>0 || count($query_result2)>0 || count($query_result3)>0)
	    {
            if(count($query_result3)>0)
            {
                echo "<tr><td style='text-align:center;border:1px solid black;border-collapse: collapse;' colspan='7'>Opening Balance</td></tr>";
                foreach($query_result3 as $row)
                {
                        $total =$total+$row['amount_paid'];
                        echo "<tr><td style='border:1px solid black;border-collapse: collapse;'>$i</td><td style='border:1px solid black;border-collapse: collapse;'>";
                        echo  date('d-m-Y', strtotime( $row['date_paid']));
                        echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['receipt_number'];
                        echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['student_name'];
                        echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['class_name'];
                        echo " - " . $row['section_name'];
                        echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['fee_head']."(".$row['fee_from_year'].")";
                        echo "</td><td align='center'  style='border:1px solid black;border-collapse: collapse;'>". number_format($row['amount_paid'],2) . "</td></tr>";
                        $i=$i+1;
                }
            }   
            echo "<tr><td style='text-align:center;border:1px solid black;border-collapse: collapse;' colspan='7'>Regular Fee</td></tr>";
	    foreach($query_result as $row)
	    {
			$total =$total+$row['fee_amount'];
            echo "<tr><td style='border:1px solid black;border-collapse: collapse;'>$i</td><td style='border:1px solid black;border-collapse: collapse;'>";
			echo  date('d-m-Y', strtotime( $row['date_paid']));
			echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['receipt_number'];
			echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" .get_student_name($row['admission_number']);
			echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" .get_student_class_name($row['admission_number']);
			echo " - " .get_student_section_name($row['admission_number']);
			echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['fee_head'];
			echo "</td><td align='center'  style='border:1px solid black;border-collapse: collapse;'>". number_format($row['fee_amount'],2) . "</td></tr>";
			$student_id	=	$row['admission_number'];//Here the admission number is actually student_id
			?>
            <!--<td><a href="<?php /* echo base_url();?>index.php/FeeManagement/print_receipt/<?php echo $student_id;?>/<?php echo $branch_id;?>/<?php echo $row['receipt_number'];?>/<?php echo date('d-m-Y', strtotime( $row['date_paid'])); */?>" target="_blank">Print</a></td></tr>-->
            
            <?php   
					$i=$i+1;
	    }
		if(count($query_result1)>0)
		{
			echo "<tr><td style='text-align:center;border:1px solid black;border-collapse: collapse;' colspan='7'>Special Fee</td></tr>";
			foreach($query_result1 as $row) 
			{
				$total =$total+$row['fee_amount'];
				echo "<tr><td style='border:1px solid black;border-collapse: collapse;'>$i</td><td style='border:1px solid black;border-collapse: collapse;'>";
				echo  date('d-m-Y', strtotime( $row['date_paid']));
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['receipt_number'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['student_name'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['class_name'];
				echo " - " . $row['section_name'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['fee_head'];
				echo "</td><td align='center' style='border:1px solid black;border-collapse: collapse;'>". number_format($row['fee_amount'],2) . "</td></tr>";
				$i=$i+1;
			}
		}

		if(count($query_result2)>0)
		{
			echo "<tr><td style='text-align:center;border:1px solid black;border-collapse: collapse;' colspan='7'>Transportation Fee</td></tr>";
			foreach($query_result2 as $row) 
			{
				$total =$total+$row['amount_paid'];
				echo "<tr><td style='border:1px solid black;border-collapse: collapse;'>$i</td><td style='border:1px solid black;border-collapse: collapse;'>";
				echo  date('d-m-Y', strtotime( $row['date_paid']));
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['receipt_number'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['student_name'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['class_name'];
				echo " - " . $row['section_name'];
				echo " </td><td style='border:1px solid black;border-collapse: collapse;'>" . $row['installment_name'];
				echo "</td><td align='center' style='border:1px solid black;border-collapse: collapse;'>". number_format($row['amount_paid'],2) . "</td></tr>";
				$i=$i+1;
			}
		}

        echo "<tr><td colspan='5' style='border:1px solid black;border-collapse: collapse;'><td style='border:1px solid black;border-collapse: collapse;'><b>Total Amount </b></td><td align='center' style='border:1px solid black;border-collapse: collapse;'><b>". number_format( $total,2)."</B></td></tr>";
	}
	if(count($query_result)==0 && count($query_result1)==0 && count($query_result2)==0 && count($query_result3)==0)
	{
		?>
        <tr>
        	<td colspan="7" style="color:#FF0000"><center><b>No results found...</b></center></td>
        </tr>
        
        <?php
	}
	?>
    </tbody>
</table>

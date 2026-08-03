<?php
	$data['result']		=	$result;			// Set these data to session so that we can use it in the pdf_report_student() function in the controller
	$_SESSION["data"] = 	$data;
	
	$data1['report_type']			=	$report_type;		// Set these data to session and we need these data to print single student details
	$data1['branch_id']				=	$branch_id;			
	$data1['route_master_id']		=	$route_master_id;
	$data1['route_register_id']		=	$route_register_id;
	$data1['route_details_id']		=	$route_details_id;
	$data1['department_id']			=	$department_id;
	$data1['class_id']				=	$class_id;
	$data1['section_id']			=	$section_id;
	$data1['student_id']			=	$student_id;
	$data1['payment_filter']		=	$payment_filter;
	$data1['receipt_number']		=	$receipt_number;
	$data1['due_date_from']			=	$due_date_from;
	$data1['due_date_to']			=	$due_date_to;
	$data1['bus_fee_settings_id']	=	$bus_fee_settings_id;
	$data1['paid_date_from']		=	$paid_date_from;
	$data1['paid_date_to']			=	$paid_date_to;
	$_SESSION["data1"] 				= 	$data1;
	
/*echo "<pre>";
print_r($result);
echo "</pre>";
die();*/
?>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
            <?php echo form_open_multipart('Transport_management/pdf_report_fee', array('target' => '_blank','class' => 'form-horizontal','id'=>"myform"));?>
                <br/> 
                <label><b> <?php // if($student_id == '' && count($result)>0 ){?> <?php // echo $count; }  ?></b></label>		
                <label><b> <?php  ?></b></label>
				<?php
					if(count($result)>0)
					{
					?>
                <button type="submit" style="float:right" class="btn-info">Download</button>
                <br/> 
                <br/>
               
                <div class="table-responsive">
                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="margin-bottom:1px;">
                    <tbody>
					<?php
						$count					=	0;
						$total_amount			=	0;
						$total_concession		=	0;
						$total_paid				=	0;
						$total_balance			=	0;
						$total_late_fee			=	0;
						$prev_stud_id			=	"";
						$prev_inst_id			=	"";
						$student_fee_amount		=	0;
						$student_fee_balance	=	0;
						$student_fee_concession	=	0;
						$student_paid_amount	=	0;
						$student_late_fee		=	0;
						//$settings_id			=	array();
						$i						=	0;
						$length					=	count($result);
						$num_of_installments	=	count($installments);
						foreach($result as $value):
							$curr_stud_id	=	$value['student_id'];
							$curr_inst_id	=	$value['bus_fee_settings_id'];
							if($prev_stud_id != $curr_stud_id)					//if new student
							{
							$count++;
							if($count > 1)	//Display 'Total Amount' row of each student before the next student's heading. 
							{				//This will not display last student's  'Total Amount' row.For that,below a condition is written to check whether the last element 
											//of the array is reached. If last element,then last studen's 'Total Amount' row will be displayed.
							?>
                        <tr>
                        	<th colspan="5" style="text-align:right"><b>Total</b></th>
                            <td><center><?php echo $student_fee_amount; ?></center></td>
                            <td><center><?php echo $student_fee_balance; ?></center></td>
                            <td><center><?php echo $student_fee_concession; ?></center></td>
                            <td><center><?php echo $student_paid_amount; ?></center></td>
                            <td><center><?php echo $student_late_fee; ?></td>
                            <td colspan="2"></td>
                        </tr>
                            <?php	
							$total_amount			=	$total_amount+$student_fee_amount;
							$total_balance			=	$total_balance+$student_fee_balance;
							$total_concession		=	$total_concession+$student_fee_concession;
							$total_paid				=	$total_paid+$student_paid_amount;
							$total_late_fee			=	$total_late_fee+$student_late_fee;	
							$student_fee_amount		=	0;
							$student_fee_balance	=	0;
							$student_fee_concession	=	0;
							$student_paid_amount	=	0;
							$student_late_fee		=	0;
							}
							?>
                    	<tr style="background-color:#CCCCCC">
                        	<th class='table-header' colspan="2"><b>Name :&nbsp;</b><?php echo $value['name']; ?></th>
                        	<th class='table-header' colspan="2"><b>Class :&nbsp;</b><?php echo $value['class_name'].$value['section_name']; ?></th>
                            <th class='table-header' colspan="7"><b>Department :&nbsp;</b><?php echo $value['dept_name']; ?></th>
                            <th class='table-header'><button type="submit" formaction="<?php echo base_url();?>index.php/Transport_management/pdf_report_single_fee/<?php echo $value['student_id']; ?>" class="btn-info download_single" style="float:right">Download</button></th>
						</tr>
                        <tr style="background-color:#CCCCCC">
                            <th>Route</th>
                            <th>Bus Number</th>
                            <th>Pickup Point</th>
                            <th>Installment</th>
                            <th>Due Date</th>
                            <th>Bus Fee</th>
                            <th>Fee Balance</th>
                            <th>Concession</th>
                            <th>Paid Amount</th>
                            <th>Late Fee</th>
                            <th>Receipt Number</th>
                            <th>Paid Date</th>
                        </tr>    
                            <?php
							}
							if($prev_stud_id != $curr_stud_id && $prev_inst_id != $curr_inst_id)		//if new student and new installment
							{
								$fee_balance			=	bcsub(bcsub($value['fee_amount'],$value['fee_concession'],2),$value['paid_amount'],2);
								$student_fee_amount		=	bcadd($student_fee_amount, $value['fee_amount'], 2);
								$student_fee_balance	=	bcadd($student_fee_balance, $fee_balance, 2);
								$student_fee_concession	=	bcadd($student_fee_concession, $value['fee_concession'], 2);
								$student_late_fee		=	bcadd($student_late_fee, $value['late_fee'], 2);
							}
							else if($prev_stud_id == $curr_stud_id && $prev_inst_id != $curr_inst_id)	//if old student and new installment
							{
								$fee_balance			=	bcsub(bcsub($value['fee_amount'],$value['fee_concession'],2),$value['paid_amount'],2);
								$student_fee_amount		=	bcadd($student_fee_amount, $value['fee_amount'], 2);
								$student_fee_balance	=	bcadd($student_fee_balance, $fee_balance, 2);
								$student_fee_concession	=	bcadd($student_fee_concession, $value['fee_concession'], 2);
								$student_late_fee		=	bcadd($student_late_fee, $value['late_fee'], 2);
							}
							else if($prev_stud_id == $curr_stud_id && $prev_inst_id == $curr_inst_id)	//if old student and old installment
							{
								$fee_balance			=	bcsub($fee_balance, $value['paid_amount'], 2);
								$student_fee_balance	=	bcsub($student_fee_balance, $value['paid_amount'], 2);
								$student_late_fee		=	bcadd($student_late_fee, $value['late_fee'], 2);
							}
							if($prev_stud_id != $curr_stud_id && $prev_inst_id == $curr_inst_id)		//if new student and old installment
							{
								$fee_balance			=	bcsub(bcsub($value['fee_amount'],$value['fee_concession'],2),$value['paid_amount'],2);
								$student_fee_amount		=	bcadd($student_fee_amount, $value['fee_amount'], 2);
								$student_fee_balance	=	bcadd($student_fee_balance, $fee_balance, 2);
								$student_fee_concession	=	bcadd($student_fee_concession, $value['fee_concession'], 2);
								$student_late_fee		=	bcadd($student_late_fee, $value['late_fee'], 2);
							}
							$student_paid_amount	=	bcadd($student_paid_amount, $value['paid_amount'], 2);
							
							$prev_inst_id = $curr_inst_id;
							?>
                        <tr>
                            <td><center><?php echo $value['route_master_name']; ?></center></td>
                            <td><center><?php echo $value['bus_number']; ?></center></td>
                            <td><center><?php echo $value['pickup_point']; ?></center></td>
                            <td><center><?php echo $value['installment_name']; ?></center></td>
                            <td><center><?php echo date('d-m-Y',strtotime($value['due_date'])); ?></center></td>
                            <td><center><?php echo $value['fee_amount']; ?></center></td>		
                            <td><center><?php echo $fee_balance; ?></center></td>
                            <td><center><?php echo $value['fee_concession']; ?></center></td>
                            <td><center><?php if($value['paid_amount'] == '') { echo "0.00"; }else {echo $value['paid_amount'];} ?></center></td>
                            <td><center><?php if($value['late_fee'] == '') { echo "0.00"; }else {echo $value['late_fee'];} ?></center></td>
                            <td><center><?php if($value['receipt_number'] == '') { echo "-"; }else {echo $value['receipt_number'];} ?></center></td>
                            <td><center><?php if($value['date_paid'] == '') { echo "-"; }else { echo date('d-m-Y',strtotime($value['date_paid'])); } ?></center></td>
                        </tr>    
                        
						<?php
							if($i == $length-1)	//If last element of the array
							{					//Display 'Total Amount' row of the last student
							?>
                        <tr>
                        	<th colspan="5" style="text-align:right"><b>Total</b></th>
                            <td><center><?php echo $student_fee_amount; ?></center></td>
                            <td><center><?php echo $student_fee_balance; ?></center></td>
                            <td><center><?php echo $student_fee_concession; ?></center></td>
                            <td><center><?php echo $student_paid_amount; ?></center></td>
                            <td><center><?php echo $student_late_fee; ?></td>
                            <td colspan="2"></td>
                            </tr>
                                <?php	
                                $total_amount			=	$total_amount+$student_fee_amount;
                                $total_balance			=	$total_balance+$student_fee_balance;
                                $total_concession		=	$total_concession+$student_fee_concession;
                                $total_paid				=	$total_paid+$student_paid_amount;
                                $total_late_fee			=	$total_late_fee+$student_late_fee;	
                                $student_fee_amount		=	0;
                                $student_fee_balance	=	0;
                                $student_fee_concession	=	0;
                                $student_paid_amount	=	0;
                                $student_late_fee		=	0;
								?>
                                <tr>
                                    <th colspan="12" class="table-header" style="text-align:center;"><b>Fee Summary</b></th>
                                </tr>
                                <tr>	
                                	<td colspan="6" style="text-align:right;border:0px;font-size:14px">
                                    	Total Amount <br>
                                        <span <?php if($total_balance>0){ echo 'style="color:#FF0000;"'; } ?>>Total Balance</span> <br>
                                        Total Concession <br>
                                        Total Paid Amount <br>
                                        Total Late Fee <br>
                                    </td>
                                    <td colspan="6" style="font-size:14px;border:0px;">
                                    	<b>
                                    		<?php echo $total_amount; ?><br>
                                            <span <?php if($total_balance>0){ echo 'style="color:#FF0000;"'; } ?>><?php echo $total_balance; ?></span><br>
                                            <?php echo $total_concession; ?><br>
                                           	<?php echo $total_paid; ?><br>
                                            <?php echo $total_late_fee; ?>
                                    	</b>	
                                    </td>
                                </tr>
                            	<?php
							}
							$prev_stud_id		=	$curr_stud_id;
							$i++;
						endforeach;
				?>	
                    </tbody>
                </table>
                </div>
                </div>
                </div>
                <?php
					}
					else
					{
					?>
					<table id="simple-table" class="table table-hover"  cellpadding="2" style="border:1px solid #CCCCCC;margin-bottom:1px;">
                    <tbody>
                    	<tr>
                        	<td><center><b style="color:#FF0000">No results found</b></center></td>
                        </tr>
                    </tbody>
                    </table>
					<?php
                    }
					echo form_close();
				?>                    
            </div>
        </div>
    </div>

<?php include_once APPPATH . 'views/main_head.php';?>
 
<body>
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Fee Collection Report</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
							Fee Collection 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Detailed Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/fee_collection_detailed_report"><b> <button class="btn-info">Back</button></b></a></div>
  
<?php echo form_open(base_url() . 'index.php/feeManagement/fee_collection_detailed_report_excel' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data','target'=>'_blank'));?>

<input type="hidden" name="date_from" id="date_from" value="<?php echo $date_from; ?>" >
<input type="hidden" name="date_to" id="date_to" value="<?php echo $date_to; ?>" >
<input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>" >
<input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" >
<input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>" >
<?php
	$result		=	base64_encode(serialize($query_result));
	$result1	=	base64_encode(serialize($query_result1));
	$result2	=	base64_encode(serialize($query_result2));
	$result3	=	base64_encode(serialize($query_result3));
?>
<input type="hidden" name="result" id="result" value="<?php echo $result; ?>" >
<input type="hidden" name="result1" id="result1" value="<?php echo $result1; ?>" >
<input type="hidden" name="result2" id="result2" value="<?php echo $result2; ?>" >
<input type="hidden" name="result3" id="result3" value="<?php echo $result3; ?>" >

   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
			 echo "<h4>Fee Collection Detailed Report</h4>"; 
            echo "<h4>".date('d-m-Y', strtotime( $date_from ))." To " . date('d-m-Y', strtotime( $date_to)) ."</h4>"; 
		?>
            </td></tr>
   </table>
    <div id="content">            
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            
            <thead><tr><th class='table-header'>SlNO</th><th class='table-header'>Date Paid</th>
            <th class='table-header'>Receipt Number</th><th class='table-header'>Name</th>
            <th class='table-header'>Class</th><th class='table-header'>Admission number</th><th class='table-header'>Fee Item</th><th class='table-header'>Amount</th>
            <!--<th class='table-header'>Print</th>-->
            </tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			if(count($query_result)>0 || count($query_result1)>0 || count($query_result2)>0 || count($query_result3)>0)
			{
                        if(count($query_result3)>0)
			{
				echo "<tr><td style='text-align:center;' colspan='8'>Opening Balance</td></tr>";
				foreach($query_result3 as $row)
				{
					$total =$total+$row['amount_paid'];
					echo "<tr><td>$i</td><td>";
					echo  date('d-m-Y', strtotime( $row['date_paid']));
					echo " </td><td>" . $row['receipt_number'];
					echo " </td><td>" . $row['student_name'];
					echo " </td><td>" . $row['class_name'];
					echo " - " . $row['section_name'];
					echo " </td><td>".$row['admission_number']."</td><td>" . $row['fee_head']."(".$row['fee_from_year'].")";
					echo "</td><td align='center'>". number_format($row['amount_paid'],2) . "</td></tr>";
					$i=$i+1;
				}
			} 
                        if(count($query_result)>0)
                        {
                            echo "<tr><td style='text-align:center;' colspan='8'>Regular Fee</td></tr>";
                            foreach($query_result as $row)
                            {
                            $total =$total+$row['fee_amount'];
                echo "<tr><td>$i</td><td>";
                            echo  date('d-m-Y', strtotime( $row['date_paid']));
                            echo " </td><td>" . $row['receipt_number'];
                            echo " </td><td>" .get_student_name($row['admission_number']);
                            echo " </td><td>" .get_student_class_name($row['admission_number']);
                            echo " - " .get_student_section_name($row['admission_number']);
                            echo " </td><td>".get_admission_number($row['admission_number'])."</td><td>" . $row['fee_head'];
                            echo "</td><td align='center'>". number_format($row['fee_amount'],2) . "</td></tr>";
                            $student_id	=	$row['admission_number'];//Here the admission number is actually student_id
                            ?>
                <!--<td><a href="<?php /* echo base_url();?>index.php/FeeManagement/print_receipt/<?php echo $student_id;?>/<?php echo $branch_id;?>/<?php echo $row['receipt_number'];?>/<?php echo date('d-m-Y', strtotime( $row['date_paid'])); */?>" target="_blank">Print</a></td></tr>-->
                </tbody>
                <?php
                                            $i=$i+1;

                            }
                        }
			if(count($query_result1)>0)
			{
				echo "<tr><td style='text-align:center;' colspan='8'>Special Fee</td></tr>";
				foreach($query_result1 as $row)
				{
					$total =$total+$row['fee_amount'];
					echo "<tr><td>$i</td><td>";
					echo  date('d-m-Y', strtotime( $row['date_paid']));
					echo " </td><td>" . $row['receipt_number'];
					echo " </td><td>" . $row['student_name'];
					echo " </td><td>" . $row['class_name'];
					echo " - " . $row['section_name'];
					echo " </td><td>".get_admission_number($row['student_id'])."</td><td>" . $row['fee_head'];
					echo "</td><td align='center'>". number_format($row['fee_amount'],2) . "</td></tr>";
					$i=$i+1;
				}
			}
			
			if(count($query_result2)>0)
			{
				echo "<tr><td style='text-align:center;' colspan='8'>Transportation Fee</td></tr>";
				foreach($query_result2 as $row)
				{
					$total =$total+$row['amount_paid'];
					echo "<tr><td>$i</td><td>";
					echo  date('d-m-Y', strtotime( $row['date_paid']));
					echo " </td><td>" . $row['receipt_number'];
					echo " </td><td>" . $row['student_name'];
					echo " </td><td>" . $row['class_name'];
					echo " - " . $row['section_name'];
					echo " </td><td>".get_admission_number($row['student_id'])."</td><td> Bus Fee";
					echo "</td><td align='center'>". number_format($row['amount_paid'],2) . "</td></tr>";
					$i=$i+1;
				}
			}
			
           echo "<tr><td colspan='6'><td><b>Total Amount </b></td><td align='center'><b>". number_format( $total,2)."</B></td></tr>";
			}
			if(count($query_result)==0 && count($query_result1)==0 && count($query_result2)==0 && count($query_result3)==0)
			{
			?>
            <tr>
            	<td colspan="8" style="color:#FF0000"><center><b>No results found...</b></center></td>
            </tr>
            
            <?php
			}
			?>
            </tbody>
            </table>
            </div>
            <?php
			if(count($query_result)>0 || count($query_result1)>0 || count($query_result2)>0 || count($query_result3)>0)
			{
			?>
            <div style="text-align:center">
                <input type="submit" name="chk_excel" class="btn btn-info" value="Download Excel"> 
                <button type="submit" class="btn btn-info" formaction="<?php echo base_url();?>index.php/FeeManagement/fee_collection_detailed_report_pdf">Download PDF</button>
            </div>
            <?php
			}
			?>
                                    
 <?php echo form_close();?>
 											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

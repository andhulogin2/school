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
							Reprint Receipt 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Fee Collection Details
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/reprint_special_fee_receipt"><b><button class="btn-info">Back</button></b></a></div>
  
<?php echo form_open(base_url() . 'index.php/feeManagement/fee_collection_detailed_report_excel' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<input type="hidden" name="date_from" id="date_from" value="<?php echo $date_from; ?>" >
<input type="hidden" name="date_to" id="date_to" value="<?php echo $date_to; ?>" >
<input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>" >
<input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" >
<input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>" >
<?php
	$result	=	base64_encode(serialize($query_result));
?>
<input type="hidden" name="result" id="result" value="<?php echo $result; ?>" >

   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
			 echo "<h4>Fee Collection Details</h4>"; 
            echo "<h4>".date('d-m-Y', strtotime( $date_from ))." To " . date('d-m-Y', strtotime( $date_to)) ."</h4>"; 
		?>
            </td></tr>
   </table>
          
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            
            <thead><tr><th class='table-header'>SlNO</th><th class='table-header'>Date Paid</th>
            <th class='table-header'>Receipt Number</th><th class='table-header'>Name</th>
            <th class='table-header'>Class</th><th class='table-header'>Amount</th>
            <th class='table-header'>Print Receipt</th>
            <!--<th class='table-header'>Print</th>-->
            </tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			if(count($query_result)>0)
			{
			foreach($query_result as $row)
			{
			$total =$total+$row['fee_amount'];
            echo "<tr><td>$i</td><td>";
			echo  date('d-m-Y', strtotime( $row['date_paid']));
			echo " </td><td>" . $row['receipt_number'];
			echo " </td><td>" .$row['student_name'];
			echo " </td><td>" .$row['class_name'];
			echo " - " .$row['section_name'];
			echo " </td>" ;
			echo "<td align='center'>". number_format($row['fee_amount'],2) . "</td>";
			$student_id	=	$row['student_id'];//Here the admission number is actually student_id
			?>
           <td><a href="<?php echo base_url();?>index.php/FeeManagement/print_special_fee_receipt/<?php echo $student_id;?>/<?php echo $branch_id;?>/<?php echo $row['receipt_number'];?>/<?php echo date('d-m-Y', strtotime( $row['date_paid'])); ?>" target="_blank">Print</a></td></tr>
            </tbody>
            <?php
					$i=$i+1;
			
			}
           echo "<tr><td colspan='4'><td><b>Total Amount </b></td><td align='center'><b>". number_format( $total,2)."</B></td></tr>";
			}
			else
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
            <?php
			if(count($query_result)>0)
			{
			?>
            
            
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

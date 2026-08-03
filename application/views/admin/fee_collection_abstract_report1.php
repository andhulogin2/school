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
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
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
									 Abstract Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/fee_collection_detailed_report"><b> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    &nbsp;&nbsp;Back</b></a></div>
  
<?php echo form_open(base_url() . 'index.php/feeManagement/fee_collection_abstract_report_excel' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data','target'=>'_blank'));?>


<input type="hidden" name="date_from" id="date_from" value="<?php echo $date_from; ?>" >
<input type="hidden" name="date_to" id="date_to" value="<?php echo $date_to; ?>" >
<input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>" >
<input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" >
<input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>" >
<?php
	$result		=	base64_encode(serialize($query_result));
	$result1	=	base64_encode(serialize($query_result1));
	$result2	=	base64_encode(serialize($query_result2));
?>
<input type="hidden" name="result" id="result" value="<?php echo $result; ?>" >
<input type="hidden" name="result1" id="result1" value="<?php echo $result1; ?>" >
<input type="hidden" name="result2" id="result2" value="<?php echo $result2; ?>" >
<div id="print">
<div class="box-body" id="printableArea">
   <table border="0" align="center" style="padding-left:25px;padding-right:25px">
            <tr><td colspan="4" align="center">
			<?php
	
            echo "<h4>Report From ". date('d-m-Y',strtotime( $date_from ))." To " .  date('d-m-Y',strtotime( $date_to)) ."</h4>"; 
			if($department_id!='All')
			{
				if ($class_id!='ALL')
					echo  "<br> Class : " .  get_class_name( $class_id ) ;
				if ($section_id!='ALL')
				echo  " Batch : " . get_section_name( $section_id);
			}
			else
			{
				echo  "<br> Department : All";
			}
			 ?></td></tr>
   </table>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" >
            
            <thead><tr><th>SlNO</th><th>Date Paid</th><th>Receipt Number</th><th>Name</th><th>Admission Number</th><th>Class</th><th>Amount</th></tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			if(count($query_result)>0  || count($query_result1)>0 || count($query_result2)>0)
			{
			foreach($query_result as $row)
			{
			$total =$total+$row['fee_amount'];
            echo "<tr><td>$i</td><td>";
			echo  date_format(date_create($row['date_paid']),"d-m-Y");
			echo " </td><td>" . $row['receipt_number'];
			echo " </td><td>" . get_student_name($row['admission_number']);
			
			
			echo "</td><td>".get_admission_number($row['admission_number'])."</td>";
			echo " </td><td>" .get_student_class_name($row['admission_number']);
			echo " - " .get_student_section_name($row['admission_number'])."</td>";			
			echo "<td>". number_format($row['fee_amount'],2) . "</td></tr>";
					$i=$i+1;
			
			}
			if(count($query_result1)>0)
			{
				echo "<tr><td style='text-align:center;' colspan='7'>Special Fee</td></tr>";
				foreach($query_result1 as $row)
				{
					$total =$total+$row['fee_amount'];
					echo "<tr><td>$i</td><td>";
					echo  date('d-m-Y', strtotime( $row['date_paid']));
					echo " </td><td>" . $row['receipt_number'];
					echo " </td><td>" . $row['student_name'];
					
				
					echo "</td><td>".get_admission_number($row['student_id'])."</td>";
					echo " </td><td>" . $row['class_name'];
					echo " - " . $row['section_name']."</td>";
					echo "<td>". number_format($row['fee_amount'],2) . "</td></tr>";
					$i=$i+1;
				}
			}
			
			if(count($query_result2)>0)
			{
				echo "<tr><td style='text-align:center;' colspan='7'>Transportation Fee</td></tr>";
				foreach($query_result2 as $row)
				{
					$total =$total+$row['amount_paid'];
					echo "<tr><td>$i</td><td>";
					echo  date('d-m-Y', strtotime( $row['date_paid']));
					echo " </td><td>" . $row['receipt_number'];
					echo " </td><td>" . $row['student_name'];
					
				
					echo "</td><td>".get_admission_number($row['student_id'])."</td>";
					echo " </td><td>" . $row['class_name'];
					echo " - " . $row['section_name']."</td>";
					echo "<td>". number_format($row['amount_paid'],2) . "</td></tr>";
					$i=$i+1;
				}
			}

			if($department_id=='All')
			{
				echo "<tr><td></td><td></td><td colspan='4' align='right'>Total Amount </td><td>". number_format( $total,2)."</td></tr>";
			}
			else
			{
           		echo "<tr><td></td><td></td><td colspan='4' align='right'>Total Amount </td><td>". number_format( $total,2)."</td></tr>";
			}
			}
			if(count($query_result)==0 && count($query_result1)==0 && count($query_result2)==0)
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
    </div>
            <?php
			if(count($query_result)>0 || count($query_result1)>0)
			{
			?>
            <div style="text-align:center">
                <input type="submit" name="chk_excel" class="btn btn-info" value="Download Excel"> <br>
                <button class="btn btn-info" type="button" style="height:30px;text-align:center;padding-bottom:20px;margin:2px;"  onClick="printDiv('printableArea')">Print</button>
            </div>
            
            <?php
			}
			?>
					

 						
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
<script> 
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
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
									 Detailed Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/fee_collection_detailed_report"><b> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    &nbsp;&nbsp;Back</b></a></div>
  
  
   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
			 echo "<h4>Fee Collection Detailed Report</h4>"; 
            echo "<h4>".date('d-m-Y', strtotime( $date_from ))." To " . date('d-m-Y', strtotime( $date_to)) ."</h4>"; 
		?>
            </td></tr>
   </table>
          
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            
            <thead><tr><th class='table-header'>SlNO</th><th class='table-header'>Date Paid</th>
            <th class='table-header'>Receipt Number</th><th class='table-header'>Name</th>
            <th class='table-header'>Class</th><th class='table-header'>Fee Item</th><th class='table-header'>Amount</th></tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			foreach($query_result as $row)
			{
			$total =$total+$row['fee_amount'];
            echo "<tr><td>$i</td><td>";
			echo  date('d-m-Y', strtotime( $row['date_paid']));
			echo " </td><td>" . $row['receipt_number'];
			echo " </td><td>" .get_student_name($row['admission_number']);
			echo " </td><td>" .get_student_class_name($row['admission_number']);
			echo " - " .get_student_section_name($row['admission_number']);
			echo " </td><td>" . $row['fee_head'];
			echo "</td><td align='center'>". number_format($row['fee_amount'],2) . "</td></tr>";
					$i=$i+1;
			
			}
           echo "<tr><td colspan='5'><td><b>Total Amount </b></td><td align='center'><b>". number_format( $total,2)."</B></td></tr>";

			?>
            
            </tbody>
            </table>
                                    
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

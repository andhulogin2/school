<?php include_once APPPATH . 'views/head.php';?>
 

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
  
  

  
   <table border="0" align="center" style="padding-left:25px;padding-right:25px">
            <tr><td colspan="4" align="center">
			<?php
	
            echo "<h4>Report From ". date('d-m-Y',strtotime( $date_from ))." To " .  date('d-m-Y',strtotime( $date_to)) ."</h4>"; 
			if ($class_id!='ALL')
            	echo  "<br> Class : " .  get_class_name( $class_id ) ;
			if ($section_id!='ALL')
            echo  " Batch : " . get_section_name( $section_id);
			 ?></td></tr>
   </table>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" >
            
            <thead><tr><th>SlNO</th><th>Date Paid</th><th>Receipt Number</th><th>Name</th><th>Amount</th></tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			foreach($query_result as $row)
			{
			$total =$total+$row['fee_amount'];
            echo "<tr><td>$i</td><td>";
			echo  date_format(date_create($row['date_paid']),"d-m-Y");
			echo " </td><td>" . $row['receipt_number'];
			echo " </td><td>" . get_student_name($row['admission_number']);
			echo "</td><td>". number_format($row['fee_amount'],2) . "</td></tr>";
					$i=$i+1;
			
			}
           echo "<tr><td></td><td></td><td colspan='2' align='right'>Total Amount </td><td>". number_format( $total,2)."</td></tr>";

			?>
            
            </tbody>
            </table>
                                    

					<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/fee_collection_detailed_report">Previous</a></div>

 						
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

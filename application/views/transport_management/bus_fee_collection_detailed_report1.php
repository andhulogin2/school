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
							<li class="active">Bus Fee Collection Report</li>
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
<div align="right"><a href="<?php echo base_url();?>index.php/Transport_management/fee_collection_detailed_report"><b> <button class="btn-info">Back</button></b></a></div>
  
  
   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
			 echo "<h4>Fee Collection Detailed Report</h4>"; 
            echo "<h4>".date('d-m-Y', strtotime( $date_from ))." To " . date('d-m-Y', strtotime( $date_to)) ."</h4>"; 
		?>
            </td></tr>
   </table>
   <?php
   	echo form_open('Transport_management/fee_collection_detailed_report_excel');
		if(count($result)>0)
		{
		?>
		<input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>" >
		<input type="hidden" name="department_id" value="<?php echo $department_id; ?>" >
		<input type="hidden" name="class_id" value="<?php echo $class_id; ?>" >
		<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" >
		<input type="hidden" name="date_from" value="<?php echo $date_from; ?>" >
		<input type="hidden" name="date_to" value="<?php echo $date_to; ?>" >
		<input type="hidden" name="fee_item" value="<?php echo $fee_item; ?>" >
        <button style="float:right" type="submit" class="btn-info">Download</button>
        <?php 	
		}	
	echo form_close();
   ?>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            
            <thead><tr>
            <th class='table-header'>SlNO</th>
            <th class='table-header'>Date Paid</th>
            <th class='table-header'>Receipt Number</th>
            <th class='table-header'>Name</th>
            <th class='table-header'>Class</th>
            <th class='table-header'>Fee Item</th>
            <th class='table-header'>Amount Paid</th>
            </tr></thead>
            <tbody>
            <?php
			$total=0;
			$total_amount=0;
			$fee_balance=0;
			$i=1;
			if(count($result)>0)
			{
			foreach($result as $row)
			{
			
            echo "<tr><td>$i</td><td>";
			echo  date('d-m-Y', strtotime( $row['date_paid']));
			echo " </td><td>" . $row['receipt_number'];
			echo " </td><td>"  . $row['student_name'];
			echo " </td><td>" . $row['class_name']."-".$row['section_name'];;
			echo " </td><td>" . $fee_item;
			echo "</td>";
			$total_amount=$total_amount+$row['total_amount'];
			if($fee_item=='Bus_Fee')
			{
			echo "<td align='center'>". number_format($row['amount_paid'],2) . "</td>";
					$i=$i+1;
					$total =$total+$row['amount_paid'];
					}
			  else 
			  {
			  echo "<td align='center'>". number_format($row['late_fee'],2) . "</td>";
					$i=$i+1;
					$total =$total+$row['late_fee'];
			  }
            if($this->session->userdata('role')<=3) { 
           } 
			  
				echo "</tr>";
			}
			
           echo "<tr><td colspan='5'><td><b>Total Amount </b></td><td align='center'><b>". number_format( $total,2)."</B></td></tr>";
			}
			else
			{
				echo "<tr><td colspan='9' style='text-align:center;color:red;'>No Records Found...</td></tr>";	
			}
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

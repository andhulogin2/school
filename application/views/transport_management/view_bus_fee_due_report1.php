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
							<li class="active">Bus Fee Due Report</li>
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
								Report 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Bus Fee Due Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

   
					<div align="right"><a href="<?php echo base_url();?>index.php/Transport_management/view_bus_fee_due_report"><b> <button class="btn-info">Back</button></b></a></div>
<br/>         
<label style="font-size:16px"><b>Class&nbsp;&nbsp;&nbsp;&nbsp; : 
	<?php
		if($class_id=='all')
		{
			echo "All";
		} 
		else
		{
			echo get_class_name($class_id);
		}
	?>
    </b></label>	<br>	
<label style="font-size:16px"><b>Section : 
	<?php
		if($section_id=='all')
		{
			echo "All";
		} 
		else
		{
			echo get_section_name($section_id);
		}
	?>
</b></label>	

   <?php
   	echo form_open('Transport_management/bus_fee_due_report_excel');
		if(count($result)>0)
		{
		?>
		<input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>" >
		<input type="hidden" name="class_id" value="<?php echo $class_id; ?>" >
		<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" >
		<input type="hidden" name="due_date" value="<?php echo $due_date; ?>" >
        <button style="float:right" type="submit" class="btn-info">Download</button>
        <?php 	
		}	
	echo form_close();
   ?>
	
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
          <thead>
            <tr>
            	<th class='table-header'>SlNO</th>
                <th class='table-header'>Due Date</th>
            	<th class='table-header'>Student</th>
                <th class='table-header'>Class</th>
                <th class='table-header'>Amount</th>
              
            </tr>
          </thead>
          <tbody>
            
            
            <?php
			$total=0;
			$i=1;
			if (count($result)==0)
			{
			echo "<tr><td colspan='5' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			}
			foreach($result as $row)
			{
		
            echo "<tr><td>$i</td><td>";
			echo  date('d-m-Y',strtotime($row['due_date']));
			echo "</td>	<td>". $row['name']. " </td>";
			echo "<td>". get_student_class_name($row['student_id']). "-".get_student_section_name($row['student_id'])." </td>";
			echo "<td align='right'>". number_format( $row['fee_balance'],2). "</td></tr>";
					$i=$i+1;
					 $total= $total+ $row['fee_balance'];
			
			}
			echo "<tr><td></td><td></td><td></td><td><b>Total Amount</b> </td><td align='right'><b>" . number_format( $total,2). "</b></td></tr>";

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

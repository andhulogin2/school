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
							<li class="active">Bus Fee Report</li>
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
									Pickup-Point Wise Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

   
					<div align="right"><a href="<?php echo base_url();?>index.php/Transport_management/bus_fee_pickup_point_wise"><b><button class="btn-info">Back</button></b></a> &nbsp;<a href="<?php echo base_url();?>index.php/Transport_management/bus_fee_pickup_wise_excel"><button class="btn-info">Download Excel</button></a></div>
<br/>
<label><b>Route Name :<?php echo $route_master_name; ?></b></label><br>
<label><b>PickUp Point :<?php echo $pickup_point; ?></b></label>

<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            <thead>
            	<tr>
                	<th class='table-header'>Sl.No</th>
                    <th class='table-header'>Student Id</th>
                     <th class='table-header'>Student</th>
                    <th class='table-header'>Class</th>
                    <th class='table-header'>Section</th>
            		<th class='table-header'>Bus Route</th>
                </tr>
            </thead>
			<tbody>
            
            
            <?php
			$total=0;
			$i=1;
			if (count($result)==0)
			{
			echo "<tr><td colspan='6' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			}
			foreach($result as $row)
			{
			?>
            <tr>
            	<td><?php echo $i; ?></td>
                <td><?php echo $row['student_id']; ?></td>
            	<td><?php echo $row['name']; ?></td>
            	<td><?php echo $row['class_name']; ?></td>
            	<td><?php echo $row['section_name']; ?></td>
            	<td><?php echo $row['route_master_name']; ?></td>
            </tr>
			<?php
			$i=$i+1;
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

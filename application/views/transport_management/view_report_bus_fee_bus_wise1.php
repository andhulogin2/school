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
									Bus Wise Report
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

   
					<div align="right"><a href="<?php echo base_url();?>index.php/Transport_management/bus_fee_bus_wise"><b><button class="btn-info">Back</button></b></a> &nbsp;<a href="<?php echo base_url();?>index.php/Transport_management/bus_fee_bus_wise_excel/<?php echo $route_register_id; ?>"><button class="btn-info">Download Excel</button></a></div>
<br/>         
<label><b>Bus Number : <?php echo $bus_number; ?></b></label>		<br>
<label><b>Route Name : <?php echo $route_master_name; ?></b></label>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
            <thead>
            	<tr>
                	<th class='table-header'>Sl.No</th>
                    <th class='table-header'>Student</th>
                    <th class='table-header'>Class</th>
                    <th class='table-header'>Section</th>
            		<th class='table-header'>Bus Route</th>
                    <th class='table-header'>Pickup Point</th>
                </tr>
            </thead>
			<tbody>
            
            
            <?php
			$total=0;
			$i=1;
			if (count($result)==0)
			{
			echo "<tr><td colspan='6' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			
			}
			foreach($result as $row)
			{
			?>
            <tr>
            	<td><?php echo $i; ?></td>
            	<td><?php echo $row['name']; ?></td>
            	<td><?php echo $row['class_name']; ?></td>
            	<td><?php echo $row['section_name']; ?></td>
            	<td><?php echo $row['route_master_name']; ?></td>
            	<td><?php echo $row['pickup_point']; ?></td>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  



<script type="text/javascript">
$(function() {
	$('#simple-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[50, 100, 200, -1], [50, 100, 200,'All']],
        "iDisplayLength": 50
	});
});
</script>       

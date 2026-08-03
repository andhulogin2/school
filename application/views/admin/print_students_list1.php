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
							<li class="active">Students List</li>
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
								Print
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Students List
								</small>
							</h1>
						</div><!-- /.page-header -->
                     
                                       
					<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/print_students_list/'; ?>"><b><button class="btn-info"><i class="fa fa-angle-double-left" aria-hidden="true" style="font-size:17px"></i> Back</button></b></a> &nbsp;
                    <a href="<?php echo base_url();?>index.php/Admin/download_student_pdf/<?php echo base64_encode(serialize($class_id)); ?>/<?php echo $section_id; ?>" title="Download PDF"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i> PDF</button></a> &nbsp;
                    <a href="<?php echo base_url();?>index.php/Admin/download_student_excel/<?php echo base64_encode(serialize($class_id)); ?>/<?php echo $section_id; ?>" title="Download Excel"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i> Excel</button></a></div><br>
   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
			if(count($class_id)==1 && $section_id!='ALL')
			{
				echo "<br> Class : ".get_class_name($class_id[0]);
				echo  " Batch :" . get_section_name($section_id); 
			}	
			?></td></tr>
   </table>
                  

    
      <div style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead>
            	<tr>
                	<th class="table-header">SlNO</th>
                    <th class="table-header">Admission Number</th>
                    <th class="table-header">Name</th>
                    <th class="table-header">Date of Birth</th>
                    <th class="table-header">Father's Name</th>
                    <th class="table-header">Mother's Name</th>
                    <th class="table-header">Class</th>
                    <th class="table-header">Phone</th>
                </tr>
            </thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			if(count($query_result)>0)
			{
			foreach($query_result as $row)
			{
		    echo "<tr><td>$i";
			echo " </td><td>" .$row['admission_number'] ;
			echo " </td><td>".get_student_name($row['student_id'])."</td>";
			echo "<td>".$row['birthday']."</td>";
			echo "<td>".$row['parent']."</td>";
			echo "<td>".$row['mother_name']."</td>";
			echo "<td>".get_student_class_name($row['student_id'])."/".get_student_section_name($row['student_id'])."</td>";
			echo "<td>" . get_student_phone($row['student_id']);
			echo "</td></tr>";
					$i=$i+1;
			
			}
        	}
			else
			{
				echo "<tr><td colspan='3' style='text-align:center;color:red'><b>No results found</b></td></tr>";
			}
			?>
            
            </tbody>
            </table>
            
      </div>      
                    
                    <?php echo form_open(base_url() . 'index.php/feeManagement/print_students_list2/'.$class_id.'/'.$section_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
    <?php
	if(count($query_result)>0)
	{
	?>
       	<!--<input type="checkbox" id="chk_excel" name="chk_excel" checked /> Save As Excel &nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-info"><?php echo 'Show'; ?></button>-->
    <?php
	}
	?>
    </div>
</div>
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
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       
            
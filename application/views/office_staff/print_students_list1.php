<?php include_once APPPATH . 'views/office_staff_head.php';?>
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
						<!-- /.nav-search -->

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
                     
                                       
 <div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/office_staff/print_students_list/'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div> 
   <table border="0" align="center">
            <tr><td colspan="4" align="center">
			<?php
            echo  "<br> Class " . get_class_name( $class_id ) ;
            echo  " Batch :" . get_section_name($section_id); ?></td></tr>
   </table>
                  

    
      <div style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead><tr><th class="table-header">SlNO</th><th class="table-header">Name</th><th class="table-header">Phone</th></tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			foreach($query_result as $row)
			{
		    echo "<tr><td>$i";
			echo " </td><td>" . get_student_name($row['student_id']);
			echo " </td><td>" . get_student_phone($row['student_id']);
			echo "</td></tr>";
					$i=$i+1;
			
			}
        
			?>
            
            </tbody>
            </table>
            
      </div>      
                    
												
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
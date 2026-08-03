<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">Late Students</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								View
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Late students
								
							</h1>
						</div> 
                         <?php echo form_open('Admin/view_class', array('class' => 'form-horizontal'));?>
                                     <?php echo form_close(); ?>
                                    
                                       
                          
             <div style="text-align:right"><a href="<?php echo base_url(); ?>index.php/Admin/index">Back</a></div>            
                      
                
            <div class="table-responsive">
           	<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.</center></th>
														<th class="table-header"><center>Student</center></th>
														<th class="table-header"><center>Admission number</center></th>
														<th class="table-header"><center>Class</center></th>
														<th class="table-header"><center>Late time</center></th>
                                                        <?php 
														if($role==1 || $role==2)
														{
														?>
                                                        <th class="table-header"><center>Branch</center></th>
                                                        <th class="table-header"><center>Department</center></th>
                                                        <?php
														}
														if($role==3)
														{
														?>
                                                        <th class="table-header"><center>Department</center></th>
                                                        <?php
														}
														?>
												
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;
												 if(count($students)>0)
												 {
												  foreach($students as $row):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $row['student_name'];?></center></td>
														<td><center><?php echo $row['admission_number'];?></center></td>
                                                     	<td style="text-align: center;"><?php echo $row['class_name'].'-'.$row['section_name']; ?>
                                                     	<td style="text-align: center;"><?php echo $row['late_time']; ?>
														 <?php
				  if($role==1 || $role==2)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $row['branch_name']; ?>
                  </td>
                  <td style="text-align: center;"><?php echo $row['dept_name']; ?>
                  </td>
                  <?php
				  }
				  if($role==3)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $row['dept_name']; ?>
                  </td>
                  <?php
				  }
				  ?>
														
														
													</tr>

												<?php endforeach;
												}
												else
												{
												?>
												<tr>
                                                	<td colspan="7" style="color:#FF0000;text-align:center">No records found!</td>
                                                </tr>
                                                <?php
												}
												?>	
												</tbody>
            </table>
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>


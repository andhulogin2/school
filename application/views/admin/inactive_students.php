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
							<li class="active"> In Active Students</li>
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
								Students
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Inactive Students
								
							</h1>
						</div>  
                              <br> 
                         
            <div class="table-responsive">
			   <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
					<thead>
						<tr>
							<th class="table-header">Sl No.</th>
							<th class="table-header">Student</th>
							<th class="table-header">Class</th>
							 <th class="table-header">Section</th>
							 <th class="table-header">Phone</th>
							<th class="table-header" colspan="2"><center>Action</center></th>
						</tr>
					</thead>
             
             <tbody>
            <?php $count =1;foreach($deleted_students as $row1){?>
			<tr>
				<td style="text-align: center;"><?php echo $count++;?></td>
				<td style="text-align: center;"><?php echo $row1['student'];?></td>
				<td style="text-align: center;"><?php echo $row1['class'];?></td>
				<td style="text-align: center;"><?php echo $row1['section'];?></td>
				<td style="text-align: center;"><?php echo $row1['phone1'];?></td>
				<td><a href="<?php echo base_url(); ?>index.php/Admin/student_portal/<?php echo $row1['student_id']; ?>" class="tooltip-success" data-rel="tooltip" title="View Profile" ><span class="blue"><i class="ace-icon fa fa-user bigger-120"></i></span></a></td>
				<td><?php echo anchor('Admin/restore_inactive_students/'.$row1['student_id'], 'Restore');?></td>
			</tr>
			<?php } ?>
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


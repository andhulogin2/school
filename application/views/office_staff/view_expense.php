<?php include_once APPPATH . 'views/office_staff_head.php';?>
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
							<li class="active"> Category1</li>
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
									 Category
								
							</h1>
						</div> 
                       
                        
                                    
                                       
                          
                        
                              <br> 
                               
                         
            <div class="table-responsive">
  









<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Category</th>
                                                        <th class="table-header">Amount</th>
                                                         <th class="table-header">Give to</th>
                                                          <th class="table-header">created By</th>
                                                           <th class="table-header">created At</th>
                                                           
                                                        <th class="table-header">Remark</th>
												
													
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;
												  $this->db->where('a.branch_id',$this->session->userdata('branch_id'));
												  $this->db->where('a.dept_id',$this->session->userdata('dept_id'));
												  $this->db->where('a.is_deleted','N');
												  $this->db->join('tbl_expence_category e','e.category_id=a.category_id','LEFT');
 $this->db->join('staff s','s.user_id=a.created_by','LEFT');
												 $category=$this->db->get('tbl_add_expense a')->result_array();
$total=0;
												  foreach($category as $row):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $row['category_name'];?></center></td>
                                                        <td><center><?php echo $row['amount'];?></center></td>
                                                          <td><center><?php echo $row['give_to'];?></center></td>
                                                         <td><center><?php echo $row['name'];?></center></td>
                                                         <td><center><?php echo $row['created_date'];?></center></td>
                                                          <td><center><?php echo $row['remark'];?></center></td>
														
														
														
														
													</tr>

												<?php 
												$total=$total+$row['amount'];
												endforeach;?>	
                                                <tr><th colspan="2">Total</th>
                                                <td align="center"><?php echo $total;?></td></tr>
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


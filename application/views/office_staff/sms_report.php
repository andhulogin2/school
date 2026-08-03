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
							<li class="active">SMS Report</li>
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
								SMS Report
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div>  
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"  width="10%"><center>Sl No.</center></th>
                                                        	<th class="table-header"  width="10%"><center>Count</center></th>
														
                                                        <th class="table-header" width="10%"><center>Send by</center></th>
														<th class="hidden-480 table-header"><center>Message</center></th>

												
														<th class="hidden-480 table-header" width="10%"><center>Option</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php 
												  $this->db->select('count(sms_master_id) as sms, send_by,name,content,send_date,sms_master_id');
												  	$this->db->group_by('sms_master_id');
													$this->db->order_by('details_id','DESC');
												   
												  $query=$this->db->get('view_sms_details')->result_array();
												  
												  
												  $count = 1;foreach($query as $row){?>
											
                                                  
													<tr>
														

														<td><center>
															<?php echo $count++;?></center>
														</td>
													
														
														<td><center>
															<?php echo $row['sms'];?></center>
														</td>
														<td><center><?php echo $row['name'];?></center></td>
														<td><center><?php echo $row['content'];?></center></td>
														<td>

															 <?php //echo anchor('http://bulksms.login2itsolutions.com/getdelivery/schooldemo2017/school@123/242118546',View); ?>
                                                       <?php //echo anchor('Admin/sms_deatail_report/' .$row['sms_master_id'], 'View'); ?>
                                                       <?php echo anchor('Admin/sms_deatail_report1/' .$row['sms_master_id'], 'Delivery Report'); ?>
                                                        </td>
                                                       
															
																

															
                

																	
																

				
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

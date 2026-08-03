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
							<li class="active">SMS Que Report</li>
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
								SMS Que Report
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div>  
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"  width="10%">Sl No.</th>
                                                        	<th class="table-header"  width="10%">Count</th>
														
                                                        <th class="table-header" width="10%">Send by</th>
														<th class="hidden-480 table-header">Message</th>

												
														<th class="hidden-480 table-header" width="10%">Option</th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php 
												 $this->db->select('count(sms_master_id) as sms, send_by,name,content,send_date,sms_master_id,processed');
												  	$this->db->group_by('sms_master_id');
												   
												  $query=$this->db->get('view_sms_details')->result_array();
												  
												 
												  
												  
												  $count = 1;foreach($query as $row){
												  if($row['processed']==0){?>
											
                                                  
													<tr>
														

														<td>
															<?php echo $count++;?>
														</td>
													
														
														<td>
															<?php //echo $row['details'];?>
														</td>
														<td><?php echo $row['name'];?></td>
														<td><?php echo $row['content'];?></td>
														<td>

															 <?php //echo anchor('http://bulksms.login2itsolutions.com/getdelivery/schooldemo2017/school@123/242118546',View); ?>
                                                       <?php //echo anchor('Admin/sms_deatail_report/' .$row['sms_master_id'], 'View'); ?>
                                                       <?php echo anchor('Admin/sms_que_deatail_report/' .$row['sms_master_id'], 'View'); ?>
                                                        </td>
                                                       
															
																

															
                

																	
																

				
													</tr>
                                              
												<?php }} ?>	
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

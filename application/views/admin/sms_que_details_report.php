<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
<?php $running_year = get_running_year();?>
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
						</div>
                         </div><!-- /.nav-search -->
                         
                           <div align="right" style="padding-right:20px; padding-top:10px;"> 
                                
                              <a href="<?php echo base_url();?>index.php/admin/sms_que_report" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
                        <div style="padding-left:1050px; padding-top:10px;">
                              <?php         echo form_open_multipart('Admin/resend_all/'.$master_id, array('class' => 'form-horizontal','id'=>"myform"));?>
       
                        <input type="submit"  type="button" value='Resend All'> 
											
										
                                          <?php echo form_close(); ?>
                                         

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
														
														<th class="table-header"  width="10%"><center>Sl No.</center></th>
                                                        <th class="table-header"  width="10%"><center>Date and Time</center></th>
                                                        	<th class="table-header"  width="10%"><center>Student</center></th>
														
                                                        <th class="table-header" width="10%"><center>Class/Section</center></th>
														<th class="hidden-480 table-header"><center>Phone</center></th>
                                                        <th class="hidden-480 table-header"><center>Message</center></th>

												
														<th class="hidden-480 table-header" width="10%"><center>Status</center></th>
                                                        <th class="hidden-480 table-header" width="10%"><center>Resend</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php 
												  $this->db->select('s.name as student,c.name as class,a.name as section,d.msg_content,d.phone,d.processed,d.status,d.details_id,d.send_date');
												 $this->db->join('student s','s.student_id=d.student_id','LEFT');
												  $this->db->join('class c','c.class_id=d.class_id','LEFT');
												   $this->db->join('section  a','a.section_id=d.section_id','LEFT');
												  $this->db->where('sms_master_id',$master_id);
												  $this->db->where('processed',0);
												  $query=$this->db->get('tbl_sms_delivery_details d')->result_array();
												  
												  
												  $count = 1;foreach($query as $row){?>
											
                                                  
													<tr>
														

														<td><center>
															<?php echo $count++;?>
                                                            </center>
														</td>
													<td><center>
															<?php echo date('d-m-Y H:i A',strtotime($row['send_date']));?></center>
														</td>
														
														<td><center>
															<?php echo $row['student']?></center>
														</td>
														<td><center><?php echo $row['class'] .'/'.$row['section'];?></center></td>
														
                                                        <td><?php echo $row['phone'];?></td>
                                                           <td><?php echo $row['msg_content'];?></td>
														<td>
                                                        <?php 
														echo $row['status'];?>
														</td>
                                                        <td>
                                                        <?php 
														if($row['status']!='Delivered')
														{
													 echo anchor('Admin/resend_sms/' .$row['details_id'], 'Resend');
													 }
													  ?>
													 
                                                       
                                                        </td>
                                                       
															
																

															
                

																	
																

				
													</tr>
                                            
												<?php   } ?>	
												</tbody>
            </table>
            <div style="padding-left:450px;">
            
              <a href="<?php echo base_url();?>index.php/admin/delete_sms_pop_up1/<?php echo $master_id;?>" class="btn btn-danger waves-effect waves-light m-r-10" onClick="return confirm('Are-you-sure');">Delete</a>
       
        <?php 
		
                 
				 echo form_close(); ?>
        </div>
               
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
 
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
							<li class="active">View Subjects</li>
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
								Subjects
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div> 
				 <?php 
				 $class='';
				$q= $this->db->get_where('class',array('class_id'=>$class_id))->result_array();
				foreach($q as $p){
				$class = $p['name'];}
				?>
                  
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                           <div>
                            <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/office_staff/new_subject_add/'.$class_id.'/'.$branch_id.'/'.$dept_id; ?>">Add Subject</a></div> 
<br>
                                    <div class="table-responsive">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="table-header"><center>Sl.No.</center></th>
														<th class="table-header"><center>Class</center></th>	
														<th class="table-header"><center>Subjects</center></th>
                                                        <th class="table-header"><center>Teacher</center></th>
                                                     
													</tr>
												</thead>
												<tbody>
                                                
                                                 <?php $count = 1;foreach($subjects as $row):?>
													<tr>
														
                                                   
														<td align="center">
															<?php echo $count++;?>
														</td>
                                                       
														<td align="center">
															<?php echo $class;?>
														</td>
                                                                      <td style="text-align: center;"><?php echo $row['name'];?></td>
                                            <td style="text-align: center;"><?php 
		                                    $teacher=$this->db->get_where('staff',array('staff_id'=>$row['teacher_id']));
											if($teacher->num_rows() > 0) 
											{
		 ?>
		 <?php 
													 
													   echo $teacher->row()->name;
													   ?></a>
		                                            
                                                     <?php
                                                    }
													  else
													  echo "---"?></td>
													</tr>

												<?php endforeach;?>	
												</tbody>
											</table>
                                           </div></div></div></div></div>
                                    <?php echo form_close(); ?>
                       
			<?php include_once APPPATH . 'views/footer.php'; ?>

 <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>

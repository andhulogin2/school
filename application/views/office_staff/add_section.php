<?php include_once APPPATH . 'views/main_head.php';

?>
         
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
							<li class="active">New Class</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<?php /*?><?php echo form_open(base_url() . 'index.php/admin/search' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
				<?php form_close(); ?><?php */?>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Section
								
							</h1>
						</div><!-- /.page-header -->
                       
                    
                    
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
            
            
            <div class="row">
            
            			<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/Admin/view_section_add/'.$class_id; ?>">Add Section</a></div> 							
   
									<div class="col-sm-12 widget-container-col">
										<div class="widget-box">
											<div class="widget-header widget-header-small">
												<h5 class="widget-title smaller"><font color="#FFFFFF">Classes</font></h5>

												<!-- #section:custom/widget-box.tabbed -->
												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab">
														<li class="active">
<?php 
				$role=$this->session->userdata('role');
				if($role==1 ||$role==2)
				{
				$classes = $this->db->get('class')->result_array();
				}
				if($role==3)
				{
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$classes = $this->db->get('class')->result_array();
				}
				if($role==4)
				{
				$this->db->where('dept_id',$this->session->userdata('dept_id'));
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$classes = $this->db->get('class')->result_array();
				}
				foreach ($classes as $row):
			?><li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php/admin/section/<?php echo $row['class_id'];?>">
						
				<font color="#FFFFFF"><?php echo $row['name'];
				?></font>
					</a>
				</li>
			<?php endforeach;?>						</li>

													</ul>
												</div>

												<!-- /section:custom/widget-box.tabbed -->
											</div>

											
										</div>
									</div></div>


		
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
														<th bgcolor="#307ecc"><font color="#FFFFFF"><center>Sl.No.</center></font></th>
                                                        <th bgcolor="#307ecc"><font color="#FFFFFF"><center>Class</center></font></th>
														<th bgcolor="#307ecc"><font color="#FFFFFF"><center>Section</center></font></th>
														<th bgcolor="#307ecc"><font color="#FFFFFF"><center>Teacher</center></font></th>

														<th bgcolor="#307ecc"  colspan="2"><font color="#FFFFFF"><center>Actions</center></font></th>
													</tr>
												</thead>

												<tbody>
                                                  <?php $count = 1;
												  $q=$this->db->get_where('section',array('class_id'=>$class_id))->result_array();
												  foreach($q as $data):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
                                                        <td><center>
															<?php echo get_class_name($class_id); ?> 
														</center></td>
														<td><center><?php echo $data['name'];?></center></td>
                                                        <?php $w=$this->db->get_where('staff',array('staff_id'=>$data['teacher_id'],'role'=>'6'))->row()->name;?>
														<td><center><?php echo $w;?></center></td>

														
														
														<td style="text-align: center;">
															
																

																<?php
                echo anchor('Admin/section_edit/' .$class_id.'/'.$data['section_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');
                ?></td><td style="width:200px;">
                <?php 
								$this->db->where('class_id',$data['class_id']);
								$this->db->where('section_id',$data['section_id']);
								$a=$this->db->get('enroll');
							
								if($a->num_rows() >0)
								{
								echo "can not delete value exist";
								}
								else{?>								
											
					<a href="<?php echo base_url();?>index.php/admin/section_delete/<?php echo $data['section_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>												
							<?php }?>									

														
															</div>

															
																</center>
                                                            </td>
														</tr>
                                                
											

          
           <input type="hidden" name="class" value="<?php echo $class_id;?>">
									
<?php endforeach;?>
</tbody></table>	
			</div></div></div>		
												
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>

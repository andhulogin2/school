<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">New Subject</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Subject
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                                
                              <a href="<?php echo base_url();?>index.php/admin/view_subject/<?php echo $class_id.'/'.$branch_id.'/'.$dept_id?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                     <?php echo form_open('Admin/add_subject/'.$class_id.'/'.$branch_id.'/'.$dept_id, array('class' => 'form-horizontal'));
					 ?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Subject :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Subject Name" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>
   
										<div class="col-sm-9">
											<select name="class_id" class="col-xs-10 col-sm-5" data-validate="required" disabled>
                                           <?php $w=$this->db->get_where('class',array('class_id'=>$class_id))->row()->name;?> 
                              <option value=""><?php echo $w;?></option>
                          </select>
										</div>
									</div>
                                    
                                    
                             <div class="row">
                             	<div class="col-md-3"></div>
                             	<div class="col-md-4">
                                	<table  class="table table-striped table-bordered table-hover">
                                    	<tr>
                                        	<th>Section</th>
                                            <th>Teacher</th>
                                        </tr>
                                        <?php
										foreach($section as $row):
										?>
                                        <tr>
                                        	<td><?php echo $row['name']; ?><input type="hidden" name="section_id[]" value="<?php echo $row['section_id']; ?>" ></td>
                                        	<td>
                                                <select name="teacher_id[]" class="col-md-12" data-validate="required">
                                                    <option value="">Select</option>
                                                    <?php 
                                                    $this->db->where('staff.role',6);
                                                    $this->db->where('branch_id',$branch_id);
                                                    $this->db->where('dept_id',$dept_id);
                                                    $teachers = $this->db->get('staff')->result_array();
                                                    foreach($teachers as $row){
														?>
														<option value="<?php echo $row['staff_id'];?>">
														<?php echo $row['name'];?>
														</option>
														<?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php
										endforeach;
										?>
                                    </table>
                                </div>
                             	<div class="col-md-5"></div>
                             </div>
                             
                             
                             
                              
									
									

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    

												
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>
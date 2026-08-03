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
							<li class="active">Edit Section</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
                       
							<form class="form-search">
							
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Edit Section
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/admin/section/<?php echo $class_id;?>"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
				 
                     
                     <?php echo form_open('Admin/update_section', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
                                     
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section Name :<font color="#FF0000">* </font></label>
                                     <?php $p=$this->db->get_where('section',array('section_id'=>$section_id))->result_array();
									 foreach($p as $row){?>
										<div class="col-sm-9">
											<input type="text" id="name" value="<?php echo $row['name'];?>" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>
  											<input type="hidden" id="section" value="<?php echo $row['section_id'];?>" class="col-xs-10 col-sm-5" name="section" />

                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="class_id" class="select2" data-validate="required">
                                               <?php  $role=$this->session->userdata('role');
											   
				$yr=get_running_year();
				if($role==3)
				{
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				}
				if($role==4 || $role==12)
				{
				$this->db->where('dept_id',$this->session->userdata('dept_id'));
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				}
				$this->db->where('academic_year',$yr);
				$classes = $this->db->get('class')->result_array();
								foreach($classes as $row1){ 
								if($class_id==$row1['class_id'])
								{
								?>
                            		<option value="<?php echo $row1['class_id'];?>" selected="selected">
									<?php echo $row1['name'];?>
                                    </option>
                                <?php
								}
								else
								{
								?>
                            		<option value="<?php echo $row1['class_id'];?>">
									<?php echo $row1['name'];?>
                                    </option>
                                <?php
								}
								
								}
							  ?>
                                            
                          </select>
										</div>
									</div>
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Teacher :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="teacher_id" class="select2" data-validate="required">
                                            <?php
                                            if($role==3)
				{
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				}
				if($role==4 || $role==12)
				{
				$this->db->where('dept_id',$this->session->userdata('dept_id'));
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				}
									$this->db->where('staff.role',6);
									$teachers = $this->db->get('staff')->result_array();
									?>
									<option value="">
												select
                                                </option>
									<?php foreach($teachers as $row2){
									if($row['teacher_id']==$row2['staff_id'])
									{
										?>
                                		<option value="<?php echo $row2['staff_id'];?>">
												<?php echo $row2['name'];?>
                                                </option>
                                    <?php
									}
									else
									{
									?>
                                		<option value="<?php echo $row2['staff_id'];?>">
												<?php echo $row2['name'];?>
                                                </option>
                                    <?php
									}
									}
								?>
                                          
                          </select>
										</div>
									</div>
									

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php
									}
									?>
                                   
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

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              

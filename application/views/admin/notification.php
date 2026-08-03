<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 
$running_year=get_running_year();?>
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
							<li class="active">Notification</li>
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
								Notification
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								
							</h1>
						</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><font color="#FFFFFF">Send Notifications</font>
            </div>
            <br>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/news/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                
                <?php $role=$this->session->userdata('role');?>
					
                                    
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title<font color="#FF0000">* </font></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="Required" value="" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"></textarea>
                    </div>
                </div>
                
                
                <?php 
                
                if($role==1 || $role==2)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Branch<font color="#FF0000">*</font></label>
						<div >
							<select name="branch" class="select2" required=""  onChange="return get_dept(this.value)" id="branch">
                              <option value="0">Select</option>
                             
                              <?php 
							   $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    <div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                              <option value="0">Select</option>
                             
                            
                          </select>
                         
                       
						</div> 
					</div>
                    </div>
                    
                     <div class="col-md-6">
                    <div class="form-group" >
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
			<select name="class" class="select2"  required=""    onChange="return get_class_sections(this.value);" id="class" >
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div> <?php } 
    if($role==3)
{?>
<div class="col-md-6">
    <div class="form-group">
						<label for="field-2" class="control-label">Department<font color="#FF0000">*</font></label>
						<div >
							<select name="department" class="select2" required="" onChange="return get_class_dept(this.value)" id="department">
                               <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
                         
                       
						</div> 
					</div>
                   
                    <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
					<select name="class" class="select2" required="" onChange="return get_class_sections(this.value)" id="class" >
                              <option value="0">Select</option>
                             
                             
                          </select>
                         
                       
						</div> 
					</div>
    </div>
                    <?php }?>
                 
                                    
                                   <?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12){?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class_id" class="select2"  onChange="return get_class_sections(this.value)" required  />
                                     <option value=" ">Select</option>
                                     <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year',$running_year);
									 
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
                          </select>
										
                                       	
										</div>
									</div>
  <?php } ?>	
									<div class="space-4"></div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: <font color="#FF0000">* </font></label>

										 <div class="col-sm-9">
		                        <select name="section_id"  class="col-xs-10 col-sm-5"    id="section_selector_holder" required />
		                            <option value="">Select</option>
			                    </select>
			                </div>
									</div>
                
<div class="form-group">
<label for="field-1" class="col-sm-3 control-label">Photo</label>
                        
						<div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>           
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            Send</button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
         </div></div></div></div></div></div></div>
    
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  
    <script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	alert(class_id);
	get_fee_master(class_id) ;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section_notification/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
    </script>

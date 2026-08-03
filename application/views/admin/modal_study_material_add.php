<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>

<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php $teacher=$this->session->userdata('login_user_id');
 $running_year = get_running_year();?>
 
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
							<li class="active">Study Material</li>
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
								Study Material
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add
								
							</h1>
						</div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/study_material/create/'.$teacher, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
             
<?php $teacher=$this->session->userdata('login_user_id');?>

				<?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
                                    <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">*</font></label>

										<div class="col-sm-5">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-5">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)" required="">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="select2" id="class_id" onchange="return get_class_subject(this.value)" required="">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            
                        </select>
                    </div>
                </div>
                <?php } 
				if($role==3)
					 {?>
                     <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-5">
											<select name="department" class="select2" id="department" onChange="return get_class1(this.value)" required="">
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
                                    
                                    <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="select2" id="class1" onchange="return get_class_subject(this.value)" required="">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            
                        </select>
                    </div>
                </div>
                   
                      <?php } 
				if($role==4|| $role==12)
					 {?>
                     
                                    
                                    <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="select2" id="class1" onchange="return get_class_subject(this.value)" required="">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
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
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title'); ?><font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" id="field-1" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-5">
                        <textarea name="description" class="form-control" id="field-ta"></textarea>
                    </div>
                </div>

                

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="select2" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('File'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search'); ?>"  required=""/>

                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('File-Type'); ?></label>

                    <div class="col-sm-5">
                        <select name="file_type" class="select2">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <option value="pdf"><?php echo get_phrase('Pdf'); ?></option>
                            <option value="excel"><?php echo get_phrase('Excel'); ?></option>
                            <option value="other"><?php echo get_phrase('Other'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 control-label col-sm-offset-2">
                    <button type="submit" class="btn btn-success"><?php echo get_phrase('Send'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>


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
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_class1(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class1').html(response);
            }
        });
    }
	

	
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','440px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>        
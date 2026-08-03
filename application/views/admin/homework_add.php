<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year(); ?>

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
							<li class="active">Homework</li>
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
								Homework
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								
							</h1>
						</div>

<?php $class_info = $this->db->get('class')->result_array(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title" ><font color="white">Send-Homework</font></div>
            </div>
            <br><br>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/homework/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" required="" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content" ></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Last-day-delivery</label>

                    <div class="col-sm-8">
                            <input type="text" class="form-control mydatepicker" name="time_end"  value="" >
                    </div>
                </div>
                <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				  <div class="form-group">
                
                    <label for="field-1" class="col-sm-3 control-label">Branch</label>

                    <div class="col-sm-8">
                       <select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
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
                
                    <label for="field-1" class="col-sm-3 control-label">Departement</label>

                    <div class="col-sm-8">
                        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
                    </div>
                </div>
                <div class="form-group">
                
                    <label for="field-1" class="col-sm-3 control-label">Class</label>

                    <div class="col-sm-8">
                        <select name="class_id" class="select2" onchange=" get_class_sections(this.value);  get_class_subject(this.value);" id="class" required>
                        <option value="">Select</option>
                        
                    </select>
                    </div>
                </div>
		<?php } ?>
        
        
         <?php 
					 if($role==3)
					 {?>
				  
                  <div class="form-group">
                
                    <label for="field-1" class="col-sm-3 control-label">Departement</label>

                    <div class="col-sm-8">
                        <select name="department" class="select2" id="department" onChange="return get_class1(this.value)">
                              <option value="">Select</option>
                               
                             <?php 
							  $this->db->where('is_deleted','N');
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
                
                    <label for="field-1" class="col-sm-3 control-label">Class</label>

                    <div class="col-sm-8">
                        <select name="class_id" class="select2" onchange=" get_class_sections(this.value);  get_class_subject(this.value);" id="class1" required>
                        <option value="">Select</option>
                        
                    </select>
                    </div>
                </div>
		<?php } ?>
         <?php 
					 if($role==4 || $role==12)
					 {?>
				  
                 
                <div class="form-group">
                
                    <label for="field-1" class="col-sm-3 control-label">Class</label>

                    <div class="col-sm-8">
                        <select name="class_id" class="select2" onchange=" get_class_sections(this.value);  get_class_subject(this.value);" id="class1" required="required">
                        <option value="">Select</option>
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
                        <label for="field-2" class="col-sm-3 control-label">Section</label>
                            <div class="col-sm-8">
                                <select name="section_id" class="select2" id="section_selector_holder" required>
                                    <option value="">Select-Class</option>
                                </select>
                            </div>
                    </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label">Subject</label>
                    <div class="col-sm-8">
                        <select name="subject_id" class="select2" id="subject_selector_holder" required>
                            <option value="">Select-Class</option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label">File</label>

                    <div class="col-sm-8">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Search" />

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
            </div>
        </div>
    </div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>



<script type="text/javascript">
    function get_class_sections(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>

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
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script> 
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
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
                jQuery('#class').html(response);
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
$('.select2').css('width','720px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>        

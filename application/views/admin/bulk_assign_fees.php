<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year();?>
 

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
							<li class="active">Bulk Assign Fee</li>
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
								Assign Fees 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									All Students
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        
                                        
                <?php echo form_open(base_url() . 'index.php/feeManagement/bulk_assign_fees1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

  <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                       <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
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
                                    
                                    
                                   
                                    
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)" required="">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="class_id" id ="class_id" class="select2" required="" onChange="return get_class_sections(this.value)" required="" >
            <option value=""><?php echo 'Select'; ?></option>
        </select>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="section_id" class="select2" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
        <option value=""><?php echo 'Select'; ?></option>
        </select>
    </div>
</div>
                                    
                                    <?php }} ?>
                                    
                                    
                                   <?php  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)" required="">
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
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="class_id" id ="class_id" class="select2" required="" onChange="return get_class_sections(this.value)">
            <option value=""><?php echo 'Select'; ?></option>
        </select>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="section_id" class="select2" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
        <option value=""><?php echo 'Select'; ?></option>
        </select>
    </div>
</div>
                                    <?php } ?>

<?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>

		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class<font color="#FF0000">*</font></label>
        <div class="col-sm-9">
		<select name="class_id" id ="class_id" class="select2" required="" onChange="return get_class_sections(this.value)">
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
    
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="section_id" class="select2" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
        <option value=""><?php echo 'Select'; ?></option>
        </select>
    </div>
</div>
                    
   <?php }?>            
					




    
    
    <div class="col-sm-offset-3 col-sm-5">
    <button type="submit" class="btn btn-info" name="btnSearch">Show</button>
    </div>
     <?php echo form_close();?>
                                    

												
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
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section1/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
				jQuery('#section_selector_holder').prepend('<option value="all" selected>All</option>');
			}
        });
		setText();
    }
	
	function setText()
	{
	var elt = document.getElementById('class_id');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtcourse').value=selectedText;
	}
	
	

    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
		})
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
	function get_class(department) 
	{
	//alert(department);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_cls/' + department ,
            success: function(response)
            {
				jQuery('#class_id').html(response);
            }
        });
    }
	

	
</script>



<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>       
<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?><body>
        
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
							<li class="active">Add Bulk Section</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Section
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Bulk
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/admin/section/'; ?>"><button class="btn-info">Back</button></a></div>
 <?php 
 echo form_open('admin/add_bulk_section');
 $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
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
<br />	<br />	

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
    </div> 
</div>
<br />	<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class_id" id="class_id" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>
<br />	<br />
	
 
	

<?php }?>
 <?php if($this->session->userdata('role')==3)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
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
    <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />
</div>
<br />	<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class_id" id="class_id" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>
<br />	<br />
<?php }?>

 <?php if($this->session->userdata('role')==4)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select  name="class_id"  onchange="get_class_sections(this.value)" required id="class_id" class="select2">
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
        <input type="hidden" name="branch" id="branch" value="<?php echo $branch; ?>" />
        <input type="hidden" name="department" id="department" value="<?php echo $dept; ?>" />
</div>
<br />	<br />
<?php } ?>
<br><br>

<div class="row">
    
    <div class="col-md-12"  >
        <div id="bulk_add_form">
            <div id="student_entry">
                <div class="row" style="margin-bottom:10px;">
            
                    <div class="col-md-3"></div>
                    <div class="col-md-2"  >
                        <div class="form-group">
                            <input type="text" name="section_name[]" id="section_name" class="form-control" style="margin-left: 5px;"
                                placeholder="<?php echo get_phrase('Section Name');?>" required onBlur="check_section_exist(this.value)">
                        </div>
                    </div>    
                    <div class="col-md-2"  >
                        <div class="form-group">
                            <select name="teacher_id[]" id="teacher_id" class="form-control" style="margin-left: 5px;">
                                <option value="">Select Teacher</option>
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
									foreach($teachers as $row):
										?>
                                		<option value="<?php echo $row['staff_id'];?>"><?php echo $row['name']; ?></option>
                                		<?php
                                    endforeach;    
                                ?>
                            </select>    
                        </div>
                    </div>    
                    <div class="col-md-4"  >
                        <div class="form-group">
                            <button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
                                    onclick="deleteParentElement(this)" style="margin-left: 10px;">
                                <i class="fa fa-trash-o" style="color: #fff;"></i>
                            </button>
                        </div>
                    </div>
            
                </div>
            
            </div>
    
    
    		<div id="student_entry_append"></div>
            <br>
            
            <div class="row" >
                <div class="col-md-3"></div>
                <div class="col-md-2"  >
                    <button type="button" class="btn btn-info" onClick="append_student_entry()" style="margin-left: 5px;">
                        <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                    </button>
                </div>    
            </div>
    
            <br>
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2"  >
                    <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
                        <i class="entypo-check"></i> <?php echo get_phrase('Save');?>
                    </button>
                </div>    
            </div>
         
         
    <?php echo form_close();?> 
    </div>
</div>
</div>

</div></div></div></body>

			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="added")
{
echo "<script>toastr.success('". "Section Added successfully...', 'Success', {timeOut: 5000})</script>";
}
else if($action=="not_added")
{
echo "<script>toastr.error('". "Section Not Added...', 'Failed', {timeOut: 5000})</script>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<2;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});

</script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
 <script type="text/javascript">
	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}
	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode.parentNode);
	}
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
    function check_section_exist(section_name)
    {
        if(section_name!='')
        {
            var class_id    =   $('#class_id').val();
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/check_section_exist/' + section_name +'/'+class_id,
                success: function(response)
                {
                    if(response==1)
                    {
                        alert("Section Name already exist");
                        $('#btnSubmit').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#btnSubmit').prop('disabled',false);
                    }
                    //jQuery('#section_selector_holder').html(response);
                }
            });
        }
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

 
 
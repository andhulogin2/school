<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year(); ?>

<?php 
$row = $this->db->get_where('exam' , array('exam_id' => $exam_id) )->row_array();
if (!empty($row)):
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
							<li class="active">Unit Exam</li>
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
								EDIT
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Unit Exam
								
							</h1>
						</div>
            	</div>
            <div align="right" style="padding-right:100px"><a href="<?php echo base_url() . 'index.php/Admin/view_exam/'; ?>"><b><button class="btn-info">Back</button></b></a></div> 

			<div class="panel-body">	
                <?php echo form_open('admin/create_exam/edit/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <input type="hidden" name="exam_id" value="<?php echo $row['exam_id']; ?>" />
            <div class="padded">
<br>
            
            <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				<div class="padded">
                 <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-5">
											<select name="branch" class="select2" id="branch" required="" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  if($branch1['branch_id']==$row['branch_id'])
							  {
							  ?>
                              <option value="<?php echo $branch1['branch_id'];?>" selected="selected"><?php echo $branch1['branch_name'];?></option>
                              <?php
							  }
							  else
							  {
							  ?>
                              <option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php
							  } 
							  }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-5">
											<select name="department" class="select2" id="department" required=""  onChange="return get_class1(this.value)">
                              <option value="">Select</option>
                              <?php $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  if($dept1['dept_id']==$row['dept_id'])
							  {
							  ?>
                              <option value="<?php echo $dept1['dept_id'];?>" selected="selected"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  }
							  ?>
                              
                          </select>
										</div>
									</div>
		     		<div class="form-group">
                   <div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font></label>

										<div class="col-sm-5">
									<select name="class" id="class" class="select2" required=""  onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                                     <?php $class=$this->db->get('class')->result_array();
							  foreach ($class as $class1)
							  {
							  if($class1['class_id']==$row['class_id'])
							  {
							  ?>
                              <option value="<?php echo $class1['class_id'];?>" selected="selected"><?php echo $class1['name'];?></option>
                              <?php
							  }
							  }
							  ?>
                          </select>
											
										</div>
									</div>
                                    <?php }?>
                                    
                                    <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-5">
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value)" required="">
            <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							   if($dept1['dept_id']==$row['dept_id'])
							  {
							  ?>
                              <option value="<?php echo $dept1['dept_id'];?>" selected="selected"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  else
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php 
							  }
							  }?>
                             
                             
                              
                          </select>
		</div>
	</div>
<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Class: <font color="#FF0000">* </font></label>

										<div class="col-sm-5">
			<select name="class" class="form-control selectboxit" onchange="select_section(this.value)" id="class" class="select2" required="">
				<option value="">Select</option>
				<?php $class=$this->db->get('class')->result_array();
							  foreach ($class as $class1)
							  {
							  if($class1['class_id']==$row['class_id'])
							  {
							  ?>
                              <option value="<?php echo $class1['class_id'];?>" selected="selected"><?php echo $class1['name'];?></option>
                              <?php
							  }
							  }
							  ?>
			</select>
		</div>
	</div>

<?php }?>
<?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>

		<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" >Class:<font color="#FF0000">* </font></label>
        <div class="col-sm-5">
			<select  name="class"  onchange="select_section(this.value)" id="class_id" class="select2" required="">
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){
									 if($data['class_id']==$row['class_id'])
								     ?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                     
                                     
                                       <?php } ?>
				
			</select>
		</div>
	</div>
    <?php }?>
            
                <div class="form-group">
                    <label class="col-sm-4 control-label">Exam Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="col-xs-12 col-sm-9" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="Required"/>
                    </div>
                </div>
      
                <div class="form-group">
                    <label class="col-sm-4 control-label">Description</label>
                    <div class="col-sm-5">
                        <input type="text" class="col-xs-12 col-sm-9" name="comment" value="<?php echo $row['comment'];?>"/>
                    </div>
                </div>
                                

                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-5">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
                </div></div>
            </form>
           
<?php
endif;
?>
</div></div>  
  <?php include_once APPPATH . 'views/footer.php'; ?>

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
	function get_class1(dept_id) 
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

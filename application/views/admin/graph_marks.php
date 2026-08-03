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
							<li class="active">Mark Report</li>
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
								Report 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Graph
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php 
		
		echo form_open(base_url() . 'index.php/admin/view_graph_marks');?>
         <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
        <div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Branch</label>
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
            <div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Department</label>
					<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onchange="return get_section(this.value)" id="class_id">
                        <option value="">Select</option>
                        
                    </select>
				</div>
			</div>
         <?php } ?>
         <?php  if($role==3){ ?>
          <div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Department</label>
					<select name="department" class="select2" id="department" onChange="return get_class1(this.value)">
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
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onchange="return get_section(this.value)" id="class_id">
                        <option value="">Select</option>
                        
                    </select>
				</div>
			</div>
         <?php } ?>
         
         <?php  if($role==4 || $role==12){ ?>
         
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onchange="return get_section(this.value)" id="class_id" required>
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
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Section</label>
				<select name="section_id" id="section_id" class="select2" style="width:200px;" required onchange="get_students();">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
        <div class="form-group">
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Student</label>
				<select name="student_id" id="student_id" class="select2" style="width:200px;" >
					<option value="0">Select</option>		
				</select>
				<label class="control-label" style="font-size:11px">[Student is not mandatory. Select only if you want single student's report]</label>
			</div>
		</div>
   
            <div class="col-md-12" >
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-12" style="margin-top: 28px;text-align:left">
				<button type="submit" class="btn btn-info" >Submit</button>
			</div>
            </div>
		<?php echo form_close();?>
	</div></div>
    
    	
    
    </div></div></div>
    <?php include_once APPPATH . 'views/footer.php'; ?>
    <script type="text/javascript">
	function validate()
	{
		var class_id	=	$('#class_id').val();
		var section_id	=	$('#section').val();	
		if(class_id=='')
		{
			alert('Please Select Class');
			return false;
		}
		else if(section_id=='')
		{
			alert('Please Select Section');
			return false;
		}
		return true;
	}
	function get_students() {	
	//alert(class_id);
		var class_id	=	$('#class_id').val();
		var section_id	=	$('#section_id').val();
		if(section_id=='')
		{
			jQuery('#student_id').html("");
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/get_students1/' + class_id + '/' + section_id,
				success: function(response)
				{
					jQuery('#student_id').html(response);
				}
			});
		}
	}
	function get_class_subject(section_id) {	
	//alert(class_id);
		var class_id	=	$('#class_id').val();
		if(section_id=='')
		{
			jQuery('#subject_holder').html("");
		}
		else
		{
				$(".preloader").show();
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_prog_report/' + class_id + '/' + section_id,
				success: function(response)
				{
					jQuery('#subject_holder').html(response);
				}
				}).complete(function () {
					$(".preloader").hide();
				});
		}
	}
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
	
	function get_section(class_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/get_section_by_class/' + class_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
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

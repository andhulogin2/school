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
				<li class="active">Student Certificate Report</li>
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
		<div class="page-content">
			
			<div class="page-header">
				<h1>Student Certificate Report</h1>
			</div>
			<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2){ ?>
				<div class="col-md-2">
				<div class="form-group">
				<label class="control-label" style="margin-bottom: 5px;">Branch</label>
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
				<label class="control-label" style="margin-bottom: 5px;">Department</label>
					<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
						  <option value="">Select</option>
						  
					  </select>
				</div>
			</div>
		
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onChange="return get_class_section(this.value)" id="class_id">
                        <option value="">Select</option>
                       
                    </select>
				</div>
			</div>
            <?php } ?>
            <?php if($this->session->userdata('role')==3)
			{?>
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;">Department</label>
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
			</div>
			<div class="col-md-2">
					<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;">Class</label>
						<select name="class_id" class="select2" onChange="return get_class_section(this.value)" id="class_id">
							<option value="">Select</option>
							
						</select>
					</div>
				</div>

			<?php }?>

			<?php if($this->session->userdata('role')>=4)
			{?>
			<div class="col-md-2">
					<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;">Class</label>
						<select name="class_id" class="select2" onChange="return get_class_section(this.value)" id="class_id" required />
							<option value="">Select</option>
							<?php 
							 $academic_year = get_running_year();
							 $branch	=$this->session->userdata('branch_id');
							 $dept	=	$this->session->userdata('dept_id');
							 $this->db->where('branch_id',$branch);
							 $this->db->where('dept_id',$dept);
							 $this->db->where('academic_year',$academic_year);
							 $class 	=	$this->db->get('class')->result_array();
							 foreach($class as $data){?>
							  <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
							   <?php } ?>
							
						</select>
						<input type="hidden" name="department" id="department" value="<?php echo $dept; ?>"  />
					</div>
				</div>
				<?php }?>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" style="margin-bottom: 5px;">Section</label>
							<select name="section_id" id="section_id" class="select2" onChange="return get_student_by_section(this.value)">
								<option value="">Select</option>		
							</select>
						</div>
					</div>
				<div class="col-md-2">
					<div class="form-group">    
					<label class="control-label" style="margin-bottom: 5px;">Students</label>
						<select name="student_id" id="student_id" class="select2" onchange="get_submitted_certificates();" >
							<option value="">Select</option>		
						</select>
					</div>
				</div>
					<div class="col-md-12" style="text-align:center">
						<center>
							<button type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit" disabled="disabled" onClick="student_certificate_data();">show</button>
						</center>
					</div>

			<div id="fee_detail" class="col-md-12">
			</div>
 </div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
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
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
				$('#class_id').find('option').get(0).remove();
				$('#class_id').prepend('<option value="" selected>Select</option><option value="all">All</option> ')
            }
        });
    }
</script>

<script type="text/javascript">
	function get_class_section(class_id) 
	{
		if(class_id!='all')
		{
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
			
            success: function(response)
            {
                jQuery('#section_id').html(response);
				$('#section_id').find('option').get(0).remove();
				$('#section_id').prepend('<option value="" selected>Select</option><option value="all">All</option> ')

				$('#section_id').prop('disabled', false);
				$('#btnsubmit').prop('disabled', false);
            }
			});
		}
		else
		{
			$('#section_id').prop('disabled', true);
			$('#btnsubmit').prop('disabled', false);
		}
	}
</script>

<script type="text/javascript">
	function get_student_by_section(section_id)
	{
		$('#student_id').prop('disabled', false);
		if(section_id!='all')
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_student_by_section/' + section_id ,
				success: function(response)
				{
					jQuery('#student_id').html(response);
					$('#student_id').prop('disabled', false);
				}
			});
		}
		else
		{
			$('#student_id').prop('disabled', true);
		}
	}
</script>

<script type="text/javascript">
	function student_certificate_data() {
	var department		=	$("#department").val();
	var class_id		=	$("#class_id").val();
	var section_id		=	$("#section_id").val();
	var student_id		=	$("#student_id").val();
	var from_date		=	$("#from_date").val();
	var to_date			=	$("#to_date").val();
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/Admin/student_certificate_data/' + department +'/'+ class_id +'/'+ section_id +'/'+ student_id ,
			
            success: function(response)
            {
                jQuery('#fee_detail').html(response);
            }
			});
	}
</script>


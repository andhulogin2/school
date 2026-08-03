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
				<li class="active">Return Certificates</li>
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
				<h1>Return Certificates</h1>
			</div>
		 <?php echo form_open_multipart('Admin/certificate_return', array('class' => 'form-horizontal','id'=>"myform"));?>
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
						<select name="student_id" id="student_id" class="select2" onchange="get_issued_certificates();" >
							<option value="">Select</option>		
						</select>
					</div>
				</div><br />

			<div id="fee_detail" class="col-md-12">
			</div>
	  <?php echo form_close(); ?>
 </div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Certificates Returned...', {timeOut: 5000})</script>";
}
?>
<script type="text/javascript">
	function get_dept(branch_id) 
	{
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
	function get_class_section(class_id) 
	{
		if(class_id==''){
			jQuery('#fee_detail').html('');
		}
		$.ajax({
			url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
			success: function(response)
			{
				jQuery('#section_id').html(response);
			}
		});
	}
</script>

<script type="text/javascript">
	function get_student_by_section(section_id)
	{
		if(section_id==''){
			jQuery('#fee_detail').html('');
		}
		$.ajax({
			url: '<?php echo base_url();?>index.php/admin/get_certificates_issued_students/' + section_id ,
			success: function(response)
			{
				jQuery('#student_id').html(response);
				//$('#student_id').find('option').get(1).remove();
			}
		});
	}
</script>

<script type="text/javascript">
	function get_issued_certificates() {
	var class_id		=	$("#class_id").val();
	var section_id		=	$("#section_id").val();
	var student_id		=	$("#student_id").val();
	if(class_id!='' && section_id!='' && student_id!=''){
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/get_issued_certificates/' + student_id ,
            success: function(response)
            {
                jQuery('#fee_detail').html(response);
            }
			});
		} else {
                jQuery('#fee_detail').html('');
		}
	}
</script>

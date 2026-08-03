<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
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
							<li class="active">Report</li>
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
									Admission Report
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php 
		
		echo form_open(base_url() . 'index.php/report/student_print_bulk_section1/');?>
        
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
                         <input type="hidden" name="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" id="branch"  />
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
         
         <?php  if($role>=4){ ?>
         
			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onchange="return get_section(this.value)" id="class_id" required>
                        <option value="">Select</option>
                        <option value="All">All</option>
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
                    <input type="hidden" name="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" id="branch"  />
                    <input type="hidden" name="department" value="<?php echo $this->session->userdata('dept_id'); ?>" id="department"  />
				</div>
			</div>
         <?php } ?>
             
        <div class="form-group">
            <div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Section</label>
				<select name="section" id="section" class="select2" style="width:200px;" required >
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
        
        <div class="form-group">
            <div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Date From</label>
				<input type="text" name="from_date" id="from_date" style="width:150px;" class="mydatepicker" required  />
			</div>
		</div>
        
        <div class="form-group">
            <div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Date To</label>
				<input type="text" name="to_date" id="to_date" style="width:150px;" class="mydatepicker" required  />
			</div>
		</div>
        
    <div class="row">
    	<div class="col-md-12" style="text-align:left;padding-left:25px;">
        	<input type="button" name="submitBtn" value="Show" class="btn btn-info" onclick="get_admission_report()" />
        </div>
    </div>

   <div id="subject_holder">     
    	<div class="col-md-12">
			<div class="form-group">
			
				
			</div>
    	</div>
    </div>
	<?php echo form_close();?>
	</div></div></div></div></div>
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
		var section_id	=	$('#section').val();
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
	function get_admission_report() {	
	//alert(class_id);
		var branch_id	=	$('#branch').val();
		var dept_id		=	$('#department').val();
		var class_id	=	$('#class_id').val();
		var section_id	=	$('#section').val();
		var from_date	=	$('#from_date').val();
		var to_date		=	$('#to_date').val();
		var role		=	<?php echo $role; ?>;
		if(role==1 || role==2)
		{
			if(branch_id=='')
			{
				alert("Please select branch");
				jQuery('#subject_holder').html('');
				return false;
			}
		}
		if(role==3)
		{
			if(dept_id=='')
			{
				alert("Please select department");
				jQuery('#subject_holder').html('');
				return false;
			}
			if(from_date=='')
			{
				alert("Please select 'From Date'");
				jQuery('#subject_holder').html('');
				return false;
			}
			if(to_date=='')
			{
				alert("Please select 'To Date'");
				jQuery('#subject_holder').html('');
				return false;
			}
		}
		if(role==4 || role==12)
		{
			if(class_id=='')
			{
				alert("Please select class");
				jQuery('#subject_holder').html('');
				return false;
			}
			if(from_date=='')
			{
				alert("Please select 'From Date'");
				jQuery('#subject_holder').html('');
				return false;
			}
			if(to_date=='')
			{
				alert("Please select 'To Date'");
				jQuery('#subject_holder').html('');
				return false;
			}
		}
		$.ajax({
			data:	{branch_id:branch_id,dept_id:dept_id,class_id:class_id,section_id:section_id,from_date:from_date,to_date:to_date},
			method: 'POST',
			url: '<?php echo base_url();?>index.php/admin/get_admission_report',
			success: function(response)
			{
				jQuery('#subject_holder').html(response);
			}
		});
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
                jQuery('#class_id').html(response);
            }
        });
    }
	
	function get_section(class_id) 
	{
	//alert(dept_id);
		if(class_id=='All')
		{
			$('#section').prop('disabled',true);
		}
		else
		{
			$('#section').prop('disabled',false);
			$.ajax({
				url: '<?php echo base_url();?>index.php/Admin/get_section_by_class/' + class_id ,
				success: function(response)
				{
					jQuery('#section').html(response);
					jQuery('#section').children('option:first').remove();
					jQuery('#section').prepend('<option value="all">All</option>');
					jQuery('#section').prepend('<option value="" selected>Select Section</option>');
				}
			});
		}
    }
	

	
</script>

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
							<li class="active">Home Test</li>
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
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Home Test
								
							</h1>
						</div>
                              <div align="right"><a href="<?php echo base_url();?>index.php/Admin/view_home_test/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> </div>
<?php echo form_open(base_url() . 'index.php/admin/create_home_test/upload_marks');?>
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
					<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id">
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
			<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id">
				<option value="">Select</option>
				
			</select>
		</div>
	</div>

<?php }?>

<?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>
<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id" required />
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
		</div>
	</div>
    <?php }?>
        <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom: 5px;">Section</label>
				<select name="" id="" class="select2" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Exam</label>
				<input type="text" name="exam" id="exam" />
			</div>
    </div>
	    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Subject</label>
				<select name="" id="" class="select2" disabled="disabled">
					<option value="0">Select-Class</option>		
				</select>
			</div>
		</div>
        
        <div class="col-md-2">
	   <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Date</label>
			<input type="text" class="form-control mydatepicker" name="date" value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
         
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">Submit</button>
			</center>
		</div>
	</div>
 </div>
<?php echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
	function get_class_subject(class_id) {
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/admin/class_get_subject/' + class_id ,
			
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			});
			/*$.ajax({
		url: '<?php echo base_url();?>index.php?admin/get_unit_test/' + class_id ,
            success: function(response)
            {
                jQuery('#exam_id').html(response);
            }
            });*/
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
	

	
</script>

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


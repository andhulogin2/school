<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">Upload Marks</li>
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
									 Mark Upload
								
							</h1>
						</div>

<?php echo form_open(base_url() . 'index.php/admin/marks_selector');?>
	<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2){ ?>
        <div class="col-md-2">
        <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Branch</label>
			<select name="branch" class="form-control selectboxit" id="branch" onChange="return get_dept(this.value)">
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
			<select name="department" class="form-control selectboxit" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
		</div>
	</div>

			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="form-control selectboxit" onChange="return get_class_subject(this.value)" id="class_id">
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
			<select name="department" class="col-xs-11 col-sm-11" id="department" onChange="return get_class(this.value)">
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
			<select name="class_id" class="form-control selectboxit" onChange="return get_class_subject(this.value)" id="class_id">
				<option value="">Select</option>
				
			</select>
		</div>
	</div>

<?php }?>

<?php if($this->session->userdata('role')==4)
{?>
<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onChange="return get_class_subject(this.value)" id="class_id">
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
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
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
    </div>
	    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Subject</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select-Class</option>		
				</select>
			</div>
		</div>
         <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Remarks</label>
				<input type="text" class="form-control" name="remarks" id="remarks">
					
			</div>
		</div>
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">View</button>
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
		 
            url: '<?php echo base_url();?>index.php/admin/marks_get_subject/' + class_id ,
			
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
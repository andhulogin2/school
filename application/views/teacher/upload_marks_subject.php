<?php include_once APPPATH . 'views/teacher_head.php';?>
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
							<li class="active">Admission</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								<i class="ace-icon fa fa-angle-double-right"></i>
									 Upload Marks
								
							</h1>
							
						</div>

<?php echo form_open(base_url() . 'index.php/teacher/marks_selector_subject');
$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
?>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="select2" onchange="get_class_subject(this.value,<?php echo $teacher_id; ?>)">
				<option value="">Select</option>
				<?php
                                $yr=get_running_year();
				$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
                       $this->db->select('c.class_id,c.name as class_name');
					   $this->db->where('c.branch_id',$this->session->userdata('branch_id'));
					    $this->db->where('c.dept_id',$this->session->userdata('dept_id'));
					   $this->db->where('st.teacher_id',$teacher_id);
					   $this->db->where('c.academic_year',$yr);
					   
					   // $this->db->where('s.teacher_id',$teacher_id);
					$this->db->join('subject_teacher st','c.class_id=st.class_id','LEFT');
					$this->db->group_by('c.class_id');
					$this->db->order_by('c.name','ASC');
					   //$this->db->join('section d','d.class_id=c.class_id','LEFT');
					   //$this->db->join('section d','d.class_id=c.class_id','LEFT');
						$class=$this->db->get_where('class c')->result_array();
						foreach ($class as $row1):
				?>
				<option value="<?php echo $row1['class_id'];?>"><?php echo $row1['class_name'];?></option>
				<?php endforeach;?>
				
			</select>
		</div>
	</div>
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
			<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
				<select name="" id="" class="select2" disabled="disabled">
					<option value="0">Select</option>		
				</select>
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
	function get_class_subject(class_id,t_id) {
	//alert(teacher_id);
	//alert(t_id);
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/teacher/marks_get_subject/' + class_id + '/' + t_id ,
			
            success: function(response)
            {
				console.log(response);
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
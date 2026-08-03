<?php include_once APPPATH . 'views/office_staff_head.php';?>
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
								Progress 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Report
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php 
		
		echo form_open(base_url() . 'index.php/report/student_print_bulk_section1/'.$class_id);?>
         
         
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="form-control selectboxit" onchange="return get_class_subject(this.value)" id="">
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
        
             <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-3">
				<label class="control-label" style="margin-bottom:5px;">Section</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled" style="width:200px;">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-12">
			<div class="form-group">
			
				
			</div>
    </div>
    </div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-3 col-md-offset-2" style="margin-top: 28px;">
				<button type="submit" class="btn btn-info">Download</button>
			</div>
		<?php echo form_close();?>
	</div></div></div></div></div>
    <?php include_once APPPATH . 'views/footer.php'; ?>
    <script type="text/javascript">
	function get_class_subject(class_id) {	
            $(".preloader").show();
		$.ajax({
            url: '<?php echo base_url();?>index.php/office_staff/get_prog_report/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			}).complete(function () {
                $(".preloader").hide();
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
                jQuery('#class').html(response);
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

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
							<li class="active">Attendance</li>
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
									 Attendance
								
							</h1>
						</div>             
   


<?php echo form_open(base_url() . 'index.php/teacher/attendance_selector/');?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)">
				<option value="">Select</option>
				<?php
                                $yr=get_running_year();
				$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
                       $this->db->select('s.class_id as id_class,c.name as class_name');
					   $this->db->where('s.teacher_id',$teacher_id);
					   $this->db->where('c.academic_year',$yr);
					   $this->db->join('class c','c.class_id=s.class_id','LEFT');
						$class=$this->db->get_where('subject s')->result_array();
						foreach ($class as $row1):
				?>
				<option value="<?php echo $row1['id_class'];?>"><?php echo $row1['class_name'];?></option>         
				<?php endforeach;?>
			</select>
		</div>
	</div>

    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Section</label>
			<select class="form-control selectboxit" name="section_id">
            <option value="">Select</option>
			</select>
		</div>
	</div>
    </div>
	
   <div class="col-md-3">
	   <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Date</label>
			<input type="text" class="form-control mydatepicker" name="timestamp"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info">View</button>
	</div>
</div>
</div>
</div></div>
<?php echo form_close();?>

<?php include_once APPPATH . 'views/footer.php'; ?>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    function select_section(class_id) 
    {
	//alert(class_id);
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/teacher/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
	</script>
   
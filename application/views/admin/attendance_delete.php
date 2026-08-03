<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10">
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
							<li class="active"> Attendance Delete</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Settings
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance Delete
								
							</h1>
						</div>


<?php echo form_open(base_url() . 'index.php/admin/delete_attendance/');?>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Branch</label>
			<select name="branch_id" class="form-control selectboxit" onChange="get_dept(this.value)">
				<option value="">Select</option>
				<?php
					$this->db->where('is_deleted','N');
					$branches = $this->db->get('tbl_branch')->result_array();
					foreach($branches as $row):                        
				?>                
				<option value="<?php echo $row['branch_id'];?>"
					><?php echo $row['branch_name'];?></option>            
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Department</label>
			<select name="department_id" id="department_id" class="form-control selectboxit" onChange="get_class_dept(this.value)">
				<option value="">Select</option>
			</select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onChange="select_section(this.value)" id="class_id">
				<option value="">Select</option>
			</select>
		</div>
	</div>

    <div id="section_holder">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Section</label>
			<select class="form-control selectboxit" name="section_id">
            <option value="">Select</option>
			</select>
		</div>
	</div>
    </div>
	
    <div class="col-md-2">
	   <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Date</label>
			<input type="text" class="form-control mydatepicker" name="timestamp1"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info">Delete</button>
	</div>
</div>
<?php echo form_close();?>
</div>
</div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
	
	function get_dept(branch_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department_id').html(response);
			//	alert(response);
            }
        });
    }
	
	function get_class_dept(dept_id) 
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
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Deleted Successfully...', 'Deleted', {timeOut: 5000})</script>";
}

?>   
    
    
    
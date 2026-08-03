<?php 

	include_once APPPATH . 'views/student_head.php';

?>
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
							<li class="active">Hourly Attendance</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div><!-- /.breadcrumb -->
						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
                        <div class="page-header">
							<h1>
								Student
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Hourly Attendance
								</small>
							</h1>
						</div>             
   


            <?php  echo form_open(base_url() . 'index.php/Hourly_attendance/hourly_attendance_2' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
            
         
		
              
    
   
 
            
            
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">From Date</label>
    <div class="col-sm-9">
       <input type="text" class="col-xs-10 col-sm-5 mydatepicker" name="from_date" required="" id="from_date"
				value="<?php echo date('d-m-Y');?>"  />
    </div> 
</div>


<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">To Date</label>
    <div class="col-sm-9">
       <input type="text" class="col-xs-10 col-sm-5 mydatepicker" name="to_date" required="" id="to_date"
				value="<?php echo date('d-m-Y');?>"  />
    </div> 
</div>


 <div class="form-group">
   
    <div class="col-sm-offset-3 col-sm-5">
        <a class="btn btn-info" name="btnView" onClick="view_attendance_list()">View Attendance</a>
       
    </div>
    </div>
 
     <?php echo form_close();?>
        <div id='show_students_list' style="padding-left:50px;padding-right:25px;"></div>  
                </div></div></div>                   
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section1/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
			}
        });
    }
</script>
<script type="text/javascript">
	function get_class_subject() 
	{
		//alert("dd");
		var class_id = $('#class_id').val();
		var hour_id = $('#hour_id').val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_subject1/' + class_id+'/'+hour_id ,
            success: function(response)
            {
                jQuery('#subject_selector_holder').html(response);
			}
        });
    }
</script>

<script type="text/javascript">
	function get_class_teacher(subject_id) 
	{
		//alert("dd");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_teacher1/' + subject_id ,
            success: function(response)
            {
                jQuery('#teacher_selector_holder').html(response);
			}
        });
    }
</script>

<script type="text/javascript">
	function get_students_list() 
	{
		var att_date = $('#att_date').val();
		var hour_id = $('#hour_id').val();
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
		var subject_id = $('#subject_selector_holder').val();
		var teacher_id = $('#teacher_selector_holder').val();
		//alert(teacher_id);
		
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/get_students_list/' + class_id +'/'+section_id+'/'+att_date+'/'+hour_id+'/'+subject_id+'/'+teacher_id,
            success: function(response)
            {
                jQuery('#show_students_list').html(response);
			}
        });
    }
	
	
	
	function view_attendance_list() 
	{
		var hour = $('#hour_id').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		//alert(branch_id);
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Student/view_attendance_list/'+from_date+'/'+to_date,
            success: function(response)
            {
                jQuery('#show_students_list').html(response);
			}
        });
    }
	
	
	function check_date() 
	{
		var att_date = $('#att_date').val();
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/is_working_day/' + att_date,
            success: function(response)
            {
                jQuery('#date_message').html(response);
			}
        });
    }

</script>

        
        
<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	check_date() ;
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
	function get_class1(dept_id) 
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
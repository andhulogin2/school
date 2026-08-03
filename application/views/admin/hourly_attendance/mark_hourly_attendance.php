<?php
$role              =   $this->session->userdata('role');
$is_class_teacher  =   $this->session->userdata('is_class_teacher');
 	include_once APPPATH . 'views/main_head.php';
  ?>
<?php $running_year = get_running_year();?>
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
            
           
           
    <?php if($role==1 || $role==2) {  ?>      
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch:<font color="#FF0000">*</font> </label>
    <div class="col-sm-9">
       <select name="branch" class="col-xs-10 col-sm-5" id="branch" onChange="get_dept(this.value);get_hour();" required="">
                    
                              
                              <?php
							  $this->db->where('is_deleted','N');
							  $branch=$this->db->get('tbl_branch')->result_array();
							  ?>
                              <option value="">--Select--</option> 
                              <?php
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>" ><?php echo $branch1['branch_name'];?></option>
                              <?php 
							  }
							  ?>
        </select>
    </div> 
</div>

<?php } ?>


 <?php if($role==3 || $role==4 || $role==5 || $role==6) { ?>
 <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />
 <?php } ?>
 
 
 <?php if($role==1 || $role==2 || $role==3)  { ?>
		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departement:<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
			<select name="department" class="col-xs-10 col-sm-5" id="department" onChange="return get_class1(this.value)" required="">
            <option value="">Select</option> 
			                  <?php
							  if($role==3)
							  {
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  }
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  ?>
                          </select>
		</div>
	</div>
 <?php } ?>
 
 
 <?php if($role==4 || $role==5 || $role==6) { ?>
<input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id'); ?>" />
<?php } ?>       
    
		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class:<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
			<select  name="class_id"  onchange="return get_class_sections(this.value);" id="class_id" class="col-xs-10 col-sm-5" required="">
				<option value="">Select</option>
                <?php 
				                     if($role==4)
									 {
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year',$running_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } 
									  }
									 elseif($role==6 || $role==5)
									  {
									    $user_id=$this->session->userdata('login_user_id');
										$this->db->select('c.class_id,c.name');
										$this->db->from('staff s');
										$this->db->join('subject e','e.teacher_id=s.staff_id','LEFT');
										$this->db->join('class c','c.class_id=e.class_id','LEFT');
										$this->db->where('s.user_id',$user_id);
										$this->db->where('c.academic_year',$running_year);
										$class=$this->db->get()->result_array();
										foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } 
									  
									  
									  }
									  ?>
				
			</select>
		</div>
	</div>
          
            
            
            
            
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section:<font color="#FF0000">*</font> </label>
    <div class="col-sm-9">
        <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_selector_holder" required=""  >
        </select>
    </div>
</div>
   
 
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date: <font color="#FF0000">*</font></label>
    <div class="col-sm-9">
       <input type="text" class="col-xs-10 col-sm-5 mydatepicker" name="att_date" required="" id="att_date"
				value="<?php echo date('d-m-Y');?>" onchange="check_date()" required="" />
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> </label>
    <div class="col-sm-9" id="date_message" name="date_message">
      
    </div> 
</div>







<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hour: <font color="#FF0000">*</font> </label>
    <div class="col-sm-9">
        <select name="hour_id" class="col-xs-10 col-sm-5" required="" id="hour_id" onChange="get_hour_subject();" required="" >
        <option value="">--Select--</option>
        <?php
        if($role==3 || $role==4 || $role==5 || $role==6)
		{
		foreach($class_timing as $timing)
		{
		?>
		<option value="<?php echo $timing['class_timing_details_id']?>" ><?php echo $timing['timing_name']; ?></option>
		<?php
		}
		}
		?>
        
       
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Subject: <font color="#FF0000">*</font> </label>
    <div class="col-sm-9">
        <select name="subject_id" class="col-xs-10 col-sm-5" required="" id="subject_selector_holder" onchange="get_class_teacher(this.value);" required="" >
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Teacher: <font color="#FF0000">*</font> </label>
    <div class="col-sm-9">
        <select name="teacher_id" class="col-xs-10 col-sm-5" required="" id="teacher_selector_holder" required=""  >
        </select>
    </div>
</div>
    
 <div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <a class="btn btn-info" name="btnMark" onclick="get_students_list();send();">Mark Attendance</a>
    </div>
    </div>
  </div>   </div>
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
	function get_class_subject(class_id) 
	{
		//alert("dd");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_subject1/' + class_id ,
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
		var branch_id = $('#branch').val();
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
		var subject_id = $('#subject_selector_holder').val();
		var teacher_id = $('#teacher_selector_holder').val();
		var date_message = $('#date_message').text();
		date_message = date_message.trim();
		//alert(hour_id);

		if(date_message=="Is a holiday")
		{
		alert ("Please check the date " + date_message + " !");
		jQuery('#show_students_list').html("");
		return;
		}
		
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/get_students_list/' + class_id +'/'+section_id+'/'+att_date+'/'+hour_id+'/'+subject_id+'/'+teacher_id+'/'+branch_id,
            success: function(response)
            {
                jQuery('#show_students_list').html(response);
			}
        });
    }
	
	
	
	function view_attendance_list() 
	{
		var hour = $('#hour_id').val();
		var att_date = $('#att_date').val();
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/view_attendance_list/' + class_id +'/'+section_id+'/'+att_date+'/'+hour,
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

<script type="text/javascript">
	function get_hour_subject() 
	{
	var hour_id = $('#hour_id').val();
    var att_date = $('#att_date').val();
	var class_id = $('#class_id').val();
	//alert(hour_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_hour_subject/' + hour_id+'/'+att_date+'/'+class_id,
            success: function(response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
	
</script>

<script type="text/javascript">
	function get_hour_teacher() 
	{
	var hour_id = $('#hour_id').val();
    var att_date = $('#att_date').val();
	var class_id = $('#class_id').val();
	//alert(hour_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_hour_teacher/' + hour_id+'/'+att_date+'/'+class_id,
            success: function(response)
            {
                jQuery('#teacher_selector_holder').html(response);
            }
        });
    }
	
</script>

<script type="text/javascript">
	function get_hour() 
	{
	var branch_id = $('#branch').val();
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_hour/' + branch_id,
            success: function(response)
            {
			    
                jQuery('#hour_id').html(response);
            }
        });
    }
</script>

<script>
function send() {
       if (document.getElementById('branch').value == '') { alert('missing branch'); return }
       if (document.getElementById('department').value == '') { alert('missing department'); return }
        if (document.getElementById('class_id').value == '') { alert('missing class'); return }
        if (document.getElementById('section_selector_holder').value == '') { alert('missing section'); return }
		 if (document.getElementById('hour_id').value == '') { alert('missing hour'); return }
		  if (document.getElementById('subject_selector_holder').value == '') { alert('missing subject'); return }
    }
</script>	
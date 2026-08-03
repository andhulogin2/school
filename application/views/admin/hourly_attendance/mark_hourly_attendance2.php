<?php $role=$this->session->userdata('role');
 	include_once APPPATH . 'views/main_head.php';
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
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date</label>
    <div class="col-sm-9">
       <input type="text" class="col-xs-10 col-sm-5 mydatepicker" name="att_date" required="" id="att_date"
				value="<?php echo date('d-m-Y');?>" onchange="check_date()" />
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> </label>
    <div class="col-sm-9" id="date_message">
      
    </div> 
</div>



 <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>	 
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch</label>
    <div class="col-sm-9">
       <select name="branch" class="col-xs-10 col-sm-5" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
        </select>
    </div> 
</div>
  
 <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departement</label>
    <div class="col-sm-9">
      <select name="department" class="col-xs-10 col-sm-5" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
       <select name="class" id="class" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
										
    </div> 
</div>
 
 <?php } ?> 
   <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departement</label>
    <div class="col-sm-9">
			<select name="department" class="col-xs-10 col-sm-5" id="department" onChange="return get_class(this.value)">
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

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
			<select name="class"  onchange="return get_class_sections(this.value)" id="class" class="col-xs-10 col-sm-5">
				<option value="">Select</option>
				
			</select>
		</div>
	</div>
    

<?php }?>

<?php if($this->session->userdata('role')==4)
{?>

		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
			<select  name="class"  onchange="return get_class_sections(this.value)" id="class" class="col-xs-10 col-sm-5">
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
    

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section </label>
    <div class="col-sm-9">
        <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_selector_holder" >
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hour </label>
    <div class="col-sm-9">
        <select name="hour_id" class="col-xs-10 col-sm-5" required="" id="hour_id" onchangeoo="get_students_list()">
        <option value="ALL">ALL</option>
        <?php
        foreach($class_timing as $timing)
		{
		echo '<option value="'.$timing['class_timing_details_id']. '">'.
		$timing['timing_name'].'</option>';
		}
		?>
        </select>
    </div>
</div>
    
 <div class="form-group">
   
    <div class="col-sm-offset-3 col-sm-5">
        <a class="btn btn-info" name="btnView" onclick="view_attendance_list()">View Attendance</a>
        &nbsp;&nbsp;&nbsp;
        <a class="btn btn-info" name="btnMark" onclick="get_students_list()">Mark Attendance</a>
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
	function get_students_list() 
	{
		var att_date = $('#att_date').val();
		var hour_id = $('#hour_id').val();
		var class_id = $('#class').val();
		var section_id = $('#section_selector_holder').val();
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/get_students_list/' + class_id +'/'+section_id+'/'+att_date+'/'+hour_id,
            success: function(response)
            {
                jQuery('#show_students_list').html(response);
			}
        });
    }
	
	
	
	function view_attendance_list() 
	{
		var att_date = $('#att_date').val();
		var class_id = $('#class').val();
		var section_id = $('#section_selector_holder').val();
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/view_attendance_list/' + class_id +'/'+section_id+'/'+att_date,
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
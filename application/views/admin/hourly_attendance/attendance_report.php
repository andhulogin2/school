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
							<li class="active">Attendance Report</li>
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
								<small>
									
									Attendance Report
								</small>
							</h1>
						</div>             
   


            
         <?php echo form_open(base_url() . 'index.php/Hourly_attendance/download_attendance_report' );
		  //echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
		 
		 ?>
           
           
 <?php if($role==1 || $role==2) { ?>          
            <div class="col-md-2">
            <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;"> Branch:<font color="#FF0000">*</font> </label>
       <select name="branch" class="form-control selectboxit" id="branch" onChange="get_dept(this.value);get_hour();" required="">
                              
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


        
<?php if($role==1 || $role==2 || $role==3) { ?>        
         <div class="col-md-2">
		<div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;">Departement:<font color="#FF0000">*</font></label>
			<select name="department" class="form-control selectboxit"  id="department" onChange="return get_class1(this.value)" required="">
            
            
                              <?php
							   if($role==3)
							  { 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  }
							  $dept=$this->db->get('tbl_department')->result_array();
							  ?>  <option value="">Select</option> <?php
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
 <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id');?>" />
 <?php } ?>
    
    
    
		<div class="col-md-2">
        <div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;">Class:<font color="#FF0000">*</font> </label>
			<select  name="class_id"  onchange="return get_class_sections(this.value);" id="class_id" class="form-control" required="">
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
          
            
            
            
<div class="col-md-2">            
<div class="form-group">
     <label class="control-label" style="margin-bottom: 5px;">Section:<font color="#FF0000">*</font> </label>
        <select name="section_id" class="form-control selectboxit" required="" id="section_selector_holder" required=""  >
        </select>
    </div>
</div>
   
<div class="col-md-2"> 
<div class="form-group">
    <label class="control-label" style="margin-bottom: 5px;">From Date:</label>
       <input type="text" class="form-control" name="from_date" required="" id="from_date" value="<?php echo date('d-m-Y');?>"  />
    </div> 
</div>


<div class="col-md-2"> 
<div class="form-group">
   <label class="control-label" style="margin-bottom: 5px;">To Date:</label>
       <input type="text" class="form-control" name="to_date" required="" id="to_date" value="<?php echo date('d-m-Y');?>"  />
    </div> 
</div>

<div class="col-md-2">
<div class="form-group">
     <label class="control-label" style="margin-bottom: 5px;">By: </label>
       <select name="category" class="form-control selectboxit" id="category" onChange="return get_select(this.value)">
       <option value="">Select</option>
                              <option value="1">Total</option>
                           <!--   <option value="2">Hour Wise</option> --->
                              <option value="3">Subject Wise</option>
                              <option value="4">Student Wise</option>
                              <option value="5">All Subject</option>
        </select>
    </div>
</div>

<div class="col-md-2">
<div class="form-group">
   <label class="control-label" style="margin-bottom: 5px;">Select: </label>
        <select name="type" class="form-control selectboxit" id="type" >
         <option value="">Select</option>
        </select>
    </div>
</div>

    
   
   <div class="col-md-2" style="margin-top: 20px;">
        <a class="btn btn-info" name="btnView" onClick="view_attendance_report();send();">View Attendance Report</a>
   </div>
   
   <div class="col-md-1" style="margin-top: 20px;">
   </div>
   
   
        
        <div class="col-md-12" id='show_attendance_report' style="margin-top: 20px;" ></div>  
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
    $(document).ready(function () {
        $('#from_date').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	
 </script>	
 
 <script type="text/javascript">
    $(document).ready(function () {
        $('#to_date').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	
 </script>	

<script type="text/javascript">
	function get_select() 
	{
		var category = $('#category').val();
		var branch_id = $('#branch').val();
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
		
		//alert(category);
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/get_select/' + category+'/'+branch_id+'/'+class_id+'/'+section_id,
            success: function(response)
            {
                jQuery('#type').html(response);
			}
        });
    }
</script>

<script type="text/javascript">
	function view_attendance_report() 
	{
		var branch_id = $('#branch').val();
		var dept_id = $('#department').val();
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		var category = $('#category').val();
		var category_id = $('#type').val();
		
		
		//alert(category_id);
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Hourly_attendance/view_attendance_report/' + branch_id +'/'+dept_id+'/'+class_id+'/'+section_id+'/'+from_date+'/'+to_date+'/'+category+'/'+category_id,
            success: function(response)
            {
                jQuery('#show_attendance_report').html(response);
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
    }
</script>
<script>
$('#category').on('change', function(){
if($(this).val()==='1' || $(this).val()==='5'){
    $('#type').attr('disabled', 'disabled');
}else{
    $('#type').attr('disabled', false);
}
});	
</script>

				
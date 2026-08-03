<?php 

	include_once APPPATH . 'views/class_teacher_head.php';

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
							<li class="active">Students</li>
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
									 View
								</small>
							</h1>
						</div>             
   


            <?php  echo form_open(base_url() . 'index.php/Hourly_attendance/hourly_attendance_2' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
            
          
 
		
				<?php
				$user_id	=	$this->session->userdata('login_user_id'); 
				$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
				?>
                <input type="hidden" id="teacher_id" value="<?php echo $teacher_id;?>"  />
		
    
		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class:</label>
    <div class="col-sm-9">
			<select  name="class_id"  onchange="get_class_sections(this.value);" id="class_id" class="select2">
				<option value="">Select</option>
                <?php 
				/*$this->db->select('c.class_id,c.name as class_name');
				$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
				$this->db->where('st.teacher_id',$teacher_id);
				$this->db->where('sec.teacher_id',$teacher_id);
				$this->db->where('c.academic_year',$this->session->userdata('academic_year'));
				$this->db->join('subject_teacher st','c.class_id=st.class_id','LEFT');
				$this->db->join('section sec','sec.class_id=c.class_id','LEFT');
				$this->db->group_by('c.class_id');
				$this->db->order_by('c.name','ASC');*/
				
				$user_id = $this->session->userdata('login_user_id');
                                $yr=get_running_year();
				$this->db->select('e.section_id,e.name as section_name,c.class_id,c.name as class_name');
				$this->db->from('staff s');
				$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
				$this->db->join('class c','c.class_id=e.class_id','LEFT');
				$this->db->where('s.user_id',$user_id);
				$this->db->where('e.academic_year',$yr);
				$class1 = $this->db->get()->result_array();
				foreach($class1 as $data){?>
                <option value="<?php echo $data['class_id']?>"><?php echo $data['class_name']?></option>
                <?php } ?>
			</select><?php // echo $this->db->last_query(); ?>
		</div>
	</div>
          
              
    
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section: </label>
    <div class="col-sm-9">
        <select name="section_id" class="select2" required="" id="section_selector_holder"  >
        </select>
    </div>
</div>
 


 <div class="form-group">
   
    <div class="col-sm-offset-3 col-sm-5">
        <a class="btn btn-info" name="btnView" onClick="view_students_list()">View Students</a>
       
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
            url: '<?php echo base_url();?>index.php/Class_teacher/get_class_teacher_section/' + class_id ,
            success: function(response)
            {
				//alert(response);
                jQuery('#section_selector_holder').html(response);
			}
        });
    }
</script>

<script type="text/javascript">

	function view_students_list() 
	{
		
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
		//alert(class_id);
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Class_teacher/view_students_list/' + class_id +'/'+section_id,
            success: function(response)
            {
                jQuery('#show_students_list').html(response);
			}
        });
    }
	
</script>

  <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','250px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>        
        

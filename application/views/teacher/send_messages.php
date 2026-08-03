<?php 

	include_once APPPATH . 'views/teacher_head.php';

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
							<li class="active">Send Messages</li>
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
								Send Messages
							</h1>
						</div>             
   


            <?php  echo form_open(base_url() . 'index.php/Teacher/teacher_send_messages' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
			$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$this->session->userdata('login_user_id')))->row()->staff_id;
			?>
            
 
		
				<?php
				$user_id	=	$this->session->userdata('login_user_id'); 
				$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
				?>
                <input type="hidden" id="teacher_id" value="<?php echo $teacher_id;?>"  />
		
		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class:</label>
    <div class="col-sm-9">
			<select  name="class_id"  onchange="get_class_sections(this.value);" id="class_id" class="col-xs-10 col-sm-5">
				<option value="">Select</option>
                <?php 
                                $yr=get_running_year();
				$this->db->select('c.class_id,c.name as class_name');
				$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
				$this->db->where('st.teacher_id',$teacher_id);
				$this->db->where('c.academic_year',$yr);
				$this->db->join('subject_teacher st','c.class_id=st.class_id','LEFT');
				$this->db->group_by('c.class_id');
				$this->db->order_by('c.name','ASC');
				
				$class1=$this->db->get_where('class c')->result_array();
				foreach($class1 as $data){?>
                <option value="<?php echo $data['class_id']?>"><?php echo $data['class_name']?></option>
                <?php } ?>
			</select><?php // echo $this->db->last_query(); ?>
		</div>
	</div>
          
              
    
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section: </label>
    <div class="col-sm-9">
        <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_selector_holder" onchange="get_class_students(this.value);get_teacher_subjects(this.value);"  >
        </select>
    </div>
    </div>
 
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Subject: </label>
    <div class="col-sm-9">
        <select name="subject_id" class="col-xs-10 col-sm-5" required="" id="subject_id" onchange=""  >
        </select>
    </div>
    </div>
 
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student: </label>
    <div class="col-sm-9" id="students_list">

    </div>
    </div>
    <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Message: </label>
    <div class="col-sm-9">
        <textarea name="message" style="width:310px;height:200px" required></textarea>
    </div>
    </div>
 

 <div class="form-group">
   
    <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" name="send" class="btn btn-info">Send</button>
       
    </div>
    </div>
 
     <?php echo form_close();?>
                </div></div></div>                   
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Class_teacher/get_teacher_class_section/' + class_id ,
            success: function(response)
            {
				//alert(response);
                jQuery('#section_selector_holder').html(response);
			}
        });
    }
</script>

<script type="text/javascript">

	function get_class_students() 
	{
		
		var class_id = $('#class_id').val();
		var section_id = $('#section_selector_holder').val();
    	$.ajax({
        url: '<?php echo base_url();?>index.php/Class_teacher/get_students_list/' + class_id +'/'+section_id,
            success: function(response)
            {
                jQuery('#students_list').html(response);
			}
        });
    }
	function get_teacher_subjects(section_id)
	{
		var teacher_id	=	<?php echo $teacher_id; ?>;
		var class_id	=	$('#class_id').val();
		//alert(section_id);
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/teacher/get_teacher_subjects/' + class_id + '/' + section_id + '/' + teacher_id ,
			
            success: function(response)
            {
				//alert(response);
                jQuery('#subject_id').html(response);
            }
			});
	}
</script>

<script>
var values = $("#students_id[]>option").map(function() { return $(this).val(); }).get();
	document.getElementById('student[]').value=values;

</script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('Message Send', {timeOut: 5000})</script>";
}
else if($action=="failed")
{
echo "<script>toastr.error('Message Not Send', {timeOut: 5000})</script>";
}
?>

<?php include_once APPPATH . 'views/teacher_head.php';?>

<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php  $teacher=$this->session->userdata('login_user_id');
$this->db->where('user_id',$teacher);
$user=$this->db->get('tbl_users')->row();
 $branch_id=$user->branch_id;
$dept_id=$user->dept_id;?>
 
<br><br>
    <div class="col-md-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <font color="white"><?php echo get_phrase('Study-Material'); ?></font>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/teacher/study_material/create/'.$teacher, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
             
<?php $teacher=$this->session->userdata('login_user_id');?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" id="field-1" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-5">
                        <textarea name="description" class="form-control" id="field-ta"></textarea>
                    </div>
                </div>
				<?php
				$user_id	=	$this->session->userdata('login_user_id'); 
				$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
				?>
                <input type="hidden" id="teacher_id" value="<?php echo $teacher_id;?>"  />
                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?></label>
			
                    <div class="col-sm-5">
                        <select name="class_id" class="select2" onchange="get_class_subject(this.value)">
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
				
				$class=$this->db->get_where('class c')->result_array();
				foreach ($class as $row1):
				?>
				<option value="<?php echo $row1['class_id'];?>"><?php echo $row1['class_name'];?></option>
				<?php endforeach;?>
				
			</select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="select2" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('File'); ?></label>

                    <div class="col-sm-5">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search'); ?>" />

                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('File-Type'); ?></label>

                    <div class="col-sm-5">
                        <select name="file_type" class="select2">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <option value="pdf"><?php echo get_phrase('Pdf'); ?></option>
                            <option value="excel"><?php echo get_phrase('Excel'); ?></option>
                            <option value="other"><?php echo get_phrase('Other'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 control-label col-sm-offset-2">
                    <button type="submit" class="btn btn-success"><?php echo get_phrase('Send'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function get_class_subject(class_id) {
	
	var teacher_id	=	document.getElementById('teacher_id').value;
	//alert(section_id);
	//alert(class_id+'/'+section_id+'/'+teacher_id);
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/teacher/get_teacher_subjects1/' + class_id  +'/'+ teacher_id,
			async: true,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','440px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>        

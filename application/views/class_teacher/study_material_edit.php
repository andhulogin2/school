<?php include_once APPPATH . 'views/class_teacher_head.php';?>
<?php

$single_study_material_info = $this->db->get_where('document', array('document_id' => $id))->result_array();
foreach ($single_study_material_info as $row) {
    ?>
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
							<li class="active">Study Meterial</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Study Meterial
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Edit
								
							</h1>
						</div>

                <div class="panel-body">
                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php/class_teacher/study_material/update/<?php echo $row['document_id'] ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Date</label>

                            <div class="col-sm-5">
                                <input type="text" name="timestamp" class="form-control mydatepicker"
                                       placeholder="date here" value="<?php echo date("d-m-Y", $row['timestamp']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Title</label>

                            <div class="col-sm-5">
                                <input type="text" name="title" class="form-control" id="field-1" value="<?php echo $row['title']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-5">
                                <textarea name="description" class="form-control"
                                          id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>
						<?php
                        $user_id	=	$this->session->userdata('login_user_id'); 
                        $teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
                        ?>
                <input type="hidden" id="teacher_id" value="<?php echo $teacher_id;?>"  />
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Class</label>

                            <div class="col-sm-5">
                                <select name="class_id" class="form-control selectboxit" id="class_id" onchange="return get_class_subject(this.value)">
                                    <option value=""><?php echo get_phrase('Select'); ?></option>
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
									foreach ($class as $row2):
									?>
                                        <option value="<?php echo $row2['class_id']; ?>" <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                            <?php echo $row2['class_name']; ?>
                                        </option>
                                    <?php 
									endforeach;
									?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">Subject</label>
                            <div class="col-sm-5">
                                <select name="subject_id" class="form-control" id="subject_selector_holder">
                                   <?php
									$this->db->where('st.class_id',$row['class_id']);
									$this->db->where('st.teacher_id',$teacher_id);
									$this->db->select('s.name as subject_name,s.subject_id');
									$this->db->join('subject s','s.subject_id=st.subject_id');
									$subject = $this->db->get('subject_teacher st')->result_array();
                                   //$subject = $this->db->get_where('subject',array('class_id'=>$row['class_id']))->result_array();
                                   foreach ($subject as $row2){
                                   ?>
                                    <option value="<?php echo $row2['subject_id']; ?>" <?php if ($row['subject_id'] == $row2['subject_id']) echo 'selected'; ?>>

                                            <?php echo $row2['subject_name']; ?>
                                        </option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('File'); ?></label>

                    <div class="col-sm-5">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search'); ?>" />

                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('File-Type'); ?></label>

                    <div class="col-sm-5">
                        <select name="file_type" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <option value="pdf"><?php echo get_phrase('Pdf'); ?></option>
                            <option value="excel"><?php echo get_phrase('Excel'); ?></option>
                            <option value="other"><?php echo get_phrase('Other'); ?></option>
                        </select>
                    </div>
                </div>

                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function get_class_subject(class_id) {
	var teacher_id	=	document.getElementById('teacher_id').value;
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/Class_teacher/get_teacher_subjects1/' + class_id  +'/'+ teacher_id,
			async: true,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
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
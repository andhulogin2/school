<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">News</li>
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
								News
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								</small>
							</h1>
						</div>

<?php $class_info = $this->db->get('class')->result_array(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title" ><font color="white">Send-Homework</font></div>
            </div>
            <br><br>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/homework/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="Required" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content" ></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Last-day-delivery</label>

                    <div class="col-sm-8">
                            <input type="text" class="form-control mydatepicker" name="time_end"  value="" >
                    </div>
                </div>

                <div class="form-group">
                
                    <label for="field-1" class="col-sm-3 control-label">Class</label>

                    <div class="col-sm-8">
                        <select name="class_id" class="form-control selectboxit" id="class_id" onchange="get_class_subject(this.value); get_class_sections(this.value);">
                            <option value="">Select</option>
                            <?php foreach ($class_info as $row) { ?>
                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">Section</label>
                            <div class="col-sm-8">
                                <select name="section_id" class="form-control" id="section_selector_holder">
                                    <option value="">Select-Class</option>
                                </select>
                            </div>
                    </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label">Subject</label>
                    <div class="col-sm-8">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value="">Select-Class</option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label">File</label>

                    <div class="col-sm-8">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Search" />

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                         Send</button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>



<script type="text/javascript">
    function get_class_sections(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  
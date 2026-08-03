<?php include_once APPPATH . 'views/staff_head.php';?>
<?php
$class_info = $this->db->get('class')->result_array();
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

                <div class="panel-body">
                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php/staff/study_material/update/<?php echo $row['document_id'] ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Date</label>

                            <div class="col-sm-5">
                                <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                       placeholder="date here" value="<?php echo date("d M, Y", $row['timestamp']); ?>">
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

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Class</label>

                            <div class="col-sm-5">
                                <select name="class_id" class="form-control selectboxit" id="class_id" onchange="return get_class_subject(this.value)">
                                    <option value=""><?php echo get_phrase('Select'); ?></option>
                                    <?php foreach ($class_info as $row2) { ?>
                                        <option value="<?php echo $row2['class_id']; ?>" <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">Subject</label>
                            <div class="col-sm-5">
                                <select name="subject_id" class="form-control" id="subject_selector_holder">
                                   <?php
                                   $subject = $this->db->get_where('subject',array('class_id'=>$row['class_id']))->result_array();
                                   foreach ($subject as $row2){
                                   ?>
                                    <option value="<?php echo $row2['subject_id']; ?>" <?php if ($row['subject_id'] == $row2['subject_id']) echo 'selected'; ?>>

                                            <?php echo $row2['name']; ?>
                                        </option>
                                   <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <button type="submit" class="btn btn-success">Update</button>
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
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/staff/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>
<?php include_once APPPATH . 'views/head.php';?>

<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php $teacher=$this->session->userdata('login_user_id');?>
 
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
							<li class="active">Study Material</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Study Material
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add
								
							</h1>
						</div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/study_material/create/'.$teacher, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
             
<?php $teacher=$this->session->userdata('login_user_id');?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title'); ?><font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" id="field-1" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-5">
                        <textarea name="description" class="form-control" id="field-ta"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="form-control selectboxit" id="class_id" onchange="return get_class_subject(this.value)" required="">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <?php foreach ($class_info as $row) { ?>
                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('File'); ?>:<font color="#FF0000">*</font></label>

                    <div class="col-sm-5">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search'); ?>"  required=""/>

                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('File-Type'); ?></label>

                    <div class="col-sm-5">
                        <select name="file_type" class="form-control selectboxit">
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
</div>

<?php include_once APPPATH . 'views/footer.php'; ?>

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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>
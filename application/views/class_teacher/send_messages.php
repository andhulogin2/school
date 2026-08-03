<?php include_once APPPATH . 'views/class_teacher_head.php';?>
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
							<li class="active">Messages</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
						
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								<i class="ace-icon fa fa-angle-double-right"></i>
									 Send Messages
								
							</h1>
							<div align="right"><a href="<?php echo base_url(); ?>index.php/Class_teacher/student_view_subject"><button class="btn-info">Back</button></a></div>
						</div>

<?php echo form_open(base_url() . 'index.php/Class_teacher/submit_message'); ?>

<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
        <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-12">
				<label class="control-label" style="margin-bottom: 5px;">Message</label><br />
				<textarea name="message" style="width:500px;height:200px"></textarea>
			</div>
		</div>

        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" >Submit</button>
			</center>
		</div>
	</div>
 </div>
<?php echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

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

<?php include_once APPPATH . 'views/student_head.php';?>
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
								Messages
							</h1>
							<div align="right"><a href="<?php echo base_url(); ?>index.php/Student/view_message"><i class="fa fa-arrow-left">Back</i></a></div>
						</div>

<?php foreach($message_data as $message)
{
?>
<div style="margin-left:15px;margin-right:15px;">
        <div class="form-group">
		<div class="col-md-12">
				<label class="control-label" style="margin-bottom: 5px;">Message</label><br />
				<textarea name="message" style="width:400px;height:150px" readonly="readonly" ><?php echo $message['message']; ?></textarea>
			</div>
		</div>
		<div class="col-md-12">
            <input type="text" value="<?php echo date('d/m/Y H:i A', strtotime($message['date_time'])); ?>" readonly="readonly"] />
        </div>
</div>
<?php } ?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>


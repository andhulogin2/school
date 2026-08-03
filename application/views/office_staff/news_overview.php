<?php include_once APPPATH . 'views/office_staff_head.php';?>
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
							<li class="active">Admission</li>
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
								News
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Overview
								
							</h1>
						</div>





<?php  $current_news = $this->db->get_where('news' , array('news_code' => $news_code))->result_array();
	foreach ($current_news as $row):
	
	
?>
<div class="col-md-12">
    <div class="panel panel-success" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title"><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $row['title']."(".$row['news_status'].")";?></font></div>
        </div>
        <div class="panel-body">
		<span class="label label-xlg label-yellow arrowed arrowed-right" style="width:100px"><font color="#000000">Details</font></span><br />
<br />
                <p>
        <?php echo $row['description'];?></p>
        <?php if (file_exists('uploads/news_image/' . $news_code . '.jpg')): ?>
                    <img src="<?php echo $this->crud_model->get_image_url('news', $row['news_code']); ?>" class="img-responsive" height="100px" width="600px"/>
                <?php endif; ?>
        <hr/>
            <p>
                <?php 
                $status = 'info';
                //if ($row['progress_status'] == 100)$status = 'success';
                //if ($row['progress_status'] < 50)$status = 'danger';
                ?>
            </p>
        </div>
    </div>
    <div class="message_container">
        <div class="panel panel-warning" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                <font color="white">Comment</font>
                </div>
</div>          
<div class="panel-body">                
        <?php echo form_open(base_url() . 'index.php/office_staff/news_message/add/' . $news_code, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-submit', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea class="form-control autogrow" rows="3" placeholder="Write-Comment.." name="message" required></textarea>
                        </div>
                            <button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                Comment
                            </button> 
                    </div>
                <?php echo form_close(); ?>
                <hr/>
                <?php
                    $this->db->order_by('news_message_id' , 'desc'); 
                    $news_messages = $this->db->get_where('mensaje_reporte' , array(
                        'news_id' => $row['news_id']
                    ))->result_array();
                    foreach ($news_messages as $row2):
                ?>
                <div class="alert alert-default" style="position:relative; padding:15px 15px 20px 15px;">
                <img src="<?php echo $this->crud_model->get_image_url($row2['user_type'], $row2['user_id']); ?>" alt="" class="img-circle" width="30">
                   

                    <span style="color:#777;">
                        <?php echo $row2['message'];?>
                    </span>
                    <?php if ($row2['message_file_name'] != ''):?>
                
                    <?php endif;?>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        </div>
</div>
<?php endforeach;?>
</div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
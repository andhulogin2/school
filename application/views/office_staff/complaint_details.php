<?php include_once APPPATH . 'views/main_head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10">
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
							<li class="active">Complaints Remark</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Complaints
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Remark
								
							</h1>
						</div>

                  <font color="black">Remark</font>
                
<div class="panel-body">                
        <?php echo form_open(base_url() . 'index.php/admin/complaint_remark/create/' . $report_code, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-submit')); ?>
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea class="form-control autogrow" rows="3" name="remark"  id="remark" placeholder="Write.."></textarea>
                        </div>
                            <button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                Save
                            </button> 
                    </div>
                <?php echo form_close(); ?>
                </div>
                </div>
                </div></div>
    <?php include_once APPPATH . 'views/footer.php'; ?>
   
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
							<li class="active">Attendance</li>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance
								
							</h1>
						</div>
             
    <?php echo form_open(base_url() . 'index.php/admin/teacher_attendance_selector/');?>

<div class="widget-body">
													<div class="widget-main">
														<div>
															<label for="form-field-mask-1" style="padding-left:30px;">
																<b>Date</b>
																
															</label>

															<!-- #section:plugins/input.masked-input -->
															<div class="input-group col-md-3" style="padding-left:30px;">
																<input class="form-control  mydatepicker" style="width:300px; height:40px;" type="text" id="form-field-mask-1" name="timestamp" value="<?php echo date('d/m/Y'); ?>"/>
                                                                <input type="hidden" name="year" value="<?php echo $running_year;?>">
																<span class="input-group-btn">
																	<button type="submit" class="btn">
																		<i class="ace-icon fa fa-calendar bigger-110"></i>
																		View
																	</button>
																</span>
															</div>
                                                            <?php echo form_close();?>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div></div></div>
                                                           <?php include_once APPPATH . 'views/footer.php'; ?>
														   
                                                           
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
	</script>                                                         
                                                           
                                                           
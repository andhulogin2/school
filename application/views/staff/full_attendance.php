<?php include_once APPPATH . 'views/staff_head.php';?>
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
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance
								</small>
							</h1>
						</div>
             
    <?php echo form_open(base_url() . 'index.php/staff/full_attendance_selector/');?>

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
<?php $role=$this->session->userdata('role');
 	include_once APPPATH . 'views/main_head.php';
 ?>
 

<body>
        
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
							<li class="active">Set Class Timing</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div>
                        
                        <!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>Set Class Timing<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								</small>
							</h1>
						</div>  
				 
                     <?php echo form_open('Hourly_attendance/save_class_timing/', array('class' => 'form-horizontal'));?>

<div class="row">
    <div class="col-md-12">
    <div class="white-box">
		<div class="row" style="padding-left:100px;">
		</div>
 <div>
          <table id="simple-table" class="table table-striped table-bordered table-hover ">
                <tr>
                    <th style="text-align: center;" class="table-header">No.</th>
                    <th style="text-align: center;" class="table-header">Timing Name</th>
                    <th style="text-align: center;" class="table-header">Start Time </th>
                    <th style="text-align: center;" class="table-header">End Time</th>
                </tr>
                    <?php
					 $count=1;
                    foreach ($class_timing as $timing){
                     ?>
                        <tr>
                            <td><?php echo $count++; ?>
                            <input type="hidden" name="timing_id[]" value="<?php echo $timing['class_timing_details_id']; ?>" />
                            </td>
                            <td><?php echo $timing['timing_name']; ?></td>
                            <td><input type="text" name="start_time[]" id="start_time[]" value="<?php echo $timing['start_time']; ?>" /> </td>
                            <td><input type="text" name="end_time[]" id="end_time[]" value="<?php echo $timing['end_time']; ?>" /> </td>
                        </tr>
                    <?php } ?>
            </table>
									
                    <div class="col-md-offset-3 col-md-9">
                         <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
									   </div>
                                        
									</div>
      </div>
                                    </div>
                                    <?php echo form_close(); ?>
									</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
	echo "<script>toastr.success('". "Week Day Updated Successfully..', 'Updation', {timeOut: 5000})</script>";
else if($action=="failed")
	echo "<script>toastr.error('". "Week Day Updation Failed..', 'Error', {timeOut: 5000})</script>";
?>
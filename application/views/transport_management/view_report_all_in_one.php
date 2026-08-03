<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">Bus Fee Reports</li>
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
								Report 
									<i class="ace-icon fa fa-angle-double-right"></i>
									All In One Report
							</h1>
						</div><!-- /.page-header -->
                                        <div></div>
<?php // echo form_open(base_url() . 'index.php/Transport_management/get_bus_fee_all_in_one',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					

 <?php //if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   //{?>
                       <?php  $role=$this->session->userdata('role');
if($role>0)
{?>
        <div class="form-group" id="dept_role">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Report Type :<font color="#FF0000">*</font></label>
        
            <div class="col-sm-9">
                <select name="report_type" class="col-xs-10 col-sm-5" id="report_type" required >
                	<option value="">Select</option>
              		<option value="student_report">Student Report</option>
                    <option value="fee_report">Fee Report</option>
                    <option value="vehicle_report">Vehicle Report</option>  
                    <option value="vehicle_tax_due_report">Vehicle Tax Due Report</option>  
                    <option value="vehicle_insurance_due_report">Vehicle Insurance Due Report</option>  
                    <option value="vehicle_pollution_due_report">Vehicle Pollution Due Report</option>  
                </select>
            </div>
        </div>
        <div id="select_items">
		</div>
                                    <?php }//} ?>
                                    
                                    
                                   <?php /*  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="bus_number" class="col-xs-10 col-sm-5" id="bus_number" required >
                              					<option value="">Select</option>
                          						<?php 
												foreach($bus as $bus1):
												?>
                                                <option value="<?php echo $bus1['bus_number'] ?>"><?php echo $bus1['bus_number'] ?></option>
                                                <?php 
												endforeach;
												?>
                          					</select>
										</div>
									</div>
                                    <?php } */?>
                                    
<?php // echo form_close();?>
                        </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>                                                         
<script type="text/javascript">
$(document).ready(function(){
	get_report_types($( "#report_type" ).val());
    $( "#report_type" ).change(function() {
		get_report_types($( "#report_type" ).val());
    });
});
function get_report_types(report_type)
{
	var report_type	=	report_type;
		$.ajax({
			url: '<?php echo base_url();?>index.php/Transport_management/get_report_student/' +report_type ,
			success: function(response)
			{
				jQuery('#select_items').html(response);
			}
		});
} 
</script>

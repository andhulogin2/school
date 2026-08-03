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
							<li class="active">All In One Report</li>
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
					<?php echo form_open_multipart('Transport_management/pdf_report_vehicle_single/'.$vehicle_master_id, array('target' => '_blank','class' => 'form-horizontal','id'=>"myform"));?>	
                        <div class="page-header">
							<h1>
								Report 
									<i class="ace-icon fa fa-angle-double-right"></i>
									Single Vehicle Report
							</h1>
                            
						</div><!-- /.page-header -->
                        
                                        <div style="text-align:center"><button type="submit" class="btn-info">Download</button></div>
					
					<div class="table-responsive" align="center" style="padding-left:20px;padding-right:20px;">
                    	<table class="table table-hover" style="border:1px solid #E3E3E6;width:50%">
                        	<?php
								foreach($result as $details):
							?>
                            	<tr class="table-header" style="background-color: #4A86CE;">
                                	<th colspan="2" style="text-align:center">Basic Details</th>
                                </tr>
                                <tr>
                                	<td style="border:0px;width:50%;">Registration Number</td>
                                	<td style="border:0px;">:<?php echo $details['vehicle_registration_number']; ?></td>
                                </tr>
                                <tr>
                                	<td style="border:0px;width:50%;">Registration Date</td>
                                	<td style="border:0px;">:<?php 	if($details['registration_date']=='0000-00-00'){echo "";}
																	else{echo date('d-m-Y',strtotime($details['registration_date']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Owner Name</td>
                                	<td style="border:0px;">:<?php echo $details['owner_name']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;width:50%;">Ownership Type</td>
                                	<td style="border:0px;">:<?php echo $details['ownership_type']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Vehicle Class</td>
                                	<td style="border:0px;">:<?php echo $details['vehicle_class_name']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;width:50%;">Vehicle Maker</td>
                                	<td style="border:0px;">:<?php echo $details['vehicle_maker_name']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Vehicle Category</td>
                                	<td style="border:0px;">:<?php echo $details['vehicle_category_name']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Seat Capacity</td>
                                	<td style="border:0px;">:<?php  if($details['seat_capacity']=='0'){echo "";}
																	else{echo $details['seat_capacity'];} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;width:50%;">Year of Manufacture</td>
                                	<td style="border:0px;">:<?php  if($details['year_of_manufacture']=='0'){echo "";}
																	else{echo $details['year_of_manufacture'];}; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Month of Manufacture</td>
                                	<td style="border:0px;">:<?php echo $details['month_of_manufacture']; ?></td>
                                </tr>
                                <tr class="table-header" style="background-color: #4A86CE;">
                                	<th colspan="2" style="text-align:center">Details of Tax Paid</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Tax Licence Number</td>
                                	<td style="border:0px;">:<?php echo $details['tax_licence_number']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid On</td>
                                	<td style="border:0px;">:<?php 	if($details['tax_paid_on']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['tax_paid_on']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid From</td>
                                	<td style="border:0px;">:<?php 	if($details['tax_paid_from']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['tax_paid_from']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid To</td>
                                	<td style="border:0px;">:<?php 	if($details['tax_paid_to']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['tax_paid_to']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Amount</td>
                                	<td style="border:0px;">:<?php echo $details['tax_amount']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid Office</td>
                                	<td style="border:0px;">:<?php echo $details['tax_paid_office']; ?></td>
                                </tr>
                                <tr class="table-header" style="background-color: #4A86CE;">
                                	<th colspan="2" style="text-align:center">Details of Insurance Paid</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Insurance Policy Number</td>
                                	<td style="border:0px;">:<?php echo $details['insurance_policy_number']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid From</td>
                                	<td style="border:0px;">:<?php  if($details['insurance_date_from']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['insurance_date_from']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid To</td>
                                	<td style="border:0px;">:<?php  if($details['insurance_date_to']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['insurance_date_to']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Insurance Type</td>
                                	<td style="border:0px;">:<?php echo $details['insurance_type']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Amount</td>
                                	<td style="border:0px;">:<?php echo $details['insurance_amount']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Insurance Company</td>
                                	<td style="border:0px;">:<?php echo $details['insurance_company']; ?></td>
                                </tr>
                                <tr class="table-header" style="background-color: #4A86CE;">
                                	<th colspan="2" style="text-align:center">Details of Pollution Test</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Date of Test</td>
                                	<td style="border:0px;">:<?php  if($details['date_of_test']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['date_of_test']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Status</td>
                                	<td style="border:0px;">:<?php echo $details['status']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Valid Upto</td>
                                	<td style="border:0px;">:<?php  if($details['valid_upto']==''){echo "";} 
																	else{echo date('d-m-Y',strtotime($details['valid_upto']));} ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Amount</td>
                                	<td style="border:0px;">:<?php echo $details['amount']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Tested From</td>
                                	<td style="border:0px;">:<?php echo $details['test_done_from']; ?></td>
                                </tr>
							<?php
								endforeach;
							?>            
                        </table> 
                    </div>
					<?php
					echo form_close();
				?>    
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

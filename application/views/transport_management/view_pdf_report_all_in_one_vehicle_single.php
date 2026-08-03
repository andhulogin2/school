<head>
	<title>VEHICLE REPORT</title>
</head>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div style="text-align:center"><span><h2>SINGLE VEHICLE REPORT</h2></span></div>
                <br/> 
				<?php
					if(count($result)>0)
					{
					?>
                <br/> 
                <div class="table-responsive" style="text-align:center;padding-left:20px;padding-right:20px;">
                    	<table align="center" class="table table-hover" style="border:1px solid #E3E3E6;width:70%">
                        	<?php
								foreach($result as $details):
							?>
                            	<tr class="table-header" style="background-color: #87B5E2;">
                                	<th colspan="2" style="text-align:center">Basic Details</th>
                                </tr>
                                <tr>
                                	<td style="border:0px;width:50%;">Registration Number</td>
                                	<td style="border:0px;">:<?php echo $details['vehicle_registration_number']; ?></td>
                                </tr>
                                <tr>
                                	<td style="border:0px;width:50%;">Registration Date</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['registration_date'])); ?></td>
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
                                	<td style="border:0px;">:<?php echo $details['seat_capacity']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;width:50%;">Year of Manufacture</td>
                                	<td style="border:0px;">:<?php echo $details['year_of_manufacture']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Month of Manufacture</td>
                                	<td style="border:0px;">:<?php echo $details['month_of_manufacture']; ?></td>
                                </tr>
                                <tr class="table-header" style="background-color: #87B5E2;">
                                	<th colspan="2" style="text-align:center">Details of Tax Paid</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Tax Licence Number</td>
                                	<td style="border:0px;">:<?php echo $details['tax_licence_number']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid On</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['tax_paid_on'])); ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid From</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['tax_paid_from'])); ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid To</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['tax_paid_to'])); ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Amount</td>
                                	<td style="border:0px;">:<?php echo $details['tax_amount']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid Office</td>
                                	<td style="border:0px;">:<?php echo $details['tax_paid_office']; ?></td>
                                </tr>
                                <tr class="table-header" style="background-color: #87B5E2;">
                                	<th colspan="2" style="text-align:center">Details of Insurance Paid</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Insurance Policy Number</td>
                                	<td style="border:0px;">:<?php echo $details['insurance_policy_number']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid From</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['insurance_date_from'])); ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Paid To</td>
                                	<td style="border:0px;">:<?php echo  date('d-m-Y',strtotime($details['insurance_date_to'])); ?></td>
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
                                <tr class="table-header" style="background-color: #87B5E2;">
                                	<th colspan="2" style="text-align:center">Details of Pollution Test</th>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Date of Test</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['date_of_test'])); ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Status</td>
                                	<td style="border:0px;">:<?php echo $details['status']; ?></td>
                                </tr>
                            	<tr>
                                	<td style="border:0px;">Valid Upto</td>
                                	<td style="border:0px;">:<?php echo date('d-m-Y',strtotime($details['valid_upto'])); ?></td>
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
                </div>
                </div>
                <?php
				}
					else
					{
					?>
					<table id="simple-table" class="table table-hover"  cellpadding="2" style="border:1px solid #CCCCCC;margin-bottom:1px;">
                    <tbody>
                    	<tr>
                        	<td><center><b style="color:#FF0000">No results found</b></center></td>
                        </tr>
                    </tbody>
                    </table>
					<?php
                    }
				?>                    
            </div>
        </div>
    </div>

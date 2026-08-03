<?php
if($report_type=='vehicle_tax_due_report' || $report_type=='vehicle_insurance_due_report' || $report_type=='vehicle_pollution_due_report')
{
	
}
/*echo "<pre>";
print_r($result);
echo "</pre>";*/
/*	$data['result']		=	$result;			// Set these data to session so that we can use it in the pdf_report_student() function in the controller
	$data['count']		=	$count;
	$data['student_id']	=	$student_id;
	$_SESSION["data"] = 	$data;*/
/*echo "<pre>";
print_r($result);
echo "</pre>";
die();*/
?>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
            <?php echo form_open_multipart('Transport_management/pdf_report_student', array('target' => '_blank','class' => 'form-horizontal','id'=>"myform"));?>
                <br/> 
                <label><b> <?php // if($student_id == '' && count($result)>0 ){?> <?php // echo $count; }  ?></b></label>		
                <label><b> <?php  ?></b></label>
				<?php
					if(count($result)>0)
					{
					?>
                <button type="submit" style="float:right" class="btn-info">Download</button>
                <br/> 
                <br/>
               
                <div class="table-responsive">
                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="margin-bottom:1px;">
                    <thead>
                    	<tr style="background-color:#CCCCCC">
                        	<?php
							if($report_type=='vehicle_report')
							{
								if($route_master_id!='' || $route_register_id!='')
								{
								?>
								<th class='table-header'><center>Bus Number</center></th>
								<th class='table-header'><center>Route</center></th>
								<th class='table-header'><center>Driver</center></th>
								<th class='table-header'><center>Conductor</center></th>
								<?php
								}
							}
							?>
                        	<th class='table-header'><center>Registration Number</center></th>
                        	<th class='table-header'><center>Seat Capacity</center></th>
                        	<th class='table-header'><center>Ownership Type</center></th>
                        	<th class='table-header'><center>Owner Name</center></th>
                        	<th class='table-header'><center>Category</center></th>
                        	<th class='table-header'><center>Vehicle Class</center></th>
                        	<th class='table-header'><center>Vehicle Maker</center></th>
                        	<th class='table-header'><center>Year</center></th>
                        	<th class='table-header'><center>Tax Licence Number</center></th>
                        	<th class='table-header'><center>View</center></th>
						</tr>
                    </thead>
                    <tbody>
					<?php
						foreach($result as $value):
					?>
                        <tr>
                        	<?php
							if($report_type=='vehicle_report')
							{
								if($route_master_id!='' || $route_register_id!='')
								{
								?>
								<td><center><?php echo $value['bus_number']; ?></center></td>
								<td><center><?php echo $value['route_master_name']; ?></center></td>
								<td><center><?php echo $value['driver_name']; ?></center></td>
								<td><center><?php echo $value['conductor_name']; ?></center></td>
								<?php
								}
							}
							?>
                            <td><center><?php echo $value['vehicle_registration_number']; ?></center></td>
                            <td><center><?php echo $value['seat_capacity']; ?></center></td>
                            <td><center><?php echo $value['ownership_type']; ?></center></td>
                            <td><center><?php echo $value['owner_name']; ?></center></td>
                            <td><center><?php echo $value['vehicle_category_name']; ?></center></td>
                            <td><center><?php echo $value['vehicle_class_name']; ?></center></td>
                            <td><center><?php echo $value['vehicle_maker_name']; ?></center></td>
                            <td><center><?php echo $value['year_of_manufacture']; ?></center></td>
                            <td><center><?php echo $value['tax_licence_number']; ?></center></td>
                            <td><center>
										<?php echo anchor('Transport_management/view_single_vehicle_report/'.$value['vehicle_master_id'], '<i class="fa fa-eye"  title="View Details"></i>', array('target'=>'_blank'));?>
                            			</center></td>
                        </tr>    
							
                            <?php
						endforeach;
				?>	
                    </tbody>
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
					echo form_close();
				?>                    
            </div>
        </div>
    </div>

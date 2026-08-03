<?php
	$data['result']				=	$result;			// Set these data to session so that we can use it in the pdf_report_student() function in the controller
	$data['count']				=	$count;
	$data['student_id']			=	$student_id;
	$_SESSION["data"] 			= 	$data;
	
	$data1['report_type']		=	$report_type;		// Set these data to session and we need these data to print single student details
	$data1['branch_id']			=	$branch_id;			
	$data1['route_master_id']	=	$route_master_id;
	$data1['route_register_id']	=	$route_register_id;
	$data1['route_details_id']	=	$route_details_id;
	$data1['department_id']		=	$department_id;
	$data1['class_id']			=	$class_id;
	$data1['section_id']		=	$section_id;
	$data1['student_id']		=	$student_id;
	$data1['date_from']			=	$date_from;
	$data1['date_to']			=	$date_to;
	$data1['driver_id']			=	$driver_id;
	$_SESSION["data1"] 			= 	$data1;
	/*echo "<pre>";
	print_r($data);
	echo "</pre>";
	die();*/
?>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
            <?php echo form_open_multipart('Transport_management/pdf_report_student', array('target' => '_blank','class' => 'form-horizontal','id'=>"myform"));?>
                <br/> 
                <label><b> <?php if($student_id == '' && count($result)>0 ){?>Number of Students : <?php echo $count; }  ?></b></label>		
                <label><b> <?php  ?></b></label>
				<?php
					if(count($result)>0)
					{
					?>
                <button type="submit" style="float:right" class="btn-info">Download</button>
                <br/> 
                <br/> 
                <div class="table-responsive">
                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="border-color:#000000;margin-bottom:1px;">
                <thead>
                    <?php
						$prev_stud_id		=	"";
						foreach($result as $value):
							$curr_stud_id	=	$value['student_id'];
							if($prev_stud_id != $curr_stud_id)
							{
							?>
                    	<tr>
                        	<th class='table-header' colspan=""><b>Name :&nbsp;</b><?php echo $value['name']; ?></th>
                        	<th class='table-header' colspan=""><b>Class :&nbsp;</b><?php echo $value['class_name'].$value['section_name']; ?></th>
                            <th class='table-header' colspan=""><b>Department :&nbsp;</b><?php echo $value['dept_name']; ?></th>
                            <th class='table-header'><button type="submit" formaction="<?php echo base_url();?>index.php/Transport_management/pdf_report_single_student/<?php echo $value['student_id']; ?>" class="btn-info download_single" style="float:right">Download</button></th>
						</tr>
                        <tr>
                            <th style="background-color:#CCCCCC">Due Date</th>
                            <th style="background-color:#CCCCCC">Route</th>
                            <th style="background-color:#CCCCCC">Bus Number</th>
                            <th style="background-color:#CCCCCC">Pickup Point</th>
                        </tr>   
                     </thead>
                     <tbody> 
                            <?php
							}
							?>
                        <tr>
                            <td><?php echo date('d-m-Y',strtotime($value['due_date']))."(".$value['installment_name'].")"; ?></td>
                            <td><?php echo $value['route_master_name']; ?></td>
                            <td><?php echo $value['bus_number']; ?></td>
                            <td><?php echo $value['pickup_point']; ?></td>
                        </tr>
                         
                            <?php
							$prev_stud_id		=	$curr_stud_id;
							?>
				
                
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  
<script type="text/javascript">
/*$(document).ready(function(){
    $( ".download_single" ).click(function() {
		pdf_report_student($(this).attr("value"));
    });
});  
function pdf_report_student(student_id)
{
var student_id	=	student_id;	
alert(student_id);
	$.ajax({
		url: '<?php echo base_url();?>index.php/Transport_management/pdf_report_student/' + student_id ,
		success: function(response)
		{
			alert(response);
			//jQuery('#report').html(response);
		}
	});
}*/
</script>
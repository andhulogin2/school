<head>
	<title>STUDENT'S TRANSPORTATION REPORT</title>
</head>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div style="text-align:center"><span><h2>STUDENT'S TRANSPORTATION REPORT</h2></span></div>
                <br/> 
                <label><b> <?php if($student_id == '' && count($result)>0 ){?>Number of Students : <?php echo $count; }  ?></b></label>		
                <label><b> <?php  ?></b></label>
				<?php
					if(count($result)>0)
					{
					?>
                <br/> 
                <div class="table-responsive">
                <table width="100%" id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="border:1px solid;margin-bottom:1px;">
                <thead style="border:1px solid">
                    <?php
						$prev_stud_id		=	"";
						foreach($result as $value):
							$curr_stud_id	=	$value['student_id'];
							if($prev_stud_id != $curr_stud_id)
							{
							?>
                    	<tr style="background:#87B5E2;border:1px solid">
                        	<th class='table-header' colspan=""><b>Name :&nbsp;</b><?php echo $value['name']; ?></th>
                        	<th class='table-header' colspan=""><b>Class :&nbsp;</b><?php echo $value['class_name'].$value['section_name']; ?></th>
                            <th class='table-header' colspan=""><b>Department :&nbsp;</b><?php echo $value['dept_name']; ?></th>
                            <th class='table-header'></th>
						</tr>
                        <tr style="border:1px solid #000000">
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
                            <td><center><?php echo $value['bus_number']; ?></center></td>
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
				?>                    
            </div>
        </div>
    </div>

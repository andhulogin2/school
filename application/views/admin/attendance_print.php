<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= 	$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
    $month_name         =  $month; 
	
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	get_running_year();
?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
<div class="box-body" id="printableArea">

	<center>
		<img src="../../../uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		Attendance Report<br>
		class  :<?php  echo $class_name;?><br>
       section "<?php echo $section_name;?><br />
      Month

       <?php  if($month_name==1)
				{
				  echo "January";
				 }
				 else if($month_name==2)
				 {
				    echo "February";
				}
				else if($month_name==3)
				{
				  echo "March";
				}
				else if($month_name==4)
				{
				  echo "April";
				}
				else if($month_name==5)
				{
				  echo "May";
				}
				else if($month_name==6)
				{
				  echo "June";
				}
				else if($month_name==7)
				{
				  echo "July";
				}
				else if($month_name==8)
				{
				  echo "August";
				}
				else if($month_name==9)
				{
				  echo "September";
				}
				else if($month_name==10)
				{
				  echo "October";
				}
				else if($month_name==11)
				{
				  echo "November";
				}
				else if($month_name==12)
				{
				  echo "December";
				}
				?>
        
        

		</center>





 <?php if($this->db->get_where('settings',array('type'=>'afternoon_attendance'))->row()->description!='yes'): ?>
        
            
        
        
<center><p><i class="fa fa-check-circle" style="color: #00a651;"></i>Present &nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle" style="color: #ee4749;"></i> Absent &nbsp;&nbsp;&nbsp;<i class="fa fa-certificate" style="color: #fec42d;"></i> Late&nbsp;&nbsp;&nbsp; <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
              {
			  ?><i class="fa fa-pencil-square" style="color: #e81d26;"></i> No Diary <?php }?> </button></p>
                
                
                
                </center>
                <hr>
                <div class="table-responsive">
	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
                        <thead>
                            <tr>
                                <td style="text-align: center;">
                                    Students <i class="entypo-down-thin"></i> | Date <i class="entypo-right-thin"></i>
                                </td>
                                <?php
                               $year = explode('-', $running_year);
                                 $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
                                for ($i = 1; $i <= $days; $i++) {
                                    ?>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                <?php } ?>
                                <td style="text-align: center;">
                                    Present/Total
                                </td>
                                <td style="text-align: center;">
                                    Percentage
                                </td>
                               
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = array();
							$this->db->join('student s','s.student_id=e.student_id and s.student_status_id=0');
                            $students = $this->db->get_where('enroll e', array('e.class_id' => $class_id, 'e.year' => $running_year, 'e.section_id' => $section_id))->result_array();
                            foreach ($students as $row) {
                                $total = 0;
                                $present = 0;
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                                    </td>
                                   
                                    <?php
                                    for ($i = 1; $i <= $days; $i++) {
                                        $timestamp = strtotime($i . '-' . $month . '-' .$year1);
									
                                        $this->db->group_by('timestamp');
                                        $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();

                                        $status = 0;
                                        foreach ($attendance as $row2) {
                                            $month_dummy = date('d', $row2['timestamp']);

                                            if ($i == $month_dummy) {
                                                $status = $row2['status'];
                                            }
											 $timestamp= $row2['timestamp'];
                                        };
                                        ?>
                                         
                                        
                                        <td style="text-align: center;">
                                            <?php if ($status == 1) { ?>
                                                <i class="fa fa-check-circle" title="Present" data-toggle="tooltip" style="color: #00a651;"></i></i>
                                            <?php } if ($status == 2) { ?>
                                                <i class="fa fa-times-circle" title="Absent" data-toggle="tooltip" style="color: #ee4749;"></i>
                                            <?php } if ($status == 3) { ?>
                                                <i class="fa fa-certificate" title="Late" data-toggle="tooltip" style="color: #fec42d;"></i>
                                                <?php
                                            }
											 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                            {
			 
											if ($status == 4) { ?>
                                                <i class="fa fa-pencil-square" title="No Diary" data-toggle="tooltip" style="color: #e81d26;"></i>
                                                <?php
                                            }
											if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes')
											{
												if ($status == 5) { ?>
                                                	<i class="fa fa-adjust" aria-hidden="true" style="color:#FF7D94" title="Half Day" data-toggle="tooltip"></i>
													<?php
												}
											}
											}
                                            if (0 != $status) {
                                                $total++;
                                            }
											if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                                 {
                                                 if (1 == $status || 3 == $status || 4 == $status) {
                                                 $present++;
                                                 }
												if(5 == $status)
												{
													$present	=	$present+0.5;
												}
											}
											else{
											  if (1 == $status || 3 == $status) {
                                                $present++;
                                                }
												if(5 == $status)
												{
													$present	=	$present+0.5;
												}
												}
                                            ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <?php $m= $present . "/" . $total; 
										 echo $m;
										
										 ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if($total==0){
										echo "NA";
										$percentage='';
										}
										else{
                                        $percentage = round(($present / $total) * 100,2);
									echo $percentage;}

                                        ?>
                                    </td>
                                    <?php $student_id= $row['student_id'];
									                  
									?>
                                    <td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/attendance_messages/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $student_id;?>/<?php echo $present;?>/<?php echo $total;?>/<?php echo $percentage;?>/<?php echo $month;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF">Send SMS</font></a></td>
                                </tr>
                                
                            <?php } ?>
                            
                        </tbody>
                    </table>
</div>
    </div>
   <div style="padding-left:600px">
    <button class="btn" type="button" style="background-color:#009933; width:200px; height:30px"  onClick="printDiv('printableArea')"> 
				<font color="#FFFFFF">Print</font>
			</button>
            </div>
<?php else: ?>										
        
<center><p><i class="fa fa-check-circle" style="color: #00a651;"></i>Present &nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle" style="color: #ee4749;"></i> Absent &nbsp;&nbsp;&nbsp;<i class="fa fa-certificate" style="color: #fec42d;"></i> Late&nbsp;&nbsp;&nbsp; <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
              {
			  ?><i class="fa fa-pencil-square" style="color: #e81d26;"></i> No Diary <?php }?> </button></p>
                
                
                
                </center>
                <hr>
                <div class="table-responsive">
	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
                        <thead>
                            <tr>
                                <td style="text-align: center;">
                                    Students <i class="entypo-down-thin"></i> | Date <i class="entypo-right-thin"></i>
                                </td>
                                <td></td>
                                <?php
                               $year = explode('-', $running_year);
                                 $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
                                for ($i = 1; $i <= $days; $i++) {
                                    ?>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                <?php } ?>
                                <td style="text-align: center;">
                                    Present/Total
                                </td>
                                <td style="text-align: center;">
                                    Percentage
                                </td>
                               
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = array();
							$this->db->join('student s','s.student_id=e.student_id and s.student_status_id=0');
                            $students = $this->db->get_where('enroll e', array('e.class_id' => $class_id, 'e.year' => $running_year, 'e.section_id' => $section_id))->result_array();
                            foreach ($students as $row) {
                                $total = 0;
                                $present = 0;
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                                    </td>
                                   	<td>Morning<br />Afternoon</td>
                                    <?php
                                    for ($i = 1; $i <= $days; $i++) {
                                        $timestamp = strtotime($i . '-' . $month . '-' .$year1);
									
                                        //$this->db->group_by('timestamp');
                                        $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
										?>
                                        <td style="text-align: center;">
                                        <?php
                                        $status = 0;
                                        foreach ($attendance as $row2) {
                                            $month_dummy = date('d', $row2['timestamp']);

                                                if ($i == $month_dummy && $row2['time'] == 'morning') {
                                                    $status = $row2['status'];
                                                }
                                                elseif($i == $month_dummy && $row2['time'] == 'afternoon')
                                                {
                                                    $status = $row2['status'];
                                                }
											 $timestamp= $row2['timestamp'];
                                        
                                       
                                         
                                        
                                        
                                             if ($status == 1) { ?>
                                                <i class="fa fa-check-circle" title="Present" data-toggle="tooltip" style="color: #00a651;"></i></i><br />
                                            <?php } if ($status == 2) { ?>
                                                <i class="fa fa-times-circle" title="Absent" data-toggle="tooltip" style="color: #ee4749;"></i><br />
                                            <?php } if ($status == 3) { ?>
                                                <i class="fa fa-certificate" title="Late" data-toggle="tooltip" style="color: #fec42d;"></i><br />
                                                <?php
                                            }
											 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                            {
			 
											if ($status == 4) { ?>
                                                <i class="fa fa-pencil-square" title="No Diary" data-toggle="tooltip" style="color: #e81d26;"></i><br />
                                                <?php
                                            	}
											}
                                            if (0 != $status) {
                                                $total=$total+0.5;
                                            }
											if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                                 {
                                                 if (1 == $status || 3 == $status || 4 == $status) {
                                                $present=$present+0.5;
                                                 }
											}
											else{
											  if (1 == $status || 3 == $status) {
                                                $present=$present+0.5;
                                                }
											}
                                           
											/**********/	 
                                            };
                                            ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <?php $m= $present . "/" . $total; 
										 echo $m;
										
										 ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if($total==0){
										echo "NA";
										$percentage='';
										}
										else{
                                        $percentage = round(($present / $total) * 100,2);
									echo $percentage;}

                                        ?>
                                    </td>
                                    <?php $student_id= $row['student_id'];
									                  
									?>
                                    <td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/attendance_messages/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $student_id;?>/<?php echo $present;?>/<?php echo $total;?>/<?php echo $percentage;?>/<?php echo $month;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF">Send SMS</font></a></td>
                                </tr>
                                
                            <?php } ?>
                            
                        </tbody>
                    </table>
</div>
    </div>
   <div style="padding-left:600px">
    <button class="btn" type="button" style="background-color:#009933; width:200px; height:30px"  onClick="printDiv('printableArea')"> 
				<font color="#FFFFFF">Print</font>
			</button>
            </div>
<?php endif; ?>                        
            
            
            
</div>            


<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

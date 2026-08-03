<?php 
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= 	$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;

	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;

	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	get_running_year();
?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}+
	</style>
<div class="box-body" id="printableArea">

	<center>
		<img src="uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php echo "Report"; ?><br>
		<?php echo "class" . ' ' . $class_name;?><br>
        <?php echo "section".''.$section_name;?><br />
		<?php echo "Unit Test Name : " .$exam_name;?>
	</center>

	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
		<thead>
			<tr>
			<td style="text-align: center;">
				students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
			</td>
			<?php 
				$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
				foreach($subjects as $row):
			?>
				<td style="text-align: center;"><?php echo $row['name'];?></td>
			<?php endforeach;?>
			<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
			</tr>
		</thead>
		<tbody>
		<?php
				
				$students = $this->db->get_where('enroll' , array('class_id' => $class_id ,'section_id' =>$section_id ,'year' => $running_year))->result_array();
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align: left;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;  foreach($subjects as $row2): ?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0) 
							{
								$obtained_marks = $marks->row()->mark_obtained;
								$marks = $marks->row()->mark_total;
								
								echo $obtained_marks .'/'.$marks;
								$total_marks += $obtained_marks;
							}
						?>
                        
					</td>
				<?php endforeach;?>
                
			<?php /*?>	<td style="text-align: center;">
					<?php 
						$this->db->where('class_id' , $class_id);
						$this->db->where('year' , $running_year);
						$this->db->from('subject');
						$total_subjects = $this->db->count_all_results();
						echo ($total_marks / $total_subjects); echo "%";
					?>
				</td><?php */?>
				</tr>
                
			<?php endforeach;?>
           
		</tbody>
	</table>
</div>    
   <div style="padding-left:600px">
    <button class="btn" type="button" style="background-color:#009933; width:200px; height:30px"  onClick="printDiv('printableArea')"> 
				<font color="#FFFFFF">Print</font>
			</button>
            </div>
            
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

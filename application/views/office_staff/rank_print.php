<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= 	$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
    $exam_name        =   $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$running_year       =	get_running_year();
?>
<?php if ($class_id != '' && $section_id != '' && $exam_id != ''):?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
<div class="box-body" id="printableArea">

	<center>
		<img src="<?php base_url();?>uploads/logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
		<?php  echo "Report" ?><br>
		<?php echo "class" . ' : ' . $class_name;?><br>
        <?php echo "section" .' : '.$section_name;?><br />
            <?php echo "exam" .' : '.$exam_name;?><br />
     

		</center>






        
            
        
        

                <hr>
                <div class="table-responsive">
	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
                        <thead>
                            <tr>
                             <td style="text-align: center;">
					Sl.No.
				</td>
                                <td style="text-align: center;">
                                   Students <i class="entypo-down-thin"></i> 
                                </td>
                               <?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
					 ?>
					<td style="text-align: center;">
					<?php echo $row['name'];?> 
					
					<?php /*?><a href="<?php echo base_url();?>index.php?admin/subject_message_individual/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>/<?php echo $row['subject_id'];?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Send SMS');?>
			</a><?php */?>
          
            
					
					</td>
                    
                     
				<?php endforeach;?>
                 <td style="text-align: center;">
					Total
				</td>
                <td style="text-align: center;">
					Rank
				</td>
				<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
				</tr>
			</thead>
			<tbody>
            
            
            
        
			<?php
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			    $this->db->select('r.rank_id,r.class_id,r.total_marks,r.section_id,r.exam_id,e.enroll_id,e.enroll_code,e.student_id as student_id,e.roll,e.date_added,e.year');
				$this->db->from('ranks r');
		        $this->db->join('enroll e', 'r.student_id=e.student_id', 'LEFT');
				$this->db->order_by('r.total_marks','desc');
				$this->db->where('r.class_id',$class_id);
				$this->db->where('e.year',$running_year);
				$this->db->where('r.section_id',$section_id);
				$this->db->where('r.exam_id',$exam_id);
				$query = $this->db->get();
				$students = $query->result_array();
			
			
			
			
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$counter = 1;$rank = 1; 
				$previous=0;
				$current=0;
				//$students = $this->db->get_where('enroll' , array('class_id' => $class_id ,'section_id' => $section_id , 'year' => $running_year))->result_array();
				foreach($students as $row){
			?>
				<tr>
              
                                 <td style="text-align: center;"><?php echo $counter++; ?></td>

					<td style="text-align: center;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
				   $sum=0;
					$total_marks = 0;  foreach($subjects as $row2){?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0) 
							{
								$obtained_marks = $marks->row()->mark_obtained;
								
								$total_marks += $obtained_marks;
								
								$mark_total = $marks->row()->mark_total;
								//echo $obtained_marks;
								$total_marks += $mark_total;
								echo $obtained_marks .'/'.$mark_total;
							}
						?>
                        
            
                        
                        
					</td>
                   
				<?php }?>
                
				
				<td style="text-align: center;"><?php 
				 $sum=$sum+$total_marks;echo $row['total_marks'];
				 $current=$sum;
				
				?>
                </td>
                <td style="text-align: center;"><?php 
				
				if($total_marks =='0'){
				  echo "-";
				}else{
				if($current<$previous)
				{
				$rank=$rank+1;
				}
				//echo "current".$current;
				//echo '<br>';
				//echo "prev".$previous;
				//echo '<br>';
				
				 echo $rank; 
				}
				?>
                </td>
				</tr>

			<?php  $previous=$current; }?>

			</tbody>
		</table>
</div>
    </div>
   <div style="padding-left:600px">
    <button class="btn" type="button" style="background-color:#009933; width:200px; height:30px"  onClick="printDiv('printableArea')"> 
				<font color="#FFFFFF">Print</font>
			</button>
            </div>
</div>            

<?php endif;?>
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

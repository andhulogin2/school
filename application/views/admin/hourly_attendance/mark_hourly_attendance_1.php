
<div class="row">
    
    <div class="col-md-12">
    <div class="white-box">
        <?php echo form_open(base_url() . 'index.php/Hourly_attendance/save_hourly_attendance_single/'.$att_master_id.'/' . $hour_id .'/' . $subject_id .'/' . $teacher_id .'/' . $att_date ); ?>
         <input type="hidden" name="timestamp1" value="">
		
        
		<div class="row" style="padding-left:100px;">
		
		</div>
       
 <div>
											  <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
													<tr>
														<th style="text-align: center;" class="table-header">No.</th>
														<th style="text-align: center;" class="table-header">Roll</th>
														<th style="text-align: center;" class="table-header">Student</th>
														<th style="text-align: center;" class="table-header">Status</th>
													</tr>
											

                    <?php
					 $count=1;
                    foreach ($students as $row){
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $row['roll']; ?></td>
                            <td>
                                <?php echo $row['name']; ?>
                                <input type="hidden" name="student_id[]"  value="<?php echo $row['student_id']; ?>" />
                            </td>
                            <td>
                            <div id="class1">
                                 <select class="form-control selectboxit" id="class" name="attendance[]" >
                                 <?php
								 if(count($attendance_details)>0)
								 {
                                foreach($attendance_details as $data)
                                {
								
								 if($row['student_id']==$data['student_id'] && $data['attendance_status']=="1" && $data['class_timing_details_id']==$hour_id )
								 {
								   ?>
								   <option value="1" selected="selected"  >Present</option>
                                   <option value="2"  >Absent</option>
                                    <option value="3" >On Duty</option>
					               <?php
								 }
								 if($row['student_id']==$data['student_id'] && $data['attendance_status']=="2" && $data['class_timing_details_id']==$hour_id)
								 {
								 ?>
								   <option value="2" selected="selected"  >Absent</option>
                                    <option value="1"  >Present</option>
                                     <option value="3" >On Duty</option>
					              <?php
								 }
								 if($row['student_id']==$data['student_id'] && $data['attendance_status']=="3" && $data['class_timing_details_id']==$hour_id)
								 {
								 ?>
                                  <option value="3" selected="selected"   >On Duty</option>
								   <option value="2"  >Absent</option>
                                    <option value="1"  >Present</option>
					              <?php
								 }
                                }
								}
								else
								{
								?>
                                 
                                  <option value="1"  >Present</option>
                                  <option value="2"  >Absent</option> 
                                  <option value="3"  >On Duty</option> 
                                 <?php  
                                }
                                ?>
                                   
                                 </select>	
                             </div>
                            </td>
                        </tr>
                    <?php } ?>
                
            </table>
    <!--        <div class="row" style="padding-left:400px;">
			<div class="form-group">
				<label class="switch switch-success"><input type="checkbox"  name="absent_notification" id="absent_notification" value="1"><span></span> Send-Absent-Notification</label> 
			</div>
		</div>
       
         <div class="form-group">
		                    <div class="col-sm-5">
                             <label class="switch switch-success"><input type="checkbox"  name="additional_msg" id="additional_msg" value="1"><span></span></label> 
		                         <?php 
								 $this->db->select('content');
								 $this->db->from('sms_template');
								 $this->db->where('title','attendance');
								 $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
								
								 //if($msg['title']=='admission'){
								?>
                                 <?php  
								 $this->db->select('content');
								 $this->db->from('sms_template');
								 $this->db->where('title','attendance');
								  $result=$this->db->get()->result_array();
								  foreach($result as $r){?>
								 
		                         <input type="text" id="message" name="message" value="<?php echo $r['content'];}?>" style="display: none">
                               
			                  
                              <?php }else
							  {?>
                            <input type="text" id="message" name="message" value="" style="display: none">
							 <?php } ?>
			                </div>
					</div>
        
</div> -->

        <center>
            <button type="submit" class="btn btn-info" id="submit_button">
                <i class="entypo-check"></i> Update
            </button>
        </center>
        <?php echo form_close(); ?>

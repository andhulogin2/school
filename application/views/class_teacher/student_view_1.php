<div class="row">
    <div class="col-md-12">
    <div class="white-box">
  
    
		<div class="row" style="padding-left:100px;">
		</div>
 <div>
<?php
	$user_id	=	$this->session->userdata('login_user_id'); 
	$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$year		=	get_running_year();
	$this->db->where('section_id',$section_id);
	$this->db->where('class_id',$class_id);
	$this->db->where('academic_year',$year);
	$class_teacher_id	=  $this->db->get('section')->row()->teacher_id;//echo $this->db->last_query();
?>
          <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
                <tr>
                    <th style="text-align: center;" class="table-header">No.</th>
                    <th style="text-align: center;" class="table-header">Student</th>
                    <th style="text-align: center;" class="table-header">Phone</th>
                    <th style="text-align: center;" class="table-header">Action</th>
                </tr>
                    <?php
					 $count=1;
                    foreach ($student as $row){
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                             <td><?php echo $row['phone1']; ?></td>
                             <td align="center">
                  <!-- <a href="<?php echo base_url();?>index.php/Class_teacher/send_message/<?php echo $row['student_id'];?>" class="btn-sm btn-icon icon-left" title="Send message">
                            <i class="fa fa-envelope" style="font-size:20px"></i>
                    </a>-->	
                           		<?php 
								if($class_teacher_id==$teacher_id)
								{
								?>
                   <a href="<?php echo base_url();?>index.php/Class_teacher/student_portal/<?php echo $row['student_id'];?>" class="btn-sm btn-icon icon-left" title="View">
                            <i class="fa fa-user"  style="font-size:20px"></i>
                    </a>	
                            	<?php
								}
								?>
                             </td>
                        </tr>
                    <?php } ?>
                
            </table>
      </div></div></div></div>
        

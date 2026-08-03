<?php 
	$role	=	$this->session->userdata('role');
?>
<div class="row" style="padding-top:20px;">
	<div class="col-md-12 table-responsive">
    	<table class="table table-bordered table-striped">
        	<thead>
            	<tr>
                    <th class="table-header">Sl.No</th>
                    <?php
                    if($role==1 || $role==2)
                    {
                    ?>
                    <th class="table-header">Branch</th>
                    <?php
                    }
                    if($role<=3)
                    {
                    ?>
                    <th class="table-header">Department</th>
                    <?php
                    }
                    ?>
                    <th class="table-header">Class</th>
                    <th class="table-header">Total</th>
                    <th class="table-header">Present</th>
                    <th class="table-header">Absent</th>
                    <th class="table-header">Late</th>
                    <?php
                    if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                    {
                    ?>
                    <th class="table-header">No Diary</th>
                    <?php
                    }
                    if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes')
                    {
                    ?>
                    <th class="table-header">Half Day</th>
                    <?php
                    }
                    ?>	
            	</tr>        
            </thead>
            <tbody>
            	<?php
					$i      =   1;
					$tot    =   0;
					$tot_pr =   0;
					$tot_ab =   0;
					$tot_lt =   0;
					$tot_nd =   0;
					$tot_hd =   0;
					foreach($result as $row):
					?>
                    	<tr>
                            <td>
                                <?php echo $i++; ?>    
                            </td>
                
                            <?php
                            if($role==1 || $role==2)
                            {
                            ?>
                            <td><?php echo $row['branch_name']; ?></td>
                            <?php
                            }
                            if($role<=3)
                            {
                            ?>
                            <td><?php echo $row['dept_name']; ?></td>
                            <?php
                            }
                            ?>
                            <td><?php echo $row['class_name'].'-'.$row['section_name']; ?></td>
                            <td><?php 
                                    $tot_count      =   $this->crud_model->get_stud_count_in_section($row['section_id']);
                                    echo $tot_count;
                                    $tot            =   $tot+$tot_count;
                                ?>
                            </td>
                            <td><?php echo $row['present_count'];$tot_pr=$tot_pr+$row['present_count']; ?></td>
                            <td><?php echo $row['absent_count'];$tot_ab=$tot_ab+$row['absent_count']; ?></td>
                            <td><?php echo $row['late_count'];$tot_lt=$tot_lt+$row['late_count']; ?></td>
                            <?php
                            if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                            {
                            ?>
                            <td><?php echo $row['no_diary_count'];$tot_nd=$tot_nd+$row['no_diary_count']; ?></td>
                            <?php
                            }
                            if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes')
                            {
                            ?>
                            <td><?php echo $row['half_day_count'];$tot_hd=$tot_hd+$row['half_day_count']; ?></td>
                            <?php
                            }
                            ?>	
						</tr>
                    <?php
					endforeach;
				    ?>
						<tr>
						    <td colspan="2" style="text-align:right">Total</td>
						    <td><?php echo $tot; ?></td>
						    <td><?php echo $tot_pr; ?></td>
						    <td><?php echo $tot_ab; ?></td>
						    <td><?php echo $tot_lt; ?></td>
                            <?php
                            if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                            {
                            ?>
                            <td><?php echo $tot_nd; ?></td>
                            <?php
                            }
                            if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes')
                            {
                            ?>
                            <td><?php echo $tot_hd; ?></td>
                            <?php
                            }
                            ?>	
						</tr>
            </tbody>
        </table>
    </div>
</div>
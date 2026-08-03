
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
					<tbody>
                    <tr>
							<td class="table-header" colspan="" width="20%">Name</td>
							<td class="table-header" colspan="" width="20%">Admission Number</td>
                            <td class="table-header" colspan="2" width="30%">Class</td>
							<td  class="table-header"  width="30%">Action</td>
						</tr>
						<?php 
						  $year=get_running_year();  
						  $role=$this->session->userdata('role');
						  $settings	=	$this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description;
						    if($role==3)
							{
							$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
							}
							elseif($role==4 || $role==5 || $role==6)
							{
							 $this->db->where('a.branch_id',$this->session->userdata('branch_id'));
							 $this->db->where('a.dept_id',$this->session->userdata('dept_id'));
							}
							$this->db->where('e.year',$year);
							//$this->db->where('a.student_status_id','0');
							
							$this->db->group_start();
    							$this->db->like('a.name' , $search_key);
    							$this->db->or_like('a.email' , $search_key);
    							if(strlen($search_key)>8)
    							{
    							    $this->db->or_like('a.phone1' , $search_key);
    							    $this->db->or_like('a.phone2' , $search_key);
    							}
    							$this->db->or_like('a.address' , $search_key);
    							$this->db->or_where('a.admission_number' , $search_key);
								if($settings == 'yes')
								{
									$this->db->or_like('a.parent_id' , $search_key);
								    if(strlen($search_key)>8)
								    {
									    $this->db->or_like('a.whatsapp_number' , $search_key);
								    }
								}
    					    $this->db->group_end();
							$this->db->join('enroll e','e.student_id=a.student_id');
							$student_query = $this->db->get('student a');
						//echo $this->db->last_query();
						// $student_query->num_rows();
				
							
						?>
						<?php 
							if ($student_query->num_rows() > 0):
								$students = $student_query->result_array();
								
								foreach ($students as $row):
						?>
						<tr>
							<td><?php
                             if($row['student_status_id']==1)
							 {
							   ?><font color="#FF0000"><?php  echo $row['name']."(Deleted)";?></font> <?php
							 }
							 elseif($row['student_status_id']==2)
							 {
							   ?><font color="#00CC00"><?php echo $row['name']."(Inactive)";?> </font> <?php
							 }
							 elseif($row['student_status_id']==3)
							 {
							   ?><?php echo $row['name']."(Completed)";?> </font> <?php
							 }
							 elseif($row['student_status_id']==4)
							 {
							   ?><?php echo $row['name']."(Discontinued)";?> </font> <?php
							 }
							 elseif($row['student_status_id']==5)
							 {
							   ?><?php echo $row['name']."(TC Issued)";?> </font> <?php
							 }
							 else
							 {
							 echo $row['name'];
							 }
							 ?>
                             
                            </td>
                            <td><?php echo get_admission_number($row['student_id']); ?></td>
                            <td><?php echo get_student_class_name($row['student_id']). ' / ' .
                             get_student_section_name( $row['student_id']);?></td>
							<td> <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" height='35' width="30"/></td>
                            <td>
				            	<a href="<?php echo base_url(); ?>index.php/admin/student_portal/<?php echo $row['student_id']; ?>" class="btn btn-warning" >
                                	<font color="white">Profile <i class="fa fa-user"></font></i>
                            	</a>
				        
				         &nbsp;&nbsp;
                         
       <?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
					   {
					   $branch_id=$this->db->get_where('student',array('student_id' => $row['student_id']))->row()->branch_id;
					   $dept_id=$this->db->get_where('student',array('student_id' => $row['student_id']))->row()->dept_id;
					   ?>                
<a href="<?php echo base_url(). 'index.php/FeeManagement/student_fee_payment_details/'. $row['student_id'] . '/' . get_student_class_id($row['student_id']) . '/' . get_student_section_id($row['student_id']) . '/' .$dept_id. '/' .$branch_id; ?>" class="btn btn-info" >
                                <font color="white">Fee &nbsp;&nbsp;<i class="fa fa-inr"></i></font>
                            	</a>
                                <?php } ?>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($student_query->num_rows() < 1):?>
							<td class="text-center" colspan="4">
								 <strong><center>Not-Found</center></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
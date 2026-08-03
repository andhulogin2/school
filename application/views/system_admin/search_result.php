
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
					<tbody>
                    <tr>
							<td class="table-header" colspan="">Name</td>
                            <td class="table-header" colspan="2">Class</td>
							<td  class="table-header" >Action
				           </td>
						</tr>
						<?php 
							$this->db->like('name' , $search_key);
							$this->db->or_like('email' , $search_key);
							$this->db->or_like('phone1' , $search_key);
							$this->db->or_like('phone2' , $search_key);
							$this->db->or_like('address' , $search_key);
							$student_query = $this->db->get('student');
						?>
						<?php 
							if ($student_query->num_rows() > 0):
								$students = $student_query->result_array();
								
								foreach ($students as $row):
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
                            <td><?php echo get_student_class_name($row['student_id']). ' / ' .
                             get_student_section_name( $row['student_id']);?></td>
							<td> <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" height='35' width="30"/></td>
                            <td>
				            	<a href="<?php echo base_url(); ?>index.php/admin/student_portal/<?php echo $row['student_id']; ?>" class="btn btn-warning">
                                	<font color="white">Profile <i class="fa fa-user"></font></i>
                            	</a>
				         &nbsp;&nbsp;
				            	<a href="<?php echo base_url(); ?>index.php/admin/student_portal/<?php echo $row['student_id']; ?>" class="btn btn-info">
                                <font color="white">Details <i class="fa fa-info-circle" ></i></font>
                            	</a>
				         &nbsp;&nbsp;
                         
                       
<a href="<?php echo base_url(). 'index.php/FeeManagement/student_fee_payment_details/'. $row['student_id'] . '/' . get_student_class_id($row['student_id']) . '/' . get_student_section_id($row['student_id']); ?>" class="btn btn-info">
                                <font color="white">Fee &nbsp;&nbsp;<i class="fa fa-inr"></i></font>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($student_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong>Not-Found</strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
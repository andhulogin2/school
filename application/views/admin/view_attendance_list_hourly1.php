 <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info" data-collapsed="0">
                       
                        <div class="white-box">
                            <div class="table-responsive">
                         
                                <table class="table table-bordered info-table">
                           <thead>
                                        <tr>
                                           



                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Present'); ?></strong></td>
                                            
                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Absent'); ?></strong></td>
                                           
                                           <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Total'); ?></strong></td>
                                          <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Percentage'); ?></strong></td>
                                          


                                        </tr>
                                    </thead>
                                     <tbody>
                                   
        
           
            <tr>
            
               
                <td style="text-align: center;"><?php 
				$this->db ->where('att_date>=',date('Y-m-d',strtotime($from_date)));
				$this->db ->where('att_date <=',date('Y-m-d',strtotime($to_date)));
				$this->db ->where('subject_id',$subject);
				$this->db ->where('student_id',$student_id);
				$this->db ->where('attendance_status',1);
				$this->db->select('count(subject_id) as present ');
				$this->db->from('tbl_att_students_houlry_attendance_details');
				$query=$this->db->get()->row();
				echo $query->present ?></td>
               
                <td style="text-align: center;"><?php 
				$this->db ->where('att_date>=',date('Y-m-d',strtotime($from_date)));
				$this->db ->where('att_date<=',date('Y-m-d',strtotime($to_date)));
				$this->db ->where('subject_id',$subject);
				$this->db ->where('student_id',$student_id);
				$this->db ->where('attendance_status',2);
				$this->db->select('count(subject_id) as absent ');
				$this->db->from('tbl_att_students_houlry_attendance_details');
				$query1=$this->db->get()->row();
				echo $query1->absent?> </td>


                 
                <td style="text-align: center;"><?php 
				$this->db ->where('att_date>=',date('Y-m-d',strtotime($from_date)));
				$this->db ->where('att_date<=',date('Y-m-d',strtotime($to_date)));
				$this->db ->where('subject_id',$subject);
				$this->db ->where('student_id',$student_id);
				
				$this->db->select('count(distinct att_date) as total ');
				$this->db->from('tbl_att_students_houlry_attendance_details');
				$query2=$this->db->get()->row();
				echo $query2->total;?></td>
                   
                
                <td style="text-align: center;"><?php 
				 $a=$query->present;
				 $b=$query2->total;
				$c=($a*100)/$b;
				echo $c;?>
                 </td>
<?php /*?>                 <?php $section_id=$row['section_id'];
<?php */?>				 
				 
      

             

            </tr>
          
            </tbody>
        </table>
       
       
            
            
            <?php echo form_close(); ?> 
                                                    
                                                    
                                                    
												</div>
											</div>
										</div>
</div>
<?php $running_year = get_running_year(); ?>

 
 
                        <div style="padding-right:10px;float:right">
                        
                        	<a href="<?php echo base_url();?>index.php/report/student_print_bulk_section/<?php echo $class_id;?>/<?php echo $section;?>/<?php echo $order?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Progress Report</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section/<?php echo $class_id;?>/<?php echo $section;?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section_pdf/<?php echo $class_id;?>/<?php echo $section;?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
                        
                        </div>
        
 
 
 
 <div align="right" style="padding-right:50px"> 
 <label  for="form-field-1">Sort By:</label>
                                       <select name="order2_" class="select2" onchange="order_by_name_2(this.value,'<?php echo $class_id ?>','<?php echo $section; ?>');" id="order2" >
                                        <option value="">Select</option>
                                        <option value="1">Name Ascending</option>
                                        <option value="2">Name Descending</option>
                                         <option value="3">Roll Ascending</option>
                                          <option value="4">Roll Descending</option>
                                           <option value="5">Admission No Ascending</option>
                                            <option value="6">Admission No Descending</option>
                                         <option value="7">Gender</option>
                                        </select>
									<!-- <input type="radio" name="name" id="name" onChange="order_by_name_2(<?php echo $row['section_id']; ?>);" />Name -->
                                <!--     <input type="radio" name="roll" id="roll" />Roll No -->
                                     <input type="hidden" id="section" name="section" value="<?php echo $class_id; ?> " />   		
                       </div>           
             
          <?php $students = $this->db->get_where('enroll' , array(
         'class_id'=>$class_id , 'section_id' => $section , 'year' => $running_year))->result_array();
		 
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
					
					  if($order==1)
					 {
                     $this->db->order_by('s.name', 'asc');
					 }
					 elseif($order==2)
					 {
                     $this->db->order_by('s.name', 'desc');
					 }	
					 elseif($order==3)
					 {
                     $this->db->order_by('e.roll', 'asc');
					 }	
					 elseif($order==4)
					 {
                     $this->db->order_by('e.roll', 'desc');
					 }	
					  elseif($order==5)
					 {
                     $this->db->order_by('s.admission_number', 'asc');
					 }	
					 elseif($order==6)
					 {
                     $this->db->order_by('s.admission_number', 'desc');
					 }			
					  elseif($order==7)
					 {
                     $this->db->order_by('s.sex', 'asc');
					 }		
						
					 $this->db->where('e.section_id',$section);
                     if ($class_id > 0) {
                         $this->db->where('e.class_id',$class_id);
                     }
					 $this->db->where('e.year',$running_year);
					 
					 $this->crud_model->check_student_status();
					 
                     $query = $this->db->get();
                     $students10 = $query->result_array();
		 
                foreach($students10 as $row2){?>
                <div class="col-md-4 col-sm-4">
                     <div class="white-box"> 
                <div class="row">
               <br /> <br />
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>/<?php echo $class_id;?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row2['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><?php echo $row2['name'];?></a></h3>
                      <small><?php echo $row2['roll'];?></small>
                    </div>
                </div>
            </div> 
             
          </div>
         
                  <?php }?> 
  <div class="clearfix"></div> 
  
<script type="text/javascript">
	function order_by_name_2(type,class_id,section) 
	{
	
	   
	 // var section = $('#section').val();
	  
	//  var class_id = $('#class_id').val();
	  //alert(section);
	 
	
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_name/'+class_id+'/'+type+'/'+section ,
		  
            success: function(response)
            {
       
				jQuery('#'+section).html(response);
            }
  });
	  
    }
</script>

<?php $running_year = get_running_year(); ?>

<div id="roll_list" >




  

<div align="right" style="padding-right:50px"> 
 <label  for="form-field-1">Sort By:</label>
                                        <select name="order1" class="select2" onchange="order_by_name_1(<?php echo $class_id; ?>);" id="order1" >
                                        <option value="">Select</option>
                                        <option value="1">Name Ascending</option>
                                        <option value="2">Name Descending</option>
                                         <option value="3">Roll Ascending</option>
                                          <option value="4">Roll Descending</option>
                                           <option value="5">Admission No Ascending</option>
                                            <option value="6">Admission No Descending</option>
                                         <option value="7">Gender</option>
                                        </select>
								<!--	 <input type="radio" name="name" id="name" onChange="a(<?php echo $class_id; ?>);" />Name-->
                               <!--     <input type="radio" name="roll" id="roll" />Roll No   --> 		
                       </div>     
             		
      
 	<?php	   $students = $this->crud_model->get_student_area_roll($running_year,$class_id,$order);
					   
            foreach($students as $row):?> 
                <div class="col-md-4 col-sm-4">
            <div class="white-box"> 
                <div class="row">
                 <br /> <br />
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>/<?php echo $class_id;?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>/<?php echo $class_id;?>">
					  
					<?php 
		echo $row['name'];
		?></a></h3>
                      <small><?php echo $row['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
                 <?php endforeach;?>
                 
                 </div>
                  <div class="clearfix"></div>
                  
                  
                  
<script type="text/javascript">
	function order_by_name_1(class_id) 
	{
	  //alert(class_id);
	 // var order=2;
	 // alert(order);
	  var type = $('#order1').val();
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_filter/' + class_id+'/'+type , 
            success: function(response)
            {
       
				jQuery('#home').html(response);
            }
  });
	  
    }
</script>                  
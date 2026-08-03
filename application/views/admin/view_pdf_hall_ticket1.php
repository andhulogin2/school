<head>
<title>HALL TICKET</title>
</head>
<body>
       
          <?php
	  $current_student_id = "";
	  $previous_student_id = "";
	  $i=0;
	  foreach($student_data as $student)
	  {
  		$current_student_id = $student['student_id'];
		if($current_student_id != $previous_student_id )
		{
		 $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	  ?>
          <table width="100%">
          <tr>
            <td style="text-align:center;"><b><img src="<?php echo base_url();?>uploads/logo.png" style="height:40px;"></b><h2><?php echo $this->db->get_where('settings',array('type'=>'system_name'))->row()->description; ?></h2></td>
          </tr>
          </table>
          <div style="text-align:center">
            <h3 style="text-transform:uppercase"><?php echo $title; ?></h3>
            <h3>HALL TICKET</h3>
          </div>
          <div align="right" style="padding-right:50px">
			<?php 
			$file ='uploads/student_image/'.$student['student_id'].'.jpg';
			if(!file_exists($file)){
			 ?>
          <svg width="100" height="110">
              <rect width="80" height="80" style="fill:#FFFFFF;stroke-width:2;stroke:rgb(0,0,0)" >
            </svg>
			<?php } else { ?>
            <td style="text-align:center;"><b><img src="<?php echo base_url();?>uploads/student_image/<?php echo $student['student_id'] ?>.jpg" width="80" height="80"></b></td>
           <?php } ?>
		   </div>
          <div class="table-responsive">
            <table width="100%" id="simple-table" class="table table-striped table-bordered table-hover"  >
              <tr>
                <td style="width:50%">Name</td>
                <td style="width:50%;text-transform:uppercase">: <?php echo $student['name']; ?></td>
              </tr>
              <tr>
                <td>Sex</td>
                <td style="text-transform:uppercase">: <?php echo $student['sex']; ?></td>
              </tr>
              <tr>
                <td>Name of Father</td>
                <td style="text-transform:uppercase">: <?php echo $student['parent']; ?></td>
              </tr>
              <tr>
                <td>Reg. Number</td>
                <td>: <?php echo $student['exam_register_number']; ?></td>
              </tr>
              <tr>
                <td>Class</td>
                <td>: <?php echo $class_name; ?></td>
              </tr>
              <tr>
                <td>Mobile Number</td>
                <td>: <?php echo $student['phone1']; ?></td>
              </tr>
              <?php
	   } ?>
            </table>
            <br>
            <br>
            <table width="90%" id="simple-table" class="table table-striped table-bordered table-hover"  >
            <tr><td style="border:1px solid;height:40px"></td><td width="70px"></td><td style="border:1px solid;height:30px"></td></tr>
              <tr>
                <td style="text-align:center">Name and Signature of Class Teacher</td><td></td>
                <td style="text-align:center"> Name and Signature of Head Master</td>
              </tr>
            </table>
            <?php
		$this->db->where('exam_title',$title);
		$this->db->where('class_id',$class_id);
		$subject  = $this->db->get('view_exam_time_table')->result_array();
	  $i=0;
	  $count=count($subject);
	  if($count>0)
	  {
	  ?>
            <div style="text-align:center;padding-bottom:20px;padding-top:20px">
              <h3>TIME TABLE</h3>
            </div>
            <table width="100%" id="simple-table" class="table table-striped table-bordered table-hover" style="border:1px solid;margin-bottom:1px;border-collapse: collapse;"  >
              <tbody>
              <tr><td align="center" rowspan="2" style="border:1px solid"><b>SI NO</b></td>
              <td align="center" rowspan="2" style="border:1px solid"><b>Exam Name</b></td>
              <td align="center" rowspan="2" style="border:1px solid"><b>Date</b></td>
              <td  align="center" style="border:1px solid" colspan="2"><b>Time</b></td></tr>
                <tr>
                  <td align="center" style="border:1px solid"><b>From</b></td>
                  <td align="center" style="border:1px solid"><b>To</b></td>
                  </tr>
                  <?php
	  foreach($subject as $sub)
	  {
		?>
                <tr>
                  <td><?php echo $i=$i+1; ?></td>
                  <td style="border:1px solid;text-transform:uppercase"><?php echo $sub['exam_name']; ?></td>
                  <td style="border:1px solid"><?php echo date('d/m/Y',strtotime($sub['exam_date'])); ?></td>
                  <td style="border:1px solid"><?php echo date('g:i A',strtotime($sub['time_from'])); ?></td>
                  <td style="border:1px solid"><?php echo date('g:i A',strtotime($sub['time_to'])); ?></td>
                </tr>
                <?php
	}		}

?>
              </tbody>
            </table>
          </div>
<pagebreak /> 
           <?php
  		$previous_student_id = $current_student_id;
		}
		?>

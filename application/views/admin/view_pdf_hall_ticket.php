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
<head>
<title>HALL TICKET</title>
</head>
<body>
<div class="main-content">
<div class="main-content-inner">
  <div class="page-content">
    <div class="main-content">
      <div class="main-content-inner">
        <div class="col-sm-12 widget-container-col" >
        
          <table width="65%">
          <tr>
            <td style="text-align:left;"><b><img src="<?php echo base_url();?>uploads/logo.png" style="max-height : 40px;"></b></td><td></td>
            <td style="text-align:left"><h2><?php echo $this->db->get_where('settings',array('type'=>'system_name'))->row()->description; ?></h2></td>
          </tr>
          </table>
          <div style="text-align:center">
            <h3>Anual Examination March-2019</h3>
            <h3>HALL TICKET</h3>
          </div>
          <div align="right">
           <svg width="100" height="110">
              <rect width="80" height="80" style="fill:#FFFFFF;stroke-width:2;stroke:rgb(0,0,0)" >
            </svg>
            </div>
          <div class="table-responsive">
            <table width="80%" id="simple-table" class="table table-striped table-bordered table-hover"  >
              <tr>
                <td>Name</td>
                <td>: <?php echo $student['name']; ?></td>
              </tr>
              <tr>
                <td>Sex</td>
                <td>: <?php echo $student['sex']; ?></td>
              </tr>
              <tr>
                <td>Name of Father</td>
                <td>: <?php echo $student['parent']; ?></td>
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
            <table width="80%" id="simple-table" class="table table-striped table-bordered table-hover"  >
            <tr><td style="border:1px solid;height:40px"></td><td width="60px"></td><td style="border:1px solid;height:30px"></td></tr>
              <tr>
                <td style="text-align:center">Name and Signatire of Class Teacher</td><td></td>
                <td style="text-align:center"> Name and Signature of Head Master</td>
              </tr>
            </table>
            <div style="text-align:center;padding-bottom:20px;padding-top:20px">
              <h3>Time Table</h3>
            </div>
            <?php
		$this->db->where('exam_title',$title);
		$this->db->where('class_id',$class_id);
		$subject  = $this->db->get('view_exam_time_table')->result_array();

	  ?>
            <table width="100%" id="simple-table" class="table table-striped table-bordered table-hover" style="border:1px solid;margin-bottom:1px;border-collapse: collapse;"  >
              <?php
	  $i=0;
	  $count=count($subject);
	  if($count>0)
	  {
		?>
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
                  <td style="border:1px solid"><?php echo $sub['exam_name']; ?></td>
                  <td style="border:1px solid"><?php echo date('d/m/Y',strtotime($sub['exam_date'])); ?></td>
                  <td style="border:1px solid"><?php echo date('g:i A',strtotime($sub['time_from'])); ?></td>
                  <td style="border:1px solid"><?php echo date('g:i A',strtotime($sub['time_to'])); ?></td>
                </tr>
                <?php
	}		}

	else
	{
    ?>
                <tr>
                  <td colspan="5">No Data Found</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
            <?php
  		$previous_student_id = $current_student_id;
		}
?>
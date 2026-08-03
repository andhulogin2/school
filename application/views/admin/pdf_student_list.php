<head>
<title>STUDENT DETAILS</title>
</head>
<body>
<?php
/* $class = get_class_name( $class_id );
 if($section_id!='ALL')
 {
  $section = get_section_name($section_id); 
  }
  else
  {
  $section="ALL";
  }
*/ ?>
<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>

<div style="text-align:center">STUDENT LIST</div>
<div style="text-align:center">  
	<?php 
		if(count($class_id)==1 && $section_id!='ALL')
		{
			echo "CLASS : ".get_class_name($class_id[0]);
			echo  "/" . get_section_name($section_id); 
		}	
		
	?>
</div>

<div style="padding-left:50px;padding-right:50px;padding-top:10px">
<table id="simple-table" class="table table-striped table-bordered table-hover" width="100%" style="border:1px solid;border-collapse:collapse">
  <thead>
    <tr>
      <th style="border:1px solid;" class="table-header">SI NO</th>
      <th style="border:1px solid;" class="table-header">Admission Number</th>
      <th style="border:1px solid;" class="table-header">Name</th>
      <th style="border:1px solid;" class="table-header">Date of Birth</th>
      <th style="border:1px solid;" class="table-header">Father's Name</th>
      <th style="border:1px solid;" class="table-header">Mother's Name</th>
      <th style="border:1px solid;" class="table-header">Class</th>
      <th style="border:1px solid;" class="table-header">Phone</th>
    </tr>
  </thead>
  <tbody>
    <?php
			$total=0;
			$i=0;
			if(count($student_data)>0)
			{
			foreach($student_data as $row)
			{
			?>
    <tr>
      <td style="border:1px solid;text-align:center"><?php echo $i=$i+1; ?></td>
      <td style="border:1px solid"><?php echo $row['admission_number']; ?></td>
      <td style="border:1px solid"><?php echo $row['name']; ?></td>
      <td style="border:1px solid"><?php echo $row['birthday']; ?></td>
      <td style="border:1px solid"><?php echo $row['parent']; ?></td>
      <td style="border:1px solid"><?php echo $row['mother_name']; ?></td>
      <td style="border:1px solid;text-align:center"><?php echo get_student_class_name($row['student_id'])."/".get_student_section_name($row['student_id']); ?></td>
      <td style="border:1px solid"><?php echo $row['phone1']; ?></td>
      </tr>
      <?php
            }
        	}
			else
			{
				echo "<tr><td colspan='3' style='text-align:center;color:red'><b>No results found</b></td></tr>";
			}
			?>
  </tbody>
</table>

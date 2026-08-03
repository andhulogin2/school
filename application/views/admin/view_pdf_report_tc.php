<head>
    <title>TRANSFER CERTIFICATE</title>
</head>
<body>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <table width="100%">
                    <tr><td style="text-align:center;" rowspan="3" width="120px"><img src="<?php echo base_url();?>uploads/logo.png" style="height:100px;width:100px"></td></tr>
                    <tr><td style="text-align:center;text-transform:uppercase"><h2><?php echo $this->db->get_where('settings',array('type'=>'system_name'))->row()->description; ?></h2></td></tr>
                    <tr><td style="text-align:center;text-transform:uppercase"><b><?php echo $this->db->get_where('settings',array('type'=>'address'))->row()->description; ?></b><br><?php echo $this->db->get_where('settings',array('type'=>'phone'))->row()->description; ?></td></tr>
                </table>
                <hr>
                <table width="100%">
                    <tr><td style="text-align:center"><h3><u>TRANSFER CERTIFICATE</u></h3></td></tr>
                </table>
                <br>
                
                <div class="table-responsive">
                <table width="100%" id="simple-table" class="table table-striped table-bordered table-hover" style="border:1px solid black;border-collapse:collapse;font-family: sans-serif;"  >
                    <?php 
                    foreach($tc_issued as $tc)
                    {
                    $student_id 	= $tc['student_id'];
                    $name 			= $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
                    $nationality1 	= $this->db->get_where('tbl_nationality', array('nationality_id' => $tc['nationality']))->row();
                    $nationality        = isset($nationality1)?$nationality1->nationality:"";
                    $religion1 		= $this->db->get_where('tbl_religion', array('religion_id' => $tc['religion']))->row();
                    $religion           = isset($religion1)?$religion1->religion:"";
                    $caste1 		= $this->db->get_where('tbl_caste', array('caste_id' => $tc['caste']))->row();
                    $caste              = isset($caste1)?$caste1->caste:"";
                   // $conduct 		= $this->db->get_where('tbl_general_conduct', array('conduct_id' => $tc['general_conduct']))->row()->conduct;
                    $class_name 	= $this->db->get_where('class', array('class_id' => $tc['last_class_studied']))->row()->name;
					//echo "<tr><td>".$student_id."/".$name."/".$nationality."/".$religion."/".$caste."/".$class_name."</td></tr>";
                    ?>
                    <tr><td style="border:1px solid black;height:30px" width="50%">Book No</td><td style="border:1px solid black;text-transform:uppercase;" width="50%"> <?php echo $tc['book_number']; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">TC Number</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['tc_number']; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Name of the Student</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $name; ?> </td></tr>
                    <tr><td style="border:1px solid black;height:30px">Sex</td><td style="border:1px solid black;text-transform:uppercase;"> <?php if($tc['sex']=='M') { echo "Male"; } else{ echo "Female"; } ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Date of Birth</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo date("d/m/Y", strtotime($tc['date_of_birth'])); ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Nationality</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $nationality; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Religion</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $religion; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Caste</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $caste; ?></td></tr>
                    <!--        <tr>
                    <td style="border:1px solid black;height:30px">Whether Belongs to SC/ST</td><td style="border:1px solid black;text-transform:uppercase;"> <?php if($tc['is_scheduled_caste']=='N') { echo "No"; } else{ echo "Yes"; } ?></td>
                    
                    </tr>
                    -->        
                    <tr><td style="border:1px solid black;height:30px">Name of Father/Gaurdian</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['name_of_father']; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Name of Mother</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['name_of_mother']; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Date of Admission</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo date("d/m/Y", strtotime($tc['date_of_admission']));  ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Last Class Studied</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $class_name; ?></td></tr>
                    <!--        <tr><td style="border:1px solid black;height:30px">last Exam Appeared</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['last_exam_appeared']; ?></td></tr>
                    -->        
                    <tr><td style="border:1px solid black;height:30px">Last Exam Result</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['last_exam_result']; ?></td></tr>
                    <!-- <tr><td style="border:1px solid black;height:30px">Subjects Studied</td><td style="border:1px solid black;text-transform:uppercase;"> <?php foreach($tc_subjects as $sub) 
                    {
                    $subject = $this->db->get_where('subject', array('subject_id' => $sub['subject_id']))->row()->name;
                    echo $subject."  ";
                    } ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Whether Qualified for Higher Classes</td><td style="border:1px solid black;">
                    <?php
                    if($tc['qualified_for_higher_class']=="Y")
                    { 
                    echo "Yes";
                    } 
                    else 
                    {
                    echo "No";
                    } 
                    ?>
                    </td></tr>-->
                    <tr><td style="border:1px solid black;height:30px">Total No.of Working Days</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['total_working_days']; ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">No.of Days Attended</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['total_present']; ?></td></tr>
                    <!--        <tr><td style="border:1px solid black;height:30px">General Conduct</td><td style="border:1px solid black;"> <?php echo $conduct; ?></td></tr>
                    -->        
                    <tr><td style="border:1px solid black;height:30px">Date of Application for TC</td><td style="border:1px solid black;text-transform:uppercase;"> <?php if($tc['date_applied'] == '1970-01-01' || $tc['date_applied'] == '' || $tc['date_applied'] == '0000-00-00'){ echo ""; }else{ echo date('d/m/Y',strtotime($tc['date_applied'])); } ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Date of Issue of TC</td><td style="border:1px solid black;text-transform:uppercase;"> <?php if($tc['date_issued'] == '1970-01-01' || $tc['date_issued'] == '' || $tc['date_issued'] == '0000-00-00'){ echo ""; }else{ echo date('d/m/Y',strtotime($tc['date_issued'])); } ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Reason for Leaving</td><td style="border:1px solid black;text-transform:uppercase;"> <?php $rsn= $this->db->get_where('tbl_tc_reason_for_leaving', array('reason_id' => $tc['reason_for_leaving']))->row(); if(isset($rsn)){ echo $rsn->reason; } ?></td></tr>
                    <tr><td style="border:1px solid black;height:30px">Any Other Remarks</td><td style="border:1px solid black;text-transform:uppercase;"> <?php echo $tc['remarks']; ?></td></tr>
                    
                    <?php } ?>
                </table>
                <br><br>
                <div align="right" style="padding-right:10px">
               	Manager / Principal Signature
                </div>
                </div>
            </div>
        </div>
    </div>
</body>        

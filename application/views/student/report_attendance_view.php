<?php include_once APPPATH . 'views/student_head.php';?>
<?php $running_year = get_running_year(); ?>




	
	<body class="no-skin">
		
		<?php //include_once APPPATH . 'views/top_bar.php';?>
        
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Student</a>
							</li>
							<li class="active">Attendance</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Attendance Report
								
							</h1>
						</div>
<?php echo form_open(base_url() . 'index.php/student/attendance_report_selector/'); ?>
<div class="white-box">
<div class="row" style="margin-left:30px;">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Month');?></label>
            <select name="month" class="form-control selectboxit" id="month">
                <?php
               for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m = get_phrase('January');
                else if ($i == 2)
                    $m = get_phrase('February');
                else if ($i == 3)
                    $m = get_phrase('March');
                else if ($i == 4)
                    $m = get_phrase('April');
                else if ($i == 5)
                    $m = get_phrase('May');
                else if ($i == 6)
                    $m = get_phrase('June');
                else if ($i == 7)
                    $m = get_phrase('July');
                else if ($i == 8)
                    $m = get_phrase('August');
                else if ($i == 9)
                    $m = get_phrase('September');
                else if ($i == 10)
                    $m = get_phrase('October');
                else if ($i == 11)
                    $m = get_phrase('November');
                else if ($i == 12)
                    $m = get_phrase('December');
                    ?>
                    <option value="<?php echo $i; ?>"
                            <?php if ($month == $i) echo 'selected'; ?>  >
                                <?php echo $m; ?>
                    </option>
                    <?php
                endfor;
                ?>
                
            </select>
            
             
        </div>
    </div>
    <div class="col-md-2">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Year</label>
        <select name="year1" class="form-control selectboxit" id="year1" >
          <option value="">Select</option>
         <?php $i= date('Y');
?>                <option value="<?php echo $i-1;?>"><?php echo $i-1;?>
                      
                </option>
                 <option value="<?php echo $i;?>"><?php echo $i;?>
                      
                </option>
                  <option value="<?php echo $i+1;?>"><?php echo $i+1;?>
                      
                </option>
                <?php
          
            ?>
        </select>
         </div>
    </div>
    <?php 
	$user_id	= $this->session->userdata('login_user_id');
        $yr=get_running_year();
	 $student = $this->db->get_where('student' , array('user_id' => $user_id))->row()->student_id;
	$class_id = $this->db->get_where('enroll' , array('student_id' => $student, 'year' => $yr))->row()->class_id;
        $section_id = $this->db->get_where('enroll' , array('student_id' => $student, 'year' => $yr))->row()->section_id;
		 $student_id = $this->db->get_where('enroll' , array('student_id' => $student , 'year' => $yr))->row()->student_id;

         ?>
    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">
      <input type="hidden" name="student" value="<?php echo $student;?>">
    <div class="col-md-3" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info"><?php echo get_phrase('View');?></button>
    </div>
</div>

  <?php if ($class_id != '' && $section_id != '' && $month != '' && $student != ''): ?>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
        <hr />
        <div class="row" style="margin-left:10px;">
            <div class="col-md-12">
                <center><p><i class="fa fa-check-circle" style="color: #00a651;"></i> <?php echo get_phrase('Present'); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle" style="color: #ee4749;"></i> <?php echo get_phrase('Absent'); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-certificate" style="color: #fec42d;"></i> Late &nbsp;&nbsp;&nbsp;<?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
              {
			  ?><i class="fa fa-pencil-square" style="color: #e81d26;"></i> <?php echo get_phrase('No Diary');} ?></p></center>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered" id="my_table">
                        <thead>
                            <tr>
                                <td style="text-align: center;" class="table-header">
                                    <b>students<i class="entypo-down-thin"></i> | <?php echo get_phrase('Date'); ?> </b><i class="entypo-right-thin"></i>
                                </td>
                                <?php
                                $year = explode('-', $running_year);
                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
                                for ($i = 1; $i <= $days; $i++) {
                                    ?>
                                    <td style="text-align: center;" class="table-header"><?php echo $i; ?></td>
                                <?php } ?>
                                <td style="text-align: center;" class="table-header">
                                    Present/Total
                                </td>
                                <td style="text-align: center;" class="table-header">
                                    Percentage
                                </td>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                            <?php
                            $data = array();
                         //   $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                           // foreach ($students as $row) {
                                $total = 0;
                                $present = 0;
                              //  }?>
                                <tr>
                                   <td style="text-align: center;">
                                        <b><?php echo $this->db->get_where('student', array('student_id' =>$student))->row()->name; ?></b>
                                    </td>
                                   
                                    <?php
                                    for ($i = 1; $i <= $days; $i++) {
                                        $timestamp = strtotime($i . '-' . $month . '-' .$year1);
									
                                       // $this->db->group_by('timestamp');
                                      $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $student))->result_array();

                                        $status = 0;
                                        foreach ($attendance as $row2) {
                                            $month_dummy = date('d', $row2['timestamp']);

                                            if ($i == $month_dummy) {
                                                $status = $row2['status'];
                                            }
											 $timestamp= $row2['timestamp'];
                                        };
                                        ?>
                                         
                                        
                                        <td style="text-align: center;">
                                            <?php if ($status == 1) { ?>
                                                <i class="fa fa-check-circle" title="Present" data-toggle="tooltip" style="color: #00a651;"></i></i>
                                            <?php } if ($status == 2) { ?>
                                                <i class="fa fa-times-circle" title="Absent" data-toggle="tooltip" style="color: #ee4749;"></i>
                                            <?php } if ($status == 3) { ?>
                                                <i class="fa fa-certificate" title="Late" data-toggle="tooltip" style="color: #fec42d;"></i>
                                                <?php
                                            }
											 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                            {
			 
											if ($status == 4) { ?>
                                                <i class="fa fa-pencil-square" title="No Diary" data-toggle="tooltip" style="color: #e81d26;"></i>
                                                <?php
                                            }
											}
                                            if (0 != $status) {
                                                $total++;
                                            }
											if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                                 {
                                                 if (1 == $status || 3 == $status || 4 == $status) {
                                                $present++;
                                                 }
											}
											else{
											  if (1 == $status || 3 == $status) {
                                                $present++;
                                                }
												}
                                            ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: center;">
                                        <?php $m= $present . "/" . $total; 
										 echo $m;
										
										 ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if($total==0){
										echo "NA";
										}
										else{
                                        $percentage = round(($present / $total) * 100,2);
									echo $percentage;}

                                        ?>
                                    </td>
                                    <?php $student_id= $student_id;
									                  
									?>
                                   
                                </tr>
                                
                         
                            
                        </tbody>
                    </table>

                   <?php endif; ?>
<script type="text/javascript">
    $(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    }); 
</script>
<script type="text/javascript">
    function select_section(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
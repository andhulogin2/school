<?php include_once APPPATH . 'views/head.php';?>
<?php $running_year = get_running_year(); ?>


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
								<a href="#">Home</a>
							</li>
							<li class="active">Attendance Report</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Attendance Report
								</small>
							</h1>
						</div>
                        <?php echo form_open(base_url() . 'index.php/admin/attendance_report_selector/'); ?>

<div class="white-box">
    <div class="row">
        <?php
        $query = $this->db->get('class');
        if ($query->num_rows() > 0):
            $class = $query->result_array();
            ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;">Class</label>
                    <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                        <option value="">Select</option>
                        <?php foreach ($class as $row): ?>
                            <option value="<?php echo $row['class_id']; ?>"<?php if ($class_id == $row['class_id']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $query = $this->db->get_where('section', array('class_id' => $class_id));
        if ($query->num_rows() > 0):
            $sections = $query->result_array();
            ?>
            <div id="section_holder">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" style="margin-bottom: 5px;">Section</label>
                        <select class="form-control selectboxit" name="section_id">
                            <?php foreach ($sections as $row): ?>
                                <option value="<?php echo $row['section_id']; ?>"
                                        <?php if ($section_id == $row['section_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Month</label>
                <select name="month" class="form-control selectboxit" id="month">
                    <?php
                    for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m ='January';
                else if ($i == 2)
                    $m = 'February';
                else if ($i == 3)
                    $m = 'March';
                else if ($i == 4)
                    $m = 'April';
                else if ($i == 5)
                    $m = 'May';
                else if ($i == 6)
                    $m = 'June';
                else if ($i == 7)
                    $m = 'July';
                else if ($i == 8)
                    $m = 'August';
                else if ($i == 9)
                    $m = 'September';
                else if ($i == 10)
                    $m = 'October';
                else if ($i == 11)
                    $m = 'November';
                else if ($i == 12)
                    $m = 'December';
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
        <input type="hidden" name="year" value="<?php echo $running_year; ?>">
        <div class="col-md-3" style="margin-top: 20px;">
            <button type="submit" class="btn btn-info">View</button>
        </div>
    </div>


    <?php if ($class_id != '' && $section_id != '' && $i != ''): ?>
        <br>
<div class="box-body" id="printableArea">

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
            
                <center><p><i class="fa fa-check-circle" aria-hidden="true"></i> Present &nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle" style="color: #ee4749;"></i> Absent &nbsp;&nbsp;&nbsp;<i class="fa fa-certificate" style="color: #fec42d;"></i> Late&nbsp;&nbsp;&nbsp; <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
              {
			  ?><i class="fa fa-pencil-square" style="color: #e81d26;"></i> No Diary &nbsp;&nbsp;&nbsp;<?php }?><a href="<?php echo base_url();?>index.php/admin/attendance_print/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $month;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF">Print</font></a>
			</button></p>
                
             
                
                </center>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered" id="my_table">
                        <thead>
                            <tr>
                                <td style="text-align: center;">
                                    Students <i class="entypo-down-thin"></i> | Date <i class="entypo-right-thin"></i>
                                </td>
                                <?php
                                $year = explode('-', $running_year);
                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
                                for ($i = 1; $i <= $days; $i++) {
                                    ?>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                <?php } ?>
                                <td style="text-align: center;">
                                    Present/Total
                                </td>
                                <td style="text-align: center;">
                                    Percentage
                                </td>
                               
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = array();
                            $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                            foreach ($students as $row) {
                                $total = 0;
                                $present = 0;
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                                    </td>
                                   
                                    <?php
                                    for ($i = 1; $i <= $days; $i++) {
                                        $timestamp = strtotime($i . '-' . $month . '-' . $year[0]);
                                        $this->db->group_by('timestamp');
                                        $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();

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
                                    <?php $student_id= $row['student_id'];
									                  
									?>
                                    <td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/attendance_messages/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $student_id;?>/<?php echo $present;?>/<?php echo $total;?>/<?php echo $percentage;?>/<?php echo $month;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF">Send SMS</font></a></td>
                                </tr>
                                
                            <?php } ?>
                            
                        </tbody>
                    </table>

                   <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div></div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () { 
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
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
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
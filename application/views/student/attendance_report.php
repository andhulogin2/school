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
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
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
									Attendance
								
							</h1>
						</div>

<?php echo form_open(base_url() . 'index.php/student/attendance_report_selector/'); ?>
<div class="row" style="margin-left:30px;">
    <div class="col-md-3">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Month');?></label>
        <select name="month" class="form-control selectboxit" id="month" onChange="show_year()">
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
                      <?php if($month == $i) echo 'selected'; ?>  >
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
	 $student = $this->db->get_where('student' , array('user_id' => $user_id))->row()->student_id;
         $yr=get_running_year();
	 $class_id = $this->db->get_where('enroll' , array('student_id' =>  $student, 'year' => $yr))->row()->class_id;
        $section_id = $this->db->get_where('enroll' , array('student_id' =>  $student , 'year' => $yr))->row()->section_id;
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

<?php echo form_close(); ?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
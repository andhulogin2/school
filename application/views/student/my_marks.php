<?php include_once APPPATH . 'views/student_head.php';?>
<?php $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>
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
							<li class="active">Marks</li>
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
									Marks
								
							</h1>
						</div>


<div class="row">
<?php $yr=get_running_year();$student_info =   $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $yr))->result_array(); 
    foreach($student_info as $row): ?>
 

   
<div class="col-md-12">
                        <center><?php if(file_exists('uploads/student_image/'.$row['student_id'].'.jpg')):?>
                <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-responsive"/>
            <?php endif;?>
            <?php if(!file_exists('uploads/student_image/'.$student_id.'.jpg')):?>
                <img src="<?php echo base_url(); ?>uploads/user.jpg" class="img-rounded img-responsive" height="100" width="200"/>
            <?php endif;?></center>
           
                        <div class="white-box" style="padding-top:20px">
                            <center><h4><?php echo $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->name;?></h4></center>
        <?php $destacado = $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->board;
                if ($destacado == 1):?>
                  <center><h5><i class="fa fa-circle m-r-5" style="color: #00a651;"></i><?php echo get_phrase('Excellent'); ?></h5> </li></center>
                  <?php endif;?>
                  <br>
                                 <?php $student_birthday = $this->db->get_where('student' , array(
            'student_id' => $row['student_id']))->row()->birthday;
                /*list ($day, $month, $year) = split($student_birthday);
                $now = date("m");
                if ($now == $month):*/?>
                    <center><span class="label label-lg label-yellow arrowed-in arrowed-in-right">This Month</span></center>
                <?php //endif;?><br><br>
                        </div>
                    </div>
                  
</div>
    <?php endforeach;?>

<div class="main_data">
    <br/><br/>
    <?php
	//$edit = $this->db->get_where('enroll', array('student_id' => $row['student_id'], 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
    $student_info = $this->crud_model->get_student_info($student_id);
	//$exams=$this->db->get_where('exam',array('class_id'=>$row['class_id']))->row()->description
 $exams = $this->crud_model->get_exams($class_id);
    foreach ($student_info as $row1):
        foreach ($exams as $row2):
            ?>
            <div class="row" style=" margin-left:30px; width:1100px;">
                <div >
                    <div class="panel panel-info" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title"><font color="white"><?php echo $row2['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rank:<?php 
							
							echo get_rank($row2['exam_id'],$student_id);?></font></div>
                        </div>
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table table-bordered info-table" >
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Subject'); ?></strong></td>

                                            <td style="text-align: center;"><strong>Mark Obtained</strong></td>


                                            <td style="text-align: center;"><strong><?php echo get_phrase('Out of Mark'); ?></strong></td>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Average'); ?></strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $this->db->select('s.subject_id,m.mark_total as mark_total,s.name ,m.mark_obtained as mark_obtained,m.comment as comment');
                                        $this->db->from('subject s');
                                        $this->db->join('mark m', 's.subject_id=m.subject_id', 'LEFT');
                                        $this->db->where('m.exam_id', $row2['exam_id']);
                                        $this->db->where('s.class_id', $class_id);
                                        $this->db->where('m.student_id', $student_id);
                                        $this->db->where('s.year', $running_year);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();

                                        //$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year
                                        //  ))->result_array();
                                        foreach ($subjects as $row3):
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $row3['name']; ?></td>

                                                <td style="text-align: center;">
                                                    <?php
                                                    /* $obtained_mark_query = $this->db->get_where('mark' , array(
                                                      'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'],
                                                      'class_id' => $class_id, 'student_id' => $student_id ,
                                                      'year' => $running_year));
                                                      if ( $obtained_mark_query->num_rows() > 0)
                                                      {
                                                      $marks = $obtained_mark_query->result_array();
                                                      foreach ($marks as $row4) */
                                                    echo $row3['mark_obtained'];
                                                    ?>
                                                </td>


                                                <td style="text-align: center;">
                                                    <span class="label label-rouded label-danger pull-right"><?php echo $row3['mark_total']; ?></span>
                                                </td>

                                                

                                                <td style="text-align: center;">
                                                    <?php
													 $average =0;
													 if ( $row3['mark_total']>0)
                                                    $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
                                                    echo number_format($average, 2, '.', '');
                                                    ?>%
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>    
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            
            <?php
        endforeach;
    endforeach;
    ?>
    </div></div></div>
  
    
	<?php include_once APPPATH . 'views/footer.php'; ?>
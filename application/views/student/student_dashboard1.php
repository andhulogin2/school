<?php include_once APPPATH . 'views/student_head.php';?>
 <?php $running_year = get_running_year();?>

	
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
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; status
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!--<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Welcome to
									<strong class="green">
										Login2 School
										
									</strong>,
	Student Administration System Software.
								</div>-->
                                
									<div class="widget-box widget-color-green2">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">News</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-8">
                                                <marquee dir="rtl" >
													<strong class="green">Login2 School</strong><?php $this->db->select('news_code,title');
													$this->db->from('news');
													$this->db->order_by('news_status','desc');
													$query=$this->db->get()->result_array();
													$slno=1;
													 foreach($query as $news){
													 ?>
													 <a href="<?php echo base_url();?>index.php/student/news_view/details/<?php echo $news['news_code'];?>" role="button" class="green" data-toggle="modal"><?php 
													 echo  $slno .") ".$news['title'];
													 $slno++;?>
                                                     </a><?php }?>
                                                 </marquee>
												</div>
											</div>
										</div>
                                        <?php
									$student=$this->session->userdata('login_user_id');
									$this->db->select('name');
									$this->db->from('student');
									$this->db->where('student_id',$student);
									$query=$this->db->get()->row();
									
               $student_id= $student; 
			   
				   $class_id     = $this->db->get_where('enroll' , array(
                  'student_id' => $student_id))->row()->class_id;
				            // echo $class_id;
				           $monthly_attendance = $this->crud_model->get_attendance_monthly($student_id);
                           $student_portal_model=$this->crud_model->student_portal_data($student_id);
				   ?>
								<div class="col-sm-12">
										<!-- #section:elements.tab.option -->
										<div class="tabbable">
											<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
												<li class="active">
													<a data-toggle="tab" href="#home4">PROFILE</a>
												</li>

												<li>
                                                <a data-toggle="tab" href="#dropdown14">MARK REPORT</a>
													
												</li>

												<li>
                                                <a data-toggle="tab" href="#dropdown15">ATTENDANCE REPORT</a>
													
												</li>
                                                <li>
													<a data-toggle="tab" href="#profile4">FEE DETAILS</a>
												</li>
											</ul>

											<div class="tab-content row col-md-12">
												<div id="home4" class="tab-pane in active">
                                                
                                                  <div  class=" row col-md-4">
                                                   <div  class="white-box">
				<table>								
            <?php
    $student_info = $this->db->get_where('enroll', array('student_id' => $student_id))->result_array();
    foreach ($student_info as $row){
	//echo $row['student_id'];
        ?>  
        <div class="profile-user-info profile-user-info-striped">
        <center><?php if (file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-responsive"/>
                <?php endif; ?>
                <?php if (!file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <img src="assets/user.png" class="img-rounded img-responsive"/>
                <?php endif; ?></center>
            <div class="white-box">
                <center><h4> <?php foreach($student_portal_model as $student_view) {
					echo $student_view['name'];
	  
                        ?></h4></center>
                <?php
                /*$destacado = $this->db->get_where('student', array(
                            'student_id' => $row['student_id']))->row()->board;*/
                //if ($destacado == 1):
                   // ?>
                    <!--<center><h5><i class="fa fa-circle m-r-5" style="color: #00a651;"></i>--><?php
					 //echo get_phrase('Excellent'); ?>
                     <!--</h5> </li></center>-->
                <?php //endif; ?>
<center>


											
													<div class="profile-info-name" style="width:500px"><center> Registered </center></div>

													<div class="profile-info-value" style="width:500px">
														<span class="editable" id="username" style="width:500px"><?php
                        echo (date('m/d/Y', $student_view['date']));
                        ?></span>
													</div>
												
                                                <div class="profile-info-row">
													<div class="profile-info-name"><center> Phone1</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php
                        echo $student_view['phone1'];
                        ?></span>
													</div>
												</div>
<div class="profile-info-row">
													<div class="profile-info-name"><center> Phone2 </center></div>

													<div class="profile-info-value">
														
														<span class="editable" id="country"><?php
                        echo $student_view['phone2'];
                        ?></span>
													</div>
												</div>
                                                <div class="profile-info-name"><center> Sex </center></div>

													<div class="profile-info-value" style="width:500px">
														<span class="editable" id="username" style="width:500px"><?php
                        echo $student_view['sex'];
                        ?></span>
													</div>
                                                     <div class="profile-info-row">
													<div class="profile-info-name"><center> Email</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php echo $student_view['email']; ?></span>
													</div>
												</div>
 <div class="profile-info-row">
													<div class="profile-info-name"><center> Class</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php echo $this->crud_model->get_class_name($row['class_id']); ?></span>
													</div>
												</div>
                                                 <div class="profile-info-row">
													<div class="profile-info-name"><center> Section</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php $sec = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; $sec_id =$row['section_id']; echo $sec?></span>
													</div>
												</div>
                                                 <?php if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
              {?>
			   <div class="profile-info-row">
													<div class="profile-info-name"> <center>School Name</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php
                       echo $student_view['school'];
                        ?></span>
													</div>
												</div>
              
              
			  
			<?php  }?>   
                                              <div class="profile-info-row">
													<div class="profile-info-name"><center> Parent</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php
                        echo $student_view['parent'];
                        ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"><center> Birthday</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php
                       echo $student_view['birthday'];
                        ?></span>
													</div>
												</div>
                                                 <div class="profile-info-row">
													<div class="profile-info-name"><center> Address</center></div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php
                        echo $student_view['address'];
                        ?></span>
													</div>
												</div>
               <div class="profile-info-row">
													<div class="profile-info-name"><center> Account-Status</center></div>

													<div class="profile-info-value">
                                                    <?php
                    $ses = $student_view['student_session'];
                    if ($ses == '1'):
                        ?>
														<span class="editable label label-rounded" style="background-color:#006633" id="username"><?php echo get_phrase('Active'); ?></span> <?php endif; ?>
                <?php if ($ses == "2"): ?>
                <span class="editable label label-rounded" style="background-color:#006633" id="username"><?php echo get_phrase('Inactive'); ?></span> <?php endif; ?>
													</div>
												</div>

                <?php
                echo $student_view['birthday'];
                //list ($day, $month, $year) = split("-", $student_view['birthday']);
               // $now = date("m");
              /*?> if ($now == $month):
                    ?>
                    <center><div class="badge badge-warnig">
                            <i class="icon-present"></i> <?php echo get_phrase('This-Month'); ?>
                        </div></center>
                <?php endif; <?php */?>
				</center><br><br>

                
              
                

               



               
            
                 
               

               <!--//////////////////////////////////////////////////////////////////***************************************////////////////////////////////////////////////////////////////-->        


                <?php /*?><?php
                $s = mysql_query("SELECT count( DISTINCT student_id ) FROM attendance ");

                if ($p = mysql_fetch_array($s)) {
                    echo "<script> alert($p[0] ; </script>";
                }
                ?><?php */?>
                <!--<p><span><?php echo get_phrase('Total Attendence'); ?>:</span>    <span class="pull-right "><?php
                        $current_date = date('m/d/Y');
                        $date_of_reg = (date('m/d/Y', $student_view['date']));
                        ?></span></p>
                --><!--//////////////////////////////////////////////////////////////////***************************************////////////////////////////////////////////////////////////////-->        
                
                
               

            </div>


          <?php echo form_open(base_url() . 'index.php/admin/individual_message/' .$student_id);?>

           <!-- <div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('to'); ?></span></label>
                <div class="col-md-12">
                    <input type="text" name="name" value="<?php echo $student_view['name']; }?>" class="form-control" placeholder="<?php echo get_phrase('Name'); ?>">
                </div>
            </div>-->
            <!--<div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('Message'); ?></span></label>
                <div class="col-md-12">
                   <!-- <textarea class="form-control" name="message1" ></textarea>-->
</div>
            </div>
            </div>
            
            <br /><br />&nbsp;
<td></td>

        </div>
        <?php $student_id = $student_id; ?>
    <?php } 
	
	echo form_close();
				?>
                </table>
                </div></div>
                <div class="row col-md-8" style="padding-left:50px">
                
                                                <?php 
												//echo $class_id;
												$q=$this->db->get_where('subject',array('class_id'=>$class_id))->result_array();
												  foreach($q as $sub){
												  
												?>
                                              
                                               
                                               <span class="btn btn-app btn-sm btn-pink no-hover">
													
													<span class="line-height-1 smaller-90"><?php echo $sub['name'];?></span>
												</span>
                                                
                                                
                                                <?php }?>
                                               
													<!--<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br />
													<span class="line-height-1 smaller-90"> Views </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br />
													<span class="line-height-1 smaller-90"> Followers </span>
												</span>

												

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> 23 </span>

													<br />
													<span class="line-height-1 smaller-90"> Reviews </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br />
													<span class="line-height-1 smaller-90"> Albums </span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br />
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>-->
											
                
                
                
                
                
                
                
             </div>   
      
             
        </div>   
                                
                

												<div id="profile4" class="tab-pane">
													
                                                          
                                                   
                                                   
                                                   
                                                   
												</div>

												<div id="dropdown14" class="tab-pane">
                                                
                                                <?php $student_info = $this->crud_model->get_student_info($student_id);
	//$exams=$this->db->get_where('exam',array('class_id'=>$row['class_id']))->row()->description
 $exams = $this->crud_model->get_exams($class_id);
    foreach ($student_info as $row1):
        foreach ($exams as $row2):
            ?>
            <div class="row">
                <div >
                    <div class="panel panel-info" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title"><font color="white"><?php echo $row2['name']; ?></font></div>
                        </div>
                       
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table table-bordered info-table">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Subject'); ?></strong></td>

                                            <td style="text-align: center;"><strong><?php echo get_phrase('Marks Obtained'); ?></strong></td>


                                            <td style="text-align: center;"><strong><?php echo get_phrase('Out of Mark'); ?></strong></td>
                                           
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Percentage'); ?></strong></td>
                                          <td style="text-align: center;"><strong><?php echo get_phrase('Grade'); ?></strong></td>
<!--<td style="text-align: center;"><a href="<?php echo base_url();?>index.php?admin/mark_message_bulk/<?php echo $class_id;?>/<?php echo $sec_id;?>/<?php echo $student_id;?>/<?php echo $row2['exam_id'];?>" class="btn btn-info">
				<font color="#FFFFFF"><?php echo get_phrase('Send All');?></font></a></td>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $subjects = $this->crud_model->student_marks($student_id, $row2['exam_id'],$class_id,$running_year);

                                        //$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year
                                        //  ))->result_array();
                                        foreach ($subjects as $row3):
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><font color="#000000"><?php echo $row3['name']; ?></font></td>

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


                                                <td style="padding-right:30px">
                                                    <span class="label label-rouded label-danger pull-right"><center><?php echo $row3['mark_total']; ?></center></span>
                                                </td>

                                                

                                                <td style="text-align: center;">
                                                    <?php
                                                    $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
                                                    echo number_format($average, 2, '.', '');
                                                    ?>%
                                                </td>
                                        <td style="text-align: center;">
                                            <?php  //$average = (($row['mark_obtained'] / $row['mark_total']) * 100);
                                                   //echo number_format($average, 2, '.', '');
													$p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
													echo $grd;
													$grade_id=$res['grade_id'];
													
													}
													
													  }
                                            ?>
                                            </td>
                                            <td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/mark_message/<?php echo $class_id;?>/<?php echo $sec_id;?>/<?php echo $student_id;?>/<?php echo $row3['mark_obtained'];?>/<?php echo $row3['mark_total'];?>/<?php echo $average;?>/<?php echo $grade_id;?>/<?php echo $row2['exam_id'];?>/<?php echo $row3['name']; ?>" class="btn btn-info">
				<font color="#FFFFFF"><?php echo get_phrase('Send SMS');?></font></a></td>
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
    ?>
    <?php endforeach; ?>
                                                
                                                
                                                
													
												</div>
                                                <div id="dropdown15" class="tab-pane">
													
                                                   <?php $running_year = get_running_year(); ?>
    <?php echo form_open(base_url() . 'index.php/report/student_print_report/'.$student_id); ?>

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <b><h4 class="page-title"><center><center>&nbsp;&nbsp;&nbsp;<font color="#000000"><?php echo get_phrase('Attendance-Report'); ?></font></center></center></h4> </b></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
           
        </div>
    </div>
    <div class="white-box">
        <div class="row">

            <div class="col-md-12">
      
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info" data-collapsed="0">
                       
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table table-bordered info-table">
                           <thead>
                                        <tr>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Year'); ?></strong></td>

                                            <td style="text-align: center;"><strong><?php echo get_phrase('Month'); ?></strong></td>


                                            <td style="text-align: center;"><strong><?php echo get_phrase('Present'); ?></strong></td>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Late'); ?></strong></td>
                                            <td style="text-align: center;"><strong><?php echo get_phrase('Absent'); ?></strong></td>
                                             <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                              {
			                                 ?>
                                              <td style="text-align: center;"><strong><?php echo get_phrase('No Diary'); ?></strong></td>
                                             <?php } ?>
                                           <td style="text-align: center;"><strong><?php echo get_phrase('Total'); ?></strong></td>
                                          <td style="text-align: center;"><strong><?php echo get_phrase('Percentage'); ?></strong></td>
                                          


                                        </tr>
                                    </thead>
                                     <tbody>
                                     <?php
    if ($monthly_attendance) {
        ?>
        
            <?php foreach ($monthly_attendance as $ma) { ?>
            <tr>
                <td style="text-align: center;"><?php echo $ma->yr; ?></td>
                <td style="text-align: center;"><?php  $ma->mnth; 
				if($ma->mnth==1)
				{
				  echo "January";
				 }
				 else if($ma->mnth==2)
				 {
				    echo "February";
				}
				else if($ma->mnth==3)
				{
				  echo "March";
				}
				else if($ma->mnth==4)
				{
				  echo "April";
				}
				else if($ma->mnth==5)
				{
				  echo "May";
				}
				else if($ma->mnth==6)
				{
				  echo "June";
				}
				else if($ma->mnth==7)
				{
				  echo "July";
				}
				else if($ma->mnth==8)
				{
				  echo "August";
				}
				else if($ma->mnth==9)
				{
				  echo "September";
				}
				else if($ma->mnth==10)
				{
				  echo "October";
				}
				else if($ma->mnth==11)
				{
				  echo "November";
				}
				else if($ma->mnth==12)
				{
				  echo "December";
				}
				?>
                                   
                </td>
                <td style="text-align: center;"><?php echo $ma->present_cnt; ?></td>
                <td style="text-align: center;"><?php echo $ma->late_cnt; ?></td>
                <td style="text-align: center;"><?php echo $ma->absent_cnt; ?></td>


                 <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { ?>
                  <td style="text-align: center;"><?php echo $ma->diary_cnt; ?></td>
                 <?php } ?>
                <td style="text-align: center;">
                    <?php  if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
					$total =  $ma->present_cnt + $ma->absent_cnt + $ma->late_cnt + $ma->diary_cnt;
					}
					else
					{
					$total =  $ma->present_cnt + $ma->absent_cnt + $ma->late_cnt; } ?>
                <?php  if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                   $present =  $ma->present_cnt + $ma->late_cnt + $ma->diary_cnt;}
                   else{
				   $present =  $ma->present_cnt + $ma->late_cnt ;}
                     if($total>0){
                    $perc =  round(($present/$total)*100,2); 
                    }
                    else
                    {
                    $perc =0;} ?>
                    <?php echo $total; ?>
                </td>
                
                <td style="text-align: center;"><?php echo $perc; ?></td>
<?php /*?>                 <?php $section_id=$row['section_id'];
<?php */?>				 
				 
      

             

            </tr>
            <?php } ?>
        </table>
        <?php
    }
    
     ?>
       
            
            </div>
           
            
        
                           <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
                          
        <button type="submit" class="btn btn-info"><?php echo 'Show Report'; ?></button>
        <a href="<?php echo base_url();?>index.php/admin/student_print/<?php echo $student_id;?>/<?php echo $class_id;?>/<?php echo $sec_id;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF"><?php echo get_phrase('Print');?></font></a>

        <input type="hidden" name="year" value="<?php echo $running_year; ?>">
            <div class="col-md-3" style="margin-top: 40px;">
            </div>
            <font color="#FFFFFF">wearfajgkjshrfhseiahrfhesruhrfesamtrfnjksehyucfjmzxcfjixdecfkjdieyfjxdg jkxdhxdx, gvdx,gfvkdsry ygfuxdjgvfl xkcdugvxdgkxdkkgxddgfvxdfgf</font>
            <?php echo form_close(); ?> 
                                                    
                                                    
                                                    
												</div>
											</div>
										</div>


</tbody>

</table>
</div>
</div>
</div></div></div></div></div></div></div></div></div></div></div>

  <?php include_once APPPATH . 'views/footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                if ($.isFunction($.fn.selectBoxIt))s
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
        <script type="text/javascript">
            function select_attendance(month) {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/admin/get_attendance/' + month,
                    success: function (response)
                    {
                        jQuery('#section_holder').html(response);
                    }
					}).complete(function () {
                $(".preloader").hide();
                });
            }
        </script>      
<script type="text/javascript">
function send_sms(class_id,section_id, student_id){
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/attendance_sms/' + class_id + '/' + section_id + '/' + student_id ,
            success: function(response)
            {
				alert(response);
            }
			}).complete(function () {
                $(".preloader").hide();
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
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
			   $("#section_selector").show();
               $("#section_selector1").hide();
                jQuery('#section_selector_holder').html(response);
				 
            }
        });
    }
</script>

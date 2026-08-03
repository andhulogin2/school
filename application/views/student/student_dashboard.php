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
						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<?php $student=$this->session->userdata('login_user_id');
									$this->db->select('name,student_id');
									$this->db->from('student');
									$this->db->where('user_id',$student);
									$query=$this->db->get()->row();
									
               $student_id= $student; 
			   $student_id1=$query->student_id;?>
						<div class="page-header">
							<h1>
								Dashboard
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $query->name;?>
								
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
													<?php $this->db->select('news_code,title');
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
									
			   		$year		=	get_running_year();
				   $class_id     = $this->db->get_where('enroll' , array(
                  'student_id' => $student_id1,'year'=>$year))->row()->class_id;
				   $section_id     = $this->db->get_where('enroll' , array(
                  'student_id' => $student_id1,'year'=>$year))->row()->section_id;
				            // echo $class_id;
				           $monthly_attendance = $this->crud_model->get_attendance_monthly($student_id1);
                           $student_portal_model=$this->crud_model->student_portal_data($student_id1);
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
                                                   <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
					   {?>

												<li>
                                                <a data-toggle="tab" href="#dropdown15">ATTENDANCE REPORT</a>
													
												</li>
                                                <?php } ?>
                                                <li>
													<a data-toggle="tab" href="#profile4">FEE DETAILS</a>
												</li>
											</ul>

											<div class="tab-content row col-md-12">
												<div id="home4" class="tab-pane in active"> 
                                                
                                                 <div class=" row col-md-4"> 
                                                   <div class="white-box">
				<table>								
            <?php
    $student_info = $this->db->get_where('enroll', array('student_id' => $student_id1))->result_array();
    foreach ($student_info as $row){
	//echo $row['student_id'];
        ?>  
        
        <!--<center>
		<?php //if (file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <!--<img src="<?php //echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-responsive"/>-->
                <?php //endif; ?>
                <?php //if (!file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <!--<img src="assets/user.png" class="img-rounded img-responsive"/>
                <?php //endif; ?></center>
            -->
                
                <?php
                /*$destacado = $this->db->get_where('student', array(
                            'student_id' => $row['student_id']))->row()->board;*/
                //if ($destacado == 1):
                   // ?>
                    <!--<center><h5><i class="fa fa-circle m-r-5" style="color: #00a651;"></i>--><?php
					 //echo get_phrase('Excellent'); ?>
                     <!--</h5> </li></center>-->
                <?php //endif; ?>
<!--<center>


											

                <?php
               // echo $student_view['birthday'];
                //list ($day, $month, $year) = split("-", $student_view['birthday']);
               // $now = date("m");
              /*?> if ($now == $month):
                    ?>
                    <center><div class="badge badge-warnig">
                            <i class="icon-present"></i> <?php echo get_phrase('This-Month'); ?>
                        </div></center>
                <?php endif; <?php */?>
				</center><br><br>-->

                
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
                
                
               

            


          <?php echo form_open(base_url() . 'index.php/admin/individual_message/' .$student_id1);?>

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


        </div>
        <?php $student_id = $student_id; ?>
    <?php //} 
	
	echo form_close();
				?>
                </table>
                </div></div>
                <div class="row col-md-12" >
                
                                              <div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<!-- #section:pages/profile.picture -->
												<span class="profile-picture">
                                                
                                                <?php if (file_exists('uploads/student_image/' . $student_id1 . '.jpg')): ?>
													<img class="editable img-responsive" alt="profile picture" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" />
                                                     <?php endif; ?>
                								<?php if (!file_exists('uploads/student_image/' . $student_id1 . '.jpg')): ?>
                  								  <img src="<?php echo base_url(); ?>uploads/user.jpg" class="img-rounded img-responsive"/ alt="student photo">
               									 <?php endif; ?>
												</span>

												<!-- /section:pages/profile.picture -->
												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<span class="white"> 
																<?php foreach($student_portal_model as $student_view) {
																echo $student_view['name'];?>
                                                           		 <?php }?>
                                                            </span>
														</a>

														
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<!-- #section:pages/profile.contact -->
											<div class="profile-contact-info">
												

												<div class="space-6"></div>

												
											</div>

											<!-- /section:pages/profile.contact -->
											<div class="hr hr12 dotted"></div>

											<!-- #section:custom/extra.grid -->
											<div class="clearfix">
												<div class="grid2">
													<span class="bigger-175 blue">Roll No.</span>

													
												</div>

												<div class="grid2">
													<span class="bigger-175 blue"><?php echo $row['roll'];?></span>

													
												</div>
											</div>

											<!-- /section:custom/extra.grid -->
											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											
											

											<!-- #section:pages/profile.info -->
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Registered </div>

													<div class="profile-info-value">
														<span class="editable" id="username"><?php  echo (date('m/d/Y', $student_view['date'])); ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Phone1 </div>

													<div class="profile-info-value">
														<span class="editable" id="city"><?php echo $student_view['phone1'];?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Phone2 </div>

													<div class="profile-info-value">
														<span class="editable" id="age"><?php echo $student_view['phone2']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Sex </div>

													<div class="profile-info-value">
														<span class="editable" id="signup"><?php echo $student_view['sex']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo $student_view['email']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Class </div>

													<div class="profile-info-value">
														<span class="editable" ><?php echo $this->crud_model->get_class_name($row['class_id']); ?></span>
													</div>
                                                  </div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Section </div>

													<div class="profile-info-value">
														<span class="editable" ><?php $sec = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; $sec_id =$row['section_id']; echo $sec;?></span>
													</div>
												</div>
                                                <?php if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True') 
												{
												?>
												<div class="profile-info-row">
													<div class="profile-info-name"> School Name </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php  echo $student_view['school'];?></span>
													</div>
												</div>
												<?php 
												 }
												 ?>  
												<div class="profile-info-row">
													<div class="profile-info-name"> Parent </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo $student_view['parent']; ?></span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Birthday </div>

													<div class="profile-info-value">
														<span class="editable" id="login"><?php echo $student_view['birthday'];?></span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>

													<div class="profile-info-value">
                                                  		<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span class="editable" id="login"><?php echo $student_view['address'];?></span>
													</div>
												</div>
                                                
                                               
                                                
											</div>
                                            </div>
                                            </div>
                                            </div>
                
                
                
                
                <div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#FFFFFF"></i>
														<font color="#FFFFFF">Recent Home Works</font>
													</h4>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-8">
														<!-- #section:pages/profile.feed -->
                                                       
                                                        <?php $home=$this->db->get_where('homework',array('class_id'=>$row['class_id']))->result_array();
                                                        
                                                //echo $row['class_id'];
                                                        foreach($home as $h){
														?>
														<div id="profile-feed-1" class="profile-feed">
															<div class="profile-activity clearfix">
																<div>
                                                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
																	
																	
										<font color="#0066FF"><?php echo $h['title'];?></font> 
																	
																</div>

															<div class="tools action-buttons">
																	<a href="<?php echo base_url(); ?>index.php/student/homeworkroom/details/<?php echo $h['homework_code']; ?>" class="blue">
																		<span class="label">Read</span>
																	</a>

																	
																</div>
															</div>
                                                           
														</div>
                                                       <?php } ?>
														<!-- /section:pages/profile.feed -->
													</div>
												</div>
											</div>
                
                
                
             </div>   
      
             
        </div>   
                                
                

						<div id="profile4" class="tab-pane">
                                    <div style="padding-left:50px;padding-right:50px;">
                                    <h5>Fee Structure</h5>
                                    
                                    <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="0">
                                              <tr>
                                              <th style="text-align: center;" class="table-header"><b>Inst. No</b></th>
                                              <th style="text-align: center;" class="table-header"><b>Due Date</b></th>
                                              <th style="text-align: right;" class="table-header"><b>Total </b></th>
                                              <th style="text-align: right;" class="table-header"><b>Paid </b></th>
                                              <th style="text-align: right;" class="table-header"><b>Concession</b></th>
                                              <th style="text-align: right;" class="table-header"><b>Balance</b></th>
                                            </tr>
                                    <?php
                                    $this->db->select('students_fee_master_id,due_date,fee_amount,fee_balance,fee_concession');
                                    $this->db->from('tbl_students_fee_master');
                                    $this->db->where('class_id',$class_id);
                                    $this->db->where('admission_number',$student_id1);
                                    $this->db->where('fee_amount>0');
                                    $this->db->where('is_deleted','N');
                                    $this->db->order_by("due_date","asc");
                                    
                                    $result=$this->db->get()->result_array();
                                    $no=1;
                                    
                                    $total_amount_to_pay = 0;
                                    $total_amount_paid = 0;
                                    $total_amount_balance = 0;
                                    $total_amount_concession = 0;
                                    $count=0;
                                    
                                                    foreach($result as $data)
                                                    {
                                                        $count=$count+1;
                                                    }
                                                    if($count==0)
                                                    {
                                                        echo "<tr><th style='text-align: center;' colspan='6'><font color='red'><b>Fee Structure Not Assigned</b></font></th>";
                                                        //die();
                                                    }
                                                    else
                                                    {
                                                    
                                    foreach($result as $data)
                                    {
                                    ?>
                                    <tr>
                                     <th style="text-align: center;"  onClick="ShowHide('<?php echo $no;?>')"> <?php echo $no;?> &nbsp;&nbsp;<i class="fa fa-expand" aria-hidden="true"></i></th>
                                     <th style="text-align: center;"><?php echo  date_format(date_create( $data['due_date']),"d-m-Y");?></th>
                                     <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
                                     <th style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];   echo  number_format($paid,2) ;?></th>
                                     <th style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></th>
                                     <th style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></th>
                                    </tr>
                                    <?php
                                    $total_amount_to_pay		 = $total_amount_to_pay+$data['fee_amount'];
                                    $total_amount_paid 			 = $total_amount_paid+$paid;
                                    $total_amount_balance		 = $total_amount_balance+$data['fee_balance'];
                                    $total_amount_concession	 = $total_amount_concession+$data['fee_concession'];
                                    
                                    ?>
                                    <tr>
                                    <td style="padding-left:100px;" colspan="8" align="right">
                                                <table width="100%" border="1"  id = "<?php echo $no;?>"  style="display:none;" >
                                                <TR>
                                                <td class="table-header">SNo.</td>            
                                                <td class="table-header">Fee Head</td>
                                                <td class="table-header">Total</td>
                                                <td class="table-header">Paid</td>
                                                <td class="table-header">Concession</td>
                                                <td class="table-header">Balance</td>
                                                </TR>
                                                
                                                
                                                <?php
                                                $this->db->select('students_fee_master_id,students_fee_details_id,fee_head_id,fee_amount,fee_balance,fee_concession');
                                                $this->db->from('tbl_students_fee_details');
                                                $this->db->where('students_fee_master_id',$data['students_fee_master_id']);
                                                $this->db->where('fee_amount>0');
                                                $this->db->order_by("fee_head_id","asc");
                                                
                                                $result1=$this->db->get()->result_array();
                                                
                                                $i=1;
                                                foreach( $result1 as $row)
                                                {
                                                
                                                $fee_head = get_fee_head_name($row['fee_head_id']);
                                                $fee_total =number_format($row['fee_amount'],2);
                                                $fee_concession = number_format($row['fee_concession'],2);
                                                $fee_balance = number_format($row['fee_balance'],2);
                                                $fee_paid= number_format($row['fee_amount']-$row['fee_balance']-$row['fee_concession'],2);
                                                 ?>
                                                            
                                                     <TR>
                                                    <td align="center"><?php echo $i; $i=$i+1; ?></td>
                                                    <td style="padding-left:20px;padding-right:20px;"><?php echo $fee_head;?></td> 
                                                    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_total;?></td> 
                                                    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_paid;?></td>
                                                    <td  align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_concession;?></td> 
                                                    <td align="right" style="padding-left:20px;padding-right:20px;"><?php echo $fee_balance ;?></td>
                                                        
                                                    </TR>
                                                <?php } ?>
                                                        
                                                </table>
                                    </td>
                                    </tr>
                                    <?php $no++;} ?>
                                    <tr>
                                     <td style="text-align: center;" colspan="2"><b>Total</b></td>
                                     <td style="text-align: right;"><b><?php echo  number_format($total_amount_to_pay,2) ;?></b></td>
                                     <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
                                     <td style="text-align: right;"><b><?php echo  number_format($total_amount_concession,2) ;?></b></td>
                                     <td style="text-align: right;"><b><?php echo  number_format($total_amount_balance,2) ;?></b></td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                    </table>
                                    
                                    
                                    <!----- Fee Payment Details-->
                                    <h5> Fee Payment Details</h5>
                                    <?php
                                            $this->db->where('admission_number', $student_id1);
                                            $this->db->where('class_id', $class_id);
                                            $this->db->where('batch_id', $section_id);
                                            $this->db->select('admission_number,date_paid,receipt_number,fee_head,fee_amount');
                                            //$this->db->group_by('receipt_number','asc');
                                            $this->db->order_by('receipt_number','asc');
                                            $this->db->from('view_fee_collection_details');
                                            
                                            $fee_details		=	$this->db->get()->result_array();
                                    ?>
                                                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" width="60%">
                                                  <thead>
                                                  <tr>
                                                  <th style="text-align: center;" class="table-header"><b>SlNo</b></th>
                                                  <th style="text-align: center;" class="table-header"><div align="center"><b>Date Paid</b></div></th>
                                                  <th style="text-align: right;" class="table-header"><div align="center"><b>Receipt No.</b></div></th>
                                                 <th style="text-align: right;" class="table-header"><div align="center"><b> Fee Head</b></div></th>
                                                  <th style="text-align: right;" class="table-header"><b> Amount</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                    <?php
                                    $total_amount_paid = 0;
                                    $count=0;
                                    foreach($fee_details as $data)
                                    {
                                    $count=$count+1;
                                    }
                                    if($count==0)
                                    {
                                    echo "<tr><th style='text-align: center;' colspan='5'><font color='red'><b>No Fee Payment Details Found</b></font></th></table>";
                                    }
                                    else
                                    {
                                    $sno=1;
                                    foreach($fee_details as $data)
                                    {
                                    ?>
                                    <tr>
                                     <th style="text-align: right;"><?php echo  $sno ;?></th>
                                     <th style="text-align: right;"><div align="center"><?php echo date('d-m-Y',strtotime($data['date_paid']));?></div></th>
                                     <th style="text-align: right;"><div align="center"><?php echo $data['receipt_number'] ;?></div></th>
                                     <th style="text-align: right;"><div align="center"><?php echo $data['fee_head'] ;?></div></th>
                                    
                                     <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
                                    </tr>
                                    <?php
                                    $total_amount_paid		 = $total_amount_paid+$data['fee_amount'];
                                    $sno=$sno+1;
                                    }
                                    ?>
                                    <tr>
                                     <td style="text-align: center;" colspan="4"><b>Total</b></td>
                                     <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <?php
                                    }
                                    ?>
                                    
                                    </div>												
                         </div>
   <?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
					   {?>
												<div id="dropdown14" class="tab-pane">
                                                
                                                <?php $student_info = $this->crud_model->get_student_info($student_id1);
	//$exams=$this->db->get_where('exam',array('class_id'=>$row['class_id']))->row()->description
 $exams = $this->crud_model->get_exams($class_id);
    foreach ($student_info as $row1):
        foreach ($exams as $row2):
            ?>
            <div class="row">
                <div >
                    <div class="panel panel-info" data-collapsed="0">
                       
                            <div class="table-header"><font color="white"><?php echo $row2['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rank:<?php 
							if(get_rank($row2['exam_id'],$student_id1)==''){
							echo "--";}
							else{
							echo get_rank($row2['exam_id'],$student_id1);}?></font></div>
                       
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

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $subjects = $this->crud_model->student_marks($student_id1, $row2['exam_id'],$class_id,$running_year);

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
                                                <?php } ?>
                                                <div id="dropdown15" class="tab-pane">
													
                                                   <?php $running_year = get_running_year(); ?>
    <?php echo form_open(base_url() . 'index.php/report/student_print_report/'.$student_id1); ?>

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
                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Year'); ?></strong></td>

                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Month'); ?></strong></td>


                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Present'); ?></strong></td>
                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Late'); ?></strong></td>
                                            <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Absent'); ?></strong></td>
                                             <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                              {
			                                 ?>
                                              <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('No Diary'); ?></strong></td>
                                             <?php } ?>
                                           <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Total'); ?></strong></td>
                                          <td style="text-align: center;" class="table-header"><strong><?php echo get_phrase('Percentage'); ?></strong></td>
                                          


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
       
        <?php
    }
    
     ?>
       
            </tbody>

</table>

            </div>
           
            
        
                           <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
                          
        <button type="submit" class="btn btn-info"><?php echo 'Show Report'; ?></button>
        <a href="<?php echo base_url();?>index.php/admin/student_print/<?php echo $student_id1;?>/<?php echo $class_id;?>/<?php echo $sec_id;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF"><?php echo get_phrase('Print');?></font></a>

        <input type="hidden" name="year" value="<?php echo $running_year; ?>">
            <div class="col-md-3" style="margin-top: 40px;">
            </div>
            
            <?php echo form_close(); ?> 
                                                    
                                                    
                                                    
												
</div></div></div></div></div></body>


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
function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
}
</script>

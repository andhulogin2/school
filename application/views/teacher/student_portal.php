<?php include_once APPPATH . 'views/teacher_head.php';?>
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
							<li class="active">Student Portal</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
					
						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
                        
							<h1>
								Student Profile
								<i class="ace-icon fa fa-angle-double-right"></i>
									 <?php 
									 $student_name=$this->db->get_where('student',array('student_id'=>$student_id))->row()->name;
									 echo $student_name;?>
							</h1>
                            <div align="right" style="padding-right:10px"> 
                              <?php
							  $year	=	get_running_year();
							  $cls= $this->db->get_where('enroll',array('student_id'=>$student_id,'year'=>$year))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/teacher/student_view/<?php echo $cls;?>"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
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
                                
									
                                        <?php
									
									
               $student_id= $student_id; 
			   
				   $class_id     = $this->db->get_where('enroll' , array(
                  'student_id' => $student_id))->row()->class_id;
				          
				   ?>
								<div class="col-sm-12">
										<!-- #section:elements.tab.option -->
										
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



        </div>
       
        <?php $student_id = $student_id; ?>
    <?php } 
	 echo form_close();
	
				?>
                </table>
                </div></div>
                
               
                
</div></div></div></div></div></div></div></div></div></div></div></div>


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

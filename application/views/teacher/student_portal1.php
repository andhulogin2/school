<?php include_once APPPATH . 'views/teacher_head.php';?>
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
							<li class="active">Student Profile</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Student Profile
								
							</h1>
						</div>




<div class="main_data">
	<div class="row">
	<div class="col-md-12">
<div align="right" style="padding-right:10px">  
                              <a href="<?php echo base_url();?>index.php/Teacher/student_view/"><b><button class="btn-info">Back</button></b></a> 
 </div>   
 
   <?php
   $year    =   get_running_year();
    $student_info = $this->db->get_where('enroll', array('student_id' => $student_id,'year'=>$year))->result_array();
    foreach ($student_info as $row){
	//echo $row['student_id'];
        ?>  
        <div class="profile-user-info profile-user-info-striped">
        <center><?php if (file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-responsive"/>
                <?php endif; ?>
                <?php if (!file_exists('uploads/student_image/' . $student_id . '.jpg')): ?>
                    <img src="<?php echo base_url(); ?>uploads/user.jpg" class="img-rounded img-responsive"/>
                <?php endif; ?></center>
            <div class="white-box">
                <center><h4> <?php foreach($student_portal_model as $student_view) {
					echo $student_view['name'];
                ?></h4></center>
                
                
                
                
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
              
                
                
                
                
                
                
                        
                        <?php } } ?>  
		
        
        
        
        
        </div>
    </div>
</div></div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>


<?php
  include_once APPPATH . 'views/main_head.php';  
$running_year = get_running_year();
?>

   
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
							<li class="active">Students</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon"></span>
									
							</form>
						</div><!-- /.nav-search -->

					</div>

					
						<div class="page-header">
							<h1>
								Students
								
									<i class="ace-icon fa fa-angle-double-right"></i>
								View
							</h1>
                 <?php if($role==2 ||$role==1)  {
                     ?>
 <div align="right" style="padding-right:10px"><a href="<?php echo base_url();?>index.php/report/student_area_print_report_all/"><h5><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></h5></a></div> 
       		        <?php
                 }
                 ?>
                            
						</div>
                        
                         
                     
                       
                        <!-- /.page-header -->
                        
                    
                                   
                                   
     <?php if($role==2 ||$role==1)  {
								   
			   $this->db->where('is_deleted','N');
			   $branch =$this->db->get('tbl_branch')->result_array();
			  foreach($branch as $row1) {?>
              
              
              
     <div class="pull-right">
               <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$row1['branch_id'] ?>" style="padding-right:20px"><h5><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></h5></a> 
      </div>
              
              
              
              
               <div id="hidden" style="padding-top:50px;"></div>
								<div class="row">
                                <div class="col-md-offset-5"> <label><b><font size="+1"><?php echo "Branch : ".$row1['branch_name']?></font></b></label></div>
 						<div class="col-sm-12 infobox-container" >
                                        <?php  
                                        $has_classes_in_branch = false;
                                        foreach($class as $row){
											  if($row['branch_id']==$row1['branch_id']) { 
                                                  $has_classes_in_branch = true;
                                                  ?>  
										<div class="infobox infobox-red" style="height:120px;" >
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data" >
												<span class="infobox-data-number"></span>
												<div class="infobox-content">
                                                
                                              
												<b><a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name'];?></a></b></div>
                                                <div class="infobox-content">
												<b>
                                                <?php 
$running_year = get_running_year();
												$this->db->select('count(enroll_id) as student_count');
												$this->db->where('class_id',$row['class_id']);
$this->db->where('year',$running_year);
												$this->crud_model->check_student_status();
$this->db->join('student s','s.student_id=enroll.student_id','LEFT');
												$st_count=$this->db->get('enroll')->row();?>
<a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>">                                            Total Students:<?php echo $st_count->student_count;?></a>
</b></div>
											</div>
										</div>
  <?php } }
  if (!$has_classes_in_branch) { ?>
      <div class="col-sm-12 text-center text-muted" style="padding-bottom: 15px;">
          <small><i>No classes registered for this branch in <?php echo $running_year; ?></i></small>
      </div>
  <?php } ?>
										

</div></div>

                                 
          <?php } }?>  
          
          
          
           <?php if($role==3)  {
				
				$branch_id=$this->session->userdata('branch_id');
								   
			   $this->db->where('is_deleted','N');
			   $this->db->where('branch_id',$this->session->userdata('branch_id'));
			   $dept =$this->db->get('tbl_department')->result_array();
			  foreach($dept as $row1) {?>
              
              
              
              
                <div id="hidden" style="padding-top:50px;"></div>
                
                 <div class="pull-right">
               <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$branch_id.'/'.$row1['dept_id'] ?>" style="padding-right:20px"><h5><i class="fa fa-file-excel-o" aria-hidden="true"></i>Download</h5></a> 
      </div>
                
								<div class="row">
                                <div class="col-md-offset-5"> <label><b><font size="+1"><?php echo "Department : ".$row1['dept_name']?></font></b></label></div>
 						<div class="col-sm-12 infobox-container" >
										
                                        <?php 
										
										$this->db->where('academic_year',$running_year);
										$this->db->where('dept_id',$row1['dept_id']);
	                                    $classes=$this->db->get('class')->result_array();
										
										 foreach($classes as $row){ ?>
										<div class="infobox infobox-red" style="height:120px;" >
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data" >
                                           
												<span class="infobox-data-number"></span>
												<div class="infobox-content">
                                                
                                              
												<b><a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name'];?></a></b></div>
                                                <div class="infobox-content">
												<b>
                                                <?php 
$running_year = get_running_year();
												$this->db->select('count(enroll_id) as student_count');
												$this->db->where('class_id',$row['class_id']);
$this->db->where('year',$running_year);
												$this->crud_model->check_student_status();
$this->db->join('student s','s.student_id=enroll.student_id','LEFT');
												$st_count=$this->db->get('enroll')->row();?>
<a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>">                                                Total Students:<?php echo $st_count->student_count;?></a>
</b></div>
											</div>
                                          
										</div>
  <?php  }?>
										

</div></div>
                                 
          <?php } }?>          
          
          
          
          
          
           <?php if($role>=4)  { 
           $branch_id=$this->session->userdata('branch_id');
           $dept_id=$this->session->userdata('dept_id');
           ?>
								   
 <div id="hidden" style="padding-top:50px;"></div>
            <div class="pull-right">
               <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$branch_id.'/'.$dept_id ?>" style="padding-right:20px"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a>
               <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all_pdf/'.$branch_id.'/'.$dept_id ?>" style="padding-right:20px"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
            </div>               
            <?php
			if($this->db->get_where('settings',array('type'=>'non_migrated_students_list'))->row()->description=='yes')
			{
			?>
                <div class="row">
                    <div class="col-md-12" style="padding-left:70px;padding-bottom:10px;">
                        <a href="<?php echo base_url().'index.php/Admin/directly_added_students'; ?>"><span>Directly Added Students</span></a>
                    </div>    
                </div> 
            <?php
			}
			?>        
								<div class="row">
                                
                                
				 					

									<div class="col-sm-12 infobox-container" >
										<!-- #section:pages/dashboard.infobox -->
                                         <?php
										  foreach($class as $row){
										  ?>
                                          
										<div class="infobox infobox-red" style="height:120px;" >
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data" >
                                           
												<span class="infobox-data-number"></span>
												<div class="infobox-content">
												<b><a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name'];?></a></b></div>
                                                <div class="infobox-content">
												<b>
                                                <?php 
$running_year = get_running_year();
												$this->db->select('count(enroll_id) as student_count');
												$this->db->where('class_id',$row['class_id']);
$this->db->where('year',$running_year);
												$this->crud_model->check_student_status();
$this->db->join('student s','s.student_id=enroll.student_id','LEFT');
												$st_count=$this->db->get('enroll')->row();?>
<a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>">                                                Total Students:<?php echo $st_count->student_count;?></a>
</b></div>
											</div>
                                          
										</div>
  <?php }?>
										

</div></div>                                 
          <?php } ?>                                                    
                             

























</div>
</div>
<br /><br /><br /><br /> <br />
											
			<?php include_once APPPATH . 'views/footer.php'; ?>
            
            
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 

<script type="text/javascript">  
   $(window).load(function() {  
      $("#loader").fadeOut(1000);  
   });
</script>  	

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
</script>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>


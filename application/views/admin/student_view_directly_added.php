<?php
$role=$this->session->userdata('role');
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
								Directly Added
							</h1>
                 <?php if($role==2 ||$role==1)  {
				 	$branch_id="";
					$dept_id="";
                     ?>
 <div align="right" style="padding-right:10px"><a href="<?php echo base_url();?>index.php/report/student_area_print_report_all/<?php echo $branch_id; ?>/<?php echo $dept_id; ?>/non_migrated"><h5><button class="btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Download</button></h5></a></div>
       		        <?php
                 }
                 ?>
                            
						</div>
                        <div style="text-align:right;padding-right:20px;">
                        	<a href="<?php echo base_url();?>index.php/Admin/student_veiw/">Back</a>	
                        </div>
                         
                     
                       
                        <!-- /.page-header -->
                        
                    
                                   
                                   
			<?php 
			if($role==2 ||$role==1)  
			{
				$dept_id="";
				$this->db->where('is_deleted','N');
				$branch =$this->db->get('tbl_branch')->result_array();
				foreach($branch as $row1) 
				{
			?>
              
              
              
                    <div class="pull-right">
                        <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$row1['branch_id'].'/'.$dept_id.'/non_migrated' ?>" style="padding-right:20px"><h5><button class="btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Download</button></h5></a> 
                    </div>
                      
                    <div id="hidden" style="padding-top:50px;"></div>
                    <div class="row">
                        <div class="col-md-offset-5"> 
                            <label><b><font size="+1"><?php echo "Branch : ".$row1['branch_name']?></font></b></label>
                        </div>
                        <div class="col-sm-12 infobox-container" >
                            <?php  
                            foreach($class as $row)
                            {
                                if($row['branch_id']==$row1['branch_id']) 
                                { 
                                ?>  
                                <div class="infobox infobox-red" style="height:120px;" >
                                    <div class="infobox-icon"><i class="ace-icon fa fa-graduation-cap"></i></div>
                            
                                    <div class="infobox-data" >
                                        <span class="infobox-data-number"></span>
                                        <div class="infobox-content">
                                            <b><a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated"><?php echo $row['name'];?></a></b>
                                        </div>
                                        <div class="infobox-content">
                                            <b>
                                                <?php 
                                                $running_year = get_running_year();
                                                $this->db->select('count(enroll_id) as student_count');
                                                $this->db->where('class_id',$row['class_id']);
                                                $this->db->where('year',$running_year);
												$this->db->where('is_migrated!=','Y');
                                                $this->crud_model->check_student_status();
                                                $this->db->join('student s','s.student_id=enroll.student_id','LEFT');
                                                $st_count=$this->db->get('enroll')->row();
                                                ?>
                                                <a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated">                                                Total Students:<?php echo $st_count->student_count;?>
                                                </a>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                } 
                            }
                            ?>
                        </div>
                    </div>
          			<?php 
				} 
			}
			if($role==3)  
			{
				$branch_id=$this->session->userdata('branch_id');
								   
				$this->db->where('is_deleted','N');
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$dept 	=	$this->db->get('tbl_department')->result_array();
				foreach($dept as $row1) 
				{
				?>
                <div id="hidden" style="padding-top:50px;"></div>
                <div class="pull-right">
               		<a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$branch_id.'/'.$row1['dept_id'].'/non_migrated' ?>" style="padding-right:20px"><h5><button class="btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Download</button></h5></a>
      			</div>
                <div class="row">
                    <div class="col-md-offset-5"> <label><b><font size="+1"><?php echo "Department : ".$row1['dept_name']?></font></b></label></div>
                    	<div class="col-sm-12 infobox-container" >
										
							<?php 
                            $this->db->where('academic_year',$running_year);
                            $this->db->where('dept_id',$row1['dept_id']);
                            $classes=$this->db->get('class')->result_array();
                            
                            foreach($classes as $row)
							{ 
							?>
                            	<div class="infobox infobox-red" style="height:120px;" >
                            		<div class="infobox-icon"><i class="ace-icon fa fa-graduation-cap"></i></div>
                            
                            		<div class="infobox-data" >
                            
                            			<span class="infobox-data-number"></span>
                            			<div class="infobox-content">
                            				<b>
                                            	<a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated"><?php echo $row['name'];?></a>
                                            </b>
                                       	</div>
                            			<div class="infobox-content">
                            			<b>
											<?php 
                                            $running_year = get_running_year();
                                            $this->db->select('count(enroll_id) as student_count');
                                            $this->db->where('class_id',$row['class_id']);
                                            $this->db->where('year',$running_year);
											$this->db->where('is_migrated!=','Y');
                                            $this->crud_model->check_student_status();
                                            $this->db->join('student s','s.student_id=enroll.student_id','LEFT');
                                            $st_count=$this->db->get('enroll')->row();
											?>
                                            <a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated">                                                Total Students:<?php echo $st_count->student_count;?></a>
                            			</b>
                                 	</div>
                            	</div>
                            
                    		</div>
                            <?php  
							}
							?>
										
					</div>
               	</div>
          		<?php 
				} 
			}
			if($role==4 || $role==12)  
			{ 
				$branch_id=$this->session->userdata('branch_id');
				$dept_id=$this->session->userdata('dept_id');
           		?>
								   
                <div class="pull-right" style="padding-right:50px;padding-bottom:10px">
               		<a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all/'.$branch_id.'/'.$dept_id.'/non_migrated' ?>" style="padding-right:20px"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a>
               		<a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_all_pdf/'.$branch_id.'/'.$dept_id.'/non_migrated' ?>" style="padding-right:20px"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a>
            	</div>               
                <div class="row">
                    <div class="col-sm-12 infobox-container" >
                    
						<?php
                        foreach($class as $row)
						{
                        ?>
                        
                            <div class="infobox infobox-red" style="height:120px;" >
                            	<div class="infobox-icon"><i class="ace-icon fa fa-graduation-cap"></i></div>
                    
                    			<div class="infobox-data" >
                    
                    				<span class="infobox-data-number"></span>
                    				<div class="infobox-content">
                    					<b><a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated"><?php echo $row['name'];?></a></b>
                                    </div>
                    				<div class="infobox-content">
                    					<b>
											<?php 
                                            $running_year = get_running_year();
                                            $this->db->select('count(enroll_id) as student_count');
                                            $this->db->where('class_id',$row['class_id']);
                                            $this->db->where('year',$running_year);
											$this->db->where('is_migrated!=','Y');
                                            $this->crud_model->check_student_status();
                                            $this->db->join('student s','s.student_id=enroll.student_id','LEFT');
                                            $st_count=$this->db->get('enroll')->row();?>
                                            <a href="<?php echo base_url(); ?>index.php/admin/students_area/<?php echo $row['class_id']; ?>/0/non_migrated">                                                Total Students:<?php echo $st_count->student_count;?></a>
                                        </b>
                                  	</div>
                    			</div>
                    
                    		</div>
                    		<?php 
						}
						?>
                	</div>
              	</div>                                 
          		<?php 
			} 
			?>                                                    
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


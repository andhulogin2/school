<?php
 $role=$this->session->userdata('role');
   include_once APPPATH . 'views/main_head.php';  
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
							<li class="active">Complaints</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Complaints
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div>


<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		 <div class="table-responsive">
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;" class="table-header">No.</th>
            
            <th style="text-align: center;" class="table-header"><div>Teacher</div></th>
             <?php 
														if($role==1 || $role==2)
														{
														?>
                                                        <th class="table-header">Branch</th>
                                                        <th class="table-header">Department</th>
                                                        <?php
														}
														if($role==3)
														{
														?>
                                                        <th class="table-header">Department</th>
                                                        <?php
														}
														?>
            <th style="text-align: center;" class="table-header"><div>Details</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>
            <th style="text-align: center;" class="table-header"><div>Student</div></th>
            <th style="text-align: center;" class="table-header"><div>Class</div></th>
            <th style="text-align: center;" class="table-header"><div>Phone</div></th>
            <th style="text-align: center;" class="table-header" colspan="2"><div>Actions</div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->select('c.report_id,c.title,c.report_code,c.priority,c.description,c.timestamp,c.branch_id,c.dept_id,c.student_id,t.name as teacher,s.name as student,e.class_id,e.section_id,s.phone1');
		$this->db->from('reporte_alumnos c');
		$this->db->join('staff t','t.staff_id=c.teacher_id','LEFT');
		$this->db->join('student s','s.student_id=c.student_id','LEFT');
		$this->db->join('enroll e','c.student_id=e.student_id','LEFT');
		if($role==4 || $role==12)
		{
			$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
			$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		}
		
		$complaints	=$this->db->get()->result_array();
		if(count($complaints)>0)
		{
		foreach($complaints as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
         <td style="text-align: center;"><?php echo $row['teacher'];?></td>
          <?php
				  if($role==1 || $role==2)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_branch' , array('branch_id' =>$row['branch_id']))->row()->branch_name;?>
                  </td>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_department' , array('dept_id' =>$row['dept_id']))->row()->dept_name;?>
                  </td>
                  <?php
				  }
				  if($role==3)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_department' , array('dept_id' =>$row['dept_id']))->row()->dept_name;?>
                  </td>
                  <?php
				  }
				  ?>
				  
          <td><b><?php echo $row['title'];?></b><br /><?php echo $row['description'];?></td>
    <td style="text-align: center;"><?php echo $row['timestamp'];?></td>
     <td style="text-align: center;"><?php echo $row['student'];?></td>
     <td style="text-align: center;"><?php echo get_class_name($row['class_id'])."/".get_section_name($row['section_id']);?></td>
     <td style="text-align: center;"><?php echo $row['phone1'];?></td>
     
		<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/complaint_description_view/details/<?php echo $row['report_code'];?>">
               Send Remark
                </a>
			</td>
		<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/delete_complaints/<?php echo $row['report_id'];?>">
               Delete
                </a>
                
			</td>
		</tr>
		<?php endforeach;
		}
		else
		{
		?>
        <tr>
        	<td colspan="9" style="color:#FF0000"><center>No records found.</center></td>
        </tr>
        <?php
		}
		?>
	</tbody>
</table>
</div>
			</div>
		</div>
		</div>
		</div>
	</div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script>
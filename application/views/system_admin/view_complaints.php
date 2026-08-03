<?php include_once APPPATH . 'views/head.php';?>
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
			<th style="text-align: center;" class="table-header"><div>Title</div></th>
            <th style="text-align: center;" class="table-header"><div>Teacher</div></th>
            <th style="text-align: center;" class="table-header"><div>Details</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>
            <th style="text-align: center;" class="table-header"><div>Student</div></th>
            <th style="text-align: center;" class="table-header" colspan="2"><div>Actions</div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->select('c.title,c.report_code,c.priority,c.description,c.timestamp,t.name as teacher,s.name as student');
		$this->db->from('reporte_alumnos c');
		$this->db->join('teacher t','t.teacher_id=c.teacher_id','LEFT');
		$this->db->join('student s','s.student_id=c.student_id','LEFT');
		
		
		$complaints	=$this->db->get()->result_array();
		foreach($complaints as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		<td style="text-align: center;"><?php echo $row['title'];?></td>
         <td style="text-align: center;"><?php echo $row['teacher'];?></td>
          <td style="text-align: center;"><?php echo $row['description'];?></td>
    <td style="text-align: center;"><?php echo $row['timestamp'];?></td>
   
     <td style="text-align: center;"><?php echo $row['student'];?></td>
     
    
		<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/complaint_description_view/details/<?php echo $row['report_code'];?>">
               Send Remark
                </a>
                
			</td>
		</tr>
		<?php endforeach;?>
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
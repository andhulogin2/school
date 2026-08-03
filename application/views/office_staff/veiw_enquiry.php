<?php include_once APPPATH . 'views/office_staff_head.php';?>
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
							<li class="active">Enquiry</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Enquiry
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div>


<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;" class="table-header">No.</th>
			<th style="text-align: center;" class="table-header"><div>Title</div></th>
             <th style="text-align: center;" class="table-header"><div>Details</div></th>
           
              <th style="text-align: center;" class="table-header"><div>Student</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>
            <th style="text-align: center;" class="table-header"><div>Actions</div></th>

            
           

		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->select('e.enquiry_id,e.title,e.description,e.date,e.branch_id,e.dept_id,s.name');
		$this->db->from('enquiry e');
		$this->db->join('student s','e.student_id=s.student_id','LEFT');
		
		
		$enquiry=$this->db->get()->result_array();
		foreach($enquiry as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		<td style="text-align: center;"><?php echo $row['title'];?></td>
        <td style="text-align: center;"><?php echo $row['description'];?></td>
       
        <td style="text-align: center;"><?php echo $row['name'];?></td>
    <td style="text-align: center;"><?php echo $row['date'];?></td>
     
   
    
		<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/enquiry_description_view/details/<?php echo $row['enquiry_id'];?>">
               Reply
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
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script>
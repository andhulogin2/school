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
		
				<table id="simple-table" class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;" class="table-header">No.</th>
			<th style="text-align: center;" class="table-header"><div>Title</div></th>
             <th style="text-align: center;" class="table-header"><div>Details</div></th>
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
              <th style="text-align: center;" class="table-header"><div>Student</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>
      <!--      <th style="text-align: center;" class="table-header"><div>Actions</div></th> -->

            
           

		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->select('e.enquiry_id,e.title,e.description,e.date,e.branch_id,e.dept_id,s.name');
		$this->db->from('enquiry e');
		$this->db->join('student s','e.student_id=s.student_id','LEFT');
		if($role==4 || $role==12)
		{
			$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
			$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		}
		
		$enquiry=$this->db->get()->result_array();
		if(count($enquiry)>0)
		{
		foreach($enquiry as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		<td style="text-align: center;"><?php echo $row['title'];?></td>
        <td style="text-align: center;"><?php echo $row['description'];?></td>
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
        <td style="text-align: center;"><?php echo $row['name'];?></td>
    <td style="text-align: center;"><?php echo $row['date'];?></td>
     
   
    
	<!--	<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/enquiry_description_view/details/<?php echo $row['enquiry_id'];?>">
               Reply
                </a>
                
			</td> -->
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
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  



<script type="text/javascript">
$(function() {
	$('#simple-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       

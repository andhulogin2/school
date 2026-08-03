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
								<a href="#">Home</a>							</li>
							<li class="active">Call Details</li>
						    <li class="active">View Call Details</li>
						</ul>
				    <!-- /.breadcrumb -->

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
					<div class="page-content">
						
                        <div class="page-header">
							<h1>Call Details<small>
									<i class="ace-icon fa fa-angle-double-right"></i>View Call Details</small>
							</h1>
						</div>
	
	<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	<div class="white-box">
	<div class="tab-content">
			<div class="tab-pane active" id="running">
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;">No.</th>
			<th style="text-align: center;"><div>Date</div></th>
            <th style="text-align: center;"><div>Called By</div></th>
			
            <th style="text-align: center;"><div>Remark</div></th>
			
			<th style="text-align: center;"><div>Options</div></th>
			
		</tr>
	</thead>					
						
	<tbody>
		<?php
    $d=date("d-m-Y");		
     $counter = 1;
		
		$call	=	$this->db->get_where('tbl_enquiry_followups',array('enquiry_id'=>$enquiry_id,'date'=>$d))->result_array();
		foreach($call as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		
	 <td><?php echo $row['date'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['remark'];?></td>
    <td style="text-align: center;">
        <a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>index.php/enquiry_controller/edit_call/<?php echo $row['call_id'] ?>">
            Edit
        </a>
        <a id="archive_link" class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>index.php/enquiry_controller/delete_call/<?php echo $row['call_id'] ?>">
            Delete
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
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script> 						
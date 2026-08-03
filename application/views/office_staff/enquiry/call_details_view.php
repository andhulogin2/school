<?php include_once APPPATH . 'views/main_head.php';?>
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
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>Call Details
									<i class="ace-icon fa fa-angle-double-right"></i>View Call Details
							</h1>
						</div>
	<div>				
	  <div align="right">
	   <table>
	   <tr>
      <td><a class="btn btn-info "  href="<?php echo base_url();?>index.php/enquiry_controller/call_details/<?php echo $enquiry_id ?>">Add Call</a> </td>	
	 <td><a class="btn btn-info "  href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/">Back</a> </td></tr>	
     </table>
  </div>
	</div>
    </div>
	<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	
		<div class="tab-content">
			<div class="tab-pane active" id="running">
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;"  class="table-header">No.</th>
			<th style="text-align: center;"  class="table-header"><div>Date</div></th>
            <th style="text-align: center;"  class="table-header"><div>Called By</div></th>
            <th style="text-align: center;"  class="table-header"><div>Next Follow up Date</div></th>

            <th style="text-align: center;"  class="table-header"><div>Remark</div></th>
			
			<th style="text-align: center;"  class="table-header"><div>Options</div></th>
			
		</tr>
	</thead>					
						
	<tbody>
		<?php		
     $counter = 1;
		
		$call	=	$this->db->get_where('tbl_enquiry_followups',array('enquiry_id'=>$enquiry_id))->result_array();
		foreach($call as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		
	 <td><?php echo $row['date'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['next_followup_date'];?></td>

    <td><?php echo $row['remark'];?></td>

    
		<td style="text-align: center;">
           &nbsp;&nbsp;&nbsp;
								
         <a href="<?php echo base_url();?>index.php/enquiry_controller/edit_call/<?php echo $row['call_id'] ?>" data-toggle="tooltip" data-placement="top"title=" Edit/View" data-original-title="Edit/View"> <span class="green">
		 <i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
         </a>
    
             &nbsp;&nbsp;&nbsp;
   
        <a href="<?php echo base_url();?>index.php/enquiry_controller/delete_call/<?php echo $row['call_id'] ?>/<?php echo $enquiry_id ?>" data-toggle="tooltip"  data-placement="top" title="Delete" data-original-title="Delete"> <span class="red">
		<i class="ace-icon fa fa-trash-o bigger-120"></i> </span>
        </a>
			
            	
             
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
</div></div></div></div></div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script> 
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>


						
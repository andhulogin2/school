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
							<li class="active">News</li>
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
								News
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									  View
								
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
			<th style="text-align: center;" class="table-header">No.</th>
            <?php $role=$this->session->userdata('role');
				if($role==1 ||$role==2)
				{?>
                <th style="text-align: center;" class="table-header"><div>Branch</div></th>
                 <th style="text-align: center;" class="table-header"><div>Department</div></th>
                <?php }?>
                
                <?php if($role==3)
				{?>
                
                 <th style="text-align: center;" class="table-header"><div>Department</div></th>
                <?php }?>
			<th style="text-align: center;" class="table-header"><div>Title</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>

			<th style="text-align: center;" colspan="3" class="table-header"><div>Options</div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->join('tbl_branch', 'news.branch_id = tbl_branch.branch_id', 'left');
		$this->db->join('tbl_department', 'news.dept_id = tbl_department.dept_id', 'left');
		$this->db->order_by('news_id' , 'desc');
		 if($role==3)
		 {
		 $this->db->where('news.branch_id',$this->session->userdata('branch_id'));
		 }
		 if($role==4)
		 {
		 $this->db->where('news.dept_id',$this->session->userdata('dept_id'));
		 }
		$news	=	$this->db->get('news')->result_array();
		foreach($news as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
    <?php if($role==1 ||$role==2)
				{?>
               <td style="text-align: center;"><?php echo $row['branch_name'];?></td>
                <td style="text-align: center;"><?php echo $row['dept_name'];?></td>
                <?php }?>
                 <?php if($role==3)
				{?>
              
                <td style="text-align: center;"><?php echo $row['dept_name'];?></td>
                <?php }?>
    
		<td style="text-align: center;">
			<a href="<?php echo base_url();?>index.php/admin/news_view/details/<?php echo $row['news_code'];?>"><?php echo $row['title'];?></a>
    </td>
    <td style="text-align: center;">
			<?php echo $row['news_status'];?>
    </td>
		<td style="text-align: center;" class="text-nowrap">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php/admin/news_view/details/<?php echo $row['news_code'];?>">
               View
                </a></td>
                
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
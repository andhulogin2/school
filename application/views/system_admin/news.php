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
			<th style="text-align: center;" class="table-header"><div>Title</div></th>
            <th style="text-align: center;" class="table-header"><div>Date</div></th>

			<th style="text-align: center;" colspan="3" class="table-header"><div>Options</div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		//$this->db->where('news_status' , 1);
		$this->db->order_by('news_id' , 'desc');
		$news	=	$this->db->get('news')->result_array();
		foreach($news as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
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
                <td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php/admin/news/delete/<?php echo $row['news_code'];?>" class="btn-sm btn-icon icon-left" onclick="return confirm('Are-you-sure');">
              			
                  		 <i class="fa fa-close text-danger"></i>
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
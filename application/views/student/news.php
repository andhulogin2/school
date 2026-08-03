<?php include_once APPPATH . 'views/student_head.php';?>

	
	
		
		<?php //include_once APPPATH . 'views/top_bar.php';?>
        
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
								<a href="#">Student</a>
							</li>
							<li class="active">News</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									News
								
							</h1>
						</div


><div class="main_data">
	<div class="row">
	<div class="col-md-12">
	<div class="white-box">
			<div class="tab-content">
				<div class="tab-pane active" id="running">
		<table class="table table-bordered datatable">
			<thead>
		<tr>
			<th style="text-align: center;" class="table-header">No.</th>
			<th style="text-align: center;" class="table-header"><div><b><?php echo get_phrase('Title'); ?></b></div></th>
   			<th style="text-align: center;" class="table-header"><div><b><?php echo get_phrase('Date'); ?></b></div></th>

			<th style="text-align: center;" class="table-header"><div><b><?php echo get_phrase('View'); ?></b></div></th>
		</tr>
		</thead>
	<tbody>
		<?php 
		$counter = 1; 
        //$this->db->where('news_status' , 1);
		$this->db->order_by('news_id' , 'desc'); 
        $projects	=	$this->db->get('news')->result_array(); 
        foreach($projects as $row): ?>
		<tr>
		<td style="text-align: center;"><?php echo $counter++;?></td>
        <td style="text-align: center;">
		    <a href="<?php echo base_url();?>index.php/student/newsroom/<?php echo $row['news_code'];?>">
			<?php echo $row['title'];?>         
            </a>
        </td>
        		<td style="text-align: center;"> <?php echo $row['news_status']; ?></td>

               
                
		
		<td style="text-align: center;">
          <a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	  href="<?php echo base_url();?>index.php/student/newsroom/<?php echo $row['news_code'];?>">
                <?php echo get_phrase('View'); ?>
                </a>
		</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table></div></div></div></div></div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

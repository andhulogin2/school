<?php include_once APPPATH . 'views/student_head.php';?>
<?php $running_year = get_running_year(); ?>


	
	<body class="no-skin">
		
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
							<li class="active">Study Material</li>
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
									Study Material
								
							</h1>
						</div>


<div class="white-box">
<table class="table table-bordered table-striped datatable">
    <thead>
        <tr>
            <th class="table-header">No.</th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Date'); ?></th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Title'); ?></th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Description'); ?></th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Class'); ?></th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Subject'); ?></th>
            <th style="text-align: center;" class="table-header"><?php echo get_phrase('Download'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $count = 1;
        foreach ($study_material_info as $row) { ?>   
            <tr>
                <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td style="text-align: center;"><?php echo $row['title']?></td>
                <td style="text-align: center;"><?php echo $row['description']?></td>
                <td style="text-align: center;">
                <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name; echo $name;?>
                </td>
                <td style="text-align: center;">
                <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name; echo $name;?>
                </td>
                 <td style="text-align: center;">
               <?php if($row['file_name']==''){
			   echo "No file selected"; }
			   else {?>
                    <a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>">
                        <i class="fa fa-download"></i>
                        
                    </a>
                    <?php }?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
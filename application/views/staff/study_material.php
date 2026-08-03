<?php include_once APPPATH . 'views/staff_head.php';?>
<?php $running_year = get_running_year(); ?>

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
							<h1>
								News
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								</small>
							</h1>
						</div>


<div style="clear:both;"></div>
<br>
 <div class="white-box">
<div class="table-responsive">	
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th style="text-align: center;">Sl.No</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Title</th>
            <th style="text-align: center;">Description</th>
            <th style="text-align: center;">Class</th>
            <th style="text-align: center;">Teacher</th>
            <th style="text-align: center;">Subject</th>
            <th style="text-align: center;">Download</th>
             <th style="text-align: center;">Options</th>
          
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
                    <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td style="text-align: center;">
                    <?php $name = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td style="text-align: center;">
                    <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td style="text-align: center;">
               <?php if($row['file_name']==''){
			   echo "No file selected"; }
			   else {?>
                    <a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>" class="btn btn-info btn-icon icon-left">
                        <i class="fa fa-download"></i>
                        Download
                    </a>
                    <?php }?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo base_url();?>index.php/staff/study_material_edit/<?php echo $row['document_id']?>" class="btn btn-info btn-sm btn-icon icon-left">
                            <i class="fa fa-trash"></i>Edit
                    </a>
                    
                </td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<?php include_once APPPATH . 'views/footer.php'; ?>

<?php include_once APPPATH . 'views/head.php';?>
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
							<li class="active">Study Material</li>
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
								Admin
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Study Material
								
							</h1>
						</div>
<a  href="<?php echo base_url();?>index.php/admin/study_material_add/" 
                        class="btn btn-info pull-right">
                            <i class="fa fa-edit"></i><?php echo get_phrase('Upload'); ?>
                    </a>


<div style="clear:both;"></div>
<br>
 <div class="white-box">
<div class="table-responsive">	
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th style="text-align: center;" class="table-header">Sl.No</th>
            <th style="text-align: center;" class="table-header">Date</th>
            <th style="text-align: center;" class="table-header">Title</th>
            <th style="text-align: center;" class="table-header">Description</th>
            <th style="text-align: center;" class="table-header">Class</th>
            <th style="text-align: center;" class="table-header">Teacher</th>
            <th style="text-align: center;" class="table-header">Subject</th>
            <th style="text-align: center;" class="table-header">Download</th>
             <th style="text-align: center;" class="table-header" colspan="2">Options</th>
          
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
                     <?php 
					if($row['teacher_id']==1)
					{
					$name1 = $this->db->get_where('admin' , array('admin_id' => $row['teacher_id'] ))->row()->name;
					echo $name1;
					}
					else{
					
					$name = $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id'] ))->row()->name;
					echo $name;
					}
                        ?>
                </td>
                <td style="text-align: center;">
                    <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ));
					if($name->num_rows() >0)
                        echo $name->row()->name;
						else echo "----";?>
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
                <td style="text-align: center;">
                    <a href="<?php echo base_url();?>index.php/admin/study_material_edit/<?php echo $row['document_id']?>" class=" btn-sm btn-icon icon-left">
                            <i class="fa fa-edit text-info"></i>
                    </a></td><td style="text-align: center;">
                    <a href="<?php echo base_url();?>index.php/admin/study_material/delete/<?php echo $row['document_id']?>" class="btn-sm btn-icon icon-left" onclick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
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

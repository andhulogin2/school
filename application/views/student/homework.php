<?php include_once APPPATH . 'views/student_head.php';?>

	
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
							<li class="active">Homework</li>
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
									Homework
								
							</h1>
						</div>


<div class="main_data">
	<div class="row" style="padding-left:20px; padding-right:20px">
	<div class="col-md-12">
    
		
		<div class="tab-pane active" id="running">
<table class="table table-bordered datatable">
    <thead>
    <tr>
        <th style="text-align: center;" class="table-header">No.</th>
        <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Title'); ?></div></th>
        <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Class'); ?></div></th>
        <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Section'); ?></div></th>
        <th style="text-align: center;" class="table-header"><div>Added By</div></th>
        <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Subject'); ?></div></th>
        <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Options'); ?></div></th>
    </tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->where('homework_status', 1);
	 $this->db->where('class_id', $class_id);
    $this->db->order_by('homework_id', 'desc');
    $homeworks = $this->db->get('homework')->result_array();
    foreach ($homeworks as $row):
        ?>
  
        <tr>
       
            <td style="text-align: center;"><?php echo $counter++; ?></td>
            <td style="text-align: center;"><a href="<?php echo base_url(); ?>index.php/student/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><span class="badge badge-info badge-roundless"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></span></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
          <td style="text-align: center;"><?php echo $this->db->get_where('staff',array('user_id'=>$row['uploader_id']))->row()->name;?>
            </td>
            <td style="text-align: center;"><?php if($row['subject_id']==0){
			echo "--";}else{
			echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);}?></td>
            <td style="text-align: center;">
                <a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('View'); ?>" 
                   href="<?php echo base_url(); ?>index.php/student/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                    <i class="fa fa-file-text"></i>
                </a>

            </td>
        </tr>
      
<?php endforeach; ?>
</tbody>
</table>
			   
		      
	       </div>
        </div>
    </div>
</div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="assets/js/neon-custom-ajax.js"></script>
<script type="text/javascript">
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('.main_data').html(response);
        }
    });
}
</script>

<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        var datatable = $(".datatable").dataTable({
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"bSortable": false},
                null,
                null,
                null,
                null,
                null,
                null
            ],
            aLengthMenu: [
            [-1 , 25 , 50 , 100 , 200],
            ["All" , 25 , 50 , 100 , 200]
            ],
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>
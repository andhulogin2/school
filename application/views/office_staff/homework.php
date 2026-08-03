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
							<li class="active">Homework</li>
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
									 Homework
								
							</h1>
						</div>



<div class="main_data">
	<div class="row">
	<div class="col-md-12">

		
<table class="table table-bordered datatable">
    <thead>
    <tr>
        <th style="text-align: center;" class="table-header">No.</th>
        <th style="text-align: center;" class="table-header"><div>Title</div></th>
        <th style="text-align: center;" class="table-header"><div>Class</div></th>
        <th style="text-align: center;" class="table-header"><div>Section</div></th>
        <th style="text-align: center;" class="table-header"><div>Added by</div></th>
        <th style="text-align: center;" class="table-header"><div>Subject</div></th>
        <th style="text-align: center;" colspan="3" class="table-header"><div>Options</div></th>
    </tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->where('homework_status', 1);
    $this->db->order_by('homework_id', 'desc');
    $homeworks = $this->db->get('homework')->result_array();
    foreach ($homeworks as $row):
        ?>
    
        <tr>
            <td style="text-align: center;"><?php echo $counter++; ?></td>
            <td style="text-align: center;"><a href="<?php echo base_url(); ?>index.php/admin/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
            <td style="text-align: center;"><?php echo $this->db->get_where($row['uploader_type'] , array(
              $row['uploader_type'].'_id' => $row['uploader_id']))->row()->name;?>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;" class="text-nowrap">
                <a  href="<?php echo base_url(); ?>index.php/admin/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                   <i class="fa fa-edit text-info"></i>
                </a></td>

					<td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php/admin/homework/delete/<?php echo $row['homework_code'];?>" onclick="return confirm('Are-you-sure');">
              			
                  	

                
                    <i class="fa fa-close text-danger"></i>
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
    </div>
</div>
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
<?php include_once APPPATH . 'views/head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<div class="main-content col-md-10">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
							<script type="text/javascript">
                                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                            </script>

                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="ace-icon fa fa-home home-icon"></i>
                                            <a href="#">Homework</a>
                                        </li>
                                        <li class="active">Edit</li>
                                    </ul><!-- /.breadcrumb -->

									<!-- #section:basics/content.searchbox -->
                                    <div class="nav-search" id="nav-search">
                                        <form class="form-search">
                                            <span class="input-icon">
                                                
                                            </span>
                                        </form>
                                    </div><!-- /.nav-search -->
					</div>
						<!-- /section:basics/content.searchbox -->
					
					<!-- /section:basics/content.breadcrumbs -->
                                <div class="page-content">
                                    
                                     <div class="page-header">
                                        <h1>
                                            Homework
                                        
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                Edit
                                            
                                        </h1>
                                    </div>
                                 </div><?php
$current_homework = $this->db->get_where('homework', array(
            'homework_code' => $homework_code
        ))->result_array();
foreach ($current_homework as $row):
    ?>
    <div class="col-md-10" style="padding-left:50px;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <font color="white">Edit</font>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/homework/edit/' . $row['homework_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" required value="<?php echo $row['title']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Last-day-delivery</label>

                    <div class="col-sm-5">
                            <input type="text" class="form-control mydatepicker" name="time_end"  value="<?php echo $row['time_end']; ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">Update</button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  
    
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
	</script>  
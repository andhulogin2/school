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
							<li class="active">Enquiry</li>
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
									Enquiry
								
							</h1>
						</div>


<div class="row" style="padding-left:50px; padding-right:50px">
    <div class="col-md-12">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <font color="white"><?php echo get_phrase('Add'); ?> <?php echo get_phrase('Enquiry');?></font>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php/student/add_enquiry/create/', array('class' => 'form-horizontal form-groups-bordered validate ticket-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label">Tittle</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('Required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                 <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('description'); ?></label>
                <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="5" name="description" id="post_content" style="width:420px "></textarea>
                    </div>
                </div>

               

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                           <?php echo get_phrase('Send'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script>
    $(document).ready(function () {

        var options = {
            beforeSubmit: validate_ticket_add,
            success: show_response_ticket_add,
            resetForm: true
        };
        $('.ticket-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_ticket_add(formData, jqForm, options) {

        if (!jqForm[0].title.value)
        {
            return false;
        }
        $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
        document.getElementById("submit-button").disabled = true;
    }

    function show_response_ticket_add(responseText, statusText, xhr, $form) {
        $('#preloader-form').html('');
        toastr.success("Report submitted successfully", "Success");
        document.getElementById("submit-button").disabled = false;
    }

</script>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>
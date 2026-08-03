<?php include_once APPPATH . 'views/head.php';?>
 

<body>
        
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
							<li class="active">Search</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
					<div class="nav-search" id="nav-search">
				
								<span class="input-icon">
									
								</span>
							</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Search
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Students
								</small>
							</h1>
						</div><!-- /.page-header -->
                        </div>
<br><br>
<div style="padding-left:50px;padding-right:50px;">
	<?php include 'search_result.php'; ?>
</div>
                                    

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
	function submit_search_form(){
		var search_char = $('#search_input1').val();
        var search_char_length = search_char.length;
        if (search_char_length > 2) {
          $('.search-form').submit();
        }
	}
    $(document).ready(function () {
        var options = {
        	beforeSubmit: validate_search,
            success: show_response_for_search
        };
        $('.search-form').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_search(formData, jqForm, options) {
        var search_char = $('#search_input1').val();
        var search_char_length = search_char.length;
        if (search_char_length < 2) {
        	toastr.error("Failed", "Error");
            return false;
        }
    }
    function show_response_for_search(responseText, statusText, xhr, $form) {
    	jQuery('.main_data').html(responseText);
	}
</script>


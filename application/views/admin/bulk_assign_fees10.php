<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">Bulk Assign Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Assign Fees 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									All Students
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                                       
                <?php echo form_open(base_url() . 'index.php/feeManagement/bulk_assign_fees1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
        <select name="class_id" id ="class_id" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)">
            <option value=""><?php echo 'Select'; ?></option>
            <?php foreach($classes as $row): ?>
            <option value="<?php echo $row['class_id'];?>">	<?php echo $row['name'];?> </option>
            <?php endforeach; ?>
        </select>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section </label>
    <div class="col-sm-9">
        <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
        <option value="">Select</option>
        </select>
    </div>
</div>
    
    
    <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class="btn btn-info" name="btnSearch">Assign Fees</button>
    </div>
     <?php echo form_close();?>
                                    

												
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

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section1/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
			}
        });
		setText();
    }
	
	function setText()
	{
	var elt = document.getElementById('class_id');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtcourse').value=selectedText;
	}
	
	

    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
		})
		</script>
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


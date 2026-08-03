<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">Students List</li>
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
								Print
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Students List
								
							</h1>
						</div><!-- /.page-header -->
                     
                                       
                <?php echo form_open(base_url() . 'index.php/feeManagement/print_students_list1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class_id" id ="class_id" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)">
            <option value="ALL"><?php echo 'ALL'; ?></option>
            <?php $classes = $this->db->get('class')->result_array();
            foreach($classes as $row): ?>
            <option value="<?php echo $row['class_id'];?>">	<?php echo $row['name'];?> </option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" id="txtcourse" name="txtcourse" />
    </div> 
</div>


<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
         <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
         <option value="ALL"><?php echo 'ALL'; ?></option>
         </select>
          <input type="hidden" id="txtsection" name="txtsection" />
	</div>
</div>
                    
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-info"><?php echo 'Show'; ?></button>
    </div>
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
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section/' + class_id ,
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

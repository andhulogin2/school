<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase($page_title); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase($page_name); ?></a></li>
            <li class="active"><?php echo get_phrase($page_name); ?></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white"><?php echo get_phrase($page_name); ?></font>
            	</div>
            </div>

			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?feeManagement/fee_collection_abstract_report1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date From"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control date-picker"  />		
                         </div> 
					</div>              
     
  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date To"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
						<input type="text" name="date_to" id="date_to" value="<?php echo date('d-m-Y'); ?>" class="form-control date-picker"  />
						</div> 
					</div>              
                
				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Class '); ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<select name="class_id" id ="class_id" class="form-control" required="" onchange="return get_class_sections(this.value)">
                           
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
					<label for="field-2" class="col-sm-3 control-label"><?php echo 'Section'; ?>
                    <font color="#FF0000">*</font></label>
		            <div class="col-sm-5">
		             <select name="section_id" class="form-control" required="" id="section_selector_holder" onchange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
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
					</div>               <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php?feeManagement/get_class_section/' + class_id ,
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

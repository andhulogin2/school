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
							<li class="active">Fee Collection Report</li>
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
								Report 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Fee Collection Report
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

                <?php echo form_open(base_url() . 'index.php/feeManagement/fee_collection_detailed_report1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date From"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />		
                         </div> 
					</div>              
     
  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date To"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
						<input type="text" name="date_to" id="mydatepicker" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />
						</div> 
					</div>   
                    
                     	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Report Type<font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<select name="report_type" id ="report_type" class="form-control" onChange="check_fee_head()">
                               <option value="detailed">Detailed Report</option>
                               <option value="abstract">Abstratct Report</option>
                          </select>
						</div> 
					</div>          
                    
                 	<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Fee Item <font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<select name="fee_head_id" id ="fee_head_id" class="form-control">
                           
                              <option value="ALL"><?php echo 'ALL'; ?></option>
                              <?php $items = $this->db->get('tbl_fee_heads')->result_array();
								foreach($items as $row): ?>
                            		<option value="<?php echo $row['fee_head_id'];?>">	<?php echo $row['fee_head'];?> </option>
                                <?php endforeach; ?>
                          </select>
						</div> 
					</div>           
                
				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Class '); ?><font color="#FF0000">*</font></label>
						<div class="col-sm-5">
							<select name="class_id" id ="class_id" class="form-control" required="" onChange="return get_class_sections(this.value)" >
                           
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
		             <select name="section_id" class="form-control" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
		             <option value="ALL"><?php echo 'ALL'; ?></option>
			         </select>
                      <input type="hidden" id="txtsection" name="txtsection" />
			        </div>
					</div>
                    
   <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
                           <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
							<button type="submit" class="btn btn-info"><?php echo 'Show Report'; ?></button>
						</div>
					</div>               <?php echo form_close();?>
                                   </div></div></div></body>

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
	
	function check_fee_head()
	{
	var elt = document.getElementById('report_type');
	var selectedText = elt.options[elt.selectedIndex].value;  
		if (selectedText=="detailed")
			document.getElementById('fee_head_id').disabled=false;
		else
			document.getElementById('fee_head_id').disabled=true;
	
	}
	
		</script>  

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
	</script>  
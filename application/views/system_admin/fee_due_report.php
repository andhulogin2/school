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
							<li class="active">Fee Due</li>
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
									Fee Due Report
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<?php echo form_open(base_url() . 'index.php/feeManagement/fee_due_report1',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					

<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Class<font color="#FF0000">*</font></label>
    <div class="col-sm-5">
        <select name="class_id" id ="class_id" class="col-xs-10 col-sm-10" required="" onChange="return get_class_sections(this.value)">
          <option value="">Select</option>
          <?php $classes = $this->db->get('class')->result_array();
            foreach($classes as $row): ?>
                <option value="<?php echo $row['class_id'];?>">
                <?php echo $row['name'];?>
                </option>
            <?php  endforeach;          ?>
      </select>
       <input type="hidden" id="txtcourse" name="txtcourse" />
    </div> 
</div>

<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Section
    <font color="#FF0000">*</font></label>
        <div class="col-sm-5">
            <select name="section_id" class="col-xs-10 col-sm-10"  required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
                 <option value="">Select-Class</option>
            </select>
        <input type="hidden" id="txtsection" name="txtsection" />
        </div>
</div>

<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Due On 
    <font color="#FF0000">*</font></label>
        <div class="col-sm-5">
             <input type="text" id="due_date" name="due_date" class="col-xs-10 col-sm-10 mydatepicker" required="" value="<?php echo date('d-m-Y'); ?>"/>
        </div>
</div>
                    
<div class="form-group">

    <div class="col-sm-offset-3 col-sm-5">
        <input type="checkbox" id="chk_excel" name="chk_excel" />  Save As Excel
        <button type="submit" class="btn btn-info">Show Due Report</button>
    </div>
</div> 
<?php echo form_close();?>
                        </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
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
	
	
	
	function  get_payment_options(payment_option_id,class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_payment_options/' + payment_option_id ,
            success: function(response)
            {
                jQuery('#installment_selector_holder').html(response);
				
			}
			
        });
		setText1();
    }
	
	function setText1()
	{
	var elt = document.getElementById('payment_option_id');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtpayment_option').value=selectedText;
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

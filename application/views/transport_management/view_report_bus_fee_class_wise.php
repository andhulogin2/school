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
							<li class="active">Bus Fee Reports</li>
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
									Class Wise Report
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<?php echo form_open(base_url() . 'index.php/Transport_management/get_bus_fee_class_wise',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					

 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                       <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php 
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    
                                   
                                    
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    <?php }} ?>
                                    
                                    
                                   <?php  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                              <?php 
							  
							  foreach ($department as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    <?php } ?>
                                    
                                    





<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label no-padding-right">Class<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
        <select name="class_id" id ="class_id" class="select2" required="" onChange="return get_class_sections(this.value)">
          <option value="">Select</option>
          <?php 
		 
            foreach($class as $row): ?>
                <option value="<?php echo $row['class_id'];?>">
                <?php echo $row['name'];?>
                </option>
            <?php  endforeach;        ?>
      </select>
       <input type="hidden" id="txtcourse" name="txtcourse" />
    </div> 
</div>

<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Section
    <font color="#FF0000">*</font></label>
        <div class="col-sm-9">
            <select name="section_id" class="select2"  required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
                 <option value="">Select-Class</option>
            </select>
        <input type="hidden" id="txtsection" name="txtsection" />
        </div>
</div>

                    
<div class="form-group">

    <div class="col-sm-offset-3 col-sm-5">
        
        <button type="submit" class="btn btn-info">Show</button>
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
<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_class(department) 
	{
	//alert(department);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_cls/' + department ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
    }
	

	
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              

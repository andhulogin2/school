<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?><body>
        
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
					

<?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				
                 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
		     		
                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
											 <input type="hidden" id="txtcourse" name="txtcourse" />    
										</div>
									</div>
                                    <?php }?>
                                    
                                    <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value)">
            <option value="">Select</option>
            <option value="all">All</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
	</div>
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
			<select name="class_id" onChange="get_class_sections1(this.value)" id="class1" class="select2">
				<option value="">Select</option>
				
			</select>
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>

<?php }?>
<?php if($this->session->userdata('role')>=4)
{?>

		<div class="form-group">
		<label class="col-sm-3 control-label" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>
        <div class="col-sm-9">
			<select  name="class_id"  onchange="get_class_sections(this.value)" id="class" class="select2">
				<option value="">Select</option>
				<option value="all">All</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $this->db->where('academic_year ',$running_year);
									 
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>
    <?php }?>

<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Section:
    <font color="#FF0000">*</font></label>
        <div class="col-sm-5">
            <select name="section_id" class="select2"  required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;">
                 <option value="">Select-Section</option>
            </select>
        <input type="hidden" id="txtsection" name="txtsection" />
        </div>
</div>

 <?php
 if($this->db->get_where('settings' , array('type' =>'reset_due_idle'))->row()->description == 'yes')
 {
 ?>
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Report Type:
    <font color="#FF0000">*</font></label>
        <div class="col-sm-5">
            <select name="report_type" class="select2"  required="" id="report_type" onChange="get_report_by_type(this.value)">
                 <option value="1">Actual Report</option>
                 <option value="2">Idle Report</option>
            </select>
        </div>
</div>
<?php } 
 if($this->db->get_where('settings' , array('type' =>'installment_wise_due_report'))->row()->description == 'yes')
 {
 ?>
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Installment:</label>
        <div class="col-sm-5">
            <select name="installment" class="select2"   id="installment" onChange="disable_date(this.value)">
                 <option value="">Select Installment</option>
                 <?php 
				 $installments	=	$this->db->get_where('tbl_fee_payment_options_details',array('fee_payment_options_details_id!='=>'1'))->result_array();
				 foreach($installments as $row):
				 	?>
                    <option value="<?php echo $row['fee_payment_options_details_id']; ?>"><?php echo $row['fee_payment_options_details']; ?></option>
                    <?php
				 endforeach;
				 ?>
            </select>
        </div>
</div>
<?php 
} 
?>

<div id="for_actual_report">
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Due From:</label>
        <div class="col-sm-4">
             <input type="text" id="due_date_from" name="due_date_from" class="col-xs-10 col-sm-10 mydatepicker" value=""/>
        </div>
</div>
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Due To:
    <font color="#FF0000">*</font></label>
        <div class="col-sm-4">
             <input type="text" id="due_date" name="due_date" class="col-xs-10 col-sm-10 mydatepicker" value="<?php echo date('d-m-Y'); ?>"/>
        </div>
</div>
             <input type="hidden" id="today" value="<?php echo date('d-m-Y'); ?>"/>
    <div class="form-group">
	<label for="field-2" class="col-sm-3 control-label">Amount:</label>
	<div class="col-sm-4">
		 <input type="text" id="amount" name="amount" class="col-xs-10 col-sm-10" />
		 <a href="#" data-toggle="tooltip" data-placement="bottom" title="If you entered the amount, you will get fee dues greater than the entered amount."><i class="fa fa-question" style="padding:10px 0px 0px 10px;"></i></a>
    </div>
    </div>  
    <?php if($this->db->get_where('settings',array('type'=>'add_last_year_due_with_fee_due'))->row()->description=='yes'){ ?>         
    <div class="form-group">
	<label for="field-2" class="col-sm-3 control-label">Add last year fee due?</label>
	<div class="col-sm-4">
		 <input type="checkbox" id="last_year_due" name="last_year_due" value="1" />
    </div>
    <?php } ?>    
</div>                    
<div class="form-group">

    <div class="col-sm-offset-3 col-sm-5">
        
        <button type="submit" class="btn btn-info">Show</button>
    </div>
</div> 
<?php echo form_close();?>
                        </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
	function disable_date(installment)
	{
		if(installment=='')
		{
			$('#due_date_from').prop('disabled',false);
			$('#due_date').prop('disabled',false);
		}
		else
		{
			$('#due_date_from').prop('disabled',true);		
			$('#due_date').prop('disabled',true);		
		}
	}
	function get_class_sections(class_id) 
	{
		if(class_id=='all')
		{
			$('#section_selector_holder').attr('disabled', 'disabled');
		}
		else
		{
			$('#section_selector_holder').removeAttr('disabled');
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
				success: function(response)
				{
					jQuery('#section_selector_holder').html(response);
					jQuery('#section_selector_holder').append("<option value='all'>All</option>");
				}
				
			});
		}
		setText();
    }
	function get_class_sections1(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
				jQuery('#section_selector_holder').append("<option value='all'>All</option>");
			}
			
        });
		setText_b();
    }
	
	function setText()
	{
	var elt = document.getElementById('class');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtcourse').value=selectedText;
	}
	function setText_b()
	{
	var elt = document.getElementById('class1');
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
	function get_class1(dept_id) 
	{
	//alert(dept_id);
	    if(dept_id!='')
	    {
        	if(dept_id=='all')
        	{
        	    $('#class1').prop('disabled',true);
        	    $('#section_selector_holder').prop('disabled',true);
        	}
        	else
        	{
        	    $('#class1').prop('disabled',false);
        	    $('#section_selector_holder').prop('disabled',false);
            	$.ajax({
                    url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
                    success: function(response)
                    {
                        jQuery('#class1').html(response);
                    }
                });
        	}
	    }    
    }
	

	
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
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
	

	
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>

 

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>        
 
 
 <script>
 function get_report_by_type(type)
 {
 	var today = document.getElementById('today').value
	if(type=='2')
	{
	document.getElementById('due_date').value = '';
	$('#for_actual_report').hide();
	}
	else
	{
	document.getElementById('due_date').value = today;
	$('#for_actual_report').show();
	}
 }
 </script>
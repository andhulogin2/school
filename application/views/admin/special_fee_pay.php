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
							<li class="active">Special Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Special Fee
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Pay Fee
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/FeeManagement/view_special_fee'; ?>"><button class="btn-info">Choose Another</button></a></div>

<?php echo form_open('FeeManagement/special_fee_payment/' , array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
 <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
                     
<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_branch"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Branch <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="branch_id" class="select2" id="branch_id" onChange="get_dept(this.value)">
                              <option value="">Select</option>
                              <?php 
							  foreach ($branch as $branch1):
							
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php 
							  endforeach;
							  ?>
                              
                          </select>
    </div> 
</div>



<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_department"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department_id" class="select2" id="department_id" onChange="get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
    </div> 
</div>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_class"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class_id" id="class_id" class="select2" required="" onChange="get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>

<?php }?>
 <?php if($this->session->userdata('role')==3)
{?>
<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_department"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Department <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="department_id" class="select2" id="department_id" onChange="get_class(this.value)">
            <option value="">Select</option>
            
                              <?php 
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
    </div> 
    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $this->session->userdata('branch_id'); ?>" />
</div>


<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_class"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class_id" id="class_id" class="select2" required="" onChange="get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>
<?php }?>

 <?php if($this->session->userdata('role')>=4)
{?>
<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_class"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select  name="class_id"  onchange="get_class_sections(this.value)" id="class_id" class="select2">
				<option value="">Select</option>
                <?php 
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
    </div> 
        <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $this->session->userdata('branch_id'); ?>" />
</div>
<?php } ?>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_section"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section_id" onChange="get_details()"  class="select2" id="section_id" required>
            <option value="">Select</option>
        </select>
    </div>
</div>
<div  class="form-group" id="special_fee_students"> </div>
                                    </div></div></div></body>

			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="transaction_success")
{
echo "<script>toastr.success('". "Fee details updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="transaction_failed")
{
echo "<script>toastr.error('". "Fee details not updated...', 'Failed', {timeOut: 5000})</script>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

   

});
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
		if(class_id=="")
		{
			jQuery('#special_fee_students').html("");
		}
		$.ajax({
			url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
			success: function(response)
			{
				jQuery('#section_id').html(response);
			}
		});
    }
</script>

<script type="text/javascript">	
 function get_details(){
	// jQuery('#special_fee_students').html("");
        var branch_id 	= $('#branch_id').val();		//This branch_id is needed in student_payment_details_print page.This branch_id should be passed to get receipt number.
        var class_id 	= $('#class_id').val();
        var section_id 	= $('#section_id').val();

		if(section_id == ""){
			jQuery('#special_fee_students').html("");
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/special_fee_students/' + class_id + '/' + section_id + '/' + branch_id,
				success: function(response)
				{
					console.log(response);
					jQuery('#special_fee_students').html(response);
				}
			});
		}
}
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
 <script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department_id').html(response);
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="Inserted")
{
echo "<script>toastr.success('". "Payment successful...', 'Success', {timeOut: 5000})</script>";
}
else if($action=="Not_Inserted")
{
echo "<script>toastr.error('". "Payment failed...', 'Failed', {timeOut: 5000})</script>";
}
?> 
 
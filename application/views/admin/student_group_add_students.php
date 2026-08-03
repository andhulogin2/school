<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
        
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
							<li class="active">Groups</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Groups
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Students
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/view_student_group'; ?>"><button class="btn-info">Back</button></a></div>

<?php echo form_open('Admin/add_remove_students_to_group/' , array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
<input type="hidden" name="students_group_master_id" id="students_group_master_id" value="<?php echo $students_group_master_id; ?>" />
<input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>" />
<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>" />
<input type="hidden" name="group_for" id="group_for" value="<?php echo $group_for; ?>" />
<?php
if($group_for=='students')
{
?>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Add/Remove <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="add_remove" class="select2" id="add_remove" onchange="remove_all(this.value);" required>
            <option value="">Select</option>
            <option value="add">Add</option>
            <option value="remove">Remove</option>
            <option value="remove_all">Remove All</option>
        </select>
    </div>
</div>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_class"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select  name="class_id"  onchange="get_class_sections(this.value)" id="class_id" class="select2">
				<option value="">Select</option>
                <?php 
									 foreach($classes as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
    </div> 
        <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $this->session->userdata('branch_id'); ?>" />
</div>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_section"></label>
<div class="form-group">
<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section_id" class="select2" id="section_id" onChange="get_details()" required>
            <option value="">Select</option>
        </select>
    </div>
</div>


<div  class="form-group" id="view_students"> </div>

<?php
}
else
{
?>
    <div class="form-group">
        <label class="col-sm-1"></label>
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="text-align:left"> Add/Remove <font color="#FF0000">* </font></label>
            <div class="col-sm-9">
                <select name="add_remove" class="select2" id="add_remove" onchange="get_staff(this.value);" required>
                    <option value="">Select</option>
                    <option value="add">Add</option>
                    <option value="remove">Remove</option>
                </select>
            </div>
    </div>
    
    <div  class="form-group" id="view_staffs"> </div>
<?php
}
?>

                                    </div></div></div>

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
	function get_staff(val)
	{
        var branch_id 					= 	$('#branch_id').val();		
        var department_id 				= 	$('#department_id').val();
		var add_remove					= 	$('#add_remove').val();		
		var students_group_master_id	= 	$('#students_group_master_id').val();		
		$.ajax({
			url: '<?php echo base_url();?>index.php/Admin/get_staffs/' + branch_id + '/' + department_id + '/' + add_remove + '/' + students_group_master_id ,
			success: function(response)
			{
				console.log(response);
				jQuery('#view_staffs').html(response);
			}
		});
	}
	function get_class_sections(class_id) 
	{
		if(class_id=="")
		{
			jQuery('#view_students').html("");
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
        var branch_id 					= $('#branch_id').val();		
        var class_id 					= $('#class_id').val();
        var section_id 					= $('#section_id').val();
		var add_remove					= $('#add_remove').val();		
		var students_group_master_id	= $('#students_group_master_id').val();		
		if(section_id == ""){
			jQuery('#view_students').html("");
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Admin/student_group_students/' + class_id + '/' + section_id + '/' + branch_id + '/' + add_remove + '/' + students_group_master_id,
				success: function(response)
				{
					console.log(response);
					jQuery('#view_students').html(response);
				}
			});
		}
}
function remove_all(value)
{ 
	jQuery('#view_students').html("");
	if(value=='remove_all')
	{ 
		document.getElementById('class_id').disabled	=	true;
		document.getElementById('section_id').disabled	=	true;
		
		var students_group_master_id	=	$('#students_group_master_id').val();
		var department_id				=	$('#department_id').val();
		var branch_id					=	$('#branch_id').val();
		var add_remove					= 	$('#add_remove').val();

		$.ajax({
			url: '<?php echo base_url();?>index.php/Admin/view_student_group_members1/' + students_group_master_id + '/' + department_id + '/' + branch_id + '/' + add_remove,
			success: function(response)
			{
				jQuery('#view_students').html(response);
			}
		});
	}
	else
	{
		document.getElementById('class_id').disabled	=	false;
		document.getElementById('section_id').disabled	=	false;
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
if ($action=="added")
{
echo "<script>toastr.success('". "Added successfully...', 'Success', {timeOut: 5000})</script>";
}
else if($action=="not_added")
{
echo "<script>toastr.error('". "Not added...', 'Failed', {timeOut: 5000})</script>";
}
if ($action=="removed")
{
echo "<script>toastr.success('". "Removed successfully...', 'Success', {timeOut: 5000})</script>";
}
else if($action=="not_removed")
{
echo "<script>toastr.error('". "Not removed...', 'Failed', {timeOut: 5000})</script>";
}
?> 
 
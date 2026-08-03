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
									Report
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px;padding-bottom:30px"><a href="<?php echo base_url() . 'index.php/FeeManagement/special_fee_report'; ?>"><button class="btn-info">Choose Another</button></a></div>

<?php echo form_open('FeeManagement/special_fee_payment/' , array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
<table class="table table-bordered table-hover">
		 <?php $role=$this->session->userdata('role');
			 if($role==1 || $role==2)
			 {?>
    <tr>
    	<th>Branch</th>
    	<th>Department</th>
    	<th>Class</th>
    	<?php
		}
		if($role==3)
		{
		?>
    	<th>Department</th>
    	<th>Class</th>
    	<?php
		}
		if($role>=4)
		{
		?>
    	<th>Class</th>
        <?php
		} ?>
    	<th>Section</th>
    	<th>Fee Item</th>
    </tr>
    
	<tr>
		 <?php
			 if($role==1 || $role==2)
			 {
			 ?>
    	<td>
                <select name="branch_id" class="select2" id="branch_id" onChange="get_dept(this.value)">
                    <option value="">Select</option>
                    <?php 
                    foreach ($branches as $branch1):
                    ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                    <?php 
                    endforeach;
                    ?>
                </select>
        </td>
        <td>
                <select name="department_id" class="select2" id="department_id" onChange="get_class(this.value)">
                    <option value="">Select</option>
                </select>
        </td>
        <td>
                <select name="class_id" id="class_id" class="select2" onChange="get_class_sections(this.value)">
                    <option value="">Select</option>
                </select>
        </td>
		<?php }?>
        <?php if($this->session->userdata('role')==3)
        {?>
        <td>
                <select name="department_id" class="select2" id="department_id" onChange="get_class(this.value)">
                    <option value="">Select</option>
                    <?php 
                    foreach ($dept as $dept1)
                    {
                    ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                    <?php }?>
                </select>
        </td>
        <td>
                <select name="class_id" id="class_id" class="select2" onChange="get_class_sections(this.value)">
                    <option value="">Select</option>
                </select>
                <input type="hidden" value="<?php echo $this->session->userdata('branch_id');?>" name="branch_id" id="branch_id">
        </td>
		<?php }?>
        
        <?php if($this->session->userdata('role')>=4)
        {?>
        <td>
                <select  name="class_id"  onchange="get_class_sections(this.value)" id="class_id" class="select2">
                    <option value="">Select</option>
                    <?php 
                    foreach($class as $data){?>
                    <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                    <?php } ?>
                </select>
                <input type="hidden" value="<?php echo $this->session->userdata('branch_id');?>" name="branch_id" id="branch_id">
                <input type="hidden" value="<?php echo $this->session->userdata('dept_id');?>" name="department_id" id="department_id">
        </td>
		<?php } ?>
        <td>
                    <select name="section_id" onChange="get_details()"  class="select2" id="section_id" >
                        <option value="">Select</option>
                    </select>
        </td>
        <td>
                    <select name="fee_head_id" class="select2" id="fee_head_id" onChange="check_paid()" >
                        <option value="">Select</option>
                        <?php
                        foreach($special_fee_heads as $fee_heads):
                        ?>
                        <option value="<?php echo $fee_heads['fee_head_id']; ?>"><?php echo $fee_heads['fee_head']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
        </td>
    </tr>
</table>
<div align="center"><input type="button" class="btn btn-info" value="Show" onClick="show_report()"></div>

<div  class="form-group" id="show_fee_report"> </div>
                                    </div></div></div></body>
<?php echo form_close(); ?>
			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#branch_id').change(function(){
		$('#show_fee_report').html("");
		get_class_by_branch();
		})
	$('#department_id').change(function(){
		$('#section_id').val("");	
	})
   

});
function show_report()
{
	role		=	parseInt(<?php echo $this->session->userdata('role');?>);
	var values	=	{
					role			:	role,
					branch_id		:	$( "#branch_id" ).val(),
					department_id	:	$( "#department_id" ).val(),
					class_id		:	$( "#class_id" ).val(),
					section_id		:	$( "#section_id" ).val(),
					fee_head_id		:	$( "#fee_head_id" ).val(),
					};
	if(role==1 || role==2)
	{
		if($('#branch_id').val()=='')
		{
			alert("Please select branch.");
		}
		else
		{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>index.php/FeeManagement/show_report/' ,
				data: { ids : values },
				success: function(response)
				{
					//alert(response);
					jQuery('#show_fee_report').html(response);
				}
			});
		}
	}
	else if(role==3)
	{
		if($('#department_id').val()=='' && $( "#class_id" ).val()=='' && $( "#section_id" ).val()=='' && $( "#fee_head_id" ).val()=='')
		{
			alert("Please select atleast one.");
		}
		else
		{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>index.php/FeeManagement/show_report/' ,
				data: { ids : values },
				success: function(response)
				{
					//alert(response);
					jQuery('#show_fee_report').html(response);
				}
			});
		}
	}
	else if(role>=4)
	{
		if($( "#class_id" ).val()=='' && $( "#section_id" ).val()=='' && $( "#fee_head_id" ).val()=='')
		{
			alert("Please select atleast one.");
		}
		else
		{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url();?>index.php/FeeManagement/show_report/' ,
				data: { ids : values },
				success: function(response)
				{
					//alert(response);
					jQuery('#show_fee_report').html(response);
				}
			});
		}
	}
}
function get_class_by_branch()
{
	var branch_id	=	$('#branch_id').val();
	if(branch_id=='')
	{
		$('#section_id').val("");		
	}
	$.ajax({
		url: '<?php echo base_url();?>index.php/FeeManagement/get_class_by_branch/' + branch_id ,
		success: function(response)
		{
			//alert(response);
			jQuery('#class_id').html(response);
		}
	});
}
</script>
<script type="text/javascript">
	function get_class_sections(class_id) 
	{
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

			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/special_fee_students/' + class_id + '/' + section_id + '/' + branch_id,
				success: function(response)
				{
					console.log(response);
					jQuery('#special_fee_students').html(response);
				}
			});
		
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

$('.select2').css('width','200px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              

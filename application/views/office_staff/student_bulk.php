<?php include_once APPPATH . 'views/office_staff_head.php';?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<div class="main-content col-md-10">
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
                                        <li class="active">Admission</li>
                                    </ul><!-- /.breadcrumb -->

									<!-- #section:basics/content.searchbox -->
                                    <div class="nav-search" id="nav-search">
                                        <form class="form-search">
                                            <span class="input-icon">
                                                
                                            </span>
                                        </form>
                                    </div><!-- /.nav-search -->
					</div>
						<!-- /section:basics/content.searchbox -->
					
					<!-- /section:basics/content.breadcrumbs -->
                                <div class="page-content">
                                    
                                     <div class="page-header">
                                        <h1>
                                            Student Bulk
                                        
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                 Admission Form
                                            
                                        </h1>
                                    </div>
                                 </div>
                        <?php echo form_open(base_url() . 'index.php/Office_staff/student_bulk1/add_bulk_student' , array('class' => 'form-inline validate'));?>
	<div class="row bg-title">

 
   
    
	<div class="col-md-3">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class');?></label>
			<select name="class_id" id="class_id" class="form-control selectboxit" required="required"
				onchange="get_sections(this.value)"  data-validate="required"  data-message-required="<?php echo get_phrase('Required');?>">
				<option value=""><?php echo get_phrase('Select');?></option>
				<?php
					$this->db->where('branch_id',$this->session->userdata('branch_id'));
					$this->db->where('dept_id',$this->session->userdata('dept_id'));
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
   
     
     
     
   
    
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>
 <div class="col-md-10">
<div id="bulk_add_form">
<div id="student_entry">
	<div class="row" style="margin-bottom:10px;">

		<div class="form-group">
			<input type="text" name="name[]" id="name" class="form-control" style="width: 260px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Name');?>" required>
		</div>

		<div class="form-group">
			<input type="text" name="roll[]" id="roll" class="form-control" style="width: 260px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Roll');?>">
		</div>

		
       
		<div class="form-group">
			<input type="text" name="phone[]" id="phone" class="form-control" required="" style="width: 260px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Phone');?>">
		</div>

		

		<div class="form-group">
			<button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
					onclick="deleteParentElement(this)" style="margin-left: 10px;">
        		<i class="fa fa-trash-o" style="color: #fff;"></i>
        	</button>
		</div>

			
	</div>

</div>


		<div id="student_entry_append"></div>
        <br>
        
        <div class="row">
            <center>
                <button type="button" class="btn btn-info" onclick="append_student_entry()">
                    <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                </button>
            </center>
        </div>

        <br><br>
        <div class="row" align="center">
            <div class="form-group">
                <label class="switch switch-success"><input type="checkbox" checked name="notification" id="notification" value="1"><span></span> <?php echo get_phrase('Send-Notification'); ?> </label> 
            </div>
        </div>
        <div class="row">
            <center>
                <button type="submit" class="btn btn-success" id="submit_button">
                    <i class="entypo-check"></i> <?php echo get_phrase('Save');?>
                </button>
            </center>
        </div>
     
     
<?php echo form_close();?> 
<div class="hr hr32 hr-dotted"></div>
<div></div>
</div> <div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<4;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
	function get_sections(class_id) {
	//alert(class_id);
		$.ajax({
            url: '<?php echo base_url();?>index.php/Office_staff/get_sections/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
                jQuery('#bulk_add_form').show();
            }
        });
	}

	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Office_staff/get_dept/' + branch_id ,
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
                jQuery('#class_id').html(response);
            }
        });
    }
	

	
</script>

<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
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
							<li class="active">Group</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Group
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Members
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/view_student_group'; ?>">Back</a></div>

<input type="hidden" name="students_group_master_id" id="students_group_master_id" value="<?php echo $students_group_master_id; ?>" >
<input type="hidden" value="<?php echo $this->session->userdata('branch_id');?>" name="branch_id" id="branch_id">
<input type="hidden" value="<?php echo $this->session->userdata('dept_id');?>" name="department_id" id="department_id">
<?php
$role	=	$this->session->userdata('role');
?>
<!--
<table class="table table-bordered table-hover">
		
    <tr>
    	<th>Class</th>
    	<th>Section</th>
    </tr>
    
	<tr>
        <td>
                <select name="class_id" id="class_id" class="form-control" onChange="get_class_sections(this.value)">
                    <option value="">Select</option>
                    <?php 
					foreach($class as $data):
					?>
                    <option value="<?php echo $data['class_id']; ?>"><?php echo $data['name']; ?></option>
                    <?php
					endforeach;
					?>
                </select>
        </td>
        <td>
                    <select name="section_id" onChange="get_details()"  class="form-control" id="section_id" >
                        <option value="">Select</option>
                    </select>
        </td>
    </tr>
</table> 
<div align="center" style="padding-bottom:5px;"><input type="button" class="btn btn-info" value="Show" onClick="show_report()"></div> -->

<div class="table-responsive" id="show_group_members" style="margin:10px;"> 
<table class="table sortable simple-table table-bordered table-hover">
    <tr>
        <th class="table-header" colspan="7">
        <?php
			$qry	=	$this->db->get_where('tbl_students_group_master',array('students_group_master_id'=>$students_group_master_id))->row();
            echo $qry->students_group_master_name;
        ?>
        </th>
    </tr>
    <tr>
        <th class="table-header" colspan="7">
        <?php
            echo "Notes : ".$qry->notes;
        ?>
        </th>
    </tr>
	<tr>
    	<th class="table-header">Sl.No</th>
    	<th class="table-header">Name&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Name"></i></th>
      <!--  <?php
		if($role==1 || $role==2 || $role==3)
		{
		?>
    	<th class="table-header">Department&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Department"></i></th>
        <?php
		}
		if($role==1 || $role==2)
		{
		?>
    	<th class="table-header">Branch&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Branch"></i></th>
        <?php
		}
		?>-->
    	<th class="table-header">Notes&nbsp;&nbsp;</th>
    	<th class="table-header">Phone&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Phone"></i></th>
    	<th class="table-header">Added Date&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Date"></i></th>
    </tr>
    <?php
	if(count($members)>0)
	{
	$i=1;
	foreach($members as $data):
	?>
	<tr>
    	<td><?php echo $i++; ?></td>
    	<td><?php echo $data['name']; ?></td>
        <!--<?php
		if($role==1 || $role==2 || $role==3)
		{
		?>
    	<td><?php echo $data['dept_name']; ?></td>
        <?php
		}
		if($role==1 || $role==2)
		{
		?>
        <td><?php echo $data['branch_name']; ?></td>
        <?php
		}
		?>-->
    	<td><?php echo $data['notes']; ?>&nbsp;&nbsp;&nbsp;
        	<a href="#" onClick="editNoteModal('<?php echo $data['students_group_details_id']; ?>','<?php echo trim($data['notes']); ?>','<?php echo $students_group_master_id; ?>','<?php echo $branch_id;?>','<?php echo $department_id;?>')"><i class="fa fa-edit"></i>
			<?php
			if($data['notes']!='')
			{
			?>
				Edit
			<?php
			}
			else
			{
			?>
				Add Note
			<?php	
			}
			?>
            </a>
		</td>	
        <td><?php echo $data['phone']; ?></td>
    	<td><?php echo date('d-m-Y',strtotime($data['entered_date'])); ?></td>
    </tr>
    <?php
	endforeach;
	}
	else
	{
	?>
    <tr>
    	<td colspan="6" style="color:#FF0000;text-align:center"><b>No Records Found.</b></td>
    </tr>
    <?php
	}
	?>
</table>

<div id="myModal" class="modal">

	<!-- Modal content -->
	<div class="modal-content">
		<?php echo form_open('admin/group_note_update/staff'); ?>
			<div class="modal-header">
				<span class="close" onClick="close_modal()" >&times;</span>
				<h4>Edit Note</h4>
			</div>
			<div class="modal-body">
				
					<input type="hidden" name="students_group_details_id" id="students_group_details_id" >
					<input type="hidden" name="students_group_master_id1" id="students_group_master_id1" >
					<input type="hidden" name="branch_id1" id="branch_id1" >
					<input type="hidden" name="dept_id1" id="dept_id1" >
					<textarea id="notes1" placeholder="Notes" name="notes1" style="width:100%"></textarea>
				
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success btn-sm" value="Update">
			</div>
		<?php echo form_close(); ?>     
	</div>

</div>


</div></div></div></div></body>
			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(). 'assets/js/sorttable.js'; ?>"></script>
<script type="text/javascript">

var modal 	= document.getElementById("myModal");

$(document).ready(function(){
	$('#branch_id').change(function(){
		$('#show_group_members').html("");
		get_class_by_branch();
		})
	$('#department_id').change(function(){
		$('#section_id').val("");	
	})
   

});

function close_modal() 
{
	modal.style.display = "none";
}
function editNoteModal(students_group_details_id,note,students_group_master_id,branch_id,dept_id)
{
	$('#students_group_details_id').val(students_group_details_id);
	$('#students_group_master_id1').val(students_group_master_id);
	$('#branch_id1').val(branch_id);
	$('#dept_id1').val(dept_id);
	$('#notes1').val(note);
	modal.style.display = "block";
}
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
					jQuery('#show_group_members').html(response);
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
					jQuery('#show_group_members').html(response);
				}
			});
		}
	}
	else if(role==4 || role==12)
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
					jQuery('#show_group_members').html(response);
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
/*
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});   */                                 
 </script>              
<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 40%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #fff;
  color: white;
} 
</style> 
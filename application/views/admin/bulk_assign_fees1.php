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
							<li class="active">Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Assign Fee
								
							</h1>
						</div>  <!-- /.page-header -->
                                        <div></div>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees/assign'; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<br/>

 <?php echo form_open(base_url() . 'index.php/feeManagement/bulk_assign_fees2' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		<?php  
		//$role_id		=	$this->session->userdata('role');
		//if($role_id==1 || $role_id==2)
		//{
		?>
      <input type="hidden" name="branch_id" id="branch_id" value=<?php echo $branch_id; ?> />
      <input type="hidden" name="department_id" id="department_id" value=<?php echo $department_id; ?> />
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />

     <!--   <?php /*
		//}
		//if($role_id==3)
		//{
		?>
      <input type="hidden" name="department_id" id="department_id" value=<?php echo $department_id; ?> />
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />

        <?php
		//}
		//if($role_id==4)
		//{
		?>
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />
      <?php
	  */	//}
	  ?> -->
      <div class="table-responsive" style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead><tr><th class="table-header">SlNO</th><th class="table-header">Name</th><th class="table-header">Class / Batch</th>
            <th class="table-header">
            	Fee Plan
                <br />
            	<select name="fee_plan_id" id="fee_plan_id"  class="col-sm-8" onchange="change_all_fee_plans(this.value);">
                	<option value='0'>Choose A Plan</option>";
                    <?php
                     foreach($fee_master as $fee)
                     {
					 ?>
                     <option value="<?php echo $fee['fee_master_id'];?>" > <?php echo $fee['fee_master_name'];?></option>
                     <?php
					 }
					 ?>
                </select>
            </th>
            <th class="table-header">
            	Select
                <br />
                <input type="checkbox" name="select_all" id="select_all" onchange="select_all_students();" />
            </th></tr></thead>
            <tbody>
            <?php
				if(count($students)==0)
			echo "<tr><td colspan='6' align='center'><font color='red'><b>No records found</font></b></td></tr>";
			$total=0;
			$i=1;
			$settings	=	$this->db->get_where('settings',array('type'=>'non_migrated_students_list'))->row()->description;
			foreach($students as $row)
			{
			    
			$assigned_fee_id = is_fees_assigned($row['student_id']);
		//echo $this->db->last_query();die();
			$is_fee_paid = is_fee_paid($row['student_id']);
			echo "<tr>";
			//if ($is_fee_paid=='y')
			// echo "<tr>";//echo "<tr bgcolor='red'>" ;
		//else if ($assigned_fee_id>0) 
			 		//	echo "<tr>";//  echo "<tr bgcolor='orange'>" ;
			// else			
			 // echo "<tr bgcolor='lightgreen'>" ;
		    echo "<td>";
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo "$i";
			echo " </td><td>" ;
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo get_student_name($row['student_id']);
				if($settings=='yes')
				{
					if($row['is_migrated']=='Y')
					{
						echo "(Migrated)";
					}
				}
		if($assigned_fee_id==0)
			echo "</font>";
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo  " </td><td>" ;
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo get_class_name( $class_id ) ;
            echo  " / " . get_student_section_name($row['student_id']);
			if($assigned_fee_id==0)
			echo "</font>";
			?>
            <input type="hidden" name="student_id[]" id="student_id[]" value=<?php echo $row['student_id']; ?> />
            <input type="hidden" name="section_id1[]" id="section_id1[]" value=<?php echo get_student_section_id($row['student_id']); ?> />
            <?php
			echo " </td><td>" ;
			?>
             <select name="fee_master_id[]" id="fee_master_id[]"  class="fee_master_id col-sm-8">
             <?php
			 $j=0;
			  echo   "<option value='0'>Choose A Plan</option>";
			 foreach($fee_master as $fee)
			 {
		        echo   "<option value='". $fee['fee_master_id']."' " ;
				if ($assigned_fee_id==$fee['fee_master_id'])
				echo ' selected="selected"';
				
				if($is_fee_paid=='y')
				
				echo " disabled"; 	
				echo  ">".$fee['fee_master_name'] . "</option>";
				$j=$j+1;
			}
			   echo "</select><div name='msg[]' style='color:red'></div>";	
			   	if($is_fee_paid=='y')
				echo "<input type='hidden'  name='fee_master_id[]'  id='fee_master_id[]' value=''";
				
			   echo "</td><td>";
			   ?>
               
                <input type="checkbox" id="chk_students[]" name="chk_students[]" 
                <?php if($is_fee_paid=='y')		 echo " disabled "; 	?>
                onclick="check_clicked();" >
                 <input type="hidden" id="chk_checked[]" name="chk_checked[]" value="0" >
                <?php	
				
				
                echo "</td></tr>";
			   $i=$i+1;
	    }
			?>
            
            </tbody>
            </table>
            </div>
						<div class="col-sm-offset-3 col-sm-5" style="padding-left:250px;">
							<button type="submit" class="btn btn-info" onclick="return check_validation()"><?php echo 'Assign Fee'; ?></button>
					</div>               <?php echo form_close();?>
        
 
                                     

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div></div>
			<?php include_once APPPATH . 'views/footer.php'; ?>
            
            
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>                                                                      
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  
<script type="text/javascript">

	$(document).ready(function () {
	
	//$('[data-toggle="tooltip"]').tooltip(); 
		show_popover();
	
	});  
	
function show_popover()
{

	var student_id 		= 	document.getElementsByName('student_id[]');
	var check_box 		= 	document.getElementsByName('chk_students[]');
	var count_item 		= 	student_id.length;
	for (var i = 0;  i < count_item; i++)
	{
		if(check_box[i].disabled==true)
		{
			document.getElementById('simple-table').getElementsByTagName("tbody")[0].getElementsByTagName("tr")[i].setAttribute("class", "test");
			document.getElementById('simple-table').getElementsByTagName("tbody")[0].getElementsByTagName("tr")[i].setAttribute("data-toggle", "tooltip");
			document.getElementById('simple-table').getElementsByTagName("tbody")[0].getElementsByTagName("tr")[i].setAttribute("data-placement","right");
			document.getElementById('simple-table').getElementsByTagName("tbody")[0].getElementsByTagName("tr")[i].setAttribute("title","Can not modify fee plan because student paid fees");
			$('[data-toggle="tooltip"]').tooltip(); 
		}
	}

}	

function change_all_fee_plans(selected_fee_plan_id)
{
	var selected_fee_plan_id	=	selected_fee_plan_id;
	var fee_plan_id				=	document.getElementById("fee_plan_id");
	var fee_master_id			=	document.getElementsByClassName('fee_master_id');
	var check_box 				= 	document.getElementsByName('chk_students[]');
	for (var i = 0;  i < fee_master_id.length; i++)
	{
		if(check_box[i].disabled==false)
		{
			for(var j=0;j<fee_plan_id.length;j++)
			{
				if(fee_master_id[i][j].value ==  selected_fee_plan_id)
				{
					fee_master_id[i][j].selected	=	true;
				}	
			}
		}
	}
}


function select_all_students()
{
	var select_all	=	document.getElementById("select_all");
	var check_box 	= 	document.getElementsByName('chk_students[]');
	var text_box 	= 	document.getElementsByName('chk_checked[]');
	
	for (var i=0;i<check_box.length;i++)
	{
		if(check_box[i].disabled==false)
		{
			if(select_all.checked==true)
			{
				check_box[i].checked	=	true;
				text_box[i].value		=	1;
			}
			else
			{
				check_box[i].checked	=	false;
				text_box[i].value		=	0;
			}
		}
	}
}


function check_clicked()
{


var check_box = document.getElementsByName('chk_students[]');
var text_box = document.getElementsByName('chk_checked[]');
var count_item = text_box.length;
  for (var i = 0;  i < count_item; i++)
   {
   if(check_box[i].checked)
	   text_box[i].value=1;
	else
	   text_box[i].value=0;
	}
}

function check_validation()
{
	var student_id 		= 	document.getElementsByName('student_id[]');
	var check_box 		= 	document.getElementsByName('chk_students[]');
	var fee_master_id	= 	document.getElementsByClassName('fee_master_id');
	var msg				= 	document.getElementsByName('msg[]');
	var count_item 		= 	student_id.length;
	var checked			=	0;
	for (var i = 0;  i < count_item; i++)
	{
		if(check_box[i].checked)
		{	
			checked++;
			if(fee_master_id[i].value==0)
			{
				msg[i].innerHTML	=	"Please choose a plan.";
				return false;
			}
			else
			{
				msg[i].innerHTML	=	"";
			}
		}
		else
		{
			msg[i].innerHTML	=	"";
		}
	}
	if(checked==0)
	{
		alert("Please select atleast one checkbox.");
		return false;
	}
	else
	{
		return true;
	}
	
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
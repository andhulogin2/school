<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">Attendance</li>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Assign Fee
								
							</h1>
						</div>  <!-- /.page-header -->
                                        <div></div>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees/assign'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div> 
<br/>

 <?php echo form_open(base_url() . 'index.php/feeManagement/bulk_assign_fees2' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />
      <div style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead><tr><th class="table-header">SlNO</th><th class="table-header">Name</th><th class="table-header">Class / Batch</th>
            <th class="table-header">Fee Plan</th><th class="table-header">Select</th></tr></thead>
            <tbody>
            <?php
				if(count($students)==0)
			echo "<tr><td colspan='6' align='center'><font color='red'><b>No records found</font></b></td></tr>";
			$total=0;
			$i=1;
			foreach($students as $row)
			{
			$assigned_fee_id = is_fees_assigned($row['student_id']);
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
		if($assigned_fee_id==0)
			echo "</font>";
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo  " </td><td>" ;
			if($assigned_fee_id==0)
			echo "<font color='red'>";
			echo get_class_name( $class_id ) ;
            echo  " / " . get_section_name($section_id);
			if($assigned_fee_id==0)
			echo "</font>";
			?>
            <input type="hidden" name="student_id[]" id="student_id[]" value=<?php echo $row['student_id']; ?> />
            
            <?php
			echo " </td><td>" ;
			?>
             <select name="fee_master_id[]" required="" id="fee_master_id[]"  class="col-xs-10 col-sm-10" >
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
			   echo "</select>";	
			   	if($is_fee_paid=='y')
				echo "<input type='hidden'  name='fee_master_id[]'  id='fee_master_id[]' value=''";
				
			   echo "</td><td>";
			   ?>
               
                <input type="checkbox" id="chk_students[]" name="chk_students[]"
                <?php if($is_fee_paid=='y')		 echo " disabled "; 	?>
                onclick="check_clicked();" >
                 <input type="hidden" id="chk_checked[]" name="chk_checked[]" value="0">
                <?php	
				
				
                echo "</td></tr>";
			   $i=$i+1;
	    }
			?>
            
            </tbody>
            </table>
            </div>
						<div class="col-sm-offset-3 col-sm-5" style="padding-left:250px;">
							<button type="submit" class="btn btn-info"><?php echo 'Assign Fee'; ?></button>
					</div>               <?php echo form_close();?>
        
 
                                     

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div></div>
			<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
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
</script>
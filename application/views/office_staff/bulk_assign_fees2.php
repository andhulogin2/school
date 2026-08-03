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
							<li class="active">Assign Fees</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Assign Fees
								</small>
							</h1>
						</div><!-- /.page-header -->
                                        <div></div>
                                        
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees/assigned'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div> 
<br/>

      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />
      <div style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead><tr><th class="table-header">SlNO</th><th class="table-header">Name</th><th class="table-header">Class / Batch</th>
            <th class="table-header">Fee Plan</th><th colspan="3" class="table-header">Action</th></tr></thead>
            <tbody>
            <?php
			$total=0;
			$i=1;
			
			if(count($students)==0)
			echo "<tr><td colspan='6' align='center'><font color='red'><b>No Studetns Found In This Class</font></b></td></tr>";
			foreach($students as $row)
			{
			$assigned_fee_id = is_fees_assigned($row['student_id']);
			$is_fee_paid = is_fee_paid($row['student_id']);
			echo "<tr>";
	//if ($is_fee_paid=='y')
//			 echo "<tr>";//echo "<tr bgcolor='red'>" ;
//		else if ($assigned_fee_id>0) 
//			 			echo "<tr>";//  echo "<tr bgcolor='orange'>" ;
//			 else			
//			  echo "<tr bgcolor='lightgreen'>" ;
		    echo "<td>$i";
			echo " </td><td>" . get_student_name($row['student_id']);
			echo  " </td><td>"  . get_class_name( $class_id ) ;
            echo  " / " . get_section_name($section_id);
			?>
            
            <?php
			echo " </td><td>" ;
			?>
            
             <?php
			
			  
			 foreach($fee_master as $fee)
			 {
		      
				if ($assigned_fee_id==$fee['fee_master_id'])
								echo $fee['fee_master_name'] ;
				
			}
			  ?>
			   </td><td>
				 
				<a href="<?php echo base_url() . 'index.php/FeeManagement/view_students_fee_schedule/'. $row['student_id'].'/'.$class_id .'/' .$section_id ;	 ?>" >
                 <i class="fa fa-eye" aria-hidden="true" title="View Fee Schedule"></i></a>
                 </td>
                   <td>
				 
				<a href="<?php echo base_url() . 'index.php/FeeManagement/students_payment_details/'. $row['student_id'].'/'.$class_id .'/' .$section_id ;	 ?>" >
                 <i class="fa fa-money" aria-hidden="true" title="View Payment Details"></i> </a>
                 </td>
                
                <td> 
                
                
                 <a href="<?php echo base_url() . 'index.php/FeeManagement/reassign_student_fees/'.$class_id.'/'. $section_id .'/'. $row['student_id'] ;	 ?>" >
                <i class="fa fa-calendar" aria-hidden="true" title="Reset Due Date"></i></a>
                 </td>
                 </tr>
                
			    <?php
                $i=$i+1;
	    }
			?>
            
            </tbody>
            </table>
            </div>
						<div class="col-sm-offset-3 col-sm-5" style="padding-left:250px;">
							
					</div>              
						</div></div></div>						
								
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
<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 
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
                                        
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/reset_due_date/'; ?>"><b><button class="btn-info">Back</button></b></a></div> 

<br/>

		<?php  
		$role_id		=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
		?>
      <input type="hidden" name="branch_id" id="branch_id" value=<?php echo $branch_id; ?> />
      <input type="hidden" name="department_id" id="department_id" value=<?php echo $department_id; ?> />
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />
     

        <?php
		}
		if($role_id==3)
		{
		?>
      <input type="hidden" name="department_id" id="department_id" value=<?php echo $department_id; ?> />
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />

        <?php
		}
		if($role_id==4 || $role_id==12)
		{
		?>
      <input type="hidden" name="class_id" id="class_id" value=<?php echo $class_id; ?> />
      <input type="hidden" name="section_id" id="section_id" value=<?php echo $section_id; ?> />
      <?php
	  	}
		
	  ?>
      <div style="padding-left:50px;padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">            
            <thead><tr><th class="table-header">SlNO</th><th class="table-header">Name</th><th class="table-header">Class / Batch</th>
            <th colspan="3" class="table-header">Action</th></tr></thead>
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
            echo  " / " . get_student_section_name($row['student_id']);
			?>
            
            <?php
			echo " </td>" ;
			?>
            
			  <td>
				 <?php
				 if($role_id==1 || $role_id==2)
					{
					?>
                    
                     <a href="<?php echo base_url() . 'index.php/FeeManagement/reset_student_fees/'.$class_id.'/'. $row['section_id'] .'/'. $row['student_id'].'/'.$department_id.'/'.$branch_id ;	 ?>" >
                    <i class="fa fa-calendar" aria-hidden="true" title="Reset Due Date"></i></a>
                    <?php
					}
					if($role_id==3)
					{
					?>
                     <a href="<?php echo base_url() . 'index.php/FeeManagement/reset_student_fees/'.$class_id.'/'. $row['section_id'] .'/'. $row['student_id'].'/'.$department_id ;	 ?>" >
                    <i class="fa fa-calendar" aria-hidden="true" title="Reset Due Date"></i></a>
                    <?php
					}
					if($role_id==4 || $role_id==12)
					{
					?>
                     <a href="<?php echo base_url() . 'index.php/FeeManagement/reset_student_fees/'.$class_id.'/'. $row['section_id'] .'/'. $row['student_id'] ;	 ?>" >
                    <i class="fa fa-calendar" aria-hidden="true" title="Reset Due Date"></i></a>
                    <?php
					}

					?>
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

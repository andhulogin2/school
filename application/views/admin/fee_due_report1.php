<?php include_once APPPATH . 'views/main_head.php';?>
 
<div id="due_sms" class="col-md-10">

        
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
							<li class="active">Fee Due Report</li>
						</ul><!-- /.breadcrumb -->

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
								<?php echo $page_title; ?>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

   
					<div align="right"><a href="<?php echo base_url();?>index.php/FeeManagement/fee_due_report"><b><button class="btn-info">Back</button></b></a></div>
<br/>       
<br/>       
<?php echo form_open('FeeManagement/fee_due_report_excel/', array('class' => 'form-horizontal'));?>  
<input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>" />
<input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" />
<input type="hidden" name="due_date" id="due_date" value="<?php echo $due_date; ?>" />
<input type="hidden" name="due_date_from" id="due_date_from" value="<?php echo $due_date_from; ?>" />
<input type="hidden" name="dept_id" id="dept_id" value="<?php echo $dept_id; ?>" />
<input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>" />
<input type="hidden" name="report_type" id="report_type" value="<?php echo $report_type; ?>" />
<input type="hidden" name="last_year_due" id="report_type" value="<?php echo $last_year_due; ?>" />
<?php	
	$res	=	base64_encode(serialize($result));
	$res1=	base64_encode(serialize($result1));
?>
<input type="hidden" name="result" id="result" value="<?php echo $res; ?>" >
<input type="hidden" name="result1" id="result1" value="<?php echo $res1; ?>" >


<?php
	if($this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
	{
	?>
	<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
		<thead>
        	<tr>
            	<th class='table-header'><input type="checkbox" id="check_all" name="check_all" onclick="checkAll()" checked="checked" /></th>
                <th class='table-header'>SlNO</th>
            	<th class='table-header'>Student</th><th class='table-header'>Admission Number</th><th class='table-header'>Class</th>
                <th class='table-header'>Phone</th><th class='table-header'>Amount</th>
            </tr>
      	</thead>
        <tbody>
    <?php
			$total=0;
			$i=1;
			if (count($result)==0)
			{
			echo "<tr><td colspan='7' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			} 
			foreach($result as $row)
			{
            echo "<tr><td><input type='checkbox' id='check_single[]' name='check_single[]' checked='checked'  /><input type='hidden' id='checked[]' name='checked[]' value=''  /></td><td>$i</td>";
			//echo "</td><td>".$row['admission_number']."</td><td>";
			
			echo "<td>". $row['name']. " <input type='hidden' id='student_id[]' name='student_id[]' value='".$row['admission_number']."'  /> </td><td>";
			echo get_admission_number($row['admission_number'])."</td><td>";
			echo get_student_class_name($row['admission_number']). " - ";
			echo get_student_section_name($row['admission_number']). " </td>";//echo $this->db->last_query();die();	
			echo "</td><td>".get_student_phone1($row['admission_number'])."</td><td align='right'>". number_format( $row['fee_balance'],2). "<input type='hidden' id='fee_balance[]' name='fee_balance[]' value='".$row['fee_balance']."'  /></td></tr>";
					$i=$i+1;
					 $total= $total+ $row['fee_balance'];
			}
			
           echo "<tr><td colspan='6' style='text-align:right'><b>Total Amount</b> </td><td align='right'><b>" . number_format( $total,2). "</b></td></tr>";
		   ?>
            </tbody>
        </table>
           <?php
	}
	else
	{
	?>
	<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
		<thead>
        	<tr>
            	<th class='table-header'><input type="checkbox" id="check_all" name="check_all" onclick="checkAll()" checked="checked" /></th>
                <th class='table-header'>SlNO</th><th class='table-header'>Due Date</th>
            	<th class='table-header'>Student</th><th class='table-header'>Class</th>
                <th class='table-header'>Phone</th><th class='table-header'>Amount</th>
                <?php
    			if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
    			{
    			    ?>
    			    <th class='table-header'>Last Paid Date</th>
    			    <th class='table-header'>Last Paid Amount</th>    
    			    <?php
    			}
    			?>

            </tr>
      	</thead>
        <tbody>
    <?php
			$total=0;
			$i=1;
			if (count($result)==0 && count($result1)==0)
			{
			echo "<tr><td colspan='7' align='center'><font color='red'><b> No Records Found...</b></font></td></tr></table>";
			die();
			} 
			foreach($result as $row)
			{
            echo "<tr><td><input type='checkbox' id='check_single[]' name='check_single[]' checked='checked'  /><input type='hidden' id='checked[]' name='checked[]' value=''  /></td><td>$i</td><td>";
			//echo "</td><td>".$row['admission_number']."</td><td>";
                        if($row['due_date'] == '0000-00-00'){ echo "-"; }else{ echo date('d-m-Y',strtotime($row['due_date'])); }
                        echo "<input type='hidden' id='due_date1[]' name='due_date1[]' value='".$row['due_date']."'  />";
			echo "</td>	<td>". $row['name']. " <input type='hidden' id='student_id[]' name='student_id[]' value='".$row['admission_number']."'  /> </td><td>";
			echo get_student_class_name($row['admission_number']). " - ";
			echo get_student_section_name($row['admission_number']). " </td>";//echo $this->db->last_query();die();	
			echo "</td><td>".$row['phone']."</td><td align='right'>". number_format( $row['fee_balance'],2). "<input type='hidden' id='fee_balance[]' name='fee_balance[]' value='".$row['fee_balance']."'  /></td>";
                        if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
			{   
			    $last_paid_info =   $this->Fee_management_model->get_last_paid_info($row['admission_number']);
			    
			    echo "<td>".$last_paid_info['last_paid_date']."</td>";    
			    echo "<td>".$last_paid_info['last_paid_amount']."</td>";    
			}
			echo "</tr>";

					$i=$i+1;
					 $total= $total+ $row['fee_balance'];
			
			}

			if($result1>0)
			{
			 echo "<tr><td colspan='7' style='text-align:center'><b>Transportation Amount</b> </td></tr>";
			foreach($result1 as $row)
			{
            echo "<tr><td><input type='checkbox' id='check_single[]' name='check_single[]' checked='checked'  /><input type='hidden' id='checked[]' name='checked[]' value=''  /></td><td>$i</td><td>";
			//echo "</td><td>".$row['admission_number']."</td><td>";
			echo  date('d-m-Y',strtotime($row['due_date']))."<input type='hidden' id='due_date2[]' name='due_date2[]' value='".$row['due_date']."'  />";
			echo "</td>	<td>". $row['name']. " <input type='hidden' id='student_id1[]' name='student_id1[]' value='".$row['student_id']."'  /> </td><td>";
			echo get_student_class_name($row['student_id']). " - ";
			echo get_student_section_name($row['student_id']). " </td>";//echo $this->db->last_query();die();	
			echo "</td><td>".get_student_phone1($row['student_id'])."</td><td align='right'>". number_format( $row['fee_balance'],2). "<input type='hidden' id='fee_balance1[]' name='fee_balance1[]' value='".$row['fee_balance']."'  /></td></tr>";
					$i=$i+1;
					 $total= $total+ $row['fee_balance'];
			
			}
			}
			
           echo "<tr><td colspan='6' style='text-align:right'><b>Total Amount</b> </td><td align='right'><b>" . number_format( $total,2). "</b></td></tr>";
		   ?>
                </tbody>
            </table>
           <?php
	}
?>
                               
 				
											</div>
               <div align="center" style="margin-top:10px;">     
                <input type='checkbox' id='phone2' name='phone2' value="1" />Phone2<br />
                <button type="submit" onclick="return check_status()" class="btn btn-info" formaction="<?php echo base_url().'index.php/FeeManagement/fee_due_report_sms'; ?>">SEND SMS</button>
                </div>
                    
                                             <div align="center" style="margin-top:10px;">
             	<button name="chk_excel" id="chk_excel" type="submit" class="btn btn-info" >Download Excel</button>
                <button name="chk_excel" id="chk_pdf" type="submit" class="btn btn-info" formaction="<?php echo base_url().'index.php/FeeManagement/fee_due_report_pdf'; ?>">Download PDF</button>

                	</div>
                
                <?php echo form_close(); ?>
             	<!--<button onclick="sms_send_due()">SEND SMS</button>-->
                <?php include_once APPPATH . 'views/footer.php'; ?>
										</div></div></div>
               
			<!-- /.main-content -->
        		
	 

			

<script type="text/javascript">
	function sms_send_due() 
	{
	var class_id=$('#class_id').val();
	var section=$('#section_id').val();
	var due_date=$('#due_date').val();
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/fee_due_report_sms/' + class_id +'/'+ section+'/'+ due_date,
            success: function(response)
            {
                jQuery('#due_sms').html(response);
            }
        });
	}
	
	function checkAll()
	{
		
		var ch_all		=	document.getElementById('check_all');
		var ch_single	=	document.getElementsByName('check_single[]');
		//var checked		=	document.getElementsByName('checked[]');
		for(i=0;i<ch_single.length;i++)
		{
			if(ch_all.checked == true)
			{
				ch_single[i].checked	=	true;
			}
			if(ch_all.checked == false)
			{
				ch_single[i].checked	=	false;
			}
		}
	}
	function check_status()
	{
		var ch_single	=	document.getElementsByName('check_single[]');	
		var checked		=	document.getElementsByName('checked[]');
		var count		=	0;
		for(i=0;i<ch_single.length;i++)
		{
			if(ch_single[i].checked == true)
			{
				checked[i].value	=	1;
				count++;
			}
			if(ch_single[i].checked == false)
			{
				checked[i].value	=	0;
			}
		}
		if(count == 0)
		{
			alert('Please select atleast one checkbox');
			return false;
		}
		return true;
	} 
	
</script>
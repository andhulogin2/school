<?php include_once APPPATH . 'views/head.php';?>
 

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
							<li class="active">Fee Schedule</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee Details 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Fee Payment Details
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section_id .'/back'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div> 
<br/>
            
<div  style="padding-left:50px;padding-right:50px;">
<?php foreach($student as $data){?>

<table class="table  table-hover">
<tr>
 <td style="text-align: left;">Name :<?php echo $data['name'];?></td>
 <td style="text-align: left;">Date Of Birth :<?php echo $data['birthday'];?></td> 
 <td style="text-align: left;">Gender :<?php echo $data['sex'];?></td></tr>
<tr>
 <td style="text-align: left;">Class  :<?php echo get_class_name($class_id); ?></td>
 <td style="text-align: left;">Section  :<?php echo get_section_name($section); ?></td>
 <td style="text-align: left;"></td>
 </tr>
<tr>
 <td style="text-align: left;">Address :<?php echo $data['address'];?></td>
 <td style="text-align: left;">Phone Number :<?php echo $data['phone1'];?></td>
 <td style="text-align: left;">Email :<?php echo $data['email'];?></td>
 </tr>
<?php }?>

<tr><td colspan="3">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" width="60%">
  <thead>
  <tr>
  <th style="text-align: center;" class="table-header"><b>SlNo</b></th>
  <th style="text-align: center;" class="table-header"><b>Date Paid</b></th>
  <th style="text-align: right;" class="table-header"><b>Receipt No.</b></th>
  <th style="text-align: right;" class="table-header"><b>Paid Amount</b></th>
</tr>
</thead>
<tbody>
<?php

$total_amount_paid = 0;
$count=0;
foreach($fee_details as $data)
{
$count=$count+1;
}
if($count==0)
{
echo "<tr><th style='text-align: center;' colspan='4'><font color='red'><b>No Fee Payment Details Found</b></font></th></table>";
die();
}

$sno=1;
foreach($fee_details as $data){

?>
<tr>
 <th style="text-align: right;"><?php echo  $sno ;?></th>
 <th style="text-align: right;"><?php echo date('d-m-Y',strtotime($data['date_paid']));?></th>
 <th style="text-align: right;"><?php echo $data['receipt_number'] ;?></th>
 <th style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></th>
<?php
$total_amount_paid		 = $total_amount_paid+$data['fee_amount'];
$sno=$sno+1;
?>
</th></tr>
<tr>
<td style="padding:0px;" colspan="8" align="right">

</td>
</tr>
<?php } ?>
<tr>
 <td style="text-align: center;" colspan="3"><b>Total</b></td>
 <td style="text-align: right;"><b><?php echo  number_format($total_amount_paid,2) ;?></b></td>
</tr>
</tbody>
</table>
</td></tr>
<tr><td></td></tr>
</table>
                                    
</div>
												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	

//////////////////
		
function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
}
</script>


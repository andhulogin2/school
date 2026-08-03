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
							<li class="active">Fee Receipt</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>								</span>
						            </form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Receipt
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
     <a href="<?php echo base_url(); ?>index.php/Transport_management/view_student_bus_fee_pay">New Receipt</a>
<DIV align="center">
<div id="print">
<div class="box-body" id="printableArea">

<?php 
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= 	$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
  //  $month_name         =  $month; 
	
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$address       		=	$this->db->get_where('settings' , array('type'=>'address'))->row()->description;
	$phone       		=	$this->db->get_where('settings' , array('type'=>'phone'))->row()->description;
	$email      		=	$this->db->get_where('settings' , array('type'=>'system_email'))->row()->description;
	$running_year       = get_running_year();
?>
<table>
<br><br>
	<center> 
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
        <h5 style="font-weight: 100;"><?php echo $address."-".$phone;?></h5>
         <h5 style="font-weight: 100;"><?php echo $email;?></h5><br />
		<h3 style="font-weight: 100;">RECEIPT</h3>
<div style="padding-left:50px; padding-right:50px;">
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
       <tr>
        <td style="text-align: left;">Receipt Number : <b><?php echo $receipt_no;?></b></td>
        <td style="text-align: right;">Payment Date : <?php echo date('d-m-Y',strtotime($date_paid));?></td> 
        </tr>
        
        <tr>
        <td style="text-align: left;">Fee Item : Bus Fee</td>
        <td style="text-align: right;"></td>
        </tr>
         
        <tr>
        <td style="text-align: left;">Name :<?php echo get_student_name($student_id); ?></td>
        <td style="text-align: right;">Class :<?php echo get_class_name($class_id).get_section_name($section_id); ?></td>
        </tr>
        <tr><td colspan="2">
        <div style="padding-left:50px; padding-right:50px;">
        <div class="gray-box">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" border="1">
            <thead>
            <tr>
            <th style="text-align: center;">Sl.No</th>
            <th style="text-align: center;">INSTALLMENT</th>
            <th style="text-align: right;">AMOUNT</th>
            </tr>
            </thead>
            <tbody>
                    <?php
					$qry = "select c.fee_collection_master_id,c.fee_head_id,sum(c.fee_amount) as fee_amount ,h.fee_head from tbl_fee_collection_details as  c 
					join 
					tbl_fee_heads as  h 
					on h.fee_head_id=c.fee_head_id 
					where c.fee_amount>0 and  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_no." ) GROUP BY c.fee_head_id ";
				/*	$qry1 = "select a.bus_fee_collection_details_id,a.bus_fee_collection_master_id,a.students_bus_fee_master_id,sum(a.fee_amount) as fee_amount,b.late_fee from tbl_transport_students_bus_fee_collection_details as a 
					inner join tbl_transport_students_bus_fee_collection_master as b on b.bus_fee_collection_master_id = a.bus_fee_collection_master_id where a.fee_amount >0 and a.bus_fee_collection_master_id in (select bus_fee_collection_master_id from tbl_transport_students_bus_fee_collection_master where receipt_number =".$receipt_no." )";*/
					$this->db->where('receipt_number',$receipt_no);
					$data =  $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();	
				//$data =  $this->db->query($qry1)->result_array();
					 $sl_no=1;
					 $total=0;
					foreach($data as $result):
						if($result['amount_paid']>0)
						{
					?>
                        <tr>
                            <td style="text-align: center;"><?php echo $sl_no;?></td>
                            <td style="text-align: center;"><?php echo $result['installment_name']; ?></td>
                            <td style="text-align: right;"><?php echo number_format($result['amount_paid'],2); ?></td>
                        </tr>
					 <?php 
					 $sl_no++; 
					 $total=$total+$result['amount_paid'];
					 	}
					 endforeach;  
                    if($total_late_fee>0)
					{
					
					?>

                     <tr>
                    	<td  colspan="2" align="right">Late Fee</td>
                    	<td style="text-align: right;"><?php echo number_format($total_late_fee,2); ?></td>
                     </tr>
                     <?php
					 $total=$total+$total_late_fee;
					 }
					 ?>
                      <tr><td colspan="2" align="right" >Total</td>
                      <td  align="right"><?php echo number_format($total,2);?></td></tr>
                       <tr><td colspan="3" align="center" >Amount in words :<b> Rupees <?php echo convert_number_to_words($total);  ?> Only</b></td></tr>
                    </tbody>
				</table>
        </div>
        </div>
        </div>
</td></tr></table>
  </div></table></div>
  <center>
       <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:justify;"  onClick="printDiv('printableArea')"> 
				<?php echo 'Print';?>
			</button>
          <a href="<?php echo base_url(); ?>index.php/Transport_management/view_student_bus_fee_pay">
                <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:justify;"> 
				<?php echo 'Next Student';?>
			</button></a>
</center>
  </div>  
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
        		</body>

    

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

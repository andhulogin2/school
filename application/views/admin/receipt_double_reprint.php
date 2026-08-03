<?php include_once APPPATH . 'views/main_head.php';?>
<body style="padding-top:0px;margin-top:0px;">
        
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
				
				<?php 
					$running_year       =	get_running_year();
					$this->db->select('class_name');
					$class_name		 	= 	$this->db->get_where('view_students',array('student_id'=>$student_id,'year'=>$running_year))->row()->class_name; 
					
					$section_name  		= 	$this->db->get_where('view_students',array('student_id'=>$student_id,'year'=>$running_year))->row()->section_name;
				  //  $month_name         =  $month; 
					
					$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
					$address       		=	$this->db->get_where('settings' , array('type'=>'address'))->row()->description;
					$phone       		=	$this->db->get_where('settings' , array('type'=>'phone'))->row()->description;
					$email      		=	$this->db->get_where('settings' , array('type'=>'system_email'))->row()->description;
					$qry = "select c.fee_collection_master_id,c.fee_head_id,sum(c.fee_amount) as fee_amount ,h.fee_head from tbl_fee_collection_details as  c 
							join 
							tbl_fee_heads as  h 
							on h.fee_head_id=c.fee_head_id 
							where c.fee_amount>0 and  c.fee_collection_master_id in 
							( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_number." and academic_year_id=".get_running_year()." 
							and branch_id=".$branch_id." and admission_number=".$student_id." ) GROUP BY c.fee_head_id ";
					$data =  $this->db->query($qry)->result_array();
				?>
				<DIV align="center">
					<div id="print">
						<div class="box-body" id="printableArea">
							<div class="" >
								<table style="width:100%;padding-top:0px;margin-top:0px;">
									<tr>
										<td style="width:20%;text-align:left;padding-top:0px;margin-top:0px;">
											<img src="<?php echo base_url();?>uploads/logo.png" alt="..."  width="auto" height="auto" style="float:left">
										</td>
										<td style="width:60%;text-align:center;padding-top:0px;margin-top:0px;">
											<h3 style="font-weight: 100;margin:0px;"><b><?php echo $system_name;?></b></h3>
											<h5 style="font-weight: 100;margin-top:3px;margin-bottom:0px;"><?php echo $address."-".$phone;?></h5>
										</td>
										<td style="width:20%">
										
										</td>
									</tr>
								</table>
								<!--<div class="row" style="">
									<div style="float:left" class="col-sm-3">
										<img src="<?php echo base_url();?>uploads/logo.png" alt="..."  width="auto" height="auto" style="float:left">
									</div>
									<div style="float:left;padding-left:170px;" class="col-sm-6">
										&nbsp;&nbsp;<h3 style="font-weight: 100;"><b><?php echo $system_name;?></b></h3>
										<h5 style="font-weight: 100;"><?php echo $address."-".$phone;?></h5>
									</div>  
									<div class="col-sm-3">
									</div>  
        						</div>-->
								<div style="text-align:center;"><h3 style="font-weight: 100;margin-top:0px;margin-bottom:3px;">RECEIPT</h3></div>
        						<!--<div style="text-align:center;">
									<h5 style="font-weight: 100;font-size:12px;"><?php echo $this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year; ?></h5>
								</div>-->
								<div style="">
    
									<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2" style="padding-top:0px;margin-top:0px;">
										<tr>
											<td style="text-align: left;width:50%;padding-top:2px;padding-bottom:2px;">Receipt No. :<b><?php echo $receipt_number;?></b></td>
											<td style="text-align: right;width:50%;padding-top:2px;padding-bottom:2px;">Date :
												<?php
													$date_p	=	$this->db->get_where('tbl_fee_collection_master',array('receipt_number'=>$receipt_number))->row()->date_paid; 
													if(date('h:i A',strtotime($date_p))=="12:00 AM")
													{
														echo date('d-m-Y',strtotime($date_p));
													}
													else
													{
														echo date('d-m-Y h:i A',strtotime($date_p));
													}
												?>
											</td> 
										</tr>
										
										<tr>
											<td style="text-align: left;padding-top:2px;padding-bottom:2px;">Name :<?php echo get_student_name($student_id); ?></td>
											<td style="text-align: right;padding-top:2px;padding-bottom:2px;">
												Admission Number :<?php $this->db->select('admission_number'); echo $this->db->get_where('student',array('student_id'=>$student_id))->row()->admission_number;?>
											</td>
										</tr>
         
        
										<tr>
											<td style="text-align: left;padding-top:2px;padding-bottom:2px;">Class : <?php echo $class_name; ?></td>
											<td style="text-align: right;padding-top:2px;padding-bottom:2px;">Section : <?php echo $section_name; ?></td>
										</tr>
										<tr>
											<td colspan="2" style="padding-bottom:0px;padding-top:1px;">
												<div style="padding-left:50px; padding-right:50px;">
													<div class="gray-box">
														<div class="table-responsive">
															<table id="myTable" class="table table-striped" border="1" style="margin-bottom:1px;">
																<thead>
																	<tr>
																		<th style="text-align: center;">Sl.No</th>
																		<th style="text-align: center;">FEE ITEM</th>
																		<th style="text-align: right;">AMOUNT</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$sl_no=1;
																	$total=0;
                                                                                /*********** opening balance start **********/
                                                                                $sl_no=1;
                                                                                $total=0;
                                                                                
                                                                                $op_bal =   "(select a.id,a.opening_balance_id,a.amount_paid,b.fee_from_year_id,c.fee_head,d.academic_year ".
                                                                                            "from tbl_opening_balance_fee_collection a ".
                                                                                            "join tbl_opening_balance b on b.id=a.opening_balance_id ".
                                                                                            "join tbl_fee_heads c on c.fee_head_id=b.fee_head_id ".
                                                                                            "join tbl_academic_year d on d.acdemic_year_id=b.fee_from_year_id ".
                                                                                            "where a.receipt_number=".$receipt_number." and a.is_deleted='N') ".
                                                                                            "UNION ALL ".
                                                                                            "(select a.id,a.opening_balance_id,a.amount_paid,b.fee_from_year_id,'Bus Fee' as fee_head,d.academic_year ".
                                                                                            "from tbl_opening_balance_transport_fee_collection a ".
                                                                                            "join tbl_opening_balance_transport b on b.id=a.opening_balance_id ".
                                                                                            "join tbl_academic_year d on d.acdemic_year_id=b.fee_from_year_id ".
                                                                                            "where a.receipt_number=".$receipt_number." and a.is_deleted='N') order by fee_from_year_id asc";
                                                                                $op_bal1 =  $this->db->query($op_bal)->result_array();
                                                                                foreach($op_bal1 as $result){
                                                                                ?>
                                                                                <tr>
                                                                                    <td style="text-align: center;"><?php echo $sl_no;?></td>
                                                                                    <td style="text-align: center;"><?php echo $result['fee_head']."(".$result['academic_year']." Due)"; ?></td>
                                                                                    <td style="text-align: right;"><?php echo number_format($result['amount_paid'],2); ?></td>
                                                                                </tr>
                                                                                <?php $sl_no++;  
                                                                                $total=$total+$result['amount_paid'];
                                                                                }  
                                                                                
                                                                                /*********** opening balance end **********/

																	foreach($data as $result)
																	{
																		?>
																		<tr>
																		<td style="text-align: center;"><?php echo $sl_no;?></td>
																		<td style="text-align: center;"><?php echo $result['fee_head']; ?></td>
																		<td style="text-align: right;"><?php echo number_format($result['fee_amount'],2); ?></td>
																		</tr>
																		<?php 
																		$sl_no++;  
																		$total=$total+$result['fee_amount'];
																	}  
																	?>
																	<tr>
																		<td colspan="2" align="right" >Total</td>
																		<td  align="right"><?php echo number_format($total,2);?></td>
																	</tr>
																	<tr>
																		<td colspan="3" align="center" >Amount in words :<b> Rupees <?php echo ucwords(convert_number_to_words($total));  ?> Only</b></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<?php //$user_id = $this->db->get_where('tbl_fee_collection_master',array('receipt_number'=>$receipt_number))->row()->collected_by;?>
										<tr>
        									<td style="text-align:left;padding-top:2px;padding-bottom:2px;" colspan="2">
												<!--Collected by: <?php echo $this->db->get_where('staff',array('user_id'=>$user_id))->row()->name;?>-->
                                                <?php
													$this->db->where('academic_year_id',$running_year);
													$this->db->where('admission_number',$student_id);
                                                    $this->db->where('is_deleted','N');
													$this->db->select('sum(fee_balance) as fee_balance');
													$balance		=	$this->db->get('tbl_students_fee_master')->row();
													$balance_amount	=	isset($balance)?$balance->fee_balance:0;
												?>
												Total Fee Balance: Rs. <b><?php echo number_format($balance_amount,2); ?></b>.<br>
											<?php if($this->db->get_where('settings',array('type'=>'show_opening_balance_in_receipt'))->row()->description=='yes'){?>
											<?php
													$this->db->where('student_id',$student_id);
													$this->db->select('sum(fee_balance) as fee_balance');
													$balance1		=	$this->db->get('tbl_opening_balance')->row();
													$balance_amount1	=	isset($balance1)?$balance1->fee_balance:0;

													$this->db->where('student_id',$student_id);
													$this->db->select('sum(fee_balance) as fee_balance');
													$balance2		=	$this->db->get('tbl_opening_balance_transport')->row();
													$balance_amount2	=	isset($balance2)?$balance2->fee_balance:0;
													$total_opening_balance	= $balance_amount1 + $balance_amount2;
												?>												
												Opening Balance: Rs. <b><?php echo number_format($total_opening_balance,2); ?></b>.
											<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
  						<center>
       						<button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:center;padding-bottom:20px;" onClick="printDiv('printableArea')"> 
								Print
							</button>
                            <?php
							if(isset($from_page) && $from_page=='payment')
							{
								?>
                                    <a href="<?php echo base_url(); ?>index.php/feeManagement/student_payment">
                                        <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:center;padding-bottom:20px;"> 
                                            <?php echo 'Next Student';?>
                                        </button>
                                    </a>
                                <?php
							}
							?>
						</center>
  					</div>  
				</div>
			</div>
		</div>
	</div><!-- PAGE CONTENT ENDS -->
</body>        		
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data) 
    {
        var mywindow = window.open('', '', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
	function printDiv(divName) 
	{
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>
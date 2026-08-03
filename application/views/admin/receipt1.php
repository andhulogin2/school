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
      
                        <?php
                        if($this->db->get_where('settings',array('type'=>'installment_wise_receipt'))->row()->description!='yes')
						{
						?>
                                        
<DIV align="center">
<div id="print">
<div class="box-body" id="printableArea">

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
	
?>
<div class="table-responsive" >

<table>
<br><br>
    
	<div style="float:left">
    	<img src="<?php echo base_url();?>uploads/logo.png" alt="..."  width="100px" height="100px" style="float:left">
	</div>
	<div style="text-align:center;">
	   	<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
	   	
	   	
        <h5 style="font-weight: 100;"><?php echo $address."-".$phone;?></h5>
    </div>    
        
		<div style="text-align:center;"><h3 style="font-weight: 100;"><br><br>RECEIPT</h3></div>
        <div style="text-align:center;"><h5 style="font-weight: 100;font-size:12px;"><?php echo $this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year; ?></h5></div>
<div style="padding-left:50px; padding-right:50px;">
    <center>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
       <tr>
        <td style="text-align: left;width:50%">Receipt No. :<b><?php echo $receipt_number;?></b></td>
        <td style="text-align: right;width:50%">Date :<?php echo date('d-m-Y',strtotime($date_paid)); ?>
			<?php
/*				$date_p		=	$this->db->get_where('tbl_fee_collection_master',array('receipt_number'=>$receipt_number))->row(); 
				//$date_p		=	isset($date_p->date_paid)?$date_p->date_paid:$this->db->get_where('tbl_transport_students_bus_fee_collection_master',array('receipt_number'=>$receipt_number))->row()->date_paid;
				
				if(isset($date_p->date_paid))
				{
				    $date_paid =   $date_p->date_paid;
				}
				else
				{
				    $date_p1    =   $this->db->get_where('tbl_transport_students_bus_fee_collection_master',array('receipt_number'=>$receipt_number))->row();
				    if(isset($date_p1))
				    {
				        $date_paid  =   $date_p1->date_paid;
				    }
				    else
				    {
				        $date_p2    =   $this->db->get_where('tbl_opening_balance_fee_collection',array('receipt_number'=>$receipt_number))->row();
				        if(isset($date_p2))
				        {
				            $date_paid  =   $date_p2->date_paid;
				        }
				        else
				        {
				            $date_p3    =   $this->db->get_where('tbl_opening_balance_transport_fee_collection',array('receipt_number'=>$receipt_number))->row();
				            if(isset($date_p3))
					        {
					            $date_paid  =   $date_p3->date_paid;
					        }
				        }
				    }
				}
				
				if(date('h:i A',strtotime($date_p))=="12:00 AM")
				{
					echo date('d-m-Y',strtotime($date_paid));
				}
				else
				{
					echo date('d-m-Y h:i A',strtotime($date_paid));
				}
*/			?>
            </td> 
        </tr>
        
        <tr>
        <td style="text-align: left;">Name :<?php echo get_student_name($student_id); ?></td>
        <td style="text-align: right;">Admission Number :<?php $this->db->select('admission_number'); echo $this->db->get_where('student',array('student_id'=>$student_id))->row()->admission_number;?></td>
        </tr>
         
        
        <tr>
        <td style="text-align: left;">Class : <?php echo $class_name; ?></td>
        <td style="text-align: right;">Section : <?php echo $section_name; ?></td>
        </tr>
		<?php
        if($this->db->get_where('settings',array('type'=>'installments_row_in_receipt'))->row()->description == 'yes')
        {
					//To get only the installment numbers 
					$acd_year   =   get_running_year();
					$qry1	=	"select distinct(d.fee_payment_options_details) from tbl_fee_collection_master as a 
									join 
										tbl_students_fee_master as b on b.students_fee_master_id=a.student_fee_master_id
									join 
										tbl_fee_installment_master as c on c.fee_installment_master_id = b.	fee_installment_master_id
									join 
										tbl_fee_payment_options_details as d on d.fee_payment_options_details_id = c.fee_payment_options_details_id
									where a.receipt_number=".$receipt_number." and branch_id=".$branch_id." and a.academic_year_id=".$acd_year." order by d.fee_payment_options_details";
					$data1 =  $this->db->query($qry1)->result_array();

        ?>
        <tr>
        	<td colspan="2" style="text-align:center">INSTALLMENTS: 
            		<?php
					$l=1;
					foreach($data1 as $result):
						if($l!=count($data1))
						{
							echo $result['fee_payment_options_details'].",";
						}
						else
						{
							echo $result['fee_payment_options_details'];
						}
						$l++;
					endforeach;
					?>
            </td>
        </tr>
        <?php
		}
		?>
        <tr><td colspan="2">
        <div style="padding-left:50px; padding-right:50px;">
        <div class="gray-box">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" border="1">
            <thead>
            <tr>
            <th style="text-align: center;">Sl.No</th>
            <th style="text-align: center;">FEE ITEM</th>
            <th style="text-align: right;">AMOUNT</th>
            </tr>
            </thead>
            <tbody>
                    <?php
                                        /*********** opening balance start **********/
                                        $sl_no=1;
                                        $total=0;

                                        $op_bal =   "(select a.id,a.opening_balance_id,a.amount_paid,a.paid_year_id,b.fee_from_year_id,c.fee_head,d.academic_year ".
                                                    "from tbl_opening_balance_fee_collection a ".
                                                    "join tbl_opening_balance b on b.id=a.opening_balance_id ".
                                                    "join tbl_fee_heads c on c.fee_head_id=b.fee_head_id ".
                                                    "join tbl_academic_year d on d.acdemic_year_id=b.fee_from_year_id ".
                                                    "where a.receipt_number=".$receipt_number." and a.paid_year_id=".$running_year." and a.is_deleted='N') ".
                                                    "UNION ALL ".
                                                    "(select a.id,a.opening_balance_id,a.amount_paid,a.paid_year_id,b.fee_from_year_id,'Bus Fee' as fee_head,d.academic_year ".
                                                    "from tbl_opening_balance_transport_fee_collection a ".
                                                    "join tbl_opening_balance_transport b on b.id=a.opening_balance_id ".
                                                    "join tbl_academic_year d on d.acdemic_year_id=b.fee_from_year_id ".
                                                    "where a.receipt_number=".$receipt_number." and a.paid_year_id=".$running_year." and a.is_deleted='N') order by fee_from_year_id asc";
                                        $op_bal1 =  $this->db->query($op_bal)->result_array();//print_r($op_bal1);echo $this->db->last_query();
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

					$qry = "select c.fee_collection_master_id,c.fee_head_id,sum(c.fee_amount) as fee_amount ,h.fee_head from tbl_fee_collection_details as  c 
					join 
					tbl_fee_heads as  h 
					on h.fee_head_id=c.fee_head_id 
                    
					where c.fee_amount>0 and  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_number." and branch_id=".$branch_id." and admission_number=".$student_id." and academic_year_id=".$running_year." ) GROUP BY c.fee_head_id ";
			
					/*
					join tbl_fee_collection_master as i on i.fee_collection_master_id=c.fee_collection_master_id
					join tbl_students_fee_master as j on j.students_fee_master_id=i.student_fee_master_id
					join tbl_fee_installment_master as k on k.fee_installment_master_id=j.fee_installment_master_id
					join tbl_fee_payment_options_details as l on l.fee_payment_options_details_id = k.fee_payment_options_details_id 
					*/
				$data =  $this->db->query($qry)->result_array();
				//echo $this->db->last_query();die();
					 
					foreach($data as $result){
					?>
                    <tr>
                    <td style="text-align: center;"><?php echo $sl_no;?></td>
                    <td style="text-align: center;"><?php echo $result['fee_head']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($result['fee_amount'],2); ?></td>
                    </tr>
                     <?php $sl_no++;  
					 $total=$total+$result['fee_amount'];
				    }  
					if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description == 'yes') 
					{
					$this->db->select('SUM(amount_paid) as amount_paid');    
					$this->db->where('receipt_number',$receipt_number);
                    $this->db->where('academic_year',$running_year);
                    $this->db->where('student_id',$student_id);
					$data =  $this->db->get('view_transport_students_bus_fee_collection_details')->row();	
                            if($data->amount_paid !='')
							{
                            ?> 
                            <tr>
                                <td style="text-align: center;"><?php echo $sl_no;?></td>
                                <td style="text-align: center;"><?php echo "Bus Fee"; ?></td>
                                <td style="text-align: right;"><?php echo number_format($data->amount_paid,2); ?></td>
                            </tr>
                            <?php $sl_no++;  
                            $total=$total+$data->amount_paid;
                            }  
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
</td></tr>
		<?php 
		if($this->db->get_where('settings',array('type'=>'show_collected_by'))->row()->description=='yes')
		{
			$user_id = $this->db->get_where('tbl_fee_collection_master',array('receipt_number'=>$receipt_number))->row()->collected_by;?>
        	<td style="text-align:left;" colspan="2">Collected by: <?php echo $this->db->get_where('staff',array('user_id'=>$user_id))->row()->name;?></td>
        <?php
		}
		?>    
</table>
  </div></center></table></div></div>
  <center>
       <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:center;padding-bottom:20px;"  onClick="printDiv('printableArea')"> 
				Print
			</button>
          
</center>
  </div>  
											</div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                           <?php
										   }
										   else
										   {
										   ?>
										   
										   
										   
										   
<DIV align="center">
<div id="print">
<div class="box-body" id="printableArea">

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
	
?>
<div class="table-responsive" >

<table>
<br><br>
    
	<div style="float:left">
    	<img src="<?php echo base_url();?>uploads/logo.png" alt="..."  width="100px" height="100px" style="float:left">
	</div>
	<div style="text-align:center;">
	   	<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
	   	
	   	
        <h5 style="font-weight: 100;"><?php echo $address."-".$phone;?></h5>
    </div>    
        
		<div style="text-align:center;"><h3 style="font-weight: 100;"><br><br>RECEIPT</h3></div>
        <div style="text-align:center;"><h5 style="font-weight: 100;font-size:12px;"><?php echo $this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year; ?></h5></div>
<div style="padding-left:50px; padding-right:50px;">
    <center>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
       <tr>
        <td style="text-align: left;width:50%">Receipt No. : <b><?php echo $receipt_number;?></b></td>
        <td style="text-align: right;width:50%">Date :
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
        <td style="text-align: left;">Name : <?php echo get_student_name($student_id); ?></td>
        <td style="text-align: right;">Admission Number : <?php $this->db->select('admission_number'); echo $this->db->get_where('student',array('student_id'=>$student_id))->row()->admission_number;?></td>
        </tr>
         
        
        <tr>
        <td style="text-align: left;">Class : <?php echo $class_name; ?></td>
        <td style="text-align: right;">Section : <?php echo $section_name; ?></td>
        </tr>
		<?php
					//To get only the installment numbers 
					$qry1	=	"select distinct(d.fee_payment_options_details) from tbl_fee_collection_master as a 
									join 
										tbl_students_fee_master as b on b.students_fee_master_id=a.student_fee_master_id
									join 
										tbl_fee_installment_master as c on c.fee_installment_master_id = b.	fee_installment_master_id
									join 
										tbl_fee_payment_options_details as d on d.fee_payment_options_details_id = c.fee_payment_options_details_id
									where a.receipt_number=".$receipt_number." and branch_id=".$branch_id." order by d.fee_payment_options_details";
					$data1 =  $this->db->query($qry1)->result_array();
		?>            
        <tr><td colspan="2">
        <div style="padding-left:50px; padding-right:50px;">
        <div class="gray-box">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" border="1">
            <thead>
            <tr>
            <th style="text-align: center;">Sl.No</th>
            <th style="text-align: center;">INSTALLMENT</th>
            <th style="text-align: center;">FEE ITEM</th>
            <th style="text-align: right;">AMOUNT</th>
            </tr>
            </thead>
            <tbody>
                    <?php
$qry = "select c.fee_collection_master_id,c.fee_head_id,c.fee_amount ,h.fee_head,l.fee_payment_options_details from tbl_fee_collection_details as  c 
			join tbl_fee_heads as  h on h.fee_head_id=c.fee_head_id 
			join tbl_fee_collection_master as i on i.fee_collection_master_id=c.fee_collection_master_id
			join tbl_students_fee_master as j on j.students_fee_master_id=i.student_fee_master_id
            join tbl_fee_installment_master as k on k.fee_installment_master_id=j.fee_installment_master_id
            join tbl_fee_payment_options_details as l on l.fee_payment_options_details_id = k.fee_payment_options_details_id 
			
			where c.fee_amount>0 and  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_number." and branch_id=".$branch_id." ) order by  l.fee_payment_options_details_id asc ";
			
					/*
					join tbl_fee_collection_master as i on i.fee_collection_master_id=c.fee_collection_master_id
					join tbl_students_fee_master as j on j.students_fee_master_id=i.student_fee_master_id
					join tbl_fee_installment_master as k on k.fee_installment_master_id=j.fee_installment_master_id
					join tbl_fee_payment_options_details as l on l.fee_payment_options_details_id = k.fee_payment_options_details_id 
					*/
				$data =  $this->db->query($qry)->result_array();
				//echo $this->db->last_query();die();
					 $sl_no=1;
					 $total=0;
					foreach($data as $result){
					?>
                    <tr>
                    <td style="text-align: center;"><?php echo $sl_no;?></td>
                    <td style="text-align: center;"><?php echo $result['fee_payment_options_details'];?></td>
                    <td style="text-align: center;"><?php echo $result['fee_head']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($result['fee_amount'],2); ?></td>
                    </tr>
                     <?php $sl_no++;  
					 $total=$total+$result['fee_amount'];
					 }  
					if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description == 'yes') 
					{
					/*$qry = "select c.fee_collection_master_id,c.fee_head_id,sum(c.fee_amount) as fee_amount ,h.fee_head from tbl_fee_collection_details as  c 
					join 
					tbl_fee_heads as  h 
					on h.fee_head_id=c.fee_head_id 
					where c.fee_amount>0 and  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_number." ) GROUP BY c.fee_head_id ";
					*/
					$this->db->where('receipt_number',$receipt_number);
					$data =  $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();	
                            foreach($data as $result)
							{
                            ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $sl_no;?></td>
                                <td style="text-align: center;"><?php echo $result['installment_name'];?></td>
                                <td style="text-align: center;"><?php echo "Bus Fee"; ?></td>
                                <td style="text-align: right;"><?php echo number_format($result['amount_paid'],2); ?></td>
                            </tr>
                            <?php $sl_no++;  
                            $total=$total+$result['amount_paid'];
                            }  
					}        
							?>
                      <tr><td colspan="3" align="right" >Total</td>
                      <td  align="right"><?php echo number_format($total,2);?></td></tr>
                       <tr><td colspan="4" align="center" >Amount in words :<b> Rupees <?php echo convert_number_to_words($total);  ?> Only</b></td></tr>
                    </tbody>
				</table>
        </div>
        </div>
        </div>
</td></tr>
		<?php 
		if($this->db->get_where('settings',array('type'=>'show_collected_by'))->row()->description=='yes')
		{
			$user_id = $this->db->get_where('tbl_fee_collection_master',array('receipt_number'=>$receipt_number))->row()->collected_by;?>
        	<td style="text-align:left;" colspan="2">Collected by: <?php echo $this->db->get_where('staff',array('user_id'=>$user_id))->row()->name;?></td>
        <?php
		}
        ?>    
</table>
  </div></center></table></div></div>
  <center>
       <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:center;padding-bottom:20px;"  onClick="printDiv('printableArea')"> 
				Print
			</button>
          
</center>
  </div>  
											</div>                                           
											<?php
											} 
                                            ?>
                                            
                                            
                                            
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		

    

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
</script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}


var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

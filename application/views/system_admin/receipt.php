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
                                        
     <a href="<?php echo base_url(); ?>index.php/feeManagement/student_payment">New Receipt</a>
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
	$running_year       =	get_running_year();
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
        <td style="text-align: left;">Receipt No. :<b><?php echo $receipt_no;?></b></td>
        <td style="text-align: right;">Payment Date :<?php echo $date_paid;?></td> 
        </tr>
        
        <tr>
        <td style="text-align: left;">Name :<?php echo get_student_name($student_id); ?></td>
        <td style="text-align: right;"><?php //echo $student_id;?></td>
        </tr>
         
        
        <tr>
        <td style="text-align: left;">Class :<?php echo get_class_name($class_id); ?></td>
        <td style="text-align: right;">Batch:<?php echo get_section_name($section_id); ?></td>
        </tr>
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
					$qry = "select c.fee_collection_master_id,c.fee_head_id,sum(c.fee_amount) as fee_amount ,h.fee_head from tbl_fee_collection_details as  c 
					join 
					tbl_fee_heads as  h 
					on h.fee_head_id=c.fee_head_id 
					where c.fee_amount>0 and  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_no." ) GROUP BY c.fee_head_id ";
			
				$data =  $this->db->query($qry)->result_array();
					 $sl_no=1;
					 $total=0;
					foreach($data as $result){
					?>
                    <tr>
                    <td style="text-align: center;"><?php echo $sl_no;?></td>
                    <td style="text-align: center;"><?php echo $result['fee_head']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($result['fee_amount'],2); ?></td>
                    </tr>
                     <?php $sl_no++;  
					 $total=$total+$result['fee_amount'];
					 }  ?>
                      <tr><td colspan="2" align="right" >Total</td>
                      <td  align="right"><?php echo number_format($total,2);?></td></tr>
                       <tr><td colspan="3" align="center" >Amount in words :<b> Rupees <?php echo convert_number_to_words($total);  ?> Only</b></td></tr>
                    </tbody>
				</table>
        </div>
        </div>
        </div>
</td></tr></table>
  </div></center></table></div>
  <center>
       <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:justify;"  onClick="printDiv('printableArea')"> 
				<?php echo 'Print';?>
			</button>
          <a href="<?php echo base_url(); ?>index.php/feeManagement/student_payment">
                <button class="btn btn-info" type="submit" style="width:200px; height:30px;text-align:justify;"> 
				<?php echo 'Next Student';?>
			</button></a>
</center>
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

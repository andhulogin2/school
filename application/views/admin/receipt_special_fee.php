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
							<li class="active">Special Fee Receipt</li>
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
								Special Fee 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Receipt
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
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
        
		<div style="text-align:center;"><h3 style="font-weight: 100;"><br>RECEIPT</h3></div>
        <div style="text-align:center;"><h5 style="font-weight: 100;font-size:12px;"><?php echo $this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year; ?></h5></div>
<div style="padding-left:50px; padding-right:50px;">
    <center>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
       <tr>
        <td style="text-align: left;">Receipt No. :<b><?php echo $receipt_number;?></b></td>
        <td style="text-align: right;">Date :<?php echo date('d-m-Y',strtotime($date_paid));?></td> 
        </tr>
        
        <tr>
        <td style="text-align: left;">Name :<?php echo get_student_name($student_id); ?></td>
        <td style="text-align: right;">Admission Number :<?php $this->db->select('admission_number'); echo $this->db->get_where('student',array('student_id'=>$student_id))->row()->admission_number;?></td>
        </tr>
         
        
        <tr>
        <td style="text-align: left;">Class :<?php echo get_student_class_name($student_id); ?></td>
        <td style="text-align: right;">Batch:<?php echo get_student_section_name($student_id); ?></td>
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
            <th style="text-align: center;">DESCRIPTION</th>
            <th style="text-align: right;">AMOUNT</th>
            </tr>
            </thead>
            <tbody>
                    <?php
					$qry = "select fee_head,fee_amount,description from view_special_fee_collection_master 
					where is_deleted='N' and fee_amount>0 and receipt_number =".$receipt_number." and branch_id=".$branch_id." and student_id=".$student_id;
			
				$data =  $this->db->query($qry)->result_array();
				//echo $this->db->last_query();die();
					 $sl_no=1;
					 $total=0;
					foreach($data as $result){
					?>
                    <tr>
                    <td style="text-align: center;"><?php echo $sl_no;?></td>
                    <td style="text-align: center;"><?php echo $result['fee_head']; ?></td>
                    <td style="text-align: center;"><?php echo $result['description']; ?></td>
                    <td style="text-align: right;"><?php echo number_format($result['fee_amount'],2); ?></td>
                    </tr>
                     <?php $sl_no++;  
					 $total=$total+$result['fee_amount'];
					 }  ?>
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
			$user_id = $this->db->get_where('view_special_fee_collection_master',array('receipt_number'=>$receipt_number,'is_deleted'=>'N'))->row()->entered_by;?>
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

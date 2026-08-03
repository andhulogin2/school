<div id="print">
<div class="box-body" id="printableArea">
<?php 
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section_name  		= 	$this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
    $month_name         =  $month; 
	
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$address       		=	$this->db->get_where('settings' , array('type'=>'address'))->row()->description;
	$phone       		=	$this->db->get_where('settings' , array('type'=>'phone'))->row()->description;
	$email      		=	$this->db->get_where('settings' , array('type'=>'system_email'))->row()->description;
	$running_year       =	get_running_year();
?>

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	

	<center>
		
		<h3 style="font-weight: 100;"><?php echo $system_name;?></h3>
        <h5 style="font-weight: 100;"><?php echo $address."-".$phone;?></h5>
         <h5 style="font-weight: 100;"><?php echo $email;?></h5><br />
 	
		<h3 style="font-weight: 100;">RECEIPT</h3>
          
            <div style="padding-left:50px; padding-right:50px;">
        
                <div class="table-responsive">
<table class="table">
<tr>
<td style="text-align: left;">Receipt No. :<b><?php echo $receipt_no;?></b></td>
<td style="text-align: right;">Payment Date :<?php echo date("d-m-Y");?></td> 
</tr>

<tr>
<td style="text-align: left;">Name :<?php echo get_student_name($student_id); ?></td>
<td style="text-align: right;">Admission No :<?php echo $student_id;?></td>
</tr>
 

<tr>
<td style="text-align: left;">Class :<?php echo get_class_name($class_id); ?></td>
<td style="text-align: right;">Batch:<?php echo get_section_name($section); ?></td>
</tr>

</div>

            
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
					
					$qry = "select c.fee_collection_master_id,c.fee_head_id,c.fee_amount,h.fee_head from tbl_fee_collection_details as  c 
					join 
					tbl_fee_heads as  h 
					on h.fee_head_id=c.fee_head_id 
					where  c.fee_collection_master_id in ( select fee_collection_master_id from tbl_fee_collection_master where receipt_number =".$receipt_no." )";
				
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
					 }
					 
					  ?>
                      <tr><td colspan="2" align="right" >Total</td>
                      <td  align="right"><?php echo number_format($total,2);?></td></tr>
                      
                       <tr><td colspan="3" align="center" >Amount in words :<b> Rupees <?php echo get_phrase( convert_number_to_words($total));  ?> Only</b></td></tr>
                     
                    </tbody>
</table>
</div>
</div>
</div>
</td></tr></table>
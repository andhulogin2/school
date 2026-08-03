
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		table tr td,th{
			padding:3px;
		}
	</style>
</head>
<body>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      	<div class="row">
	      	<!-- right column -->
	      	<div class="col-md-12">
		        <div class="box box-info">
		            <div class="box-header with-border">
		              <table width="100%">
		              	<tr>
		              		<td align="center">
		              			<!--<h3 class="box-title"><img src="<?php // echo base_url(); ?>assets/images/logo.png"/></h3>!-->
		              		</td>
		              	</tr>
		              </table>
		              
		            </div>
		            <!-- /.box-header -->
                    <div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>


                    <div class="col-md-10" align="center"><b>PURCHASE DETAILS</b></div>
                      <div class="box-body">
				    <?php	
					$prev_purchase_id="";
                    foreach ($result as $row) { 
                    $current_purchase_id=$row['purchase_master_id'];
					if($prev_purchase_id!=$current_purchase_id)
					{?>
                    <div class="col-md-10" align="center">
                    
					     <b> Date:<?php echo date('d-m-Y',strtotime($row['purchase_date']));?></b>
                        <br>  <b>Invoice:<?php echo $row['purchase_invoice_number'];?></b></div>
                        
			               <div class="col-sm-12" style="overflow-y: auto;margin-top: 4%">
                                        <table class="table table-hover table-bordered" width="100%" style="border:1px solid;border-collapse:collapse">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;border:1px solid">Item</th>
                                                <th style="text-align: center;border:1px solid">Quantity</th>
                                                <th style="text-align: center;border:1px solid">Price</th>
                                                <th style="text-align: center;border:1px solid">Unit</th>
                                                <th style="text-align: center;border:1px solid">Sub Total</th>
                                                <th style="text-align: center;border:1px solid">Discount</th>
                                                <th style="text-align: center;border:1px solid">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                	 <?php } ?>          	
				            	
                       
			         
			           
                          
			            			
			            			     <tr>
                                                <td style="border:1px solid"><center><?php echo $row['item_name'];?></center></td>
                                                <td style="border:1px solid"><center><?php echo $row['purchase_quantity'];?></center></td>
                                                <td style="border:1px solid"><center><?php echo number_format($row['purchase_rate'],2);?></center></td>
                                                <td style="border:1px solid"><center><?php echo $row['unit_long_name'];?></center></td>
                                                <td style="border:1px solid"><center><?php echo number_format($row['purchase_price'],2);?></center></td>
                                                <td style="border:1px solid"><center><?php echo number_format($row['discount'],2);?></center></td>
                                                <td style="border:1px solid"><center><?php echo number_format($row['net_total'],2);?></center></td>
                                               
			            			     </tr>
			            			 
	                        
                        <?php  
						$prev_purchase_id=$current_purchase_id;
						} 
                        ?>
                        
                        <tr>
                        <td style="border:1px solid" colspan="4"><center><b>Total</b></center></td>
                       <td style="border:1px solid" ><center><b><?php echo  number_format($row['invoice_amount'],2);?></b></center></td>
                       <td style="border:1px solid" ><center><b><?php echo  number_format($row['discount_received'],2);?></b></center></td>
                        <td style="border:1px solid" ><center><b><?php echo  number_format($row['net_amount'],2);?></b></center></td>
                        </tr>

                        
                        
                         </tbody>
			            	</table>
			           </div>			            
                       <div class="col-sm-12">
			            	<table align="right" width="35%">
			            		<tr>
			            		</tr>
			            		<tr>
			            	
			            		</tr>
			            	</table>
			            </div>
		            </div>
		            <!-- /.box-body -->
		        </div>      
		            
	            <!-- /.box -->
	        </div>
	        <!--/.col (right) -->
      	</div>
      	<!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</body>
</html>
<?php
	
?>
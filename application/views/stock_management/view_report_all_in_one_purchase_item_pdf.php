
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
		              			<!--<h3 class="box-title"><img src="<?php  echo base_url(); ?>assets/images/logo.png"/></h3>!-->
		              		</td>
		              	</tr>
		              </table>
		              
		            </div>
		            <!-- /.box-header -->
                    <div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>


                    <div align="center">PURCHASE ITEMS REPORT</div>
                                    <br><br>
					            <table class="table table-hover table-bordered" width="100%" style="border:1px solid;border-collapse:collapse">
			            		<thead>
                                <tr>
                                    <th style="text-align: center;border:1px solid">Date</th>
                                    <th style="text-align: center;border:1px solid">Invoice</th>
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
			            			<?php 
									$qty=0;
									$total=0;
									$discount=0;
									$net=0;
									
									foreach ($result as $row) { ?>
			            			<tr>
                                    <td style="border:1px solid"><center><?php echo $row['purchase_date'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $row['purchase_invoice_number'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $row['item_name'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $row['purchase_quantity'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo number_format($row['purchase_rate'],2);?></center></td>
                                    <td style="border:1px solid"><center><?php echo $row['unit_long_name'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo number_format($row['purchase_price'],2);?></center></td>
                                    <td style="border:1px solid"><center><?php echo number_format($row['discount'],2);?></center></td>
                                    <td style="border:1px solid"><center><?php echo number_format($row['net_total'],2);?></center></td>
                                    </tr>
                                      <?php 
									  $qty=$qty + $row['purchase_quantity'];
									  $total=  $total + $row['purchase_price'];
									  $discount=  $discount + $row['discount'];
									  $net=$net + $row['net_total'];
									  }
									  ?>
                                     <tr>
                                      <td style="border:1px solid" colspan="3"><center><b>Total</b></center></td>
                                      <td style="border:1px solid" ><center><b><?php echo number_format($qty,2);?></b></center></td>
                                      <td style="border:1px solid" colspan="2"><center></center></td>
                                       <td style="border:1px solid" colspan=""><center><b><?php echo number_format($total,2);?></b></center></td>
                                        <td style="border:1px solid" colspan=""><b><center><?php echo number_format($discount,2);?></b></center></td>
                                         <td style="border:1px solid" colspan=""><b><center><?php echo number_format($net,2);?></b></center></td>
                                     </tr> 
                                    </tbody>
			            	       </table>
                                   
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
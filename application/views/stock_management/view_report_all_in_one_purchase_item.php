
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table tr td,th{
			padding:3px;
		}
	</style>
</head>
<body>
<?php
$data1['branch_id']	=	$branch_id;
	$data1['date_from']	=	    $date_from;
	$data1['date_to']	=	     $date_to;
	$data1['item_master_id']	= $item_master_id;
	$data1['report_type']	=	"sales_report";
	$_SESSION["data1"] = 	$data1;
	?>
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
                                       <div class="pull-right"><a href="<?php echo base_url('index.php/stock_management/pdf_purchase_report_item/');?>" target="_blank "><i class="btn btn-info">Download</i></a></div>
					            <table class="table table-hover table-bordered">
			            		<thead>
                                <tr>
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">Invoice</th>
                                    <th style="text-align: center;">Item</th>
			            			<th style="text-align: center;">Quantity</th>
			            			<th style="text-align: center;">Price</th>
			            			<th style="text-align: center;">Unit</th>
			            			<th style="text-align: center;">Sub Total</th>
			            			<th style="text-align: center;">Discount</th>
			            			<th style="text-align: center;">Total</th>
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
                                    <td><center><?php echo $row['purchase_date'];?></center></td>
                                    <td><center><?php echo $row['purchase_invoice_number'];?></center></td>
                                    <td><center><?php echo $row['item_name'];?></center></td>
                                    <td><center><?php echo $row['purchase_quantity'];?></center></td>
                                    <td><center><?php echo number_format($row['purchase_rate'],2);?></center></td>
                                    <td><center><?php echo $row['unit_long_name'];?></center></td>
                                    <td><center><?php echo number_format($row['purchase_price'],2);?></center></td>
                                    <td><center><?php echo number_format($row['discount'],2);?></center></td>
                                    <td><center><?php echo number_format($row['net_total'],2);?></center></td>
                                    </tr>
                                      <?php 
									  $qty=$qty + $row['purchase_quantity'];
									  $total=  $total + $row['purchase_price'];
									  $discount=  $discount + $row['discount'];
									  $net=$net + $row['net_total'];
									  }
									  ?>
                                     <tr>
                                      <td colspan="3"><center><b>Total</b></center></td>
                                      <td ><center><b><?php echo number_format($qty,2);?></b></center></td>
                                      <td colspan="2"><center></center></td>
                                       <td colspan=""><center><b><?php echo number_format($total,2);?></b></center></td>
                                        <td colspan=""><b><center><?php echo number_format($discount,2);?></b></center></td>
                                         <td colspan=""><b><center><?php echo number_format($net,2);?></b></center></td>
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
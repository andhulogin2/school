
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
                    <div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
		              		</td>
		              	</tr>
		              </table>
		              
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
                    <?php foreach ($master as $row) { ?>
		            	<div class="col-sm-12 well well-sm" align="center">
		            		<b>Date : <?php echo $row['sales_date'];?></b>
		            		<br>
		            		<b>Name : <?php echo $row['student'];?></b>
		            <div align="right">
		            	
		            		Total :	<b><?php echo $row['bill_amount'];?></b>	&nbsp;&nbsp;Discount:<?php echo $row['discount_allowed'];?>
                         
			            		<br>Grand Total:	<b><?php echo $row['net_amount'];?></b>	
                                 <?php  } ?>  
			            			</div>
			            		 </div>
                                	          	
                          
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
			            			<?php foreach ($data as $value) { ?>
			            			<tr>
                                    <td style="border:1px solid"><center><?php echo $value['item_name'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['sales_quantity'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['unit_rate'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['unit_long_name'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['sales_amount'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['discount'];?></center></td>
                                    <td style="border:1px solid"><center><?php echo $value['net_total'];?></center></td>
                                   
			            			</tr>
			            			 <?php  } ?>
			            			<tr>
			            		        <td style="border:1px solid" colspan="6" align="right" ><b>Total Amount</b></td>
			            				<td style="border:1px solid" align="right"><center><?php echo $this->session->userdata('symbol'). $row['net_amount'];?></center></td>	
			            			</tr>
			            		</tbody>
			            	</table>
			           </div>
			            <div class="col-sm-12">
			            	<table align="right" width="35%">
			            		<tr>
			            			<td style="border:1px solid" style="border-bottom: 1px solid #000;"><br></td>
			            		</tr>
			            		<tr>
			            		<br><br><br><br><td>Stamp & Signature</td>
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
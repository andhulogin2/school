
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
                      <div class="box-body">
				    <?php	
					$prev_sales_id="";
                    foreach ($result as $row) { 
                    $current_sales_id=$row['sales_master_id'];
					if($prev_sales_id!=$current_sales_id)
					{?>
                    <div class="col-md-10" align="left">
					     <b> Date:<?php echo date('d-m-Y',strtotime($row['sales_date']));?></b></div>
                      <div class="col-md-10" align="center"><b>SALES DETAILS</b></div>
 <div class="col-md-10" align="right" style="width:20"><a href="<?php echo base_url('index.php/stock_management/pdf_sales_report/');?><?php echo $row['sales_master_id']; ?>" target="_blank "> <i class="btn btn-info">Download</i></a></div>
		            	
		            		
                            
			            			
			            <div class="col-sm-12" style="overflow-y: auto;margin-top: 4%">
			            	<table class="table table-hover table-bordered">
			            		<thead>
                                <tr>
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

                                	 <?php } ?>          	
				            	
                       
			         
			           
                          
			            			
			            			<tr>
                                    <td><center><?php echo $row['item_name'];?></center></td>
                                    <td><center><?php echo $row['sales_quantity'];?></center></td>
                                    <td><center><?php echo number_format($row['unit_rate'],2);?></center></td>
                                    <td><center><?php echo $row['unit_long_name'];?></center></td>
                                    <td><center><?php echo number_format($row['sales_amount'],2);?></center></td>
                                    <td><center><?php echo number_format($row['discount'],2);?></center></td>
                                    <td><center><?php echo number_format($row['net_total'],2);?></center></td>
                                   
			            			</tr>
			            			 
	                        
                        <?php  
						$prev_sales_id=$current_sales_id;
						} 
                        ?>
                         
                        <tr>
                        <td colspan="4"><center><b>Total</b></center></td>
                       <td ><center><b><?php echo  number_format($row['bill_amount'],2);?></b></center></td>
                       <td ><center><b><?php echo  number_format($row['discount_allowed'],2);?></b></center></td>
                        <td ><center><b><?php echo  number_format($row['net_amount'],2);?></b></center></td>


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
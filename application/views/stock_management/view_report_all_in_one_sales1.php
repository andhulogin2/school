
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
                   
					                <table class="table table-hover table-bordered">
			            		<thead>
                                <tr>
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">Name(class-section)</th>
			            			<th style="text-align: center;">Amount</th>
			            			<th style="text-align: center;">Discount</th>
			            			<th style="text-align: center;">Net Amount</th>
			            			<th style="text-align: center;" colspan="">Action</th>
                                    </tr>
			            		</thead>
		            	<tbody>
			            			<?php foreach ($result as $row) { ?>
                                
			            			<tr>
                                    <td><center><?php echo date('d-m-Y',strtotime($row['sales_date']));?></center></td>
                                    <td><center><?php echo $row['student'];?>(<?php echo $row['class_name'];?>-<?php echo $row['section_name'];?>)</center></td>
                                    <td><div align="right"><?php echo number_format($row['bill_amount'],2);?></div></td>
                                    <td><div align="right"><?php echo number_format($row['discount_allowed'],2);?></div></td>
                                    <td><div align="right"><?php echo number_format($row['net_amount'],2);?></div></td>
              <td>  <?php echo anchor('Stock_management/view_sales_report/' .$row['sales_master_id'], '<i class="fa fa-eye text-info"  title="View"></i>',array('target'=>'_blank'));   ?> </td> 
                                                </tr>
                                      <?php }?>
                                    </tbody>
			            	       </table>
                                   
					
				
		            
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
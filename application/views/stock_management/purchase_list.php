<?php include_once APPPATH . 'views/main_head.php';?>

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
                            <li class="active">Purchase</li>
						</ul><!-- /.breadcrumb -->

						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Purchase Stock
                              
                                <i class="ace-icon fa fa-angle-double-right"></i>
									 View
                                
							</h1>
						</div><!-- /.page-header -->
                     
					  <!-- PAGE CONTENT BEGINS -->

<div class="row">
      <?php
        if($message = $this->session->flashdata('message')){
      ?>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button">×</button>
              <?php echo $message; ?>
            <div class="alerts-con"></div>
          </div>
        </div>
      <?php
        }
      ?>


<div class="col-md-12">
<div align="right" style="padding-right:10px;padding-bottom:10px"> <a href="<?php echo base_url() . 'index.php/Stock_management/add/' ?>"><button class="btn-info">New Entry </button></a></div> 
<div class="table-header">
<center>List Purchase</center>
</div>

<div class="clearfix">
</div>


<table id="simple-table" class="table table-striped table-bordered table-hover">
<thead>

<tr>
				 <th><center>No</center></th>
                  <th><center>Purchase Date</center></th>
                  <th><center>Invoice No</center></th>
                  <th><center>Total</center></th>
                  <th><center>Discount</center></th>
                  <th><center>Grand Total</center></th>
                  <th><center>Action</center></th>
                 
       
</tr>
</thead>

<tbody>
<?php 
         
                                               
				$count = 1;

                    foreach ($data as $row) {
                      $id= $row->purchase_master_id;
                  ?>
                    <tr>
                     
                      <td><center><?php echo $count++;?></center></td>
                      
                       <td><center><?php echo date('d-m-Y',strtotime($row['purchase_date']));?></center></td>                                      
                     <td><center><?php echo $row['purchase_invoice_number'];?></center></td>
                      <td><center><?php echo $row['invoice_amount'];?></center></td>
                       <td><center><?php echo $row['discount_received'];?></center></td>
                        <td><center><?php echo $row['net_amount'];?></center></td>
                    
                 
                      <td align="center">
                          
                             
                      <a href="<?php echo base_url('index.php/stock_management/view_purchase_details/');?><?php echo $row['purchase_master_id']; ?>"><i class="fa fa-file-text-o" title="Purchase details"></i></a>
                             
                             
      <a href="<?php echo base_url('index.php/stock_management/edit_purchase/'); ?><?php echo $row['purchase_master_id']; ?>"><i class="fa fa-edit" title="Edit Purchase"></i></a>
                             
                             
                                <a href="<?php echo base_url('index.php/stock_management/pdf_purchase/');?><?php echo $row['purchase_master_id']; ?>" target="_blank  "><i class="fa fa-file-pdf-o" title="Download as PDF"></i></a>
                             
                                <a href="<?php echo base_url('index.php/stock_management/delete_purchase_master/');?><?php echo $row['purchase_master_id']; ?>"  onClick="return confirm('Are you sure to delete this entry?');"  ><i class="fa fa-close text-danger" title="Delete"></i></a>
                             
                            
                             
                             
                           
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
               
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>




<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
  function delete_id(id)
  {
  

     if(confirm('are you sure'))
     {
        window.location.href='<?php  echo base_url('index.php/stock_management/stock_item_purchase_delete/'); ?>'+id;
     }
  }
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if($action=="deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="not_deleted")
{
echo "<script>toastr.error('". "Deletion failed...', 'Not deleted', {timeOut: 5000})</script>";
}
$action = $this->session->flashdata('action');
if ($action=="Updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
?>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

<script type="text/javascript">
$(function() {
	$('#simple-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       

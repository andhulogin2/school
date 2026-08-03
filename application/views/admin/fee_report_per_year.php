<?php
  include_once APPPATH . 'views/main_head.php';  
?>

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
							<li class="active"> Reports</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee Report Per Year
							</h1>
						</div>
                        
                          
                              <br> 
  
  <div class="table-responsive">
														
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
				<thead>
                        <tr>
                            <th class="table-header"><center>Sl No.</center></th>
                            <th class="table-header"><center>Fee Head</center></th>
                            <th class="table-header"><center>Total </center></th>
                            <th class="table-header"><center>Collected</center></th>
                            <th class="table-header"><center>Balance</center></th>
                            <th class="table-header"><center>Concession</center></th>
                        </tr>
                </thead>
             
             <tbody>
					   <?php $count = 1;
                        $amount=0;
                        $collection=0;
                        $balance=0;
                        $concession=0;
						if(count($total_amount)>0){
                      foreach($total_amount as $acc):
					  $fee_collection = $acc['amount']-$acc['balance']-$acc['concession']; ?>
                        <tr>
                            <td><center><?php echo $count++;?></center></td>
                            <td><center><?php echo $acc['item_head'];?></center></td>
                            <td align="right"><?php echo number_format($acc['amount'],2);?></td>
                            <td align="right"><?php echo number_format($fee_collection,2);?></td>
                            <td align="right"><?php echo number_format($acc['balance'],2);?></td>
                            <td align="right"><?php echo number_format($acc['concession'],2);?></td>
                        </tr>

								<?php 
                                $amount		=$amount+$acc['amount'];
                                $collection	=$collection+$fee_collection;
                                $balance	=$balance+$acc['balance'];
                                $concession	=$concession+$acc['concession'];
                                endforeach;?>	
                               <tr><th colspan="2"><center>Total</center></th>
                               <td align="right"><?php echo number_format($amount,2);?></td><td align="right"><?php echo number_format($collection,2);?></td>
                               <td align="right"><?php echo number_format($balance,2);?></td><td align="right"><?php echo number_format($concession,2);?></td>
								</tr>                                
                                <?php }
								else
								{ ?>
                            <tr><td colspan="8"><font color="#FF0000"><center><b>No Data Found...</b></center></font> </td></tr>
                                <?php } ?>
                                </tbody>
            </table>



 
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', {timeOut: 5000})</script>";
}
else if ($action=="Updated")
{
echo "<script>toastr.success('". "Updated Successfully...', {timeOut: 5000})</script>";
}
else if ($action=="deleted")
{
echo "<script>toastr.success('". "Deleted Successfully...', {timeOut: 5000})</script>";
}
?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
				if($('#department').children('option').length=="1")
				{
					jQuery('#department').html("<option value='0'>Select</option>");
				}
            }
        });
    }
	

	
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script> 


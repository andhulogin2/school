<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/main_head.php';
?><body>
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
							<li class="active">expense Settings</li>
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
								Expense
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Expense Settings
								
							</h1>
						</div><!-- /.page-header -->
                     
                                       
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/add_expense_settings/'; ?>" >Add Expense Settings</a></div> 
                              <br> 
                               
                         
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        
                        <th class="table-header">Sl No.</th>
                        <th class="table-header">Amount</th>
                        <th class="table-header">Mobile Number</th>
                        <th class="table-header">Date</th>
                        <th class="table-header" colspan="2"><center>Action</center></th>
                      
                        
                    </tr>
                </thead>
             
             <tbody>
				  <?php 
				  if(count($expense)>0)
				  {
				  $count = 1;
                  foreach($expense as $row):?>
                    <tr>
                        <td><center><?php echo $count++;?></center></td>
                        <td><center><?php echo $row['amount'];?></center></td>
                        <td><center><?php echo $row['mobile_number'];?></center></td>
                        <td><center><?php echo date('d-m-Y',strtotime($row['date']));?></center></td>
                        <td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/expense_settings_edit/<?php echo  $row['id']?>" class="btn-sm btn-icon icon-left" title="Edit">
                            <i class="fa fa-edit text-info"></i>
                    </a></td>
                        <td><a href="<?php echo base_url();?>index.php/admin/expense_settings_delete/<?php echo  $row['id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');" title="Delete">
                            <i class="fa fa-close text-danger"></i>
                    </a></td>
                   </tr>

                    <?php endforeach;
					}
					else
					{
						?>
                        <tr><td colspan="5" style="color:red;text-align:center">No Records Found...</td></tr>
                        <?php
					}
					?>	
                    </tbody>
            </table>
                          </div>                                      
                   </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if(isset($action)){
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
else if ($action=="delete")
{
echo "<script>toastr.success('Deleted', {timeOut: 5000})</script>";
}
else if ($action=="edit")
{
echo "<script>toastr.success('Updated', {timeOut: 5000})</script>";
}
}
?>

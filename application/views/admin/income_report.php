<?php
  include_once APPPATH . 'views/main_head.php';  

$running_year = get_running_year();
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
							<li class="active"> Income Report</li>
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
								View
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Income Report
							</h1>
						</div>
                        
                          
                        <?php echo form_open_multipart('Admin/income_report', array('class' => 'form-horizontal'));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    

                        <div class="form-group">
             <?php $role=$this->session->userdata('role');
			 $result = base64_encode(serialize($account));
					 if($role==1 || $role==2)
					 {
					 ?>
                            <div class="col-sm-2 col-xs-12">
                               Branch 
                                <select name="branch" class="form-control selectboxit" id="branch" onChange="return get_dept(this.value)" >
                                  <option value="0">Select</option>
                                   <?php $branch=$this->db->get('tbl_branch')->result_array();
								   
                                    foreach ($branch as $branch1)
                                    {
                                        if($branch1['branch_id']==$branch_id)
                                        { ?>
                                              <option value="<?php echo $branch1['branch_id'];?>" selected="selected"><?php echo $branch1['branch_name'];?></option>
                                   <?php }
                                   else {
                                   ?>
                                   <option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                                   <?php } }?>
                                  </select>
                            </div>
                            <div class="col-sm-2 col-xs-12">
                               Department
                                <select name="department" class="form-control selectboxit" id="department" onChange="return get_item_head(this.value)" >
                                	<?php 
									if($branch_id!="" && $branch_id!="0" && $department_id!="" && $department_id!="0")
									{
										?>
                                        <option value="All">All</option>
                                        <?php
										$this->db->where('branch_id',$branch_id);
										$this->db->where('is_deleted','N');
										$departments	=	$this->db->get('tbl_department')->result_array();
										foreach($departments as $depts):
											?>
                                            
                                            <option value="<?php echo $depts['dept_id']; ?>" <?php if($depts['dept_id'] == $department_id){ echo "Selected"; } ?>><?php echo $depts['dept_name']; ?></option>
                                            <?php
										endforeach;
										?>
                                        
                                        <?php
									}
									else
									{
									?>
                                  		<option value="0">Select</option>
                                     <?php
									 }
									 ?>
                                         
                                 </select>
                            </div>
                       <?php } 
					   if($this->session->userdata('role')==3){ ?>
                         <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
                           <div class="col-sm-2 col-xs-12">
                               Department
                                <select name="department" class="form-control selectboxit" id="department" onChange="return get_item_head(this.value)" >
                                <option value="0">Select</option>
                                  <?php 
                                  $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                  $dept=$this->db->get('tbl_department')->result_array();
                                  foreach ($dept as $dept1)
                                  {
								  	if($dept1['dept_id']==$department_id)
									{ 
                                  ?><option value="<?php echo $dept1['dept_id'];?>" selected="selected"><?php echo $dept1['dept_name'];?></option>
                                  <?php } else { ?>
                                  <option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                                  <?php } }?>
                              </select>
                            </div>
                       <?php } 
					   if($this->session->userdata('role')>=4){ ?> 
                        <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
                        <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id') ?>"  />
                       <?php } ?>    
                            
                            
                            <div class="col-sm-2 col-xs-12">
                               From Date
                                <input type="text" name="from_date" id="from_date" autocomplete="off" class="form-control mydatepicker" placeholder="From Date" value="<?php echo $from_date; ?>" />
                            </div>
                            <div class="col-sm-2 col-xs-12">
                            	To Date
                                <input type="text" name="to_date" id="to_date" autocomplete="off" placeholder="To Date" class="form-control mydatepicker" value="<?php echo $to_date; ?>" />
                            </div>
                            
                          <div class="col-md-3 col-xs-3" style="padding-top:15px">
                             <input type="submit"  value='Submit' class="btn btn-info">
            
                            </div>
                            </div>
                            
                             <?php echo form_close(); ?>
           
                        
                              <br> 
                         
  <div class="table-responsive">
  <?php  $role=$this->session->userdata('role');?>
														
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
				<thead>
                        <tr>
                            
                            <th class="table-header"><center>Sl No.</center></th>
                            <th class="table-header"><center>Date</center></th>
                            <th class="table-header"><center>Voucher Number</center></th>
                            <th class="table-header"><center>Account Head </center></th>
                            <th class="table-header"><center>Credit Amount</center></th>
                            <th class="table-header"><center>Debit Amount</center></th>
                            <th class="table-header"><center>Narration</center></th>
                            
                        </tr>
                </thead>
             
             <tbody>
					   <?php $count = 1;
                        $credit_total=0;
                        $debit_total=0;
						if(count($account)>0){
                      foreach($account as $acc):?>
                        <tr>
                            <td><center>
                                <?php echo $count++;?>
                            </center></td>
                            <td><center><?php echo date('d-m-Y',strtotime($acc['day_book_date']));?></center></td>
                            <td><center><?php echo $acc['voucher_number'];?></center></td>
                            <td><center><?php echo $acc['account_head_name'];?></center></td>
                             <td><center><?php echo $acc['credit_amount'];?></center></td>
                             <td><center><?php echo $acc['debit_amount'];?></center></td>
                            <td><center><?php echo $acc['narration'];?></center></td>
                        </tr>

							<?php 
                            $credit_total=$credit_total+$acc['credit_amount'];
                            $debit_total=$debit_total+$acc['debit_amount'];
                            endforeach;?>	
                            <tr><th colspan="4">Total</th><td align="center"><?php echo $credit_total;?></td><td align="center"><?php echo $debit_total;?></td><td></td></tr>
                           <?php }
						    else { 
						   ?>
                            <tr><td colspan="7"><font color="#FF0000"><center>No Data Found...</center></font> </td></tr>
                            <?php } ?>
				</tbody>
            </table>
<?php 
if(count($account)>0){
?>
<div align="center" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/income_report_excel/'.$branch_id.'/'.$department_id.'/'.$from_date.'/'.$to_date; ?>" ><button class="btn btn-info">Download Excel</button></a> 
<a href="<?php echo base_url() . 'index.php/Admin/income_report_pdf/'.$branch_id.'/'.$department_id.'/'.$from_date.'/'.$to_date; ?>" target="_blank" ><button class="btn btn-info">Download PDF</button></a></div> 
<?php } ?> 


 
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
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


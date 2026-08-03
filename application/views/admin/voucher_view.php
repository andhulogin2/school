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
							<li class="active"> Voucher</li>
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
									 Voucher
								
							</h1>
						</div>
                        
                          
                        <?php echo form_open_multipart('Admin/view_voucher', array('class' => 'form-horizontal'));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    

                        <div class="form-group">
             <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
                            <div class="col-sm-2 col-xs-12">
                               Branch
                                <select name="branch" class="form-control selectboxit" id="branch" onChange="return get_dept(this.value)" >
                                  <option value="">Select</option>
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
                                <option value="">Select</option>
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
                            <div class="col-sm-2 col-xs-12">
                            	Voucher Type
                                <select name="voucher_type" class="form-control selectboxit" id="voucher_type" class="col-xs-12 col-sm-12" >
                                    <option value="0">Select</option>
                                    <option value="0">All</option>
                                    <?php
                                     $voucher_type 	=	$this->db->get('tbl_account_voucher_type')->result_array();
                                     foreach($voucher_type as $data){
									 	if($data['voucher_type_id']==$voucher_type_id) {?>
                                      <option value="<?php echo $data['voucher_type_id']?>" selected="selected"><?php echo $data['voucher_type_name']?></option>
                                       <?php }
									   else { ?>
                                       <option value="<?php echo $data['voucher_type_id']?>"><?php echo $data['voucher_type_name']?></option>
                                       <?php } } ?>
                                </select>
                            </div>
                            
                          <div class="col-md-2 col-xs-3" style="padding-top:15px">
                             <input type="submit"  value='Submit' class="btn btn-info">
            
                            </div>
                            </div>
                            
                             <?php echo form_close(); ?>
           
                        
                              <br> 
  <div align="right" style="padding-right:50px;padding-bottom:10px"><a href="<?php echo base_url() . 'index.php/Admin/add_voucher_single/'?>" >Add voucher</a></div>  
  
<!--  <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/voucher_bulk/'?>" >Bulk voucher</a></div>
-->  
                         
  <div class="table-responsive">
  <?php  $role=$this->session->userdata('role');?>
														
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
				<thead>
                        <tr>
                            
                            <th class="table-header"><center>Sl No.</center></th>
                            <th class="table-header"><center>Date</center></th>
                            <th class="table-header"><center>Account Head </center></th>
							<?php if($voucher_type_id!="0")
							{
                            if($voucher_type_id=='2')
                            { ?>
                            <th class="table-header"><center>Amount</center></th><!--Credit amount-->
                            <?php } 
							if($voucher_type_id=='1')
                            { ?>
                            <th class="table-header"><center>Amount</center></th><!--Debit amount-->
                            <?php }
							if($voucher_type_id=='3')
							{ ?>
                            <th class="table-header"><center>Credit Amount</center></th>
                            <th class="table-header"><center>Debit Amount</center></th>
							<?php }
							}
							else
							{
							?>
                            <th class="table-header"><center>Credit Amount</center></th>
                            <th class="table-header"><center>Debit Amount</center></th>
                            <?php }
							 ?>
                            <th class="table-header"><center>Voucher No# / Narration</center></th>
                    
                            <th class="table-header" colspan="2"><center>Action</center></center></th>
                            
                        </tr>
                </thead>
             
             <tbody>
					   <?php $count = 1;
                        $credit_total=0;
                        $debit_total=0;
						if(count($account)>0){
                      foreach($account as $acc):?>
                        <tr>
                            

                            <td><center><?php echo $count++;?></center></td>
                            <td><center><?php echo date('d-m-Y',strtotime($acc['day_book_date']));?></center></td>
                            
                            <td><?php echo $acc['account_head_name'];?></td>
							<?php if($voucher_type_id!="0")
							{
                            if($voucher_type_id=='2')
                            { ?>
                             <td align="right"><?php if($acc['credit_amount']=='0'){echo "-";} else {echo number_format($acc['credit_amount'],2);}?></td>
                            <?php } 
							if($voucher_type_id=='1')
                            { ?>
                            <td align="right"><?php if($acc['debit_amount']=='0'){echo "-";} else {echo number_format($acc['debit_amount'],2);}?></td>
                            <?php }
							if($voucher_type_id=='3')
							{ ?>
                             <td align="right"><?php if($acc['credit_amount']=='0'){echo "-";} else {echo number_format($acc['credit_amount'],2);}?></td>
                            <td align="right"><?php if($acc['debit_amount']=='0'){echo "-";} else {echo number_format($acc['debit_amount'],2);}?></td>
							<?php }
							}
							else
							{
							?>
                             <td align="right"><?php if($acc['credit_amount']=='0'){echo "-";} else {echo number_format($acc['credit_amount'],2);}?></td>
                            <td align="right"><?php if($acc['debit_amount']=='0'){echo "-";} else {echo number_format($acc['debit_amount'],2);}?></td>
                            <?php }
							 ?>
                            <td><?php if($acc['voucher_type_id']=='1'){echo "Pmt#".$acc['voucher_number']; } else if($acc['voucher_type_id']=='2'){echo "Rct#".$acc['voucher_number']; } else if($acc['voucher_type_id']=='3'){echo "Jrnl#".$acc['voucher_number']; } ?> / <?php echo $acc['narration'];?></td>
                            
                            <td style="text-align: center;">
                            												
                            <?php echo anchor('Admin/voucher_edit/' .$acc['day_book_id'], '<i class="fa fa-edit text-info"></i>'); ?>
                            </td><td >	
                    									
							<a href="<?php echo base_url();?>index.php/admin/voucher_delete/<?php echo $acc['day_book_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i> </a> </td>
						
                        </tr>

								<?php 
                                $credit_total=$credit_total+$acc['credit_amount'];
                                $debit_total=$debit_total+$acc['debit_amount'];
                                endforeach;?>	
                               <tr><th colspan="3"><center>Total</center></th>
                                <?php  if($voucher_type_id!='1') { ?><td align="right"><?php echo number_format($credit_total,2);?></td><?php } ?>
                               <?php  if($voucher_type_id!='2') { ?><td align="right"><?php echo number_format($debit_total,2);?></td><?php } ?>
                                <td colspan="4"></td></tr>
                                
                                <?php }
								else
								{ ?>
                            <tr><td colspan="8"><font color="#FF0000"><center><b>No Data Found...</b></center></font> </td></tr>
                                <?php } ?>
                                </tbody>
            </table>

<!-- <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Report/expense_report/'.$cat.'/'.$from_date.'/'.$to_date; ?>" >Download</a></div> 
 <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Report/expense_report_pdf/'.$cat.'/'.$from_date.'/'.$to_date; ?>" >Download PDF</a></div> 
-->


 
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


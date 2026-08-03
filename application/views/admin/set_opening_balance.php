<?php
$role=$this->session->userdata('role');
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
							<li class="active"> Opening Balance</li>
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
								Set
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Opening Balance
								
							</h1>
						</div> 
                       
<br />
                              
						<?php echo form_open(base_url() . 'index.php/admin/set_opening_balance ' , array('id'=>'expense_form','class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    
                                    <th class="table-header"><center>Sl No.</center></th>
                                    <th class="table-header"><center>Account Head</center></th>
                                    <th class="table-header"><center>Opening Balance</center></th>
                                  
                                    
                                </tr>
                            </thead>
             
                         <tbody>
								  <?php $count = 1;
								 $account_section_id = $this->session->userdata('account_section_id');
								 if($this->session->userdata('dept_id')){
								  $this->db->where('department_id',$this->session->userdata('dept_id')); }
								 if($account_section_id!="1")
								 {
								  $this->db->where('account_section_id',$account_section_id);
								  }
                                  $category=$this->db->get('tbl_account_head')->result_array();
                                  foreach($category as $row):?>
                                    <tr>
                                        <input type="hidden" name="account_head_id[]" value="<?php echo $row['account_head_id'];?>"  />
                                        <td><center> <?php echo $count++;?></center></td>
                                        <td><center><?php echo $row['account_head_name'];?></center></td>
                                        <td><center><input type="text" name="opening_balance[]" value="<?php echo $row['opening_balance'];?>" onkeypress="return isNumber(event)" /></center></td>
                                   
									</tr>
								<?php endforeach;?>	
                    </tbody>
            </table>
            </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info">Update</button>
              <span id="preloader-form"></span>
            </div>
        </div>
						 <?php echo form_close();?>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if($action=="updated")
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
            }
        });
    }
	
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
	
</script>


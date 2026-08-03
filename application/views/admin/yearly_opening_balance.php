<?php
$role=$this->session->userdata('role');
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
					<li class="active">Opening Balance</li>
				</ul><!-- /.breadcrumb -->
				
				<!-- #section:basics/content.searchbox -->
				<div class="nav-search" id="nav-search">
					<form class="form-search">
					<span class="input-icon">
					</span>
					</form>
				</div><!-- /.nav-search -->
			</div>
		
			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<div class="page-header">
					<h1>
					Opening Balance
					</h1>
				</div><!-- /.page-header -->
			<div>
			<?php echo form_open('Admin/add_yearly_opening_balance', array('class' => 'form-horizontal')); ?>
			
			<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2){ ?>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
					  <option value="">Select</option>
					  <?php $branch=$this->db->get('tbl_branch')->result_array();
					  foreach ($branch as $branch1)
					  {
					  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
					  <?php }?>
					  
				  </select>
				</div>
			</div>
    
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<select name="department" class="select2" id="department" >
						  <option value="">Select</option>
						  
					  </select>
				</div>
			</div>
            <?php } ?>
            <?php if($this->session->userdata('role')==3)
			{?>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
						<select name="department" class="select2" id="department" >
						<option value="">Select</option>
						  <?php 
						  $this->db->where('branch_id',$this->session->userdata('branch_id'));
						  $dept=$this->db->get('tbl_department')->result_array();
						  foreach ($dept as $dept1)
						  {
						  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
						  <?php }?>
					  </select>
				</div>
			</div>
			<?php }?>

			<?php if($this->session->userdata('role')>=4)
			{?>
				<input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id'); ?>"  />
			<?php }?>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Financial Year :<font color="#FF0000">* </font></label>
				
				<div class="col-sm-9">
					<select name="year" class="select2" id="year" required="required" onchange="check_op_balance_exist(this.value)">
						<option value="">Select</option>
						<?php $year=$this->db->get('tbl_financial_year')->result_array();
						foreach ($year as $year1)
						{
						?><option value="<?php echo $year1['financial_year_id'];?>"><?php echo $year1['description'];?></option>
						<?php }?>
					</select>
				</div>
				<div class="col-sm-offset-3 col-sm-9" id="opening_balance_exist"></div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Opening Balance :<font color="#FF0000">* </font></label>
				<div class="col-sm-9">
					<input type="text" id="amount" placeholder="Amount" class="col-xs-10 col-sm-5" name="amount" required/>
				</div>
			</div>
			
			<button type="submit" id="btnSubmit" class="btn btn-info" style="margin-left:400px;">
			Save
			</button>
			<div></div>
			<br />
		</div>
		<?php echo form_close(); ?>
	</div>


	<div class="form-group">
		<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
			<thead>
				<tr>
					<th class="table-header">Sl No.</th>
					<th class="table-header">Financial Year</th>
					<th class="table-header">Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 1;
				foreach($opening as $row):?>
				<tr>
					<td><center><?php echo $count++;?></center></td>
					<td><center><?php echo $this->db->get_where('tbl_financial_year',array('financial_year_id'=>$row['financial_year']))->row()->description; ?></center></td>
					<td><center><?php echo $row['amount'];?></center></td>
				</tr>
				<?php endforeach;?>	
			</tbody>
		</table>
	</div>
</div>
</center>

</div></div>



<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              
<script type="text/javascript">
	function get_dept(branch_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	
	function check_op_balance_exist(year_id){
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/check_op_balance_exist/' + year_id ,
            success: function(response)
            {
                    if(response=="1")
                    {
                        jQuery('#opening_balance_exist').html("<span style='color:red'>Opening Balance already exist.</span>");
                        $('#btnSubmit').prop('disabled',true);
                    }
                    else if(response=="0")
                    {
                        jQuery('#opening_balance_exist').html("<span style='color:red'></span>");
                        $('#btnSubmit').prop('disabled',false);
                    }
            }
        });
	}
</script>

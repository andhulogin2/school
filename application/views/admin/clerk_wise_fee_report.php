<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year(); ?>
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
							<li class="active">All Fee Report</li>
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
							<h1>All Fee Report</h1>
						</div>

<!--	<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2){ ?>
        <div class="col-md-2">
        <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Branch</label>
			<select name="branch" class="select2" id="branch">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
		</div>
	</div>
    
            <?php } ?>
            <?php if($this->session->userdata('role')==3)
			{?>
            <input type="hidden" name="branch" id="department" value="<?php echo $this->session->userdata('branch_id'); ?>"  />

			<?php }?>
-->	
    
        <div class="form-group">
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom: 5px;">Date From</label>
							<input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />		
			</div>
		</div>
    <div class="form-group">    
    <div class="col-md-2">
			
			<label class="control-label" style="margin-bottom: 5px;">Date To</label>
						<input type="text" name="date_to" id="date_to" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />
			</div>
    </div>
    
    <div class="form-group">    
    <div class="col-md-2" style="margin-top:20px;margin-bottom:20px">
			
				<button type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit" onClick="get_all_fee_report();">show</button>
			</div>
    </div>
         

<div id="fee_detail" style="margin-top:30px;" >


</div>

 </div>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>



<script type="text/javascript">
	function get_all_fee_report() {
	//var branch		=	$("#branch").val();
	var from_date	=	$("#date_from").val();
	var to_date		=	$("#date_to").val();
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/Admin/get_clerk_wise_fee_report/' + from_date +'/'+ to_date ,
			
            success: function(response)
            {
                jQuery('#fee_detail').html(response);

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

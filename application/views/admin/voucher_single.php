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
							<li class="active">Voucher</li>
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
								Add
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 New Voucher
								
							</h1>
						</div>
<div class="col-sm-10 widget-container-col">
										
						<?php echo form_open(base_url() . 'index.php/admin/voucher_single_add ' , array('id'=>'expense_form','class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

<div align="right"><a href="<?php echo base_url().'index.php/admin/view_voucher'; ?>"><b>Back</b></a></div>						
       
          <div class="white-box">
            <br><br>
            
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Date: <font color="#FF0000">* </font> </label>
                 
                    
                    <div class="col-sm-4">
                        <div class="clearfix">
                        <!-- #section:plugins/date-time.datepicker -->
                        <div class="input-group input-group-sm">
                                <input type="text"  id="mydatepicker"  class="form-control mydatepicker" name="voucher_date" value="<?php echo date('d-m-Y'); ?>" required/>
                                <span class="input-group-addon">
                                    <i class="ace-icon fa fa-calendar"></i>
                                </span>
                            </div>

                        <div class="space-2"></div>

                        </div>
                    </div>
                </div>
 		
             <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
                     
          <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
				<select name="branch" class="form-control selectboxit" id="branch" onChange="return get_dept(this.value)" required="">
                  <option value="">Select</option>
                   <?php $branch=$this->db->get('tbl_branch')->result_array();
					foreach ($branch as $branch1)
					{ ?>
                   <option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                   <?php } ?>
                  </select>
			</div>
		</div>
        
        <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
				<select name="department" class="form-control selectboxit" id="department" required="">
                  <option value="">Select</option>
                         
                 </select>
			</div>
		</div>
        
        <?php } ?>
        
	<?php if($this->session->userdata('role')==3)
	{?>
		<input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
			<select name="department" class="form-control selectboxit" id="department" required="">
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

    <?php } ?>

	<?php if($this->session->userdata('role')>=4)
	{?>
		<input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
		<input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id') ?>"  />

<?php } ?>
        <div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Voucher Type:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select name="voucher_type" class="form-control selectboxit" id="voucher_type" class="col-xs-12 col-sm-12" required="" onchange="get_voucher_num(this.value); get_amount_type(this.value); get_item_head(this.value)" >
				<option value="">Select</option>
                <?php
				 $voucher_type 	=	$this->db->get('tbl_account_voucher_type')->result_array();
				 foreach($voucher_type as $data){?>
				  <option value="<?php echo $data['voucher_type_id']?>"><?php echo $data['voucher_type_name']?></option>
				   <?php } ?>
			</select>
		</div>
	</div>

        <div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Item Head:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select name="item_head" class="form-control selectboxit" id="item_head" class="col-xs-12 col-sm-12" required="">
                  <option value="">Select</option>
                  
            </select>
		</div>
	</div>

        <div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Transaction Type:<font color="#FF0000">* </font></label>
        <div class="col-sm-5">
			<input type="hidden" name="amount_types" id="amount_types" />
            <select name="amount_type" class="form-control selectboxit" id="amount_type" class="col-xs-12 col-sm-12" required="" disabled="disabled" onchange="change_amount_type(this.value);"  >
				<option value="1">Credit</option>
				<option value="2">Debit</option>
			</select>
		</div>
	</div>
    
            <div class="form-group">
                <label class="col-sm-4 control-label">Voucher Number:<font color="#FF0000">* </font></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="voucher_number" id="voucher_number" placeholder="Voucher Number" required="" value="">
                </div>
            </div>
                  
            <div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Mode of Payment:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select name="transaction_mode" class="form-control selectboxit" id="transaction_mode" class="col-xs-12 col-sm-12" required="">
				<option value="">Select</option>
                <?php
				 $transaction_mode 	=	$this->db->get('tbl_account_transaction_mode')->result_array();
				 foreach($transaction_mode as $data){?>
				  <option value="<?php echo $data['transaction_mode_id']?>"><?php echo $data['transaction_mode']?></option>
				   <?php } ?>
			</select>
		</div>
	</div>
 
        <div class="form-group">
            <label class="col-sm-4 control-label">Amount:<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" required="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Narration:</label>
            <div class="col-sm-5">
                <textarea  name="narration" style="width:350px;"></textarea>
            </div>
        </div>
                  

        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info">Add</button>
              <span id="preloader-form"></span>
            </div>
        </div>
       
						 <?php echo form_close();?>

                    </div>
                  </div>
          </div>                          
                            
        </div>                              

	</div><br /><br />
            										

<?php include_once APPPATH . 'views/footer.php'; ?>

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>


<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_item_head(voucher_type) 
	{
	var dept = document.getElementById("department").value;
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_item_head/'+ voucher_type +'/'+ dept ,
            success: function(response)
            { 
                jQuery('#item_head').html(response);
            }
        });
    }
	
	function get_voucher_num(voucher_type) 
	{
	var dept = document.getElementById("department").value;
	var branch_id = document.getElementById("branch").value;
	//alert(branch_id);
	var voucher = document.getElementById('voucher_number');
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_voucher_num/'+ branch_id+'/'+ dept  +'/'+ voucher_type ,
            success: function(response)
            {
				voucher.value = response;
            }
        });
    }

	function get_amount_type(voucher_type)
	{
		var amount_type = document.getElementById("amount_type");
		if(voucher_type=="1")
		{
			document.getElementById("amount_type").options.selectedIndex = 1;
			document.getElementById("amount_types").value= 2;
		 	$( "#amount_type" ).prop( "disabled", true );
		}
		else if(voucher_type=="2")
		{
			document.getElementById("amount_type").options.selectedIndex = 0;
			document.getElementById("amount_types").value= 1;
		 	$( "#amount_type" ).prop( "disabled", true );
		}
		else
		{
		 	$( "#amount_type" ).prop( "disabled", false );
		}
	}
	
	function change_amount_type(amount_type)
	{
			document.getElementById("amount_types").value= amount_type;
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
    

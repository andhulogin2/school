<?php
  include_once APPPATH . 'views/main_head.php';  
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<div class="main-content col-md-10">
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
					</div>
						<!-- /section:basics/content.searchbox -->
					
					<!-- /section:basics/content.breadcrumbs -->
                                <div class="page-content">
                                    
                                     <div class="page-header">
                                        <h1>
                                            Voucher Bulk
                                        
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                 Add
                                            
                                        </h1>
                                    </div>
                                    </div>
                        <?php echo form_open(base_url() . 'index.php/Admin/voucher_bulk_add' , array('class' => 'form-inline validate'));?>
	<div class="row bg-title">

            <div class="form-group" style="padding-left:20px">
            <label class="control-label" style="padding-right:10px;">Date:</label>
                <div class="input-group input-group-sm">
                    <input type="text"  id="mydatepicker"  class="form-control mydatepicker"  name="voucher_date" value="<?php echo date('d-m-Y'); ?>" required/>
                    <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                    </span>
                </div>
            </div>

            <div class="form-group" style="padding-left:20px">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1">Voucher Type:<font color="#FF0000">* </font> </label>
                <div class="col-sm-5">
                    <select  name="voucher_type" class="form-control" id="voucher_type" style="width: 180px;" class="col-xs-12 col-sm-12" required="required">
                    <option value="">Select</option>
                    <?php
                     $voucher_type 	=	$this->db->get('tbl_account_voucher_type')->result_array();
                     foreach($voucher_type as $data){?>
                      <option value="<?php echo $data['voucher_type_id']?>"><?php echo $data['voucher_type_name']?></option>
                       <?php } ?>
                    </select>
                </div>
            </div>
    
   
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>
 <div class="col-md-12" style="text-align:center">
<div id="bulk_add_form">
<div id="student_entry">
	<div class="row" style="margin-bottom:10px;">

        <div class="form-group">
          <select name="item_head[]" class="form-control" id="item_head[]" style="width: 255px; margin-left: 5px;" required>
				<option value="">Select</option>
                <?php 
				
				 $account_head 	=	$this->db->get('tbl_account_head')->result_array();
				 foreach($account_head as $data){?>
				  <option value="<?php echo $data['account_head_id']?>"><?php echo $data['account_head_name']?></option>
				   <?php } ?>
          </select>
        </div>

        <div class="form-group">
			<select  name="transaction_mode[]" class="form-control" id="transaction_mode" style="width: 255px; margin-left: 5px;" required="required">
				<option value="">Select</option>
                <?php
				 $transaction_mode 	=	$this->db->get('tbl_account_transaction_mode')->result_array();
				 foreach($transaction_mode as $data){?>
				  <option value="<?php echo $data['transaction_mode_id']?>"><?php echo $data['transaction_mode']?></option>
				   <?php } ?>
			</select>
		</div>

        <div class="form-group">
          <input type="text" name="amount[]" id="amount" class="form-control" style="width: 255px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Amount');?>" required>
        </div>
        
        <div class="form-group">
			<input type="text" name="narration[]" id="narration" class="form-control" style="width: 255px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Narration');?>" >
		</div>
        
       

		<div class="form-group">
			<button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
					onclick="deleteParentElement(this)" style="margin-left: 10px;">
        		<i class="fa fa-trash-o" style="color: #fff;"></i>
        	</button>
		</div>

	</div>

</div>

		<div id="student_entry_append"></div>
        <br>
        
        <div class="row">
                <button type="button" class="btn btn-info" onClick="append_student_entry()" style="margin-left: 5px;">
                    <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                </button>
        </div>

        <br>
        
        <div class="row">
                <button type="submit" class="btn btn-success" id="submit_button" style="margin-left: 5px;">
                    <i class="entypo-check"></i> <?php echo get_phrase('Save');?>
                </button>
        </div>
     
     
<?php echo form_close();?> 
<div class="hr hr32 hr-dotted"></div>
<div></div>
</div> <div></div></div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<4;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
	function get_sections(class_id) {
	//alert(class_id);
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_sections/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
                jQuery('#bulk_add_form').show();
            }
        });
	}

	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action=$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.success('". "Failed to add...', 'Failed', {timeOut: 5000})</script>";
}
?>


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
    


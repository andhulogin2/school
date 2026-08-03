<?php include_once APPPATH . 'views/main_head.php';?>
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
					<li class="active">Set Installments</li>
				</ul><!-- /.breadcrumb -->

				<!-- #section:basics/content.searchbox -->
				<div class="nav-search" id="nav-search">
					<form class="form-search">
						<span class="input-icon">
							
					</form>
				</div><!-- /.nav-search -->

				<!-- /section:basics/content.searchbox -->
			</div>

			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				
                <div class="page-header">
					<h1>
						Setup
						
							<i class="ace-icon fa fa-angle-double-right"></i>
							 Installments
						
					</h1>
				</div><!-- /.page-header -->
                <div></div>

 
                <div align="right" style="padding-right:10px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_details_view/'. $fee_master_id . "/". $class_id ?>"><b><button class="btn-info">Back</button></b></a></div>
                <div class="row">    
                    <?php echo form_open(base_url() . 'index.php/FeeManagement/insert_set_fees', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                    <input type="hidden" name="installment_master_id" id="installment_master_id" class="form-control"  value="<?php echo $installment_master_id;?>"/>
                    <input type="hidden" name="fee_master_id" id="fee_master_id" class="form-control"  value="<?php echo $fee_master_id;?>"/>
                    <input type="hidden" name="class_id" id="class_id" class="form-control"  value="<?php echo $class_id;?>"/>
                    <div style="padding-left:50px;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fee Master Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name"  class="col-xs-10 col-sm-5" value="<?php echo $fee_master_name; ?>" readonly="readonly"/>
                            </div>
                        </div>
                    
                        <br/><br />
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
                            <div class="col-sm-9">
                    		    <input type="text" name="class_name" id="class_name"  class="col-xs-10 col-sm-5" value="<?php echo $class_name;?>" readonly="readonly"/>
                    	    </div>
                        </div>
                        <br><br />
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payament Option </label>
                            <div class="col-sm-9">
                        		<input type="text" name="payment_option" id="payment_option" class="col-xs-10 col-sm-5"  value="<?php echo $option_master; ?>" readonly="readonly"/>
                        </div></div>
                    
                        <br /><br />
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Installment Name </label>
                            <div class="col-sm-9">
                        		<input type="text" name="payment_option" id="payment_option" class="col-xs-10 col-sm-5"  value="<?php echo $installment_name; ?>" readonly="readonly"/>
                        </div></div>
                    
                        <br /><br />
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total Installments </label>
                            <div class="col-sm-9">
                        		<input type="text" name="payment_option" id="payment_option" class="col-xs-10 col-sm-5"  value="<?php echo $total_installments; ?>" readonly="readonly"/>
                        </div></div>
                        
                        <br /><br />
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date </label>
                            <div class="col-sm-9">
                        		<input type="text" name="due_date" id="due_date" class="form-control mydatepicker" style="width:200px;"  required="" value="<?php echo get_installment_due_date($installment_master_id); ?>" onChange="feeTotal();" />
                        </div>
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label><div class="col-sm-9" name="msg_due_date" id="msg_due_date" style="color:#FF0000" ></div>
                    </div>
                    
                    <br /><br /><br />
                    <?php
                    
                    
                    
                    ?>
                    <?php 
                    		$total=0;
                    		$fee_total=0;
                                    $total_balance=0;
                    		foreach($fee_heads as $fee)
                    		{
                            $fee_head_id= $fee['fee_head_id'];
                    		$fee_item_amount=get_installment_item_amount($installment_master_id,$fee_head_id);
                    		$total   = get_fee_item_total($fee_master_id,$fee_head_id);
                    		$balance = get_fee_item_balance($fee_master_id,$fee_head_id);
                    		
                    		
                    		  $total_balance=$total_balance+$balance;
                    		$fee_total = $fee_total+$fee_item_amount;
                           ?>
                           
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $fee['fee_head']; ?></label>
                        <div class="col-sm-9">
                            <input type="number" name="fee_head[]" id="fee_head[]" class="col-xs-10 col-sm-5" min="0"  required="" onChange="feeTotal();check_balance();" value="<?php echo $fee_item_amount; ?>"/>
                            <input type="hidden" name="fee_head1[]" id="fee_head1[]" value="<?php echo $fee_item_amount; ?>"/>
                            <input type="hidden" name="fee_balance[]" id="fee_balance[]" class="form-control" style="width:300px;"  value="<?php echo $balance;?>"/>
                          
                            <!--<input type="hidden" name="fee_paid[]" id="fee_paid[]" />-->
                            <input type="hidden" name="fee_total1[]" id="fee_total1[]" value="<?php echo $total; ?>" />
                          
                          
                          
                          &nbsp;&nbsp;&nbsp;Assigned :<span name="fee_paid[]" id="fee_paid[]"></span>
                           <?php  echo "/-<br>&nbsp;&nbsp;&nbsp;Total : " . number_format($total) ."/-"; ?>
                            <input type="hidden" name="fee_head_id[]" id="fee_head_id[]" class="form-control" style="width:300px;"  value="<?php echo $fee_head_id;?>"/>
                            <input type="hidden" name="head_name[]" id="head_name[]" class="form-control" style="width:300px;"  value="<?php echo $fee['fee_head']?>"/>
                        </div>
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label><div class="col-sm-9" name="msg_fee[]" id="msg_fee[]" style="color:#FF0000" ></div>
                    </div>
                          
                    <br><br />
                    <?php
                    $total=$total+$fee['fee_amount'];
                    }
                    ?>
                    <div id="check_balance" style="display:none"><font color="#FF0000">Amount Greater Than Balance</font></div>
                    <div class="form-group" >
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total </label>
                        <div class="col-sm-9">
                     		 <input type="text" name="total" id="total" class="col-xs-10 col-sm-5"  value="<?php echo $fee_total;?>" readonly="readonly" required=""/>
                        </div>
                    </div>
                    <input type="hidden" name="total_balance" id="total_balance" class="form-control" style="width:300px;"  value="<?php echo $total_balance?>"/>
                     
                    <br /><br />
                    <div class="col-md-offset-4 col-xs-offset-4">
                        <button type="submit" class="btn btn-success "  name="btn_save" id="btn_save">
                            Save
                        </button>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>                                   

												
			</div>
		</div>
	

	 

<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>




<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
		
	get_fee_balance(); 
	
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
	</script>  


<script type="text/javascript">


/////////////////////////////////////

	function get_fee_balance() 
	{
	//alert(class_id);
		var fee_head_id 	= 	document.getElementsByName('fee_head_id[]');
		var fee_master_id	=	$("#fee_master_id").val();
		var fee_paid		=	document.getElementsByName('fee_paid[]');
		var fee_total1		=	document.getElementsByName('fee_total1[]');
		var fee_balance1	=	document.getElementsByName('fee_balance1[]');
		//alert(fee_paid);
		var i				=	0;
		//alert(fee_head_id.length);
		for(i=0;i<fee_head_id.length;i++)
		{
		//alert(fee_balance1[i].value);
		//var fee_balance+i	=	fee_balance1[i].val();
			fee_head_id_value = fee_head_id[i].value;
		//alert(fee_head_id_value);
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/get_fee_balance/' + fee_master_id + '/' + fee_head_id_value,
				async: false,
				success: function(response)
				{
					//alert(i);
					fee_paid[i].innerHTML	=	response;
					//alert(fee_paid[i].value);
				}
			});
			
			/*if(fee_paid[i].value!='')
			{
				var balance	=	parseFloat(fee_total1[i].value).toFixed(2) - parseFloat(fee_paid[i].value).toFixed(2);
				fee_balance1[i].innerHTML	=	balance;
			}*/
			
		}
	}






/////////////////////////////////////	

function feeTotal() {
		var fees 	= document.getElementsByName('fee_head[]');
		var chkfees = document.getElementsByName('chkfee_details[]');
		var msg_fee = document.getElementsByName('msg_fee[]');
		var due_date= document.getElementById('due_date');
		var total=0;
		
		if(due_date.value=='')
		{
			msg_due_date.innerHTML	=	"Please enter due date";
			fees[i].focus();
			document.getElementById("btn_save").disabled = true;	
				
		}
		else
		{
			msg_due_date.innerHTML	=	"";
			document.getElementById("btn_save").disabled = false;
		}
		for (var i = 0;  i < fees.length; i++)
		{
			if(!/^[0-9]+$/.test(fees[i].value)){								// Used to check if positive number
				msg_fee[i].innerHTML	=	"Please enter +ve numbers only";
				fees[i].focus();
				document.getElementById("btn_save").disabled = true;
				break;															// Break is used to exit from loop if -ve number.So the button is disabled. If break is not used 
			}																	// button will be enabled.	
			else
			{
				msg_fee[i].innerHTML	=	"";
				document.getElementById("btn_save").disabled = false;
			}
		total = total+Number(fees[i].value);
		}   
		document.getElementById('total').value=total;
}
</script>

<script type="text/javascript">
	function check_balance()
	{
	
		var head_name 		= 	document.getElementsByName('head_name[]');
		var fee_balance 	= 	document.getElementsByName('fee_balance[]');
		var fee_head 		= 	document.getElementsByName('fee_head[]');
		var fee_head1 		= 	document.getElementsByName('fee_head1[]');
		var fee_paid		=	document.getElementsByName('fee_paid[]');
		var fee_total1		=	document.getElementsByName('fee_total1[]');
		var msg_fee 		= 	document.getElementsByName('msg_fee[]');
		
		for (var i = 0; i<fee_head.length;i++)
		{
			balance			=	parseInt(fee_balance[i].value);
			head			=	parseInt(fee_head[i].value);
			head_original	=	parseInt(fee_head1[i].value);
			fee_paid1		=	parseFloat(fee_paid[i].innerHTML);
			fee_total		=	parseFloat(fee_total1[i].value);
			name			=	head_name[i].value;
			var new_total	=	(fee_paid1-head_original)+head;
			
			if(new_total>fee_total)
			{
				msg_fee[i].innerHTML	=	"Total "+name+" of all installents exceeds the total("+fee_total+")"; 
				document.getElementById("btn_save").disabled = true;
				break;
			}
			else
			{
				msg_fee[i].innerHTML	=	"";
				document.getElementById("btn_save").disabled = false;
			}
		}
	}
</script>


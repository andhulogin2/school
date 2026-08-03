<div class="row" style="padding-top:20px;">
	<div class="col-md-12">
		<?php
        echo form_open('FeeManagement/update_specialfee_receipt');
        ?>
    	<div class="table-responsive">
            
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                
				<?php   
				$no=1;             
					if(count($results>0))
					{
                ?>
                <tr>
                    <td colspan="2" align="center">
                        <table border="1"  id = "<?php echo $no;?>"  width="70%" >
                            <tr>
                                <td class="table-header" >SNo.</td>
                                <td class="table-header" >Fee Head</td>
                                <td class="table-header" >Paid In This Receipt</td>
                            </tr>
							<?php
                            $i=1;
                foreach($results as $data){
                            {
							?>
                         <input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>" >
                        <input type="hidden" name="fee_collection_master_id[]" value="<?php echo $data['special_fee_collection_master_id']; ?>" >
                        <input type="hidden" name="student_fee_master_id[]" value="<?php echo $data['fee_head_id']; ?>" >
           
                            <TR>
                                <td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $i;?></td> 
                                <td style="padding-left:20px;padding-right:20px;" width="30%">
									<?php echo $this->db->get_where('tbl_fee_heads',array('fee_head_id'=>$data['fee_head_id']))->row()->fee_head; ?>
                                    <input type="hidden" name="special_fee_collection_master_id[]" value="<?php echo $data['special_fee_collection_master_id']; ?>" >
                                    <input type="hidden" name="fee_head_id[]" value="<?php echo $data['fee_head_id']; ?>" >
                                </td> 
                                <td style="padding-left:20px;padding-right:20px;" width="30%">
									<input type="text" name="amount[]" class="form-control"  id="amount" value="<?php echo $data['fee_amount'] ;?>" />
									
                                </td>
							</TR>
							<?php $i=$i+1; } ?>
           
            			</table>
                    </td>
                </tr>
				<?php 
				$no++;
					}
				} 
				?>
        	</table>   
            
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="text-align:right">Edit Receipt Number <font color="#FF0000">* </font></label>
            <div class="col-sm-9">
                <input type="text" name="edit_receipt_number" id="edit_receipt_number" value="<?php echo $receipt_number; ?>" class="col-md-5" onchange="return check_receipt_num();" required/>
                <input type="hidden" name="actual_receipt_number" id="actual_receipt_number" value="<?php echo $receipt_number; ?>" class="col-md-5" />
            </div> 
        </div>
         
        <div align="center" style="padding-top:30px;">
            <input type="button" name="btnDelete" id="btnDelete" value="Delete" class="btn btn-danger" onclick="return deleteConfirm(<?php echo $receipt_number; ?>)" >
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Update" class="btn btn-info" onclick="return check_receipt_num()" >
        </div>  
        <?php
        echo form_close();
        ?>  
    </div>
</div>

<script type="text/javascript">
	function deleteConfirm(receipt_number)
	{
		if(confirm("You can not retrieve the deleted receipt information. Do you really want to delete this receipt?"))
		{
			//var receipt_number	=	$('#receipt_number').val();
			$.ajax({
				url: '<?php echo base_url();?>index.php/feeManagement/delete_specialfee_receipt/' + receipt_number ,
				success: function(response)
				{
					location.reload();
				}
			});
		}
		else
		{
			return false;
		}
	}
	function ShowHide(body_id)
	{
		var TBody
		TBody = document.getElementById(body_id);
		if(!TBody) return true;
		
		if (TBody.style.display=="none")
		  TBody.style.display=""
		else
		  TBody.style.display="none"
		return true;
	}
	function check_amount(elm,maximum)
	{
		if(parseFloat(elm.value)>parseFloat(maximum))
		{
			elm.value	=	maximum;
		}
	}
	function check_receipt_num()
	{
		var receipt_num			=	$('#edit_receipt_number').val();
		var actual_receipt_num	=	$('#receipt_number').val();
		if(receipt_num!='')
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/check_receipt_num/' + receipt_num +'/'+actual_receipt_num ,
				success: function(response)
				{
					if(response=="1")
					{
						alert('Receipt Number already exist');
						jQuery('#edit_receipt_number').val('');
						//$('#btnSubmit').prop('disabled',true);
						return false;
					}
					
				}
			});
		}
	}
</script> 
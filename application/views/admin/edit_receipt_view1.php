<div class="row" style="padding-top:20px;">
	<div class="col-md-12">
		<?php
        echo form_open('FeeManagement/update_receipt');
        ?>
    	<div class="table-responsive">
            
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                
				<?php   
				$no=1;             
                foreach($results as $data){
					if(count($data['fee_collection_details'])>0)
					{
                ?>
                <tr>
                    <th style="text-align: left;" colspan="2" > 
						<?php echo $data['fee_payment_options_details'];?>
                        <input type="hidden" name="student_id" value="<?php echo $data['admission_number']; ?>" >
                        <input type="hidden" name="fee_collection_master_id[]" value="<?php echo $data['fee_collection_master_id']; ?>" >
                        <input type="hidden" name="student_fee_master_id[]" value="<?php echo $data['student_fee_master_id']; ?>" >
                    </th>
            	</tr>
                <tr>
                    <td colspan="2" align="center">
                        <table border="1"  id = "<?php echo $no;?>"  width="70%" >
                            <tr>
                                <td class="table-header" >SNo.</td>
                                <td class="table-header" >Fee Head</td>
                                <td class="table-header" >Paid In This Receipt</td>
                                <td class="table-header" >Total Balance</td>
                            </tr>
							<?php
                            $i=1;
                            foreach( $data['fee_collection_details'] as $row)
                            {
							?>
            
                            <TR>
                                <td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $i;?></td> 
                                <td style="padding-left:20px;padding-right:20px;" width="30%">
									<?php echo $row['fee_head'];?>
                                    <input type="hidden" name="<?php echo $data['fee_collection_master_id']; ?>_fee_collection_details_id[]" value="<?php echo $row['fee_collection_details_id']; ?>" >
                                    <input type="hidden" name="<?php echo $data['fee_collection_master_id']; ?>_fee_head_id[]" value="<?php echo $row['fee_head_id']; ?>" >
                                </td> 
                                <td style="padding-left:20px;padding-right:20px;" width="30%">
									<input type="text" name="<?php echo $data['fee_collection_master_id']; ?>_amount[]" class="form-control" onChange="check_amount(this,<?php echo $row['paid_amount']+$row['fee_balance'] ;?>)" id="amount" value="<?php echo $row['paid_amount'] ;?>" />
									
                                </td>
                                <td style="padding-left:20px;padding-right:20px;" width="20%">
									<?php echo $row['fee_balance'];?>
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
            
            
            <?php
			if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
			{
				if(count($transport)>0)
				{
				?>
                <input type="hidden" name="student_id1" value="<?php echo $transport[0]['student_id']; ?>" >
				<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
					<tr>
						<th style="text-align: left;" colspan="2" > 
							<?php echo "Transport Fee Details";?>
						</th>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<table border="1"  width="70%" >
								<tr>
									<td class="table-header" >SNo.</td>
									<td class="table-header" >Installment</td>
									<td class="table-header" >Paid In This Receipt</td>
									<td class="table-header" >Total Balance</td>
								</tr>
								<?php
								$i=1;
								foreach($transport as $row)
								{
								?>
							<input type="hidden" name="bus_fee_collection_master_id[]" value="<?php echo $row['bus_fee_collection_master_id']; ?>" >
							<input type="hidden" name="bus_fee_collection_details_id[]" value="<?php echo $row['bus_fee_collection_details_id']; ?>" >
							<input type="hidden" name="students_bus_fee_master_id[]" value="<?php echo $row['students_bus_fee_master_id']; ?>" >
				
								<TR>
									<td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $i;?></td>
									<td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $row['installment_name'];?></td>
									<td style="padding-left:20px;padding-right:20px;" width="30%">
										<input type="text" name="bus_fee_amount[]" class="form-control" id="bus_fee_amount" value="<?php echo $row['fee_amount'];?>" />
									</td>
									<td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $row['fee_balance'];?></td>
								</TR>
								<?php 
								$i=$i+1; 
								} 
								?>
			   
							</table>
						</td>
					</tr>
				</table>
				<?php
				}
			}
			?>
            <!-- Opening Balance start -->
            <?php
            foreach($opening_balance as $op):
                ?>
                <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                    <tr>
                        <th style="text-align: left;" colspan="2" > 
                            <?php echo "Opening Balance: ".$op->fee_from_year;?>
                                    
                        </th>
                    </tr>
                    <tr>
                    <td colspan="2" align="center">
                        <table border="1"  id = "<?php echo $no;?>"  width="70%" >
                            <tr>
                                <td class="table-header" >SNo.</td>
                                <td class="table-header" >Fee Head</td>
                                <td class="table-header" >Paid In This Receipt</td>
                                <td class="table-header" >Total Balance</td>
                            </tr>
                            <?php 
                            $i=1;
                            foreach($op->data as $dat):
                                ?>
                                <tr>
                                    <td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $i;?></td>
                                    <td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $dat->fee_head;?></td>
                                    <td style="padding-left:20px;padding-right:20px;" width="30%">
                                        <input type="text" name="op_bal_fee_amount[]" class="form-control" id="op_bal_fee_amount" value="<?php echo $dat->amount_paid;?>" onchange="check_amount1(this,<?php echo $dat->amount_paid;?>,<?php echo $dat->fee_balance;?>)" />
                                            <input type="hidden" name="op_bal_fee_actual_amount[]" class="form-control" id="op_bal_fee_actual_amount" value="<?php echo $dat->amount_paid;?>" />
                                    </td>
                                    <td style="padding-left:20px;padding-right:20px;" width="20%"><?php echo $dat->fee_balance;?></td>
                                    <input type="hidden" name="fee_collection_id[]" value="<?php echo $dat->fee_collection_id ?>" >
                                    <input type="hidden" name="opening_balance_id[]" value="<?php echo $dat->opening_balance_id ?>" >
                                    <input type="hidden" name="fee_head_id[]" value="<?php echo $dat->fee_head_id ?>" >
                                    <input type="hidden" name="fee_balance[]" value="<?php echo $dat->fee_balance ?>" >
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </table>    
                </table>    
            
                <?php
            endforeach;
            ?>
                
            <!-- Opening Balance end -->    
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
				url: '<?php echo base_url();?>index.php/feeManagement/delete_receipt/' + receipt_number ,
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
        function check_amount1(elm,amount_paid,fee_balance)
        {
            var total   =   parseFloat(amount_paid)+parseFloat(fee_balance);
            if(parseFloat(elm.value)>total)
            {
                elm.value	=   total;
            }
            if(elm.value==0)
            {
                alert("Enter Amount greater than 0");
                elm.value       =   parseFloat(amount_paid);
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
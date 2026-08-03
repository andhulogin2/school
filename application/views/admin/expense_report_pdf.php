<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
<div style="text-align:center;padding-bottom:20px;"><h3>Expense Report <br> </h3></div>

<table id="simple-table" width="100%" class="table table-striped table-bordered table-hover"  style="border:1px solid black;border-collapse: collapse;">
				<thead>
                        <tr>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Sl No.</th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Date</th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Voucher Number</th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Account Head </th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Credit Amount</th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Debit Amount</th>
                            <th class="table-header" style="border:1px solid black;border-collapse: collapse;width:10%">Narration</th>
                            
                        </tr>
                </thead>
             
             <tbody>
					   <?php $count = 1;
                        $credit_total=0;
                        $debit_total=0;
                      foreach($account as $acc):?>
                        <tr>
                            <td style='border:1px solid black;'><center><?php echo $count++;?></center></td>
                            <td style='border:1px solid black;'><center><?php echo date('d-m-Y',strtotime($acc['day_book_date']));?></center></td>
                            <td style='border:1px solid black;'><center><?php echo $acc['voucher_number'];?></center></td>
                            <td style='border:1px solid black;'><center><?php echo $acc['account_head_name'];?></center></td>
                             <td style='border:1px solid black;'><center><?php echo $acc['credit_amount'];?></center></td>
                             <td style='border:1px solid black;'><center><?php echo $acc['debit_amount'];?></center></td>
                            <td style='border:1px solid black;'><center><?php echo $acc['narration'];?></center></td>
                        </tr>
							<?php 
                            $credit_total=$credit_total+$acc['credit_amount'];
                            $debit_total=$debit_total+$acc['debit_amount'];
                            endforeach;?>	
                            <tr><th colspan="4" style='border:1px solid black;'>Total</th><td align="center" style='border:1px solid black;'><?php echo $credit_total;?></td><td align="center" style='border:1px solid black;'><?php echo $debit_total;?></td><td></td></tr>
			</tbody>
</table>



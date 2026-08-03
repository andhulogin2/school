<head>
<title>EXPENSE REPORT</title>
</head>
<body>
<div style="text-align:center"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;"><h3><?php echo get_school() ?>
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>

<div style="padding-left:30px;padding-right:30px;padding-top:10px">
<table id="simple-table" class="table table-striped table-bordered table-hover" width="100%" style="border:1px solid;border-collapse:collapse">
  <thead>
    <tr style="text-align:left">
      <th style="border:1px solid;width:20%;height:30px;text-align:left" class="table-header">SI NO</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Expense Date</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Category</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Amount</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Give to</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Remark</th>
    </tr>
  </thead>
  <tbody>
    <?php
			$total=0;
			$i=0;
			if(count($category_exp)>0)
			{
			foreach($category_exp as $row)
			{
			?>
    <tr>
      <td style="border:1px solid;height:30px"><?php echo $i=$i+1; ?></td>
      <td style="border:1px solid"><?php echo date('d-m-Y', strtotime($row['expense_date'])); ?></td>
      <td style="border:1px solid"><?php echo $row['category_name']; ?></td>
      <td style="border:1px solid"><?php echo number_format($row['amount'],2); ?></td>
      <td style="border:1px solid"><?php echo $row['give_to']; ?></td>
      <td style="border:1px solid"><?php echo $row['remark']; ?></td>
      </tr>
      <?php
      $total = $total+$row['amount'];
            } ?>
 			<tr><td colspan='3' style="border:1px solid;text-align:center">Total</td><td style="border:1px solid;"><?php echo number_format($total,2); ?></td><td colspan='2'></td></tr>
       <?php 	}
			else
			{
				echo "<tr><td colspan='7' style='text-align:center;color:red'><b>No results found</b></td></tr>";
			}
			?>
  </tbody>
</table>

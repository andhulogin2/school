<head>
<title>BOOK REPORT</title>
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
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Book Number</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Book Name</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Author Name</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Category</th>
      <th style="border:1px solid;width:20%;text-align:left" class="table-header">Language</th>
    </tr>
  </thead>
  <tbody>
    <?php
			$total=0;
			$i=0;
			if(count($book)>0)
			{
			foreach($book as $row)
			{
			?>
    <tr>
      <td style="border:1px solid;height:30px"><?php echo $i=$i+1; ?></td>
      <td style="border:1px solid"><?php echo $row['book_number']; ?></td>
      <td style="border:1px solid"><?php echo $row['book_name']; ?></td>
      <td style="border:1px solid"><?php echo $row['author_name']; ?></td>
      <td style="border:1px solid"><?php echo $row['book_category_name']; ?></td>
      <td style="border:1px solid"><?php echo $row['book_language_name']; ?></td>
      </tr>
      <?php
            } }
			else
			{
				echo "<tr><td colspan='7' style='text-align:center;color:red'><b>No results found</b></td></tr>";
			}
			?>
  </tbody>
</table>

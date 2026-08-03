<div class="table-header">
   Books
</div>
	
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th>SlNo	</th> 
    <th>Book Number	</th>
    <th>Book Name	</th>
    <th>Category	</th>
     <th>Author	</th>
      <th>Language	</th>
      <th>Status</th>
     
</tr>
</thead>

<tbody>

<?php
$i=1;

foreach($bookdata as $book)
{
?>
<tr>
   <td> <?php echo $i; ?> </td>
   <td id="<?php echo $book['book_master_id']?>"  ><?php echo $book['book_number'];?> </td>
    <td id="<?php echo $book['book_master_id']?>" ><?php echo $book['book_name'];?> </td>
    <td id="<?php echo $book['book_master_id']?>"><?php echo $book['book_category_name'];?> </td>
    <td id="<?php echo $book['book_master_id']?>"><?php echo $book['author_name'];?> </td>
    <td id="<?php echo $book['book_master_id']?>"><?php echo $book['book_language_name'];?> </td>
    
        <td id="<?php echo $book['book_master_id']?>"><?php if($book['is_available']=='Y')
{ ?>
<span class="editable" style="color:#006600" id="status" style="width:500px" > <b> Not Issued </b> </span>
<?php 
}
else { ?>
<span class="editable" style="color:#CC0000" id="status" style="width:500px" > <b>  Issued </b> </span>
<?php } ?> </td>

  
</tr>
<?php
$i=$i+1;
?>
<?php
 } 
?>

</tbody>
</table>
   

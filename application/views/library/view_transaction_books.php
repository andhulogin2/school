<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
BOOK DETAILS
</div>

<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" >
<tr><th style="text-align: left;font:bold;"> SI NO </th> 
<th style="text-align: left;"> Book Name  </th>
<th style="text-align: left;"> Book Number  </th>
<th style="text-align: left;"> Author Name</th>
<th></th>
</tr> 
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>

<?php 
$count = count($book);
if($count>0)
{
$i=1;
foreach($book as $data)
{
?>
<tr>
<td style="text-align: left;"><?php echo $i++;?></td>
<td style="text-align: left;"><?php echo $data['book_name'];?></td>
<td style="text-align: left;"><?php echo $data['book_number'];?></td>
<td style="text-align: left;"><?php echo $data['author_name'] ;?> </td> 
<td style="text-align: left;"><button name="student_id" id="student_id" onclick="get_book_detail(<?php echo $data['book_master_id'];?>); return false; " class="btn btn-info" value="<?php echo $data['book_master_id'];?>">Choose</button>
<input type="text" name="student_id" id="selected_book" value="<?php echo $data['book_master_id'];?>" hidden /> </td>
</tr>
<?php
}}
else
{
?>
<tr>
<td colspan="6" align="center">
<font color="#FF0000"> No Books Available </font></td>
</tr>
<?php
}
?>
</table>

<br />
<div id="book_transaction" >
</div>
<br/></br>	
<br />
</div></div>
</div>
</div>


<script type="text/javascript">	
 function get_book_detail(id){
 document.getElementById("selected_book").value = id;
 var book_id = id;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/book_transaction_detail_ajax/' + book_id ,
		type:"GET",
            success: function(response)
            {
				console.log(response);
                jQuery('#book_transaction').html(response);
            }
   });
}
</script>

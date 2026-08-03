<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
STUDENT BOOK DETAILS
</div>

<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" >
<tr><th style="text-align: left;font:bold;"> Book Number</th> 
<th style="text-align: left;"> Book Name  </th> 
<th style="text-align: left;"> Issued Date </th>
<th style="text-align: left;"> Return Date </th>
</tr> 

<?php 
$count = count($student);
if($count>0)
{
foreach($student as $data)
{
?>
<tr>
<td style="text-align: left;"><?php echo $data['book_number'];?></td>
<td style="text-align: left;"><?php echo $data['book_name'];?></td>
<td style="text-align: left;"><?php echo $data['issued_date'] ;?> </td> 
<td style="text-align: left;"><?php if($data['return_date']=='1970-01-01'){ echo "-"; }else{ echo $data['return_date'];} ?> </td>
</tr>
<?php
}
}
else
{
?>
<tr>
<td colspan="4" align="center">
<font color="#FF0000"> No books issued </font></td>
</tr>
<?php

}
?>
</table>

<input type="text" name="book_count" id="book_count" value="<?php echo $count; ?>" hidden />
    <div style="text-align:center">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Search Books:</label>
        <div class="col-sm-3">
            <input type="text" required id="book_id" name="book_id" data-placeholder="Choose an id..." class="form-control"   />
&nbsp;&nbsp;<button onclick="get_book_details(); return false;" class="btn btn-info">Search</button>
	</div>
    </div>
    
    <br /><br /><br />
<div id="book1" >
</div>
<br/></br>	
<br />
<center>
<input type="submit" class="btn btn-info" value="Issue Book" id="submit_button" disabled="disabled">
</center>
</div></div>
</div>
</div>

<script type="text/javascript">	
 function get_book_details(book_id){
 var book_id = document.getElementById("book_id").value;
 var book_count = document.getElementById("book_count").value;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_book_details_ajax/' + book_id +'/'+ book_count ,
            success: function(response)
            {
				console.log(response);
                jQuery('#book1').html(response);
            }
   });
}
</script>

<script type="text/javascript">
$(document).ready(function () {
$('.mydatepicker').datepicker({
autoclose: true,
todayHighlight: true,
dateFormat: 'dd/mm/yy'
})
});
</script>
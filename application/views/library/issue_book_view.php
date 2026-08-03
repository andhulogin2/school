<?php echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<input type="hidden" name="student_id" id="student_id"  value="<?php echo $student_id;?>">
<input type="hidden" name="book_details_id" id="book_details_id"  value="<?php echo $book_details_id;?>">
<br/>
<br/>
<?php foreach($student as $data)
{
?>
<font size="3">
<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" > 
<tr><td style="text-align: left;"> Student Id  </td> <td style="text-align: left;"><?php echo $data['student_id'];?></td></tr>
<tr><td style="text-align: left;"> Name        </td> <td style="text-align: left;"><?php echo $data['name'] ;?> </td> </tr>
</table>
</div>
</font>
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>
<?php } ?>

<center>
<button type="submit" class="btn btn-info" id="submit_button">
<b>Issue Book</b>
</button>

</center>
</div>
</div>
</div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function () {
$('.mydatepicker').datepicker({
autoclose: true,
todayHighlight: true,
dateFormat: 'dd/mm/yy'
})
});
</script>
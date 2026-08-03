<br />
<?php
if(count($student)>0)
{
	?>
	<input type="checkbox" name="check_all" id="check_all"  />&nbsp;<b>Check/Uncheck All</b><br /><br />
	<?php
	foreach ($student as $row) 
	{
		?>
		
		<input type="checkbox" name="student_id[]" class="student_id" id="student_id" value="<?php echo $row['student_id']; ?>" />&nbsp;<?php echo $row['name']; ?><br />
		<?php
	}
}
?>
<script>
	$('#check_all').on('click',function(){
        if(this.checked){
            $('.student_id').each(function(){
                this.checked = true;
            });
        }else{
             $('.student_id').each(function(){
                this.checked = false;
            });
        }
    });
	$('.student_id').on('click',function(){
        if($('.student_id:checked').length == $('.student_id').length){
            $('#check_all').prop('checked',true);
        }else{
            $('#check_all').prop('checked',false);
        }
    });
 </script>
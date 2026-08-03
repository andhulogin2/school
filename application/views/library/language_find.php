
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"></label>
<div class="col-sm-9">

<?php 
$this->db->where('book_language_name',$book_language_id);
$result1=$this->db->get('tbl_lib_book_language');
if($result1->num_rows()>0)
{
?> <font color="#FF0000">
<?php echo "Data Already Exists";?></font><?php 
}
else
{
?><font color="green"><?php echo "Click Save to Add Data";?></font>
<br/><br/><br/>
<div class="col-md-offset-4 col-md-9">
<input type="submit" class="btn btn-info" id="submit" value='Save'> 
</div>
<?php 
}
?>
</div>
</div>

		<script type="text/javascript">	
		function get_data(){
		jQuery('#absent1').html("");
		var language = $('#language_name').val();
		$.ajax({
		url: '<?php echo base_url();?>index.php/Library/get_data1/' +language,
		success: function(response)
		{
		console.log(response);
		jQuery('#absent1').html(response);
		}
		});
		}
		</script>


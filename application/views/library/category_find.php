
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"></label>
<div class="col-sm-9">

<?php 
$this->db->where('book_category_name',$book_category_id);
$result=$this->db->get('tbl_lib_book_category');
if($result->num_rows()>0)
{
?> 
<font color="#FF0000"><?php echo "Data Already Exists";?></font>
<?php 
}
else
{
?>
<font color="green"><?php echo "Click Save to Add Data";?></font>
<br/><br/><br/>

<div class="col-md-offset-4 col-md-9">
<input type="submit" class="btn btn-info" id="submit"  value="Save"> 
</div>
<?php 
}
?>
</div>
</div>

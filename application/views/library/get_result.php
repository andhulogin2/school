<div class="col-md-2">
<div class="form-group">
<label class="control-label" style="margin-bottom: 5px;">Search:</label>

<select name="results_id" id="results_id" class="form-control selectboxit">
<option value="">Select</option>
<?php 
$data_book = $this->db->get_where('tbl_lib_book_stream' , array('category_id' => $category_id, 'is_deleted'=>'N' ))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['book_stream_id'];?>"><?php echo $row_book['book_stream_name'];?></option>
<?php endforeach;?>


<?php 
$data_book = $this->db->get_where('tbl_lib_distributors' , array('category_id' => $category_id, 'is_deleted'=>'N' ))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['distributor_id'];?>"><?php echo $row_book['distributor_name'];?></option>
<?php endforeach;?>


<?php 
$data_book = $this->db->get_where('tbl_lib_publishers' , array('category_id' => $category_id, 'is_deleted'=>'N'))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['publisher_id'];?>"><?php echo $row_book['publisher_name'];?></option>
<?php endforeach;?>
	
	<?php 
$data_book = $this->db->get_where('tbl_lib_book_category' , array('category_id' => $category_id))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['book_category_id'];?>"><?php echo $row_book['book_category_name'];?></option>
<?php endforeach;?>
	
	<?php 
$data_book = $this->db->get_where('tbl_lib_book_language' , array('category_id' => $category_id ))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['book_language_id'];?>"><?php echo $row_book['book_language_name'];?></option>
<?php endforeach;?>
	
	<?php 
$data_book = $this->db->get_where('tbl_lib_authors' , array('category_id' => $category_id ))->result_array();
foreach($data_book as $row_book):

?>
<option value="<?php echo $row_book['author_id'];?>"><?php echo $row_book['author_name'];?></option>
<?php endforeach;?>

</select>
</div>
</div>

<script type="text/javascript">
$(document).ready(function ()
{
if ($.isFunction($.fn.selectBoxIt))
{
$("select.selectboxit").each(function (i, el)
{
var $this = $(el),
opts = {
showFirstOption: attrDefault($this, 'first-option', true),
'native': attrDefault($this, 'native', false),
defaultText: attrDefault($this, 'text', ''),
};
$this.addClass('visible');
$this.selectBoxIt(opts);
});
}
});
</script>

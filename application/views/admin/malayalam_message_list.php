<?php //echo form_open(base_url() . 'index.php/admin/special_message/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<div style="border: 0.5px solid #CCCCCC;padding:10px;">
	<table>
	 <input type="hidden" name="class" id="class"  class="name" value="<?php echo $class ?>">
	 <input type="hidden" name="section" id="section"  class="name" value="<?php echo $section ?>">
	 
	
		<?php
		if(count($student) > 0){
		?>
			<tr><td>  
				<input type="checkbox" name="selectall" id="selectall" onChange="select_deselcet_all()" /> <b>Check / Uncheck</b></span>
			</td></tr>
		<?php
			foreach($student as $stud){
			?>
			<tr><td>
			<input type="checkbox" name="student[]" id="student[]"  class="name" value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>
			</td></tr>
			<?php 
			} 
		}	
		else{
			echo "No data found!!";
		}
		?>
	</table>
</div>   
<?php echo form_close(); ?>
<script type="text/javascript">

function select_deselcet_all()
{
var check = document.getElementById('selectall');
var students = document.getElementsByName('student[]');
 for(var i =0; i< students.length;i++)
        students[i].checked=check.checked;

}
</script>
<script type="text/javascript">
    function get_template_content1(id)
  {
  
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_template_content1/' + id ,
            success: function(response)
            {
                jQuery('#message1').html(response);
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
</script>
    
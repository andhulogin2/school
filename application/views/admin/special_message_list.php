<?php //echo form_open(base_url() . 'index.php/admin/special_message/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<br /><br /><br />
<table>
<tr><td>  
<div class="form-group"> 
   <label class="col-md-12"><b>Check / Uncheck</b></span> <input type="checkbox" name="selectall" id="selectall" onChange="select_deselcet_all()" />
</label>
 </div>
 <input type="hidden" name="class" id="class"  class="name" value="<?php echo $class ?>">
  <input type="hidden" name="section" id="section"  class="name" value="<?php echo $section ?>">
 
</td></tr>

<?php

foreach($student as $stud){
?>
<tr><td>
<input type="checkbox" name="student[]" id="student[]"  class="name" value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>
</td></tr>
<?php } ?>
</table>
 <div class="col-md-10">
          <div class="form-group">
						<label for="field-2" class="control-label">SMS Template</label>
						<div >
							<select name="template" class="form-control"  onchange="return get_template_content1(this.value)">
                              <option value="">Select</option>
                              <?php $template = $this->db->get('sms_template')->result_array();
								foreach($template as $row){ 
		                        if($row['title']!= 'admission' && $row['title']!='attendance' && $row['title']!='birthday'){?>
	
								
							
                            		<option value="<?php echo $row['id'];?>">
									<?php echo $row['title'];}}?>
                                    </option>
                               
                          </select>
                          
						</div> 
					</div> 
           </div>


  <div class="compose-message-editor" style="padding-left:10px; padding-right:50px">
                <textarea class=" form-control" name="message1" id="message1" rows="10"  placeholder="Write-Message..." required></textarea>
    </div>

<?php 
if(count($student) > 0){
?>
    <button type="submit" class="btn btn-success btn-icon pull-right" >
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
<?php }else{
	echo "No data found!!";
} ?>
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
    
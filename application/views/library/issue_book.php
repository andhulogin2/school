<?php include_once APPPATH . 'views/library_head.php';?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />



<div class="main-content col-md-10">
    <div class="main-content-inner">

    
    
    
        <div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>							
                </li>
                <li class="active">Books</li>
                <li class="active">Issue Book</li>
            </ul>
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>View<small> <i class="ace-icon fa fa-angle-double-right"></i>Books</small> </h1>
            </div>

            <?php
            $profile_info = $this->db->get_where('view_lib_book_details' , array('book_details_id' => $book_details_id))->result_array();
            foreach($profile_info as $data){
            ?>

            <h1>

                <div style="text-align:center">
                    <b> <?php echo $data['book_name'];?> </b> 
                </div>
 
            </h1>

            <font size="3"> 
            <div style="text-align:center">

                <table id="simple-table" class="table table-striped table-hover table-bordered" > 
                    <tr><td style="text-align: left;width:50%"> &nbsp;Book Number  </td> <td style="text-align: left;width:50%"> <?php echo $data['book_number'];?>  	   </td></tr>
                    <tr><td style="text-align: left;width:50%"> &nbsp;Author Name  </td> <td style="text-align: left;width:50%"> <?php echo $data['author_name'] ;?>  	   </td></tr>
                    <tr><td style="text-align: left;width:50%"> &nbsp;Category	  </td> <td style="text-align: left;width:50%"> <?php echo $data['book_category_name'];?> </td></tr>
                    <tr><td style="text-align: left;width:50%"> &nbsp;Language	  </td> <td style="text-align: left;width:50%"> <?php echo $data['book_language_name'];?> </td></tr>
                    <tr><td style="text-align: left;width:50%"> &nbsp;Stream	      </td> <td style="text-align: left;width:50%"> <?php echo $data['book_stream_name'];?>   </td></tr>
                </table>
            </div>
            </font>
            <?php
            } 
            ?> 
        </div>
    </div>

    <h2>

        <div style="text-align:center">
            <b> &nbsp;ISSUE DETAILS</b> 
        </div>
 
    </h2>
    <div style="text-align:center">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Member Category: </label>
        <div class="col-sm-3">
            <select class="form-control selectboxit" name="member_type">
                <option value="">Select a Member</option>            
                <option value="1"> Student</option>            
            </select>
        </div>
    </div>
</div>
<br/></br>	

<div style="text-align:center">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Member ID: </label>
        <div class="col-sm-3">
            <select id="member_id" name="member_id" data-placeholder="Choose an id..." style="width:300px;" onChange="get_details()">
                <option value=""></option>
                    <?php
                    $details = $this->db->get('student');
                    if ($details->num_rows() > 0):
                    $detail = $details->result_array();
                    foreach($detail as $row):                        
                    ?>   
                <option value="<?php echo $row['student_id'];?> "> <?php echo $row['name'];?>  </option>
                <?php endforeach;?>
                <?php endif; ?>
            </select>
            <input type="hidden" name="details_id" id="details_id"  value="<?php echo $data['book_details_id'];?>">
            &nbsp;&nbsp;
        </div>
    </div>
</div>

<div id="student1" >     
</div>

</div>
</div>
    
    
    
    
    
    
    </div>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>       


<script type="text/javascript">
		$(document).ready(function() 
		{
			$("#member_id").select2({
				  });
		});		
</script>
<script type="text/javascript">	
 function get_details(){
	 jQuery('#student1').html("");
        var student_id = $('#member_id').val();
		var book_details_id = $('#details_id').val();
		if(student_id == "0" ){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_student_details/' +book_details_id +'/' + student_id ,
            success: function(response)
            {
				console.log(response);
                jQuery('#student1').html(response);
            }
   });
}
</script>

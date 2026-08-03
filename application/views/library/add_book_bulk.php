<?php  include_once APPPATH . 'views/library_head.php';  ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<div class="main-content col-md-8">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
							<script type="text/javascript">
                                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                            </script>

                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="ace-icon fa fa-home home-icon"></i>
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="active">Add Book Bulk</li>
                                    </ul><!-- /.breadcrumb -->

									<!-- #section:basics/content.searchbox -->
                                    <div class="nav-search" id="nav-search">
                                        <form class="form-search">
                                            <span class="input-icon">
                                                
                                            </span>
                                        </form>
                                    </div><!-- /.nav-search -->
					</div>
						<!-- /section:basics/content.searchbox -->
					
					<!-- /section:basics/content.breadcrumbs -->
                                <div class="page-content">
                                    
                                     <div class="page-header">
                                        <h1>
                                            Book Bulk
                                        
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                 Add New Books
                                            
                                        </h1>
                                    </div>
                                 </div>
                        <?php echo form_open(base_url() . 'index.php/Library/book_bulk1/add_bulk_book' , array('class' => 'form-inline validate','method' => 'POST'));?>
	<div class="row bg-title">

    
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>
 <div class="col-md-10">
<div id="bulk_add_form">
<div id="book_entry">
	<div class="row" style="margin-bottom:10px;">

		<div class="form-group">
			<input type="text" name="book_name[]" id="book_name" class="form-control" style=" margin-left: 5px;" placeholder="Book Name" required>
		</div>

		<div class="form-group">
			<input type="text" name="book_number[]" id="book_number" class="form-control" style=" margin-left: 5px;" placeholder="Book Number" required>
		</div>

		<div class="form-group">
			<input type="text" name="isbn[]" id="isbn" class="form-control"  style=" margin-left: 5px;" placeholder="ISBN" >
		</div>

		
		<div class="form-group">
			<button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
					onclick="deleteParentElement(this)" style="margin-left: 10px;">
        		<i class="fa fa-trash-o" style="color: #fff;"></i>
        	</button>
		</div>

 <div id="check_phone_number" align="left"></div> 			
	</div>

</div>


		<div id="book_entry_append"></div>
        <br>
        
        <div class="row">
            <center>
                <button type="button" class="btn btn-info" onclick="append_book_entry()">
                   New Row
                </button>
            </center>
        </div>

        <br><br>
        <div class="row">
            <center>
                <input type="submit" class="btn btn-success" id="submit_button" name="submit_button" value="Save">
            </center>
        </div>
     
<?php echo form_close();?> 
<div class="hr hr32 hr-dotted"></div>
<div></div>
</div> <div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<script type="text/javascript">
	var blank_book_entry ='';
	$(document).ready(function() {
		blank_book_entry = $('#book_entry').html();

		for ($i = 0; $i<4;$i++) {
			$("#book_entry").append(blank_book_entry);
		}
		
	});

	function append_book_entry()
	{
	//alert("xzfd");
		$("#book_entry_append").append(blank_book_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.success('". "Failed to add...', 'Failed', {timeOut: 5000})</script>";
}

?>


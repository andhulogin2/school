<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<body>
        
        	<div class="main-content col-md-10">  
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
							<li class="active">Gallery</li>
						</ul><!-- /.breadcrumb -->


						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
                            
                        <div class="page-header">
							<h1>
								Gallery
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
										View Images 
								</small>
							</h1>
                           
                            
						</div>     
                        <div style="text-align:right"><a href="<?php echo base_url().'index.php/admin/gallery'; ?>">Back</a></div>
                        <div class="panel panel-primary">
                        	<div class="panel-body">	
                                <div class="row">
                                    <div class="col-md-12" style="text-align:center;padding:10px;">
                                        <div class="col-md-12" style="padding-bottom:10px;">
                                            <div class="col-md-offset-2 col-md-3" style="text-align:left">
                                                Title<font color="#FF0000">*</font>
                                            </div>
                                            <div class="col-md-3" style="text-align:left">
                                                <input type="hidden" name="gallery_master_id" id="gallery_master_id" class="form-control" value="<?php echo $result['master']->id; ?>" required>
                                                <input type="text" name="title" id="title" class="form-control" value="<?php echo $result['master']->title; ?>" readonly required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="padding-bottom:10px;">
                                            <div class="col-md-offset-2 col-md-3" style="text-align:left">
                                                Description 
                                            </div>
                                            <div class="col-md-3" style="text-align:left">
                                                <textarea name="description" id="description" class="form-control" readonly><?php echo $result['master']->description; ?></textarea>
                                            </div>
                                        </div>	                                    
                                        
                                        <div class="col-md-offset-4 col-md-2" style="padding:10px;">
                                            <button type="button" class="btn btn-info" name="submit_btn" id="submit_btn" onClick="edit_save()">Edit</button>
                                        </div>
                                    </div>
                                </div>
                        	</div>        
                        </div>
	
    					
                        <div class="row">
                            <div class="col-md-12" style="padding:10px;">
                            
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="text-align:center;font-size:18px">Photos</div>
                                    <div class="panel-body">
                                    
                                  <!-- Add more photos section start -->
                                  		<div class="row">
                                            <div class="col-md-12" style="text-align:center;padding:5px;">
                                                <button type="button" class="btn btn-success btn-sm" id="add_more_photos">
                                                    <i class="fa fa-plus"></i> Add More Photos
                                                </button>
                                            </div>
                                            <form id="upload_img" action="" method="post" enctype="multipart/form-data">
                                                <div class="col-md-12" id="add_more_photos_div" style="display:none;text-align:center;border:1px solid #CCCCCC;padding-top:5px;padding-bottom:5px;">
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-6">
                                                        <input type="file" name="images" id="images" required><br>
                                                        
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-12" style="text-align:center">
                                                    	<textarea id="description1" placeholder="Description"></textarea>
                                                    </div>
                                                    <div class="col-md-12" style="text-align:center">
                                                    	<input type="button" class="btn btn-info btn-md" value="Add" onClick="add_photo()" >
                                                    </div>
                                                </div>
                                            </form>
                                     	</div>       
                                <!-- Add more photos section end -->       
                                        <div id="loading" style="display:none;text-align:center;">
                                            <img src="<?php echo base_url() . 'assets/images/ajax-loader2.gif'; ?>" alt="Loading..." style="width:100px;height:100px;"> 
                                        </div>
                                        <div class="row" id="search_results">
                                            <?php
                                            if(count($result['details'])>0)
                                            {
                                                foreach($result['details'] as $row):
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="thumbnail">
                                                        <input type="hidden" name="url" id="url" value="<?php echo $row['url']; ?>" >
                                                        <a href="<?php echo base_url().$row['url']; ?>" style="text-decoration:none" class="image_viewer" title="<?php echo $row['details_description']; ?>">
                                                            <img src="<?php echo base_url().$row['url']; ?>" alt="Lights" style="width:100%">
                                                            <div class="caption">
                                                               <!-- <p style="font-size:14px;">
                                                                	<b><?php 
																			echo $row['details_description']; 
																			if($row['details_description']=='')
																			{
																			?>
                                                                            <span style="color:#CCCCCC">No Description</span>
                                                                            <?php
																			}
																		?></b>
                                                                </p>-->
																</a>
                                                                <input type="text" id="image_description_<?php echo $row['gallery_details_id']; ?>" readonly value="<?php echo $row['details_description']; ?>" class="form-control" <?php if($row['details_description']==''){ echo "placeholder='No Description'"; } ?>>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12" style="text-align:right;padding-top:2px;">
                                                                        <span class="btn btn-info" id="edit_btn_<?php echo $row['gallery_details_id']; ?>" onClick="edit_save_image_description(<?php echo $row['gallery_details_id']; ?>)" style="text-align:center;padding:0px;border-radius:50px;" title="Delete">
                                                                            Edit
                                                                        </span>
                                                                        <span class="btn btn-danger" id="del_btn" onClick="delete_album_image(<?php echo $row['gallery_details_id']; ?>)" style="text-align:center;padding:0px;border-radius:50px;" title="Delete">
                                                                            <i class="fa fa-trash"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>	
                                                            </div>
                                                        
                                                        
                                                    </div>
                                                </div> 
                                                <?php
                                                endforeach;
                                            }
                                            else
                                            {
                                            ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger alert-dismissible" style="font-size:12px;text-align:center">
                                                        <strong>No data found...</strong>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>                
                                    </div>
                                </div>
                            </div>
                        </div>      
							

					</div>
				</div>
			</div> 
            
			



		



<?php include_once APPPATH . 'views/footer.php'; ?>
<!--Jquery image viewer plugin-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/viewbox.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.viewbox.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script type="text/javascript">

//Jquery image viewer
$(function(){
	$('.image_viewer').viewbox({
		// template
		setTitle: true,
		margin: 20,
		resizeDuration: 300,
		openDuration: 200,
		closeDuration: 200,
		closeButton: true,
		navButtons: false,
		closeOnSideClick: true,
		nextOnContentClick: false,
		useGestures: true
	});

//Add more photo button start
	$("#add_more_photos").click(function(){
		$("#add_more_photos_div").toggle();
	});
//Add more photo button end
});

//Edit/Save image description start
	function edit_save_image_description(gallery_details_id)
	{ 
		if($('#edit_btn_'+gallery_details_id).html().trim()=='Edit')
		{
			$("#image_description_"+gallery_details_id).attr("readonly", false); 	
			$("#image_description_"+gallery_details_id).focus();	
			$('#edit_btn_'+gallery_details_id).html('Save');
		}	
		else if($('#edit_btn_'+gallery_details_id).html().trim()=='Save')	
		{
			var description			=	$("#image_description_"+gallery_details_id).val();
			
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/gallery_details_update' ,
				type: "POST",
				data: {gallery_details_id:gallery_details_id,description:description},
				success: function(response)
				{
					if(response.trim()=='details_update_success')
					{
						toastr.success('Updated Successfully...', 'Updated', {timeOut: 5000});
						$("#image_description_"+gallery_details_id).attr("readonly", true);
						$('#edit_btn_'+gallery_details_id).html('Edit'); 
					}
					else if(response.trim()=='details_update_failed')
					{
						toastr.error('Updation Failed...', 'Failed', {timeOut: 5000});
						$("#image_description_"+gallery_details_id).attr("readonly", true);
						$('#edit_btn_'+gallery_details_id).html('Edit'); 
					}
				}
			});
		}
	}
//Edit/Save image description end

//Ajax function to add photos start
	function add_photo()
	{
		$("#add_more_photos_div").toggle();
		//alert(document.getElementById("images").files[0]);
		var form 		= 	new FormData(document.getElementById('upload_img'));
		var file 		= 	document.getElementById('images').files[0];
		var description	= 	document.getElementById('description1').value;
			if (file) {   
				form.append('images', file);
				form.append('description', description);
			}
		var gallery_master_id	=	$("#gallery_master_id").val();
		$.ajax({
			url: '<?php echo base_url();?>index.php/admin/add_more_photos/'+gallery_master_id ,
			type: "POST",
			data: form,
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function() {
				$('#loading').css('display', 'block');
				$('#search_results').html('');
			},
			success: function(response)
			{
				$('#loading').css('display', 'none');
				$('#search_results').html(response);
				$("#msg_div").show();
				$("#msg_div").delay(6000).hide(1000);
				document.getElementById('description1').value	=	'';
			}
		});
	} 
//Ajax function to add photos end

//Edit/Save album title and description start
	function edit_save()
	{
		if($('#submit_btn').html()=='Edit')
		{
			$("#title").attr("readonly", false); 	
			$("#description").attr("readonly", false); 
			$("#title").focus();	
			$('#submit_btn').html('Save');
		}	
		else if($('#submit_btn').html()=='Save')	
		{
			var title				=	$("#title").val();
			var description			=	$("#description").val();
			var gallery_master_id	=	$("#gallery_master_id").val();
			if(title=='')
			{
				alert("Please enter title");
				return false;
			}
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/gallery_master_update' ,
				type: "POST",
				data: {gallery_master_id:gallery_master_id,title:title,description:description},
				success: function(response)
				{
					if(response.trim()=='master_update_success')
					{
						toastr.success('Updated Successfully...', 'Updated', {timeOut: 5000});
						$("#title").attr("readonly", true); 	
						$("#description").attr("readonly", true);
						$('#submit_btn').html('Edit'); 
					}
					else if(response.trim()=='master_update_failed')
					{
						toastr.error('Updation Failed...', 'Failed', {timeOut: 5000});
					}
				}
			});
		}
	}
//Edit/Save album title and description end	
//Delete album image start
	function delete_album_image(gallery_details_id)
	{ 
		if(confirm("Do you really want to delete this image?"))
		{
			var url					=	$("#url").val();
			var gallery_master_id	=	$("#gallery_master_id").val();
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/gallery_details_delete' ,
				type: "POST",
				data: {gallery_master_id:gallery_master_id,gallery_details_id:gallery_details_id,url:url},
				beforeSend: function() {
					$('#loading').css('display', 'block');
					$('#search_results').html('');
				},
				success: function(response)
				{
					$('#loading').css('display', 'none');
					$('#search_results').html(response);
					$("#msg_div").show();
					$("#msg_div").delay(6000).hide(1000);
				}
			});
		}
	}
//Delete album image end
</script>
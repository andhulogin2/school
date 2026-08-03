<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
<style type="text/css">
    #preview{
      border: 0.5px solid #E0E0E0;
      padding: 10px;
    }
    #preview img{
      width: 200px;
      padding: 5px;
    }
	.description{
	  width: 193px;	
	}
  </style>
<body>
        
        	<div class="main-content col-md-10" >  
				<div class="main-content-inner" > 
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
                    <div class="page-content" >
                            
                        <div class="page-header">
							<h1>
								Gallery
								<!--<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 
								</small>-->
							</h1>
                           
                            
						</div>     
                        
                        <form action="<?php echo base_url(); ?>index.php/admin/gallery_upload" method="post" name="gallery_upload" enctype="multipart/form-data">
                        
                        	<div class="row" id="error_msg">
                            	<div class="col-md-12">
                                	<?php
                                    if(null!==$this->session->userdata('errors'))
                                    {
										$count	=	count($this->session->userdata('errors'));
										?>
                                    <div class="alert alert-danger alert-dismissible" style="font-size:12px;text-align:center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php if($count>1){ echo "The following files not uploaded.<br>"; }else{ echo "The following file not uploaded.<br>"; } ?>
                                        
                                        <?php
                                        for($i=0;$i<$count;$i++)
                                        {
                                            echo "<strong>".$this->session->userdata('errors')[$i]['file_name']."</strong><br>";
                                        }
										?>
                                        
                                    </div>
                                        
                                    	<?php    
                                    }
									else
									{
										if($this->session->flashdata('action')=='success')
										{
										?>
                                        <div class="alert alert-success alert-dismissible" style="font-size:12px;text-align:center">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Uploaded successfully</strong>
                                        </div>
                                        <?php	
										}
									}
									$this->session->unset_userdata('errors');
                                    ?>
                                </div>
                            </div>
                        
                        	<div class="row">
                            	<div class="col-md-12" style="text-align:center;padding:10px;">
                                	<div class="col-md-12" style="padding-bottom:10px;">
                                        <div class="col-md-offset-2 col-md-3" style="text-align:left">
                                            Title<font color="#FF0000">*</font>
                                        </div>
                                        <div class="col-md-3" style="text-align:left">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                	<div class="col-md-12" style="padding-bottom:10px;">
                                        <div class="col-md-offset-2 col-md-3" style="text-align:left">
                                            Description 
                                        </div>
                                        <div class="col-md-3" style="text-align:left">
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
									</div>	                                    
                                    
                                	<div class="col-md-12" style="padding-bottom:10px;">
                                        <div class="col-md-offset-2 col-md-3" style="text-align:left">
                                            Images<font color="#FF0000">*</font>
                                        </div>
                                        <div class="col-md-3" style="text-align:left">
                                            <input type="file" name="images[]" id="images" multiple="" required>
                                        </div>
									</div>	                                    
                                    
                                    
                                    <div class="col-md-12" id="preview" style="padding:10px;">
                                    	<span style="color:#999999">Image Preview</span>
                                    </div> 
                                    <div class="col-md-offset-4 col-md-2" style="padding:10px;">
                                		<input type="submit" value="Upload" class="btn btn-info" name="image_upload" >
                                    </div>
                                </div>
                            </div>
                        
                        <?php echo form_close();?>


                        	<div class="row">
                            	<div class="col-md-12" style="padding:10px;">
                                
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="text-align:center;font-size:18px">Image Gallery</div>
                                        <div class="panel-body">
                                        
                                            <div class="row">
                                                <div class="col-md-12" style="background-color:#D7ECEB;padding:10px;margin-bottom:10px;">
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" placeholder="Keyword" id="keyword" >
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control mydatepicker" placeholder="Date From" id="date_from" >
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control mydatepicker" placeholder="Date To" id="date_to" >
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" name="search_btn" class="btn btn-success" onClick="gallery_search()">
                                                            <i class="fa fa-search"></i> Search
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="loading" style="display:none;text-align:center;">
                                                <img src="<?php echo base_url() . 'assets/images/ajax-loader2.gif'; ?>" alt="Loading..." style="width:100px;height:100px;"> 
                                            </div>
                                            <div class="row" id="search_results">
                                                <?php
                                                if(count($result)>0)
                                                {
                                                    foreach($result as $row):
                                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="thumbnail">
                                                            
                                                            <a href="<?php echo base_url().'index.php/admin/view_gallery_images/'.$row['id']; ?>" style="text-decoration:none">
                                                                <img src="<?php echo base_url().$row['url']; ?>" alt="<?php echo $row['title']; ?>" style="width:100%">
																<?php
                                                                $string = strip_tags($row['title']);
                                                                if (strlen($string) > 30) {
                                                                
                                                                    // truncate string
                                                                    $stringCut = substr($string, 0, 30);
                                                                    $endPoint = strrpos($stringCut, ' ');
                                                                
                                                                    //if the string doesn't contain any space then it will cut without word basis.
                                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                                    $string .= '...';
                                                                }
                                                                            
                                                                ?>
                                                                <div class="caption">
                                                                    <p style="font-size:14px;" title="<?php echo $row['title']; ?>"><b><?php echo $string; ?></b></p></a>
                                                                    <div class="row">
                                                                        <div class="col-md-10 col-sm-10">
                                                                            <p>Date Added: <?php echo date('d-m-Y',strtotime($row['date'])); ?></p>
                                                                        </div>
                                                                        <div class="col-md-2 col-sm-2" style="text-align:right">
                                                                            <span class="btn btn-danger" id="del_btn" onClick="delete_album(<?php echo $row['id']; ?>)" style="text-align:center;padding:0px;border-radius:50px;">
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

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
//Calendar code start  
	$(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
//Calendar code end

//Image preview start
  $("#images").change(function(){
     $('#preview').html("");
     var total_file=document.getElementById("images").files.length;
	/*if((document.getElementById("images").files[0].size)>3145728)
	{
	 	alert("Max File Size Exceeds");
		return false;
	}*/

     for(var i=0;i<total_file;i++)
     {
     	$('#preview').append("<div class='col-md-3'><img src='"+URL.createObjectURL(event.target.files[i])+"'><br><input type='textbox' name='description_"+i+"' class='description' placeholder='Description' /></div>");
     }
  });
//Image preview end

//Gallery search start  
	function gallery_search()
	{
		var keyword		=	$('#keyword').val();
		var date_from	=	$('#date_from').val();
		var date_to		=	$('#date_to').val();
		
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/gallery_search' ,
			type: "POST",
			data: {keyword:keyword,date_from:date_from,date_to:date_to},
			beforeSend: function() {
				$('#loading').css('display', 'block');
				$('#search_results').html('');
			},
            success: function(response)
            {
				$('#loading').css('display', 'none');
                $('#search_results').html(response);
            }
        });
	}  
//Gallery search end	

//Delete album start
	function delete_album(gallery_master_id)
	{
		if(confirm("Do you really want to delete this album and all of its contents?"))
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/gallery_master_delete' ,
				type: "POST",
				data: {gallery_master_id:gallery_master_id},
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
		else
		{
			
		}
	}
//Delete album end


</script>
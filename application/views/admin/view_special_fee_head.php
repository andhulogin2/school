<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); ?>
<div class="main-content">
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
							<li class="active">View Fee Head</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fees Head
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div> 
				
                  
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                           <div>
                            <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/FeeManagement/add_special_fee_head/' ?>"><button class="btn-info">Add Fee Item</button></a></div> 
<br>
                                    <div class="table-responsive">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="table-header"><center>Sl.No.</center></th>
														<th class="table-header"><center>Fee Head</center></th>	
														
                                                        <th class="table-header" colspan="2"><center>Actions</center></th>
													</tr>
												</thead>
												<tbody>
                                                
                                                 <?php $count = 1;
												
												 foreach($fees as $row1):?>
													<tr>
														
                                                   
														<td align="center">
															<?php echo $count++;?>
														</td>
                                                       
														<td align="center">
															<?php echo $row1['fee_head'];?>
														</td>
                                                        <td align="center">
                                                        <input type="hidden" name="fee_head_id[]" id="fee_head_id[]" value="<?php echo $row1['fee_head_id'];?>"  />
<span name="edit2[]">  <a  name="edit1[]" href="<?php echo base_url();?>index.php/FeeManagement/edit_special_fee_head/<?php echo $row1['fee_head_id'];?>" class="btn-sm btn-icon icon-left" ><i name="edit[]" class="fa fa-edit"></i> </a></span>	
 
 &nbsp;&nbsp;&nbsp;
                                                        
 <span name="delete3[]"><a name="delete2[]" href="<?php echo base_url();?>index.php/FeeManagement/delete_special_fee_heads/<?php echo $row1['fee_head_id'];?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');"><i name="delete1[]" class="fa fa-close text-danger"></i> </a>	</span>
                                                        
                                                        </td>
                                                                     
													</tr>

												<?php endforeach;?>	
												</tbody>
											</table>
                                           </div></div></div></div></div>
                                    <?php echo form_close(); ?>
                       
			<?php include_once APPPATH . 'views/footer.php'; ?>

 <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Deleted Successfully...', 'Deleted', {timeOut: 5000})</script>";
}
elseif ($action=="failed")
{
echo "<script>toastr.error('". "Not Deleted...', 'Error', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
$(document).ready(function(){
	
	check_fee_head_assigned();
});

function check_fee_head_assigned()
{
	var fee_head	=	document.getElementsByName('fee_head_id[]');
	var edit		=	document.getElementsByName('edit[]');
	var edit1		=	document.getElementsByName('edit1[]');
	var edit2		=	document.getElementsByName('edit2[]');
	var delete1		=	document.getElementsByName('delete1[]');
	var delete2		=	document.getElementsByName('delete2[]');
	var delete3		=	document.getElementsByName('delete3[]');
	
	for(var i=0;i<fee_head.length;i++)
	{
		var fee_head_id 	= 	fee_head[i].value;
		
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/check_fee_head_assigned/' + fee_head_id ,
			async:false,
            success: function(response)
            {
				if(parseInt(response)==1)
				{
					edit2[i].title					=	"Can not edit.This Fee Head is assigned to Fee Master";
					edit1[i].style.pointerEvents	=	"none";
					edit1[i].style.cursor			=	"default";
					edit[i].style.color				=	"#CCCCCC";
					
					delete3[i].title				=	"Can not delete.This Fee Head is assigned to Fee Master";
					delete2[i].style.pointerEvents	=	"none";
					delete2[i].style.cursor			=	"default";
					delete1[i].style.color			=	"#CCCCCC";
					
				}
				//alert(response);
                //jQuery('#department').html(response);
            }
        });
	}
}
</script>
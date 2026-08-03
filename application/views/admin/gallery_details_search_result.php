<div class="col-md-12" id="msg_div" style="display:none">
	<?php
	if($this->session->flashdata('action')=='delete_failed')
	{
	?>
        <div class="alert alert-danger alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Image not deleted.</strong>
        </div>
   	<?php
	}
	if($this->session->flashdata('action')=='delete_success')
	{
	?>
        <div class="alert alert-success alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Image deleted successfully.</strong>
        </div>
   	<?php
	}
	if($this->session->flashdata('action')=='insert_failed')
	{
	?>
        <div class="alert alert-danger alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Image not added.</strong>
        </div>
   	<?php
	}
	if($this->session->flashdata('action')=='insert_success')
	{
	?>
        <div class="alert alert-success alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Image added successfully.</strong>
        </div>
   	<?php
	}
	?>     
</div>

<?php
if(count($result['details'])>0)
{
	foreach($result['details'] as $row):
	?>
	<div class="col-md-3">
		<div class="thumbnail">
			
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

<div class="col-md-12" id="msg_div" style="display:none">
	<?php
	if($this->session->flashdata('action')=='delete_failed')
	{
	?>
        <div class="alert alert-danger alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Album not deleted.</strong>
        </div>
   	<?php
	}
	if($this->session->flashdata('action')=='delete_success')
	{
	?>
        <div class="alert alert-success alert-dismissible" style="font-size:12px;text-align:center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Album deleted successfully.</strong>
        </div>
   	<?php
	}
	?>     
</div>

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

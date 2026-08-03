<?php if($certificates_id!=''){ ?>
	<label class="col-sm-3 control-label"> Certificate submitted: </label>
	<div class="col-sm-9">
		<?php foreach($certificate as $cert){ 
			$check = strpos($certificates_id, "'".$cert['certificate_id']."'")!== false;
			if($check=='1') { 
				$query  = "(select a.student_id,b.certificate_id,b.issue_details_id"
				. " from tbl_certificate_issue_master a "
				. "join tbl_certificate_issue_details b on b.issue_master_id=a.issue_master_id "
				. "where b.return_date='0000-00-00 00:00:00' and a.student_id=".$student_id." and b.certificate_id=".$cert['certificate_id'].")";
				$issued = $this->db->query($query)->result_array();
				if(count($issued)>0){
			?>
			<input type="checkbox" name="certificate[]" id="certificate" disabled="disabled" title="Already Issued" value="<?php echo $cert['certificate_id'] ?>">
			<span class="lbl"> <?php echo $cert['certificate_name'] ?></span>
			<?php } else { ?>
			<input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $cert['certificate_id'] ?>">
			<span class="lbl"> <?php echo $cert['certificate_name'] ?></span>
			&nbsp;
		<?php } } } ?>											
	</div>

	<div class="col-md-12" style="margin-top: 20px;text-align:center">
		<center>
			<button type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit">Issue</button>
		</center>
	</div>
<?php } else { ?>
No Certificates submitted
<?php } ?>

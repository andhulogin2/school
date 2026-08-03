	<label class="col-sm-3 control-label"> Certificate submitted: </label>
	<div class="col-sm-9">
		<?php foreach($certificate as $cert){
		foreach($issued as $issue){
		 
			$check = strpos($issue['certificate_id'], $cert['certificate_id'])!== false;
			if($check=='1') { ?>
			<input type="checkbox" name="certificate[]" id="certificate" value="<?php echo $issue['issue_details_id'] ?>">
			<span class="lbl"> <?php echo $cert['certificate_name'] ?></span>
			&nbsp;
		<?php } } } ?>											
	</div>

	<div class="col-md-12" style="margin-top: 20px;text-align:center">
		<center>
			<button type="submit" class="btn btn-info" name="btnsubmit" id="btnsubmit">Return</button>
		</center>
	</div>

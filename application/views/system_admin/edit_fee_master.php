<?php include_once APPPATH . 'views/head.php';?>
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
								<a href="#">Fee Master</a>
							</li>
							<li class="active">Edit</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee master
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Edit
								
							</h1>
						</div><!-- /.page-header -->
                        
                        
         <div><div>               
      <div align="right" style="padding-right:10px;"><a href="<?php echo  base_url();?>index.php/FeeManagement/fee_master">View Fee Master</a></div>       

<?php echo form_open(base_url() . 'index.php/FeeManagement/fee_master/edit', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

<?php

$this->session->set_userdata('fee_master_id',$fee_master_id);
$this->db->select('f.class_id,f.fee_master_name,c.name,f.fee_master_id');
$this->db->from('tbl_fee_master f');
$this->db->join('class c','f.class_id=c.class_id') ;
$this->db->where('fee_master_id',$fee_master_id);
$edit_data		=	$this->db->get()->result_array();
foreach ( $edit_data as $row)
{
?>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Master Name </label>
    <div class="col-sm-9">
  	  <input type="text"  class="col-xs-10 col-sm-5"  id="fee_master_name" name="fee_master_name" value="<?php echo $row['fee_master_name'];?>" readonly="readonly"/>
    </div>
</div>
<br /><br />
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class </label>
    <div class="col-sm-9">
        <input type="text"  class="col-xs-10 col-sm-5"  id="class" name="class" value="<?php echo $row['name'];?>" readonly="readonly"/>
        <input type="hidden" class="form-control"  id="class_id" name="class_id" value="<?php echo $row['class_id'];}?>"/>
    </div>
</div>
   <br /><br />  
   <div style="padding-left:150px;padding-right:500px" >                
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
<tr><td class="table-header">No.</td><td class="table-header">Fee Item</td><td class="table-header">Amount</td></tr>
           
<?php
$fee_master_id=$this->session->userdata('fee_master_id');
$query= $this->db->query("select fee_head_id,fee_head from tbl_fee_heads");
$total = 0;
$i=1;
	foreach($query->result_array() as  $row){
	$chk="";
	$amount= 0;
	$sql= $this->db->query("select fee_amount from tbl_fee_details where fee_head_id=".$row["fee_head_id"]. " and fee_master_id=". $fee_master_id);
 	foreach($sql->result_array() as  $row1){
	if ($sql->num_rows())
	{
		$amount= $row1["fee_amount"];
		$total =$total+ $row1["fee_amount"];
		if($row1["fee_amount"]>0 ) $chk="checked='checked'";
	}
}
	?>
<tr><td> <?php echo $i; $i=$i+1;?></td><td> 
 <input type="checkbox" <?php echo $chk;?>name="chkfee_details1[]" onClick="feeTotal1()" value="<?php echo $row["fee_head_id"] ?>"> <?php echo $row["fee_head"] ?>
<input type="hidden" name="hdnfee_details[]"  value="<?php echo $row["fee_head_id"] ?>"></td>
<td>
<input type="number" name="fee_details1[]" id="fee_details1[]"  class="col-xs-10 col-sm-5"  value="<?php echo $amount; ?>" onChange="feeTotal1()" >
</td>

</tr>
<?php }?>
<tr><td colspan="2" align="center">
<b>Total</b></td><td >
<input type="text"  class="col-xs-10 col-sm-5"  name="tot" id="tot" value="<?php echo $total;?>" readonly/></td></tr>
  <tr><td colspan="3" align="center">  <button type="submit" class="btn btn-success btn-icon">
        Update
    </button>
    </td></tr>
</table>
</div>
<?php echo form_close(); ?>
      
            </div></div>
</div>
</div>
</div>
</div><!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
<!-- /.main-content -->

<?php include_once APPPATH . 'views/footer.php'; ?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    

<script type="text/javascript">
	

function feeTotal1() {

  var fees = document.getElementsByName('fee_details1[]');
    var chkfees = document.getElementsByName('chkfee_details1[]');
	
  var tot=0;
// alert(fees.length);
  for (var i = 0;  i < fees.length; i++)
   {
   if(chkfees[i].checked)
 	   tot = tot+Number(fees[i].value);
   else
    fees[i].value=0;
	}   
  document.getElementById('tot').value=tot;
 // alert(document.getElementById('total').value);
}
</script>


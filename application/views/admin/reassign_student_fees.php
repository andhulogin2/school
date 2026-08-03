 <?php include_once APPPATH . 'views/main_head.php';?>
 <?php 
/* echo "<pre>";
 print_r($branch_id);
 echo "</pre>";
 die();*/
 ?>
<body>
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
							<li class="active">Reassign Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Reassign
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
<?php

$counter=$this->session->flashdata('counter');
if($counter==1)
{
	$this->session->set_flashdata('counter',$counter);
}

$role	=	$this->session->userdata('role');
if($role==1 || $role==2)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section .'/back/'.$department_id.'/'.$branch_id; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}
if($role==3)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section .'/back/'.$department_id; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}
if($role==4)
{
?>
<div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section .'/back'; ?>"><b><button class="btn-info">Back</button></b></a></div> 
<?php
}

?>				 
<br>                     
                                        <div></div>
<?php echo form_open(base_url() . 'index.php/FeeManagement/reset_fee_due_date/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

<input type="hidden" name="department" id="department" value="<?php echo $department_id;?>">
<input type="hidden" name="class" id="class" value="<?php echo $class_id;?>">
<input type="hidden" name="section" id="section" value="<?php echo $section;?>">
<input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>">


<div style="padding-left:50px; padding-right:50px;">
<table class="table">
<tr>
 <td style="text-align: center;">Name :<?php echo get_student_name($student_id);?></td>
 <td style="text-align: center;">Admission No : <?php echo get_admission_number($student_id); ?></td>
 <td style="text-align: center;">Gender :<?php echo get_student_sex($student_id);?></td></tr>
<tr>
 <td style="text-align: center;">Address :<?php echo get_student_address($student_id);?></td>
 <td style="text-align: center;">Phone Number :<?php echo get_student_phone($student_id);?></td>
 <td style="text-align: center;">Email :<?php echo get_student_email($student_id);?></td>
 </tr>
<tr><td colspan="3">

<div style="padding-left:50px; padding-right:50px;">
     <table  id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                              <thead>
                    <tr>
      <th style="text-align: center;">Sl.No</th>
      <th style="text-align: center;">Due Date</th>
      <th style="text-align: center;">Amount to Pay</th>
      <th style="text-align: center;">Paid Amount</th>
      <th style="text-align: center;">Balance</th>
      <th style="text-align: center;">Concession</th>
    </tr>
    </thead>
    <tbody>
		<?php
        $this->db->select('students_fee_master_id, due_date,fee_amount,fee_balance,fee_concession');
        $this->db->from('tbl_students_fee_master');
        $this->db->where('class_id',$class_id);
        $this->db->where('admission_number',$student_id);
        $this->db->where('fee_amount>0');
        $this->db->where('is_deleted','N');
        $this->db->order_by("due_date","asc");
		$result=$this->db->get()->result_array();
		$no=1;
		foreach($result as $data)
		{?>
            <tr>
            <input type="hidden" name="students_fee_master_id[]" id="students_fee_master_id[]" value="<?php echo $data['students_fee_master_id'];?>">
            <td style="text-align: center;"> <?php echo $no;?></td>
            <td style="text-align: center;">
            <?php
            $date = $data['due_date'];
            $timestamp=strtotime($date);
            $display=date('d-m-Y', $timestamp);
            ?>
            <input type="text" name="due_date[]" id="due_date[]" class="form-control date-picker"   value="<?php  echo $display;?>"/>
            </td>
            <td style="text-align: right;"><?php echo  number_format($data['fee_amount'],2) ;?></td>
            <td style="text-align: right;"><?php $paid=$data['fee_amount']-$data['fee_balance']-$data['fee_concession'];  echo  number_format($paid,2) ;?></td>
            <td style="text-align: right;"><?php echo  number_format($data['fee_balance'],2) ;?></td>
            <td style="text-align: right;"><?php echo  number_format($data['fee_concession'],2) ;?></td>
            </td>
            </tr>
		<?php $no++;
         }?>
        <tr><td align="center" colspan="6">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                   <button type="submit" class="btn btn-info"><?php echo get_phrase('Reset Due Date'); ?></button>
                </div>
            </div>
            </td></tr>
            </tbody>
        </table>
<?php echo form_close(); ?>
</td></tr>
</table>
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

<script type="text/javascript">
  function reset_date(){
	
        var classid = $('#class_selector_holder').val();
        var section = $('#section_selector').val();
		console.log(section);
		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_details/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent_student').html(response);
            }
   });
}
 
		</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
		})
		</script>

<?php include_once APPPATH . 'views/main_head.php';?>
 
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
							<li class="active">Fee Master</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

					<!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee Master 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Course Fee Details
								
							</h1>
						</div><!-- /.page-header -->
           <div align="right" style="padding-right:10px;"><a href="<?php echo  base_url();?>index.php/FeeManagement/setup_fee"><button class="btn-info">New Fee Plan</button></a></div>           
                        <?php echo form_open('FeeManagement/fee_plan_view', array('class' => 'form-horizontal'));?>
 							 <?php 
							 $role=$this->session->userdata('role');
							 if($role ==1 || $role==2 )
							 {?>
							 
							 
                                    <div class="col-md-12">
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-2">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
								
                                    
                                   
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Department:</label>

										<div class="col-sm-2">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
                                        
                                        <div class="col-sm-3">
											<input type="submit" class="btn btn-info" type="button" value='Show' />
										</div>
                                         <div id="hidden" style="padding-top:100px;"></div>
                                         <?php } ?>
                                         
									<?php 
							// $role=$this->session->userdata('role');
							 if($role ==3)
							 {?>
							 
							 
					  
                                    <div class="col-md-12">
										
                                    
                                   
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Department:</label>

										<div class="col-sm-3">
											<select name="department" class="col-xs-12 col-sm-12" id="department" onChange="return get_class1(this.value)">
            <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
										</div>
                                        
                                        <div class="col-sm-3">
											<input type="submit" type="button" value='view'>
										</div> 
                                        <div id="hidden" style="padding-top:100px;"></div>
                                         <?php } ?>
                                     <?php echo form_close(); ?>
                                    
                                     
         <div><div> 
         
         
             
          <br>
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
              <thead>
                <tr>
                  <th style="text-align: center;" class="table-header">SNo.</th>
                  <th style="text-align: center;" class="table-header">Name</th>
				  <th style="text-align: center;" class="table-header">Class Name</th>
                  <?php $role=$this->session->userdata('role');
				  if($role==1 || $role==2){?>
                   <th style="text-align: center;" class="table-header">Branch</th>
                   <?php } 
                    if($role==1 || $role==2 ||$role==3){?>
                   <th style="text-align: center;" class="table-header">Department</th>
                   <?php } ?>
                  <th style="text-align: center;" class="table-header">Total Fee</th>
			      <th style="text-align: center;" colspan="3" class="table-header">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php  $i=1;    
										  foreach($fee_master as $row){?>       
        <tr>
         <td style="text-align: center;">
         	<?php
			if($row['fee_total']==$row['full_fee_amount'])
			{
			?>
		 		<span style="float:left" name="same_amount[]" title="Full Fee Set"><i style="color:#00FF00" class="fa fa-check text-info"></i></span>
            <?php
			}
			else if($row['fee_total']!=$row['full_fee_amount'])
			{
			?>    
                <span style="float:left;" name="not_same_amount[]" title="Full Fee Not Set"><i style="color:#FF0000" class="fa fa-times text-info"></i></span>
            <?php
			}
			?>
		 <?php echo $i; $i=$i+1;?></td>
         <td style="text-align: center;"><?php echo html_entity_decode( $row['fee_master_name'],ENT_COMPAT,'UTF-8');?></td>
         <td style="text-align: center;"><?php echo $row['name'];?></td>
           <?php if($role==1 || $role==2){?>
         <td style="text-align: center;"><?php echo $row['branch'];?></td>
         <?php } 
		  if($role==1 || $role==2 ||$role==3){?>
          <td style="text-align: center;"><?php echo $row['dept'];?></td>
          <?php } ?>
          
         <td style="text-align: center;"><?php echo $row['fee_total'];?></td>
         <input type="hidden" name="fee_master_id[]" id="fee_master_id[]" value="<?php echo $row['fee_master_id'];?>" > 
         <input type="hidden" name="fee_total[]" id="fee_total[]" value="<?php echo $row['fee_total'];?>" > 
         
		<!--<td style="text-align: center;" class="text-nowrap"><a name="edit_fee" href="<?php echo base_url();?>index.php/FeeManagement/edit_fee_master1/<?php echo $row['fee_master_id'];?>"  data-toggle="tooltip" title="Edit" data-original-title="Edit"> <i name="i_edit[]" class="fa fa-edit text-info"></i> </a></td>	-->
        <td style="text-align: center;" class="text-nowrap">
        	<?php
			if($row['is_fee_assigned']=='Y')
			{
			?>
                <span name="edit1[]" title="Can not edit.This Fee Master is assigned to students">
                    <a name="edit[]" href="<?php echo base_url();?>index.php/FeeManagement/edit_fee_master/<?php echo $row['fee_master_id'];?>"  data-toggle="tooltip" title="Edit" data-original-title="Edit" style="pointer-events: none;cursor:default;"> 
                        <i name="i_edit[]" style="color:#CCCCCC" class="fa fa-edit text-info"></i> 
                    </a>
                </span>
            <?php
			}
			else
			{
			?>
                <span name="edit1[]">
                    <a name="edit[]" href="<?php echo base_url();?>index.php/FeeManagement/edit_fee_master/<?php echo $row['fee_master_id'];?>"  data-toggle="tooltip" title="Edit" data-original-title="Edit"> 
                        <i name="i_edit[]" class="fa fa-edit text-info"></i> 
                    </a>
                </span>
            <?php
			}
			?>
        </td>			       
        <td style="text-align: center;" class="text-nowrap">
        	<?php
			if($row['is_fee_assigned']=='Y')
			{
			?>
                <span name="delete2[]" title="Can not delete.This Fee Master is assigned to students">
                    <a name="delete1[]" href="<?php echo  base_url();?>index.php/FeeManagement/fee_master/delete/<?php echo $row['fee_master_id']."/".$row['class_id'];?>" data-toggle="tooltip"  title="Delete" onClick="return confirm('Are you sure to delete this entry?');" data-original-title="Delete"  style="pointer-events: none;cursor:default;"> 
                        <i name="i_delete[]" style="color:#CCCCCC" class="fa fa-close text-danger"></i> 
                    </a>
                </span>
            <?php
			}
			else
			{
			?>
                <span name="delete2[]">
                    <a name="delete1[]" href="<?php echo  base_url();?>index.php/FeeManagement/fee_master/delete/<?php echo $row['fee_master_id']."/".$row['class_id'];?>" data-toggle="tooltip"  title="Delete" onClick="return confirm('Are you sure to delete this entry?');" data-original-title="Delete"> 
                        <i name="i_delete[]" class="fa fa-close text-danger"></i> 
                    </a>
                </span>
            <?php
			}
			?>
        </td>
        
        
        <td style="text-align: center;" class="text-nowrap"><a href="<?php echo  base_url();?>index.php/FeeManagement/fee_details_view/<?php echo $row['fee_master_id']."/".$row['class_id'];?>" data-toggle="tooltip" title="Setup Installments"><i class="fa fa-wrench text-info"></i></a></td>
               </tr>
                <?php }?>
              </tbody>
            </table>
           </div></div></div></div></div>
           </div></div>
           </body>
           
<?php include_once APPPATH . 'views/footer.php'; ?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	//get_total_inst_amount();
});
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	
function get_total_inst_amount()
{
	$("#same_amount[0]").hide();
	var fee_master		=	$('input[name="fee_master_id[]"]');
	var fee_total		=	$('input[name="fee_total[]"]');
	var same_amount		=	document.getElementsByName('same_amount[]');
	var not_same_amount	=	document.getElementsByName('not_same_amount[]');
	var edit			=	document.getElementsByName('edit[]');
	var edit1			=	document.getElementsByName('edit1[]');
	var delete1			=	document.getElementsByName('delete1[]');
	var delete2			=	document.getElementsByName('delete2[]');
	var i_delete		=	document.getElementsByName('i_delete[]');
	var i_edit			=	document.getElementsByName('i_edit[]');

	for(var i=0;i<fee_master.length;i++)
	{
		var fee_master_id 	= 	fee_master[i].value;
		var total_amount	=	parseFloat(fee_total[i].value);
		
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/get_total_inst_amount/' + fee_master_id ,
			async:false,
            success: function(response)
            {
				if(total_amount==parseFloat(response))
				{
					same_amount[i].style.display	=	"inline";
					same_amount[i].title			=	"Full Fee Assigned";
				}
				else
				{
					not_same_amount[i].style.display=	"inline";
					not_same_amount[i].title		=	"Full Fee Not Assigned";
				}
				//alert(response);
                //jQuery('#department').html(response);
            }
        });
		
		/////Check Fee Master is assigned to a student
		
/*		  $.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/check_fee_master_assigned/' + fee_master_id ,
			async:false,
            success: function(response)
            {
				if(parseInt(response)==1)
				{
					edit1[i].title					=	"Can not edit.This Fee Master is assigned to students";
					edit[i].style.pointerEvents		=	"none";
					edit[i].style.cursor			=	"default";
					
					delete2[i].title				=	"Can not delete.This Fee Master is assigned to students";
					delete1[i].style.pointerEvents	=	"none";
					delete1[i].style.cursor			=	"default";
					i_delete[i].style.color			=	"#CCCCCC";
					i_edit[i].style.color			=	"#CCCCCC";
					
					
				}	
				else
				{
					edit[i].style.pointerEvents		=	"auto";
					edit[i].style.cursor			=	"pointer";
					edit1[i].title					=	"";
					
					delete1[i].style.pointerEvents	=	"auto";
					delete1[i].style.cursor			=	"pointer";
					delete2[i].title				=	"";
				}
            }
        });
*/
		
	}

}

	
</script>

<?php
 $role=$this->session->userdata('role');
   include_once APPPATH . 'views/main_head.php';  
 $running_year = get_running_year(); ?>
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
							<li class="active"> Category</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								View
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Category
								
							</h1>
						</div>
                        
                        
                        

                          
                        <?php echo form_open_multipart('Admin/view_expense', array('class' => 'form-horizontal'));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-1 col-xs-10 control-label no-padding-right" for="form-field-1">Category</label>

										<div class="col-sm-2 col-xs-12">
											<select name="category" class="col-xs-5 col-sm-12" id="category" >
                              <option value="">Select</option>
                              <?php 
							  //$branch	=	$this->session->userdata('branch_id');
							  //$this->db->where('branch_id',$branch);
							$category=$this->db->get('tbl_expence_category')->result_array();
							  foreach ($category as $category1)
							  {
							  
											   ?>
                                               <option value="<?php echo $category1['category_id']?>"><?php echo $category1['category_name']; ?></option>
                                               <?php
											   }
											?>
                              
                          </select>
										</div>
                                        <div class="col-sm-2 col-xs-12">
											<input type="text" name="from_date" id="from_date"  class="form-control mydatepicker" placeholder="From Date" />
										</div>
									<div class="col-sm-2 col-xs-12">
											<input type="text" name="to_date" id="to_date" placeholder="To Date" class="form-control mydatepicker" />
										</div>
                                      <div class="col-md-3 col-xs-3">
                     <input type="submit"  value='Submit'>
                        
										</div>
                                        </div>
                                         <?php echo form_close(); ?>
                       
                        
                                    
                                       
                          
                        
                              <br> 
  <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/add_expense/'?>" >Add Expense</a></div>  
  
  <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/expense_bulk/'?>" >Bulk Expense</a></div>
  
  
  
                         
            <div class="table-responsive">
  <?php  $role=$this->session->userdata('role');?>
														
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
                                                        <th class="table-header">Date</th>
														<th class="table-header">Category</th>
                                                        <th class="table-header">Amount</th>
                                                         <th class="table-header">Give to</th>
                                                       
                                                           
                                                            <th class="table-header">Remark</th>
                                                       
												
														<th class="table-header" colspan="2"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                   <?php $count = 1;
												  									 $total=0;
												  foreach($category_exp as $row):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
                                                        <td><center><?php echo date('d-m-Y',strtotime($row['expense_date']));?></center></td>
														<td><center><?php echo $row['category_name'];?></center></td>
                                                        <td><center><?php echo $row['amount'];?></center></td>
                                                        <td><center><?php echo $row['give_to'];?></center></td>
                                                    	<!-- <td><center><?php echo $row['dept_name'];?></center></td>-->
														
                                                      <!--  <td><center><?php echo $row['name'];?></center></td>-->
                                                        
                 
                                                          <td><center><?php echo $row['remark'];?></center></td>
														
														
														
														<td style="text-align: center;">
															
																

																<?php
                echo anchor('Admin/expense_edit/' .$row['id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div></td><td style="width:200px;">	
                    									

								<a href="<?php echo base_url();?>index.php/admin/expense_delete/<?php echo $row['id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>
													</tr>

												<?php 
												$total=$total+$row['amount'];
												endforeach;?>	
                                                <tr><th colspan="3">Total</th>
                                                <td align="center"><?php echo $total;?></td></tr>
												</tbody>
            </table>

 <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Report/expense_report/'.$cat.'/'.$from_date.'/'.$to_date; ?>" >Download</a></div> 
 <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Report/expense_report_pdf/'.$cat.'/'.$from_date.'/'.$to_date; ?>" >Download PDF</a></div> 



 
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script> 


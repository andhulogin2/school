<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
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
							<li class="active">Exam</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Exam 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        
                                        
                                         <?php echo form_open('Admin/view_exam', array('class' => 'form-horizontal'));
                        $role=$this->session->userdata('role');
						if($role==1 || $role==2)
						{
						 ?>
                         
                         <div class="col-md-12">
										<label class="col-sm-1"> Branch: </label>

										<div class="col-sm-2">
											<select class="select2" id="branch" name="branch" onChange="return get_dept(this.value)">
                                               <option value="">Select</option>
                                               <?php $branch=$this->db->get('tbl_branch')->result_array();
											   foreach($branch as $branch_id){?>
                                               <option value="<?php echo $branch_id['branch_id']?>"><?php echo $branch_id['branch_name']; }?></option>
                                               
                                             </select>
											
										</div>
                                        
								
                                    
                                    
										<label class="col-sm-1"> Department: </label>

										<div class="col-sm-2">
											<select name="department" class="select2" id="department">
                              <option value="">Select</option>
                             
                              
                          </select>
                                             </div>
                                             <div class="col-sm-3">
											<input type="submit" type="button" class="btn btn-info" value='Show'>
										</div>
                                        
									</div>
                                     <?php echo form_close(); }?>
                                        
                                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Admin/create_exam/new/'; ?>"><b><button type="button" class="btn-info">New Exams</button></b></a></div>
<br>


																<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
													
														<th class="table-header"><center> Sl no</center></th>
														<th class="table-header"><center>Exam Name</center></th>
														<th class="table-header"><center>Description</center></th>
														<th class="table-header"><center>Class </center></th>
														<th class="table-header" colspan="1"><center>Action</center></th>
													</tr>
												</thead>
              <?php $count =1;foreach($exams as $row1):?>
                <tr>
                 <td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row1['name'];?></td>
                <td style="text-align: center;"><?php echo $row1['comment'];?></td>
               
               <td style="text-align: center;"><?php 
               $ses = $this->db->get_where('class', array('class_id' => $row1['class_id']))->row()->name;
               echo $ses;?></td>
             


<!-- /.modal-content -->
<td>
<?php echo anchor('Admin/edit_unit_exam/'.$row1['exam_id'], '<i class="ace-icon fa fa-pencil bigger-130" title="Edit"></i>');?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php 
$this->db->where('exam_id',$row1['exam_id']);
								$a=$this->db->get('mark');
							
								if($a->num_rows() >0)
								{
								echo "exist";
								}
								else{?>
								<a href="<?php echo base_url();?>index.php/admin/create_exam/delete/<?php echo $row1['exam_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
		<?php	}					
//echo anchor('Admin/create_exam/delete/'.$row1['exam_id'],'<i class="ace-icon fa fa-trash-o bigger-130"  title="Delete"></i>');}?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('Admin/tab_sheet/','<i class="fa fa-bars" aria-hidden="true"  title="Report">&nbsp;&nbsp;Report</i>');?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('Admin/rank/','<i class="fa fa-arrow-right bigger-130" title="Rank">&nbsp;&nbsp;Rank</i>');?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('Admin/progress_report/','<i class="fa fa-download bigger-130" title="Download"></i>');?>
</td>



</td>

</tr>
                <?php endforeach;?>
              
            </table>

			<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
    $(document).ready(function(){
      if ($.fn.DataTable && $('#dynamic-table').length > 0) {
        $('#dynamic-table').DataTable();
      }
    });
</script>
  <script type="text/javascript">
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
	

	
</script>
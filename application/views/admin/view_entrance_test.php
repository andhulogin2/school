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
							<li class="active">Entrance Test</li>
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
								Entrance Test 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Admin/create_entrance_test/new/'; ?>"><b><button class="btn-info">New Entrance Test</button></b></a></div> 
                                        
                                         <?php echo form_open('Admin/view_entrance_test', array('class' => 'form-horizontal'));
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
											<input type="submit" class="btn btn-info" type="button" value='Show'>
										</div>
                                        
                                             
                                             
                                             <?php } 
                                             
                                             
                                             
                                             
                                             if($role==3)
						{
						 ?>
                         
                         <div class="col-md-12">
										<label class="col-sm-1"> Department: </label>

										<div class="col-sm-2">
											<select class="select2" id="department" name="department" >
                                               <option value="">Select</option>
                                               <?php 
											   $branch		=		$this->session->userdata('branch_id');
											   $this->db->where('branch_id',$branch);
											   $dept=$this->db->get('tbl_department')->result_array();
											   foreach($dept as $data){?>
                                               <option value="<?php echo $data['dept_id']?>"><?php echo $data['dept_name']; }?></option>
                                               
                                             </select>
											
										</div>
										
										 <div class="col-sm-3">
											<input type="submit" class="btn btn-info" type="button" value='Show'>
										</div>
                                        
                                        
                                    
                                             <?php } ?>
                                             
								
                                     <?php echo form_close(); ?>
                                        
<br><br><br>



																<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
													
														<th class="table-header"><center> Sl no</center></th>
														<th class="table-header"><center>Exam Name</center></th>
														<th class="table-header"><center>Class</center></th>
														<th class="table-header"><center>Section</center></th>
                                                        <th class="table-header"><center>Subject</center></th>
														<th class="table-header" colspan="1"><center>Action</center></th>
													</tr>
												</thead>
              <?php  $count =1;foreach($exams as $row1):?>
                <tr>
                 <td style="text-align: center;"><?php  echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row1['exam_name'];?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('class', array('class_id' => $row1['class_id']))->row()->name; ?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('section', array('section_id' => $row1['section_id']))->row()->name; ?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('subject', array('subject_id' => $row1['subject_id']))->row()->name; ?></td>
               
              


<!-- /.modal-content -->
<td>
<?php  echo anchor('Admin/edit_entrance_test/'.$row1['entrance_test_id'].'/'.$row1['class_id'].'/'.$row1['subject_id'].'/'.$row1['section_id'].'/'.$row1['branch_id'].'/'.$row1['dept_id'].'/'.$row1['date_exam'], '<i class="ace-icon fa fa-pencil bigger-130" title="Edit"></i>');?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php 
$this->db->where('entrance_test_id',$row1['entrance_test_id']);
								$a=$this->db->get('tbl_entrance_test_mark');
							
								if($a->num_rows() >0)
								{
								echo "value exist";
								}
								else{?>
								<a href="<?php echo base_url();?>index.php/admin/create_entrance_test/delete/<?php echo $row1['entrance_test_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
		<?php	}					
//echo anchor('Admin/create_exam/delete/'.$row1['exam_id'],'<i class="ace-icon fa fa-trash-o bigger-130"  title="Delete"></i>');}?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('Admin/entrance_test_report/'.$row1['class_id'].'/'.$row1['section_id'].'/'.$row1['entrance_test_id'].'/'.$row1['subject_id'],'<i class="fa fa-bars" aria-hidden="true"  title="Report">&nbsp;&nbsp;Report</i>');?>
</td>



</td>

</tr>
                <?php  endforeach;?>
              
            </table>

			<?php include_once APPPATH . 'views/footer.php'; ?>


<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
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
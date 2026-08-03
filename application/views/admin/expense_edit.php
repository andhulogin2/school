<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">Admission</li>
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
								Add
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 New Exam
								
							</h1>
						</div>
                        
<div align="right" style="padding-right:20px"><a href="<?php echo base_url() . 'index.php/Admin/view_expense/'?>">Back</a></div>                         
<div class="col-sm-10 widget-container-col">
<?php
foreach($expense as $row)
{
?>										
						<?php echo form_open(base_url() . 'index.php/admin/expense_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
          <div class="white-box">
            <br><br>
            

		<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Expense Category:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select  name="category1" class="form-control selectboxit" id="category" class="col-xs-12 col-sm-12">
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									// $this->db->where('branch_id',$branch);
									 //$this->db->where('dept_id',$dept);
									 $category 	=	$this->db->get('tbl_expence_category')->result_array();
									 foreach($category as $data)
									 {
									 if($data['category_id']==$row['category_id'])
									 {
									 ?>
                                      <option value="<?php echo $data['category_id']?>" selected="selected"><?php echo $data['category_name']?></option>
                                       <?php 
									   }
									   else
									   { 
									    ?>
                                      <option value="<?php echo $data['category_id']?>" selected="selected"><?php echo $data['category_name']?></option>
                                       <?php  
									   }
									   } ?>
				
			</select>
		</div>
	</div>
 
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label">Amount<font color="#FF0000">* </font></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="amount" value="<?php echo $row['amount']; ?>" placeholder="Amount">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Give to</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control"  name="give_to" value="<?php echo $row['give_to']; ?>" placeholder="give to">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Remark</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control"  name="remark" value="<?php echo $row['remark']; ?>" placeholder="Remark">
                    </div>
                  </div>
                          
<?php
}
?>
					
                           
                            
                            
				

        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info">Update</button>
              <span id="preloader-form"></span>
            </div>
            </div>
        </div>
       
						 <?php echo form_close();?>
                         
															</div>
														</div>
                                                      
                </div>                              

			</div>											

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
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>


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

<script type="text/javascript">
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_class1(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class1').html(response);
            }
        });
    }
	

	
</script>

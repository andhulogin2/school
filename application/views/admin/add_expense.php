<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/main_head.php';
?>
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
							<li class="active">Expense</li>
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
									 New Expense
								
							</h1>
						</div>
<div class="col-sm-10 widget-container-col">
										
						<?php echo form_open(base_url() . 'index.php/admin/expense_add ' , array('id'=>'expense_form','class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
          <div class="white-box">
            <br><br>
            
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Expense Date: <font color="#FF0000">* </font> </label>
                 
                    
                    <div class="col-sm-4">
                        <div class="clearfix">
                        <!-- #section:plugins/date-time.datepicker -->
                        <div class="input-group input-group-sm">
                                <input type="text"  id="mydatepicker"  class="form-control mydatepicker" name="expense_date" value="<?php echo date('d-m-Y'); ?>" required/>
                                <span class="input-group-addon">
                                    <i class="ace-icon fa fa-calendar"></i>
                                </span>
                            </div>

                        <div class="space-2"></div>

                        </div>
                    </div>
                </div>
                                    <?php if($this->session->userdata('role')==3)
									{?>
                                    <div class="form-group">
                                    
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Department:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select  name="dept_id" class="form-control selectboxit" id="dept_id" class="col-xs-12  col-sm-12" required="required">
				<option value="">Select</option>
				<option value="all">All</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 //$dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('is_deleted','N');
									 $dept 	=	$this->db->get('tbl_department')->result_array();
									 foreach($dept as $data){?>
                                      <option value="<?php echo $data['dept_id']?>"><?php echo $data['dept_name']?></option>
                                       <?php } ?>
				
			</select>
		</div>
	</div>
    <?php } ?>
 
		<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Expense Category:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select  name="category1" class="form-control selectboxit" id="category" class="col-xs-12 col-sm-12" required="required">
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									// $this->db->where('branch_id',$branch);
									
									 $category 	=	$this->db->get('tbl_expence_category')->result_array();
									 foreach($category as $data){?>
                                      <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name']?></option>
                                       <?php } ?>
				
			</select>
		</div>
	</div>
 
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label">Amount:<font color="#FF0000">* </font></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="amount" id="amount" placeholder="Amount" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Give to:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="give_to" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Remark:</label>
                    <div class="col-sm-5">
                   <textarea  name="remark" style="width:350px;"></textarea>
                     
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Upload Document:</label>
                    <div class="col-sm-5">
                   <input  type="file" name="userfile" width="100px" height="120px"/>
                     
                    </div>
                  </div>
                          
				

        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="button" onclick="check_settings();" class="btn btn-info">Add</button>
              <span id="preloader-form"></span>
            </div>
        </div>
       
						 <?php echo form_close();?>

              <div id="otp_div" style="padding-top:60px">

            </div>
            
            
                    </div>
                  </div>
          </div>                          
                            
                                                      
        </div>                              

	</div><br /><br />
            										

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

<script>	
	function validate_otp()
	{
		var otp_password    =   $('#otp').val();
		var recieved_otp 	=	$('#recieved_otp').val();

		if(otp_password == recieved_otp)
		{
			//alert("1");
			$('#expense_form').submit();
		}
		else
		{
			$('#errorMsg').show();
		}
	}
	
	function check_settings()
	{
		<?php
		if($this->db->get_where('settings', array('type'=>'otp_for_expense_add'))->row()->description == 'yes')
		{
		 ?>
		var expence_value    =   $('#amount').val();
		var expense_date    =   $('#mydatepicker').val();
		//alert(expense_date);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/check_expense_limit/' + expence_value +'/'+ expense_date ,
            success: function(response)
            {
                if(response=="0")
			   {
	               $('#expense_form').submit();
				   $('#otp_div').hide();
			   }
			   else
			   {
				   $('#otp_div').html(response);
			   }

            }
        });
		return false;
		<?php
		} else {
		?>
		
		   $('#expense_form').submit();
		   
	   <?php } ?>
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
    

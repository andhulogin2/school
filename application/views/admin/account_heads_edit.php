<?php
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
							<li class="active">Account Head</li>
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
									 Edit Account Head
								
							</h1>
						</div>
<div class="col-sm-10 widget-container-col">
                              <div align="right" style="padding-right:100px"> 
                             <a href="<?php echo base_url();?>index.php/Admin/view_account_heads" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                             </div>
                             
                     <?php echo form_open('Admin/account_heads_update/', array('class' => 'form-horizontal'));?>

  <?php
  foreach($account as $row)
  { ?>     
          <input type="hidden" name="account_head_id" value="<?php echo $row['account_head_id']; ?>"
          <div class="white-box">
            <br><br>
             <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
                     
          <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
				<select name="branch" class="form-control selectboxit" id="branch" onChange="return get_dept(this.value)" required="">
                   <?php $branch=$this->db->get('tbl_branch')->result_array();
					foreach ($branch as $branch1)
					{
						if($branch1['branch_id']==$row['branch_id'])
						{
						?>
						<option value="<?php echo $branch1['branch_id']?>" selected="selected"><?php echo $branch1['branch_name']?></option>
						<?php 
						}
						else
						{ 
						?>
						<option value="<?php echo $branch1['branch_id']?>" ><?php echo $branch1['branch_name']?></option>
						<?php  
						}
					 } ?>
                  </select>
			</div>
		</div>
        
        <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
				<select name="department" class="form-control selectboxit" id="department" onChange="return get_class(this.value)" required="">
                  <option value="<?php echo $row['department_id']; ?>"><?php echo get_dept($row['department_id']); ?></option>
                         
                 </select>
			</div>
		</div>
        <?php } ?>
        
	<?php if($this->session->userdata('role')==3)
	{?>
		<input type="hidden" name="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
		<div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
			<div class="col-sm-5">
			<select name="department" class="form-control selectboxit" id="department" onChange="return get_class1(this.value)" required="">
            <option value="<?php echo $row['department_id']; ?>"><?php echo get_dept($row['department_id']); ?></option>
			  <?php 
              $this->db->where('branch_id',$this->session->userdata('branch_id'));
              $dept=$this->db->get('tbl_department')->result_array();
              foreach ($dept as $dept1)
              {
              ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
              <?php }?>
          </select>
		</div>
	</div>
    
    <?php } 
	if($this->session->userdata('role')>=4)
	{
	?>
      	<input type="hidden" name="branch" value="<?php echo $this->session->userdata('branch_id') ?>"  />
		<input type="hidden" name="department" value="<?php echo $this->session->userdata('dept_id') ?>"  />
	<?php } ?>   
                                                     		
        <div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Account Group:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select  name="account_group" class="form-control selectboxit" id="account_group" class="col-xs-12 col-sm-12" required="">
                <?php
				 $voucher_type 	=	$this->db->get('tbl_account_group')->result_array();
				 foreach($voucher_type as $data)
				 {
					if($data['account_group_id']==$row['account_group_id'])
					{
					?>
					<option value="<?php echo $data['account_group_id']?>" selected="selected"><?php echo $data['account_group_name']?></option>
					<?php 
					}
					else
					{ 
					?>
					<option value="<?php echo $data['account_group_id']?>" ><?php echo $data['account_group_name']?></option>
					<?php  
					}
				 } ?>
			</select>
		</div>
	</div>
		<?php
				$account_section_id = $this->session->userdata('account_section_id');
				if($account_section_id==1)
				{
		?>
    
		<div class="form-group">
		<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">account Section:<font color="#FF0000">* </font> </label>
        <div class="col-sm-5">
			<select  name="account_section" class="form-control selectboxit" id="account_section" class="col-xs-12 col-sm-12" required="">
                <?php 
				 $this->db->where('account_section_id >','1');
				 $account_head 	=	$this->db->get('tbl_account_section')->result_array();
				 foreach($account_head as $data)
				 {
					if($data['account_section_id']==$row['account_section_id'])
					{
					?>
					<option value="<?php echo $data['account_section_id']?>" selected="selected"><?php echo $data['account_section_name']?></option>
					<?php 
					}
					else
					{ 
					?>
					<option value="<?php echo $data['account_section_id']?>" ><?php echo $data['account_section_name']?></option>
					<?php  
					}
				 } ?>
				
			</select>
		</div>
	</div>
    <?php } ?>
    
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label">Account Head:<font color="#FF0000">* </font></label>
                    <div class="col-sm-5">
                      <input type="text" id="account_head" value="<?php echo $row['account_head_name']; ?>" placeholder="Account Head" name="account_head" class="form-control"/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Opening Balance:</label>
                    <div class="col-sm-5">
                      <input type="text" id="opening_balance" value="<?php echo $row['opening_balance']; ?>" placeholder="Opening Balance" name="opening_balance" class="form-control"/>
                    </div>
                  </div>
                  
				

        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info">Update</button>
              <span id="preloader-form"></span>
            </div>
        </div>
       
	<?php }
	?>
    			 <?php echo form_close();?>

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
    


<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>

<?php $running_year = get_running_year(); ?>
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
				<li class="active">Attendance</li>
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
                    Attendance
                    
                        <i class="ace-icon fa fa-angle-double-right"></i>
                         Summary
                    
                </h1>
            </div>             
   			<div class="row">
				<?php
                if($role==1 || $role==2)
                {
					$this->db->select('branch_id,branch_name');
					$this->db->where('is_deleted','N');
					$branches	=	$this->db->get('tbl_branch')->result_array();
                ?>      
                    <div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center">
                        <select class="select2" name="branch_id" id="branch_id" onchange="get_dept(this.value)">
                            <option value="">Select Branch</option>
                            <?php
							foreach($branches as $row):
							?>
                            <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>
                            <?php
							endforeach;
							?>
                        </select>
                        <div id="err_branch" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select branch</div>
                    </div>
                    <div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                        <select class="select2" name="dept_id" id="dept_id" >
                            <option value="">Select Department</option>
                        </select>
                        <div id="err_dept" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select department</div>
                    </div>
                    <div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                        <input type="text" class="form-control mydatepicker" name="date" id="date"  placeholder="Select Date" />
                        <div id="err" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select date</div>
                    </div>
                <?php
				}
				if($role==3)
				{
					$this->db->select('dept_id,dept_name');
					$this->db->where('is_deleted','N');
					$this->db->where('branch_id',$this->session->userdata('branch_id'));
					$dept	=	$this->db->get('tbl_department')->result_array();
				?>  
                	<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $this->session->userdata('branch_id'); ?>"  />
                    <div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                        <select class="select2" name="dept_id" id="dept_id" >
                            <option value="">Select Department</option>
                            <?php
							foreach($dept as $row):
							?>
                            <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
                            <?php
							endforeach;
							?>
                        </select>
                        <div id="err_dept" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select department</div>
                    </div>
                    <div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                        <input type="text" class="form-control mydatepicker" name="date" id="date"  placeholder="Select Date" />
                        <div id="err" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select date</div>
                    </div>
                <?php
				}
				if($role>=4)
				{
				?>
                <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $this->session->userdata('branch_id'); ?>"  />
                <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $this->session->userdata('dept_id'); ?>"  />
            	<div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                	<input type="text" class="form-control mydatepicker" name="date" id="date"  placeholder="Select Date" />
                    <div id="err" style="color:#FF0000;display:none;text-align:left;font-size:12px" >Please select date</div>
                </div>
                <?php
				}
				?>
            	<div class="col-md-offset-4 col-md-3 col-md-offset-5" style="text-align:center;padding-top:10px">
                	<button class="btn btn-info btn-sm" onclick="show_summary();">Show</button>
                </div>
            </div>

			<div id="show_summary_div">
            	
            </div>

        </div>
	</div>
</div>    
<br><br><br><br>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>

	function show_summary()
	{
		var branch_id	=	$('#branch_id').val();
		var dept_id		=	$('#dept_id').val();
		var date		=	$('#date').val();
		var count		=	0;
		jQuery('#show_summary_div').html("");
		if($('#branch_id').length>0)
		{
			if(branch_id=='')
			{
				$('#err_branch').show();
				count++;
			}
			else
			{	
				$('#err_branch').hide();
			}
		}
		if($('#dept_id').length>0)
		{
			if(dept_id=='')
			{
				$('#err_dept').show();
				count++;
			}
			else
			{
				$('#err_dept').hide();
			}
		}
		if(date=='')
		{
			$('#err').show();
			count++;
		}
		else
		{
			$('#err').hide();
		}
		if(count>0)
		{
			return false;
		}
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/hourly_attendance/show_attendance_summary/',
			type: "post",
			data: {branch_id:branch_id,dept_id:dept_id,date:date},
            success:function (response)
            {
                jQuery('#show_summary_div').html(response);
            }
        });
		
	}
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#dept_id').html(response);
                jQuery('#dept_id').children('option:first').remove();
                jQuery('#dept_id').prepend('<option value="" selected>Select Department</option>');
            }
        });
    }


</script>



<script type="text/javascript">
    function select_section(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
	
	<?php /*?>$('#radiobutton1').click(function() {
   if($('#radio_button1').is(':checked')) { 
   
    }<?php */?>
});
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#timestamp").keyup(function () {
var a = $("#timestamp").val();
var c= a ;
$("#timestamp1").val(c);

});
});
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript">
function Checklate(val,name){
//alert("hfghfthfdSS");
var res = name.substring(7);
 var element=document.getElementById("late_"+res);
 if(val=='3')
 {
   element.style.display='block';
   
   }
 else  
 {
   element.style.display='none';
   }
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
    <script src="<?php echo base_url(). 'assets/js/sorttable.js'; ?>"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		setTimeout($.unblockUI, 3000); 
}
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','260px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              

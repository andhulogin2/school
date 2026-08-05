<?php 
$role=$this->session->userdata('role');
  include_once APPPATH . 'views/main_head.php';  
?>
<?php 
$running_year = get_running_year();
$cls_row = ($class_id !== '' && $class_id !== null) ? $this->db->get_where('class',array('class_id'=>$class_id,'academic_year'=>$running_year))->row() : NULL;
$cls = ($cls_row) ? $cls_row->name : 'All Classes';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <?php $running_year = get_running_year();?>
 
 

                        
                        
                         
						<div class="breadcrumbs col-md-10" id="breadcrumbs">
                        <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">View Students</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->
</div>
						<!-- /section:basics/content.searchbox -->
					
                        
                        
                        <div class="page-header">
                       <div class="row col-md-10"></div>
                          <div class="pull-right" style="padding-top:20px;padding-right:30px">
                   
                <?php
				if($migrated=='non_migrated')
				{
					?>
					<a href="<?php echo base_url();?>index.php/Admin/student_veiw/non_migrated" ><button class="btn-info">Back</button></a> 
                    <a href="<?php echo base_url();?>index.php/report/student_area_print_report/<?php echo $class_id;?>/non_migrated" ><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a> 
                    <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_pdf/'.$class_id ?>/non_migrated" ><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
                    <?php
				}
				else
				{
					?>
                    <a href="<?php echo base_url();?>index.php/Admin/student_veiw" ><button class="btn-info">Back</button></a> 
                    <a href="<?php echo base_url();?>index.php/report/student_area_print_report/<?php echo $class_id;?>" ><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a> 
                    <a  href="<?php echo base_url() . 'index.php/Report/student_area_print_report_pdf/'.$class_id ?>" ><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
                    <?php
				}
				?>          
                   
               
             
       		
                 		
              </div><br />
							<h1 style="padding-top:5px"><br />
								&nbsp;&nbsp;Students
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Class&nbsp;&nbsp;<?php echo $cls;?>
								
                                
							</h1>
                         
						</div>
                        
                        
      <?php /* echo form_open_multipart('Admin/students_area/'.$class_id, array('class' => 'form-horizontal','id'=>"myform"));?>            
                         <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Sort By:</label>
										<div class="col-sm-3">
											<select name="order" class="col-xs-11 col-sm-11" id="order">
                              <option value="">Select</option>
                              <option value="1">Name</option>
                               <option value="2">Roll No</option>
                          </select>
										</div>
                                        
                                        
                    <div class=" col-sm-3">
						 <a class="btn btn-info" name="btnView" onclick="a(<?php echo $class_id; ?>)">View</a>					
										</div>
                                        
									</div>
                                        
                                        
                                        
                                        
                 <?php // echo form_close();*/?>                       
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
        <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
          
 <div class="row">
  <div class="white-box">
  
            <ul class="nav customtab nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">All Students</span></a></li>
               <?php 
			   $this->db->order_by('name','ASC');
			   if ($class_id !== '' && $class_id !== null) {
			       $this->db->where('class_id', $class_id);
			   }
			   $query = $this->db->get_where('section' , array('academic_year' => $running_year)); 
                if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row2):
					$stud_count	=	$this->crud_model->get_stud_count_in_section($row2['section_id'], $running_year);
				?>
              <li role="presentation" class=""><a href="#<?php echo $row2['section_id'];?>" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Section <?php echo $row2['name'];?>(<?php echo $stud_count; ?>)</span></a></li><?php endforeach;?>
        <?php endif;?>
            </ul>


 <!-- Tab panes -->
 <br />
       

            <div class="tab-content">
            
             		 <div role="tabpanel" class="tab-pane fade active in" id="home">
<div id="roll_list" >  

<div  style="padding-right:50px;float:right"> 
 <label  for="form-field-1">Sort By:</label>
										
                                        <select name="order1" id="order1" class="select2" onchange="order_by_name_1(<?php echo $class_id; ?>);" >
                                        <option value="">Select</option>
                                        <option value="1">Name Ascending</option>
                                        <option value="2">Name Descending</option>
                                         <option value="3">Roll Ascending</option>
                                          <option value="4">Roll Descending</option>
                                           <option value="5">Admission No Ascending</option>
                                            <option value="6">Admission No Descending</option>
                                         <option value="7">Gender</option>
                                        </select>
                                       
								<!--	 <input type="radio" name="name" id="name" onchange="order_by_name_1(<?php echo $class_id; ?>);" />Name -->
                                  <!--   <input type="radio" name="roll" id="roll" onchange="order_by_roll_1(<?php echo $class_id; ?>);"  />Roll No    -->		
                      
 </div>     
             		
      
 	<?php	  
	 $students = $this->crud_model->get_student_area_roll($running_year,$class_id,$order,$migrated);
	 if (!empty($students)) {
         foreach($students as $row):?> 
             <div class="col-md-4 col-sm-4" style="height:200px;">
                <div class="white-box"> 
                    <div class="row">
                     <br /> <br />
                        <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>/<?php echo $class_id;?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                        <div class="col-md-8 col-sm-8">
                          <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>/<?php echo $class_id;?>">
                          
                        <?php 
            echo $row['name'];
            ?></a></h3>
                          <small><?php echo $row['roll'];?></small>
                        </div>
                    </div>
                </div>  
              </div>
         <?php endforeach;
     } else { ?>
         <div class="col-md-12 alert alert-info text-center" style="margin-top: 20px;">
             <h4>No Students Found</h4>
             <p>No active student records found for the selected criteria.</p>
         </div>
     <?php } ?>
                 
                 </div>
                  <div class="clearfix"></div>
              </div>
              

               <?php 
               if ($class_id !== '' && $class_id !== null) {
                   $this->db->where('class_id', $class_id);
               }
               $query = $this->db->get_where('section' , array('academic_year' => $running_year));
                 if ($query->num_rows() > 0){
                 $sections = $query->result_array();
                 foreach ($sections as $row){ ?>
                
                <div role="tabpanel" class="tab-pane fade" id="<?php echo $row['section_id'];?>">
 
 
                <?php
				if($migrated=='non_migrated')
				{
					?>
                        <div style="padding-right:10px;float:right">
                        
                        	<a href="<?php echo base_url();?>index.php/report/student_print_bulk_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Progress Report</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section_pdf/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
                        
                        </div>
                    <?php
				}
				else
				{
					?>
                        <div style="padding-right:10px;float:right">
                        
                        	<a href="<?php echo base_url();?>index.php/report/student_print_bulk_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Progress Report</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>Excel</button></a> 
                        	<a href="<?php echo base_url();?>index.php/report/student_area_print_report_section_pdf/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $order;?>"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i>PDF</button></a> 
                        
                        </div>
                    <?php
				}
				?>          
          <div style="padding-right:50px;float:right"> 
           <label  for="form-field-1">Sort By:</label>
										
                                        <select name="order2_" class="select2" onchange="order_by_name_2(this.value,'<?php echo $class_id ?>','<?php echo $row['section_id']; ?>');" id="order2" >
                                        <option value="">Select</option>
                                        <option value="1">Name Ascending</option>
                                        <option value="2">Name Descending</option>
                                         <option value="3">Roll Ascending</option>
                                          <option value="4">Roll Descending</option>
                                           <option value="5">Admission No Ascending</option>
                                            <option value="6">Admission No Descending</option>
                                         <option value="7">Gender</option>
                                        </select>
									<!-- <input type="radio" name="name" id="name" onchange="order_by_name_2(<?php echo $class_id; ?>);" />Name -->
                                   <!--  <input type="radio" name="roll" id="roll" onchange="order_by_roll_2(<?php echo $class_id; ?>);" />Roll No-->
                                     <input type="hidden" id="section" name="section" value="<?php echo $row['section_id']; ?> " />  
                                     <input type="hidden" id="class_id" name="class_id" value="<?php echo $class_id; ?> " />   		
                       </div>           
                 
            <br />     
        <div> 
         
         
         
         
         
              
              
              <?php $students = $this->db->get_where('enroll' , array(
         'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
		 
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
					
					 if($order==1)
					 {
                     $this->db->order_by('s.name', 'asc');
					 }
					 elseif($order==2)
					 {
                     $this->db->order_by('s.name', 'desc');
					 }	
					 elseif($order==3)
					 {
                     $this->db->order_by('e.roll', 'asc');
					 }	
					 elseif($order==4)
					 {
                     $this->db->order_by('e.roll', 'desc');
					 }	
					  elseif($order==5)
					 {
                     $this->db->order_by('s.admission_number', 'asc');
					 }	
					 elseif($order==6)
					 {
                     $this->db->order_by('s.admission_number', 'desc');
					 }			
					  elseif($order==7)
					 {
                     $this->db->order_by('s.sex', 'asc');
					 }		
					 if($migrated=='non_migrated')
					 {
					 	$this->db->where('e.is_migrated!=','Y');
					 }
					 $this->db->where('e.section_id',$row['section_id']);
                     if ($class_id !== '' && $class_id !== null) {
                         $this->db->where('e.class_id',$class_id);
                     }
					 $this->db->where('e.year',$running_year);
					 
					 $this->crud_model->check_student_status();
					 
                     $query = $this->db->get();
                     $students10 = $query->result_array();
	                
                foreach($students10 as $row2){?>
                <div class="col-md-4 col-sm-4" style="height:200px;">
                     <div class="white-box"> 
                <div class="row">
               <br /> <br />
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>/<?php echo $class_id;?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row2['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><?php echo $row2['name'];?></a></h3>
                      <small><?php echo $row2['roll'];?></small>
                    </div>
                </div>
            </div> 
             
          </div>
         
                  <?php }?> 
                  
            </div>
              
            
                  <!-- <div class="row" style="padding-left:600px">
                  <a href="<?php echo base_url();?>index.php/admin/student_section_print/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Print');?>
			</a>
            
            </div>-->
            
                <div class="clearfix" ></div>
                
              </div>
        <?php }?>
        <?php }?>
        </div></div>
        <div class="pull-right">
        
                <?php
				if($migrated=='non_migrated')
				{
					?>
						<a href="<?php echo base_url();?>index.php/Admin/student_veiw/non_migrated" style="padding-right:20px"><h5>Back</h5></a>
                    <?php
				}
				else
				{
					?>
						<a href="<?php echo base_url();?>index.php/Admin/student_veiw/" style="padding-right:20px"><h5>Back</h5></a>
                    <?php
				}
				?>          
        
                
       		
              </div>
           
<!--           //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
student_bulk_report      -->           <?php /*?><?php echo form_open(base_url() . 'index.php/report/student_print_bulk/'.$class_id); ?>           
                                       <input type="checkbox" id="chk_excel10" name="chk_excel10"  /> Save As Excel &nbsp;&nbsp;&nbsp;
                          
        <button type="submit" class="btn btn-info"><?php echo 'Bulk Profile Report'; ?></button>             
                                                    <?php echo form_close(); ?> <?php */?>
                                                    
<!--      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                              
-->                                                    
         
 <?php echo form_close(); ?></div>
 
 <div></div>
  
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('value') == 'alphabet') {
	      
            $('#alphabet_list').show(); 
			$('#roll_list').hide();           
       }

       if($(this).attr('value') == 'roll') {
	  
            $('#alphabet_list').hide(); 
			$('#roll_list').show();   
       }
	  //  if($(this).attr('value') == 'roll_sec') {
//	  //alert("roll_sec_list");
//            $('#alphabet_sec_list').hide(); 
//			$('#roll_sec_list').show();   
//       }
//	    if($(this).attr('value') == 'alphabet_sec') {
//	 // alert("alphabet_sec_list");
//            $('#roll_sec_list').hide(); 
//			$('#alphabet_sec_list').show();   
//       }
	  ///////////////////////////////////////////////////
	  
	   <?php $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
         foreach ($sections as $row){ ?> 
		     if($(this).attr('value') == '<?php echo $row['section_id'];?>') {
            	if (this.checked) {
			
                 $('#<?php echo $row['section_id']."roll_list";?>').show(); 
			     $('#<?php echo $row['name'];?>').hide(); 
			    } 
              }
		   if($(this).attr('value') == '<?php echo $row['name'];?>') {
	           if (this.checked) {
		
			    $('#<?php echo $row['name'];?>').show();  
                $('#<?php echo $row['section_id']."roll_list";?>').hide(); 
             }
			 
	      }
	 <?php  } ?>
	
	  ////////////////////////////////////////////////////
   });
});
</script>
<script type="text/javascript">
function send_message(){
if($('#alphabet').prop('checked') == true) {
       var grade ='1';
    } else {
        var grade ='0';
    }
}
</script>




<script type="text/javascript">
	function order_by_name_1(class_id) 
	{
	  //alert(class_id);
	 // var order=2;
	 // alert(order);
	  var type = $('#order1').val();
	 // alert(type);
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_filter/' + class_id+'/'+type , 
            success: function(response)
            {
       
				jQuery('#home').html(response);
            }
  });
	  
    }
</script>

<script type="text/javascript">
	function order_by_name_2(type,class_id,section) 
	{
	
	   
	 // var section = $('#section').val();
	  
	//  var class_id = $('#class_id').val();
	  //alert(section);
	 
	
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_name/'+class_id+'/'+type+'/'+section ,
		  
            success: function(response)
            {
       
				jQuery('#'+section).html(response);
            }
  });
	  
    }
</script>



<script type="text/javascript">
	function order_by_roll_1(class_id) 
	{
	 // alert(class_id);
	  var order=1;
	 // alert(order);
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_filter/' + class_id+'/'+order , 
            success: function(response)
            {
       
				jQuery('#home').html(response);
            }
  });
	  
    }
</script>


<script type="text/javascript">
	function order_by_roll_2(class_id) 
	{
	   
	  var section = $('#section').val();
	  var order=1;
	
	  $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area_name/'+class_id+'/'+order+'/'+section ,
		  
            success: function(response)
            {
       
				jQuery('#'+section).html(response);
            }
  });
	  
    }
</script>


<!-- <script type="text/javascript">
	function a(class_id) 
	{
	var order = $('#order').val();
		//alert(order);
		<?php
		$data['class_id']=$class_id;
		
		//redirect(base_url() . 'index.php/Admin/students_area/'.$data['class_id']);
		?>
	
		//window.location="<?php echo base_url().'index.php/Admin/students_area/'.$class_id;?>";
	window.location="<?php echo base_url(); ?>index.php/Admin/students_area/<?php echo $class_id; ?>" ;
    }
</script> -->






<!--<script type="text/javascript">
function a(class_id){

var order = $('#order').val();

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 



	
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/students_area/' + class_id + '/' + order , 
            success: function(response)
            {
			    $.unblockUI();
       
				jQuery('#ajax_view').html(response);
            }
  });
  /*complete(function () {
                $('#preloader_icon').show().delay(2000).fadeOut(300); 
           }, 1000);*/
}
</script>
-->



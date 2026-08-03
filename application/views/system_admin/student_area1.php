<?php include_once APPPATH . 'views/head.php';?>
<?php $cls=$this->db->get_where('class',array('class_id'=>$class_id))->row()->name;?>
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
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
</div>
						<!-- /section:basics/content.searchbox -->
					
                        
                        
                        <div class="page-header">
                       <div class="row col-md-10"></div>
                          <div class="pull-right">
               <a href="<?php echo base_url();?>index.php/report/student_area_print_report/<?php echo $class_id;?>" style="padding-right:20px"><h5><i class="fa fa-file-excel-o" aria-hidden="true"></i>
Download</h5></a> 
       		
              </div><br />
							<h1 style="padding-top:5px"><br />
								&nbsp;&nbsp;Students
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Class&nbsp;&nbsp;<?php echo $cls;?>
								
                                
							</h1>
                         
						</div>
        <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
          
 <div class="row">
  <div class="white-box">
  
            <ul class="nav customtab nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">All Students</span></a></li>
               <?php $query = $this->db->get_where('section' , array('class_id' => $class_id)); 
                if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row2):?>
              <li role="presentation" class=""><a href="#<?php echo $row2['section_id'];?>" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Section <?php echo $row2['name'];?></span></a></li><?php endforeach;?>
        <?php endif;?>
            </ul>


 <!-- Tab panes -->
 <br />
       

            <div class="tab-content">
            
             		 <div role="tabpanel" class="tab-pane fade active in" id="home">
              
              
              
              
              
              	
              
<div id="alphabet_list" style="display:none">       

              
              <?php 
			      
			 $students = $this->crud_model->get_student_area_alphabet($running_year,$class_id);
             foreach($students as $row):?> 
              <div class="col-md-4 col-sm-4">
              <div class="white-box"> 
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>">
					 <?php echo form_open(base_url() . 'index.php/report/student_area_report/'.$row['student_id']); ?> 
					<?php 
		echo $row['name'];
		?></a></h3>
                      <small><?php echo $row['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
                 <?php endforeach;?>
                 </div>
                 
<div id="roll_list" >       

              
              <?php 
			
					echo form_close();
             		
       
 		   $students = $this->crud_model->get_student_area_roll($running_year,$class_id);
					   
            foreach($students as $row):?> 
                <div class="col-md-4 col-sm-4">
            <div class="white-box"> 
                <div class="row">
                 <br /> <br />
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>">
					  
					<?php 
		echo $row['name'];
		?></a></h3>
                      <small><?php echo $row['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
                 <?php endforeach;?>
                 
                 </div>
                  <div class="clearfix"></div>
              </div>
              

              <?php $query = $this->db->get_where('section' , array('class_id' => $class_id));
                if ($query->num_rows() > 0){
                $sections = $query->result_array();
                foreach ($sections as $row){ ?>
                
                <div role="tabpanel" class="tab-pane fade" id="<?php echo $row['section_id'];?>">
 
               <div class="row pull-right" style="padding-left:100px">
              
            <a href="<?php echo base_url();?>index.php/report/student_print_bulk_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>"><p><i class="fa fa-download" aria-hidden="true"></i>
Progress Report</p></a> 
               
                                                    </div>

              <div class="row pull-right">
              <a href="<?php echo base_url();?>index.php/report/student_area_print_report_section/<?php echo $class_id;?>/<?php echo $row['section_id'];?>"><p><i class="fa fa-file-excel-o" aria-hidden="true"></i>
Download</p></a> 


</div>
                 
                 
            <br />     
         <div id="<?php echo $row['section_id']."roll_list";?>"> 
              
              
              <?php $students = $this->db->get_where('enroll' , array(
         'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
		 
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
                     $this->db->order_by('e.roll', 'asc');	
					 $this->db->where('e.section_id',$row['section_id']);
                     $this->db->where('e.class_id',$class_id);
					 $this->db->where('e.year',$running_year);
                     $query = $this->db->get();
                     $students10 = $query->result_array();
		 
                foreach($students10 as $row2){?>
                <div class="col-md-4 col-sm-4">
                     <div class="white-box"> 
                <div class="row">
               <br /> <br />
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row2['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><?php echo $row2['name'];?></a></h3>
                      <small><?php echo $row2['roll'];?></small>
                    </div>
                </div>
            </div> 
             
          </div>
         
                  <?php }?> 
                  
            </div>
              <div id="<?php echo $row['name'];?>" style="display:none" >     
               
              <?php $students = $this->db->get_where('enroll' , array(
         'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
		 
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
                     $this->db->order_by('s.name', 'asc');	
					 $this->db->where('e.section_id',$row['section_id']);
                     $this->db->where('e.class_id',$class_id);
					 $this->db->where('e.year',$running_year);
                     $query = $this->db->get();
                     $students10 = $query->result_array();
                foreach($students10 as $row2){?>
                <div class="col-md-4 col-sm-4">
                     <div class="white-box"> 
                <div class="row">
               
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row2['student_id']);?>" alt="user" class="img-circle img-responsive" height="40px" width="80px"></a></div>
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




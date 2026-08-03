<?php include_once APPPATH . 'views/main_head.php';?>
<?php $cls=$this->db->get_where('class',array('class_id'=>$class_id))->row()->name;?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-header">
							<h1>
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admission Form
								</small>
							</h1>
						</div>


 <?php $running_year = get_running_year();?>
  <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <h1 class="page-title">Students</h1>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/admin_dashboard">Students</a></li>
            <li class="active"><?php echo $cls;?></li>
          </ol>
        
						
                        
      
      
 <div class="row">
 
 
							 <div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<!-- #section:elements.tab -->
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														<span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Student</span></a></li>
               <?php $query = $this->db->get_where('section' , array('class_id' => $class_id)); 
                if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row2):?>
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#<?php echo $row2['section_id'];?>">
														<span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">section<?php echo $row2['name'];?></span></a></li><?php endforeach;?>
        <?php endif;?>
														
													</a>
												</li>

												
   


 <!-- Tab panes -->

     

            <div class="">
            <br><br>
            
              <div role="tabpanel" class="tab-pane fade active in" id="home">
              <input type="radio"  name="radcheck" value="roll" checked="checked"/>Roll No
                &nbsp;&nbsp;
              <input type="radio"  name="radcheck" value="alphabet" > Alphabet

              <div id="alphabet_list" style="display:none">       

              
              <?php 
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
                     $this->db->order_by('s.name', 'asc');	
					
                     $this->db->where('e.class_id',49);
					 $this->db->where('e.year',$running_year);
                     $query = $this->db->get();
                     $students = $query->result_array();
					   
            foreach($students as $row):?> 
                <div class="col-md-12 col-sm-12">
            <div class="white-box"> 
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>"><img src="../../../../login2_school_sc-new/uploads/user.jpg" alt="user" class="img-circle img-responsive"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>">
					 <?php echo form_open(base_url() . 'index.php?report/student_area_report/'.$row['student_id']); ?> 
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
					 $this->db->select('e.student_id,e.roll,s.name as name,');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
                     $this->db->order_by('e.roll', 'asc');	
					
                     $this->db->where('e.class_id',49);
					 $this->db->where('e.year',$running_year);
                     $query = $this->db->get();
                     $students = $query->result_array();
					   
            foreach($students as $row):?> 
                <div class="col-md-4 col-sm-4">
            <div class="white-box"> 
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row['student_id'];?>"><img src="../../../../login2_school_sc-new/uploads/user.jpg" alt="user" class="img-circle img-responsive"></a></div>
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
              

              <?php $query = $this->db->get_where('section' , array('class_id' => 49));
                if ($query->num_rows() > 0){
                $sections = $query->result_array();
                foreach ($sections as $row){ ?>
                <div role="tabpanel" class="tab-pane fade" id="<?php echo $row['section_id'];?>">
 <input type="radio"  name="radcheck1" value="<?php echo $row['section_id'];?>" checked="checked"/>Roll No
                &nbsp;&nbsp;
              <input type="radio"  name="radcheck1" value="<?php echo $row['name'];?>" >Alphabet

              
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
               
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><img src="../../../../login2_school_sc-new/uploads/user.jpg" alt="user" class="img-circle img-responsive"></a></div>
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
               
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><img src="../../../../login2_school_sc-new/uploads/user.jpg" alt="user" class="img-circle img-responsive"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $row2['student_id'];?>"><?php echo $row2['name'];?></a></h3>
                      <small><?php echo $row2['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
         
                  <?php }?> 
            </div>
                   <div class="row" style="padding-left:600px">
                  <a href="<?php echo base_url();?>index.php/admin/student_section_print/<?php echo $class_id;?>/<?php echo $row['section_id'];?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Print');?>
			</a>
            
            </div>
             <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
                          
        <button type="submit" class="btn btn-info"><?php echo 'Show Report'; ?></button>
                <div class="clearfix" ></div>
              </div>
        <?php }?>
        <?php }?>
           </div>
         </div>
       </div>
    </div>
</div>
 <?php echo form_close(); ?>

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
			jQuery(function($) {
				/**
				$('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				  //console.log(e.target.getAttribute("href"));
				})
					
				$('#accordion').on('shown.bs.collapse', function (e) {
					//console.log($(e.target).is('#collapseTwo'))
				});
				*/
				
				$('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
					//if($(e.target).attr('href') == "#home") doSomethingNow();
				})
			
				
				/**
					//go to next tab, without user clicking
					$('#myTab > .active').next().find('> a').trigger('click');
				*/
			
			
				$('#accordion-style').on('click', function(ev){
					var target = $('input', ev.target);
					var which = parseInt(target.val());
					if(which == 2) $('#accordion').addClass('accordion-style2');
					 else $('#accordion').removeClass('accordion-style2');
				});
				
				//$('[href="#collapseTwo"]').trigger('click');
			
			
				var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
				$('.easy-pie-chart.percentage').each(function(){
					$(this).easyPieChart({
						barColor: $(this).data('color'),
						trackColor: '#EEEEEE',
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 8,
						animate: oldie ? false : 1000,
						size:75
					}).css('color', $(this).data('color'));
				});
			
				$('[data-rel=tooltip]').tooltip();
				$('[data-rel=popover]').popover({html:true});
			
			
				$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar1.png', //in Ace demo ../assets will be replaced by correct assets path
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
			
					return false;
				});
			
				$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: '../assets/avatars/avatar3.png', //in Ace demo ../assets will be replaced by correct assets path
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
					
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
					
			
				///////
			
			
				$("#bootbox-regular").on(ace.click_event, function() {
					bootbox.prompt("What is your name?", function(result) {
						if (result === null) {
							
						} else {
							
						}
					});
				});
					
				$("#bootbox-confirm").on(ace.click_event, function() {
					bootbox.confirm("Are you sure?", function(result) {
						if(result) {
							//
						}
					});
				});
				
			/**
				$("#bootbox-confirm").on(ace.click_event, function() {
					bootbox.confirm({
						message: "Are you sure?",
						buttons: {
						  confirm: {
							 label: "OK",
							 className: "btn-primary btn-sm",
						  },
						  cancel: {
							 label: "Cancel",
							 className: "btn-sm",
						  }
						},
						callback: function(result) {
							if(result) alert(1)
						}
					  }
					);
				});
			**/
					
				$("#bootbox-options").on(ace.click_event, function() {
					bootbox.dialog({
						message: "<span class='bigger-110'>I am a custom dialog with smaller buttons</span>",
						buttons: 			
						{
							"success" :
							 {
								"label" : "<i class='ace-icon fa fa-check'></i> Success!",
								"className" : "btn-sm btn-success",
								"callback": function() {
									//Example.show("great success");
								}
							},
							"danger" :
							{
								"label" : "Danger!",
								"className" : "btn-sm btn-danger",
								"callback": function() {
									//Example.show("uh oh, look out!");
								}
							}, 
							"click" :
							{
								"label" : "Click ME!",
								"className" : "btn-sm btn-primary",
								"callback": function() {
									//Example.show("Primary button");
								}
							}, 
							"button" :
							{
								"label" : "Just a button...",
								"className" : "btn-sm"
							}
						}
					});
				});
			
			
			
				$('#spinner-opts small').css({display:'inline-block', width:'60px'})
			
				var slide_styles = ['', 'green','red','purple','orange', 'dark'];
				var ii = 0;
				$("#spinner-opts input[type=text]").each(function() {
					var $this = $(this);
					$this.hide().after('<span />');
					$this.next().addClass('ui-slider-small').
					addClass("inline ui-slider-"+slide_styles[ii++ % slide_styles.length]).
					css('width','125px').slider({
						value:parseInt($this.val()),
						range: "min",
						animate:true,
						min: parseInt($this.attr('data-min')),
						max: parseInt($this.attr('data-max')),
						step: parseFloat($this.attr('data-step')) || 1,
						slide: function( event, ui ) {
							$this.val(ui.value);
							spinner_update();
						}
					});
				});
			
			
			
				//CSS3 spinner
				$.fn.spin = function(opts) {
					this.each(function() {
					  var $this = $(this),
						  data = $this.data();
			
					  if (data.spinner) {
						data.spinner.stop();
						delete data.spinner;
					  }
					  if (opts !== false) {
						data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
					  }
					});
					return this;
				};
			
				function spinner_update() {
					var opts = {};
					$('#spinner-opts input[type=text]').each(function() {
						opts[this.name] = parseFloat(this.value);
					});
					opts['left'] = 'auto';
					$('#spinner-preview').spin(opts);
				}
			
			
			
				$('#id-pills-stacked').removeAttr('checked').on('click', function(){
					$('.nav-pills').toggleClass('nav-stacked');
				});
			
				
				
				
				
				
				///////////
				$(document).one('ajaxloadstart.page', function(e) {
					$.gritter.removeAll();
					$('.modal').modal('hide');
				});
			
			});
		</script>




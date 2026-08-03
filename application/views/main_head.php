<?php
$role=$this->session->userdata('role');
$is_class_teacher  =   $this->session->userdata('is_class_teacher');
if($role==12)
{
	include_once APPPATH . 'views/head_master_head.php';  
}
else if($role<=4)
{
	include_once APPPATH . 'views/head.php';
}
else if($role==5)
{
	include_once APPPATH . 'views/class_teacher_head.php';
}
else if($role==6 && $is_class_teacher=='Y')
{
	include_once APPPATH . 'views/class_teacher_head.php';
}
else if($role==6 && $is_class_teacher=='N')
{
	include_once APPPATH . 'views/teacher_head.php';
}
else if($role==13)
{
  include_once APPPATH . 'views/pta_head.php';  
}
else if($role==14)
{
  include_once APPPATH . 'views/management_head.php';  
}
else if($role==15)
{
  include_once APPPATH . 'views/clerk_head.php';  
}
else if($role==16)
{
  include_once APPPATH . 'views/view_report_head.php';  
}
else
{
	include_once APPPATH . 'views/head.php';
}

?>
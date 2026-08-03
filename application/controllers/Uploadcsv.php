<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Uploadcsv extends CI_Controller {
public function __construct()
{
    parent::__construct();
    $this->load->helper('url');                    
    $this->load->model('crud_model');
}
	//////////////////Import subscriber emails ////////////////////////////////
public function importbulkemail(){
	$this->load->view('excelimport');
}
public function import()
        {
  if(isset($_POST["import"]))
    {
	
	  $running_year = get_running_year();
	    				$class_id=$this->input->post('class_id');
						$section_id=$this->input->post('section_id');
						
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
            $file = fopen($filename, "r");
			
			$i=1;
			
             while (($importdata = fgetcsv($file)) !== FALSE)
             {
			    if($i>3){
				
				
				        $data2['user_role_id']  =  "10";
						$data2['created_by']    =  $this->session->userdata('login_user_id');
						$data2['created_date']  =  date('Y-m-d');
						$data2['is_deleted']    =  "N";
						$data2['username']      =  $importdata[4];
						$data2['password']      =  sha1($importdata[4]);
						$data2['branch_id']     =  $this->session->userdata('branch_id');
						$data2['dept_id']       =  $this->session->userdata('dept_id');
						$user_id = $this->crud_model->insert_user_data($data2);
						
                     	$data['name'] 		= $importdata[0];
						$data['birthday']	= $importdata[1];
                        $data['sex'] 		= $importdata[2];
						$data['address'] 	= $importdata[3];
						$data['phone1'] 	= $importdata[4];
						$data['phone2'] 	= $importdata[5];
						$data['email'] 		= $importdata[6];
						$data['parent'] 	= $importdata[7];
						$data['admission_number'] 	= $importdata[8];
						$data['user_id']    = $user_id;
						$data['branch_id'] =  $this->session->userdata('branch_id');
						$data['dept_id']   =  $this->session->userdata('dept_id');
                        $data['date'] 		= strtotime(date("d M,Y"));
						if($data['name']!='' && $data['phone1']!=''){
						$insert = $this->crud_model->insertCSV($data);
						 	
						 $data1['student_id']=$insert;
						$data1['class_id']=$class_id;
	    				$data1['section_id']=$section_id;
						$data1['roll']=$importdata[9];
						$data1['date_added']=strtotime(date("d M,Y"));
						$data1['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
				        $data1['year']           = $running_year;

						$insert = $this->crud_model->insertenroll($data1);
						 
						}
						}
						$i++;
             
             }                    
            fclose($file);
          }
		}
		redirect('admin/students_area/'.$class_id);

   
							           


}


/////////////////////////////////Import subscriber emails ////////////////////////////////

}


















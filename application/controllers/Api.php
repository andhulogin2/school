<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL & ~E_NOTICE);
        $this->load->database();
        $this->load->model('Api_model');
        $this->load->helper('form');
    }
    
    /********** This file is for dept_admin app ****************/
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * PLEASE WRITE ALL NEW FUNCTIONS BELOW THIS LINE
     * ALSO, WRITE NEW FUNCTIONS AT THE TOP (BELOW THIS LINE)
     * */
     
    function send_sms()
    {
        /*
         * WOLF, 15:45, 2019-05-31
         * */
        /*
         * These constants are defined for this function
         * define('SMS_TYPE_LOGIN', 0);
            define('SMS_TYPE_STUDENT_NOTIFICATION', 1);
            define('SMS_TYPE_STAFF_NOTIFICATION', 2);
            define('SMS_AUDIENCE_SCHOOL', 0);
            define('SMS_AUDIENCE_CLASS', 1);
            define('SMS_AUDIENCE_STUDENT', 2);
         * */

        /*
         * TEST URLS
         *
         * 1 - Login Details    :  http://login2.co.in/schoolnishin/index.php/api/send_sms?audience=-1&user_id=4&ids=0-148-149-150&type=0&message=
         *
         * 2 - Student Notification
         *      2.1 -   Whole school        :    http://login2.co.in/schoolnishin/index.php/api/send_sms?audience=0&user_id=4&ids=&type=1&message=SMSContent
         *      2.2 -   Selected Classes    :    http://login2.co.in/schoolnishin/index.php/api/send_sms?audience=1&user_id=4&ids=0-2-1-6-7-14-15&type=1&message=SMSContent
         *      2.3 -   Selected Students   :    http://login2.co.in/schoolnishin/index.php/api/send_sms?audience=2&user_id=4&ids=0-1-3-7-8-9&type=1&message=SMSContent
         * 3 - Staff Notification   :   http://login2.co.in/schoolnishin/index.php/api/send_sms?audience=-1&user_id=4&ids=5-6-7-8-10-11&type=2&message=SMSContent
         * */
        $user_id            =   $this->get("user_id");
        $type               =   $this->get("type");
        $audience           =   $this->get("audience"); // Used for student notification only
        $message            =   $this->get("message");
        $ids                =   $this->get("ids");
        date_default_timezone_set("Asia/Kolkata");
        
        $running_year       =   get_running_year();
    	$sms                =   $this->db->get('sms_settings')->row();
    	$sender_id          =   $sms->sender_id;
    	$username           =   $sms->username;
    	$password           =   $sms->password;
    	$common             =   $sms->common_word;
    	$url                =   $sms->url;
        $web_url            =   $sms->web_url;
        
        $staff_id           =   $this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
        $data['send_by']	=   $staff_id;
        $data['send_date']	=   date('Y/m/d H:i:s ');
        
        $user_det           =   $this->Api_model->get_user_details($user_id);
        $branch_id          =   $user_det->branch;
        $dept_id            =   $user_det->dept;
        //echo "branch id=".$branch_id;
        //echo "dept id=".$dept_id;die;
        if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
        {
            $c= '1';
        }
        else
        {
            $c= '0';
        }
        if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
        {
            $n= '1';
        }
        else
        {
            $n= '0';
        }
        
        
        switch ($type) {
            case SMS_TYPE_LOGIN:
                {
                    $student_ids = $this->get_ids($ids);
                    if (null != $student_ids) {
                        /*
                         * Here you have student ids in array,
                         * send login details to all students in the array
                         * */

                        //Insert to master
                        $data['content']    =   "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from school.login2.in site  with following details.username () and password ()";
                        $this->db->insert('tbl_sms_delivery_master',$data);
                        $master_id		    =	$this->db->insert_id();
                        
                        $this->db->select('s.phone1,s.name,s.student_id');
                        $this->db->from('student s');
                        $this->db->where_in('student_id',$student_ids);
                        $students=$this->db->get()->result_array();

                        
                        //Insert to details
                        foreach($students as $b)
                        {
                            $data1['sms_master_id']	=   $master_id;
                            $data1['student_id']	=   $b['student_id'];
                            $data1['class_id']	    =   get_student_class_id($b['student_id']);
                            $data1['section_id']	=   get_student_section_id($b['student_id']);
                            $data1['phone']	        =   $b['phone1'];
                            $content                =   "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$b['phone1']." and password ".$b['phone1']."";
                            
                            
                            $data1['msg_content']   =   " Hi ".$b['name'].' '.$content." ";
                            
                            $data1['send_date']	    =   date('Y/m/d H:i:s ');
                            $this->db->insert('tbl_sms_delivery_details',$data1);
                        }
                         
                        //Get from details table and send sms
                    	$i                          =   0;
                    	$this->db->select('details_id,d.student_id,phone,s.name as student_name');
                    	$this->db->from('tbl_sms_delivery_details d');
                    	$this->db->join('student s','s.student_id=d.student_id','LEFT');
                    	$this->db->where('sms_master_id',$master_id);
                    	$a=$this->db->get()->result_array();
                    	
                    	foreach($a as $b)
                    	{
                        	$phone1                     =   $b['phone']; 
                        	$student_name               =   $b['student_name']; 
                    	    $message                    =   "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$b['phone']." and password ".$b['phone']."";
                    	
                    	    $location                   =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone1.'&msg=' . urlencode($common . " " .$message ) . '&route=T';
                        	$api                        =   $url;
                    	
                        	$handle                     =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
                        	$balance                    =   stream_get_contents($handle);
                        	if ($balance >= 0) 
                        	{
                            	$api . "/sendsms?" . $location;
                            	$send                   =   fopen($api . "/sendsms?" . $location, "r");
                            	$api . "/sendsms?" . $location;

                            	$return_message_ids     =   stream_get_contents($send);
                            	$message_id_array       =   explode(",", $return_message_ids);

                            	$str                    =   filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
                            	$sms_data['msg_code']	=	$str;
                            	$sms_data['processed']	=	1;
                            	$this->db->where('details_id',$b['details_id']);
                            	$this->db->update('tbl_sms_delivery_details',$sms_data);
                            	$i++; 
                        	}
                    	}
                                            
                    }
                    break;
                }
            case SMS_TYPE_STUDENT_NOTIFICATION:
                {
                    if (SMS_AUDIENCE_SCHOOL == $audience) {
                        // Send $message to all students in the school
                        // Ids will be empty
                        
                        $data['content']	=   $message;
                        
                        $this->db->insert('tbl_sms_delivery_master',$data);
                        $master_id		    =	$this->db->insert_id();
                        
                                    
            			$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
            			$this->db->from('student s');
            			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
            			$this->db->where('e.year',$running_year);
            			$this->crud_model->check_student_status();
            			$this->db->where('s.branch_id',$branch_id);
            			$this->db->where('s.dept_id',$dept_id);
            			$a                  =   $this->db->get()->result_array();
            			//echo $this->db->last_query();die;
            			foreach($a as $b)
            			{
            				$data1['sms_master_id'] =   $master_id;
            				$data1['student_id']	=   $b['student_id'];
            				$data1['class_id']	    =   $b['class'];
            				$data1['section_id']	=   $b['section'];
            				$data1['phone']	        =   $b['phone1'];
            				
            				$data1['msg_content']	=   $this->sms_helper($common,$c,$n,$b['name'],$message);
            				$data1['send_date']	    =   date('Y/m/d H:i:s');
            				$this->db->insert('tbl_sms_delivery_details',$data1);
            				/*if($phone2==1)
            				{
            					if($b['phone2']!='')
            					{
            						$data1['phone'] =   $b['phone2'];    
            						$this->db->insert('tbl_sms_delivery_details',$data1);
            					}
            				}*/
            	        }
                        /*                            
                        $this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
                        $this->db->from('tbl_sms_delivery_details a');
                        $this->db->where('sms_master_id',$master_id);
                        $stu                =   $this->db->get()->result_array();
                        $i                  =   0;
                        
                        foreach($stu as $b)
                        {
                            $ph             =   $b['ph'];
                            $message        =   $b['msg_content'];
                            if($b['processed']==0)
                            {
                                $location                   =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
                                $api                        =   $url;
                                $handle                     =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
                                $balance                    =   stream_get_contents($handle);
                                if ($balance >= 0) 
                                {
                                    $api . "/sendsms?" . $location;
                                    $send                   =   fopen($api . "/sendsms?" . $location, "r");
                                    $api . "/sendsms?" . $location;
                            
                                    $return_message_ids     =   stream_get_contents($send); // It is a number. If invalid mob, then its value is 'Enter valid MobileNo'
                                    $message_id_array       =   explode(",", $return_message_ids);
                            
                                    $str                    =   filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); //If $return_message_ids is string,this will not print anything. Otherwise it's value will be same as $return_message_ids 
                                    $sms_data['msg_code']	=	$str; // If phone number is invalid,this field will be blank
                                    $sms_data['processed']	=	1;
                                    $this->db->where('details_id',$b['details_id']);
                                    $this->db->update('tbl_sms_delivery_details',$sms_data);
                                    $i++;
                                }            
                            }            
                        }
                        */
                        
                        
                    } else if (SMS_AUDIENCE_CLASS == $audience) {
                        $section_ids = $this->get_ids($ids);
                        if (null != $section_ids) {
                            /*
                             * Here you have class ids in array,
                             * Find all students in those classes and send $message
                             * */
                            
                            $i=0;
                            $data['content']	=   $message;
                            
                            $this->db->insert('tbl_sms_delivery_master',$data);
                            $master_id		    =	$this->db->insert_id();
                            
                            $this->db->select('s.phone1,s.name,s.student_id,e.class_id as class,e.section_id as section');
                            $this->db->from('student s');
                            $this->db->join('enroll e','e.student_id=s.student_id','LEFT'); 
                            $this->db->where_in('e.section_id',$section_ids);
                            $this->db->where('e.year',$running_year);
                            $this->crud_model->check_student_status();
                            $a=$this->db->get()->result_array();//echo $this->db->last_query();die();
                           
                            foreach($a as $b)
                            {
                            
                                $data1['sms_master_id'] =   $master_id;
                                $data1['student_id']	=   $b['student_id'];
                                
                                $data1['class_id']	    =   $b['class'];
                                $data1['section_id']	=   $b['section'];
                                $data1['phone']	        =   $b['phone1'];
                                $data1['msg_content']	=   $this->sms_helper($common,$c,$n,$b['name'],$message);
                                $data1['send_date']	    =   date('Y/m/d H:i:s');
                                $this->db->insert('tbl_sms_delivery_details',$data1);

                            }
                            $this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
                            $this->db->from('tbl_sms_delivery_details a');
                            $this->db->where('sms_master_id',$master_id);
                            $a=$this->db->get()->result_array();
                            $i                          =   0;

                            foreach($a as $b)
                            {
                                $ph                         =   $b['ph'];
                                $message                    =   $b['msg_content'];
    
                                if($b['processed']==0)
                                {
                                    $location               =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
                                    $api                    =   $url;
                                    $handle                 =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
                                    $balance                =   stream_get_contents($handle);
                                    if ($balance >= 0) 
                                    {
                                        $api . "/sendsms?" . $location;
                                        $send = fopen($api . "/sendsms?" . $location, "r");
                                        $api . "/sendsms?" . $location;
                                        
                                        $return_message_ids =   stream_get_contents($send); // It is a number. If invalid mob, then its value is 'Enter valid MobileNo'
                                        $message_id_array   =   explode(",", $return_message_ids);
                                        
                                        $str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); //If $return_message_ids is string,this will not print anything. Otherwise it's value will be same as $return_message_ids 
                                        $sms_data['msg_code']	=	$str; // If phone number is invalid,this field will be blank
                                        $sms_data['processed']	=	1;
                                        $this->db->where('details_id',$b['details_id']);
                                        $this->db->update('tbl_sms_delivery_details',$sms_data);
                                        $i++;
                                    }
                                
                                }
                            }
                        }

                    } else {
                        $student_ids = $this->get_ids($ids);
                        if (null != $student_ids) {
                            /*
                             * Here you have student ids in array,
                             * send $message to all students in the array
                             * */
                            
                            $data['content']	=   $message;
                            $this->db->insert('tbl_sms_delivery_master',$data);
                            $master_id		    =	$this->db->insert_id();

                            $this->db->select('s.phone1,s.name,s.student_id,e.class_id as class,e.section_id as section');
                            $this->db->from('student s');
                            $this->db->join('enroll e','e.student_id=s.student_id','LEFT'); 
                            $this->db->where_in('s.student_id',$student_ids);
                            $this->db->where('e.year',$running_year);
                            $this->crud_model->check_student_status();
                            $a=$this->db->get()->result_array();//echo $this->db->last_query();die();
                           
                            foreach($a as $b)
                            {
                            
                                $data1['sms_master_id'] =   $master_id;
                                $data1['student_id']	=   $b['student_id'];
                                $data1['class_id']	    =   $b['class'];
                                $data1['section_id']	=   $b['section'];
                                $data1['phone']	        =   $b['phone1'];
                                $data1['msg_content']	=   $this->sms_helper($common,$c,$n,$b['name'],$message);
                                $data1['send_date']	    =   date('Y/m/d H:i:s');
                                $this->db->insert('tbl_sms_delivery_details',$data1);

                            }
                            $this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
                            $this->db->from('tbl_sms_delivery_details a');
                            $this->db->where('sms_master_id',$master_id);
                            $a=$this->db->get()->result_array();
                            $i=0;
                            foreach($a as $b)
                            {
                                $ph                         =   $b['ph'];
                                $message                    =   $b['msg_content'];

                                if($b['processed']==0)
                                {
                                    $location               =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
                                    $api                    =   $url;
                                    $handle                 =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
                                    $balance                =   stream_get_contents($handle);
                                    if ($balance >= 0) 
                                    {
                                        $api . "/sendsms?" . $location;
                                        $send               =   fopen($api . "/sendsms?" . $location, "r");
                                        $api . "/sendsms?" . $location;
                                        
                                        $return_message_ids =   stream_get_contents($send); 
                                        $message_id_array   =   explode(",", $return_message_ids);
                                        
                                        $str                    =   filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); 
                                        $sms_data['msg_code']	=	$str; 
                                        $sms_data['processed']	=	1;
                                        $this->db->where('details_id',$b['details_id']);
                                        $this->db->update('tbl_sms_delivery_details',$sms_data);
                                        $i++;
                                    }
                            
                                }
                            }
                        }
                    }
                    break;
                }
            case SMS_TYPE_STAFF_NOTIFICATION:
                {
                    $staff_ids = $this->get_ids($ids);
                    if (null != $staff_ids) {
                        /*
                         * Here you have staff ids in array,
                         * Send $message to all staffs in the array
                         * */
                        $data['content']	            =   $message;
                        $this->db->insert('tbl_sms_delivery_master',$data);
                        $master_id		                =	$this->db->insert_id();
                        
        				$this->db->select('s.phone,s.name,s.staff_id');
        				$this->db->from('staff s');
        				$this->db->where_in('s.staff_id',$staff_ids);
        				$a                              =   $this->db->get()->result_array();
        				
        				foreach($a as $b)
        				{
        					if($b['phone']>0)
        					{
        						$data1['sms_master_id']	=   $master_id;
        						$data1['student_id']	=   $b['staff_id'];
        						$data1['phone']	        =   $b['phone'];
        						$data1['msg_content']	=   $this->sms_helper($common,$c,$n,$b['name'],$message);
        					}
        				    $data1['send_date']	            =   date('Y/m/d H:i:s');
        				    $this->db->insert('tbl_sms_delivery_details',$data1);
        				}
                        $this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
                        $this->db->from('tbl_sms_delivery_details a');
                        $this->db->where('sms_master_id',$master_id);
                        $a=$this->db->get()->result_array();
                        $i=0;
                        foreach($a as $b)
                        {
                            $ph                         =   $b['ph'];
                            $message                    =   $b['msg_content'];

                            if($b['processed']==0)
                            {
                                $location               =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
                                $api                    =   $url;
                                $handle                 =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r"); 
                                $balance                =   stream_get_contents($handle);
                                if ($balance >= 0) 
                                {
                                    $api . "/sendsms?" . $location;
                                    $send               =   fopen($api . "/sendsms?" . $location, "r");
                                    $api . "/sendsms?" . $location;
                                    
                                    $return_message_ids =   stream_get_contents($send); 
                                    $message_id_array   =   explode(",", $return_message_ids);
                                    
                                    $str                    =   filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); 
                                    $sms_data['msg_code']	=	$str; 
                                    $sms_data['processed']	=	1;
                                    $this->db->where('details_id',$b['details_id']);
                                    $this->db->update('tbl_sms_delivery_details',$sms_data);
                                    $i++;
                                }
                        
                            }
                        }
                    }
                    break;
                }
        }
        $this->send_response("",true); // Send true only when success
    }
    
    function sms_helper($common_word,$c,$n,$name,$content)
    {
        if($c==1 && $n==1)
        $message = $common_word. ' Hi ' .$name.' ' .$content.'.';  
        if($c==1 && $n==0)
        $message = $common_word. ' Hi ' .$content.'.'; 
        if($c==0 && $n==1)
        $message = 'Hi ' .$name.' ' .$content.' '.$common_word.'.' ;  
        if($c==0 && $n==0)
        $message = 'Hi ' .$content.' '.$common_word.'.';
        return $message; 
    }

    private function get_ids($ids_string)
    {
        if (null != $ids_string) {
            if (strpos($ids_string, '-') !== false) {
                return explode("-", $ids_string);
            } else {
                return array($ids_string);
            }
        }
        return null;
    }

    public function get_receipt_details()
    {
        /*
         * Mani,23-05-2019 14:41
         */
        $receipt_num = $this->get("receipt_num");
        $this->send_response($this->Api_model->get_receipt_details($receipt_num));
    }

    public function update_concession()
    {
        //
        //Sanal
        //20-04-2019

        $data = json_decode(file_get_contents('php://input'), true);

        $this->send_response($this->Api_model->update_concession($data));
    }

    public function insert_fee()
    {
        //
        //Sanal
        //20-04-2019

        $data = json_decode(file_get_contents('php://input'), true);

        $user_id = $data['user_id'];
        $student_id = $data['student_id'];
        $date_paid = $this->get_ymd($data['date_paid']);
        $payment_mode = $data['payment_mode'];
//        $master = json_decode($data['master'],true); // this is an array.
        $master = $data['master']; // this is an array.
        //print_r($master);die;
        $this->send_response($this->Api_model->insert_fee($user_id, $student_id, $date_paid, $payment_mode, $master));
    }

    /* public function insert_fee()
     {
         //
         //Sanal
         //20-04-2019

         $data = json_decode(file_get_contents('php://input'), true);

         $user_id = $data['user_id'];
         $student_id = $data['student_id'];
         $section_id = $this->Api_model->student_details($student_id)->section_id;


         $receipt_number = -1;
 //     @SANAL - Get this from table, not from app-->   $receipt_number = $data['receipt_number'];


         $date_paid = $this->get_ymd($data['date_paid']);
         $payment_mode = $data['payment_mode'];
 //        $master = json_decode($data['master'],true); // this is an array.
         $master = $data['master']; // this is an array.
         $this->send_response($this->Api_model->insert_fee($user_id, $student_id, $section_id, $receipt_number, $date_paid, $payment_mode, $master));
     }*/

    public function payment_history()
    {
        //
        //Sanal
        //16-04-2019
        $student_id = $this->get("student_id");
        $this->send_response($this->Api_model->payment_history($student_id));
    }

    public function student_fee_details()
    {
        //
        //Sanal
        //16-04-2019
        $student_id = $this->get("student_id");
        $this->send_response($this->Api_model->student_fee_details($student_id));
    }

    public function list_staff()
    {
        //
        //Sanal
        //13-04-2019  12:35 PM
        $user_id = $this->get('user_id');
        $this->send_response($this->Api_model->list_staff($user_id));
    }

    public function list_sections()
    {
        //
        //Sanal
        //13-04-2019  12:09 PM
        $class_id = $this->get('class_id');
        $this->send_response($this->Api_model->list_sections($class_id));
    }

    public function student_details()
    {
        $student_id = $this->get('student_id');
        $this->send_response($this->Api_model->student_details($student_id));
    }

    public function class_details()
    {
        $user_id = $this->get('user_id');
        $section_id = $this->get('section_id');
        $this->send_response($this->Api_model->class_details($user_id, $section_id));
    }

    public function class_teacher()
    {
        $user_id = $this->get('user_id');
        $section_id = $this->get('section_id');
        $this->send_response($this->Api_model->class_teacher($user_id, $section_id));
    }

    public function attendance_details()
    {   //echo $this->get_ymd("28/06/2019");
        //date_default_timezone_set("Asia/Kolkata");
        //$data = $this->Api_model->attendance_details("4", $this->get_ymd("28/06/2019"), "1", "5");
        //print_r($data);die;
        $user_id = $this->get('user_id');
        $date = $this->get_ymd($this->get('date'));
        $time_of_day = $this->get('time_of_day') == 1 ? "morning" : "afternoon"; //Assuming, 1 = Morning, 2 = afternoon
        $section_id = $this->get('section_id');
        $data = $this->Api_model->attendance_details($user_id, $date, $time_of_day, $section_id);
        if (sizeof($data) > 0) {
            $this->send_response($data);
        } else {

            $students = $this->Api_model->list_students($section_id);
            $attendance = array();
            foreach ($students as $row) {
                $student['student_id'] = $row->student_id;
                $student['status'] = 0;
                array_push($attendance, $student);
            }
            $this->Api_model->insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance);
            $data = $this->Api_model->attendance_details($user_id, $date, $time_of_day, $section_id);
            $this->send_response($data);
        }

    }

    public function search()
    {
        $user_id = $this->get('user_id');
        $keyword = $this->get('keyword');
        $this->send_response($this->Api_model->search($user_id, $keyword));
    }

    public function insert_attendance()
    {
        // * Sanal, 2019 03 26, 14 :34
        // *
        //date_default_timezone_set("Asia/Kolkata");
        $data = json_decode(file_get_contents('php://input'), true);

        $user_id = $data['user_id'];
        $send_absent = $data['send_absent'];
        $send_present = $data['send_present'];
        $date = $this->get_ymd($data['date']);//echo $date;die;
        $time_of_day = $data['time_of_day'] == 1 ? "morning" : "afternoon"; //Assuming, 1 = Morning, 2 = afternoon
        $section_id = $data['section_id'];
        $attendance = json_decode($data['attendance'], true); // this is an array. Loop through it to get student status
//        $attendance = $data['attendance']; // this is an array. Loop through it to get student status
        $this->send_response($this->Api_model->insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance,$send_absent));
    }

    public function list_students()
    {
        //* Sanal, 2019 03 23, 16:42
        //*

        $section_id = $this->get('section_id');
        $this->send_response($this->Api_model->list_students($section_id));
    }

    public function list_class()
    {
        /*
       * WOLF, 2019 03 23, 16:42
       * */
        $user_id = $this->get('user_id');
        $this->send_response($this->Api_model->list_class($user_id));
    }

    public function login()
    {
        /*
         * WOLF, 2019 03 23, 12:10
         * */
        $username = $this->get('username'); // Use $this->get('param'); to get parameters. Don't use $_GET['param'] or $_POST['param'] or $_REQUEST['param']
        $password = $this->get('password');
        $user_id = $this->Api_model->login($username, $password);
        $status = $user_id > 0; // If invalid user, user id is -1, so status false. Else userid will be greater than 0 so status will be true
        $message = $status ? "Success" : "Invalid username or password";
        $data['user_id']    =   $user_id;
        $data['half_day']   =   $this->Api_model->get_settings_table("half_day_leave")=="yes"?true:false;
        $data['attendance']   =   $this->Api_model->get_settings_table("afternoon_attendance")=="yes"?"2":"1";
        $data['no_diary']   =   $this->Api_model->get_settings_table("diary")=="1"?true:false;
        $this->send_response($data, $status, $message);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * $ - HELPER FUNCTIONS -$
     * DO NOT WRITE API FUNCTIONS BELOW THIS AREA
     * USE THIS AREA FOR HELPER FUNCTIONS ONLY
     * */

    public
    function send_response($data, $status = true, $message = "")
    {
        //DO NOT CHANGE THIS FORMAT
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private
    function get($key)
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        } else {
            return null;
        }
    }

    public
    function index()
    {
        $this->send_response(date('H:i:s d-m-Y'), true, 'Login2 School Admin :)');
    }

    public
    function test()
    {
        $name = $this->get('name');
        $this->send_response($this->api_model->test_api($name));
    }

    private
    function get_ymd($date)
    {
        if (null != $date && "" != $date) {
            $date = date('Y-m-d', strtotime(str_replace("/", "-", $date)));
        } else {
            $date = null;
        }
        return $date;
    }

}

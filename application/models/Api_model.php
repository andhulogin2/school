<?php

class Api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function test_api($message)
    {
        return 'API_MODEL ' . $message;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * PLEASE WRITE ALL NEW FUNCTIONS BELOW THIS LINE
     * ALSO, WRITE NEW FUNCTIONS AT THE TOP (BELOW THIS LINE)
     * */
    public function get_settings_table($type="")
    {
        return $this->db->get_where('settings',array('type'=>$type))->row()->description;
    }

    public function get_receipt_details($receipt_num)
    {
        /*
         * Mani,23-05-2019 14:41
         */
        $this->db->select('DATE_FORMAT(a.date_paid,"%d-%m-%Y") as receipt_date,a.receipt_number,a.fee_collection_master_id,b.name as student_name,b.class_name as class,b.section_name as section,(select description from settings where type="system_name") as school_name,(select description from settings where type="phone") as phone,(select SUM(fee_amount) from tbl_fee_collection_details where fee_collection_master_id=a.fee_collection_master_id) as total_amount');
        $this->db->join('view_students b', 'b.student_id=a.admission_number');
        $this->db->where('a.receipt_number', $receipt_num);
        $col_master = $this->db->get('tbl_fee_collection_master a')->result_array();//echo $this->db->last_query();die;
        //print_r($col_master);die;
        $arr = array();
        foreach ($col_master as $row):
            $this->db->select('fee_head as title,fee_amount as amount');
            $this->db->where('fee_collection_master_id', $row['fee_collection_master_id']);
            $row['items'] = $this->db->get('view_fee_collection_details')->result_array();
            array_push($arr, $row);
        endforeach;
        return $arr[0];
    }

    public function update_concession($data)
    {
        //
        //Sanal
        //20-04-2019

        $master_data = array(
            'fee_balance' => $data['balance'],
            'fee_concession' => $data['concession']
        );
        $this->db->where('students_fee_master_id', $data['students_fee_master_id']);
        $this->db->update('tbl_students_fee_master', $master_data);
//            $details = json_decode($row['details'],true); // this is an array.
        $details = $data['details']; // this is an array.
        foreach ($details as $row) {
            $details_data = array(
                'fee_balance' => $row['balance'],
                'fee_concession' => $row['concession']
            );
            $this->db->where('students_fee_details_id', $row['students_fee_details_id']);
            $this->db->update('tbl_students_fee_details', $details_data);
        }
//        return $this->db->last_query();
        return ($this->db->affected_rows() > 0);
    }

    public function insert_fee($user_id, $student_id, $date_paid, $payment_mode, $master)
    {
        //
        //Sanal
        //20-04-2019

        $section_id = $this->student_details($student_id)->section_id;
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $receipt_number = 1 + $this->get_voucher_number("Receipt", $branch_id, $running_year);

        $this->update_student_fee($master);
//        return ($this->db->affected_rows()>0);
        foreach ($master as $row) {
            $master_data = array(
                'receipt_number' => $receipt_number,
                'date_paid' => $date_paid,
                'student_fee_master_id' => $row['students_fee_master_id'],
                'admission_number' => $student_id,
                'class_id' => $class_id,
                'batch_id' => $section_id,
                'department_id' => $department_id,
                'branch_id' => $branch_id,
                'academic_year_id' => $running_year,
                'payment_mode' => $payment_mode
            );
            $this->db->insert('tbl_fee_collection_master', $master_data);
            $insert_id = $this->db->insert_id();
//            $details = json_decode($row['details'],true); // this is an array.
            $details = $row['details']; // this is an array.
            foreach ($details as $row) {
                $details_data = array(
                    'fee_collection_master_id' => $insert_id,
                    'fee_head_id' => $row['fee_head_id'],
                    'fee_amount' => $row['amount']
                );
                $this->db->insert('tbl_fee_collection_details', $details_data);
            }
        }
        $this->db->where('voucher_type_name', "Receipt");
        $this->db->where('branch_id', $branch_id);
        $this->db->where('academic_year_id', $running_year);
        $this->db->update('tbl_voucher', array('voucher_number' => $receipt_number));
//        return $this->payment_history($student_id);
//        return ($this->db->affected_rows()>0);
        return $this->get_receipt_details($receipt_number);
    }

    public function update_student_fee($master)
    {
        //
        //Sanal
        //20-04-2019

        foreach ($master as $row) {
            $master_data = array(
                'fee_balance' => $row['amount']
            );
            $this->db->where('students_fee_master_id', $row['student_fee_master_id']);
            $this->db->set('fee_balance', 'fee_balance -' . $row['amount'] . '', false);
            $this->db->update('tbl_students_fee_master');
//            $details = json_decode($row['details'],true); // this is an array.
            $details = $row['details']; // this is an array.
            foreach ($details as $row) {
                $details_data = array(
                    'fee_balance' => $row['amount']
                );
                $this->db->where('students_fee_details_id', $row['students_fee_details_id']);
                $this->db->set('fee_balance', 'fee_balance -' . $row['amount'] . '', false);
                $this->db->update('tbl_students_fee_details');
            }
        }
        return ($this->db->affected_rows() > 0);
    }
    /* public function insert_fee($user_id, $student_id, $section_id, $receipt_number, $date_paid, $payment_mode, $master)
     {
         //
         //Sanal
         //20-04-2019

         $class_id = $this->get_class_id($section_id);
         $running_year = $this->get_running_year();
         $user = $this->get_user_details($user_id);
         $branch_id = $user->branch;
         $department_id = $user->dept;
         $receipt_number = 1 + $this->get_voucher_number("Receipt", $branch_id, $running_year);
         $this->update_student_fee($master);
 //        return ($this->db->affected_rows()>0);
         foreach ($master as $row) {
             $master_data = array(
                 'receipt_number' => $receipt_number,
                 'date_paid' => $date_paid,
                 'student_fee_master_id' => $row['students_fee_master_id'],
                 'admission_number' => $student_id,
                 'class_id' => $class_id,
                 'batch_id' => $section_id,
                 'department_id' => $department_id,
                 'branch_id' => $branch_id,
                 'academic_year_id' => $running_year,
                 'payment_mode' => $payment_mode
             );
             $this->db->insert('tbl_fee_collection_master', $master_data);
             $insert_id = $this->db->insert_id();
 //            $details = json_decode($row['details'],true); // this is an array.
             $details = $row['details']; // this is an array.
             foreach ($details as $row) {
                 $details_data = array(
                     'fee_collection_master_id' => $insert_id,
                     'fee_head_id' => $row['fee_head_id'],
                     'fee_amount' => $row['amount']
                 );
                 $this->db->insert('tbl_fee_collection_details', $details_data);
             }
         }
         $this->db->where('voucher_type_name', "Receipt");
         $this->db->where('branch_id', $branch_id);
         $this->db->where('academic_year_id', $running_year);
         $this->db->update('tbl_voucher', array('voucher_number' => $receipt_number));
 //        return $this->payment_history($student_id);
         return ($this->db->affected_rows() > 0);
     }*/

    /* public function update_student_fee($master)
     {
         //
         //Sanal
         //20-04-2019

         foreach ($master as $row) {
             $master_data = array(
                 'fee_balance' => $row['amount']
             );
             $this->db->where('students_fee_master_id', $row['students_fee_master_id']);
             $this->db->set('fee_balance', 'fee_balance -' . $row['amount'] . '', false);
             $this->db->update('tbl_students_fee_master');
 //            $details = json_decode($row['details'],true); // this is an array.
             $details = $row['details']; // this is an array.
             foreach ($details as $row) {
                 $details_data = array(
                     'fee_balance' => $row['amount']
                 );
                 $this->db->where('students_fee_details_id', $row['students_fee_details_id']);
                 $this->db->set('fee_balance', 'fee_balance -' . $row['amount'] . '', false);
                 $this->db->update('tbl_students_fee_details');
             }
         }
         return ($this->db->affected_rows() > 0);
     }*/

    public function payment_history($student_id)
    {
        //
        //Sanal
        //16-04-2019
        $year   =   get_running_year();
        $where_data = array(
            'admission_number' => $student_id,
            'academic_year_id' => $year
        );
        $this->db->where($where_data);
        $total = $this->db->select('SUM(fee_amount) as total')->get('view_fee_collection_details')->row()->total;
        $this->db->where($where_data);
        $this->db->select('DATE_FORMAT(date_paid, "%d/%m/%Y") as date_paid,receipt_number,fee_head_id,fee_head,fee_amount');
        $this->db->order_by('fee_collection_details_id');
        $result = $this->db->get('view_fee_collection_details')->result();

        foreach ($result as $row) {
            $row->total_paid = $total;
            if ($row->fee_head_id == 9999) {
                $row->fee_head = "Late Fee";
            }
        }
        return $result;
    }

    public function student_fee_details($student_id)
    {
        //
        //Sanal
        //16-04-2019
        $year   =   get_running_year();
        $data['total'] = 0;
        $data['paid'] = 0;
        $data['balance'] = 0;
        $data['concession'] = 0;
        $where_data = array(
            'admission_number' => $student_id,
            'academic_year_id' => $year 
        );
        $this->db->where($where_data);
        $this->db->select('students_fee_master_id,fee_installment_master_id,DATE_FORMAT(due_date, "%d/%m/%Y") as due_date,fee_amount as total,abs(fee_amount-fee_balance)as paid,fee_balance as balance,fee_concession as concession');
        $fee_master = $this->db->get('tbl_students_fee_master')->result();
        //print_r($fee_master);die;
        $count = 1;
        foreach ($fee_master as $row) {
            $row->installment_number = $count++;
            $this->db->where('students_fee_master_id', $row->students_fee_master_id);
            $this->db->where('f.is_deleted', 'N');
            $this->db->select('f.students_fee_details_id,h.fee_head_id,h.fee_head,f.fee_amount as total,abs(f.fee_amount-f.fee_balance)as paid,f.fee_balance as balance,f.fee_concession as concession');
            $this->db->join('tbl_fee_heads h', 'f.fee_head_id=h.fee_head_id');
            $row->details = $this->db->get('tbl_students_fee_details f')->result();
            /*foreach ($row->details as $item) {
                $row->paid += $item->paid;
            }*/
            $data['total'] += $row->total;
            $data['paid'] += $row->paid;
            $data['balance'] += $row->balance;
            $data['concession'] += $row->concession;
        }
        $data['details'] = $fee_master;
        return $data;
    }

    public function list_staff($user_id)
    {
        //
        //Sanal
        //13-04-2019  12:35 PM
        $user = $this->get_user_details($user_id);
        $where_data = array(
            'branch_id' => $user->branch,
            'dept_id' => $user->dept
        );
        $this->db->where($where_data);
        $this->db->select('staff_id,name,phone');
        return $this->db->get('staff')->result();
    }

    public function list_sections($class_id)
    {
        //
        //Sanal
        //13-04-2019  12:09 PM
        $running_year = $this->get_running_year();
        $this->db->where('class_id', $class_id);
        $this->db->where('academic_year', $running_year);
        $this->db->select('class_id, section_id, name as section_name');
        return $this->db->get('section')->result();
    }

    public function student_details($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->select('student_id, section_id, name as student_name,roll as roll_number, date_added, phone1, IFNULL(phone2,"") as phone2, sex as gender, IFNULL(email,"") as email, class_name as class, section_name as section, IFNULL(parent,"") as parent, birthday, address, student_status_id as status_id');
        $student_details = $this->db->get('view_students')->row();
        if ($student_details->status_id == 0) {
            $student_details->active = true;
        } else {
            $student_details->active = false;
        }
        unset($student_details->status_id);
        $student_details->date_added = date("d/m/Y", $student_details->date_added);
        if (null == $student_details->birthday) {
            $student_details->birthday = "";
        }
        if ($student_details->birthday != "") {
            $student_details->birthday = date("d/m/Y", $student_details->birthday);
        }
        $student_details->class_name = $student_details->class . " " . $student_details->section;
        $student_details->student_name = trim($student_details->student_name);
        $student_details->profile_photo = base_url() . "uploads/student_image/" . $student_details->student_id . ".jpg";
        unset($student_details->class);
        unset($student_details->section);
        return $student_details;
    }

    public function class_details($user_id, $section_id)
    {
        $class_data = $this->class_teacher($user_id, $section_id);
        if ($class_data == null) {
            $class_data = new stdClass();
            $class_data->section_id = $section_id;
            $class_data->teacher_id = -1;
            $class_data->teacher_name = "";
            $class_data->phone = "";
        }
        $class_data->students = $this->list_students($section_id);
        return $class_data;
    }

    public function class_teacher($user_id, $section_id)
    {
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $where_data = array(
            's.section_id' => $section_id,
            's.branch_id' => $branch_id,
            's.dept_id' => $department_id
        );
        $this->db->where($where_data);
        $this->db->select('s.section_id,t.staff_id as teacher_id,t.name as teacher_name,t.phone');
        $this->db->join('view_staff t', 't.staff_id=s.teacher_id');
        $res = $this->db->get('view_section_class s')->row();
        if (null == $res) {
            $res = new stdClass();
        }
        if ($res->teacher_id == "") {
            $res->teacher_id = -1;
            $res->section_id = $section_id;
            $res->profile_photo = base_url() . 'uploads/user.jpg';
        } else {
            $res->profile_photo = $this->crud_model->get_image_url('staff', $res->teacher_id);
        }
        //echo $this->db->last_query();die;
        return $res;
    }

    public function attendance_details($user_id, $date, $time_of_day, $section_id)
    {
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $timestamp = strtotime($date);
        if($this->get_settings_table("afternoon_attendance")=="yes")
        {
            $data = array(
                'a.year' => $running_year,
                'a.branch_id' => $branch_id,
                'a.dept_id' => $department_id,
                'a.class_id' => $class_id,
                'a.section_id' => $section_id,
                'a.timestamp' => $timestamp,
                'a.time' => $time_of_day,    //If afternoon attendance is on, then check $time_of_day also.
            );
        }
        else
        {
            $data = array(
                'a.year' => $running_year,
                'a.branch_id' => $branch_id,
                'a.dept_id' => $department_id,
                'a.class_id' => $class_id,
                'a.section_id' => $section_id,
                'a.timestamp' => $timestamp,
            );
        }
        $this->db->where($data);
        $this->db->select('a.attendance_id,s.student_id,s.name as student_name,s.roll as roll_number,s.section_id,a.status');
        $this->db->join('attendance a', 'a.student_id=s.student_id and s.year=' . $running_year);
        $this->db->order_by('s.roll');
        $data = $this->db->get('view_students s')->result();
        //echo $this->db->last_query(); die();
        return $data;
    }

    public function search($user_id, $keyword)
    {
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $this->db->where('c.branch_id', $user->branch);
        $this->db->where('c.dept_id', $user->dept);
        $this->db->where('c.academic_year', $running_year);
//        $this->db->like('c.name', $keyword);
        $this->db->like('CONCAT(c.name," ",s.name)', $keyword);
        $this->db->or_like('CONCAT(c.name,s.name)', $keyword);
        $this->db->select('c.class_id, c.name as class_name,s.section_id,s.name as section_name ');
        $this->db->join('section s', 's.class_id=c.class_id', 'LEFT');
        $class_list = $this->db->get('class c')->result();
        foreach ($class_list as $row) {
            $row->student_count = $this->get_student_count($row->section_id);
            $row->display_name = $row->class_name . " " . $row->section_name;
            unset($row->section_name);
            unset($row->class_name);
        }

        $this->db->where('s.branch_id', $user->branch);
        $this->db->where('s.dept_id', $user->dept);
        $this->db->like('s.name', $keyword, 'after');
//        $this->db->or_like('trim(s.name)', $keyword, 'after');
        $this->db->where('s.student_status_id', 0);
        $this->db->select('s.student_id,s.name as student_name,vs.sex as gender,vs.roll as roll_number,vs.class_name as class,vs.section_id,vs.section_name as section');
        $this->db->join('view_students vs', 'vs.student_id=s.student_id', 'LEFT');
        $student_list = $this->db->get('student s')->result();
        foreach ($student_list as $row) {
            $row->class_name = $row->class . " " . $row->section;
            $row->profile_photo = base_url() . "uploads/student_image/" . $row->student_id . ".jpg";
            unset($row->class);
            unset($row->section);
        }
        $data['student_list'] = $student_list;
        $data['class_list'] = $class_list;
        return $data;
    }

    public function insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance,$send_absent="")
    {
        // * Sanal, 2019 03 26, 14 :34
        // *
        //return $attendance;
        //date_default_timezone_set("Asia/Kolkata");
        $existing = $this->attendance_details($user_id, $date, $time_of_day, $section_id);
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $timestamp = strtotime($date);
    
        if($send_absent==true)
        {
        	$sms                =   $this->db->get('sms_settings')->row();
        	$sender_id          =   $sms->sender_id;
        	$username           =   $sms->username;
        	$password           =   $sms->password;
        	$common             =   $sms->common_word;
        	$url                =   $sms->url;
            $web_url            =   $sms->web_url;
            
            $staff_id           =   $this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
            $data1['send_by']	=   $staff_id;
            
            $data1['send_date']	=   date('Y/m/d H:i:s');
                    
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
            $data1['content']	=   "Absent Message";
            
            $this->db->insert('tbl_sms_delivery_master',$data1);
            $master_id		    =	$this->db->insert_id();
        }
        
        
        
        foreach ($attendance as $student) {
            $data = array(
                'student_id' => $student['student_id'],
                'status' => $student['status'],
                'timestamp' => $timestamp,
                'year' => $running_year,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'time' => $time_of_day,
                'branch_id' => $branch_id,
                'dept_id' => $department_id
            );
            if (sizeof($existing) > 0) {
                $this->db->where('attendance_id', $student['attendance_id']);
                $this->db->update('attendance', $data);
            } else {
                $this->db->insert('attendance', $data);
            }
            if($send_absent==true)
            {
                //Send absent message
                $date1			=	date('d/m/Y',$timestamp);
                if($student['status']==2)
                {
                    $msg = " is absent on ".$date1;
                }
                if($this->get_settings_table("half_day_leave")=="yes" && $student['status']==5)
                {
                    $msg = " is half day leave on ".$date1;
                }
                
                if($student['status']==2 || $student['status']==5)
                {
                    $stu        =   $this->db->get_where('student', array('student_id' => $student['student_id']))->row();
                    $phone1     =   $stu->phone1;
                    $name       =   $stu->name;
                    $message    =   $name. " ".$msg;
                    
    				$data2['sms_master_id'] =   $master_id;
    				$data2['student_id']	=   $student['student_id'];
    				$data2['class_id']	    =   $class_id;
    				$data2['section_id']	=   $section_id;
    				$data2['phone']	        =   $phone1;
    				
    
    				
                    if($c==1)
                        $data2['msg_content'] = $common_word."Dear Parent,".$message.'.';  
                    if($c==0)
                        $data2['msg_content'] = "Dear Parent,".$message.'.'.$common_word.'.' ;  
    
    				$data2['send_date']	    =   date('Y/m/d H:i:s');
    				$this->db->insert('tbl_sms_delivery_details',$data2);
                }
            }
        }
        
        //Take data from table and send sms
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
        
        
        return $this->attendance_details($user_id, $date, $time_of_day, $section_id);
    }

    public function list_students($section_id)
    {
//
//        * Sanal, 2019 03 25, 16:14
//        *
        $year = get_running_year();
        $this->db->where('s.year', $year);
        $this->db->where('s.section_id', $section_id);
        $this->db->where('s.student_status_id', 0);
        $this->db->select('s.class_name as class,s.section_id,s.section_name as section,s.student_id,s.roll as roll_number,s.name as student_name,s.sex as gender');
        $student_list = $this->db->get('view_students s')->result();
        foreach ($student_list as $row) {
            $row->class_name = $row->class . " " . $row->section;
            $row->profile_photo = base_url() . "uploads/student_image/" . $row->student_id . ".jpg";
            unset($row->class);
            unset($row->section);
        }
        return $student_list;
    }

    public function list_class($user_id)
    {
        /*
        * Sanal, 2019 03 25, 16:00
        * */

        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $this->db->where('c.branch_id', $user->branch);
        $this->db->where('c.dept_id', $user->dept);
        $this->db->where('c.academic_year', $running_year);
//        $this->db->select('c.class_id, cast(c.name as unsigned) as class_name,s.section_id,s.name as section_name ');
        $this->db->select('c.class_id, c.name as class_name,s.section_id,s.name as section_name ');
        $this->db->join('section s', 's.class_id=c.class_id', 'LEFT');
//        $this->db->order_by('class_name',ASC);
//        $this->db->order_by('section_name',ASC);
        $class_list = $this->db->get('class c')->result();
        foreach ($class_list as $row) {
//            $row->class_id=(int)$row->class_id;
//            $row->section_id=(int)$row->section_id;
            $row->student_count = $this->get_student_count($row->section_id);
            $row->display_name = $row->class_name . " " . $row->section_name;
            unset($row->section_name);
            unset($row->class_name);
        }
        return $class_list;

    }

    public function login($username, $password)
    {
        /*
        * WOLF, 2019 03 23, 12:04
        * */
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->where('user_role_id', 4);// Login for department admin only
        $this->db->select('user_id as id,branch_id,dept_id');
        $query = $this->db->get('tbl_users');
        $id = -1; // Invalid user
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
        } else {
            $id = -1; //Invalid user
        }
        //echo $this->db->last_query();die();
		$this->session->set_userdata('branch_id', $query->row()->branch_id);
		$this->session->set_userdata('dept_id', $query->row()->dept_id);
        return $id;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * $ - HELPER FUNCTIONS -$
     * DO NOT WRITE API FUNCTIONS BELOW THIS AREA
     * USE THIS AREA FOR HELPER FUNCTIONS ONLY
     * */

    private function get_voucher_number($type, $branch_id, $year)
    {
        //
        //Sanal
        //18-04-2019
        $this->db->where('voucher_type_name', $type);
        $this->db->where('branch_id', $branch_id);
        $this->db->where('academic_year_id', $year);
        return $this->db->get('tbl_voucher')->row()->voucher_number;
    }

    private function get_class_id($section_id)
    {
        $this->db->where('section_id', $section_id);
        return $this->db->get('section')->row()->class_id;
    }

    public function get_student_count($section_id)
    {

        // * Sanal, 2019 03 25, 16:00
        // *
        // $this->db->where('class_id',$class_id);
        $year = get_running_year();
        $this->db->where('section_id', $section_id);
        $this->db->where('student_status_id', 0);
        $this->db->where('year', $year);
        $this->db->select('count(*) as student_count');
        return $this->db->get('view_students')->row()->student_count;
    }

    public function get_user_details($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->select('user_role_id as role,branch_id as branch,dept_id as dept');
        return $this->db->get('tbl_users')->row();
    }

    private function get_running_year()
    {
        return $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    }
}

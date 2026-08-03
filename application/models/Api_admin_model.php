<?php

class Api_admin_model extends CI_Model
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

    public function delete_student_message($message_ids){
        /*
        * Sanal, 2019 08 02
        * */
        $count = 0;
        foreach ($message_ids as $row){
            $this->db->where('message_id', $row);
            $this->db->delete('tbl_teacher_student_message');
            $count += $this->db->affected_rows();
        }
        return $count;
    }
    public function list_teacher_student_messages($user_id){
        /*
        * Sanal, 2019 08 02
        * */
        $running_year = $this->get_running_year();
        $where_data = array(
            'm.from_teacher_id' =>  $user_id,
            'm.year'            =>  $running_year
        );
        $this->db->where($where_data);
        $this->db->select('m.message_id,m.message,m.date_time as sent_date,m.viewed,m.viewed_date_time as viewed_date,vs.student_id,vs.name as student_name,vs.section_id,CONCAT(vs.class_name," ",vs.section_name) as class_name,m.subject_id, s.name as subject_name');
        $this->db->join('view_students vs', 'vs.student_id=m.to_student_id', 'LEFT');
        $this->db->join('subject s', 's.subject_id=m.subject_id', 'LEFT');
//        $this->db->join('view_section_class sc', 'm.section_id=hw.section_id', 'LEFT');
        $this->db->order_by('m.date_time',DESC);
        $message_data = $this->db->get('tbl_teacher_student_message m')->result();
        foreach ($message_data as $row){
            $row->viewed = $row->viewed=="Y";
            $row->sent_date = date('d/m/Y h:i:s A',strtotime($row->sent_date));
            $row->viewed_date = date('d/m/Y h:i:s A',strtotime($row->viewed_date));
        }
        return $message_data;
    }
    public function send_teacher_student_message($user_id,$section_id,$subject_id,$message,$students){
        /*
        * Sanal, 2019 08 01, 15:40
        * */
        $running_year = $this->get_running_year();
        date_default_timezone_set("Asia/Kolkata");
        $send_date=date('Y-m-d H:i:s');
        $count = 0;
        if ($students[0] == -1) {
            $studentList = $this->list_students($section_id);
            foreach ($studentList as $student_row){
                $student_id = $student_row->student_id;
                $data = array(
                    'from_teacher_id' => $user_id,
                    'subject_id' => $subject_id,
                    'message' => $message,
                    'to_student_id' => $student_id,
                    'date_time' => $send_date,
                    'year' => $running_year
                );
                $this->db->insert('tbl_teacher_student_message', $data);
                if ($this->db->affected_rows() > 0)   $count++;
            }
        } else {
            foreach ($students as $student_id) {
                $data = array(
                    'from_teacher_id' => $user_id,
                    'subject_id' => $subject_id,
                    'message' => $message,
                    'to_student_id' => $student_id,
                    'date_time' => $send_date,
                    'year' => $running_year
                );
                $this->db->insert('tbl_teacher_student_message', $data);
                if ($this->db->affected_rows() > 0)   $count++;
            }
        }
        return $count;
    }
    public function update_student_bus_fee($bus_fee_master){
        //
        //Sanal
        //19-07-2019

        foreach ($bus_fee_master as $row) {
            $this->db->where('students_bus_fee_master_id', $row['students_bus_fee_master_id']);
            $this->db->set('fee_balance','fee_balance -' .$row['amount'].'',false);
            $this->db->update('tbl_transport_students_bus_fee_master');
        }
        return ($this->db->affected_rows()>0);
    }
    public function student_bus_fee_collection_details($receipt_number, $date_paid){
        $running_year = $this->get_running_year();
        $date_paid = date('Y-m-d', strtotime(str_replace("/", "-", $date_paid)));
        $where_data=array(
            'receipt_number'=>$receipt_number,
            'date_paid'=>$date_paid
        );
        $this->db->where($where_data);
        $this->db->select('SUM(amount_paid) as fee_amount');
        $this->db->group_by('receipt_number');
        $data = $this->db->get('view_transport_students_bus_fee_collection_details')->result();
        foreach ($data as $row){
            $row->fee_head_name = "Bus Fee";
        }
        return $data;
    }
    public function student_bus_fee_details($student_id){
        //
        //Sanal
        //16-07-2019
        $running_year = $this->get_running_year();
        $data['total']=0;
        $data['paid']=0;
        $data['concession']=0;
        $data['balance']=0;
        $where_data=array(
            'student_id'=>$student_id,
            'academic_year'=>$running_year,
            'is_deleted'=>'N'
        );
        $this->db->where($where_data);
        $this->db->select('students_bus_fee_master_id,installment_name,DATE_FORMAT(due_date, "%d/%m/%Y") as due_date,fee_amount as total,abs(fee_amount-fee_balance)as paid,fee_concession as concession,fee_balance as balance');
        $fee_master = $this->db->get('view_transport_students_bus_fee_master')->result();
        foreach ($fee_master as $row){
            $data['total']+=$row->total;
            $data['paid']+=$row->paid;
            $data['concession']+=$row->concession;
            $data['balance']+=$row->balance;
        }
        $data['details']=$fee_master;
        return $data;
    }
    public function attendance_message($user_id, $date, $time_of_day, $section_id, $send_absent, $send_late, $send_half_day_leave){
        $attendance_details = $this->attendance_details($user_id, $date, $time_of_day, $section_id);
/*        $params = array(
            "userId"    => $user_id,
            "date"    => $date,
            "time_of_day"    => $time_of_day,
            "section_id"    => $section_id,
            "send_absent"    => $send_absent,
            "send_late"    => $send_late,
            "send_half_day"    => $send_half_day,
        );
        return $params;*/
//        return $attendance_details;

        $send_by=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
        date_default_timezone_set("Asia/Kolkata");
        $send_date=date('Y-m-d H:i:s');
        $master_data = array(
            'send_by'   => $send_by,
            'content'   => "Attendance message",
            'send_date'   => $send_date
        );
        $this->db->insert('tbl_sms_delivery_master' , $master_data);
        $insert_id = $this->db->insert_id();

        $count = 0;
        foreach ($attendance_details as $row){
            $studentId = $row->student_id;
            $student_details = $this->student_details($studentId);
            $phone = $student_details->phone1;
            $details_data=array(
                'sms_master_id' =>  $insert_id,
                'class_id'      =>  $this->get_class_id($student_details->section_id),
                'section_id'    =>  $student_details->section_id,
                'student_id'    =>  $studentId,
                'phone'         =>  $phone,
                'msg_content'   =>  "$student_details->name ",
                'send_date'     =>  $send_date
            );
            if ($send_absent && $row->status == 2){
                $details_data["msg_content"] = "$student_details->name is absent on $date";
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
            if ($send_late && $row->status == 3){
                $details_data["msg_content"] = "$student_details->name is late on $date";
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
            if ($send_half_day_leave && $row->status == 5){
                $details_data["msg_content"] = "$student_details->name is half day on $date";
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
        }
        $count = $this->send_sms($insert_id);
        return $count;
    }
    public function delete_home_work($homework_ids){
        $count = 0;
        $update_data = array(
            "is_deleted"  => "Y"
        );
        foreach ($homework_ids as $row){
            $this->db->where('homework_id', $row);
            $this->db->update('homework', $update_data);
            $count += $this->db->affected_rows();
        }
        return $count;
    }
    public function list_home_works($user_id){
        $running_year = $this->get_running_year();
        $where_data = array(
            'hw.is_deleted'   =>  "N",
            'hw.uploader_id'   =>  $user_id,
            'hw.academic_year'   =>  $running_year
        );
        $this->db->where($where_data);
        $this->db->select('hw.homework_id,hw.title,hw.description,hw.time_end as last_date,hw.section_id,CONCAT(sc.class_name," ",sc.name) as class_name,hw.subject_id, s.name as subject_name');
        $this->db->join('subject s', 's.subject_id=hw.subject_id', 'LEFT');
        $this->db->join('view_section_class sc', 'sc.section_id=hw.section_id', 'LEFT');
        $this->db->order_by('hw.homework_id',DESC);
        return $this->db->get('homework hw')->result();
    }
    public function insert_home_work($user_id, $section_id, $subject_id, $title, $description, $last_date)
    {
        // * Sanal, 2019 07 02, 10 :45
        // *
        //return $attendance;
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $current_date=date('Y-m-d');
        $homework_code = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data = array(
            'homework_code' => $homework_code,
            'title' => $title,
            'description' => $description,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'uploader_id' => $user_id,
            'time_end' => $last_date,
            'section_id' => $section_id,
            'branch_id' => $branch_id,
            'dept_id' => $department_id,
            'created_at' => $current_date,
            'academic_year' => $running_year
        );
        $this->db->insert('homework' , $data);
        return $this->db->affected_rows();
    }
    public function list_subjects($user_id,$section_id){
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $teacher_id = $this->getStaffId($user_id);
        $where_data = array(
            'st.section_id'   =>  $section_id,
            'st.teacher_id'   =>  $teacher_id
        );
        $this->db->where($where_data);
        $this->db->select('st.subject_id, s.name,');
        $this->db->join('subject s', 's.subject_id=st.subject_id', 'LEFT');
        return $this->db->get('subject_teacher st')->result();
    }
    public function send_sms($sms_master_id){
        $running_year   =   get_running_year();
        $sms            =   $this->db->get('sms_settings')->row();
        $sender_id      =   $sms->sender_id;
        $username       =   $sms->username;
        $password       =   $sms->password;
        $common         =   $sms->common_word;
        $url            =   $sms->url;
        $web_url        =   $sms->web_url;

        //Get from details table and send sms
        $i = 0;
        $this->db->where('sms_master_id',$sms_master_id);
        $this->db->select('details_id,sms_master_id,student_id,phone,msg_content');
        $sms_details=$this->db->get('tbl_sms_delivery_details')->result_array();

//        return $sms_details;
        foreach($sms_details as $row)
        {
            $phone1     =   $row['phone'];
            $message    =   $row['msg_content'];

            $location   =   'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone1.'&msg=' . urlencode($message . " " . $common) . '&route=T';
            $api        =   $url;

            $handle     =   fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
//            $balance    =   stream_get_contents($handle);
            $balance    =   0;
            if ($balance > 0)
            {
                $api . "/sendsms?" . $location;
                $send                   =   fopen($api . "/sendsms?" . $location, "r");
                $api . "/sendsms?" . $location;

                $return_message_ids     =   stream_get_contents($send);
                $message_id_array       =   explode(",", $return_message_ids);

                $str                    =   filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
                $sms_data['msg_code']	=	$str;
                $sms_data['processed']  =	1;
                $this->db->where('details_id',$row['details_id']);
                $this->db->update('tbl_sms_delivery_details',$sms_data);
                $i++;
            }
        }
        return $i;
    }
    public function notification_sms($user_id,$message,$send_phone2,$sections,$students){
        $running_year = $this->get_running_year();
        $send_by=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
        date_default_timezone_set("Asia/Kolkata");
        $send_date=date('Y-m-d H:i:s');
        $master_data = array(
            'send_by'   => $send_by,
            'content'   => $message,
            'send_date'   => $send_date
        );
        $this->db->insert('tbl_sms_delivery_master' , $master_data);
        $insert_id = $this->db->insert_id();

        $count = 0;
        if ($sections[0] == -1 && $students[0] == -1){
            $classList = $this->list_class($user_id,false);
            foreach ($classList as $class_row){
                $studentList = $this->list_students($class_row->section_id);
                foreach ($studentList as $student_row){
                    $studentId = $student_row->student_id;
                    $phone1 = $this->student_details($studentId)->phone1;
                    $phone2 = $this->student_details($studentId)->phone2;
                    $details_data=array(
                        'sms_master_id' =>  $insert_id,
                        'class_id'      =>  $this->get_class_id($student_row->section_id),
                        'section_id'    =>  $student_row->section_id,
                        'student_id'    =>  $studentId,
                        'phone'         =>  $phone1,
                        'msg_content'   =>  "Hi $student_row->student_name \n$message",
                        'send_date'     =>  $send_date
                    );
                    $this->db->insert('tbl_sms_delivery_details', $details_data);
                    $count ++;
                    if ($send_phone2){
                        if (($phone2)!=null && ($phone2)!=""){
                            $details_data=array(
                                'sms_master_id' =>  $insert_id,
                                'class_id'      =>  $this->get_class_id($student_row->section_id),
                                'section_id'    =>  $student_row->section_id,
                                'student_id'    =>  $studentId,
                                'phone'         =>  $phone2,
                                'msg_content'   =>  "Hi $student_row->student_name \n$message",
                                'send_date'     =>  $send_date
                            );
                            $this->db->insert('tbl_sms_delivery_details', $details_data);
                            $count ++;
                        }
                    }
                }
            }
        }
        else if ($students[0] == -1){
            foreach ($sections as $row){
                $studentList = $this->list_students($row);
                foreach ($studentList as $student_row){
                    $studentId = $student_row->student_id;
                    $phone1 = $this->student_details($studentId)->phone1;
                    $phone2 = $this->student_details($studentId)->phone2;
                    $details_data=array(
                        'sms_master_id' =>  $insert_id,
                        'class_id'      =>  $this->get_class_id($student_row->section_id),
                        'section_id'    =>  $student_row->section_id,
                        'student_id'    =>  $studentId,
                        'phone'         =>  $phone1,
                        'msg_content'   =>  "Hi $student_row->student_name \n$message",
                        'send_date'     =>  $send_date
                    );
                    $this->db->insert('tbl_sms_delivery_details', $details_data);
                    $count ++;
                    if ($send_phone2){
                        if (($phone2)!=null && ($phone2)!=""){
                            $details_data=array(
                                'sms_master_id' =>  $insert_id,
                                'class_id'      =>  $this->get_class_id($student_row->section_id),
                                'section_id'    =>  $student_row->section_id,
                                'student_id'    =>  $studentId,
                                'phone'         =>  $phone2,
                                'msg_content'   =>  "Hi $student_row->student_name \n$message",
                                'send_date'     =>  $send_date
                            );
                            $this->db->insert('tbl_sms_delivery_details', $details_data);
                            $count ++;
                        }
                    }
                }
            }
        }else{
            foreach ($students as $student_row){
                $student_details = $this->student_details($student_row);
                $studentId = $student_details->student_id;
                $phone1 = $student_details->phone1;
                $phone2 = $student_details->phone2;
                $details_data=array(
                    'sms_master_id' =>  $insert_id,
                    'class_id'      =>  $this->get_class_id($student_details->section_id),
                    'section_id'    =>  $student_details->section_id,
                    'student_id'    =>  $studentId,
                    'phone'         =>  $phone1,
                    'msg_content'   =>  "Hi $student_details->name \n$message",
                    'send_date'     =>  $send_date
                );
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
                if ($send_phone2){
                    if (($phone2)!=null && ($phone2)!=""){
                        $details_data=array(
                            'sms_master_id' =>  $insert_id,
                            'class_id'      =>  $this->get_class_id($student_details->section_id),
                            'section_id'    =>  $student_details->section_id,
                            'student_id'    =>  $studentId,
                            'phone'         =>  $phone2,
                            'msg_content'   =>  "Hi $student_details->name \n$message",
                            'send_date'     =>  $send_date
                        );
                        $this->db->insert('tbl_sms_delivery_details', $details_data);
                        $count ++;
                    }
                }
            }
        }
        $count = $this->send_sms($insert_id);
        return $count;
    }
    public function login_details_sms($user_id,$sectionId){
        $running_year = $this->get_running_year();
        $sms = $this->db->get('sms_settings')->row();
        $common = $sms->common_word;
        $web_url = $sms->web_url;
        $send_by=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
        $message = "Greetings from $common.You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from $web_url site  with following details.username () and password ()";
        date_default_timezone_set("Asia/Kolkata");
        $send_date=date('Y-m-d H:i:s');
        $master_data = array(
            'send_by'   => $send_by,
            'content'   => $message,
            'send_date'   => $send_date
        );
        $this->db->insert('tbl_sms_delivery_master' , $master_data);
        $insert_id = $this->db->insert_id();

        $count = 0;
        if ($sectionId == -1){
            $classes = $this->list_class($user_id,false);
            foreach ($classes as $class_row){
                $students = $this->list_students($class_row->section_id);
                foreach ($students as $student_row){
                    $studentId = $student_row->student_id;
                    $phone = $this->student_details($studentId)->phone1;
                    $loginDetails = $this->get_login_details($studentId);
                    $details_message = "Greetings from $common.You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from $web_url site  with following details.username $loginDetails->username and password $loginDetails->password";
                    $details_data=array(
                        'sms_master_id' =>  $insert_id,
                        'class_id'      =>  $this->get_class_id($student_row->section_id),
                        'section_id'    =>  $student_row->section_id,
                        'student_id'    =>  $studentId,
                        'phone'         =>  $phone,
                        'msg_content'   =>  "Hi $student_row->student_name \n$details_message",
                        'send_date' =>  $send_date
                    );
                    $this->db->insert('tbl_sms_delivery_details', $details_data);
                    $count ++;
                }
            }
        }
        else{
            $students = $this->list_students($sectionId);
            foreach ($students as $student_row){
                $studentId = $student_row->student_id;
                $phone = $this->student_details($studentId)->phone1;
                $loginDetails = $this->get_login_details($studentId);
                $details_message = "Greetings from $common.You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from $web_url site  with following details.username $loginDetails->username and password $loginDetails->password";
                $details_data=array(
                    'sms_master_id' =>  $insert_id,
                    'class_id'      =>  $this->get_class_id($student_row->section_id),
                    'section_id'    =>  $student_row->section_id,
                    'student_id'    =>  $studentId,
                    'phone'         =>  $phone,
                    'msg_content'   =>  "Hi $student_row->student_name \n$details_message",
                    'send_date' =>  $send_date
                );
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
        }
        $count = $this->send_sms($insert_id);
        return $count;
    }
    public function staff_sms($user_id,$message,$receivers){
        $running_year = $this->get_running_year();
        $send_by=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
        date_default_timezone_set("Asia/Kolkata");
        $send_date=date('Y-m-d H:i:s');
        $master_data = array(
            'send_by'   => $send_by,
            'content'   => $message,
            'send_date'   => $send_date
        );
        $this->db->insert('tbl_sms_delivery_master' , $master_data);
        $insert_id = $this->db->insert_id();

        $count = 0;
        if (sizeof($receivers) == 1 && $receivers[0] == -1){
            $staffs = $this->list_staff($user_id);
            foreach ($staffs as $row){
                $details_data=array(
                    'sms_master_id' =>  $insert_id,
                    'student_id'    =>  $row->staff_id,
                    'phone'         =>  $row->phone,
                    'msg_content'   =>  "Hi ".$row->name."\n$message",
                    'send_date' =>  $send_date
                );
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
        }
        else{
            foreach ($receivers as $row){
                $details_data=array(
                    'sms_master_id' =>  $insert_id,
                    'student_id'    =>  $row,
                    'phone'         => $this->staff_details($row)->phone,
                    'msg_content'   =>  "Hi ".$this->staff_details($row)->name."\n$message",
                    'send_date' =>  $send_date
                );
                $this->db->insert('tbl_sms_delivery_details', $details_data);
                $count ++;
            }
        }
        $count = $this->send_sms($insert_id);
        return $count;
    }
    public function staff_details($staff_id){
        //
        //Sanal
        //01-06-2019
        $this->db->where('staff_id',$staff_id);
        $this->db->select('staff_id,name,phone');
        return $this->db->get('staff')->row();
    }
    public function list_templates(){
        //
        //Sanal
        //07-05-2019
        $range = array('attendance', 'admission', 'birthday');
        $this->db->where_not_in('title ', $range);
        $this->db->select('id,title,content');
        return $this->db->get('sms_template')->result();
    }
    public function update_concession($data){
        //
        //Sanal
        //20-04-2019

        $master_data = array(
            'fee_balance' =>$data['balance'],
            'fee_concession' =>$data['concession']
        );
        $this->db->where('students_fee_master_id', $data['students_fee_master_id']);
        $this->db->update('tbl_students_fee_master',$master_data);
//            $details = json_decode($row['details'],true); // this is an array.
        $details = $data['details']; // this is an array.
        foreach ($details as $row) {
            $details_data = array(
                'fee_balance' =>$row['balance'],
                'fee_concession' =>$row['concession']
            );
            $this->db->where('students_fee_details_id', $row['students_fee_details_id']);
            $this->db->update('tbl_students_fee_details',$details_data);
        }
        return $this->db->last_query();
        return ($this->db->affected_rows()>0);
    }
    public function insert_fee($user_id, $student_id, $date_paid, $payment_mode, $students_fee_master, $bus_fee_master){
        //
        //Sanal
        //20-04-2019

        $section_id = $this->student_details($student_id)->section_id;
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $receipt_number = 1 + $this->get_voucher_number("Receipt",$branch_id,$running_year);

        $this->update_student_fee($students_fee_master);
        $this->update_student_bus_fee($bus_fee_master);
//        return ($this->db->affected_rows()>0);
        $count = 0;
        foreach ($students_fee_master as $row) {
            $master_data = array(
                'receipt_number'        => $receipt_number,
                'date_paid'             => $date_paid,
                'student_fee_master_id' => $row['students_fee_master_id'],
                'admission_number'      => $student_id,
                'class_id'              => $class_id,
                'batch_id'              => $section_id,
                'department_id'         => $department_id,
                'branch_id'             => $branch_id,
                'academic_year_id'      => $running_year,
                'payment_mode'          => $payment_mode
            );
            $this->db->insert('tbl_fee_collection_master' , $master_data);
            $count ++;
            $insert_id = $this->db->insert_id();
//            $details = json_decode($row['details'],true); // this is an array.
            $details = $row['details']; // this is an array.
            foreach ($details as $row) {
                $details_data = array(
                    'fee_collection_master_id'  => $insert_id,
                    'fee_head_id'               => $row['fee_head_id'],
                    'fee_amount'                => $row['amount']
                );
                $this->db->insert('tbl_fee_collection_details' , $details_data);
                $count ++;
            }
        }

        foreach ($bus_fee_master as $row) {
            $bus_fee_master_data = array(
                'receipt_number'        => $receipt_number,
                'date_paid'             => $date_paid,
                'late_fee'             => 0,
                'student_id'            => $student_id,
                'class_id'              => $class_id,
                'section_id'            => $section_id,
                'payment_mode'          => $payment_mode,
                'entered_by'          => $user_id,
                'academic_year'      => $running_year
            );
            $this->db->insert('tbl_transport_students_bus_fee_collection_master' , $bus_fee_master_data);
            $count ++;
            $insert_id = $this->db->insert_id();
            $bus_fee_details_data = array(
                'bus_fee_collection_master_id'  => $insert_id,
                'students_bus_fee_master_id'    => $row['students_bus_fee_master_id'],
                'fee_amount'                    => $row['amount']
            );
            $this->db->insert('tbl_transport_students_bus_fee_collection_details' , $bus_fee_details_data);
            $count ++;
        }
        if ($count>0) {
            $this->db->where('voucher_type_name', "Receipt");
            $this->db->where('branch_id', $branch_id);
            $this->db->where('academic_year_id', $running_year);
            $this->db->update('tbl_voucher', array('voucher_number' => $receipt_number));
        }
//        return $this->payment_history($student_id);
//        return ($this->db->affected_rows()>0);
        return ($count>0);
    }
    public function update_student_fee($master){
        //
        //Sanal
        //20-04-2019

        foreach ($master as $row) {
/*            $master_data = array(
                'fee_balance' =>$row['amount']
            );*/
            $this->db->where('students_fee_master_id', $row['students_fee_master_id']);
            $this->db->set('fee_balance','fee_balance -' .$row['amount'].'',false);
            $this->db->update('tbl_students_fee_master');
//            $details = json_decode($row['details'],true); // this is an array.
            $details = $row['details']; // this is an array.
            foreach ($details as $row) {
                $details_data = array(
                    'fee_balance' =>$row['amount']
                );
                $this->db->where('students_fee_details_id', $row['students_fee_details_id']);
                $this->db->set('fee_balance','fee_balance -' .$row['amount'].'',false);
                $this->db->update('tbl_students_fee_details');
            }
        }
        return ($this->db->affected_rows()>0);
    }
    public function payment_history($student_id)
    {
        //
        //Sanal
        //16-04-2019
        $running_year = $this->get_running_year();
        $where_data = array(
            'admission_number' => $student_id
        );
        $this->db->where('academic_year_id',$running_year);
        $this->db->where('admission_number',$student_id);
        $total = $this->db->select('SUM(fee_amount) as total')->get('view_fee_collection_details')->row()->total;

        $this->db->where('academic_year_id',$running_year);
        $this->db->where('admission_number',$student_id);
        $this->db->select('receipt_number, DATE_FORMAT(date_paid, "%d/%m/%Y") as date_paid');
        $this->db->order_by('fee_collection_master_id','DESC');
//        $collection = $this->db->get('tbl_fee_collection_master')->result();
        $this->db->group_by('receipt_number');
        $collection = $this->db->get('view_fee_collection_details')->result();
        foreach ($collection as $row){
            $this->db->where('academic_year_id',$running_year);
            $this->db->where('admission_number',$student_id);
            $this->db->where('receipt_number',$row->receipt_number);
            $receipt_total = $this->db->select('SUM(fee_amount) as total')->get('view_fee_collection_details')->row()->total;

            $this->db->where('academic_year_id',$running_year);
            $this->db->where('admission_number',$student_id);
            $this->db->where('receipt_number',$row->receipt_number);
            $this->db->select('fee_head_id,fee_head as fee_head_name,SUM(fee_amount) as fee_amount');
            $this->db->order_by('fee_collection_details_id');
            $this->db->group_by('fee_head_id');
            $receipt_collection_student_fee = $this->db->get('view_fee_collection_details')->result();
            foreach ($receipt_collection_student_fee as $payment_row) {
                if ($payment_row->fee_head_id==9999){
                    $payment_row->fee_head_name="Late Fee";
                }
            }
            $receipt_collection_bus_fee = $this->student_bus_fee_collection_details($row->receipt_number,$row->date_paid);
            foreach ($receipt_collection_bus_fee as $row_bus_fee){
                $receipt_total += $row_bus_fee->fee_amount;
                $total += $row_bus_fee->fee_amount;
            }
            $row->total_paid = $receipt_total ;
//            $row->collection_student_fee = $receipt_collection_student_fee;
//            $row->collection_student_bus_fee = $this->student_bus_fee_collection_details($row->receipt_number,$row->date_paid);
            $row->collection = array_merge($receipt_collection_student_fee, $receipt_collection_bus_fee);
        }
/*        return $collection;

        $this->db->select('DATE_FORMAT(date_paid, "%d/%m/%Y") as date_paid,receipt_number,fee_head_id,fee_head as fee_head_name,fee_amount');
        $this->db->order_by('fee_collection_details_id');
        $result = $this->db->get('view_fee_collection_details')->result();*/

		if(is_null($total))
			$total = 0;
        $data = array(
            "total_paid"    =>  $total,
            "collection"    =>  $collection
        );
        return $data;
    }
    public function student_fee_details($student_id){
        //
        //Sanal
        //16-04-2019
        $running_year = $this->get_running_year();
        $data['total']=0;
        $data['paid']=0;
        $data['concession']=0;
        $data['balance']=0;
        $where_data=array(
            'admission_number'=>$student_id,
            'academic_year_id'=>$running_year,
            'is_deleted'=>'N',
        );
        $this->db->where($where_data);
        $this->db->select('students_fee_master_id,fee_installment_master_id,DATE_FORMAT(due_date, "%d/%m/%Y") as due_date,fee_amount as total,abs(fee_amount-fee_balance)as paid,fee_concession as concession,fee_balance as balance');
        $fee_master = $this->db->get('tbl_students_fee_master')->result();
        $count = 1;
        foreach ($fee_master as $row){
            $data['total']+=$row->total;
            $data['paid']+=$row->paid;
            $data['concession']+=$row->concession;
            $data['balance']+=$row->balance;
            $row->installment_number = $count++;
            $this->db->where('students_fee_master_id',$row->students_fee_master_id);
            $this->db->where('f.is_deleted','N');
            $this->db->select('f.students_fee_details_id,h.fee_head_id,h.fee_head as fee_head_name,f.fee_amount as total,abs(f.fee_amount-f.fee_balance)as paid,f.fee_concession as concession,f.fee_balance as balance');
            $this->db->join('tbl_fee_heads h','f.fee_head_id=h.fee_head_id');
            $row->details = $this->db->get('tbl_students_fee_details f')->result();
        }
        $data['master']=$fee_master;
        return $data;
    }
    public function list_staff($user_id){
        //
        //Sanal
        //13-04-2019  12:35 PM
        $user = $this->get_user_details($user_id);
        $where_data=array(
            'branch_id' => $user->branch,
            'dept_id' => $user->dept
        );
        $this->db->where($where_data);
        $this->db->select('staff_id,name,phone');
        return $this->db->get('staff')->result();
    }
    public function list_sections($class_id){
        //
        //Sanal
        //13-04-2019  12:09 PM
        $running_year = $this->get_running_year();
        $this->db->where('class_id',$class_id);
        $this->db->where('academic_year',$running_year);
        $this->db->select('class_id, section_id, name as section_name');
        return $this->db->get('section')->result() ;
    }
    public function student_details($student_id){
        $this->db->where('student_id',$student_id);
        $this->db->select('student_id, section_id, TRIM(name) as name,roll as roll_number, date_added, phone1, IFNULL(phone2,"")as phone2, sex as gender, IFNULL(email,"")as email, class_name as class, section_name as section, IFNULL(parent,"")as parent, birthday, address, student_status_id as status_id');
        $student_details = $this->db->get('view_students')->row();
        if (!is_null($student_details)) {
            if ($student_details->status_id==0){
                $student_details->active=true;
            }else{
                $student_details->active=false;
            }
            unset($student_details->status_id);
            $student_details->gender=ucfirst($student_details->gender);
            $student_details->date_added=date("d/m/Y",$student_details->date_added);
            if (empty($student_details->birthday)) {
                $student_details->birthday = "";
            } else {
                $student_details->birthday = date("d/m/Y", strtotime($student_details->birthday));
            }
            $student_details->profile_photo = base_url() . "uploads/student_image/" . $student_details->student_id . ".jpg";
        }
        return $student_details;
    }
    public function class_details($user_id,$section_id){
        $class_data=$this->class_teacher($user_id,$section_id);
        if ($class_data==null){
            $class_data = array(
                "section_id"    =>  $section_id,
                "teacher_id"    =>  -1,
                "teacher_name"  =>  "[Not Assigned]",
                "phone"         =>  "[Not Assigned]",
                "profile_photo" =>  base_url() . "uploads/staff_image/" . -1 . ".jpg",
                "students"      =>  $this->list_students($section_id)
            );
//            $class_data->section_id=$section_id;
//            $class_data->teacher_id=-1;
//            $class_data->teacher_name="";
//            $class_data->phone="";
        } else
            $class_data->students=$this->list_students($section_id);
        return $class_data;
    }
    public function class_teacher($user_id,$section_id){
        $class_id=$this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $where_data=array(
            's.section_id'  =>	$section_id,
            's.branch_id'	=>	$branch_id,
            's.dept_id'	    =>	$department_id
        );
        $this->db->where($where_data);
        $this->db->select('s.section_id,t.staff_id as teacher_id,t.name as teacher_name,t.phone');
        $this->db->join('view_staff t', 't.staff_id=s.teacher_id');
        $data = $this->db->get('view_section_class s')->row();
        if (!is_null($data)) {
            $data->profile_photo = base_url() . "uploads/staff_image/" . $data->teacher_id . ".jpg";
        }
        return $data;
    }
    public function attendance_details($user_id, $date, $time_of_day, $section_id)
    {
/*        $params = array(
            "user_id"   =>  $user_id,
            "date"   =>  $date,
            "time_of_day"   =>  $time_of_day,
            "section_id"   =>  $section_id,
        );
        return $params;*/
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $timestamp = strtotime($date);
        $data = array(
            's.year' => $running_year,
            's.branch_id' => $branch_id,
            's.dept_id' => $department_id,
            's.class_id' => $class_id,
            's.section_id' => $section_id,
            'a.timestamp' => $timestamp,
            'a.time' => $time_of_day
        );
        $this->db->where($data);
        $this->db->select('a.attendance_id,s.student_id,TRIM(s.name) as student_name,s.roll as roll_number,s.section_id,a.status');
        $this->db->join('attendance a', 'a.student_id=s.student_id');
        $this->db->order_by('s.name');
        $attendance_data = $this->db->get('view_students s')->result();

//         echo $this->db->last_query(); die();
//        die(print_r($attendance_data));
//        return $this->db->last_query();
        return $attendance_data;
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
        $this->db->like('TRIM(s.name)', $keyword, 'after');
//        $this->db->like('s.name', $keyword, 'after');
//        $this->db->or_like('trim(s.name)', $keyword, 'after');
        $this->db->where('s.student_status_id', 0);
        $this->db->select('s.student_id,TRIM(s.name) as student_name,vs.sex as gender,vs.roll as roll_number,vs.class_name as class,vs.section_id,vs.section_name as section');
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
    public function insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance, $send_absent, $send_late, $send_half_day_leave)
    {
        // * Sanal, 2019 03 26, 14 :34
        // *
        //return $attendance;
        $existing = $this->attendance_details($user_id, $date, $time_of_day, $section_id);
        $class_id = $this->get_class_id($section_id);
        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $branch_id = $user->branch;
        $department_id = $user->dept;
        $timestamp = strtotime($date);
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
        }
        if ($send_absent || $send_late || $send_half_day_leave) {
            $this->attendance_message($user_id, $date, $time_of_day, $section_id, $send_absent, $send_late, $send_half_day_leave);
        }
        return $this->attendance_details($user_id, $date, $time_of_day, $section_id);
    }
    public function list_students($section_id)
    {
//
//        * Sanal, 2019 03 25, 16:14
//        *
        $this->db->where('s.section_id', $section_id);
        $this->db->where('s.student_status_id', 0);
//        $this->db->select('s.class_name as class,s.section_id,s.section_name as section,s.student_id,s.roll as roll_number,s.name as student_name,s.sex as gender');
        $this->db->select('s.class_name as class,s.section_id,s.section_name as section,s.student_id,s.roll as roll_number,TRIM(s.name) as student_name,s.sex as gender');
        $this->db->order_by('s.name');
        $student_list = $this->db->get('view_students s')->result();
        foreach ($student_list as $row) {
            $row->class_name = $row->class . " " . $row->section;
            $row->profile_photo = base_url() . "uploads/student_image/" . $row->student_id . ".jpg";
            unset($row->class);
            unset($row->section);
        }
        return $student_list;
    }
    public function list_class($user_id,$is_subject_class_only)
    {
        /*
        * Sanal, 2019 03 25, 16:00
        * */

        $running_year = $this->get_running_year();
        $user = $this->get_user_details($user_id);
        $staff_id = $this->getStaffId($user_id);

        if ($is_subject_class_only == "true"){
            $where_data = array(
                'c.academic_year'   =>  $running_year,
                'c.branch_id'   =>  $user->branch,
                'c.dept_id'   =>  $user->dept,
                'sb.teacher_id'   =>  $staff_id
            );
            $this->db->where($where_data);
//        $this->db->select('c.class_id, cast(c.name as unsigned) as class_name,s.section_id,s.name as section_name ');
            $this->db->select('sb.class_id, c.name as class_name,sb.section_id,s.name as section_name ');
            $this->db->join('class c', 'c.class_id=sb.class_id', 'LEFT');
            $this->db->join('section s', 's.section_id=sb.section_id', 'LEFT');
            $class_list = $this->db->get('subject_teacher sb')->result();
        } else {
            if ($user->role == 4)
                $where_data = array(
                    'c.academic_year'   =>  $running_year,
                    'c.branch_id'   =>  $user->branch,
                    'c.dept_id'   =>  $user->dept
                );
            else if ($user->role == 6)
                $where_data = array(
                    'c.academic_year'   =>  $running_year,
//                'c.branch_id'   =>  $user->branch,
//                'c.dept_id'   =>  $user->dept,
                    's.teacher_id'   =>  $this->getStaffId($user_id)
                );
            else
                return [];

            $this->db->where($where_data);
//        $this->db->select('c.class_id, cast(c.name as unsigned) as class_name,s.section_id,s.name as section_name ');
            $this->db->select('c.class_id, c.name as class_name,s.section_id,s.name as section_name ');
            $this->db->join('section s', 's.class_id=c.class_id', 'LEFT');
//        $this->db->order_by('class_name',ASC);
//        $this->db->order_by('section_name',ASC);
            $class_list = $this->db->get('class c')->result();
        }

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
        $roles = array(4,6);
        $this->db->where_in('user_role_id', $roles);// Login for department admin and teacher only
        $this->db->select('user_id, user_role_id, is_class_teacher');
        $user = $this->db->get('tbl_users')->row();
        $settings = array(
            "afternoon_attendance"  =>  $this->db->get_where('settings', array('type' => 'afternoon_attendance'))->row()->description == "yes",
            "diary"  =>  $this->db->get_where('settings', array('type' => 'diary'))->row()->description == "1",
            "half_day_leave"  =>  $this->db->get_where('settings', array('type' => 'half_day_leave'))->row()->description == "yes"
        );
        if (is_null($user)){
            $user = array(
                "user_id"           =>  -1,
                "user_role_id"      =>  -1,
                "is_class_teacher"  =>  false,
                "settings"          =>  $settings
            );
        } else {
            $user->is_class_teacher = $user->is_class_teacher == "Y";
            $user->settings = $settings;
        }

        return $user;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * $ - HELPER FUNCTIONS -$
     * DO NOT WRITE API FUNCTIONS BELOW THIS AREA
     * USE THIS AREA FOR HELPER FUNCTIONS ONLY
     * */

    private function getStaffId($user_id){
        return $this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
    }

    private function get_login_details($student_id){
        $this->db->where('student_id', $student_id);
        $this->db->select('student_id, phone1 as username, password');
        return $this->db->get('student')->row();
    }

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
        $this->db->where('section_id',$section_id);
        $this->db->where('student_status_id',0);
        $this->db->select('count(*) as student_count');
        return $this->db->get('view_students')->row()->student_count;
    }

    private function get_user_details($user_id)
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

<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL & ~E_NOTICE);
        $this->load->database();
        $this->load->model('Api_admin_model');
        $this->load->helper('form');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * PLEASE WRITE ALL NEW FUNCTIONS BELOW THIS LINE
     * ALSO, WRITE NEW FUNCTIONS AT THE TOP (BELOW THIS LINE)
     * */

    public function delete_student_message(){
        /*
        * Sanal, 2019 08 02
        * */
        $data = json_decode(file_get_contents('php://input'), true);
        $message_ids = $data['$message_ids'];

        $response = $this->Api_admin_model->delete_student_message($message_ids);
        $status = $response > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($response,$status,$message);
    }
    public function list_teacher_student_messages(){
        /*
        * Sanal, 2019 08 02
        * */
        $user_id = $this->get('user_id');
        $result = $this->Api_admin_model->list_teacher_student_messages($user_id);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function send_teacher_student_message(){
        /*
       * Sanal, 2019 08 01, 15:40
       * */
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $section_id = $data['section_id'];
        $subject_id = $data['subject_id'];
        $message = $data['message'];
        $students = $data['students'];

        $result = $this->Api_admin_model->send_teacher_student_message($user_id,$section_id,$subject_id,$message,$students);

        $status = $result > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);

    }
    public function delete_home_work(){
        $data = json_decode(file_get_contents('php://input'), true);
        $homework_ids = $data['homework_ids'];

        $response_data = $this->Api_admin_model->delete_home_work($homework_ids);
        $status = $response_data > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($response_data,$status,$message);
    }
    public function list_home_works(){
        $user_id = $this->get('user_id');
        $result = $this->Api_admin_model->list_home_works($user_id);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function insert_home_work()
    {
        // * Sanal, 2019 07 02, 10 :45
        // *

        $data = json_decode(file_get_contents('php://input'), true);

        $user_id = $data['user_id'];
        $section_id = $data['section_id'];
        $subject_id = $data['subject_id'];
        $title = $data['title'];
        $description = $data['description'];
        $last_date = $data['last_date'];

        $response_data = $this->Api_admin_model->insert_home_work($user_id, $section_id, $subject_id, $title, $description, $last_date);
        $status = $response_data > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($response_data,$status,$message);
    }
    public function list_subjects(){
        $user_id = $this->get('user_id');
        $section_id = $this->get('section_id');
        $result = $this->Api_admin_model->list_subjects($user_id,$section_id);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function notification_sms(){
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $message = $data['message'];
        $send_phone2 = $data['send_phone2'];
        $sections = $data['sections'];
        $students = $data['students'];
//        $receivers = json_decode($data['receivers']);
        $this->send_response($this->Api_admin_model->notification_sms($user_id,$message,$send_phone2,$sections,$students));
    }
    public function login_details_sms(){
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $sectionId = $data['section_id'];
        $this->send_response($this->Api_admin_model->login_details_sms($user_id,$sectionId));
    }
    public function staff_sms(){
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $message = $data['message'];
        $receivers = $data['receivers'];
//        $receivers = json_decode($data['receivers']);
        $this->send_response($this->Api_admin_model->staff_sms($user_id,$message,$receivers));
    }
    public function list_templates(){
        $result = $this->Api_admin_model->list_templates();
        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function update_concession(){
        //
        //Sanal
        //20-04-2019

        $data = json_decode(file_get_contents('php://input'), true);

        $this->send_response($this->Api_admin_model->update_concession($data));
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
        $students_fee_master = $data['students_fee_master']; // this is an array.
//        $bus_fee_master = json_decode($data['bus_fee_master'],true); // this is an array.
        $bus_fee_master = $data['bus_fee_master']; // this is an array.
        $this->send_response($this->Api_admin_model->insert_fee($user_id, $student_id, $date_paid, $payment_mode, $students_fee_master, $bus_fee_master));
    }
    public function payment_history(){
        //
        //Sanal
        //16-04-2019
        $student_id=$this->get("student_id");
        $this->send_response($this->Api_admin_model->payment_history($student_id));
    }
    public function student_fee_details(){
        //
        //Sanal
        //16-04-2019
        $student_id=$this->get("student_id");

        $student_fee_data = ($this->Api_admin_model->student_fee_details($student_id));
        $student_bus_fee_data = ($this->Api_admin_model->student_bus_fee_details($student_id));

        $data['total']= $student_fee_data["total"] + $student_bus_fee_data["total"];
        $data['paid']= $student_fee_data["paid"] + $student_bus_fee_data["paid"];
        $data['concession']= $student_fee_data["concession"] + $student_bus_fee_data["concession"];
        $data['balance']= $student_fee_data["balance"] + $student_bus_fee_data["balance"];
        $data["student_fee_data"] = $student_fee_data;
        $data["student_bus_fee_data"] = $student_bus_fee_data;

        $status = sizeof($data) > 0;
//        $status = sizeof($student_fee_data["details"]) > 0 && sizeof($student_bus_fee_data["details"]) > 0 ;
        $message = $status ? "Success" : "Failed";
        $this->send_response($data, $status, $message);
//        $this->send_response($data);
    }
    public function list_staff(){
        //
        //Sanal
        //13-04-2019  12:35 PM
        $user_id = $this->get('user_id');
        $result = $this->Api_admin_model->list_staff($user_id);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function list_sections(){
        //
        //Sanal
        //13-04-2019  12:09 PM
        $class_id=$this->get('class_id');
        $this->send_response($this->Api_admin_model->list_sections($class_id));
    }
    public function student_details(){
        $student_id=$this->get('student_id');
        $this->send_response($this->Api_admin_model->student_details($student_id));
    }
    public function class_details(){
        $user_id=$this->get('user_id');
        $section_id=$this->get('section_id');
        $this->send_response($this->Api_admin_model->class_details($user_id,$section_id));
    }
    public function class_teacher(){
        $user_id=$this->get('user_id');
        $section_id=$this->get('section_id');
        $this->send_response($this->Api_admin_model->class_teacher($user_id,$section_id));
    }
    public function attendance_details()
    {
        $time_of_day = "" ;
        $user_id = $this->get('user_id');
        $date = $this->get_ymd($this->get('date'));
        if ($this->get('time_of_day') != -1) {
            $time_of_day = $this->get('time_of_day') == 1 ? "morning" : "afternoon";//Assuming, 1 = Morning, 2 = afternoon
        }
        $section_id = $this->get('section_id');
        $data = $this->Api_admin_model->attendance_details($user_id, $date, $time_of_day, $section_id);
        $status = sizeof($data) > 0;
        $message = $status ? "Success" : "Failed";
        if ($status) {
            $this->send_response($data,$status,$message);
        } else {
            $students = $this->Api_admin_model->list_students($section_id);
            $attendance = array();
            foreach ($students as $row) {
                $student['student_id'] = $row->student_id;
                $student['status'] = 0;
                array_push($attendance,$student);
            }
            $this->Api_admin_model->insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance, false, false, false);
            $data = $this->Api_admin_model->attendance_details($user_id, $date, $time_of_day, $section_id);
            $status = sizeof($data) > 0;
            $message = $status ? "Success" : "Failed";
            $this->send_response($data,$status,$message);
        }

    }
    public function search(){
        $user_id = $this->get('user_id');
        $keyword = $this->get('keyword');
        $this->send_response($this->Api_admin_model->search($user_id,$keyword));
    }
    public function insert_attendance()
    {
        // * Sanal, 2019 03 26, 14 :34
        // *

        $time_of_day = "" ;
        $data = json_decode(file_get_contents('php://input'), true);

        $user_id = $data['user_id'];
//        $send_present = $data['send_present'];
        $send_absent = $data['send_absent'];
        $send_late = $data['send_late'];
//        $send_no_diary = $data['send_no_diary'];
        $send_half_day_leave = $data['send_half_day_leave'];
        $date = $this->get_ymd($data['date']);
        if ($data['time_of_day'] != -1) {
            $time_of_day = $data['time_of_day'] == 1 ? "morning" : "afternoon";//Assuming, 1 = Morning, 2 = afternoon
        }
        $section_id = $data['section_id'];
        $attendance = json_decode($data['attendance'],true); // this is an array. Loop through it to get student status
//        echo '<pre>';
//        var_dump($attendance);
//        echo '</pre>';
//        die();
//        $attendance = $data['attendance']; // this is an array. Loop through it to get student status
        $this->send_response($this->Api_admin_model->insert_attendance($user_id, $section_id, $time_of_day, $date, $attendance, $send_absent, $send_late, $send_half_day_leave));
    }
	public function list_students()
    {
        //* Sanal, 2019 03 23, 16:42
        //*

        $section_id = $this->get('section_id');
		$result = $this->Api_admin_model->list_students($section_id);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function list_class()
    {
		 /*
        * WOLF, 2019 03 23, 16:42
        * */
        $user_id = $this->get('user_id');
        $is_subject_class_only = $this->get('is_subject_class_only');
        if (is_null($is_subject_class_only))
//            $this->send_response($this->Api_admin_model->list_class($user_id,false));
            $result = $this->Api_admin_model->list_class($user_id,false);
        else
//            $this->send_response($this->Api_admin_model->list_class($user_id,$is_subject_class_only));
            $result = $this->Api_admin_model->list_class($user_id,$is_subject_class_only);

        $status = sizeof($result) > 0;
        $message = $status ? "Success" : "Failed";
        $this->send_response($result, $status, $message);
    }
    public function login()
    {
        /*
         * WOLF, 2019 03 23, 12:10
         * */
        $username = $this->get('username'); // Use $this->get('param'); to get parameters. Don't use $_GET['param'] or $_POST['param'] or $_REQUEST['param']
        $password = $this->get('password');
        $user = $this->Api_admin_model->login($username, $password);
        $status = $user->user_id > 0; // If invalid user, user id is -1, so status false. Else userid will be greater than 0 so status will be true
        $message = $status ? "Success" : "Invalid username or password";
        $this->send_response($user, $status, $message);
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
        $this->send_response($this->Api_admin_model->test_api($name));
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

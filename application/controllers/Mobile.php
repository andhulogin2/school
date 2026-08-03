<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('MobileModel');
    }
    
	function teacher_message()
	{
        $student_id         =   $_REQUEST['student_id']; 
        $this->load->model('MobileModel');
        $response 	= $this->MobileModel->teacher_message($student_id);
        $this->send_response($response);
	}
	function teacher_message_update()
	{
		date_default_timezone_set('Asia/Kolkata');
        $message_id         =   $_REQUEST['message_id']; 
        $this->load->model('MobileModel');
        $response 	= $this->MobileModel->teacher_message_update($message_id);
        $this->send_response($response);
	}
    function timetable()
    {
        $student_id         =   $_REQUEST['student_id']; 
        $data               =   $this->MobileModel->timetable($student_id);
        $this->send_response($data);
    }
    function exam_time_table()
    {
        $student_id         =   $_REQUEST['student_id']; 
        $data               =   $this->MobileModel->exam_time_table($student_id);
        $this->send_response($data);
    }
    function list_albums()
    {
        $student_id         =   $_REQUEST['student_id']; 
        $this->load->model('MobileModel');
        $response['status'] =   true;
        $response['message']=   "";
        $response['data']   =   $this->MobileModel->list_albums($student_id);
        header('content-type:application/json');
        echo json_encode($response);
    }
    
    function list_photos()
    {
        $album_id           =   $_REQUEST['album_id']; 
        $this->load->model('MobileModel');
        $response['status'] =   true;
        $response['message']=   "";
        $response['data']   =   $this->MobileModel->list_photos($album_id);
        header('content-type:application/json');
        echo json_encode($response);
    }
    
    public function get_notification_count()
    {
        $student_id = $_REQUEST['uid'];

        header('content-type:application/json');
        echo '{
                  "status": true,
                  "message": "",
                  "data":{"count":12}
              }';
    }
    public function set_notification_delivered()
    {
        $student_id = $_REQUEST['uid'];
        $sub_table_id = $_REQUEST['nid']; // Notification Id in sub table 
        // Update delivered time to current timestamp
        header('content-type:application/json');
        echo '{
                  "status": true,
                  "message": "",
                  "data":""
              }';
    }
    public function set_notification_read()
    {
        $student_id = $_REQUEST['uid'];
        $sub_table_id = $_REQUEST['nid']; // Notification Id in sub table 
        // Update read time to current timestamp
        header('content-type:application/json');
        echo '{
                  "status": true,
                  "message": "",
                  "data":""
              }';
    }
    
    public function notification_details()
    {
        $student_id = $_REQUEST['uid'];
        $sub_table_id = $_REQUEST['nid']; // Notification Id in sub table 
        
        header('content-type:application/json');
        echo '{
  "status": true,
  "message": "",
  "data": 
    {
      "id": 1,
      "title": "Invitation to Christmas celebration",
      "message": "Dear parent, Login2 School invites you to the christmas celebration tomorrow.\n\nChristmas is the festival of great importance for the Christians however it is celebrated by the people of other religions also. It is celebrated every year with great joy, happiness and enthusiasm like other festivals throughout the world. It falls every year on 25th of December in the winter season. Christmas Day is celebrated on the anniversary of the Jesus Christ. On 25th of December, Jesus Christ was born to the Joseph (father) and Mary (mother) in the Bethlehem.\n\nAll the houses and churches are cleaned, white washed and decorated with lots of colourful light, sceneries, candles, flowers, and other decorative things. Everyone get together (whether they are poor or rich) and enjoy this festival with lots of activities. People make a Christmas tree at this day in the mid of their home. They decorate it with electric lights, gifts items, balloons, colourful flowers, toys, green leaves and other materials. Christmas tree looks very attractive and beautiful. People invite their friends, relatives and neighbours to join the celebration in front of the Christmas tree. People get together, dance, sing, distribute gifts, and enjoy eating delicious dinner.\n\nPeople of Christian religion pray to the God. They confess in front of their Jesus Christ about their sins and sufferings. People sing holy songs in the praise of their Lord Jesus. Later they distribute Christmas gifts to their guests and children. There is a trend of giving Christmas greetings or other beautiful Christmas cards to the friends and relatives. Everyone involve in the great celebration of Christmas feast and eat delicious dinner with family members and friends. Children of the home wait for this day very eagerly as they get lots of gifts and chocolates. Christmas celebration also takes place in the schools and colleges a day before means on 24th of December when students go to school wearing Santa dress or Christmas cap.\n\nPeople enjoy this festival late night by dancing and singing in the party or in the malls and restaurants. People of Christian religion worship their God, Jesus Christ. It is considered that Jesus (the Son of God) was sent to people on the earth to save their lives and protect them from their sins and sadness. People of the Christian religion celebrate this festival of Christmas to remember the great works of the Jesus and give lots of love and respect. It is a public and religious holiday when almost all the government and non-government organizations become closed.",
      "date_time": "22 Dec 2018, 11:15 AM",
      "img_url": "https://image.freepik.com/free-vector/merry-christmas-celebration-card-illustration_1344-275.jpg",
      "is_new": true
    }
}';
    }
    public function notification_list()
    {
        $student_id = $_REQUEST['uid'];
        // Fetch notifications for student_id
        header('content-type:application/json');
        echo '{
  "status": true,
  "message": "",
  "data": [
    {
      "id": 1,
      "title": "Invitation to Christmas celebration",
      "message": "Dear parent, Login2 School invites you to the christmas celebration tomorrow.",
      "date_time": "22 Dec 2018, 11:15 AM",
      "img_url": "https://image.freepik.com/free-vector/merry-christmas-celebration-card-illustration_1344-275.jpg",
      "is_new": true
    },
    {
      "id": 2,
      "title": "Half yearly examinations postponed",
      "message": "Half yearly examinations, scheduled to start on 15 Dec has been postponed to 15 January 2019",
      "date_time": "12 Dec 2018, 11:10 AM",
      "img_url": "",
      "is_new": true
    },
    {
      "id": 3,
      "title": "Holiday on 11 December",
      "message": "This is to remind that today is holiday for classes III and IV.",
      "date_time": "11 Dec 2018, 08:00 AM",
      "img_url": "",
      "is_new": false
    },
    {
      "id": 4,
      "title": "Holiday on 11 December",
      "message": "Due to maintenance work, the principal has declared holiday for classes III and IV on 11 December. Delay in conveying info is deeply regretted",
      "date_time": "10 Dec 2018, 09:23 PM",
      "img_url": "",
      "is_new": false
    }
  ]
}';
    }
    
    
    // public function send_notification( $firebase_token, $message_data)
    // {
    //     /*
    //     * Wolf, 2018-09-26, 10:13
    //     * */
    //     // $firebase_token = $this->ApiModel->get_firebase_id($user_id);
    //     $fields = array(
    //         'to' => $firebase_token,
    //         'data' => $message_data,
    //     );
    //     $headers = array(
    //         'Authorization: key=' . API_KEY,
    //         'Content-Type: application/json',
    //     );
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     $this->send_response($result);
    // }
    // public function new_message()
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:49
    //     * */
    //     $user_id = $_REQUEST['sender_id'];
    //     $receiver_id = -1;//Admin
    //     $media_type = $_REQUEST['mt'];
    //     $text = $_REQUEST['text'];
    //     $server_id = $this->MobileModel->insert_message($user_id, $receiver_id, $media_type, $text);
    //     $message_data = array(
    //         "type" => CHAT_NEW_MESSAGE,
    //         "message_id" => $server_id,
    //         "conversation_id" => $receiver_id,
    //         "media_type" => $media_type,
    //         "message" => $text,
    //         "url" => "",
    //         "file_size" => "",
    //     );
    //     $this->send_response($message_data);
    // }

    // public function upload_file()
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:47
    //     * */
    //     $user_id = $_POST['sender_id'];
    //     $media_type = $_POST['mt'];
    //     $text = $_POST['text'];
    //     $receiver_id = -1; // Admin
    //     $file_path = $this->get_uploads_directory($user_id, $media_type);
    //     if (isset($_FILES['file']['name'])) {
    //         $file_name = $file_path . basename($_FILES['file']['name']);
    //         $upload_path = FCPATH . $file_name;
    //         try {
    //             if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
    //                 $file_name = str_replace("\\", "/", $file_name);
    //                 $server_id = $this->MobileModel->insert_message($user_id, $receiver_id, $media_type, $text, $file_name);
    //                 $message_data = array(
    //                     "type" => CHAT_NEW_MESSAGE,
    //                     "message_id" => $server_id,
    //                     "conversation_id" => 1,
    //                     "media_type" => $media_type,
    //                     "message" => $text,
    //                     "url" => $file_name,
    //                     "file_size" => $this->human_filesize($upload_path),
    //                 );
    //                 $this->send_response($message_data);
    //             } else {
    //                 $this->send_response('', false, "Couldn't move file");
    //             }
    //         } catch (Exception $e) {
    //             $this->send_response('', false, $e->getMessage());
    //         }
    //     } else {
    //         $this->send_response('', false, "Didn't receive file");
    //     }
    // }

    // private function get_uploads_directory($user_id, $media_type)
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:42
    //     * */
    //     $uploads_dir = "uploads" . DIRECTORY_SEPARATOR . "chat" . DIRECTORY_SEPARATOR;
    //     switch ($media_type) {
    //         case MEDIA_TYPE_IMAGE:
    //             $uploads_dir = $uploads_dir . $user_id . DIRECTORY_SEPARATOR . DIR_IMAGE;
    //             break;
    //         case MEDIA_TYPE_VIDEO:
    //             $uploads_dir = $uploads_dir . $user_id . DIRECTORY_SEPARATOR . DIR_VIDEO;
    //             break;
    //         case MEDIA_TYPE_AUDIO:
    //             $uploads_dir = $uploads_dir . $user_id . DIRECTORY_SEPARATOR . DIR_AUDIO;
    //             break;
    //     }
    //     $this->create_directory(FCPATH . $uploads_dir);
    //     return $uploads_dir . DIRECTORY_SEPARATOR;
    // }

    // private function create_directory($path)
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:40
    //     * */
    //     if (!file_exists($path)) {
    //         mkdir($path, 0777, true);
    //     }
    // }

    // public function human_filesize($file_path)
    // {
    //     /*
    //     * Wolf, 2018-09-25, 14:55
    //     * */
    //     $size = filesize($file_path);
    //     $precision = 2;
    //     $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    //     $step = 1024;
    //     $i = 0;
    //     while (($size / $step) > 0.9) {
    //         $size = $size / $step;
    //         $i++;
    //     }
    //     return round($size, $precision) . $units[$i];
    // }

    // public function set_message_read()
    // {
    //     /*
    //     * Wolf, 2018-09-25, 14:55
    //     * */
    //     $mid = $_REQUEST['mid'];
    //     $time = $_REQUEST['time'];
    //     $this->MobileModel->set_message_read($mid, $time);
    //     $this->send_response("", true, "read_time_updated");
    // }

    // public function set_message_received()
    // {
    //     /*
    //     * Wolf, 2018-09-25, 14:50
    //     * */
    //     $mid = $_REQUEST['mid'];
    //     $time = $_REQUEST['time'];
    //     $this->MobileModel->set_message_received($mid, $time);
    //     $this->send_response("", true, "delivered_time_updated");
    // }

    private function send_response($data, $status = true, $message = "")
    {
        /*
         * Wolf, 2018-09-25, 11:12
         * */
        header('Content-Type:application/json');
        $response['status'] = $status;
        $response['message'] = $message;
        $response['data'] = $data;
        echo json_encode($response);
    }

    function update_firebase_token($user_id, $firebase_token)
    {
        /*
         * Wolf, 2018-09-25, 11:20
         * */
        $this->db->set('firebase_token', $firebase_token);
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users');
    }

    // Edited login function, Wolf on 20180925 @ 1606
    function login()
    {
        $year   =   get_running_year();    
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        //$firebase_token = $_REQUEST['fb_token'];
        $this->db->where('u.username', $username);
        $this->db->where('u.password', sha1($password));
        $this->db->where('u.user_role_id', '10');
        $this->db->join('student s', 's.user_id=u.user_id', 'LEFT');
        $this->db->join('enroll e', 'e.student_id=s.student_id and e.year='.$year);
        $query3 = $this->db->get('tbl_users u');
        if ($query3->num_rows() > 0) {
            $id = $query3->row()->student_id;
            $name = $query3->row()->name;
            $user_id = $query3->row()->user_id;
            //$this->update_firebase_token($user_id, $firebase_token);
            $message = "success";
        } else {
            $user_id = -1;
            $id = '';
            $message = "invalid";
        }
        $data['student_id'] = $id;
        $data['name'] = $name;
        $data['user_id'] = $user_id;
        $data['message'] = $message;
        echo json_encode($data);
    }


    function get_class()
    {
        $response = array();
        $classes = $this->db->get('class')->result_array();
        foreach ($classes as $row) {
            $data['class_id'] = $row['class_id'];
            $data['name'] = $row['name'];
            $data['name_numeric'] = $row['name_numeric'];
            $data['teacher_id'] = $row['teacher_id'];
            $sections = $this->db->get_where('section', array('class_id' => $row['class_id']))->result_array();
            $data['sections'] = $sections;
            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_image_url($type = '', $id = '')
    {
        $type = $this->input->post('user_type');
        $id = $this->input->post('user_id');
        $response = array();

        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $response['image_url'] = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $response['image_url'] = base_url() . 'uploads/user.jpg';
        echo json_encode($response);
    }

    function get_system_info()
    {
        $response['system_name'] = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        echo json_encode($response);
    }

    function get_students_of_class()
    {
        $response = array();
        $class_id = $this->input->post('class_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year))->result_array();

        foreach ($students as $row) {
            $data['student_id'] = $row['student_id'];
            $data['roll'] = $row['roll'];

            $data['name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $data['birthday'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->birthday;
            $data['gender'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex;
            $data['address'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address;
            $data['phone'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone;
            $data['email'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email;
            $data['class'] = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
            $data['section'] = $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;
            $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
            $data['parent_name'] = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;

            $data['image_url'] = $this->crud_model->get_image_url('student', $row['student_id']);

            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_student_profile_information()
    {
        $response = array();
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_id = $this->input->post('student_id');
        $roll = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->roll;
        $class_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->class_id;
        $section_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->section_id;

        $student_profile = $this->db->get_where('student', array('student_id' => $student_id))->result_array();

        foreach ($student_profile as $row) {
            $data['student_id'] = $row['student_id'];
            $data['name'] = $row['name'];
            $data['birthday'] = $row['birthday'];
            $data['gender'] = $row['sex'];
            $data['address'] = $row['address'];
            $data['phone'] = $row['phone'];
            $data['email'] = $row['email'];
            $data['roll'] = $roll;
            $data['class'] = $class_id;
            $data['section'] = $section_id;
            $data['parent_name'] = $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->name;
            $data['image_url'] = $this->crud_model->get_image_url('student', $row['student_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_student_mark_information()
    {
        $response = array();
        $mark_array = array();
        $exam_id = $this->input->post('exam_id');
        $student_id = $this->input->post('student_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $student_marks = $this->db->get_where('mark', array('exam_id' => $exam_id,
            'student_id' => $student_id,
            'year' => $running_year))->result_array();

        $response['exam_id'] = $exam_id;
        foreach ($student_marks as $row) {
            $data['mark_obtained'] = $row['mark_obtained'];
            $data['subject'] = $this->db->get_where('subject',
                array('subject_id' => $row['subject_id'],
                    'year' => $running_year))->row()->name;

            $grade = $this->crud_model->get_grade($row['mark_obtained']);
            $data['grade'] = $grade['name'];
            array_push($mark_array, $data);
        }
        $response['marks'] = $mark_array;
        echo json_encode($response);
    }

    function get_teachers()
    {
        $response = array();
        $teachers = $this->db->get('teacher')->result_array();
        foreach ($teachers as $row) {
            $data['teacher_id'] = $row['teacher_id'];
            $data['name'] = $row['name'];
            $data['birthday'] = $row['birthday'];
            $data['gender'] = $row['sex'];
            $data['address'] = $row['address'];
            $data['phone'] = $row['phone'];
            $data['email'] = $row['email'];
            $data['image_url'] = $this->crud_model->get_image_url('teacher', $row['teacher_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_teacher_profile()
    {
        $response = array();
        $teacher_id = $this->input->post('teacher_id');
        $response = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        echo json_encode($response);
    }

    function get_parents()
    {
        $response = array();
        $parents = $this->db->get('parent')->result_array();
        foreach ($parents as $row) {
            $data['parent_id'] = $row['parent_id'];
            $data['name'] = $row['name'];
            $data['profession'] = $row['profession'];
            $data['address'] = $row['address'];
            $data['phone'] = $row['phone'];
            $data['email'] = $row['email'];
            $data['image_url'] = $this->crud_model->get_image_url('parent', $row['parent_id']);
            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_parent_profile()
    {
        $response = array();
        $parent_id = $this->input->post('parent_id');
        $response = $this->db->get_where('parent', array('parent_id' => $parent_id))->row();
        echo json_encode($response);
    }

    function get_accounting()
    {
        $response = array();
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $type = $this->input->post('type');
        $start_timestamp = strtotime("1-" . $month . "-" . $year);
        $end_timestamp = strtotime("30-" . $month . "-" . $year);
        $this->db->where("timestamp >=", $start_timestamp);
        $this->db->where("timestamp <=", $end_timestamp);
        $this->db->where("payment_type", $type);
        $response = $this->db->get('payment')->result_array();
        echo json_encode($response);
    }

    function get_attendance()
    {
        $response = array();
        $date = $this->input->post('date');
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $class_id = $this->input->post('class_id');
        $timestamp = strtotime($date . '-' . $month . '-' . $year);
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year))->result_array();
        foreach ($students as $row) {
            $data['student_id'] = $row['student_id'];
            $data['roll'] = $row['roll'];
            $data['name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;

            $attendance_query = $this->db->get_where('attendance', array('timestamp' => $timestamp,
                'student_id' => $row['student_id']));
            if ($attendance_query->num_rows() > 0) {
                $attendance_result_row = $attendance_query->row();
                $data['status'] = $attendance_result_row->status;
            } else {
                $data['status'] = '0';
            }

            array_push($response, $data);
        }

        echo json_encode($response);
    }


    function get_class_routine()
    {

        $response = array();
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $day = $this->input->post('day');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_routines = $this->db->get_where('class_routine', array('class_id' => $class_id,
            'section_id' => $section_id,
            'day' => $day,
            'year' => $running_year))->result_array();
        foreach ($class_routines as $row) {
            $data['class_id'] = $row['class_id'];
            $data['subject'] = $this->db->get_where('subject', array('subject_id' => $row['subject_id'],
                'year' => $running_year))->row()->name;
            $data['time_start'] = $row['time_start'];
            $data['time_end'] = $row['time_end'];
            $data['time_start_min'] = $row['time_start_min'];
            $data['time_end_min'] = $row['time_end_min'];
            $data['day'] = $row['day'];

            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_subject_name()
    {

        $response = array();
        $subject_id = $this->input->post('subject_id');
        $response = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        echo json_encode($response);
    }

    function get_event_calendar()
    {

        $response = array();
        $response = $this->db->get('noticeboard')->result_array();
        echo json_encode($response);
    }

    function get_exam_list()
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $response = array();
        $response = $this->db->get_where('exam', array('year' => $running_year))->result_array();
        echo json_encode($response);
    }

    function get_subject_of_class()
    {

        $response = array();
        $class_id = $this->input->post('class_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'year' => $running_year))->result_array();

        foreach ($subjects as $row) {
            $data['subject_id'] = $row['subject_id'];
            $data['name'] = $row['name'];

            $teacher_query = $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']));
            if ($teacher_query->num_rows() > 0) {
                $teacher_query_row = $teacher_query->row();
                $data['teacher_name'] = $teacher_query_row->name;
            } else {
                $data['teacher_name'] = '';
            }


            array_push($response, $data);
        }
        echo json_encode($response);
    }

    function get_marks()
    {

        $response = array();
        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $marks = $this->db->get_where('mark', array('exam_id' => $exam_id,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'year' => $running_year))->result_array();
        foreach ($marks as $row) {
            $data['class_id'] = $row['class_id'];
            $data['student_id'] = $row['student_id'];
            $data['student_name'] = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
            $data['student_roll'] = $this->db->get_where('enroll', array('student_id' => $row['student_id'], 'year' => $running_year))->row()->roll;
            $data['exam_id'] = $row['exam_id'];
            $data['mark_obtained'] = $row['mark_obtained'];

            array_push($response, $data);
        }

        echo json_encode($response);
    }

    function get_loggedin_user_profile()
    {

        $response = array();
        $login_type = $this->input->post('login_type');
        $login_user_id = $this->input->post('login_user_id');
        $user_profile = $this->db->get_where($login_type, array($login_type . '_id' => $login_user_id))->result_array();

        foreach ($user_profile as $row) {
            $data['name'] = $row['name'];
            $data['email'] = $row['email'];
            $data['image_url'] = $this->crud_model->get_image_url($login_type, $login_user_id);
            break;
        }
        array_push($response, $data);

        echo json_encode($response);

    }


    function update_user_image()
    {
        $response = array();
        $user_type = $this->input->post('login_type');
        $user_id = $this->input->post('login_user_id');

        $directory = 'uploads/' . $user_type . '_image/' . $user_id . '.jpg';
        move_uploaded_file($_FILES['user_image']['tmp_name'], $directory);

        $response = array('update_status' => 'success');
        echo json_encode($response);
    }


    function update_user_info()
    {
        $response = array();
        $user_type = $this->input->post('login_type');
        $user_id = $this->input->post('login_user_id');

        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $this->db->where($user_type . '_id', $user_id);
        $this->db->update($user_type, $data);


        $response = array('update_status' => 'success');
        echo json_encode($response);
    }


    function update_user_password()
    {
        $response = array();
        $user_type = $this->input->post('login_type');
        $user_id = $this->input->post('login_user_id');

        $old_password = sha1($this->input->post('old_password'));
        $data['password'] = sha1($this->input->post('new_password'));
        $this->db->where($user_type . '_id', $user_id);
        $this->db->where('password', $old_password);
        $verify_query = $this->db->get($user_type);

        if ($verify_query->num_rows() > 0) {
            $this->db->where($user_type . '_id', $user_id);
            $this->db->update($user_type, $data);

            $response = array('update_status' => 'success');
        } else {
            $response = array('update_status' => 'failed');
        }

        echo json_encode($response);
    }

    function get_total_summary()
    {

        $response = array();
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $this->db->where('year', $running_year);
        $this->db->from('enroll');
        $response['total_student'] = $this->db->count_all_results();
        $response['total_teacher'] = $this->db->count_all('teacher');
        $response['total_parent'] = $this->db->count_all('parent');
        $check = array('timestamp' => strtotime(date('d-m-Y')), 'status' => '1');
        $query = $this->db->get_where('attendance', $check);
        $present_today = $query->num_rows();

        $response['total_present_today'] = $present_today;
        echo json_encode($response);
    }

    function getdata()
    {

        $response = array();
        $postvar = $this->input->post('postvar');
        $response = $this->db->get_where('table', array('postvar' => $postvar))->result_array();
        echo json_encode($response);
    }

    function get_children_of_parent()
    {

        $response = array();
        $parent_id = $this->input->post('parent_id');
        $response['children'] = $this->db->get_where('student', array('parent_id' => $parent_id))->result_array();
        echo json_encode($response);
    }

    function get_child_class_routine()
    {

    }

    function get_child_exam_marks()
    {

    }

    function get_child_accounting()
    {

    }

    function get_own_subjects()
    {

    }

    function get_own_class_routine()
    {

    }

    function get_own_marks()
    {

    }

    function get_single_student_accounting()
    {

        $response = array();
        $student_id = $this->input->post("student_id");
        $this->db->where("student_id", $student_id);
        $response = $this->db->get('invoice')->result_array();
        echo json_encode($response);
    }

    function login1()
    {
        $response = array();
        $email = $this->input->post("user");
        $password = sha1($this->input->post("password"));
        echo $email;
        $query = $this->db->get_where('admin', array('email' => $email, 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key = md5(rand(10000, 1000000));
            $response['status'] = 'success';
            $response['login_type'] = 'admin';
            $response['login_user_id'] = $row->admin_id;
            $response['name'] = $row->name;
            $response['authentication_key'] = $authentication_key;

            $this->db->where('admin_id', $row->admin_id);
            $this->db->update('admin', array('authentication_key' => $authentication_key));

            echo json_encode($response);
            return;

        }

        $query = $this->db->get_where('teacher', array('email' => $email, 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key = md5(rand(10000, 1000000));
            $response['status'] = 'success';
            $response['login_type'] = 'teacher';
            $response['login_user_id'] = $row->teacher_id;
            $response['name'] = $row->name;
            $response['authentication_key'] = $authentication_key;
            $this->db->where('teacher_id', $row->teacher_id);
            $this->db->update('teacher', array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;

        }

        $query = $this->db->get_where('student', array('email' => $email, 'password' => $password));
        if ($query->num_rows() > 0) {
            $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

            $row = $query->row();

            $authentication_key = md5(rand(10000, 1000000));
            $response['status'] = 'success';
            $response['login_type'] = 'student';
            $response['login_user_id'] = $row->student_id;
            $response['name'] = $row->name;
            $response['authentication_key'] = $authentication_key;

            $response['class_id'] = $this->db->get_where('enroll', array(
                'student_id' => $row->student_id, 'year' => $running_year
            ))->row()->class_id;

            $response['section_id'] = $this->db->get_where('enroll', array(
                'student_id' => $row->student_id, 'year' => $running_year
            ))->row()->section_id;
            $this->db->where('student_id', $row->student_id);
            $this->db->update('student', array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;

        }

        $query = $this->db->get_where('parent', array('email' => $email, 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key = md5(rand(10000, 1000000));
            $response['status'] = 'success';
            $response['login_type'] = 'parent';
            $response['login_user_id'] = $row->parent_id;
            $response['name'] = $row->name;
            $response['authentication_key'] = $authentication_key;

            $response['children'] = $this->db->get_where('student', array('parent_id' => $row->parent_id))->result_array();

            $this->db->where('parent_id', $row->parent_id);
            $this->db->update('parent', array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;
        } else {
            $response['status'] = 'failed';
        }
        echo json_encode($response);
    }

    function validate_auth_key()
    {

        if ($this->input->post('authenticate') == 'false')
            return 'success';
        $response = array();
        $authentication_key = $this->input->post("authentication_key");
        $user_type = $this->input->post("user_type");

        $query = $this->db->get_where($user_type, array('authentication_key' => $authentication_key));
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $response['status'] = 'success';
            $response['login_type'] = 'admin';
            if ($user_type == 'admin')
                $response['login_user_id'] = $row->admin_id;
            if ($user_type == 'teacher')
                $response['login_user_id'] = $row->teacher_id;
            if ($user_type == 'student')
                $response['login_user_id'] = $row->student_id;
            if ($user_type == 'parent')
                $response['login_user_id'] = $row->parent_id;
            $response['authentication_key'] = $authentication_key;
        } else {
            $response['status'] = 'failed';
        }
        return $response['status'];
    }

    //Created by Jishnu.....(start)


    function news()
    {
        $response = array();
        //$title = $_REQUEST['title'];
        $limit = $_REQUEST['limit'];
        $this->load->model('MobileModel');
        $news = $this->MobileModel->news($limit);
        array_push($response, $news);
        echo json_encode($response);

    }

    function student_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];

        $this->load->model('MobileModel');
        $student = $this->MobileModel->student($id);
        $student_image = $this->MobileModel->student_img($id);
        array_push($response, $student, $student_image);
        echo json_encode($response);
    }

    function slider()
    {
        $response = array();
        $image_url1 = base_url() . 'uploads/slider/slider1.png';
        $image_url2 = base_url() . 'uploads/slider/slider2.png';
        $image_url3 = base_url() . 'uploads/slider/slider3.png';
        array_push($response, $image_url1, $image_url2, $image_url3);
        echo json_encode($response);

    }

    function system_setings()
    {
        $this->load->model('MobileModel');
        $setings = $this->MobileModel->student_info();
        echo json_encode($setings);
    }


    function attendence_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $this->load->model('MobileModel');
        $attendence = $this->MobileModel->attendence($id, $month, $year);
        //array_push($response,$attendence);
        echo json_encode($attendence);

    }

    function attendence_details1()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $this->load->model('MobileModel');
        $a = $this->MobileModel->attendence2($id, $month, $year);
        array_push($response, $a);
        echo json_encode($response);

    }

    function attendance_report()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $this->load->model('MobileModel');
        $a = $this->MobileModel->attendence_report($id, $month, $year);
        array_push($response, $a);
        echo json_encode($response);

    }

    function exam_report()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $exam_id = $_REQUEST['exam_id'];
        $limit = $_REQUEST['limit'];
        $this->load->model('MobileModel');
        $exam = $this->MobileModel->exam_report($id, $limit, $exam_id);
        //array_push($response,$exam);
        echo json_encode($exam);
    }

    function exam_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $this->load->model('MobileModel');
        $exam = $this->MobileModel->exam_details($id);
        // array_push($response,$exam);
        echo json_encode($exam);
    }


    function logo()
    {
        $response = array();
        $image_url1 = base_url() . 'uploads/logo.png';
        array_push($response, $image_url1);
        echo json_encode($response);
    }


    function exam_report1()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $name = $_REQUEST['name'];
        $class = $_REQUEST['class'];
        $section = $_REQUEST['section'];
        $limit = $_REQUEST['limit'];
        $this->load->model('MobileModel');
        $exam = $this->MobileModel->exam_report1($id, $name, $limit, $class, $section);
        array_push($response, $exam);
        echo json_encode($response);
    }

    function add_complaint()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        $teacher_id = $_REQUEST['teacher_id'];
        $this->load->model('MobileModel');
        $this->db->where('student_id', $id);
        $stud = $this->db->get('student')->row();
        $branch_id = $stud->branch_id;
        $dept_id = $stud->dept_id;

        // $date	 = $_REQUEST['date'];

        $complaint = $this->MobileModel->complaint($id, $title, $description, $teacher_id, $branch_id, $dept_id);
        echo json_encode("Complaint Registered Successfully");
    }

    function view_teacher()
    {
        $this->load->model('MobileModel');
        $view1 = $this->MobileModel->view_teacher();
        echo json_encode($view1);
    }

    function add_enquiry()
    {
        $response = array();
        $student_id = $_REQUEST['student_id'];
        $title = $_REQUEST['title'];
        $description = $_REQUEST['description'];
        // $date	 = $_REQUEST['date'];
        $this->db->where('student_id', $student_id);
        $stud = $this->db->get('student')->row();
        $branch_id = $stud->branch_id;
        $dept_id = $stud->dept_id;
        $this->load->model('MobileModel');
        $enq = $this->MobileModel->enquiry($student_id, $title, $description, $branch_id, $dept_id);
        echo json_encode("Added Successfully");
    }

    function homework()
    {
        $response = array();
        $student_id = $_REQUEST['student_id'];
        //$id = $_REQUEST['homework_id'];
        // $class = $this->input->get('class');
        $this->load->model('MobileModel');
        $homework = $this->MobileModel->homework1($student_id);
        array_push($response, $homework);
        echo json_encode($response);
    }

    function study_meterial()
    {
        $response = array();
        $student_id = $_REQUEST['student_id'];
        //$id = $_REQUEST['document_id'];
        //$class = $this->input->get('class');
        $this->load->model('MobileModel');
        $document = $this->MobileModel->study_meterial($student_id);
        array_push($response, $document);
        echo json_encode($response);
    }

    function fees()
    {
        $response = array();
        $id = $_REQUEST['student_id'];

        $this->load->model('MobileModel');
        $fees = $this->MobileModel->fees($id);
        array_push($response, $fees);
        echo json_encode($response);
    }

    function fees_head()
    {
        $response = array();
        $id = $_REQUEST['student_id'];

        $this->load->model('MobileModel');
        $fees = $this->MobileModel->fees_head($id);
        array_push($response, $fees);
        echo json_encode($response);
    }

    function change_password()
    {
        $student_id = $_REQUEST['student_id'];
        $password = $_REQUEST['password'];
        $new = $_REQUEST['new'];
        $confirm = $_REQUEST['confirm'];
        $this->db->where('student_id', $student_id);
        $user_id = $this->db->get('student')->row();

        if ($new == $confirm) {
            //echo "fe";
            $data1['password'] = sha1($confirm);
            $this->db->where('user_id', $user_id->user_id);
            $this->db->where('password', sha1($password));
            $this->db->update('tbl_users', $data1);
            //$query3=$this->db->get_where('student' ,array('username'=>$username,'password'=>$password))->row();
            // if($query3 >0)
            //{
            //$id= $query3->student_id;
            $message = "success";
        } else {
            $message = "invalid";
            // echo "yyyy";
        }
        //$data['student_id']=$id;
        $data['message'] = $message;
        echo json_encode($data);
    }

    function fees_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];

        $this->load->model('MobileModel');
        $fees = $this->MobileModel->fees_details($id);
        array_push($response, $fees);
        echo json_encode($response);
    }

    function fees_details_head()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $n_month = $_REQUEST['n_month'];
        $n_year = $_REQUEST['n_year'];


        $this->load->model('MobileModel');
        $fees = $this->MobileModel->fees_details_head($id, $month, $year, $n_month);
        array_push($response, $fees);
        echo json_encode($response);
    }

    function fees_details_head1()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        //$fees_head = $this->input->get('fees_head');
        //  $year = $this->input->get('year');
        // $n_month = $this->input->get('n_month');
        //$n_year = $this->input->get('n_year');


        $this->load->model('MobileModel');
        $fees = $this->MobileModel->fees_details_head1($id);
        //array_push($response,$fees);
        echo json_encode($fees);
    }


    function next_due_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        // $month = $this->input->get('month');
        //$year = $this->input->get('year');
        // $n_month = $this->input->get('n_month');
        //$n_year = $this->input->get('n_year');


        $this->load->model('MobileModel');
        $data['over_due'] = $this->MobileModel->over_due_details($id);//echo $this->db->last_query();die;
        $data['this_month'] = $this->MobileModel->current_due_details($id);
        $data['next_month'] = $this->MobileModel->next_due_details($id);
        //array_push($response,$data);
        header('Content-Type:application/json');
        echo json_encode($data);
    }


    function paid_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $this->load->model('MobileModel');
        $fees_paid = $this->MobileModel->paid_details($id);
        // array_push($response,$fees_paid);
        echo json_encode($fees_paid);
    }

    function pending_details()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $this->load->model('MobileModel');
        $pending_details = $this->MobileModel->pending_details($id);
        // array_push($response,$pending_details);
        echo json_encode($pending_details);
    }


    function otp1()
    {
        $response = array();
        //$phone1 = $this->input->get('phone');
        //$message=$this->input->get('message');
        $this->load->model('MobileModel');
        $opt = $this->MobileModel->otp();
        //array_push($response,$opt);
        header('Content-Type:application/json');
        echo json_encode($opt);

        //else{
        //echo json_encode("failed");}


    }

    function check_number()
    {
        $response = array();
        $phone1 = $_REQUEST['phone'];
        //$message=$this->input->get('message');
        $this->load->model('MobileModel');
        $check_number = $this->MobileModel->check_number($phone1);
        //$msg="Mobile number verified";
        //array_push($response,$check_number);
        header('Content-Type:application/json');
        echo json_encode($check_number);

        //else{
        //echo json_encode("failed");}


    }

    function forgot_password()
    {
        //$response = array();
        $student_id = $_REQUEST['student_id'];
        $password = $_REQUEST['password'];
        $phone1 = $_REQUEST['phone1'];
        //echo $phone1;
        // die();
        //$message=$this->input->get('message');
        // $this->load->model('MobileModel');
        //$forgot_password= $this->MobileModel->forgot_password($student_id,$password,$phone);
        //$msg="Mobile number verified";
        $this->db->where('student_id', $student_id);
        $user_id = $this->db->get('student')->row()->user_id;
        if ($password) {
            $data1['password'] = sha1($password);
            $this->db->where('user_id', $user_id);

            $this->db->update('tbl_users', $data1);

            // array_push();
            header('Content-Type:application/json');
            echo json_encode("success");
        } else {
            header('Content-Type:application/json');
            echo json_encode("failed");
        }


    }

    function about()
    {
        $response = array();


        $this->load->model('MobileModel');
        $about = $this->MobileModel->about();
        array_push($response, $about);
        echo json_encode($response);
    }

    function attendence_details_report()
    {
        $response = array();
        $id = $_REQUEST['student_id'];
        $month = $_REQUEST['month'];
        $year = $_REQUEST['year'];
        $this->load->model('MobileModel');
        $attendence = $this->MobileModel->attendance1($id, $month, $year);
        array_push($response, $attendence);
        echo json_encode($response);

    }

    function special_fees()
    {
        $id = $_REQUEST['student_id'];
        $this->load->model('MobileModel');
        $data['special_fees'] = $this->MobileModel->special_fees($id);
        header('Content-Type:application/json');
        echo json_encode($data);
    }


    // End of jishnu
	
	
	function student_message()
	{
		$id 					= 	$_REQUEST['student_id'];
        $this->load->model('MobileModel');
        $data['message_data'] 	= 	$this->MobileModel->student_message($id);
        header('Content-Type:application/json');
        echo json_encode($data);
	}
	function update_message_status()
	{
		$id 					= 	$_REQUEST['message_id'];
		$date_time				=	$_REQUEST['date_time'];
		$this->db->set('viewed','Y');
		$this->db->set('viewed_date_time',$date_time);
		$this->db->where('message_id',$id);
		$this->db->update('tbl_teacher_student_message');
	}
	

}




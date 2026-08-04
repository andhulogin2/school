<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('Student_model');
        $this->load->model('User_model');
        $this->load->model('Hourly_attendance_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function student_dashboard()
    {
        $this->load->view('student/student_dashboard.php');
    }
    
    public function subject($param1 = '', $param2 = '')
    {
        $yr = get_running_year();
        $user_id = $this->session->userdata('login_user_id');

        $student_profile = $this->Student_model->get_student_by_user_id($user_id);
        if ($student_profile) {
            $enroll_query = $this->db->select('class_id')->from('enroll')->where('student_id', $student_profile->student_id)->where('year', $yr)->get();
            $student_class_id = ($enroll_query->num_rows() > 0) ? $enroll_query->row()->class_id : 0;
            
            $page_data['subjects'] = $this->db->select('subject_id, name, class_id, year')->from('subject')->where(array('class_id' => $student_class_id, 'year' => $yr))->get()->result_array();
        } else {
            $page_data['subjects'] = array();
        }

        $this->load->view('student/subject', $page_data);
    }
    
    public function my_marks($user_id = '')
    {
        $target_user_id = !empty($user_id) ? $user_id : $this->session->userdata('login_user_id');
        $student = $this->Student_model->get_student_by_user_id($target_user_id);

        if ($student) {
            $enroll_query = $this->db->select('class_id')->from('enroll')->where('student_id', $student->student_id)->get();
            $class_id = ($enroll_query->num_rows() > 0) ? $enroll_query->row()->class_id : 0;
            
            $page_data['class_id']   = $class_id;
            $page_data['student_id'] = $student->student_id;
        } else {
            $page_data['class_id']   = 0;
            $page_data['student_id'] = 0;
        }

        $this->load->view('student/my_marks', $page_data);
    }
    
    public function attendance_report() 
    {
        $page_data['month'] = date('m');
        $this->load->view('student/attendance_report', $page_data);
    }
     
    public function attendance_report_selector()
    {
        $class_id   = $this->input->post('class_id', TRUE);
        $year1      = $this->input->post('year1', TRUE);
        $month      = $this->input->post('month', TRUE);
        $section_id = $this->input->post('section_id', TRUE);
        $student_id = $this->input->post('student', TRUE);
        
        redirect(base_url().'index.php/student/report_attendance_view/'.$class_id.'/'.$section_id.'/'.$month.'/'.$student_id.'/'.$year1, 'refresh');
    }
    
    public function news_view($param1 = '', $param2 = '')
    {
        if ($param1 == 'details') {
            $page_data['room_page'] = 'details';
            $page_data['news_code'] = $param2;
        }
        
        $news_query = $this->db->select('title')->from('news')->where('news_code', $param2)->get();
        $page_data['news'] = ($news_query->num_rows() > 0) ? $news_query->row()->title : '';
        $this->load->view('student/news_overview', $page_data);
    }
    
    public function report_attendance_view($class_id = '', $section_id = '', $month = '', $student = '', $year1 = '') 
    {
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['month']      = $month;
        $page_data['year1']      = $year1;
        $page_data['student_id'] = $student;
        $this->load->view('student/report_attendance_view', $page_data);
    }
      
    public function news() 
    {
        $this->load->view('student/news');
    }
    
    public function newsroom($param1 = '')
    {
        $page_data['room_page'] = 'news_overview';
        $page_data['news_code'] = $param1;
        
        $news_query = $this->db->select('title')->from('news')->where('news_code', $param1)->get();
        $page_data['page_title'] = ($news_query->num_rows() > 0) ? $news_query->row()->title : '';
        $this->load->view('student/newsroom', $page_data);
    }
    
    public function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add') {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php/student/news', 'refresh');
        }
    }
    
    public function complaint() 
    {
        $this->load->view('student/complaints');
    }
    
    public function teacher_complaints($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($param1 == 'create') {
            $this->crud_model->create_report();
            redirect(base_url() . 'index.php/student/complaint/', 'refresh');
        }
    }
    
    public function enquiry() 
    {
        $this->load->view('student/enquiry_add');
    }
    
    public function add_enquiry($param1 = '', $param2 = '', $param3 = '') 
    {
        if ($param1 == 'create') {
            $this->crud_model->create_enquiry();
            redirect(base_url() . 'index.php/student/enquiry/', 'refresh');
        }
    }
    
    public function study_material($task = "", $document_id = "")
    {
        $data['study_material_info'] = $this->crud_model->select_study_material_info_for_student();
        $this->load->view('student/study_material', $data);
    }
    
    public function homework($student_id = '')
    {
        $yr = get_running_year();
        $user_id = $this->session->userdata('login_user_id');

        $student = $this->Student_model->get_student_by_user_id($user_id);
        if ($student) {
            $enroll_query = $this->db->select('class_id')->from('enroll')->where(array('student_id' => $student->student_id, 'year' => $yr))->get();
            $class_id = ($enroll_query->num_rows() > 0) ? $enroll_query->row()->class_id : 0;
            $page_data['student_id'] = $student->student_id;
            $page_data['class_id']   = $class_id;
        } else {
            $page_data['student_id'] = 0;
            $page_data['class_id']   = 0;
        }
        $this->load->view('student/homework', $page_data);
    }
    
    public function homeworkroom($param1 = '', $param2 = '')
    {
        if ($param1 == 'details') {
            $page_data['room_page']     = 'homework_details';
            $page_data['homework_code'] = $param2;
        }
        $this->load->view('student/homework_room', $page_data);
    }
    
    public function reset_password() 
    {
        $this->load->view('student/reset_password');
    }
     
    public function change_password($student_id = '')
    {
        $student_user_id = !empty($student_id) ? $student_id : $this->session->userdata('login_user_id');
        $new_password     = $this->input->post('new', TRUE);
        $confirm_password = $this->input->post('confirm', TRUE);
        
        if (!empty($new_password) && $new_password === $confirm_password) {
            $data_student = array('password' => $confirm_password);
            $data_user    = array('password' => sha1($confirm_password));
            
            $this->db->where('user_id', $student_user_id)->update('student', $data_student);
            $this->db->where('user_id', $student_user_id)->update('tbl_users', $data_user);
            $this->session->set_flashdata('flash_message', 'Password updated successfully');
        } else {
            $this->session->set_flashdata('error_message', 'Password mismatch');
        }
        redirect('student/reset_password', 'refresh');
    }
     
    public function view_hourly_attendance()
    {
        $classes = $this->db->select('class_id, name')->from('class')->get()->result_array();
        $class_hours = $this->db->select('att_class_timing_details_id, start_time, end_time, period_name')->from('tbl_att_class_timing_details')->get()->result_array();
        
        $page_data['classes']      = $classes;
        $page_data['class_timing'] = $class_hours;
        
        $this->load->view('student/view_hourly_attendance', $page_data);
    }
    
    public function view_attendance_list($from_date = '', $to_date = '')
    {
        $page_data['from_date'] = $from_date;
        $page_data['to_date']   = $to_date;
        $branch_id              = $this->session->userdata('branch_id');
        $page_data['class_timing'] = $this->Hourly_attendance_model->get_class_hours($branch_id);
        
        $student = $this->Student_model->get_student_by_user_id($this->session->userdata('login_user_id'));
        $student_id = $student ? $student->student_id : 0;
        
        $this->db->where('student_id', $student_id);
        if (!empty($from_date)) {
            $this->db->where('att_date >=', date('Y-m-d', strtotime($from_date)));
        }
        if (!empty($to_date)) {
            $this->db->where('att_date <=', date('Y-m-d', strtotime($to_date)));
        }

        $query = $this->db->get('view_att_attendance_details_tabular');
        $page_data['students'] = $query->result_array();

        $this->load->view('student/view_hourly_attendance_1', $page_data);
    }
    
    public function get_time_table()
    {
        $branch_id = $this->session->userdata('branch_id');
        
        $class_timing = $this->Hourly_attendance_model->get_class_hours($branch_id);
        $student = $this->Student_model->get_student_by_user_id($this->session->userdata('login_user_id'));
        $student_id = $student ? $student->student_id : 0;
        
        $enroll_query = $this->db->select('section_id')->from('enroll')->where('student_id', $student_id)->get();
        $section_id = ($enroll_query->num_rows() > 0) ? $enroll_query->row()->section_id : 0;
        
        $page_data['section_id']   = $section_id;
        $page_data['class_timing'] = $class_timing;
        
        $time_table = $this->db->where('section_id', $section_id)->get('view_att_time_table_tabular')->result_array();
        $page_data['time_table']   = $time_table;
        
        $this->load->view('student/show_class_time_table', $page_data);
    }

    public function view_message()
    {
        $student = $this->Student_model->get_student_by_user_id($this->session->userdata('login_user_id'));
        $student_id = $student ? $student->student_id : 0;

        $this->db->select('message_id, to_student_id, title, message, date_time, viewed');
        $this->db->from('tbl_teacher_student_message');
        $this->db->where('to_student_id', $student_id);
        $this->db->order_by('date_time', 'DESC');
        $data['message_data'] = $this->db->get()->result_array();
        $this->load->view('student/view_messages', $data);
    }

    public function view_single_message()
    {
        date_default_timezone_set("Asia/Kolkata");
        $message_id = $this->uri->segment(3);
        
        $this->db->where('message_id', $message_id);
        $message = $this->db->get('tbl_teacher_student_message')->result_array();
        $data['message_data'] = $message;

        foreach ($message as $m) {
            if ($m['viewed'] == 'N') {
                $data_view = array(
                    'viewed'           => 'Y',
                    'viewed_date_time' => date('Y/m/d H:i:s')
                );
                $this->db->where('message_id', $message_id);
                $this->db->update('tbl_teacher_student_message', $data_view);
            }
        }
        $this->load->view('student/view_single_messages', $data);
    }
}

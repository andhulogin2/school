<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    public function index() {
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php/admin/index', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php/teacher/teacher_dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php/student/student_dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php/parents/parents_dashboard', 'refresh');

        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'index.php/staff/staff_dashboard', 'refresh');

        $this->load->view('login');
    }

    public function ajax_login() {
        $email = $this->input->post('email', TRUE);
        $password_raw = $this->input->post('password', TRUE);
        $pswd = sha1($password_raw);

        $user = $this->User_model->get_user_by_credentials($email, $pswd);
        $academic_year = $this->User_model->get_running_academic_year();
        $this->session->set_userdata('academic_year', $academic_year);

        if ($user) {
            $role = (int)$user->user_role_id;
            $deleted = $user->is_deleted;
            $is_class_teacher = $user->is_class_teacher;

            $this->session->set_userdata('is_class_teacher', $is_class_teacher);

            if ($role === 1) {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('login_type', 'admin');
                $this->session->set_userdata('account_section_id', '1');
                $this->load->view('admin/admin_dashboard.php');
            } else if ($role === 2 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('account_section_id', '1');
                $this->load->view('admin/admin_dashboard.php');
            } else if ($role === 3 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('account_section_id', '1');
                $this->load->view('admin/admin_dashboard.php');
            } else if ($role === 4 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->session->set_userdata('account_section_id', '4');
                $this->load->view('admin/admin_dashboard.php');
            } else if ($role === 6 && $deleted === 'N' && $is_class_teacher === 'Y') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('class_teacher/class_teacher_dashboard.php');
            } else if ($role === 6 && $deleted === 'N' && $is_class_teacher === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('teacher/teacher_dashboard.php');
            } else if ($role === 10 && $deleted === 'N') {
                $year = function_exists('get_running_year') ? get_running_year() : $academic_year;
                $student_user = $this->User_model->get_student_user_by_credentials($email, $pswd, $year);
                $student_data = $student_user ? $student_user : $user;

                $this->session->set_userdata('login_user_id', $student_data->user_id);
                $this->session->set_userdata('username', $student_data->username);
                $this->session->set_userdata('role', $student_data->user_role_id);
                $this->session->set_userdata('branch_id', $student_data->branch_id);
                $this->session->set_userdata('dept_id', $student_data->dept_id);
                $this->load->view('student/student_dashboard.php');
            } else if ($role === 8 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('library/library_dashboard.php');
            } else if ($role === 7 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('office_staff/office_dashboard.php');
            } else if ($role === 12 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('admin/admin_dashboard.php');
            } else if ($role === 13 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->session->set_userdata('account_section_id', '2');
                $this->load->view('admin/pta_dashboard.php');
            } else if ($role === 14 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->session->set_userdata('account_section_id', '3');
                $this->load->view('admin/manager_dashboard.php');
            } else if ($role === 15 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('admin/clerk_dashboard.php');
            } else if ($role === 16 && $deleted === 'N') {
                $this->session->set_userdata('login_user_id', $user->user_id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->user_role_id);
                $this->session->set_userdata('branch_id', $user->branch_id);
                $this->session->set_userdata('dept_id', $user->dept_id);
                $this->load->view('admin/admin_dashboard.php');
            } else {
                echo '<script>alert("INVALID");</script>';
                $this->load->view('login');
            }
        } else {
            echo '<script>alert("INVALID");</script>';
            $this->load->view('login');
        }
    }

    public function validate_login($email = '', $password = '', $pswd = '') {
        $user = $this->User_model->get_user_by_credentials($email, $pswd);
        if ($user) {
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $user->user_id);
            $this->session->set_userdata('name', $user->username);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }
        return 'invalid';
    }

    public function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }
}
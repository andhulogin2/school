<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Authenticate user credentials against tbl_users
     *
     * @param string $username
     * @param string $password (SHA1 hash)
     * @return object|false
     */
    public function get_user_by_credentials($username, $password) {
        $this->db->select('user_role_id, user_id, username, is_deleted, password, branch_id, dept_id, is_class_teacher');
        $this->db->from('tbl_users');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('is_deleted', 'N');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get student user details with enrollment year
     *
     * @param string $username
     * @param string $password
     * @param string $year
     * @return object|false
     */
    public function get_student_user_by_credentials($username, $password, $year) {
        $this->db->select('u.user_role_id, u.user_id, u.username, u.is_deleted, u.password, u.branch_id, u.dept_id, u.is_class_teacher');
        $this->db->from('tbl_users u');
        $this->db->join('student s', 's.user_id = u.user_id', 'LEFT');
        $this->db->join('enroll e', 'e.student_id = s.student_id AND e.year = ' . $this->db->escape($year), 'INNER');
        $this->db->where('u.username', $username);
        $this->db->where('u.password', $password);
        $this->db->where('u.is_deleted', 'N');
        $this->db->where('u.user_role_id', '10');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get running academic year from settings table
     *
     * @return string
     */
    public function get_running_academic_year() {
        $this->db->select('description');
        $this->db->from('settings');
        $this->db->where('type', 'running_year');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->description;
        }
        return '';
    }

    /**
     * Get user profile by user_id
     *
     * @param int $user_id
     * @return object|false
     */
    public function get_user_by_id($user_id) {
        $this->db->select('user_id, username, user_role_id, branch_id, dept_id, is_class_teacher');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 'N');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }
}

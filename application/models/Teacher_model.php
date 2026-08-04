<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get teacher profile by teacher ID with explicit column selection
     *
     * @param int $teacher_id
     * @return object|false
     */
    public function get_teacher_by_id($teacher_id) {
        $this->db->select('t.teacher_id, t.name, t.username, t.email, t.phone, t.address, t.salary, t.birthday, t.sex, t.user_id, t.branch_id, t.dept_id');
        $this->db->from('teacher t');
        $this->db->where('t.teacher_id', $teacher_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get list of all teachers by optional branch filter
     *
     * @param int $branch_id
     * @return array
     */
    public function get_all_teachers($branch_id = 0) {
        $this->db->select('t.teacher_id, t.name, t.username, t.email, t.phone, t.sex, t.birthday, t.user_id, t.branch_id, t.dept_id');
        $this->db->from('teacher t');
        if ($branch_id > 0) {
            $this->db->where('t.branch_id', $branch_id);
        }
        $this->db->order_by('t.name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate teacher by username, email, or phone before insertion
     *
     * @param string $username
     * @param string $email
     * @param string $phone
     * @return bool
     */
    public function check_duplicate_teacher($username, $email = '', $phone = '') {
        if (!empty($username)) {
            $this->db->where('username', $username);
            if ($this->db->count_all_results('tbl_users') > 0) {
                return TRUE;
            }
        }
        if (!empty($email)) {
            $this->db->where('email', $email);
            if ($this->db->count_all_results('teacher') > 0) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Transactional insertion of Teacher User Account and Teacher Details
     *
     * @param array $data_user
     * @param array $data_teacher
     * @return int|false Teacher ID on success, FALSE on failure
     */
    public function add_teacher_transaction($data_user, $data_teacher) {
        $this->db->trans_start();

        // 1. Insert user into tbl_users
        $this->db->insert('tbl_users', $data_user);
        $user_id = $this->db->insert_id();

        // 2. Insert teacher profile
        $data_teacher['user_id'] = $user_id;
        $this->db->insert('teacher', $data_teacher);
        $teacher_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $teacher_id;
    }

    /**
     * Transactional update of Teacher profile and User credentials
     *
     * @param int $teacher_id
     * @param array $data_teacher
     * @param array $data_user
     * @return bool
     */
    public function update_teacher_transaction($teacher_id, $data_teacher, $data_user = array()) {
        $this->db->trans_start();

        $this->db->where('teacher_id', $teacher_id);
        $this->db->update('teacher', $data_teacher);

        if (!empty($data_user)) {
            $teacher = $this->get_teacher_by_id($teacher_id);
            if ($teacher && $teacher->user_id > 0) {
                $this->db->where('user_id', $teacher->user_id);
                $this->db->update('tbl_users', $data_user);
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Transactional deletion of Teacher
     *
     * @param int $teacher_id
     * @return bool
     */
    public function delete_teacher_transaction($teacher_id) {
        $this->db->trans_start();

        $teacher = $this->get_teacher_by_id($teacher_id);
        if ($teacher) {
            if ($teacher->user_id > 0) {
                $this->db->where('user_id', $teacher->user_id);
                $this->db->update('tbl_users', array('is_deleted' => 'Y'));
            }
            $this->db->where('teacher_id', $teacher_id);
            $this->db->delete('teacher');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

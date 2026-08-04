<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get staff profile by staff ID with explicit column selection
     *
     * @param int $staff_id
     * @return object|false
     */
    public function get_staff_by_id($staff_id) {
        $this->db->select('s.staff_id, s.name, s.username, s.email, s.phone, s.designation, s.salary, s.birthday, s.sex, s.user_id, s.branch_id, s.dept_id');
        $this->db->from('staff s');
        $this->db->where('s.staff_id', $staff_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get list of all staff members with optional branch and department filters
     *
     * @param int $branch_id
     * @param int $dept_id
     * @return array
     */
    public function get_all_staff($branch_id = 0, $dept_id = 0) {
        $this->db->select('s.staff_id, s.name, s.username, s.email, s.phone, s.designation, s.sex, s.birthday, s.user_id, s.branch_id, s.dept_id');
        $this->db->from('staff s');

        if ($branch_id > 0) {
            $this->db->where('s.branch_id', $branch_id);
        }
        if ($dept_id > 0) {
            $this->db->where('s.dept_id', $dept_id);
        }

        $this->db->order_by('s.name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate staff member by username or email before creation
     *
     * @param string $username
     * @param string $email
     * @param string $phone
     * @return bool
     */
    public function check_duplicate_staff($username, $email = '', $phone = '') {
        if (!empty($username)) {
            $this->db->where('username', $username);
            if ($this->db->count_all_results('tbl_users') > 0) {
                return TRUE;
            }
        }
        if (!empty($email)) {
            $this->db->where('email', $email);
            if ($this->db->count_all_results('staff') > 0) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Transactional insertion of Staff User Account and Staff Profile
     *
     * @param array $data_user
     * @param array $data_staff
     * @return int|false Staff ID on success, FALSE on failure
     */
    public function add_staff_transaction($data_user, $data_staff) {
        $this->db->trans_start();

        // 1. Insert user into tbl_users
        $this->db->insert('tbl_users', $data_user);
        $user_id = $this->db->insert_id();

        // 2. Insert staff profile
        $data_staff['user_id'] = $user_id;
        $this->db->insert('staff', $data_staff);
        $staff_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $staff_id;
    }

    /**
     * Transactional update of Staff profile and User credentials
     *
     * @param int $staff_id
     * @param array $data_staff
     * @param array $data_user
     * @return bool
     */
    public function update_staff_transaction($staff_id, $data_staff, $data_user = array()) {
        $this->db->trans_start();

        $this->db->where('staff_id', $staff_id);
        $this->db->update('staff', $data_staff);

        if (!empty($data_user)) {
            $staff = $this->get_staff_by_id($staff_id);
            if ($staff && $staff->user_id > 0) {
                $this->db->where('user_id', $staff->user_id);
                $this->db->update('tbl_users', $data_user);
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Transactional deletion of Staff member
     *
     * @param int $staff_id
     * @return bool
     */
    public function delete_staff_transaction($staff_id) {
        $this->db->trans_start();

        $staff = $this->get_staff_by_id($staff_id);
        if ($staff) {
            if ($staff->user_id > 0) {
                $this->db->where('user_id', $staff->user_id);
                $this->db->update('tbl_users', array('is_deleted' => 'Y'));
            }
            $this->db->where('staff_id', $staff_id);
            $this->db->delete('staff');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

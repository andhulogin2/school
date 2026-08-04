<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get user role by role ID
     *
     * @param int $role_id
     * @return object|false
     */
    public function get_role_by_id($role_id) {
        $this->db->select('role_id, role_name');
        $this->db->from('tbl_user_roles');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get all active roles
     *
     * @return array
     */
    public function get_all_roles() {
        $this->db->select('role_id, role_name');
        $this->db->from('tbl_user_roles');
        $this->db->order_by('role_id', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate role name before insertion
     *
     * @param string $role_name
     * @return bool
     */
    public function check_duplicate_role($role_name) {
        $this->db->where('role_name', $role_name);
        return ($this->db->count_all_results('tbl_user_roles') > 0);
    }
}

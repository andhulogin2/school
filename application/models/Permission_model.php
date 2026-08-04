<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Check if user role has permission for a feature
     *
     * @param int $role_id
     * @param string $feature_key
     * @return bool
     */
    public function check_permission($role_id, $feature_key) {
        if ($role_id == 1) { // Super Admin always has full permission
            return TRUE;
        }
        $this->db->where('role_id', $role_id);
        $this->db->where('feature_key', $feature_key);
        return ($this->db->count_all_results('tbl_role_permissions') > 0);
    }
}

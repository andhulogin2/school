<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get class by ID
     *
     * @param int $class_id
     * @return object|false
     */
    public function get_class_by_id($class_id) {
        $this->db->select('class_id, name, name_numeric, teacher_id, academic_year, dept_id, branch_id');
        $this->db->from('class');
        $this->db->where('class_id', $class_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get all active classes
     *
     * @param string $year
     * @param int $branch_id
     * @return array
     */
    public function get_all_classes($year = '', $branch_id = 0) {
        $this->db->select('class_id, name, name_numeric, teacher_id, academic_year, dept_id, branch_id');
        $this->db->from('class');
        if (!empty($year)) {
            $this->db->where('academic_year', $year);
        }
        if ($branch_id > 0) {
            $this->db->where('branch_id', $branch_id);
        }
        $this->db->order_by('name_numeric', 'ASC');
        return $this->db->get()->result_array();
    }
}

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get subject by ID
     *
     * @param int $subject_id
     * @return object|false
     */
    public function get_subject_by_id($subject_id) {
        $this->db->select('subject_id, name, class_id, year, teacher_id');
        $this->db->from('subject');
        $this->db->where('subject_id', $subject_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get subjects by class ID and year
     *
     * @param int $class_id
     * @param string $year
     * @return array
     */
    public function get_subjects_by_class($class_id, $year = '') {
        $this->db->select('subject_id, name, class_id, year, teacher_id');
        $this->db->from('subject');
        $this->db->where('class_id', $class_id);
        if (!empty($year)) {
            $this->db->where('year', $year);
        }
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate subject name within the same class
     *
     * @param string $name
     * @param int $class_id
     * @param string $year
     * @return bool
     */
    public function check_duplicate_subject($name, $class_id, $year = '') {
        $this->db->where('name', $name);
        $this->db->where('class_id', $class_id);
        if (!empty($year)) {
            $this->db->where('year', $year);
        }
        return ($this->db->count_all_results('subject') > 0);
    }
}

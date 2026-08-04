<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Section_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get section by ID
     *
     * @param int $section_id
     * @return object|false
     */
    public function get_section_by_id($section_id) {
        $this->db->select('section_id, name, class_id, teacher_id');
        $this->db->from('section');
        $this->db->where('section_id', $section_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get sections for a class
     *
     * @param int $class_id
     * @return array
     */
    public function get_sections_by_class($class_id) {
        $this->db->select('section_id, name, class_id, teacher_id');
        $this->db->from('section');
        $this->db->where('class_id', $class_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }
}

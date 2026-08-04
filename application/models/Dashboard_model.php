<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get dashboard count statistics
     *
     * @param string $year
     * @return array
     */
    public function get_dashboard_counts($year = '') {
        $data = array();

        // 1. Total active students
        if (!empty($year)) {
            $this->db->where('year', $year);
            $data['total_students'] = $this->db->count_all_results('enroll');
        } else {
            $data['total_students'] = $this->db->count_all('student');
        }

        // 2. Total active teachers
        $data['total_teachers'] = $this->db->count_all('teacher');

        // 3. Total staff members
        $data['total_staff'] = $this->db->count_all('staff');

        // 4. Total active classes
        $data['total_classes'] = $this->db->count_all('class');

        return $data;
    }
}

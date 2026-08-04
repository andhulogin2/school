<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marks_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get student marks for a class, section, exam, and subject
     *
     * @param int $class_id
     * @param int $section_id
     * @param int $exam_id
     * @param int $subject_id
     * @param string $year
     * @return array
     */
    public function get_marks($class_id, $section_id, $exam_id, $subject_id, $year) {
        $this->db->select('m.mark_id, m.student_id, m.class_id, m.section_id, m.exam_id, m.subject_id, m.mark_obtained, m.mark_total, m.grade, m.position, m.comment, s.name as student_name, e.roll');
        $this->db->from('mark m');
        $this->db->join('student s', 's.student_id = m.student_id', 'INNER');
        $this->db->join('enroll e', 'e.student_id = m.student_id AND e.year = ' . $this->db->escape($year), 'LEFT');
        $this->db->where('m.class_id', $class_id);
        $this->db->where('m.section_id', $section_id);
        $this->db->where('m.exam_id', $exam_id);
        $this->db->where('m.subject_id', $subject_id);
        $this->db->where('m.year', $year);
        $this->db->order_by('e.roll', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate mark entry for a student, exam, and subject
     *
     * @param int $student_id
     * @param int $exam_id
     * @param int $subject_id
     * @param string $year
     * @return bool
     */
    public function check_duplicate_mark($student_id, $exam_id, $subject_id, $year) {
        $this->db->where('student_id', $student_id);
        $this->db->where('exam_id', $exam_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->where('year', $year);
        return ($this->db->count_all_results('mark') > 0);
    }

    /**
     * Save student mark entry inside a transaction
     *
     * @param array $data_mark
     * @return bool
     */
    public function save_mark_transaction($data_mark) {
        $this->db->trans_start();

        if ($this->check_duplicate_mark($data_mark['student_id'], $data_mark['exam_id'], $data_mark['subject_id'], $data_mark['year'])) {
            $this->db->where('student_id', $data_mark['student_id']);
            $this->db->where('exam_id', $data_mark['exam_id']);
            $this->db->where('subject_id', $data_mark['subject_id']);
            $this->db->where('year', $data_mark['year']);
            $this->db->update('mark', $data_mark);
        } else {
            $this->db->insert('mark', $data_mark);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Update bulk marks for students in an exam inside a transaction
     *
     * @param array $marks_data Array of mark updates
     * @return bool
     */
    public function update_bulk_marks_transaction($marks_data) {
        $this->db->trans_start();

        foreach ($marks_data as $mark_id => $update_fields) {
            $this->db->where('mark_id', $mark_id);
            $this->db->update('mark', $update_fields);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Calculate grade and position from score and total
     *
     * @param float $obtained
     * @param float $total
     * @return array ['grade' => string, 'position' => string]
     */
    public function calculate_grade($obtained, $total) {
        $grade = '';
        $position = '';

        if ($total > 0) {
            $percentage = ($obtained / $total) * 100;
            $this->db->select('grade, position, minimum_range, maximum_range');
            $this->db->from('grade');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    if ($percentage >= $row['minimum_range'] && $percentage <= $row['maximum_range']) {
                        $grade    = $row['grade'];
                        $position = $row['position'];
                        break;
                    }
                }
            }
        }

        return array('grade' => $grade, 'position' => $position);
    }
}

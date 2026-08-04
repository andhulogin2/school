<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get student by student ID with required columns
     *
     * @param int $student_id
     * @return object|false
     */
    public function get_student_by_id($student_id) {
        $this->db->select('s.student_id, s.name, s.admission_number, s.birthday, s.sex, s.address, s.phone1, s.phone2, s.phone3, s.email, s.aadhaar_number, s.parent, s.mother_name, s.parent_id, s.whatsapp_number, s.school, s.user_id, s.branch_id, s.dept_id');
        $this->db->from('student s');
        $this->db->where('s.student_id', $student_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get student by user ID
     *
     * @param int $user_id
     * @return object|false
     */
    public function get_student_by_user_id($user_id) {
        $this->db->select('student_id, name, admission_number, birthday, sex, address, phone1, email, parent, user_id, branch_id, dept_id');
        $this->db->from('student');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get enrolled student list for class and section in specific academic year (eliminates duplicates)
     *
     * @param int $class_id
     * @param int $section_id
     * @param string $year
     * @return array
     */
    public function get_students_by_class_and_section($class_id, $section_id = '', $year = '') {
        $this->db->select('s.student_id, s.name, s.admission_number, s.phone1, s.email, s.sex, s.user_id, e.enroll_id, e.roll, e.class_id, e.section_id, e.year');
        $this->db->from('student s');
        $this->db->join('enroll e', 'e.student_id = s.student_id', 'INNER');
        $this->db->where('e.class_id', $class_id);

        if (!empty($section_id)) {
            $this->db->where('e.section_id', $section_id);
        }
        if (!empty($year)) {
            $this->db->where('e.year', $year);
        }

        $this->db->group_by('s.student_id');
        $this->db->order_by('e.roll', 'ASC');
        $this->db->order_by('s.name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Check if admission number or user phone exists to prevent duplicate creation
     *
     * @param string $admission_number
     * @param string $phone
     * @return bool
     */
    public function check_duplicate_student($admission_number, $phone = '') {
        if (!empty($admission_number)) {
            $this->db->where('admission_number', $admission_number);
            if ($this->db->count_all_results('student') > 0) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Atomic transaction to add student user, profile, and enrollment record
     *
     * @param array $data_user
     * @param array $data_student
     * @param array $data_enroll
     * @param int $enquiry_id
     * @return int|false Student ID on success, FALSE on failure
     */
    public function add_student_transaction($data_user, $data_student, $data_enroll, $enquiry_id = 0) {
        $this->db->trans_start();

        // 1. Insert into tbl_users
        $this->db->insert('tbl_users', $data_user);
        $user_id = $this->db->insert_id();

        // 2. Insert into student table
        $data_student['user_id'] = $user_id;
        $this->db->insert('student', $data_student);
        $student_id = $this->db->insert_id();

        // 3. Insert into enroll table if not already enrolled for this year
        if ($student_id > 0) {
            $data_enroll['student_id'] = $student_id;
            
            // Verify no duplicate enrollment for same student and year
            $this->db->where('student_id', $student_id);
            $this->db->where('year', $data_enroll['year']);
            if ($this->db->count_all_results('enroll') == 0) {
                $this->db->insert('enroll', $data_enroll);
            }
        }

        // 4. Update enquiry master if applicable
        if ($enquiry_id > 0) {
            $this->db->where('enquiry_id', $enquiry_id);
            $this->db->update('tbl_enquiry_master', array('is_admitted' => 'Y'));
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $student_id;
    }

    /**
     * Update student details
     *
     * @param int $student_id
     * @param array $data_student
     * @param array $data_user
     * @return bool
     */
    public function update_student_transaction($student_id, $data_student, $data_user = array()) {
        $this->db->trans_start();

        $this->db->where('student_id', $student_id);
        $this->db->update('student', $data_student);

        if (!empty($data_user)) {
            $student = $this->get_student_by_id($student_id);
            if ($student && $student->user_id > 0) {
                $this->db->where('user_id', $student->user_id);
                $this->db->update('tbl_users', $data_user);
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Delete student safely
     *
     * @param int $student_id
     * @return bool
     */
    public function delete_student_transaction($student_id) {
        $this->db->trans_start();

        $student = $this->get_student_by_id($student_id);
        if ($student) {
            if ($student->user_id > 0) {
                $this->db->where('user_id', $student->user_id);
                $this->db->update('tbl_users', array('is_deleted' => 'Y'));
            }
            $this->db->where('student_id', $student_id);
            $this->db->delete('enroll');

            $this->db->where('student_id', $student_id);
            $this->db->delete('student');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

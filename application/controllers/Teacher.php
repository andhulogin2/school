<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('Teacher_model');
        $this->load->model('Student_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function teacher_dashboard()
    {
        $this->load->view('teacher/teacher_dashboard.php');
    }
    
    public function subject($param1 = '', $param2 = '', $param3 = '')
    {
        $page_data['class_id'] = $param1;
        $page_data['subjects'] = $this->db->select('subject_id, name, class_id, year')->from('subject')->where('class_id', $param1)->get()->result_array();
        $this->load->view('teacher/subjects', $page_data);
    }
    
    public function upload_marks()
    {
        $this->load->view('teacher/upload_marks.php');
    }
    
    public function upload_marks_subject()
    {
        $this->load->view('teacher/upload_marks_subject.php');
    }

    public function student_portal($student_id)
    {
        $yr = get_running_year();
        $student = $this->Student_model->get_student_by_id($student_id);

        if ($student) {
            $enroll_query = $this->db->select('class_id')->from('enroll')->where(array('student_id' => $student_id, 'year' => $yr))->get();
            $class_id = ($enroll_query->num_rows() > 0) ? $enroll_query->row()->class_id : 0;
            
            $page_data['student_portal_model'] = $this->crud_model->student_portal_data($student_id);
            $monthly_attendance = $this->crud_model->get_attendance_monthly($student_id);

            $page_data['student_id']          = $student_id;
            $page_data['class_id']           = $class_id;
            $page_data['monthly_attendance'] = $monthly_attendance;
        } else {
            $page_data['student_id']          = 0;
            $page_data['class_id']           = 0;
            $page_data['monthly_attendance'] = array();
        }

        $this->load->view('teacher/student_portal1.php', $page_data);
    }

    public function marks_selector()
    {
        $data['class_id']   = $this->input->post('class_id', TRUE);
        $data['section_id'] = $this->input->post('section_id', TRUE);
        $data['exam_id']    = $this->input->post('exam_id', TRUE);
        $data['subject_id'] = $this->input->post('subject_id', TRUE);
        $data['comment']    = $this->input->post('remarks', TRUE);
        $data['year']       = get_running_year();

        $query = $this->db->select('mark_id')->from('mark')->where(array(
            'class_id'   => $data['class_id'],
            'section_id' => $data['section_id'],
            'exam_id'    => $data['exam_id'],
            'subject_id' => $data['subject_id'],
            'year'       => $data['year']
        ))->get();

        $query1 = $this->db->select('enroll_id')->from('enroll')->where(array(
            'class_id'   => $data['class_id'],
            'section_id' => $data['section_id'],
            'year'       => $data['year']
        ))->get();

        if ($query->num_rows() < $query1->num_rows()) {
            $students = $this->Student_model->get_students_by_class_and_section($data['class_id'], $data['section_id'], $data['year']);
            foreach ($students as $row) {
                $data['student_id'] = $row['student_id'];
                $dat = $this->db->select('mark_id')->from('mark')->where(array(
                    'class_id'   => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'exam_id'    => $data['exam_id'],
                    'subject_id' => $data['subject_id'],
                    'year'       => $data['year'],
                    'student_id' => $data['student_id']
                ))->get();

                if ($dat->num_rows() < 1) {
                    $this->db->insert('mark', $data);
                }
            }
        }
        redirect(base_url() . 'index.php/teacher/marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'], 'refresh');
    }

    public function marks_selector_subject()
    {
        $data['class_id']   = $this->input->post('class_id', TRUE);
        $data['section_id'] = $this->input->post('section_id', TRUE);
        $data['exam_id']    = $this->input->post('exam_id', TRUE);
        $data['subject_id'] = $this->input->post('subject_id', TRUE);
        $data['comment']    = $this->input->post('remarks', TRUE);
        $data['year']       = get_running_year();

        $students = $this->Student_model->get_students_by_class_and_section($data['class_id'], $data['section_id'], $data['year']);
        foreach ($students as $row) {
            $data['student_id'] = $row['student_id'];
            $dat = $this->db->select('mark_id')->from('mark')->where(array(
                'class_id'   => $data['class_id'],
                'section_id' => $data['section_id'],
                'exam_id'    => $data['exam_id'],
                'subject_id' => $data['subject_id'],
                'year'       => $data['year'],
                'student_id' => $data['student_id']
            ))->get();

            if ($dat->num_rows() < 1) {
                $this->db->insert('mark', $data);
            }
        }
        redirect(base_url() . 'index.php/teacher/marks_upload_subject/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'], 'refresh');
    }

    public function marks_get_subject($class_id = '', $teacher_id = '')
    {
        $page_data['class_id']   = $class_id;
        $page_data['teacher_id'] = $teacher_id;
        $this->load->view('teacher/marks_get_subject', $page_data);
    }

    public function marks_get_subject_myclass($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('teacher/marks_get_subject_myclass', $page_data);
    }

    public function marks_upload($class_id = '', $section_id = '', $exam_id = '', $subject_id = '', $remarks = '')
    {
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        $page_data['section_id'] = $section_id;
        $page_data['remarks']    = $remarks;
        $this->load->view('teacher/marks_upload', $page_data);
    }

    public function marks_upload_subject($class_id = '', $section_id = '', $exam_id = '', $subject_id = '', $remarks = '')
    {
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        $page_data['section_id'] = $section_id;
        $page_data['remarks']    = $remarks;
        $this->load->view('teacher/marks_upload_subject', $page_data);
    }

    public function marks_update($class_id = '', $section_id = '', $exam_id = '', $subject_id = '')
    {
        $running_year = get_running_year();
        $marks_of_students = $this->db->select('mark_id, mark_obtained, mark_total, grade, position')->from('mark')->where(array(
            'exam_id'    => $exam_id, 
            'class_id'   => $class_id,
            'section_id' => $section_id, 
            'year'       => $running_year,
            'subject_id' => $subject_id
        ))->get()->result_array();

        foreach ($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_' . $row['mark_id'], TRUE);
            $mark_total     = $this->input->post('mark_total_' . $row['mark_id'], TRUE);
            $grade1         = $this->input->post('grade_value_' . $row['mark_id'], TRUE);
            $comnt          = $this->input->post('comment', TRUE);
            $position1      = $this->input->post('position_value_' . $row['mark_id'], TRUE);

            if ($grade1 == "" && $position1 == "" && $mark_total > 0) {
                $average = (($obtained_marks / $mark_total) * 100);
                $p = $this->db->select('minimum_range, maximum_range, grade, position')->from('grade')->get()->result_array();
                foreach ($p as $res) {
                    if ($average >= $res['minimum_range'] && $average <= $res['maximum_range']) {
                        $grade    = $res['grade'];
                        $position = $res['position'];
                    }
                }
            } else {
                $grade    = $grade1;
                $position = $position1;
            }

            $update_data = array(
                'mark_obtained' => $obtained_marks,
                'mark_total'    => $mark_total,
                'grade'         => $grade,
                'position'      => $position
            );
            if (!empty($comnt)) {
                $update_data['comment'] = $comnt;
            }

            $this->db->where('mark_id', $row['mark_id'])->update('mark', $update_data);
        }
        redirect(base_url() . 'index.php/teacher/marks_upload/' . $class_id . '/' . $section_id . '/' . $exam_id . '/' . $subject_id, 'refresh');
    }
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('get_student_name'))
{
	function get_student_name($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$student_name='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		
		
		$student_name	=	$row->name;
			
		return $student_name;
	}
}

if ( ! function_exists('get_school'))
{
	function get_school()
	{
		$CI	=& get_instance();
		$CI->load->database();
		$school_name='';
		$query			=	$CI->db->get_where("settings", array('type'=> 'system_name'));
		$row			=	$query->row();	
		$school_name	=	$row->description;
			
		return $school_name;
	}
}
if ( ! function_exists('get_school_address'))
{
	function get_school_address()
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$school_address='';
		$query			=	$CI->db->get_where("settings", array('type'=> 'address'));
		$row			=	$query->row();	
		$school_address	=	$row->description;
			
		return $school_address;
	}
}
if ( ! function_exists('get_school_phone'))
{
	function get_school_phone()
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$school_phone='';
		$query			=	$CI->db->get_where("settings", array('type'=> 'phone'));
		$row			=	$query->row();	
		$school_phone	=	$row->description;
			
		return $school_phone;
	}
}
if ( ! function_exists('get_school_mail'))
{
	function get_school_mail()
	{
		$CI	=& get_instance();
		$CI->load->database();

		$school_mail='';
		$query			=	$CI->db->get_where("settings", array('type'=> 'system_email'));
		$row			=	$query->row();	
		$school_mail	=	$row->description;
			
		return $school_mail;
	}
}
if ( ! function_exists('get_running_year'))
{
	function get_running_year()
	{ 
		$CI	=& get_instance();
		$CI->load->database();
		$CI->load->library('session');
		//$session = $CI->session->userdata('academic_year');
		
		if(isset($CI->session->userdata['academic_year']))
		{
			$year		=	$CI->session->userdata['academic_year'];
		}
		else
		{
			$year		=	'';
			$query		=	$CI->db->get_where("settings", array('type'=> 'running_year'));
			$row		=	$query->row();	
			$year		=	$row->description;
		}	
		return $year;
	}
}
if ( ! function_exists('get_class_name'))
{
	function get_class_name($class_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$class_name='';
		$query			=	$CI->db->get_where("class", array('class_id'=> $class_id));
		$row			=	$query->row();	
		if(isset($row))
		{
			$class_name		=	$row->name;
		}
		else
		{
			$class_name		=	'';
		}
			
		return $class_name;
	}
}
if ( ! function_exists('get_admission_number'))
{
	function get_admission_number($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$query			=	$CI->db->get_where("student", array('student_id'=> $student_id));
		$row			=	$query->row();	
		if(isset($row))
		{
			$admission_number	=	$row->admission_number;
		}
		else
		{
			$admission_number	=	'';
		}
			
		return $admission_number;
	}
}
if ( ! function_exists('get_rank'))
{
	function get_rank($exam_id='',$student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$class_name='';
		$query			=	$CI->db->get_where("ranks", array('exam_id'=> $exam_id,'student_id'=>$student_id));
		//$row			=	$query->row();	
		if($query->num_rows() > 0)
		
		{
	
		$class_name		=	$query->row()->rank;
		}//echo $student_id;die();
		else
		$class_name ='NA';	
		return $class_name;
	}
}

if ( ! function_exists('get_section_name'))
{
	function get_section_name($section_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$section_name='';
		$query			=	$CI->db->get_where("section", array('section_id'=> $section_id));
		$row			=	$query->row();	
		if(isset($row))
		{
			$section_name	=	$row->name;	
		}
		else
		{
			$section_name	=	'';
		}
		
			
		return $section_name;
	}
}

if ( ! function_exists('get_student_address'))
{
	function get_student_address($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$address='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$address		=	$row->address;
			
		return $address;
	}
}


if ( ! function_exists('get_student_email'))
{
	function get_student_email($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$email='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$email			=	$row->email;
			
		return $email;
	}
}

if ( ! function_exists('get_student_phone1'))
{
	function get_student_phone1($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$phone='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$phone			=	$row->phone1;
			
		return $phone;
	}
}
if ( ! function_exists('get_student_phone'))
{
	function get_student_phone($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$phone='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$phone			=	$row->phone1;
			
		return $phone;
	}
}
if ( ! function_exists('get_student_phone2'))
{
	function get_student_phone2($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$phone='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$phone			=	$row->phone2;
			
		return $phone;
	}
}

if ( ! function_exists('get_student_sex'))
{
	function get_student_sex($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$sex='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$sex			=	$row->sex;
			
		return $sex;
	}
}

if ( ! function_exists('get_student_class_name'))
{
	function get_student_class_name($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$class_id='';
		$year			=	get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $student_id,'year' => $year));
		$row			=	$query->row();	
		if(isset($row))
		{
			$class_id	=	$row->class_id;
		}
		else
		{
			$class_id	=	'';
		}
			
		return get_class_name($class_id);
	}
}


if ( ! function_exists('get_student_class_id'))
{
	function get_student_class_id($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$class_id='';
		$year           =   get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $student_id,'year' => $year));
		$row			=	$query->row();	
		$class_id		=	$row->class_id;
			
		return $class_id;
	}
}


if ( ! function_exists('get_student_section_name'))
{
	function get_student_section_name($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$section_id	='';
		$year           =   get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $student_id,'year' => $year));
		$row			=	$query->row();	
		if(isset($row))
		{
			$section_id	=	$row->section_id;
		}
		else
		{
			$section_id	=	'';
		}
		
			
		return get_section_name($section_id);
	}
}

if ( ! function_exists('get_student_section_id'))
{
	function get_student_section_id($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$section_id='';
		$year           =   get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $student_id,'year' => $year));
		$row			=	$query->row();	
		$section_id		=	$row->section_id;
			
		return $section_id;
	}
}





if ( ! function_exists('get_student_roll'))
{
	function get_student_roll($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$year           =   get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $admission_number,'year'=>$year));
		$row			=	$query->row();	
		$year			=	$row->roll;
			
		return $year;
	}
}
if ( ! function_exists('get_student_academic_year'))
{
	function get_student_academic_year($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$year			=	get_running_year();
		$query			=	$CI->db->get_where("enroll", array('student_id'=> $admission_number,'year'=>$year));
		$row			=	$query->row();	
		$year			=	$row->year;
			
		return $year;
	}
}
if ( ! function_exists('get_student_birthday'))
{
	function get_student_birthday($admission_number='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$year='';
		$query			=	$CI->db->get_where("student", array('student_id'=> $admission_number));
		$row			=	$query->row();	
		$year			=	$row->birthday;
			
		return $year;
	}
}


if ( ! function_exists('get_exam_name'))
{
	function get_exam_name($exam_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

		$year='';
		$query			=	$CI->db->get_where("exam", array('exam_id'=> $exam_id));
		$row			=	$query->row();	
		$year			=	$row->name;
			
		return $year;
	}
}



if ( ! function_exists('convert_number_to_words'))
{
function convert_number_to_words($number='') {

   // $hyphen      = '-';
	$hyphen      = ' ';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
}






// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */
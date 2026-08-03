<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php/admin/index', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php/teacher/teacher_dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php/student/student_dashboard', 'refresh');
        
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php/parents/parents_dashboard', 'refresh');
			
	    if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'index.php/staff/staff_dashboard', 'refresh');

        $this->load->view('login');
    }

    function ajax_login1() {
        $response = array();
        $email = $_POST["email"];
        // $password = sha1($_POST["password"]);
		//echo $email;
		//die();
		$pswd =$_POST["password"];
        $response['submitted_data'] = $_POST;
        $login_status = $this->validate_login($email, $password,$pswd);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
		// redirect(base_url() . 'index.php/admin/index', 'refresh');
		if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php/admin/index', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php/teacher/teacher_dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php/student/student_dashboard', 'refresh');
        
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php/parents/parents_dashboard', 'refresh');
			
	    if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'index.php/staff/staff_dashboard', 'refresh');
            
        }
		else
		?>
        <script> alert("INVALID");</script>
		<?php $this->load->view('login');
		
       // echo json_encode($response);
    }
	
	
	
	function ajax_login() 
	{
		$response = array();
		$email = $_POST['email'];
		$pswd =sha1($_POST["password"]);
		
		$this->db->select('user_role_id,user_id,username,is_deleted,password,branch_id,dept_id,is_class_teacher');
		$this->db->from('tbl_users');
		$this->db->where('username',$email);
		$this->db->where('password',$pswd);
                $this->db->where('is_deleted','N');
		$query=$this->db->get();
		
		
		$this->db->select('description');
		$this->db->from('settings');
		$this->db->where('type','running_year');
		$result=$this->db->get();
		$academic_year=$result->row()->description;
		$this->session->set_userdata('academic_year',$academic_year);
		
		 
		if($query->num_rows()>0)
		{
			$role=$query->row()->user_role_id;
			$deleted=$query->row()->is_deleted;
			$is_class_teacher=$query->row()->is_class_teacher;
			
			$this->session->set_userdata('is_class_teacher', $is_class_teacher);

            //$this->session->set_userdata('academic_year', '2017-2018');
			
			if (1 == $role) 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('login_type', 'admin');
				$this->session->set_userdata('account_section_id', '1');
				$this->load->view('admin/admin_dashboard.php');
			}
			
			else if (2 == $role && $deleted=='N') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('account_section_id', '1');
				$this->load->view('admin/admin_dashboard.php');
			}
			else if (3 == $role && $deleted=='N') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('account_section_id', '1');
				$this->load->view('admin/admin_dashboard.php');
			}
			else if (4 == $role && $deleted=='N') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->session->set_userdata('account_section_id', '4');
				$this->load->view('admin/admin_dashboard.php');
			}
			else if (6 == $role && $deleted=='N' && $is_class_teacher=='Y') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('class_teacher/class_teacher_dashboard.php');
			}
			else if (6 == $role && $deleted=='N' && $is_class_teacher=='N') 
			{
			
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				
				$this->load->view('teacher/teacher_dashboard.php');
			}
			
			else if (10 == $role && $deleted=='N') 
			{
			
                $year   =   get_running_year();    
        		$this->db->select('u.user_role_id,u.user_id,u.username,u.is_deleted,u.password,u.branch_id,u.dept_id,u.is_class_teacher');
        		$this->db->from('tbl_users u');
        		$this->db->where('u.username',$email);
        		$this->db->where('u.password',$pswd);
                $this->db->where('u.is_deleted','N');
                $this->db->where('u.user_role_id', '10');
                $this->db->join('student s', 's.user_id=u.user_id', 'LEFT');
                $this->db->join('enroll e', 'e.student_id=s.student_id and e.year='.$year);
        		$query1=$this->db->get();
			
				$this->session->set_userdata('login_user_id', $query1->row()->user_id);
				$this->session->set_userdata('username', $query1->row()->username);
				$this->session->set_userdata('role', $query1->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query1->row()->branch_id);
				$this->session->set_userdata('dept_id', $query1->row()->dept_id);
				
				$this->load->view('student/student_dashboard.php');
			}
			else if (8 == $role && $deleted=='N') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('library/library_dashboard.php');
			}
			else if (7 == $role && $deleted=='N') 
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('office_staff/office_dashboard.php');
			}
					else if (12 == $role && $deleted=='N') 
			{
			    
			  
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('admin/admin_dashboard.php');
			}
					else if (13 == $role && $deleted=='N') //user_role PTA
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->session->set_userdata('account_section_id', '2');
				$this->load->view('admin/pta_dashboard.php');
			}
					else if (14 == $role && $deleted=='N') //user role management
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->session->set_userdata('account_section_id', '3');
				$this->load->view('admin/manager_dashboard.php');
			}
					else if (15 == $role && $deleted=='N') //user role management
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('admin/clerk_dashboard.php');
			}
					else if (16 == $role && $deleted=='N') //user role management
			{
				$this->session->set_userdata('login_user_id', $query->row()->user_id);
				$this->session->set_userdata('username', $query->row()->username);
				$this->session->set_userdata('role', $query->row()->user_role_id);
				$this->session->set_userdata('branch_id', $query->row()->branch_id);
				$this->session->set_userdata('dept_id', $query->row()->dept_id);
				$this->load->view('admin/admin_dashboard.php');
			}
			else
			{
				?>
				<script> alert("INVALID");</script>
                <?php  $this->load->view('login');
			}
		}
		else
		{
			?>
			<script> alert("INVALID");</script>
			<?php $this->load->view('login');
		}
	}

    function validate_login($email = '', $password = '',$pswd='') {
        $credential = array('username' => $email, 'password' => $password);
        $query = $this->db->get_where('admin', $credential);
	
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', $row->status);
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
           return 'success';
        }
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('teacher_login', '1');
            $this->session->set_userdata('teacher_id', $row->teacher_id);
            $this->session->set_userdata('login_user_id', $row->teacher_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'teacher');
            return 'success';
        }
		$sd=array('username' => $email, 'password' => $pswd);
        $query = $this->db->get_where('student', $sd);
		
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', $row->student_session);
            $this->session->set_userdata('student_id', $row->student_id);
            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
           return 'success';
        }
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('parent_login', '1');
            $this->session->set_userdata('parent_id', $row->parent_id);
            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'parent');
            return 'success';
        }
		 $query = $this->db->get_where('staff', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('staff_login', '1');
            $this->session->set_userdata('staff_id', $row->staff_id);
            $this->session->set_userdata('login_user_id', $row->staff_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'staff');
            return 'success';
        }

        return 'invalid';
    }

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }
	
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }
}
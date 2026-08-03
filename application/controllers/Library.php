<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {


 		/* Books: Category */

public function dashboard()
	{
		$this->load->view('library/library_dashboard.php');
	}
	
public function fine_setting($action='')
	{
		$data['action']=$action;
		$data['fine'] = $this->Library_Model->view_fine();
		$this->load->view('library/fine_setting.php',$data);
	}
//public function get_fine_ajax()
//{
//		$member_type = (filter_input(INPUT_POST, 'member_type'));
//		$data['fine'] = $this->Library_Model->view_fine($member_type);
//		$this->load->view('library/fine_setting.php',$data);
//}
public function insert_fine()
	{
		$this->db->trans_start();
		$data=array(
		'branch_id'					  =>'0',
		'department_id'				  =>'0',
		'fine_amount_per_day'		  =>$this->input->post('fine'),
		'number_of_days_without_fine' =>$this->input->post('days_without_fine'),
		'maximum_books_can_take'	  =>$this->input->post('max_books'),
		'member_type_id'	  		  =>$this->input->post('member_type')
		);
	$category = $this->Library_Model->insert_fine($data);
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
	}
	else
	{
		$action="success";
	}
	$this->fine_setting($action);
	}
	
public function view_book_category($action='')
{
	$data['action']		 = $this->session->flashdata('action');
	$data['categorydata']= $this->Library_Model->view_book_category($data);
	$this->load->view('library/view_category.php',$data);
}
public function add_new_book_category()
{
	$this->load->view('library/add_book_category.php');
}
public function add_book_category()
{
//transaction starts 
	$this->db->trans_start();
	$role=$this->session->userdata('role');
	
	$data['book_category_name'] = strtoupper($this->input->post('category_name'));
	$data['dept_id']            = $this->input->post('dept_id');  
	$data['branch_id']          = $this->input->post('branch_id');  
	$category 					= $this->Library_Model->book_category_insert($data);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_book_category($action);
	redirect('Library/view_book_category');
}
public function edit_category_il()
{
	$book_category_id   = $this->input->post('id');
	$book_category_name = strtoupper($this->input->post('cname'));
	$res                = $this->Library_Model->updates_category($book_category_id,$book_category_name);
} 
public function delete_book_category()
{
	$book_category_id   = $this->input->post('id');
	$this->Library_Model->delete_category($book_category_id); 
}

function get_data($category='')
{
	$page_data['book_category_id']=$category;
	$this->load->view('library/category_find.php', $page_data);
}
	
		
	/* Books: Language */

public function view_book_language($action='')
{
	$data['action']		  = $this->session->flashdata('action');	
	$data['languagedata'] = $this->Library_Model->view_book_language();
	$this->load->view('library/view_language.php',$data);
}
public function add_new_book_language()
{
	$this->load->view('library/add_book_language');
}
public function add_book_language()
{
//transaction starts 
	$this->db->trans_start();
	$data['book_language_name'] = strtoupper($this->input->post('language_name'));
	$this->Library_Model->book_language_insert($data); 
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_book_language($action);
	redirect('Library/view_book_language');
	
}
public function edit_language_il()
{
	$book_language_id   = $this->input->post('id');
	$book_language_name = strtoupper($this->input->post('cname'));
	$res 				= $this->Library_Model->updates_language($book_language_id,$book_language_name);
}
public function delete_book_language()
{
	$book_language_id   = $this->input->post('id');
	$this->Library_Model->delete_language($book_language_id); 
	redirect(base_url() . 'index.php/library/view_book_language', 'refresh'); 
}
function get_data1($language='')
{
	$page_data['book_language_id']=$language;
	$this->load->view('library/language_find.php', $page_data);
}

		/* Books: Stream */

public function view_stream($action='')
{
	$data['action']		= $this->session->flashdata('action');
	$data['streamdata'] = $this->Library_Model->view_stream();
	$this->load->view('library/view_streams.php',$data);					
}
public function add_bookstream()
{
	$this->load->view('library/add_bookstream.php');
}
public function add_book_streams()
{ 
//transaction starts 
	$this->db->trans_start();
	$data['book_stream_name'] = strtoupper($this->input->post('stream_name'));
	$this->Library_Model->book_stream_insert($data);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_stream($action);
	redirect('Library/view_stream');
}
public function edit_stream_il()
{
	$book_stream_id   = $this->input->post('id');
	$book_stream_name = strtoupper($this->input->post('cname'));
	$res              = $this->Library_Model->updates_stream($book_stream_id,$book_stream_name);
}
public function delete_book_stream()
{
	$book_stream_id  = $this->input->post('id');
	$this->Library_Model->delete_book_stream($book_stream_id); 
	redirect(base_url() . 'index.php/library/view_stream', 'refresh'); 
}
function get_data2($stream='')
{
	$page_data['book_stream_id']=$stream;
	$this->load->view('library/stream_find.php', $page_data);
}

/* Books: Author */

public function view_authors($action='')
{
	$data['action']    = $this->session->flashdata('action');
//	$authordata	       = $this->db->query("select * from tbl_lib_authors order by author_name");	
	$data['authordata']= $this->Library_Model->view_authors();	
	$this->load->view('library/view_author.php',$data);
}
public function add_author()
{
	$this->load->view('library/add_book_author.php');
}
public function add_new_author()
{  
//transaction starts 
	$this->db->trans_start();
	$data['author_name']        = strtoupper($this->input->post('author_name'));
	$data['author_address']     = strtoupper($this->input->post('author_address'));
	$data['author_phone1']      = strtoupper($this->input->post('author_phone1'));
	$data['author_phone2']      = strtoupper($this->input->post('author_phone2'));
	$data['author_email']       = $this->input->post('author_email');
	$this->Library_Model->book_author_insert($data);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_authors($action);
	redirect('Library/view_authors');
}
public function edit_author()
{
	$data['author_id']          = $this->input->post('author_id');
	$data['author_name']        = strtoupper($this->input->post('author_name'));
	$data['author_address']		= strtoupper($this->input->post('author_address'));
	$data['author_phone1']		= strtoupper($this->input->post('author_phone1'));
	$data['author_phone2']		= strtoupper($this->input->post('author_phone2'));
	$data['author_email']		= $this->input->post('author_email');
	$this->Library_Model->updates_author($data);
	redirect(base_url() . 'index.php/library/view_authors/', 'refresh'); 
}
public function delete_author()
{
	$author_id=$this->input->post('id');
	$this->Library_Model->delete_author($author_id);
	redirect(base_url() . 'index.php/library/view_authors/', 'refresh'); 
}

/* Books: Publisher */


public function view_publisher($action='')
{
	$data['action']		  = $this->session->flashdata('action');	
	$data['publisherdata']=$this->Library_Model->view_publisher();					
	$this->load->view('library/view_publisher.php',$data);
}
public function add_publisher()
{
	$this->load->view('library/add_publisher.php');
}
public function add_new_publisher()
{
//transaction starts 
	$this->db->trans_start();
	$data['publisher_name']        = strtoupper($this->input->post('publisher_name'));
	$data['publisher_address']     = strtoupper($this->input->post('publisher_address'));
	$data['publisher_phone1']      = strtoupper($this->input->post('publisher_phone1'));
	$data['publisher_phone2']      = strtoupper($this->input->post('publisher_phone2'));
	$data['publisher_email1']      = $this->input->post('publisher_email1');
	$data['publisher_email2']      = $this->input->post('publisher_email2');
	$this->Library_Model->book_publisher_insert($data);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_publisher($action);
	redirect('Library/view_publisher');
}
public function edit_publisher()
{
	$data['publisher_id']           = strtoupper($this->input->post('publisher_id'));
	$data['publisher_name']         = strtoupper($this->input->post('publisher_name'));
	$data['publisher_address']		= strtoupper($this->input->post('publisher_address'));
	$data['publisher_phone1']		= strtoupper($this->input->post('publisher_phone1'));
	$data['publisher_phone2']		= strtoupper($this->input->post('publisher_phone2'));
	$data['publisher_email1']		= $this->input->post('publisher_email1');
	$this->Library_Model->updates_publisher($data);
	redirect(base_url() . 'index.php/library/view_publisher/', 'refresh');
}
public function delete_publisher()
{
	$publisher_id=$this->input->post('id');
	$this->Library_Model->delete_publisher($publisher_id);
	redirect(base_url() . 'index.php/library/view_publisher/', 'refresh'); 
}		

/* Books: Distributor */

public function view_distributer($action='')
{
	$data['action']         = $this->session->flashdata('action');	
	$data['distributordata']= $this->Library_Model->view_distributer();					
	$this->load->view('library/view_distributer.php',$data);
}
public function add_distributer()
{
	$this->load->view('library/add_distributer.php');
}
public function add_new_distributer()
{
//transaction starts 
	$this->db->trans_start();
	$data['distributor_name']        = strtoupper($this->input->post('distributor_name'));
	$data['distributor_address']     = strtoupper($this->input->post('distributor_address'));
	$data['distributor_phone1']      = strtoupper($this->input->post('distributor_phone1'));
	$data['distributor_phone2']      = strtoupper($this->input->post('distributor_phone2'));
	$data['distributor_email1']      = $this->input->post('distributor_email1');
	$data['distributor_email2']      = $this->input->post('distributor_email2');
	$this->Library_Model->book_distributor_insert($data);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_distributer($action);
	redirect('Library/view_distributer');
}
public function edit_distributer()
{
	$data['distributor_id']         = strtoupper($this->input->post('distributor_id'));
	$data['distributor_name']       = strtoupper($this->input->post('distributor_name'));
	$data['distributor_address']	=strtoupper($this->input->post('distributor_address'));
	$data['distributor_phone1']		=strtoupper($this->input->post('distributor_phone1'));
	$data['distributor_phone2']		=strtoupper($this->input->post('distributor_phone2'));
	$data['distributor_email1']		=$this->input->post('distributor_email1');
	$data['distributor_email2']		=$this->input->post('distributor_email2');
	$this->Library_Model->updates_distributor($data);
	redirect(base_url() . 'index.php/library/view_distributer/', 'refresh'); 
}
public function delete_distributor()
{
	$distributor_id=$this->input->post('id');
	$this->Library_Model->delete_distributor($distributor_id);
	redirect(base_url() . 'index.php/library/view_distributer/', 'refresh'); 
}


/* Book: Shelf */

public function view_shelf($action='')
{
	$data['action']		= $this->session->flashdata('action');
	$data['shelfdata']	=$this->Library_Model->view_shelf();
	$this->load->view('library/view_shelf.php',$data);
}
public function add_shelf()
{
	$this->load->view('library/add_shelf.php');
}
public function add_new_shelf()
{
//transaction starts 
	$this->db->trans_start();
	$shelf=array(
				 'shelf_number' => strtoupper($this->input->post('shelf_name')),
				 'branch_id'    => $this->input->post('branch_id'),
				 'dept_id'      => $this->input->post('dept_id')
				);
	$this->Library_Model->shelf_insert($shelf);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_shelf($action);
	redirect('Library/view_shelf');
}
public function edit_shelf()
{
	$shelf_id=$this->input->post('id');
	$shelf_number=strtoupper($this->input->post('cname'));
	$res = $this->Library_Model->updates_shelf($shelf_id,$shelf_number);
}
public function delete_shelf()
{
	$shelf_id=$this->input->post('id');
	$this->Library_Model->delete_shelf($shelf_id); 
	redirect(base_url() . 'index.php/library/view_stream', 'refresh'); 
}
function get_data3($shelf='')
{
	$page_data['shelf_id']=$shelf;
	$this->load->view('library/shelf_find.php', $page_data);
}

/* Books: Book */

public function view_book_details($action='')
{
	$data['action']     =   $this->session->flashdata('action');
	$this->load->view('library/view_books_bysearch.php',$data);
}
public function get_search_book_details_ajax($book_id,$search_by)
{
	$book_id	=	urldecode($book_id);
	$this->db->select('*')
			->where("$search_by LIKE '%$book_id%'");
	$res=$this->db->get(' view_lib_book_details');		
	$data['bookdata']		=	$res->result_array();
	$this->load->view('library/view_searchbooks.php', $data);
}
public function add_book()
{
	$this->load->view('library/add_book');
}
public function add_bulk_book()
{
	$this->load->view('library/add_book_bulk');
}
public function add_new_book()
{
	$data['list_data']      =   $this->Library_Model->get_author_list();
	$data['languagedata']   =   $this->Library_Model->get_language_list();
	$data['categorydata']   =   $this->Library_Model->get_category_list();
	$data['streamdata']     =   $this->Library_Model->get_stream_list();
	$data['shelf']          =   $this->Library_Model->get_shelf_list();
	$this->load->view('library/add_book',$data);
}
public function add_book_data()
{
//transaction starts 
	$this->db->trans_start();
	$master_details= array(
							'book_name'      	 => strtoupper($this->input->post('book_name')),
							'author_id'        	 => $this->input->post('author_id'),
							'book_language_id'   => $this->input->post('language_id'),
							'book_category_id'   => $this->input->post('category_id'),
							'book_stream_id'     => $this->input->post('stream_id'),		
							'isbn'        		 => $this->input->post('isbn'),
							'edition'        	 => $this->input->post('edition'),
							'price'       		 => $this->input->post('price'),
							'no_of_pages'        => $this->input->post('no_of_pages')
						  );
	if($master_details['author_id']=='')
	{
	    $master_details['author_id']            =   NULL;    
	}
	if($master_details['book_language_id']=='')
	{
	    $master_details['book_language_id']     =   NULL;    
	}
	if($master_details['book_category_id']=='')
	{
	    $master_details['book_category_id']     =   NULL;    
	}
	if($master_details['book_stream_id']=='')
	{
	    $master_details['book_stream_id']       =   NULL;    
	}
	

	$book_details=  array(
						    'shelf_id'          =>  $this->input->post('shelf_id'),
							'book_number'       =>  $this->input->post('book_number'),
							'is_deleted'        =>  'N',
							'is_available'      =>  'Y',
							'is_reserved'       =>  'N',
							'entered_by'        =>  $this->session->userdata('login_user_id'),
							'approved_by'       =>  $this->session->userdata('login_user_id'),
							'entered_date'      =>  date('Y-m-d'),
							'approved_date'     =>  date('Y-m-d')
						);
	if($book_details['shelf_id']=='')
	{
	    $book_details['shelf_id']               =   NULL;    
	}
	$this->Library_Model->book_insert($master_details,$book_details);
//transaction completed
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	//$this->view_book_details($action);
	redirect('Library/view_book_details');
}
public function edit_book()
{
	$data['book_master_id']      = $this->input->post('book_master_id');
	$data['book_number']         = $this->input->post('book_number');
	$data['book_name']		     = strtoupper($this->input->post('book_name'));
	
	$this->Library_Model->update_book($data['book_master_id'],$data['book_number']);
	redirect(base_url() . 'index.php/library/view_book_details/', 'refresh');
}

public function edit_book_details()
{
	$book_id=$this->uri->segment(3);
	$data['authordata']     =   $this->Library_Model->get_author_list();
	$data['languagedata']   =   $this->Library_Model->get_language_list();
	$data['categorydata']   =   $this->Library_Model->get_category_list();
	$data['streamdata']     =   $this->Library_Model->get_stream_list();
	$data['bookdata']=$this->Library_Model->edit_book_details($book_id);
	$this->load->view('library/edit_book.php',$data);
}
public function edit_book_data()
{
	$this->db->trans_start();
	$data['book_master_id']    = $this->input->post('book_master_id');
	$data['book_name']		   = $this->input->post('book_name');
	$data['author_id']         = $this->input->post('author_name');
	$data['book_language_id']  = $this->input->post('language_name');
	$data['book_category_id']  = $this->input->post('category_name');
	$data['book_stream_id']    = $this->input->post('stream_name');
	$data['isbn']		       = $this->input->post('isbn');
	$data['edition'] 		   = $this->input->post('edition');
	$data['price']   		   = $this->input->post('price');
	$data['no_of_pages']	   = $this->input->post('no_of_pages');
	
	$this->Library_Model->edit_book_data($data);
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
		$this->session->set_flashdata('action',$action);
	}
	else
	{
		$action="success";
		$this->session->set_flashdata('action',$action);
	}
	$this->view_book_details($action); 
}

public function delete_book($book_master_id)
{
//	$book_master_id=$this->input->post('id');
	$this->Library_Model->delete_book($book_master_id); 
	redirect(base_url() . 'index.php/library/view_book_details', 'refresh'); 
}

/* Books: Issue Book */

public function view_issue_data($action='')
{
	$data['action']=$action;
	$data['fine'] = $this->Library_Model->view_fine_detail();
	$data['member']=$this->Library_Model->view_member_type();
	$this->load->view('library/issue_view_books.php',$data);
}
public function get_student_details_ajax($member_id,$member_type)
{
	$member_id	=	urldecode($member_id);
	if( $member_type== "1")
	{
		$this->db->select('*')
				->where("name LIKE '%$member_id%' OR student_id LIKE '$%member_id%'");
		$res=$this->db->get('view_students');
			$data['student']		=	$res->result_array();
		$this->load->view('library/issue_student_view.php', $data);
	}
	else if($member_type== "2")
	{
		$this->db->select('*')
				->where("name LIKE '%$member_id%' OR staff_id LIKE '%$member_id%'");
		$res=$this->db->get('view_staff');
		$data['student']		=	$res->result_array();
		$this->load->view('library/issue_staff_view.php', $data);
	}
}
public function get_book_details_ajax($book_id,$book_count)
{
	$book_id	=	urldecode($book_id);
	$this->db->select('*')
			->where("book_name LIKE '%$book_id%' AND is_available LIKE 'Y'");
	$res=$this->db->get(' view_lib_book_details');		
	$data['student']		=	$res->result_array();
	$data['book_count']=$book_count;
	$data['fine'] = $this->Library_Model->view_fine_detail();
	$this->load->view('library/issue_books.php', $data);
}

public function student_book_detail_ajax($student_id)
{
	$this->db->where('member_id',$student_id);
//	$this->db->where('member_type_id',"1");
	$this->db->where('is_available',"N");
	$res=$this->db->get('view_lib_due_details');		
	$data['student']		=	$res->result_array();
	$this->load->view('library/issue_student_book_view.php', $data);
}
public function staff_book_detail_ajax($staff_id)
{
	$this->db->where('member_id',$staff_id);
//	$this->db->where('member_type_id','2');
	$res=$this->db->get(' view_lib_due_details');		
	$data['student']		=	$res->result_array();
	$this->load->view('library/issue_student_book_view.php', $data);
}
public function issue_book_data()
{
	$days_without_fine=$this->input->post('days_without_fine');
//transaction starts 
	$this->db->trans_start();
	$issue_details = array(
							'issued_date' 	 =>date('Y-m-d'),
							'issued_by'		 =>$this->session->userdata('login_user_id'),
							'member_id'      =>$this->input->post('student_id'),
							'return_date'  	 =>date('Y-m-d',strtotime("+$days_without_fine day")),
							'is_available'	 =>'N',
							'returned_date'  => 1,		
							'received_by'    =>1,
							'member_type_id' =>$this->input->post('member_type')
						   );
	$book_details_id=$this->input->post('book_details_checked[]');
	//var_dump($book_details_id);	
	//count($book_details_id);
	
	$check_status=$this->input->post('checked[]');				   
	$i=0;
	for($i=0 ; $i<count($book_details_id) ; $i++)
	{
		if($check_status[$i]=='Y')
		{					   
			$issue_details['book_details_id']=$book_details_id[$i];
			
			//var_dump($issue_details);
			
			$affected_rows=$this->Library_Model->issue_insert($issue_details);
			//$i=$i+1;
		
		}
	}
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
	}
	else
	{
		$action="success";
	}
	$this->view_issue_data($action);
}


/* Books: Return Book */


public function return_book($action='')
{
	$data['action']=$action;
	$data['bookdata']=$this->Library_Model->return_book();
	$this->load->view('library/return_book.php',$data);
}

public function get_books_ajax($book_id)
{
	$book_id	=	urldecode($book_id);
	$this->db->select('*')
			->where("book_name LIKE '%$book_id%' AND is_available LIKE 'N'");
	$res=$this->db->get('view_lib_due_details');		
	$data['book']		=	$res->result_array();
	$this->load->view('library/return_book_view.php', $data);
}

public function student_detail_ajax($student_id)
{
	$fine_per_day=$this->db->get('tbl_lib_fine_setting');
	$data['fine']		=	$fine_per_day->result_array();
	$this->db->where('member_id',$student_id);
	$this->db->where('is_available',"N");
	$res=$this->db->get(' view_lib_due_details');
	$this->db->where('student_id',$student_id);
	$result=$this->db->get('view_students');
	$data['student']	=	$result->result_array();
	$data['book']		=	$res->result_array();
	$this->load->view('library/return_student_book_view.php', $data);
}

public function insert_return_book_data()
{
//transaction starts
	$this->db->trans_start();
	$i=0;
	$book_details_id=$this->input->post('book_details_checked[]');
	$check_status=$this->input->post('checked[]');
	$check_status_of_fine=$this->input->post('checking');
	$i=0;
	for($i=0 ; $i<count($book_details_id) ; $i++)
	{
		if($check_status[$i]=='Y')
		{
			$book_details=$book_details_id[$i];
			$return_details = array('is_available'    =>'Y' );
			$update         = array('is_available'    =>'Y',
									'returned_date'   =>date('Y-m-d'));
			$this->Library_Model->insert_data($return_details,$book_details,$update);
		}
	}
	if($check_status_of_fine=='Y')
	{
		$data=array(
		'branch_id'			=>'0',
		'department_id'		=>'0',
		'member_id'			=>$this->input->post('member_id'),
		'member_type'		=>'student',
		'date_of_collection'=>date('Y-m-d'),
		'fine_amount'		=>$this->input->post('paying_fine')
		);
		$this->Library_Model->insert_paying_fine($data);
	}
//transaction completed

	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE)
	{
		$action="failed";
	}
	else
	{
		$action="success";
	}
	$this->return_book($action);	
}

/* Report: Book Report */

public function book_report()
{	
	$data['bookdata'] = $this->Library_Model->view_book_details();
	$this->load->view('library/book_report_by_search.php',$data);
}
public function book_report_by_search_ajax($book_id,$search_by)
{
	$book_id	=	urldecode($book_id);
	$this->db->select('*')
			->where("$search_by LIKE '%$book_id%'");
	$res=$this->db->get(' view_lib_book_details');		
	$data['bookdata']		=	$res->result_array();
	$this->load->view('library/book_report.php', $data);
}

/* Report: Due Report */

public function get_due_report()
{
	$this->load->view('library/due_report.php');
}
public function due_report($due_date)
{
	$due_dates		= date('Y-m-d',strtotime($due_date));
	$data['result'] = $this->Library_Model->due_report($due_dates);
	$this->load->view('library/view_due_report',$data);
}
/* Report: fine Report */

public function fine_report()
{	
	$this->load->view('library/fine_report.php');
}
public function get_fine_report_ajax($due_date1,$due_date2)
{
	$due_dates1		= date('Y-m-d',strtotime($due_date1));
	$due_dates2		= date('Y-m-d',strtotime($due_date2));
//	echo $due_dates1; die();
	$data['fine'] = $this->Library_Model->view_fine_details($due_dates1,$due_dates2);
	$this->load->view('library/fine_report_by_date.php',$data);
}

/* Transaction: Book Transaction */

public function get_book_transaction()
{
	$this->load->view('library/book_transaction.php');
}
public function get_book_transaction_ajax($book_id)
{
	$book_id	=	urldecode($book_id);
	$this->db->select('*')
			->where("book_name LIKE '%$book_id%'");
	$res=$this->db->get('view_lib_book_details');		
	$data['book']		=	$res->result_array();
	$this->load->view('library/view_transaction_books.php', $data);
}
public function book_transaction_detail_ajax($book_id)
{
	$this->db->select('*');
	$this->db->where('book_master_id',$book_id);
	$res=$this->db->get('view_lib_due_details');		
	$data['book']		=	$res->result_array();
	$this->load->view('library/view_book_transaction.php', $data);
}

/* Transaction: Member Transaction */

public function get_member_transaction()
{
	$this->load->view('library/member_transaction.php');
}
public function get_member_transaction_ajax($member_id)
{
	$member_id	=	urldecode($member_id);
	$this->db->select('*')
			->where("name LIKE '%$member_id%'");
	$res=$this->db->get('view_students');		
	$data['student']		=	$res->result_array();
	$this->load->view('library/view_transaction_members.php', $data);
}
public function member_transaction_detail_ajax($student_id)
{
	$this->db->select('*');
	$this->db->where('member_id',$student_id);
	$res=$this->db->get('view_lib_due_details');		
	$data['book']		=	$res->result_array();
	$this->load->view('library/view_member_transaction.php', $data);
}

public function member_transaction()
{
	$member_id		= $this->input->post('member_id');
	$data['result'] = $this->Library_Model->get_due_detail($member_id);
	$data['data']   = $this->Library_Model->get_student_detail($member_id);
	$this->load->view('library/view_member_transaction',$data);
}
	
function book_bulk1($param1 = '')
{
	if($param1 == 'add_bulk_book') 
	{
		$book_names     = $this->input->post('book_name');
		$book_number    = $this->input->post('book_number');
		$isbn    		= $this->input->post('isbn');
		
		$book_entries = sizeof($book_names);
		for($i = 0; $i < $book_entries; $i++)
		{
			$data['book_name']      =   $book_names[$i];
			$data2['book_number']   =   $book_number[$i];
			$data['isbn']     	    =   $isbn[$i];
			if($data['book_name'] == '' || $data2['book_number'] == '')
				continue;
				$this->db->insert('tbl_lib_book_master' , $data);
				$book_master_id = $this->db->insert_id();
				
			$data2['book_master_id']=  $book_master_id;
			$data2['is_deleted']    =  'N';
			$data2['is_available']  =  'Y';
			$data2['is_reserved']   =  'N';
			$data2['entered_date']  = date('Y-m-d');
			$data2['entered_by']  	= $this->session->userdata('login_user_id');
			$data2['approved_date'] = date('Y-m-d');
			$data2['approved_by']   = $this->session->userdata('login_user_id');
		
				$this->db->insert('tbl_lib_book_details' , $data2);
				$action	=	"success";
				$this->session->set_flashdata('action',$action);
		}
			
	}           
	$this->load->view('library/add_book_bulk');
	//redirect('library/add_book_bulk');
}

	function getBook_details_ajax()
	{
          $data=array();
        $book = $this->Library_Model->getBook_details_ajax($_POST['author'], $_POST['language'], $_POST['category'],$_POST['length'],$_POST['start'],$_POST['search']['value']);
        $i = $_POST['start'];
        foreach($book as $new){
            $i++;
			if($new->is_available=='Y'){
			$availability = "<font color='#006600'> AVAILABLE </font>";
			}elseif($new->is_available=='N'){
			$availability = "<font color='#FF0000'> NOT AVAILABLE </font>";
			}
            $button = '<a title="Edit" class="green" href="' . site_url('Library/edit_book_details/'.$new->book_master_id) . '"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp; <a title="Delete" class="info" href="' . site_url('Library/delete_book/'.$new->book_master_id) . '"><i class="ace-icon fa fa-trash bigger-130"></i></a> 
                                      	';
                    				
            $data[] = array($i,$new->book_number, $new->book_name, $new->author_name, $new->book_category_name, $new->book_language_name,$availability,$button);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Library_Model->getBook_details_ajax_count(),
            "recordsFiltered" => $this->Library_Model->getBook_details_ajax_count($_POST['author'], $_POST['language'], $_POST['category'],$_POST['search']['value']),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
	}

	function getBook_details_ajax1()
	{
          $data=array();
        $book = $this->Library_Model->getBook_details_ajax($_POST['author'], $_POST['language'], $_POST['category'],$_POST['length'],$_POST['start'],$_POST['search']['value']);
        $i = $_POST['start'];
        foreach($book as $new){
            $i++;
            $button = '<a title="Edit" class="green" href="' . site_url('Library/edit_book_details/'.$new->book_master_id) . '"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp;&nbsp; <a title="Delete" class="info" href="' . site_url('Library/delete_book/'.$new->book_master_id) . '"><i class="ace-icon fa fa-trash bigger-130"></i></a> 
                                      	';
                    				
            $data[] = array($i,$new->book_number, $new->book_name, $new->author_name, $new->book_category_name, $new->book_language_name);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Library_Model->getBook_details_ajax_count(),
            "recordsFiltered" => $this->Library_Model->getBook_details_ajax_count($_POST['author'], $_POST['language'], $_POST['category'],$_POST['search']['value']),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
	}
	
	function download_book_details()
	{
		$author = $this->input->post('author');
		$language = $this->input->post('language');
		$category = $this->input->post('category');
        $data['book'] = $this->Library_Model->getBook_details($author, $language, $category);
		$this->load->view('library/pdf_book_details',$data);

		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('library/pdf_book_details',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('book_report.pdf','D');	
	}

}

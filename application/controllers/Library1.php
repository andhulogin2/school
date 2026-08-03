<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

/**
* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -
* 		http://example.com/index.php/welcome/index
*	- or - 
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see https://codeigniter.com/user_guide/general/urls.html
*/


 		/* Books: Category */

public function dashboard()
	{
		$this->load->view('library/library_dashboard.php');
	}
	
public function view_book_category($action='')
{
	$data['action']		 = $this->session->flashdata('action');
	$categorydata  		 = $this->db->query("select * from tbl_lib_book_category");	
	$data['categorydata']= $categorydata->result_array();
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
	$languagedata  		  = $this->db->query("select * from tbl_lib_book_language");
	$data['action']		  = $this->session->flashdata('action');	
	$data['languagedata'] = $languagedata->result_array();
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
	$streamdata			= $this->db->query("select * from tbl_lib_book_stream");	
	$data['action']		= $this->session->flashdata('action');
	$data['streamdata'] = $streamdata->result_array();
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
	$authordata	       = $this->db->query("select * from tbl_lib_authors");	
	$data['action']    = $this->session->flashdata('action');
	$data['authordata']= $authordata->result_array();	
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
	$this->Library_Model->updates_author($data['author_id'],$data['author_name'],$data['author_address'],$data['author_phone1'],$data['author_phone2'],
										 $data['author_email']);
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
	$publisherdata		  = $this->db->query("select * from tbl_lib_publishers");
	$data['action']		  = $this->session->flashdata('action');	
	$data['publisherdata']=$publisherdata->result_array();					
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
	$this->Library_Model->updates_publisher($data['publisher_id'],$data['publisher_name'],$data['publisher_address'],$data['publisher_phone1'],$data['publisher_phone2'],
	                                        $data['publisher_email1']);
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
    $distributordata        = $this->db->query("select * from tbl_lib_distributors");
	$data['action']         = $this->session->flashdata('action');	
	$data['distributordata']= $distributordata->result_array();					
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
	$data['distributor_name']         = strtoupper($this->input->post('distributor_name'));
	$data['distributor_address']		=strtoupper($this->input->post('distributor_address'));
	$data['distributor_phone1']		=strtoupper($this->input->post('distributor_phone1'));
	$data['distributor_phone2']		=strtoupper($this->input->post('distributor_phone2'));
	$data['distributor_email1']		=$this->input->post('distributor_email1');
	$data['distributor_email2']		=$this->input->post('distributor_email2');
	$this->Library_Model->updates_distributor($data['distributor_id'],$data['distributor_name'],$data['distributor_address'],$data['distributor_phone1'],
	                                          $data['distributor_phone2'],$data['distributor_email1'],$data['distributor_email2']);
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
	$shelfdata			= $this->db->query("select * from tbl_lib_shelf");	
	$data['action']		= $this->session->flashdata('action');
	$data['shelfdata']	= $shelfdata->result_array();					
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
				 'dept_id'    => $this->input->post('dept_id')
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
	$bookdata           =   $this->db->query("select * from view_lib_book_details");	
	$data['bookdata']   =   $bookdata->result_array();
	$data['action']     =   $this->session->flashdata('action');
	$this->load->view('library/view_book.php',$data);
}
public function add_book()
{
	$this->load->view('library/add_book');
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
							'book_name'      => strtoupper($this->input->post('book_name')),
							'author_id'        => $this->input->post('author_id'),
							'book_language_id'        => $this->input->post('language_id'),
							'book_category_id'       => $this->input->post('category_id'),
							'book_stream_id'        => $this->input->post('stream_id'),		
							'isbn'        => $this->input->post('isbn'),
							'edition'        => $this->input->post('edition'),
							'price'        => $this->input->post('price'),
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
public function delete_book()
{
	$book_master_id=$this->input->post('id');
	$this->Library_Model->delete_book($book_master_id); 
	redirect(base_url() . 'index.php/library/view_book_details', 'refresh'); 
}


/* Books: Issue Book */

public function view_issue_data($action='')
{
	$bookdata= $this->db->query("select * from view_lib_book_details where is_available='Y'");	
	$data['bookdata']=$bookdata->result_array();
	$data['action']=$action;
	$this->load->view('library/issue_view.php',$data);
}
public function book_issue($book_details_id)
{
	$page_data['book_details_id']  =  $book_details_id;
	$this->load->view('library/issue_book.php',$page_data);
}
public function get_student_details($book_details_id='',$student_id='')
{
	$this->db->where('student_id', $student_id);
	$this->db->select('student_id,name,address');
	$this->db->from('student');
	$data['student']		=	$this->db->get()->result_array();
	$data['student_id']	=	$student_id;
	$data['book_details_id']	=	$book_details_id;
	$this->load->view('library/issue_book_view.php', $data);
}
public function issue_book_data($book_details_id='',$student_id='')
{
//transaction starts 
	$this->db->trans_start();
	$issue_details = array(
							'issued_date' =>date('Y-m-d'),
							'issued_by'=>$this->session->userdata('login_user_id'),
							'member_id'     => $student_id,
							'book_details_id' => $book_details_id,
							'return_date'  =>date('Y/m/d',strtotime("+10 day")),
							'is_available'=>'N',
							'returned_date'        => 1,		
							'received_by'        =>1
						   );
	$this->Library_Model->issue_insert($issue_details,$book_details_id);
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
	$this->view_issue_data($action);
}


/* Books: Return Book */


public function return_book($action='')
{
	$bookdata= $this->db->query("select * from view_lib_book_details where is_available='N'");	
	$data['bookdata']=$bookdata->result_array();
	$data['action']=$action;
	$this->load->view('library/return_book.php',$data);
}
public function insert_return_book_data($book_details_id='')
{
//transaction starts 
	$this->db->trans_start();
	$return_details = array(
						    'is_available'    =>'Y'
						   );
	$update         = array(
					        'is_available'    =>'Y',
					        'returned_date'    =>date('Y-m-d')
                           );
	$this->Library_Model->insert_data($return_details,$book_details_id,$update);
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
	$bookdata		  = $this->db->query("select * from view_lib_book_details");	
	$data['bookdata'] = $bookdata->result_array();
	$this->load->view('library/book_report.php',$data);
}

/* Report: Due Report */

public function get_due_report()
{
	$this->load->view('library/due_report.php');
}
public function due_report()
{
	$due_date		= date('Y-m-d',strtotime( $this->input->post('due_date')));
	$sql        	= "select book_name,return_date,name,issued_date from view_lib_due_details where 
	return_date<='" . $due_date	. "' and is_available='N'  order by return_date,name";
	$data['result'] = $this->db->query($sql)->result_array();
	$this->load->view('library/view_due_report',$data);
}

/* Transaction: Book Transaction */

public function get_book_transaction()
{
	$this->load->view('library/book_transaction.php');
}
public function book_transaction()
{
	$book_id		= $this->input->post('book_id');
	$sql        	= "select member_id,name,book_number,book_name,returned_date,return_date,issued_date from view_lib_due_details where 
	book_master_id ='" . $book_id	. "'  order by return_date,name";
	$data['result'] = $this->db->query($sql)->result_array();
	$this->load->view('library/view_book_transaction',$data);
}

/* Transaction: Member Transaction */

public function get_member_transaction()
{
	$this->load->view('library/member_transaction.php');
}
public function member_transaction()
{
	$member_id		= $this->input->post('member_id');
	$sql        	= "select * from view_lib_due_details where 
	member_id ='" . $member_id	. "'  order by return_date,name";
	$data['result'] = $this->db->query($sql)->result_array();
	
	$student        = "select student_id, name from student where 
	student_id ='" . $member_id	. "' ";
	$data['data'] = $this->db->query($student)->result_array();
	$this->load->view('library/view_member_transaction',$data);
}

}

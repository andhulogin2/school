<?php 
   class Library_Model extends CI_Model 
   {
	
      function __construct()
	  { 
   			parent::__construct(); 
  	  }
	  function view_fine()
	  {
//		$this->db->where('member_type_id', $member_type);
		$categorydata  		 = $this->db->get('tbl_lib_fine_setting');	
		return $categorydata->result_array();
	  }
	  function insert_fine($data) 
	  {		
		
		$this->db->update('tbl_lib_fine_setting',$data);
      }
	  
	  function view_book_category()
	  {
		$categorydata  		 = $this->db->query("select * from tbl_lib_book_category order by book_category_name asc");	
		return $categorydata->result_array();
	  }
	  
	  function book_category_insert($data) 
	  {		
		$this->db->insert('tbl_lib_book_category',$data);
      }
	 
	  function updates_category($book_category_id,$book_category_name) 
	  {
     	$this->db->where('book_category_id', $book_category_id);
     	$this->db->update('tbl_lib_book_category',array('book_category_name'=>$book_category_name));echo $this->db->last_query();die();
      }
	  
	  function delete_category($book_category_id)
	  {
			$this->db->where('book_category_id', $book_category_id);
			$this->db->delete('tbl_lib_book_category');
		  if($this->db->affected_rows>0)
		  {
			$action="modified";
		  }
		  else
		  {
			$action="error";
		  }
      }

	  function book_stream_insert($data='') 
	  {
				$this->db->insert('tbl_lib_book_stream',$data);
      }
	  
	  public function view_book_language()
	  {
		$languagedata  		  = $this->db->query("select * from tbl_lib_book_language order by book_language_name asc");
		return $languagedata->result_array();
	  }
	  
	  function book_language_insert($data='') 
	  {
				$this->db->insert('tbl_lib_book_language',$data);
      }
	  
	  function book_author_insert($data='') 
	  {
				$this->db->insert('tbl_lib_authors',$data);
      }
	  
	  function book_publisher_insert($data='') 
	  {
				$this->db->insert('tbl_lib_publishers',$data);
      }
	  
	  function book_distributor_insert($data='') 
	  {
				$this->db->insert('tbl_lib_distributors',$data);
      }
	
	  function update_category($data,$param2) 
	  {
     			$this->db->where('book_category_id', $data);
     			$this->db->update('tbl_lib_book_category', array('book_category_name'=>$param2));
      }
	  
	  function get_book_list()
	  {
				$this->db->select("author_id,author_name,book_language_id,book_language_name,book_category_id,book_category_name,
				                   book_stream_id,book_stream_name,shelf_id,shelf_number");
				$this->db->from('view_lib_book_details');
				$query = $this->db->get();
				return $query->result();
      }
	  
	function view_book_details()
	{
		$bookdata           =   $this->db->query("select * from view_lib_book_details ORDER BY book_category_name asc ,book_stream_name asc, book_name ASC");	
		return  $bookdata->result_array();
	}

	function edit_book_details($book_id)
	{
		$this->db->where('book_master_id',$book_id);
		$bookdata  =   $this->db->get("view_lib_book_details");	
		return  $bookdata->result_array();
	}
	function edit_book_data($data)
	{
	  $book_master_id = $data['book_master_id'];
	  $this->db->where('book_master_id', $book_master_id);
      $this->db->update('tbl_lib_book_master', $data);		 
	}
	function view_fine_detail()
	{
		$fine=$this->db->get('tbl_lib_fine_setting');
		return  $fine->result_array();
	}

	function view_fine_details($due_dates1,$due_dates2)
	{
		$sql        	= "select date_of_collection,SUM(fine_amount) as fine_amounts from tbl_lib_fine_collection where 
		date_of_collection<='" . $due_dates2	. "' and date_of_collection>='" . $due_dates1	. "' group by date_of_collection order by date_of_collection";
		$q= $this->db->query($sql);
		return $q->result_array();
	}
	
	function book_insert($master_details,$book_details) 
	 {
		$this->db->insert('tbl_lib_book_master',$master_details);
		$book_details['book_master_id']=$this->db->insert_id();
		$this->db->insert('tbl_lib_book_details',$book_details);
     }
	   
	 function add_book_stream($data)
	{
	  $this->db->insert('tbl_lib_book_stream', $data);
	}
	
   function delete_book_stream($book_stream_id) 
   {
      
	   $this->db->where('book_stream_id', $book_stream_id);
      $this->db->delete('tbl_lib_book_stream');

    }
	
	function edit_book_stream($book_stream_id)
	{
	   
	  $data['book_stream_name'] = $this->input->post('stream_name0');;
	  $this->db->where('book_stream_id', $book_stream_id);
      $this->db->update('tbl_lib_book_stream', $data);		 
	}
	
	
    function add_publisher($data)
	{
	  $this->db->insert('tbl_lib_publishers', $data);
	}	
	
	
	
	function update_publisher($publisher_id) 
     {
      
	  $data['publisher_name']   =$this->input->post('name');
	  $data['publisher_address']=$this->input->post('address');
 	  $data['publisher_phone1'] =$this->input->post('phone1');
 	  $data['publisher_phone2'] =$this->input->post('phone2');
 	  $data['publisher_email1'] =$this->input->post('email1');
 	  $data['publisher_email2'] =$this->input->post('email2');
      $this->db->where('publisher_id', $publisher_id);
      $this->db->update('tbl_lib_publishers', $data);

    }

	
    function add_distributer($data)
	{
	  $this->db->insert('tbl_lib_distributors', $data);
	}	
	
	 function delete_distributer($distributor_id) 
     {
      
	  $data['is_deleted'] = 'Y';
      $this->db->where('distributor_id', $distributor_id);
      $this->db->update('tbl_lib_distributors', $data);

    }
	
	
	function update_distributer($distributor_id) 
     {
      
	  $data['distributor_name']   =$this->input->post('name');
	  $data['distributor_address']=$this->input->post('address');
 	  $data['distributor_phone1'] =$this->input->post('phone1');
 	  $data['distributor_phone2'] =$this->input->post('phone2');
 	  $data['distributor_email1'] =$this->input->post('email1');
 	  $data['distributor_email2'] =$this->input->post('email2');
      $this->db->where('distributor_id', $distributor_id);
      $this->db->update('tbl_lib_distributors', $data);

    }

	function get_category_name($book_category_id) 
	{
	
	$this->db->select("book_category_id,book_category_name");
    	$this->db->from('tbl_lib_book_category');
    	$q = $this->db->get();
    	$res = $q->result_array();
        foreach ($res as $row)
            return $row['book_category_name'];
    }
	   

	function get_language_name($book_language_id) 
	{
	
	$this->db->select("book_language_id,book_language_name");
    	$this->db->from('tbl_lib_book_language');
    	$q = $this->db->get();
    	$res = $q->result_array();
        foreach ($res as $row)
            return $row['book_language_name'];
    }
	   
	function updates_language($book_language_id,$book_language_name) 
    {
     $this->db->where('book_language_id', $book_language_id);
     $this->db->update('tbl_lib_book_language', array('book_language_name'=>$book_language_name));
    }
	
	function delete_language($book_language_id) 
	{
      $this->db->where('book_language_id', $book_language_id);
      $this->db->delete('tbl_lib_book_language');
    }
	 
	public function view_stream()
	{
		$streamdata			= $this->db->query("select * from tbl_lib_book_stream ORDER BY book_stream_name ASC");	
		return $streamdata->result_array();
	}
	  
	function get_stream_name($book_stream_id) 
	{
	
	$this->db->select("book_stream_id,book_stream_name");
    	$this->db->from('tbl_lib_book_stream');
    	$q = $this->db->get();
    	$res = $q->result_array();
        foreach ($res as $row)
            return $row['book_stream_name'];
    }
	   
	function updates_stream($data,$param2) 
	{
     $this->db->where('book_stream_id', $data);
     $this->db->update('tbl_lib_book_stream', array('book_stream_name'=>$param2));
    }
	
	public function view_authors()
	{
		$authordata	       = $this->db->query("select * from tbl_lib_authors order by author_name asc");	
		return $authordata->result_array();
	}
	     
	function get_author_list() 
	{
	
	$this->db->select("author_id,author_name,author_address,author_phone1,author_phone2,author_email");
	$this->db->order_by("author_name", "asc");
    	$this->db->from('tbl_lib_authors');
    	
    	$q = $this->db->get();
    	return $res = $q->result_array();
       
						
    }
	   function get_language_list()
	 {
    	$this->db->select("book_language_id,book_language_name");
    	$this->db->order_by("book_language_name", "asc");
    	$this->db->from('tbl_lib_book_language');
     	$q = $this->db->get();
    	return $q->result();
    }
	   function get_category_list()
	 {
    	$this->db->select("book_category_id,book_category_name");
    	$this->db->order_by("book_category_name", "asc");
    	$this->db->from('tbl_lib_book_category');
    	$q = $this->db->get();
    	return $q->result();
    }
	function get_stream_list()
	 {
    	$this->db->select("book_stream_id,book_stream_name");
    	$this->db->order_by("book_stream_name", "asc");
    	$this->db->from('tbl_lib_book_stream');
    	$q = $this->db->get();
    	return $q->result();
    }
	
	function view_shelf()
	{
		$shelfdata			= $this->db->query("select * from tbl_lib_shelf");	
		return $shelfdata->result_array();
	}
	
	function get_shelf_list()
	 {
    	$this->db->select("shelf_id,shelf_number");
    	$this->db->order_by("shelf_number", "asc");
    	$this->db->from('tbl_lib_shelf');
    	$q = $this->db->get();
    	return $q->result();
    }
	
	function updates_author($data) 
	{
	 $author_id=$data['author_id'];
     $this->db->where('author_id', $author_id);
     $this->db->update('tbl_lib_authors', $data);
    }
	
	function delete_author($param2) 
	{
      $this->db->where('author_id', $param2);
      $this->db->delete('tbl_lib_authors');
	
    } 
	function view_distributer()
	{
		$distributordata        = $this->db->query("select * from tbl_lib_distributors order by distributor_name asc");
		return $distributordata->result_array();					
	}
	
   function get_distributor_name($distributor_id) 
	   	{
	
			$this->db->select("distributor_id,distributor_name,distributor_address,distributor_phone1,distributor_phone2,distributor_email1,distributor_email2");
		    $this->db->from('tbl_lib_distributors');
    		$q = $this->db->get();
    		$res = $q->result_array();
		    foreach ($res as $row)
            return $row['distributor_name'];
						
    }
	   
	function updates_distributor($data) 
	{
	$distributor_id=$data['distributor_id'];
    $this->db->where('distributor_id', $distributor_id);
    $this->db->update('tbl_lib_distributors',$data);
    }
	
	function delete_distributor($param2) 
	{
      $this->db->where('distributor_id', $param2);
      $this->db->delete('tbl_lib_distributors');
	
    } 
	   
	 function update_book($data) 
	{
    $this->db->where('book_master_id', $data);
     $this->db->update('tbl_lib_book_master', array('book_name'=>strtoupper($this->input->post('book_name'))));
    $this->db->where('book_master_id', $data);
     $this->db->update('tbl_lib_book_details', array('book_number'=>$this->input->post('book_number')));
    }
	 
	function view_publisher()
	{
	$publisherdata		  = $this->db->query("select * from tbl_lib_publishers order by publisher_name asc");
	return $publisherdata->result_array();					
	}
	 
	function get_publisher_name($distributor_id) 
	{
		$this->db->select("publisher_id,publisher_name,publisher_address,publisher_phone1,publisher_phone2,publisher_email1,publisher_email2");
		$this->db->from('tbl_lib_publishers');
    	$q = $this->db->get();
    	$res = $q->result_array();
		foreach ($res as $row)
        return $row['publisher_name'];
    }
	   
function updates_publisher($data) 
{
	$publisher_id=$data['publisher_id'];
    $this->db->where('publisher_id', $publisher_id);
    $this->db->update('tbl_lib_publishers',$data);
    }
	
	function delete_publisher($param2) 
	{
      $this->db->where('publisher_id', $param2);
      $this->db->delete('tbl_lib_publishers');
	
    }    

	function delete_book($param2)
	{
	  $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
	    
      $this->db->where('book_master_id', $param2);
      $this->db->delete('tbl_lib_book_master');
	
      $this->db->where('book_master_id', $param2);
      $this->db->delete('tbl_lib_book_details');
      
      $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
	
    }
	
	function view_issue_data()
	{
		$bookdata= $this->db->query("select * from view_lib_book_details where is_available='Y'");	
		return $bookdata->result_array();
	}
	function view_member_type()
	{
		$member= $this->db->get('tbl_lib_member_type');	
		return $member->result_array();
	}
 	
	function issue_insert($issue_details)
	{
		 $this->db->insert('tbl_lib_issue_master',$issue_details);
		 $book_details_id=$issue_details['book_details_id'];
		 $this->db->where('book_details_id',$book_details_id);
         $this->db->update('tbl_lib_book_details', array('is_available'=>'N'));
		 return $this->db->affected_rows();
     }
	 function insert_data($return_details,$book_details_id,$update)
	 {
	 	$this->db->where('book_details_id',$book_details_id);
        $this->db->update('view_lib_book_details',$return_details);
		
	 	$this->db->where('book_details_id',$book_details_id);
		$this->db->update('tbl_lib_issue_master',$update);
	}
	function insert_paying_fine($data)
    {
		 $this->db->insert('tbl_lib_fine_collection',$data);
	}
	function shelf_insert($shelf) 
	{
		$this->db->insert('tbl_lib_shelf',$shelf);
    }
	 function updates_shelf($data,$param2) 
    {
     $this->db->where('shelf_id', $data);
     $this->db->update('tbl_lib_shelf', array('shelf_number'=>$param2));
    }
	function delete_shelf($param2) 
	{
      $this->db->where('shelf_id', $param2);
      $this->db->delete('tbl_lib_shelf');
	
    }
	
	function return_book()
	{
		$bookdata= $this->db->query("select * from view_lib_book_details where is_available='N'");	
		return $bookdata->result_array();
	}
	
	function due_report($due_date)
	{
		$sql        	= "select book_name,return_date,name,issued_date,book_number,member_id from view_lib_due_details where 
		return_date<='" . $due_date	. "' and is_available='N'  order by return_date,name";
		$q= $this->db->query($sql);
		return $q->result_array();
	}
	
	function book_transaction($book_id)
	{
		$sql        	= "select member_id,name,book_number,book_name,returned_date,return_date,issued_date from view_lib_due_details where 
		book_master_id ='" . $book_id	. "'  order by return_date,name";
		$q= $this->db->query($sql);
		return $q->result_array();
	}
	
	function get_due_detail($member_id)
	{
	$sql        	= "select * from view_lib_due_details where 
	member_id ='" . $member_id	. "'  order by return_date,name";
	return  $this->db->query($sql)->result_array();
	}
	
	function get_student_detail($member_id)
	{
	$student        = "select student_id, name from student where 
	student_id ='" . $member_id	. "' ";
	return $this->db->query($student)->result_array();
	}
	
	function getBook_details_ajax_count($author="",$language="",$category="",$search="")
	 {
        if ($search) {
            $this->db->where("(author_name like '%$search%' or book_name like '%$search%' or book_number like '%$search%' or book_language_name like '%$search%' or book_category_name like '%$search%')");
        }
		if($author!=0)
		{
			$this->db->where('author_id',$author);
		}
		if($language!=0)
		{
			$this->db->where('book_language_id',$language);
		}
		if($category!=0)
		{
			$this->db->where('book_category_id',$category);
		}
        return  $this->db->count_all_results('view_lib_book_details');
 }
    function getBook_details_ajax($author="",$language="",$category="",$limit="",$offset=0,$search) {
        $ids = array();
         $admin["client"]['author'] = $author;
         $admin["client"]['language'] = $language;
         $this->session->set_userdata($admin);
        if ($search) {
            $this->db->where("(author_name like '%$search%' or book_name like '%$search%' or book_number like '%$search%' or book_language_name like '%$search%' or book_category_name like '%$search%')");
        }
			if($author!=0)
			{
				$this->db->where('author_id',$author);
			}
			if($language!=0)
			{
				$this->db->where('book_language_id',$language);
			}
			if($category!=0)
			{
				$this->db->where('book_category_id',$category);
			}
		if($limit)
		$this->db->limit($limit,$offset);
        $res = $this->db->get('view_lib_book_details')->result();
       return $res;
    }
    function getBook_details($author="",$language="",$category="") {
			if($author!=0)
			{
				$this->db->where('author_id',$author);
			}
			if($language!=0)
			{
				$this->db->where('book_language_id',$language);
			}
			if($category!=0)
			{
				$this->db->where('book_category_id',$category);
			}
        $res = $this->db->get('view_lib_book_details')->result_array();
       return $res;
    }
}
?>
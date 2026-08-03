
<?php 
   class Library_Model extends CI_Model 
   {
	
      function __construct()
	  { 
   			parent::__construct(); 
  	  } 
	  
	  function book_category_insert($data='') 
	  {		
		$this->db->insert('tbl_lib_book_category',$data);
      }
	 
	  function updates_category($data,$param2) 
	  {
     	$this->db->where('book_category_id', $data);
     	$this->db->update('tbl_lib_book_category',array('book_category_name'=>$param2));echo $this->db->last_query();die();
      }
	  
	  function delete_category($param2)
	  {
      	$this->db->where('book_category_id', $param2);
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
      
	  $data['publisher_name']=$this->input->post('name');
	  $data['publisher_address']=$this->input->post('address');
 	  $data['publisher_phone1']=$this->input->post('phone1');
 	  $data['publisher_phone2']=$this->input->post('phone2');
 	  $data['publisher_email1']=$this->input->post('email1');
 	  $data['publisher_email2']=$this->input->post('email2');
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
      
	  $data['distributor_name']=$this->input->post('name');
	  $data['distributor_address']=$this->input->post('address');
 	  $data['distributor_phone1']=$this->input->post('phone1');
 	  $data['distributor_phone2']=$this->input->post('phone2');
 	  $data['distributor_email1']=$this->input->post('email1');
 	  $data['distributor_email2']=$this->input->post('email2');
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
	   
	function updates_language($data,$param2) 
    {
     $this->db->where('book_language_id', $data);
     $this->db->update('tbl_lib_book_language', array('book_language_name'=>$param2));
    }
	
	function delete_language($param2) 
	{
      $this->db->where('book_language_id', $param2);
      $this->db->delete('tbl_lib_book_language');
	
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
	

	     
	function get_author_list() 
	{
	
	$this->db->select("author_id,author_name,author_address,author_phone1,author_phone2,author_email");
    	$this->db->from('tbl_lib_authors');
    	$q = $this->db->get();
    	return $res = $q->result_array();
       
						
    }
	   function get_language_list()
	 {
    	$this->db->select("book_language_id,book_language_name");
    	$this->db->from('tbl_lib_book_language');
    	$q = $this->db->get();
    	return $q->result();
    }
	   function get_category_list()
	 {
    	$this->db->select("book_category_id,book_category_name");
    	$this->db->from('tbl_lib_book_category');
    	$q = $this->db->get();
    	return $q->result();
    }
	function get_stream_list()
	 {
    	$this->db->select("book_stream_id,book_stream_name");
    	$this->db->from('tbl_lib_book_stream');
    	$q = $this->db->get();
    	return $q->result();
    }
	
	function get_shelf_list()
	 {
    	$this->db->select("shelf_id,shelf_number");
    	$this->db->from('tbl_lib_shelf');
    	$q = $this->db->get();
    	return $q->result();
    }
	
	function updates_author($data) 
	{
	
     $this->db->where('author_id', $data);
     $this->db->update('tbl_lib_authors', array('author_name'   =>strtoupper($this->input->post('author_name')),
											    'author_address'=>strtoupper($this->input->post('author_address')),
											    'author_phone1' =>strtoupper($this->input->post('author_phone1')),
											    'author_phone2' =>strtoupper($this->input->post('author_phone2')),
											    'author_email'  =>$this->input->post('author_email')));
    }
	
	function delete_author($param2) 
	{
      $this->db->where('author_id', $param2);
      $this->db->delete('tbl_lib_authors');
	
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
	
    $this->db->where('distributor_id', $data);
     $this->db->update('tbl_lib_distributors', array('distributor_name'=>strtoupper($this->input->post('distributor_name')),
											   'distributor_address'=>strtoupper($this->input->post('distributor_address')),
											   'distributor_phone1'=>strtoupper($this->input->post('distributor_phone1')),
											   'distributor_phone2'=>strtoupper($this->input->post('distributor_phone2')),
											   'distributor_email1'=>$this->input->post('distributor_email1'),
												'distributor_email2'=>$this->input->post('distributor_email2')));
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
	
     
    $this->db->where('publisher_id', $data);
    $this->db->update('tbl_lib_publishers', array('publisher_name'   =>strtoupper($this->input->post('publisher_name')),
											      'publisher_address'=>strtoupper($this->input->post('publisher_address')),
											   	  'publisher_phone1' =>strtoupper($this->input->post('publisher_phone1')),
											      'publisher_phone2' =>strtoupper($this->input->post('publisher_phone2')),
											      'publisher_email1' =>strtoupper($this->input->post('publisher_email1')),
												  'publisher_email2' =>strtoupper($this->input->post('publisher_email2'))));
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
 	
	function issue_insert($issue_details,$book_details_id) 
	  {
		 $this->db->insert('tbl_lib_issue_master',$issue_details);
		 
		 $this->db->where('book_details_id',$book_details_id);
         $this->db->update('tbl_lib_book_details', array('is_available'=>'N'));
         
     }
	 function insert_data($return_details,$book_details_id,$update)
	 {
	 	$this->db->where('book_details_id',$book_details_id);
        $this->db->update('view_lib_book_details',$return_details);
		
	 	$this->db->where('book_details_id',$book_details_id);
		$this->db->update('tbl_lib_issue_master',$update);
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
}
?>
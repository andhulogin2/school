<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class ExcelDataInsert extends CI_Controller
{
 
public function __construct()
{
        parent::__construct();
        $this->load->library('excel');//load PHPExcel library 
		  $this->load->database();
		//$this->load->model('upload');//To Upload file in a directory
        $this->load->model('excel_data_insert_model');

}	

public	function ExcelDataAdd()
{  
	//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	
	
	$configUpload['upload_path'] = FCPATH.'uploads/excel/';
	$configUpload['allowed_types'] = 'xls|xlsx|csv';
	$configUpload['max_size'] = '50000';
	$this->load->library('upload', $configUpload);
	$this->upload->do_upload('userfile');	
	$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
	$file_name = $upload_data['file_name']; //uploded file name
	$extension=$upload_data['file_ext'];    // uploded file extension
	
	move_uploaded_file($_FILES['userfile']['tmp_name'],'uploads/excel/sample.xlsx');
	
	
	//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
	$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
	//Set to read only
	$objReader->setReadDataOnly(true); 		  
	//Load excel file
	$objPHPExcel=$objReader->load(FCPATH.'uploads/excel/sample.xlsx');		 
	$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
	$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
	//loop from first data untill last data
	for($i=2;$i<=$totalrows;$i++)
	{
		$company_name= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
		$country_id= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
		$sub_country_id= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
		$distict_id=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
		$address=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
		$description=$objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
		$contact1=$objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
		$contact2=$objWorksheet->getCellByColumnAndRow(7,$i)->getValue();
		$company_head=$objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
		$designation=$objWorksheet->getCellByColumnAndRow(9,$i)->getValue();
		$email=$objWorksheet->getCellByColumnAndRow(10,$i)->getValue();
		$software_used=$objWorksheet->getCellByColumnAndRow(11,$i)->getValue();
		$business_activity=$objWorksheet->getCellByColumnAndRow(12,$i)->getValue();
		$group_name=$objWorksheet->getCellByColumnAndRow(13,$i)->getValue();
		$other_branch_name=$objWorksheet->getCellByColumnAndRow(14,$i)->getValue();
		$sub_activity=$objWorksheet->getCellByColumnAndRow(15,$i)->getValue();
		$date=$objWorksheet->getCellByColumnAndRow(16,$i)->getValue();
		//echo $date;
		//$date1=date_create($date);
				$priority=$objWorksheet->getCellByColumnAndRow(17,$i)->getValue();
		
		
		$data_user=array('company_name'=>$company_name, 'country_id'=>$country_id ,'sub_country_id'=>$sub_country_id ,'distict_id'=>$distict_id , 'address'=>$address,'description'=>$description,'contact1'=>$contact1,'contact2'=>$contact2,'company_head'=>$company_head,'designation'=>$designation,'email'=>$email,'software_used'=>$software_used,'business_activity'=>$business_activity,'group_name'=>$group_name,'other_branch_name'=>$other_branch_name,'sub_activity'=>$sub_activity,'date'=>$date,'priority'=>$priority);
		$this->excel_data_insert_model->Add_User($data_user);
	}
	unlink(FCPATH. 'uploads/excel/sample.xlsx'); //File Deleted After uploading in database .		
	redirect('Clients/get_list1');	 
	
	
}

//////////////////////////////////////////////////////////////////////////////////////

public function exportExcelData($records)
{
  $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
 }

public function fetchDataFromTable()
{
     $query =$this->db->get('user'); // fetch Data from table
     $allData = $query->result_array();  // this will return all data into array
     $dataToExports = [];
     foreach ($allData as $data)
	 {
        $arrangeData['FirstName'] 	= $data['FirstName'];
        $arrangeData['LastName'] 	= $data['LastName'];
        $arrangeData['Email']		= $data['Email'];
		$arrangeData['Mobile']		= $data['Mobile'];
		$arrangeData['Address']		= $data['Address'];
        $dataToExports[]			= $arrangeData;
  }
  // set header
  $filename = "dataToExport.xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=".$filename);
  $this->exportExcelData($dataToExports);
 }
 
}

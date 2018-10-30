<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Querydata {

    var $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    function data($requestData,$sql,$columnOrderBy,$defaultOrder=null)
	{
		$kolom = array();
        $kolom = $columnOrderBy;
		$totalData = $this->ci->db->query($sql)->num_rows();
		$totalFiltered = $totalData; 
                $requestData['start'] = (isset($requestData['start']) ? $requestData['start']:0);
                $requestData['length'] = (isset($requestData['length']) ? $requestData['length']:20);
    	if( !empty($requestData['search']['value']) ) {  
			//echo 'afs';
			$pertama = true;
			$f =0;
			foreach($kolom As $ff=>$nil)
            {
			  if($pertama)
			  {
			     $sql.=" AND ( ".$nil." LIKE '%".$requestData['search']['value']."%' ";   
			     $pertama = false;
			  }
			  else
			  {
				 $sql.=" OR ".$nil." LIKE '%".$requestData['search']['value']."%' ";
				    
			  }
			   $f++;
			  
              
			}
			$sql.=" )";
			
		}
		$columns = $columnOrderBy;
		
		
		$totalFiltered = $this->ci->db->query($sql)->num_rows(); 
		
		if(isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] > 0)
		{
		  $R = $requestData['order'][0]['column'];
		  $sql.=" ORDER BY ". $columns[$R]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		
		}
		else
		{
		   
		   if($defaultOrder!=null)
		   {
			     $sql.=" ORDER BY ". $defaultOrder."     LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		
		   }
		   else	   
		   {
		        $R = $requestData['order'][0]['column'];
		        //$R = 'created_date';
		        $sql.=" ORDER BY created_date ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		        //$sql.=" ORDER BY ". $R." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		        // $sql.=" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			   
		   }
		}

	    $query = $this->ci->db->query($sql)->result_array();
		//return array($query,$totalData,$totalFiltered,$kolom);
		return array($query,$totalData,$totalFiltered);
		
	}
}
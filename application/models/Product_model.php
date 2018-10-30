<?php 

class Product_model extends CI_Model {
	
	public function __construct(){
			$this->load->database();
	}
		
	public function add_product($data){
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = 1;
		$data['status'] = 1;
		
		$has_product = $this->get_by_id($data['product_id']);
		
		if ($has_product){
			$this->db->set('product_price', $data['product_price']);
			$this->db->set('updated_date',  date('Y-m-d H:i:s'));
			$this->db->set('updated_by',  1);
			$this->db->where('product_id', $data['product_id']);
			$this->db->update('product'); 
		}else{
			$this->db->insert('product', $data);			
		}
		
		$this->db->insert('product_history', $data);
		
		return true;
	}
	
	public function get_by_id($id){
		$query = $this->db->get_where('product', array('product_id' => $id))->result_array();
		return $query;
	}
	
	public function get_history_by_id($id){
		$this->db->select('product_price,created_date');
		$this->db->where('product_id',$id);
		$this->db->limit(10);
		$this->db->order_by('created_date', 'DESC');
		$query = $this->db->get('product_history')->result_array();
		return $query;
	}
	
	public function get_list($params){
		$this->db->select('product_url,product_price,product_id,product_title,created_date,updated_date');
		$this->db->where('status',1);
		$sql = $this->db->get_compiled_select('product');
		$totalData= $this->db->query($sql)->num_rows();
		
		$this->db->select('product_url,product_price,product_id,product_title,created_date,updated_date');
		$this->db->where('status',1);
		
		if( !empty($params['search']['value']) ) {
			$this->db->or_like('product_title',$params['search']['value']);
			$this->db->or_like('product_url',$params['search']['value']);
		}
		
		$sql = $this->db->get_compiled_select('product');		
		$totalFiltered= $this->db->query($sql)->num_rows();
		
		$query = $this->db->query($sql)->result_array();
		echo $this->db->last_query();
		$data=array('total_data'=>$totalData,'total_filtered'=>$totalFiltered,'query'=>$query);
		return $data;
	}
}
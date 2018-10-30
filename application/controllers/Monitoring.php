<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	public function index(){
		$data['title'] = 'Add new currency';
		$data['breadcrumb'] = array('Monitoring' => base_url()."monitoring");

		$this->template->display('monitoring/index', $data);
	}
	
	public function create(){
		$this->load->helper('form');
		$this->load->helper('scrapper');
		$this->load->library('form_validation');

		$data['title'] = 'Add new currency';

		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$text = array('message'=>'Failed, please input valid product url from fabelio.com','url'=>$this->input->post('url'));
			$this->session->set_flashdata('error', $text);
			redirect('monitoring/index');
		}
		else
		{
			$this->load->model('Product_model', 'product');
			$data = fabelio($this->input->post('url'));
			$data['product_id'] = md5($this->input->post('url'));
			$data['product_url'] = $this->input->post('url');
			if ($data['product_title']<>''&&$data['product_price']<>''){
				$result = $this->product->add_product($data);
				redirect('monitoring/history/'.$data['product_id']);
			}else{
				$text = array('message'=>'Failed, please input valid product url from fabelio.com','url'=>$this->input->post('url'));
				$this->session->set_flashdata('error', $text);
				redirect('monitoring/index');
			}
		}
	}
	
	public function history($id){
		$this->load->model('Product_model', 'product');
		$this->load->model('Comment_model', 'comment');
		$product = $this->product->get_by_id($id);
		$data['product'] = $product['0'];
		$data['historyProduct'] = $this->product->get_history_by_id($id);
		
		$data['comment'] = $this->comment->get_by_productid($id);
		
		$data['title'] = 'Price History '.$data['product']['product_title'];
		
		$this->template->display('monitoring/history', $data);
	}
	
	public function list(){
		$data['title'] = 'Product List';
		
		$this->template->display('monitoring/list', $data);
	}
	
	public function add_comment($id){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('comment_content', 'Comment', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$text = array('message'=>'Failed, please write your comment','url'=>$this->input->post('url'));
			$this->session->set_flashdata('error', $text);
			redirect('monitoring/history/'.$id);
		}
		else
		{
			$this->load->model('Comment_model', 'comment');
			$data = array('comment_content'=>$this->input->post('comment_content'),'product_id'=>$id);
			$result = $this->comment->add_comment($data)	;
			redirect('monitoring/history/'.$id);
			
		}
	}
	
	public function add_likes($comment_id,$product_id,$type){
		
		$this->load->model('comment_model', 'comment');
		$data = array('comment_id'=>$comment_id);
		$result = $this->comment->add_like($data,$type);
		redirect('monitoring/history/'.$product_id);
	}
	
	public function getData(){
		$this->load->model('Product_model', 'product');
		$this->load->library('Querydata');
		
		//$product = $this->product->get_list($_POST);
		
		$columnOrderBy = array(
			1 => 'product_title',
			2 => 'product_url',
			3 => 'product_price',
			4 => 'created_date',
			5 => 'updated_date',
		);
			
		$data = array();
		if($_POST['start'] == 0) {
			$no = 1;
		} else {
			$no = $_POST['start'] + 1;
		}
		$sql = 'select product_url,product_price,product_id,product_title,created_date,updated_date from product where status=1';
		$product = $this->querydata->data($_POST, $sql, $columnOrderBy);
		
		foreach($product['0'] As $row)
		{
			$nestedData=array(); 
			$nestedData[] = $no;
			
			$nestedData[] = $row['product_title'];
			$nestedData[] = $row['product_url'];
			$nestedData[] = 'Rp. '.number_format($row['product_price']);
			$nestedData[] = $row['created_date'];
			$nestedData[] = $row['updated_date'];
			
			//$delete='<a class="btn btn-sm btn-info" title="Update" href='.base_url('city/update').'/'.$row->city_id.'> <i class="glyphicon glyphicon-pencil"></i> Edit </a>';
			//$update=' <a class="btn btn-sm btn-danger" title="Hapus" onclick="DeleteCity('.$row->city_id.')" > <i class="glyphicon glyphicon-trash"></i> Delete </a>';
			//$aksi = $delete.' '.$update;
			$nestedData[] = ' <a href="'.base_url().'monitoring/history/'.$row['product_id'].'" class="btn btn-sm btn-info" title="Detail"> <i class="fa fa-link"></i> Detail </a>';
			$data[] = $nestedData;
			$no++;
		}
			
		$json_data = array(
			"draw"            => intval( $_POST['draw'] ),   
			"recordsTotal"    => intval( $product['1'] ),  
			"recordsFiltered" => intval( $product['2'] ), 
			"data"            => $data 	 
		);
		echo json_encode($json_data);
	}
	
}

<?php 

class Comment_model extends CI_Model {
	
	public function __construct(){
			$this->load->database();
	}
		
	public function add_comment($data){
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['status'] = 1;
		
		$this->db->insert('comment', $data);			
		return true;
	}
	
	public function get_by_id($id){
		$query = $this->db->get_where('comment', array('comment_id' => $id))->result_array();
		return $query;
	}
	
	public function get_by_productid($id){
		//$query = $this->db->get_where('comment', array('product_id' => $id))->result_array();
		$sql = "SELECT comment_content,comment.comment_id,count(like_id) as likes,count(dislike_id) as dislikes from comment
				left join likes on likes.comment_id=comment.comment_id
				left join dislikes on dislikes.comment_id=comment.comment_id
				where comment.product_id='$id'
				GROUP by comment_id";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}

	public function add_like($data,$type){
		$data['created_date'] = date('Y-m-d H:i:s');
		if ($type==1){
			$this->db->insert('likes', $data);
		}else{
			$this->db->insert('dislikes', $data);
		}		
		return true;
	}
}
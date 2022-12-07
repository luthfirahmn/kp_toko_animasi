<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductDetail extends CI_Controller
{

	public function index($id)
	{
		$query = $this->db->query("SELECT t0.*,t1.kategori 
									FROM ms_product t0 
									LEFT JOIN ms_kategori t1 ON t0.id_kategori = t1.id
									WHERE t0.id = {$id} 
								");
		$product = $query->row();

		$query = $this->db->query("SELECT * FROM ms_product ORDER BY RBT DESC LIMIT 3 ");
		$popular = $query->result();

		$query = $this->db->query("SELECT * FROM ms_kategori LIMIT 3 ");
		$kategori = $query->result();

		$data['product']            =    $product;
		$data['kategori']           =    $kategori;
		$data['popular']            =    $popular;
		$data['content']            =    'frontend/product_detail';
		$this->load->view('frontend/app', $data);
	}
}
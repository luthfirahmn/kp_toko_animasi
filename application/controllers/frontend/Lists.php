<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends CI_Controller
{

	public function index($kategori = 0)
	{
		if($kategori > 0){
			$query = $this->db->query("SELECT * FROM ms_product  WHERE id_kategori =  {$kategori} ORDER BY RBT DESC");
			$product = $query->result();

			$query = $this->db->query("SELECT * FROM ms_kategori  WHERE id =  {$kategori}");
			$kat = $query->row();
		}else{
			$query = $this->db->query("SELECT * FROM ms_product ORDER BY RBT DESC");
			$product = $query->result();

			$kat = '';
		}
		

		$data['kategori']			=	$kat;
		$data['product']			=	$product;
		$data['content']            =    'frontend/list';
		$this->load->view('frontend/app', $data);
	}
}

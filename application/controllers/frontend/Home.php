<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$query = $this->db->query("SELECT * FROM ms_kategori LIMIT 3");
		$kategori = $query->result();

		$query = $this->db->query("SELECT * FROM ms_slider LIMIT 3");
		$slider = $query->result();

		$query = $this->db->query("SELECT * FROM ms_product ORDER BY RBT DESC LIMIT 0,3 ");
		$product_left = $query->result();

		$query = $this->db->query("SELECT * FROM ms_product ORDER BY RBT DESC LIMIT 3,3 ");
		$product_right = $query->result();

		$data['kategori']			=	$kategori;
		$data['slider']				=	$slider;
		$data['product_right']			=	$product_right;
		$data['product_left']			=	$product_left;
		$data['content']			=	'frontend/home';
		$this->load->view('frontend/app', $data);
	}
}
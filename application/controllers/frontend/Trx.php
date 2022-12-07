<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trx extends CI_Controller
{

	public function trx_process($id)
	{
		
		$session = $this->session->userdata();
		$id_cust = isset($session['id_customer']) ? $session['id_customer'] : 0;
		$query = $this->db->query("SELECT * FROM ms_customer WHERE id = {$id_cust} ");
		$cust = $query->row();

		$query = $this->db->query("SELECT * FROM ms_contact");
		$_phone = $query->row();

		$query = $this->db->query("SELECT * FROM ms_product WHERE id = {$id} ");
		$product = $query->row();

		$phone = '62'.$_phone->telepon;
		$url = 'https://api.whatsapp.com/send';

		$_msg = 'Hello saya ingin memesan barang ' .$product->nama.' atas nama : '.$cust->nama_lengkap .' dengan id customer : '.$cust->id;

		$msg = str_replace(' ', '%20', $_msg);

		$data = array('id_product' => $product->id,
					  'id_customer' => $cust->id,
					   'status'		=> 'PENDING',
					   'tgl_transaksi' => date('Y-m-d H:i:s')
					);
		$insert = $this->db->insert('tr_log',$data);
		
		if($insert){
			redirect($url . '?phone=' .$phone .'&text='.$msg);
		}else{
			echo "<script type='text/javascript'>alert('terjadi kesalahan sistem');</script>";
		}
	}
}

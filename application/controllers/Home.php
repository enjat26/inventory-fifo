<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index(){
		$data['rows'] = $this->db->select('a.*,b.*,c.*')
									->from('barang_masuk a')
									->join('barang_masuk_rinci b','a.id_barang_masuk=b.id_barang_masuk','right')
									->join('barang c','b.id_barang=c.id_barang')
									->order_by('c.id_barang,a.tgl_barang_masuk')
									->get()->result();
		view('home',$data);
	}

	public function tes(){
		// Data random
		$data = [
			'menu' => ['Coto', 'Konro', 'Pallubasa', 'Pisang Ijo']
		];

		// Memanggil file test.blade.php
		// Tidak perlu menuliskan .blade.php
		view('test', $data);
	}
}

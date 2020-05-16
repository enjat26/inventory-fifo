<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_barang_masuk extends CI_Controller {
	public function index(){
		view('lap_barang_masuk.index');
	}

	public function cetak(){
        $post = $this->input->get();
		$tgl_awal = date('Y-m-d', strtotime($post['tgl_awal']));
        $tgl_akhir = date('Y-m-d', strtotime($post['tgl_akhir']));
        
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' =>10]);
		
        $data['rows'] =$this->db->select('a.*,b.*,c.*')
                            ->from('barang a')
							->join('barang_masuk_rinci b','a.id_barang=b.id_barang')
							->join('barang_masuk c','c.id_barang_masuk=b.id_barang_masuk')
							->where('tgl_barang_masuk >=',$tgl_awal)
							->where('tgl_barang_masuk <=',$tgl_akhir)
							->get()->result();
        
		$html = $this->load->view('lap_barang_masuk/cetak', $data, TRUE);
		// $html = view('spp.table',$data);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
    }
}

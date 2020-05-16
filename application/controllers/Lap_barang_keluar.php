<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_barang_keluar extends CI_Controller {
	public function index(){
		view('lap_barang_keluar.index');
	}

	public function cetak(){
        $post = $this->input->get();
		$tgl_awal = date('Y-m-d', strtotime($post['tgl_awal']));
        $tgl_akhir = date('Y-m-d', strtotime($post['tgl_akhir']));
        
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' =>10]);
		
        $data['rows'] =$this->db->select('a.*,b.*,c.*,d.*')
                            ->from('barang a')
							->join('barang_keluar_rinci b','a.id_barang=b.id_barang')
							->join('barang_keluar c','c.id_barang_keluar=b.id_barang_keluar')
							->join('customer d','d.id_customer=c.id_customer')
							->where('tgl_barang_keluar >=',$tgl_awal)
							->where('tgl_barang_keluar <=',$tgl_akhir)
							->get()->result();
        
		$html = $this->load->view('lap_barang_keluar/cetak', $data, TRUE);
		// $html = view('spp.table',$data);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
    }
}

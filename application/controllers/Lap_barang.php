<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_barang extends CI_Controller {
	public function index(){
        
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' =>10]);
		
        $data['rows'] = $this->db->select('*')->from('barang')->get()->result();
        
		$html = $this->load->view('lap_barang/cetak', $data, TRUE);
		// $html = view('spp.table',$data);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function cetak(){
        
    }
}

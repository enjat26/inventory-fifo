<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {
	protected $_table = 'barang_masuk';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
        $data['rows'] =  $this->db->select("a.*,b.*,c.*,SUM(b.jml_masuk) AS qty")
                            ->from('barang_masuk a')
                            ->join('barang_masuk_rinci b','a.id_barang_masuk=b.id_barang_masuk')
							->join('supplier c','a.id_supplier=c.id_supplier')
							->group_by('a.id_barang_masuk')
                            ->get()->result();
		view('barang_masuk.table',$data);
	}
	public function create(){
		$post = $this->input->post();
		
        $data['tmp_barang'] = $this->db->select('a.*,b.*')
                            ->from('barang a')
                            ->join('tmp_barang b','a.id_barang=b.id_barang')
							->get()->result();
							
        $data['barang'] = $this->m_crud->getAll('barang');
        
		view('barang_masuk.create',$data);
	}
	public function edit(){
		$id = $_GET['id'];

		$data['tmp_barang'] = $this->db->select('a.*,b.*,b.id_barang_masuk_rinci as id_tmp, b.jml_masuk as jml_tmp,
												 b.harga_masuk as harga_tmp')
                            ->from('barang a')
							->join('barang_masuk_rinci b','a.id_barang=b.id_barang')
							->where('id_barang_masuk',$id)
							->get()->result();
							
		$data['barang'] = $this->m_crud->getAll('barang');

		$data['r'] = $this->m_crud->first('barang_masuk',['id_barang_masuk' => $id]);
		
		view('barang_masuk.edit',$data);
	}
	public function simpan(){
		$post = $this->input->post();

		if($post['mode'] == 'create'){
			
			$data = [
				'tgl_barang_masuk' => date('Y-m-d', strtotime($post['tgl_barang_masuk'])),
				'id_supplier' => $post['id_supplier'],
				'kwt_barang_masuk' => $this->kode_otomatis('KWM')
			];
			$simpan = $this->m_crud->save_id('barang_masuk',$data);
			if($simpan){
				$data_tmp = $this->m_crud->getAll('tmp_barang');
				foreach($data_tmp as $r){
					$this->db->insert(
						'barang_masuk_rinci',
						[
							'id_barang_masuk' => $simpan,
							'id_barang' => $r->id_barang,
							'harga_masuk' => $r->harga_tmp,
							'jml_masuk' => $r->jml_tmp,
							'stok_masuk' => $r->jml_tmp
						]
					);
				}
				$this->db->empty_table('tmp_barang');
				echo 'sukses';
			}else {
				echo 'gagal';
			}
		}else{
			$data = [
				'tgl_barang_masuk' => date('Y-m-d', strtotime($post['tgl_barang_masuk'])),
				'id_supplier' => $post['id_supplier'],
			];
			$update = $this->m_crud->update('barang_masuk',$data,['id_barang_masuk' => $post['id_barang_masuk']]);
			if($update){
				echo 'sukses';
			}else {
				echo 'gagal';
			}
		}
	}
	public function simpan_tmp(){
		$post = $this->input->post();
		if($post['mode'] == 'create'){
			$data = [
				'id_barang' => $post['id_barang'],
				'jml_tmp' => $post['jml'],
				'harga_tmp' => $post['harga']
			];
			$simpan = $this->m_crud->save('tmp_barang',$data);
		}else{
			$data = [
				'id_barang' => $post['id_barang'],
				'jml_masuk' => $post['jml'],
				'stok_masuk' => $post['jml'],
				'harga_masuk' => $post['harga'],

				'id_barang_masuk' => $post['id_barang_masuk']
			];
			$simpan = $this->m_crud->save('barang_masuk_rinci',$data);
		}
		if($simpan){
			echo 'sukses';
		}else {
			echo 'gagal';
		}
	}
	
	public function delete(){
		$id_barang_masuk = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_barang_masuk' => $id_barang_masuk]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('barang_masuk');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('barang_masuk');
		}
	}
	public function delete_tmp(){
		$id = $_GET['id'];
		$id_barang_masuk = $_GET['id_barang_masuk'];

		$url_lokasi = ($_GET['mode'] == 'edit') ? 'barang_masuk/edit?id='.$id_barang_masuk : 'barang_masuk/create';

		if($_GET['mode'] == 'edit'){
			$delete = $this->m_crud->delete('barang_masuk_rinci',['id_barang_masuk_rinci' => $id]);
		}else{
			$delete = $this->m_crud->delete('tmp_barang',['id_tmp' => $id]);
		}
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect($url_lokasi);
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect($url_lokasi);
		}
	}
	function kode_otomatis($prefix){
		$this->load->database();
		$hasil = $this->db->query("SELECT max(kwt_barang_masuk) as maxKode FROM barang_masuk")->row();
		$kode = $hasil->maxKode;
		$noUrut = (int) substr($kode, 3, 3);
		$noUrut++;
		$kode = $prefix . sprintf("%03s", $noUrut);
		// die($kode);
		return $kode;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	protected $_table = 'barang';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
		
		$data['rows'] =  $this->m_crud->getAll($this->_table);
		view('barang.table',$data);
	}
	public function create(){
		$post = $this->input->post();
		$data['rak'] =  $this->m_crud->getAll('rak');
		$data['satuan'] =  $this->m_crud->getAll('satuan');

		$this->form_validation->set_rules('nama_barang','Nama Barang','required');
		$this->form_validation->set_rules('no_rak','No Rak','required');
		$this->form_validation->set_rules('satuan','Satuan','required');
		$this->form_validation->set_rules('harga','Harga','required|numeric');
		$this->form_validation->set_rules('width','Width','required|numeric');
		$this->form_validation->set_rules('length','length','required|numeric');
		$this->form_validation->set_rules('weigth','weigth','required|numeric');

		if($this->form_validation->run()){
			$data = [
				'kode_barang' => $this->kode_otomatis('BR.'),
				'nama_barang' => $post['nama_barang'],
				'harga' => $post['harga'],
				'no_rak' => $post['no_rak'],
				'harga' => $post['harga'],
				'satuan' => $post['satuan'],
				'width' => $post['width'],
				'length' => $post['length'],
				'weigth' => $post['weigth'],
			];
			$simpan = $this->m_crud->save($this->_table,$data);
			if($simpan){
				$this->session->set_flashdata('success', 'simpan');
				redirect('barang');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('barang');
			}
		}
		view('barang.create',$data);
	}
	public function edit(){
		$id_barang = $_GET['id'];
		$post = $this->input->post();

		$data['rak'] =  $this->m_crud->getAll('rak');
		$data['satuan'] =  $this->m_crud->getAll('satuan');
		$data['field'] =$this->m_crud->first($this->_table,['id_barang' => $id_barang]);

		$this->form_validation->set_rules('nama_barang','Nama Barang','required');
		$this->form_validation->set_rules('no_rak','No Rak','required');
		$this->form_validation->set_rules('satuan','Satuan','required');
		$this->form_validation->set_rules('harga','Harga','required|numeric');
		$this->form_validation->set_rules('width','Width','required|numeric');
		$this->form_validation->set_rules('length','length','required|numeric');
		$this->form_validation->set_rules('weigth','weigth','required|numeric');

		if($this->form_validation->run()){
			$data = [
				'nama_barang' => $post['nama_barang'],
				'harga' => $post['harga'],
				'no_rak' => $post['no_rak'],
				'harga' => $post['harga'],
				'satuan' => $post['satuan'],
				'width' => $post['width'],
				'length' => $post['length'],
				'weigth' => $post['weigth'],
			];
			$update = $this->m_crud->update($this->_table,$data,['id_barang' => $id_barang]);
			if($update){
				$this->session->set_flashdata('success', 'ubah');
				redirect('barang');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('barang');
			}
		}
		view('barang.edit',$data);
	}
	public function delete(){
		$id_barang = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_barang' => $id_barang]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('barang');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('barang');
		}
	}
	function kode_otomatis($prefix){
		$this->load->database();
		$hasil = $this->db->query("SELECT max(kode_barang) as maxKode FROM barang")->row();
		$kode = $hasil->maxKode;
		$noUrut = (int) substr($kode, 3, 3);
		$noUrut++;
		$kode = $prefix . sprintf("%03s", $noUrut);
		// die($kode);
		return $kode;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	protected $_table = 'supplier';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
		$this->data['rows'] =  $this->m_crud->getAll($this->_table);
		view('supplier.table',$this->data);
	}
	public function create(){
		$post = $this->input->post();

		$this->form_validation->set_rules('nama_supplier','Nama Supplier','required');
		$this->form_validation->set_rules('tlp','No Hp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()){
			$data = [
				'nama_supplier' => $post['nama_supplier'],
				'tlp' => $post['tlp'],
				'alamat' => $post['alamat'],
			];
			$simpan = $this->m_crud->save($this->_table,$data);
			if($simpan){
				$this->session->set_flashdata('success', 'simpan');
				redirect('supplier');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('supplier');
			}
		}
		view('supplier.create');
	}
	public function edit(){
		$id_supplier = $_GET['id'];
		$post = $this->input->post();
		$this->data['field'] =$this->m_crud->first($this->_table,['id_supplier' => $id_supplier]);

		$this->form_validation->set_rules('nama_supplier','Nama Supplier','required');
		$this->form_validation->set_rules('tlp','No Hp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');

		if($this->form_validation->run()){
			$data = [
				'nama_supplier' => $post['nama_supplier'],
				'tlp' => $post['tlp'],
				'alamat' => $post['alamat'],
			];
			$update = $this->m_crud->update($this->_table,$data,['id_supplier' => $id_supplier]);
			if($update){
				$this->session->set_flashdata('success', 'ubah');
				redirect('supplier');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('supplier');
			}
		}
		view('supplier.edit',$this->data);
	}
	public function delete(){
		$id_supplier = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_supplier' => $id_supplier]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('supplier');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('supplier');
		}
	}
}

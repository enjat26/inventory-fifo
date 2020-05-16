<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	protected $_table = 'customer';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
		$this->data['rows'] =  $this->m_crud->getAll($this->_table);
		view('customer.table',$this->data);
	}
	public function create(){
		$post = $this->input->post();

		$this->form_validation->set_rules('nama_customer','Nama Customer','required');
		$this->form_validation->set_rules('tlp','No Hp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()){
			$data = [
				'nama_customer' => $post['nama_customer'],
				'tlp' => $post['tlp'],
				'alamat' => $post['alamat'],
			];
			$simpan = $this->m_crud->save($this->_table,$data);
			if($simpan){
				$this->session->set_flashdata('success', 'simpan');
				redirect('customer');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('customer');
			}
		}
		view('customer.create');
	}
	public function edit(){
		$id_customer = $_GET['id'];
		$post = $this->input->post();
		$this->data['field'] =$this->m_crud->first($this->_table,['id_customer' => $id_customer]);

		$this->form_validation->set_rules('nama_customer','Nama Customer','required');
		$this->form_validation->set_rules('tlp','No Hp','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');

		if($this->form_validation->run()){
			$data = [
				'nama_customer' => $post['nama_customer'],
				'tlp' => $post['tlp'],
				'alamat' => $post['alamat'],
			];
			$update = $this->m_crud->update($this->_table,$data,['id_customer' => $id_customer]);
			if($update){
				$this->session->set_flashdata('success', 'ubah');
				redirect('customer');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('customer');
			}
		}
		view('customer.edit',$this->data);
	}
	public function delete(){
		$id_customer = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_customer' => $id_customer]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('customer');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('customer');
		}
	}
}

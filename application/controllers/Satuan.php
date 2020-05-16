<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {
	protected $_table = 'satuan';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
		$this->data['rows'] =  $this->m_crud->getAll($this->_table);
		view('satuan.table',$this->data);
	}
	public function create(){
		$post = $this->input->post();
		$this->form_validation->set_rules('satuan','satuan','required');
		if($this->form_validation->run()){
			$data = [
				'satuan' => $post['satuan'],
			];
			$simpan = $this->m_crud->save($this->_table,$data);
			if($simpan){
				$this->session->set_flashdata('success', 'simpan');
				redirect('satuan');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('satuan');
			}
		}
		view('satuan.create');
	}
	public function edit(){
		$id_satuan = $_GET['id'];
		$post = $this->input->post();
		$this->data['field'] =$this->m_crud->first($this->_table,['id_satuan' => $id_satuan]);
		// die(print_r($this->data));
		$this->form_validation->set_rules('satuan','satuan','required');
		if($this->form_validation->run()){
			$data = [
				'satuan' => $post['satuan'],
			];
			$update = $this->m_crud->update($this->_table,$data,['id_satuan' => $id_satuan]);
			if($update){
				$this->session->set_flashdata('success', 'ubah');
				redirect('satuan');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('satuan');
			}
		}
		view('satuan.edit',$this->data);
	}
	public function delete(){
		$id_satuan = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_satuan' => $id_satuan]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('satuan');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('satuan');
		}
	}
}

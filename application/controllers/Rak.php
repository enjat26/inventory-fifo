<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Controller {
	protected $_table = 'rak';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
		$this->data['rows'] =  $this->m_crud->getAll($this->_table);
		view('rak.table',$this->data);
	}
	public function create(){
		$post = $this->input->post();
		$this->form_validation->set_rules('no_rak','no_rak','required');
		if($this->form_validation->run()){
			$data = [
				'no_rak' => $post['no_rak'],
			];
			$simpan = $this->m_crud->save($this->_table,$data);
			if($simpan){
				$this->session->set_flashdata('success', 'simpan');
				redirect('rak');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('rak');
			}
		}
		view('rak.create');
	}
	public function edit(){
		$id_rak = $_GET['id'];
		$post = $this->input->post();
		$this->data['field'] =$this->m_crud->first($this->_table,['id_rak' => $id_rak]);
		// die(print_r($this->data));
		$this->form_validation->set_rules('no_rak','no_rak','required');
		if($this->form_validation->run()){
			$data = [
				'no_rak' => $post['no_rak'],
			];
			$update = $this->m_crud->update($this->_table,$data,['id_rak' => $id_rak]);
			if($update){
				$this->session->set_flashdata('success', 'ubah');
				redirect('rak');
			}else {
				$this->session->set_flashdata('error', 'error');
				redirect('rak');
			}
		}
		view('rak.edit',$this->data);
	}
	public function delete(){
		$id_rak = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_rak' => $id_rak]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('rak');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('rak');
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {
	protected $_table = 'barang_keluar';

	public function __construct(){
		parent::__construct();
		$this->load->model('M_crud','m_crud');
	}
	public function index(){
        $data['rows'] =  $this->db->select("a.*,b.*,c.*,SUM(b.jml_keluar*b.harga_keluar) AS total")
                            ->from('barang_keluar a')
                            ->join('barang_keluar_rinci b','a.id_barang_keluar=b.id_barang_keluar')
							->join('customer c','a.id_customer=c.id_customer')
							->group_by('a.id_barang_keluar')
                            ->get()->result();
		view('barang_keluar.table',$data);
	}
	public function create(){
		$post = $this->input->post();
		
        $data['tmp_barang'] = $this->db->select('a.*,b.*')
                            ->from('barang a')
                            ->join('tmp_barang b','a.id_barang=b.id_barang')
							->get()->result();
							
		$data['barang'] = $this->m_crud->getAll('barang');
		
		$data['customer'] = $this->m_crud->getAll('customer');
		
		// $cek_semua_stok = $this->db->select('sum(stok_masuk) as stok_masuk')
		// 										->from('barang_masuk_rinci')
		// 										->where('id_barang',1)
		// 										->where('stok_masuk > ',0)
		// 										->get()->row();
		// 										die(print_r($cek_semua_stok));
		view('barang_keluar.create',$data);
	}
	public function edit(){
		$id = $_GET['id'];

		$data['tmp_barang'] = $this->db->select('a.*,b.*,b.id_barang_keluar_rinci as id_tmp, 
												b.jml_keluar as jml_tmp,
												b.harga_keluar as harga_tmp')
                            ->from('barang a')
							->join('barang_keluar_rinci b','a.id_barang=b.id_barang')
							->where('id_barang_keluar',$id)
							->get()->result();
							
		$data['barang'] = $this->m_crud->getAll('barang');

		$data['customer'] = $this->m_crud->getAll('customer');

		$data['r'] = $this->m_crud->first('barang_keluar',['id_barang_keluar' => $id]);
		
		view('barang_keluar.edit',$data);
	}
	public function simpan(){
		$post = $this->input->post();

		if($post['mode'] == 'create'){
			
			$data = [
				'tgl_barang_keluar' => date('Y-m-d', strtotime($post['tgl_barang_keluar'])),
				'id_customer' => $post['id_customer'],
				'kwt_barang_keluar' => $this->kode_otomatis('KWK')
			];
			$simpan = $this->m_crud->save_id('barang_keluar',$data);
			if($simpan){
				$data_tmp = $this->m_crud->getAll('tmp_barang');
				foreach($data_tmp as $r){
					$this->db->insert(
						'barang_keluar_rinci',
						[
							'id_barang_keluar' => $simpan,
							'id_barang' => $r->id_barang,
							'harga_keluar' => $r->harga_tmp,
							'jml_keluar' => $r->jml_tmp
						]
					);
					$id_barang_keluar_rinci = $this->db->insert_id();

					//	ambil data semua stok masuk 
					$data_semua_stok = $this->db->select('stok_masuk,id_barang,id_barang_masuk_rinci')
												->from('barang_masuk_rinci')
												->where('id_barang',$r->id_barang)
												->where('stok_masuk > ',0)
												->order_by('id_barang_masuk_rinci')
												->get()->result();

					// lakukan pengulangan 
					
					$qty = $r->jml_tmp;
					foreach ($data_semua_stok as $val) {
						if($qty > 0){
							$temp = $qty;
							$qty = $qty - $val->stok_masuk;

							if($qty > 0) {      
								$stok_update = 0;
								$qty_asli = $r->jml_tmp - $val->stok_masuk;
							}else{
								$stok_update = $val->stok_masuk - $temp;
								$qty_asli = $r->jml_tmp;
							}
							$this->db
								->where(['id_barang_masuk_rinci' => $val->id_barang_masuk_rinci])
								->update('barang_masuk_rinci',['stok_masuk' => $stok_update]);
							
							$data_kartu_stok = [
											'id_barang_masuk_rinci' => $val->id_barang_masuk_rinci,
											'id_barang' => $val->id_barang,
											'stok_awal' => $val->stok_masuk,
											'jm_stok_masuk' => $stok_update,
											'id_barang_keluar_rinci' => $id_barang_keluar_rinci,
											'id_barang_keluar' => $simpan,
										];
										$this->db->insert('kartu_stok', $data_kartu_stok);
						}
					}
				}
				$this->db->empty_table('tmp_barang');
				echo 'sukses';
			}else {
				echo 'gagal';
			}
		
		//AKSI JIKA MODE EDIT
		}else{
			$data = [
				'tgl_barang_keluar' => date('Y-m-d', strtotime($post['tgl_barang_keluar'])),
				'id_customer' => $post['id_customer'],
			];
			$update = $this->m_crud->update('barang_keluar',$data,['id_barang_keluar' => $post['id_barang_keluar']]);
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
				'jml_keluar' => $post['jml'],
				'harga_keluar' => $post['harga'],

				'id_barang_keluar' => $post['id_barang_keluar']
			];
			$simpan = $this->m_crud->save('barang_keluar_rinci',$data);
			$id_barang_keluar_rinci = $this->db->insert_id();

			//	ambil data semua stok masuk 
			$data_semua_stok = $this->db->select('stok_masuk,id_barang,id_barang_masuk_rinci')
										->from('barang_masuk_rinci')
										->where('id_barang',$post['id_barang'])
										->where('stok_masuk > ',0)
										->order_by('id_barang_masuk_rinci')
										->get()->result();

			// lakukan pengulangan 
			
			// $qty = $r->jml_tmp;
			$qty = $post['jml'];
			foreach ($data_semua_stok as $val) {
				if($qty > 0){
					$temp = $qty;
					$qty = $qty - $val->stok_masuk;

					if($qty > 0) {      
						$stok_update = 0;
						$qty_asli = $post['jml'] - $val->stok_masuk;
					}else{
						$stok_update = $val->stok_masuk - $temp;
						$qty_asli = $post['jml'];
					}
					$this->db
						->where(['id_barang_masuk_rinci' => $val->id_barang_masuk_rinci])
						->update('barang_masuk_rinci',['stok_masuk' => $stok_update]);
					
					$data_kartu_stok = [
									'id_barang_masuk_rinci' => $val->id_barang_masuk_rinci,
									'id_barang' => $val->id_barang,
									'stok_awal' => $val->stok_masuk,
									'jm_stok_masuk' => $stok_update,
									'id_barang_keluar_rinci' => $id_barang_keluar_rinci,
									'id_barang_keluar' => $post['id_barang_keluar'],
								];
								$this->db->insert('kartu_stok', $data_kartu_stok);
				}
			}
		}
		if($simpan){
			echo 'sukses';
		}else {
			echo 'gagal';
		}
	}
	
	public function delete(){
		$id_barang_keluar = $_GET['id'];
		$delete = $this->m_crud->delete($this->_table,['id_barang_keluar' => $id_barang_keluar]);
		if($delete){
			$this->session->set_flashdata('success', 'hapus');
			redirect('barang_keluar');
		}else {
			$this->session->set_flashdata('error', 'error');
			redirect('barang_keluar');
		}
	}
	public function delete_tmp(){
		$id = $_GET['id'];
		$id_barang_keluar = $_GET['id_barang_keluar'];

		$url_lokasi = ($_GET['mode'] == 'edit') ? 'barang_keluar/edit?id='.$id_barang_keluar : 'barang_keluar/create';

		if($_GET['mode'] == 'edit'){
			//update stok masuk jika ada penghapusan di kartu stok
			$delete = $this->m_crud->delete('barang_keluar_rinci',['id_barang_keluar_rinci' => $id]);
			$this->m_crud->delete('kartu_stok',['id_barang_keluar_rinci' => $id]);
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
	public function stok(){
		$id = $_POST['id'];
		$cari = $this->db->select("SUM(stok_masuk) as stok")
							->from('barang_masuk_rinci')
							->where('id_barang',$id)
							->get()->row();
		echo $cari->stok;
	}
	public function surat_jalan(){
        $id = $this->input->get('id');
		
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' =>10]);
		$data['r'] = $this->db->select('a.*,b.*')
							->from('barang_keluar a')
							->join('customer b','a.id_customer=b.id_customer')
							->where('id_barang_keluar',$id)
							->get()->row();
		// die(print_r($query->result_array()));
        $data['rows'] = $this->db->select('b.*,c.*')
									->from('barang_keluar_rinci b')
									->join('barang c','b.id_barang=c.id_barang')
									->where('b.id_barang_keluar',$id)
									->get()->result();
        
		$html = $this->load->view('barang_keluar/surat_jalan', $data, TRUE);
		// $html = view('spp.table',$data);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
	
	function kode_otomatis($prefix){
		$this->load->database();
		$hasil = $this->db->query("SELECT max(kwt_barang_keluar) as maxKode FROM barang_keluar")->row();
		$kode = $hasil->maxKode;
		$noUrut = (int) substr($kode, 3, 3);
		$noUrut++;
		$kode = $prefix . sprintf("%03s", $noUrut);
		// die($kode);
		return $kode;
	}
}

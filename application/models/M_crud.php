<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model 
{
    public function lastID($table,$kode){
        $this->db->select($kode);
        $this->db->from($table);
        $this->db->order_by($kode, 'DESC');
        $query = $this->db->get();
        return $query->row();
    }
	public function getAll($table){
        return $this->db->get($table)->result();
    }
    public function getAutoComplate($cari,$table,$field){
            // $query = "SELECT kode_obat,nama_obat,harga,stok FROM obat WHERE nama_obat LIKE '$nama%' LIMIT 10";

        $this->db->distinct('*');
        $this->db->from($table);
        $this->db->like($field,$cari,'after');
        $this->db->group_by($field);
        // echo $this->db->last_query();
        return $this->db->get()->result();
    }
    public function getCount($table,$where){
        $this->db->where($where);
        return $this->db->count_all_results($table);
        // $this->db->last_query();
    }
    public function getById($table,$where){
        return $this->db->get_where($table, $where)->result();
        // echo $this->db->last_query();
    }
    public function first($table,$where){
        return $this->db->get_where($table, $where)->row();
        // echo $this->db->last_query();
    }
    public function save($table,$data){
        return $this->db->insert($table, $data);
        // echo $this->db->last_query();
    }
    public function save_id($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
        // echo $this->db->last_query();
    }
    public function saveGetID($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
        // echo $this->db->last_query();
    }
    public function update($table,$data,$where){
        return $this->db->where($where)->update($table,$data);

    }
    public function delete($table,$where){
        return $this->db->delete($table,$where);
    }

}
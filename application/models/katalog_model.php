<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
  
    // Fungsi untuk menambahkan katalog
    public function insert_katalog($data) {
        return $this->db->insert('katalog', $data);
    }

    // Fungsi untuk mendapatkan semua katalog
    public function get_all_katalog() {
        $query = $this->db->get('katalog');
        return $query->result_array();
    }

    public function get_all_katalog_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('katalog')->result();
    }

    public function get_by_series($series = '')
    {
        if (!empty($series)) {
            $this->db->where('series', $series);  // Filter berdasarkan kategori yang dipilih
        }
        return $this->db->get('katalog')->result_array();  // Mengembalikan hasil filter
    }
    

    // Fungsi untuk mendapatkan katalog berdasarkan user_id
    public function get_katalog_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('katalog')->result_array();
    }

    
    public function get_katalog_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('katalog')->row();
    }
    

    // Fungsi untuk mengupdate katalog berdasarkan id dan user_id
    public function update($id, $user_id, $data) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id); // Pastikan user_id cocok
        return $this->db->update('katalog', $data);
    }

    // Fungsi untuk menghapus katalog berdasarkan id
    public function delete_katalog($id) {
        return $this->db->delete('katalog', array('id' => $id));
    }

  
    public function get_user_by_id($user_id)
    {
        return $this->db->get_where('user', ['id' => $user_id])->row_array(); // Sesuaikan nama tabel
    }
}
    
    


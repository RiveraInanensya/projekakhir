<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    // Fungsi untuk mendapatkan sub menu
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
            FROM `user_sub_menu` 
            JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }

    // Fungsi untuk mendapatkan data user berdasarkan id
    public function getUserData($name) 
    {
        $this->db->where('name', $name); // 'id' sesuai dengan kolom di database
        $query = $this->db->get('user'); // 'user' adalah nama tabel di database
        return $query->row_array(); // Mengembalikan hasil dalam bentuk array
    }
}

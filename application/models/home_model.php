<?php
class Home_model extends CI_Model
{
    public function getKatalog($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_karakter', $keyword);
        }
        return $this->db->get('katalog', $limit, $start)->result_array();
    }

    public function countAllKatalog($keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_karakter', $keyword);
        }
        return $this->db->count_all_results('katalog'); // Use count_all_results for efficiency
    }
}
?>
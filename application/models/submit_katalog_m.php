<?php
class submit_katalog_m extends CI_Model {

    // Function to insert catalog data
    public function insert_katalog($data) {
        return $this->db->insert('katalog', $data); // Insert data into the katalog table
    }
}

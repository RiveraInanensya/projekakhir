<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Edit_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    // Menampilkan halaman edit profil
    public function edit_profile() {
        if (!$this->session->userdata('email')) {
            redirect('auth/login'); // Redirect ke halaman login jika belum login
        }

        $email = $this->session->userdata('email');
        $data['user'] = $this->Edit_model->get_user_by_email($email);
        
        // Tampilkan halaman edit profil
        $this->load->view('user/edit_profile', $data);
    }

    // Memproses update profil
    public function update() {
        // Validasi form input
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('usrname', 'Username', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            $this->edit_profile(); // Tampilkan kembali halaman edit_profile dengan error
        } else {
            $email = $this->session->userdata('email');
            $update_data = array(
                'usrname' => $this->input->post('usrname'),
                'name' => $this->input->post('name'),
                'instagram' => $this->input->post('instagram'),
                'email' => $this->input->post('email'),
                'bio' => $this->input->post('bio'),
                'cara_sewa' => $this->input->post('cara_sewa'),
                'kota' => $this->input->post('kota')
            );
    
            // Cek apakah ada logo yang diupload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './upload/';  // Folder upload
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // Ukuran maksimal 2MB
                $config['file_name'] = time() . '_' . $_FILES['image']['name']; // Nama file unik
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $update_data['image'] = $uploadData['file_name']; // Simpan nama file ke array $update_data
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupload logo: ' . $this->upload->display_errors());
                    redirect('edit_profile');
                    return;
                }
            }
    
            // Update data di database
            if ($this->Edit_model->update_user($email, $update_data)) {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('edit_profile');
        }
    }
    
    
}
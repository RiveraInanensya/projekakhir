<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Katalog_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['katalogs'] = $this->Katalog_model->get_all_katalog();
        $this->load->view('user/katalog', $data);
    }

    public function detail($id)
    {
        $this->load->model('Katalog_model');
        $data['katalog'] = $this->Katalog_model->get_katalog_by_id($id);
    
        if (empty($data['katalog'])) {
            show_404(); // Tampilkan halaman 404 jika tidak ditemukan
        }
    
        $this->load->view('user/detail', $data);
    }
    
    
    

    public function tambah_katalog()
    {
        // Pastikan model Katalog_model di-load
        $this->load->model('Katalog_model');
        
        // Ambil user_id dari session
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect('auth');
            return;
        }
        
        // Ambil data pengguna berdasarkan user_id
        $user = $this->Katalog_model->get_user_by_id($user_id);
        if (!$user) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
            redirect('katalog');
            return;
        }
    
        // Data awal untuk form tambah katalog
        $data['katalog'] = [
            'nama_karakter' => '',
            'brand' => '',
            'series' => '',
            'ukuran' => '',
            'harga' => '',
            'url_instagram' => $user['instagram'], // Diisi dari tabel user
            'judul_post' => '',
            'detail' => '',
            'image' => '',
            'lokasi' => '',
            'username' => $user['usrname'], // Diisi dari tabel user
        ];
    
        // Load view tambah katalog
        $this->load->view('user/tambah_katalog', $data);
    }
    


    public function submit_katalog()
    {
        $this->load->model('submit_katalog_m');
        $this->load->model('katalog_model'); // Pastikan model katalog_model di-load
        $user_id = $this->session->userdata('user_id');
    
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu untuk menambah katalog.');
            redirect('auth');
            return;
        }
    
        // Ambil data user berdasarkan user_id
        $user = $this->katalog_model->get_user_by_id($user_id);
        if (!$user) {
            $this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
            redirect('katalog/tambah_katalog');
            return;
        }
    
        $data = [
            'user_id' => $user_id,
            'judul_post' => $this->input->post('judul_post'),
            'nama_karakter' => $this->input->post('nama_karakter'),
            'brand' => $this->input->post('brand'),
            'series' => $this->input->post('series'),
            'ukuran' => $this->input->post('ukuran'),
            'harga' => $this->input->post('harga'),
            'url_instagram' => $user['instagram'], // Ambil langsung dari tabel user
            'username' => $user['usrname'], // Ambil langsung dari tabel user
            'detail' => $this->input->post('detail'),
            'lokasi' => $this->input->post('lokasi'),
        ];
    
        // Upload file gambar jika ada
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $data['image'] = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
                redirect('katalog/tambah_katalog');
                return;
            }
        }
    
        // Simpan data ke database
        if ($this->submit_katalog_m->insert_katalog($data)) {
            $this->session->set_flashdata('flash', 'Katalog berhasil ditambahkan');
            redirect('katalog');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan katalog.');
            redirect('katalog/tambah_katalog');
        }
    }
    

    public function my_katalog()
    {
        $user_id = $this->session->userdata('user_id');
        $data['katalogs'] = $this->Katalog_model->get_all_katalog_by_user($user_id);
        $this->load->view('user/my_katalog', $data);
    }

    
    public function filter_ajax($series = '')
{
    $this->load->model('Katalog_model');
    // Ambil katalog berdasarkan kategori (series) yang dipilih
    $katalogs = $this->Katalog_model->get_by_series($series);
    
    // Tampilkan katalog yang sesuai dalam format HTML
    foreach ($katalogs as $katalog) {
        echo '<a href="' . base_url('katalog/detail/' . $katalog['id']) . '" class="catalog-link">
                <div class="catalog-card">
                    <img src="' . base_url('upload/' . $katalog['image']) . '" alt="' . $katalog['nama_karakter'] . '" class="catalog-image">
                    <div class="catalog-details">
                        <p class="catalog-title">' . $katalog['judul_post'] . '</p>
                        <p class="catalog-owner">@' . $katalog['username'] . '</p>
                        <p class="catalog-price"><i class="fas fa-tag"></i> Rp ' . number_format($katalog['harga'], 0, ',', '.') . ' / 3 hari</p>
                        <p class="catalog-series"><i class="fas fa-tv"></i> ' . $katalog['series'] . '</p>
                        <p class="catalog-location"><i class="fas fa-location-dot"></i> ' . $katalog['lokasi'] . '</p>
                        <p class="catalog-ukuran">Ukuran: ' . $katalog['ukuran'] . '</p>
                    </div>
                </div>
            </a>';
    }
    
    // Jika tidak ada katalog ditemukan
    if (empty($katalogs)) {
        echo '<p>Tidak ada katalog tersedia.</p>';
    }
}


    public function edit()
    {
        // Load the model if not already loaded
        $this->load->model('katalog_model');

        $user_id = $this->session->userdata('user_id'); // Retrieve user_id from session
        $id = $this->input->get('id'); // Get the ID from the URL

        // Retrieve the catalog data for the specific ID and user
        $data['katalog'] = $this->katalog_model->get_katalog_by_id($id, $user_id);

        if (empty($data['katalog'])) {
            show_404(); // Display 404 if catalog not found
        }

        // var_dump($data);
        // Load the view and pass the data
        $this->load->view('user/edit_katalog', $data);
    }


    public function update($id)
    {
        $this->load->model('Katalog_model'); // Pastikan penulisan model benar

        $id = $this->input->post('id'); // Dapatkan ID dari input form
        $user_id = $this->session->userdata('user_id'); // Ambil user_id dari session

        if (!$user_id) {
            $this->session->set_flashdata('error', 'Anda harus login untuk memperbarui katalog.');
            redirect('auth'); // Redirect ke halaman login jika belum login
            return;
        }

        // Siapkan data untuk update
        $update_data = [
            'judul_post' => $this->input->post('judul_post'),
            'nama_karakter' => $this->input->post('nama_karakter'),
            'brand' => $this->input->post('brand'),
            'lokasi' => $this->input->post('lokasi'),
            'series' => $this->input->post('series'),
            'ukuran' => $this->input->post('ukuran'),
            'harga' => $this->input->post('harga'),
            'detail' => $this->input->post('detail'),
            'url_instagram' => $this->input->post('url_instagram'),
            'username' => $this->input->post('username')
        ];
        var_dump($update_data);

        // Cek jika ada gambar baru yang diupload
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $update_data['image'] = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupload gambar: ' . $this->upload->display_errors());
                redirect('katalog/edit?id=' . $id); // Kembali ke halaman edit jika upload gagal
                return;
            }
        }

        // Lakukan update data katalog di database
        if ($this->Katalog_model->update($id, $user_id, $update_data)) {
            $this->session->set_flashdata('success', 'Katalog berhasil diperbarui.');
            redirect('katalog/my_katalog', $update_data); // Redirect ke halaman katalog setelah berhasil update
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui katalog.');
            redirect('katalog/edit?id=' . $id); // Redirect jika update gagal
        }
    }

    public function delete_katalog($nama_karakter)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('auth');
        }

        if ($this->Katalog_model->delete_katalog($nama_karakter)) {
            $this->session->set_flashdata('success', 'Catalog deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete catalog.');
        }

        redirect('katalog/my_katalog');
    }

   
}


<?php
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination'); // Load pagination library
        $this->load->model('home_model', 'katalog'); // Load your model
    }

        public function search_katalog()
        {
            $keyword = $this->input->post('keyword');
            $this->load->model('Katalog_model'); // Load model katalog
            $data['results'] = $this->Katalog_model->searchKatalog($keyword);
        
            $this->load->view('user/katalog', $data); // Tampilkan view dengan data hasil pencarian
        }
        

        // Pagination config
        $config['base_url'] = base_url('user/home');
        $config['total_rows'] = $this->katalog->countAllKatalog($data['keyword']);
        $config['per_page'] = 5; // Number of items per page
        $config['uri_segment'] = 3;

        // Custom link bootstrap
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';

        // Initialize pagination
        $this->pagination->initialize($config);

        // Fetch data
        $start = $this->uri->segment(3, 0);
        $data['katalog'] = $this->katalog->getKatalog($config['per_page'], $start, $data['keyword']);

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('user/home', $data); // Ensure the path is correct
        $this->load->view('templates/footer');
    }

?>
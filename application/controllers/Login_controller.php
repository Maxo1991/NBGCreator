<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }
    public function login_post()
    {
        if (!empty($_SESSION['user_id']) || (isset($_POST['email']) && isset($_POST['password']))) {
            if(!empty($_POST['email'])){
                $email = $_POST['email'];
            } else if(!empty($_SESSION['user_email'])) {
                $email = $_SESSION['user_email'];
            } else {
                $email = false;
            }

            if(!empty($_POST['password'])) {
                $password = $_POST['password'];
            } else if(!empty($_SESSION['user_password'])){
                $password = $_SESSION['user_password'];
            } else {
                $password = false;
            }

            $query = $this->db->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

            if ($query->num_rows()) {
                $result = $query->result_array();
                $this->session->set_userdata('user_id', $result[0]['id']);
                $this->session->set_userdata('user_email', $result[0]['email']);
                $this->session->set_userdata('user_name', $result[0]['name'] . ' ' . $result[0]['lastname']);
                $this->session->set_userdata('user_password', $result[0]['password']);
                $userId = $result[0]['id'];
                $this->load->model('post_model');

                $this->load->library('pagination');
                $limit = 3;
                $page = ($this->uri->segment(2)) ? ($this->uri->segment(2) - 1) : 0;
                $start = $page * $limit;

                $data['posts'] = $this->post_model->getUserPostsPagination($userId, $limit, $start);

                $config['base_url'] = 'http://localhost/NBGCreator/home';
                $config['total_rows'] = $this->post_model->getUserPosts($userId)->num_rows();
                $config['per_page'] = 3;
                $config['uri_segment'] = 2;

                $config['num_links'] = 1;
                $config['use_page_numbers'] = TRUE;
                $config['reuse_query_string'] = TRUE;

                $config['full_tag_open'] = '<div class="pagination">';
                $config['full_tag_close'] = '</div>';

                $config['first_link'] = '<<';
                $config['first_tag_open'] = '<span class="firstlink btn btn-dark">';
                $config['first_tag_close'] = '</span>';

                $config['last_link'] = '>>';
                $config['last_tag_open'] = '<span class="lastlink btn btn-dark">';
                $config['last_tag_close'] = '</span>';

                $config['next_link'] = '>';
                $config['next_tag_open'] = '<span class="nextlink btn btn-dark">';
                $config['next_tag_close'] = '</span>';

                $config['prev_link'] = '<';
                $config['prev_tag_open'] = '<span class="prevlink btn btn-dark">';
                $config['prev_tag_close'] = '</span>';

                $config['cur_tag_open'] = '<span class="curlink btn btn-warning">';
                $config['cur_tag_close'] = '</span>';

                $config['num_tag_open'] = '<span class="numlink btn btn-dark">';
                $config['num_tag_close'] = '</span>';

                $this->pagination->initialize($config);

                $data['links'] = $this->pagination->create_links();

                $this->load->view('home', $data);
            } else {
                $this->load->view('login');
            }
        } else {
            die("Invalid Input!");
        }
    }
    function listAllPosts(){
        $this->load->model('post_model');

        $this->load->library('pagination');
        $limit = 3;
        $page = ($this->uri->segment(2)) ? ($this->uri->segment(2) - 1) : 0;
        $start = $page * $limit;

        $data['posts'] = $this->post_model->getAllPostsPagination($limit, $start);

        $config['base_url'] = 'http://localhost/NBGCreator/posts';
        $config['total_rows'] = $this->post_model->getAllPosts()->num_rows();
        $config['per_page'] = 3;
        $config['uri_segment'] = 2;

        $config['num_links'] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = '<<';
        $config['first_tag_open'] = '<span class="firstlink btn btn-dark">';
        $config['first_tag_close'] = '</span>';

        $config['last_link'] = '>>';
        $config['last_tag_open'] = '<span class="lastlink btn btn-dark">';
        $config['last_tag_close'] = '</span>';

        $config['next_link'] = '>';
        $config['next_tag_open'] = '<span class="nextlink btn btn-dark">';
        $config['next_tag_close'] = '</span>';

        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<span class="prevlink btn btn-dark">';
        $config['prev_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<span class="curlink btn btn-warning">';
        $config['cur_tag_close'] = '</span>';

        $config['num_tag_open'] = '<span class="numlink btn btn-dark">';
        $config['num_tag_close'] = '</span>';

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();

        $this->load->view('allposts', $data);
    }
    function show($id)
    {
        $this->load->model('post_model');
        $data['post'] = $this->post_model->getPost($id);
        $data['images'] = $this->post_model->getImages($id);
        $this->load->view('singlepost', $data);
    }
    function edit($id)
    {
        $this->load->model('post_model');
        $data['post'] = $this->post_model->getPost($id);
        $data['images'] = $this->post_model->getImages($id);
        $this->load->view('edit', $data);
    }
    function showCreateForm()
    {
        $this->load->view('createpost');
    }
    function create()
    {
        $this->load->model('post_model');
        $lastId = $this->post_model->createPost();
        $countfiles = count($_FILES['files']['name']);
        for($i = 0; $i < $countfiles; $i++){
            if(!empty($_FILES['files']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $imageName = rand(10000, 99999) . $_FILES['files']['name'][$i];

                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['upload_path'] = './images/';
                $config['file_name'] = $imageName;

                $this->db->insert('photos', array('post_id' => $lastId, 'name' => $imageName));

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if( $this->upload->do_upload('file') ){
                    $data = $this->upload->data();
                } else {
                    print_r($this->upload->display_errors());
                }
            }
        }

        redirect('home/1');
    }
    function deleteImage($id)
    {
        $this->load->model('post_model');
        $data = $this->post_model->deleteImage($id);
        unlink("images/" . $data['name']);
        redirect('edit_post/' . $data['post_id']);
    }
    function update($id)
    {
        $this->load->model('post_model');
        $this->post_model->updatePost($id);
        $countfiles = count($_FILES['files']['name']);
        for($i = 0; $i < $countfiles; $i++){
            if(!empty($_FILES['files']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $imageName = rand(10000, 99999) . $_FILES['files']['name'][$i];

                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['upload_path'] = './images/';
                $config['file_name'] = $imageName;

                $this->db->insert('photos', array('post_id' => $id, 'name' => $imageName));

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if( $this->upload->do_upload('file') ){
                    $data = $this->upload->data();
                } else {
                    print_r($this->upload->display_errors());
                }
            }
        }

        redirect('home/1');
    }
    function delete($id)
    {
        $this->load->model('post_model');
        $names = $this->post_model->deletePost($id);
        foreach($names as $name)
        {
            unlink("images/" . $name);
        }
        redirect('home/1');
    }
    function logout()
    {
        session_destroy();
        $this->load->view('login');
    }
}
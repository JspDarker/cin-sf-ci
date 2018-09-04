<?php

class Users extends MY_Controller
{

    private $_uploaded;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('captcha');
        $this->load->model('user_model');
    }
    public function login()
    {
        if($this->session->has_userdata('user_id')) {
            redirect('auth/users/tam');
        }
        $data['subview'] = 'login';
        if($this->input->post('email') !== null) {
            $this->form_validation->set_rules('email','email','required|callback_check_mail_exists');
            $this->form_validation->set_rules('pass','password','required|callback_check_pass'); // |callback_check_pass
            if($this->form_validation->run() !== false) {
                echo $this->session->userdata('user_name');
                redirect('auth/users/tam');
            } else {
                $this->load->view('layouts/master',compact('data'));
            }
        } else {
            $this->load->view('layouts/master',compact('data'));
        }
    }

    public function register()
    {
        $data['subview'] = 'register';
        if($this->input->post('email') !== null) {
            // set rules
            $this->form_validation->set_rules('email','email','required|valid_email|is_unique[fs_user.email]',array(
                'is_unique' => 'Please enter email #'
            ));
            $this->form_validation->set_rules('pass','pass','required');
            $this->form_validation->set_rules('images[]','images','callback_check_avatars_upload');
            //if invalid
            if($this->form_validation->run() !== true) {
                // unlink avatar
                $this->load->view('layouts/master',compact('data'));
            } else { // insert db fs_user
                // hash password
                // upload avatar
                // save
                echo 'Email valid, You can register !';
            }

        } else {
            $this->load->view('layouts/master',compact('data'));
        }
    }

    public function check_avatars_upload()
    {
        // count all file uploaded;
        $number_of_files = sizeof($_FILES['images']['tmp_name']);
        /*echo "<pre>";
        print_r($_FILES['images']);
        echo "</pre>"; die;*/
        $files = $_FILES['images'];
        for($i = 0; $i < $number_of_files; $i++){
            if($files['error'][$i] != 0) {
                $this->form_validation->set_message('check_avatars_upload','Coun\'t upload files');
                return false;
            }
        }
        // load library
        $this->load->library('upload');
        // config add
        $config['upload_path']= 'public/images/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

    }

    public function check_mail_exists()
    {
        $email = $this->input->post('email',true);
        $found = $this->user_model->check_mail($email);
        if($found === false) {
            $this->form_validation->set_message('check_mail_exists','wrong email or pass');
            return false;
        } else{
            return true;
        }
    }

    public function check_pass()
    {
        $pass = $this->input->post('pass',true);
        $email = $this->input->post('email',true);
        $found = $this->user_model->check_pass($email,$pass);
        if($found === false) {
            $this->form_validation->set_message('check_pass','wrong email or pass'); return false;
        } else {
            return true;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        redirect('auth/users/login');
    }

    public function tam()
    {
        echo "Welcome to home page";
    }
}
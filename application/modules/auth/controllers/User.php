<?php

class User extends MY_Controller
{

    private $_uploaded;
    private $_email;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        //$this->load->helper('captcha');
        $this->load->model('user_model');
    }

    public function login()
    {
        if ($this->session->has_userdata('user_id')) {
            redirect('auth/user/tam');
        }
        $data['subview'] = 'login';

        if($this->input->post() !== null) {
            // set rule
            $this->form_validation->set_rules('email','email','required');
            $this->form_validation->set_rules('pass','password','required|callback_check_authenticate');
                //captcha extension
            /**
             * Captcha ====
             */
            $captcha['captcha'] = $this->captcha();
            $captcha_rule = true;
            if(! empty($captcha['captcha']['error'])) {
                $captcha_rule = false;
            } else {
                echo isset($captcha['captcha']['error']) ? $captcha['captcha']['error'] : '';
            }

            if($this->form_validation->run() === false && $captcha_rule == true) {
                $this->load->view('layouts/master',compact('data'));
            } else {
                $this->_email = $this->input->post('email');
                /**
                 * Adding cookies for email
                 */
                $this->load->helper('cookie');
                if ($this->input->post('remember') == 'on'){ // set cookies
                    $cookies = array('name'=>'email_cook','value'=>$this->_email,'expire'=>604800);
                    $this->input->set_cookie($cookies);
                } else {// delete cookies
                    $cookies = array('name'=>'email_cook','value'=>'','expire'=>'');
                    delete_cookie($cookies);
                } // end adding cookies
                redirect('auth/user/tam');
            }
        } else {
            $this->load->view('layouts/master',compact('data','captcha','status'));
        }
    }

    public function check_authenticate()
    {
        $email = $this->input->post('email',true);
        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
            $this->form_validation->set_message('check_authenticate','email invalid');
            return false;
        }
        $pass = $this->input->post('pass',true);
        $user = $this->user_model->authenticate($email,$pass);
        if ($user === false) {
            $this->form_validation->set_message('check_authenticate','Account invalid ! Email or password wrong');
            return false;
        }
        return true;
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
        } else {
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
        redirect('auth/user/login');
    }

    public function tam()
    {
        echo "Welcome to home page";
    }

    public function captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './public/assets/captcha/',
            //'img_url' => 'http://localhost/thanh/code3sf/public/images/captcha/',
            'font_path'     => './public/fonts/Amble-Regular.ttf',
            'img_url' => base_url().'public/assets/captcha/',
            'img_width' => '170',
            'img_height' => '45',
            'expiration' => 7200,
            'font_size'     => 16,
        );

        $cap = create_captcha($vals);
        echo "<pre>";
        //print_r($this->input->ip_address());
        print_r($cap);
        echo "</pre>";


        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );
        $this->load->model('captcha_model');
        $b_SaveData = $this->captcha_model->saveData($data);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sz_Word = $this->input->post('captcha');
            $b_Check = $this->captcha_model->b_fCheck($sz_Word);
            if ($b_Check) {
                $a_Data['success'] = 'Your input catpcha is correct';
            } else {
                $a_Data['error'] = 'Your catpcha fail';
                //$this->form_validation->set_message('captcha', $a_Data['error']);
                //return false;
            }
        }
        $a_Data['Data'] = $cap['image'];
//        echo "<pre>";
//        print_r($a_Data);
//        echo "</pre>"; die;
        return $a_Data;
    }

    public function testCaptcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'word'          => 'Random word',
            'img_path'      => './public',
            'img_url'       => base_url().'public/',
            //'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);

        echo $cap['image'];
    }
}
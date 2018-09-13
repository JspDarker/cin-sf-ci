<?php


class Authenticate extends MY_Controller
{

    // properties here
    private $_userid;
    private $_captcha;
    private $_email;
    private $_password;
    private $_data_from_email= array();


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('admin_model');
        /**
         * email::required|
         * password:: required|callback_is_authorize()
         */
    }

    public function login()
    {
        $data['subview']= 'login';
        $data['title']= 'Login';

        if($this->input->post('login_button') !== null){
            $data['form_data']=$this->input->post();
            $this->_email = $data['form_data']['email'];
            $this->_password = $data['form_data']['pass'];
            $this->form_validation->set_rules('email','email','required|valid_email|callback_check_email');
            $this->form_validation->set_rules('pass','password','required|callback_check_auth_login');


            if($this->form_validation->run() !== true) {
                $this->load->view('master',array('data'=>$data));
            } else { // valid
                redirect('authenticated');
            }
        } else {
            $this->load->view('master',array('data'=>$data));
        }

    }

    public function check_email()
    {
        $result = $this->admin_model->check_email_exists($this->_email,'fs_user');
        if($result === false) {
            $this->form_validation->set_message('check_email','Email not exists !');
            return false;
        } else {
            $this->_data_from_email= $result;
            return true;
        }
    }

    public function check_auth_login()
    {
        if (!empty($this->_data_from_email)) {
            $email= $this->_data_from_email['email'];
            $pass_hash= $this->_data_from_email['password'];
            $pass = $this->_password;
            if(password_verify($pass, $pass_hash) === true) {
                return true;
            } else {
                $this->form_validation->set_message('check_auth_login','pass or email wrong !');
                return false;
            }
        }
    }

}

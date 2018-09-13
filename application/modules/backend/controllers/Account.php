<?php
/**
 * Created by PhpStorm.
 * User: jsp-thanh
 * Date: 9/13/18
 * Time: 8:07 PM
 */

class Account extends MY_Controller
{
    // properties here
    private $_userid;
    private $_captcha;
    private $_username;
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
        if ($this->session->has_userdata('author')) {
            redirect('authenticated');
        }
        self::_is_authenticated();
        $data['subview']= 'login';
        $data['title']= 'Login';

        if($this->input->post('login_button') !== null){
            $data['posts']=$this->input->post();
            $this->form_validation->set_rules($this->_setRules(),$data['posts']);
            if($this->form_validation->run() !== true) {
                $this->load->view('master',array('data'=>$data));
            } else { // valid
                redirect('authenticated');
            }
        } else {
            $this->load->view('master',array('data'=>$data));
        }
    }

    private function _setRules()
    {
        $configs = array(
            array(
                'field'     =>  'email',
                'label'     =>  'Email',
                'rules'     =>  'trim|required|valid_email'
            ),
            array(
                'field'     =>  'pass',
                'label'     =>  'Password',
                'rules'     =>  'trim|required|callback_is_authorize'
            ),
            array(
                'field'     =>  'checkbox',
                'label'     =>  '',
                'rules'     =>  ''
            ),
            /*array(
                'field'     =>  'captcha',
                'label'     =>  'Captcha',
                'rules'     =>  'required|callback_is_captcha'
            ),*/
        );
        return $configs;
    }

    public function is_authorize()
    {
        $email = $this->input->post('email',true);

        $result = $this->admin_model->check_email_exists($email,'fs_user');
        if($result === false) {
            $this->session->set_flashdata('message_login','error login ! password or email wrong');
            $this->form_validation->set_message('is_authorize','');
            return false;
        } else { // email true
            // check pass
            //1. get pass from email
            $pass_hash = $result['password'];
            $pass = $this->input->post('pass',true);
            if(password_verify($pass,$pass_hash) !== true) {
                $this->session->set_flashdata('message_login','error login ! password or email wrong');
                $this->form_validation->set_message('is_authorize','');
                return false;
            } else {
                $this->session->set_userdata(array(
                    'author' => array(
                        'id'    => $result['id'],
                        'name'  => $result['name']
                    )
                ));
                return true;
            }
        }

    }

    private static function _is_authenticated()
    {
        // has cookie
        // has session
        /*$param = 'th';
        switch ($param === 1){
            case 'home': {

            }
                break;
            case 'home1': {

            }
                break;
            default:
                echo 'default';
        }*/
    }
}
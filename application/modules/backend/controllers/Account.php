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
    private $_data_from_email = array();


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
        $data['subview'] = 'login';
        $data['title'] = 'Login';

        if ($this->input->post('login_button') !== null) {
            $data['posts'] = $this->input->post();
            //$this->form_validation->set_rules($this->_setRules(), $data['posts']);

            $this->form_validation->set_rules(rulesHelper(array('email','pass')), $data['posts']);
            if ($this->form_validation->run() !== true) {
                $this->load->view('master', array('data' => $data));
            } else { // valid
                // process cookie
                if ($this->input->post('checkbox_login') == 1) {
                    $this->_setCookies(DURATION_COOKIE, array('email'=>$data['posts']['email'], 'pass'=>$data['posts']['pass']));
                } else {
                    $this->_setCookies('', array('email'=>$data['posts']['email'], 'pass'=>$data['posts']['pass']));
                }

                redirect('authenticated');
            }
        } else {
            $this->load->view('master', array('data' => $data));
        }
    }

    private function _setRules()
    {
        $configs = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|xss_clean|valid_email'
            ),
            array(
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean|callback_is_authorize'
            ),
            array(
                'field' => 'checkbox',
                'label' => '',
                'rules' => ''
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
        $email = $this->input->post('email', true);
        $result = $this->admin_model->check_email_exists($email, 'fs_user');
        if ($result === false) {
            $this->session->set_flashdata('message_login', 'error login ! password or email wrong');
            $this->form_validation->set_message('is_authorize', '');
            return false;
        } else { // email true
            // check pass
            //1. get pass from email
            $pass_hash = $result['password'];
            $pass = $this->input->post('pass', true);
            if (password_verify($pass, $pass_hash) !== true) {
                $this->session->set_flashdata('message_login', 'error login ! password or email wrong');
                $this->form_validation->set_message('is_authorize', '');
                return false;
            } else {
                $this->session->set_userdata(array(
                    'author' => array(
                        'id' => $result['id'],
                        'name' => $result['name']
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
    }

    public function logout()
    {
        $this->session->unset_userdata('author');
        redirect('/');
    }

    public function register()
    {
        $data['subview'] = 'register';
        //fields

        if($this->input->post('btn-register') !== null) {
            $posts = $this->input->post();
            $this->form_validation->set_rules(rulesHelper(array('avatar','captcha')),$posts);
            if($this->form_validation->run() !== true) {
                $this->load->view('master', array('data' => $data));
            }
        } else {
            $this->load->view('master', array('data' => $data));
        }
        //files
        //captcha

    }

    private function _setRuleRegister()
    {
        $configs = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password conf',
                'rules' => 'trim|required|matches[pass]'
            ),
            array(
                'field' => 'checkbox',
                'label' => '',
                'rules' => ''
            ),
            /*array(
                'field'     =>  'captcha',
                'label'     =>  'Captcha',
                'rules'     =>  'required|callback_is_captcha'
            ),*/
        );
        return $configs;
    }

    private function _setCookies($duration, $fields = array())
    {
        $this->load->helper('cookie');
        foreach ($fields as $key => $field) {
            $cookies = array(
                'name' => $key,
                'value' => $field,
                'expire' => $duration
            );
            $this->input->set_cookie($cookies);
        }
        delete_cookie('name');
    }
}
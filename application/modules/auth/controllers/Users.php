<?php

class Users extends MX_Controller
{
    public function login()
    {
        $data['subview'] = 'login';
        $this->load->view('layouts/master',compact('data'));
    }
}
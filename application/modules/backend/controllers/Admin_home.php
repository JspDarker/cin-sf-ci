<?php


class Admin_home extends MY_Controller
{
    // properties here


    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('form');
    }

    public function index()
    {
        $data['subview']= 'home';
        $data['title']= 'PagesHome';
        $this->load->view('master',array('data'=>$data));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jsp-thanh
 * Date: 9/4/18
 * Time: 9:23 PM
 */

class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }
}
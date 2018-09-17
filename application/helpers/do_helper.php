<?php

function dd($END)
{
    echo "<pre>";
    print_r($END);
    echo "</pre>";
    die;
}

if (!function_exists('rulesHelper')) {
    function rulesHelper($posts) {
        if (!is_array($posts)) {
            return false;
        }

        $mainConfigs = array(
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
                'field' => 'email_new',
                'label' => 'Email',
                'rules' => 'trim|required|xss_clean|valid_email|is_unique[fs_user.email]'
            ),
            array(
                'field' => 'pass_new',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'pass_new_confirm',
                'label' => 'Passconf',
                'rules' => 'required|xss_clean|matches[pass_new]'
            ),
            array(
                'field' => 'pass_new_confirm',
                'label' => 'Passconf',
                'rules' => 'required|xss_clean|matches[pass_new]'
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'city',
                'label' => 'Name',
                'rules' => ''
            ),
            array(
                'field' => 'avatar',
                'label' => 'Avatar',
                'rules' => 'required|callback_check_avatar'
            ),
            array(
                'field'     =>  'captcha',
                'label'     =>  'Captcha',
                'rules'     =>  'required|callback_is_captcha'
            ),
            array(
                'field' => 'checkbox',
                'label' => '',
                'rules' => ''
            ),
        );
        $result = array();
        foreach ($posts as $post) {
            foreach ($mainConfigs as $config) {
                if ($post == $config['field']) {
                    $result[] = $config;
                }
            }
        }
        return $result;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: jsp-thanh
 * Date: 9/4/18
 * Time: 9:11 PM
 */

class User_model extends CI_Model
{

    public function authenticate($email, $pass=1)
    {
        //from email get info user
        $query = $this->db->select('id,name,email,password')
            ->from('fs_user')
            ->where(array('email'=>$email));
        $user = $query->get()->row_array();
        //return $password;
        if(password_verify($pass,$user['password']) !== true){
            return false;
        } else {
            $this->session->set_userdata('user_id',$user['id']);
            $this->session->set_userdata('user_name',$user['name']);
            return $user;
        }

    }


    public function check_mail($email)
    {
        $query = $this->db->select('id,name,email')
            ->from('fs_user')
            ->where('email = ',$email);
        $res = $query->get()->row_array();
        if(empty($res)) {
            return false;
        } else {
            return array(
                'id'=>$res['id'],
                'name'=>$res['name'],
                'email'=>$res['email']
            );
        }
    }



    public function check_pass($email,$pass)
    {
        $lists = array('email = '=> $email);
        $query = $this->db->select('id,name,email,password')
            ->from('fs_user')
            ->where($lists);
        $res = $query->get()->row_array();
        if(empty($res)) return false;
        if(password_verify($pass,$res['password']) !== true) {
            return false;
        }
        $this->session->set_userdata('user_id',$res['id']);
        $this->session->set_userdata('user_name',$res['name']);
    }
}
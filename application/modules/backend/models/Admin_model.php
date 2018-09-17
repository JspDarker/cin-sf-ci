<?php
/**
 * Created by PhpStorm.
 * User: jsp-thanh
 * Date: 9/11/18
 * Time: 9:58 PM
 */

class Admin_model extends CI_Model
{

    public function check_email_exists($email, $table)
    {
        $query = $this->db->select('id,email,password,name')
            ->from($table)
            ->where('email',$email);
        $result = $query->get()->row_array();
        return empty($result) ? false : $result;
    }
}
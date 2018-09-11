<?php

class Captcha_model extends CI_Model
{
    private $_name = 'fs_captcha';

    function __construct(){
        parent::__construct();
    }

    public function saveData($the_a_Data)
    {
        $query = $this->db->insert_string($this->_name, $the_a_Data);
        return $this->db->query($query);
    }

    public function b_fCheck($the_sz_Captcha)
    {
        // Xóa các captch cũ đi
        $expiration = time()-7200; // Giới hạn là 2 tiếng
        $this->db->query("DELETE FROM $this->_name WHERE captcha_time < ".$expiration);

        // Kiểm tra captcha nhập vào có tồn tại hay không:
        $sql = "SELECT COUNT(*) AS count FROM $this->_name WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($the_sz_Captcha, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            return false;
        } else return true;
    }
}
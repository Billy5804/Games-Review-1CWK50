<?php
class UserModel extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function checkCredentials($username = null, $password = null) {
        $query = $this->db->query("SELECT enableDarkMode, isAdmin FROM users WHERE username = '".$username."' AND  password = '".$password."';");
        return $query->result();
    }

    public function setDarkmode($darkmode = 0, $username = NULL) {
        $this->db->query("UPDATE users SET enableDarkMode = ".$darkmode." WHERE username = '".$username."';");
    }

    public function setAdmin($admin = 0, $username = NULL) {
        $this->db->query("UPDATE users SET isAdmin = ".$admin." WHERE username = '".$username."';");
    }
}
?>
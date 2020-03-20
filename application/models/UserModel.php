<?php
class UserModel extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }

    public function checkCredentials($username = null, $password = null) {
        // Main Query
        $this->db->select('enableDarkMode, isAdmin');
        $this->db->from('users');
        $this->db->where('username', $username)->where('password', $password);

        $query = $query = $this->db->get();

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
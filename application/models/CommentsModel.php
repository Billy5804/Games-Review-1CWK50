<?php
class CommentsModel extends CI_Model{

    public function __construct() {
        $this->load->database();
    }

    public function getComments($id = 0) {
        // Sub Query
        $this->db->select('username')->from('users')->where('userID = gc.userID');
        $subQuery =  $this->db->get_compiled_select();

        // Main Query
        $this->db->select('comment, commentTimestamp, ('.$subQuery.') AS username');
        $this->db->from('gamescomments gc')->join('activereviews', 'reviewID');
        $this->db->where('reviewID', $id)->where('enableComments', 1);
        $this->db->order_by('commentTimestamp', 'ASC');

        $query = $query = $this->db->get();

        // print_r($this->db->last_query());
        
        return $query->result();
    }

    public function postComment($id = NULL, $username = NULL, $comment = NULL) {
        $queryCommentsEnabled = $this->db->query("SELECT enableComments FROM activereviews WHERE reviewID = ".$id.";");
        $commentsEnabled = boolval($queryCommentsEnabled->row(0)->enableComments);
        if ($commentsEnabled) {
            $queryUserID = $this->db->query("SELECT userID FROM users WHERE username = '".$username."';");
            $userID = $queryUserID->row(0)->userID;
            $this->db->query("INSERT INTO gamescomments (userID, comment, reviewID) VALUES (".$userID.",'".$comment."',".$id.");");
        }
    }
}
?>
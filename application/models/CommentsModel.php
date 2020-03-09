<?php
class CommentsModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function getComments($id = 0)
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT (SELECT username FROM users WHERE userID = gc.userID) AS username, comment, commentTimestamp FROM gamescomments gc JOIN activereviews USING(reviewID) WHERE reviewID = ".$id." AND enableComments = 1 ORDER BY commentTimestamp;");
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
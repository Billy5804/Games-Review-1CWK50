<?php
class HomeModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Get for all games
    public function getReviewedGames()
    {
        $this->db->select('name,blurb,slug,image');
        $this->db->from('games');

        $query = $this->db->get();

        return $query->result();
    }

    public function getGameReviews($slug)
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT reviewID, ar.image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username FROM activereviews ar JOIN games USING(gameID) WHERE slug = '".$slug."' ORDER BY reviewTimestamp;");
        return $query->result();
    }

    public function getLatestReviews()
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT reviewerID, reviewID, slug, ar.image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username FROM activereviews ar JOIN games USING(gameID) ORDER BY reviewTimestamp;");
        return $query->result();
    }

    //Get the details for a game once it has been clicked on.
    public function getReview($id = 0)
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT ar.image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username, blurb, reviewID FROM activereviews ar JOIN games USING(gameID) WHERE reviewID = ".$id.";");
        return $query->result();
    }

    public function getComments($id = 0)
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT (SELECT username FROM users WHERE userID = gc.userID) AS username, comment, commentTimestamp FROM gamescomments gc WHERE reviewID = ".$id." ORDER BY commentTimestamp;");
        return $query->result();
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
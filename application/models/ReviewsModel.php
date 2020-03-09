<?php 
class ReviewsModel extends CI_Model{

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
        $query = $this->db->query("SELECT reviewID, image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username FROM activereviews ar JOIN games USING(gameID) WHERE slug = '".$slug."' ORDER BY reviewTimestamp;");
        return $query->result();
    }

    public function getLatestReviews()
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT reviewerID, reviewID, slug, image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username FROM activereviews ar JOIN games USING(gameID) ORDER BY reviewTimestamp;");
        return $query->result();
    }

    //Get the details for a game once it has been clicked on.
    public function getReview($id = 0)
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT image, name, review, (SELECT username FROM users WHERE userID = ar.reviewerID) AS username, blurb, reviewID, enableComments FROM activereviews ar JOIN games USING(gameID) WHERE reviewID = ".$id.";");
        return $query->result();
    }
}
?>
<?php 
class ReviewsModel extends CI_Model{

    public function __construct() {
        $this->load->database();
    }

    //Get for all games
    public function getReviewedGames() {
        $this->db->select('name,blurb,slug,image');
        $this->db->from('games');

        $query = $this->db->get();

        return $query->result();
    }

    // get reviews for specific game
    public function getGameReviews($slug) {
        // Sub Query
        $this->db->select('username')->from('users')->where('userID = ar.reviewerID');
        $subQuery =  $this->db->get_compiled_select();

        // Main Query
        $this->db->select('reviewID, image, name, review, ('.$subQuery.') AS username');
        $this->db->from('activereviews ar')->join('games', 'gameID');
        $this->db->where('slug', $slug);
        $this->db->order_by('reviewTimestamp', 'DESC');

        $query = $this->db->get();

        // print_r($this->db->last_query());  

        return $query->result();
    }

    // get all reviews with the latest first
    public function getLatestReviews() {
        // Sub Query
        $this->db->select('username')->from('users')->where('userID = ar.reviewerID');
        $subQuery =  $this->db->get_compiled_select();

        // Main Query
        $this->db->select('reviewerID, reviewID, slug, image, name, review, ('.$subQuery.') AS username');
        $this->db->from('activereviews ar')->join('games', 'gameID');
        $this->db->order_by('reviewTimestamp', 'DESC');

        $query = $query = $this->db->get();

        // print_r($this->db->last_query());

        return $query->result();
    }

    //Get the details for a game once it has been clicked on.
    public function getReview($id = 0) {
        // Sub Query
        $this->db->select('username')->from('users')->where('userID = ar.reviewerID');
        $subQuery =  $this->db->get_compiled_select();

        // Main Query
        $this->db->select('reviewID, image, name, review, blurb, enableComments, ('.$subQuery.') AS username');
        $this->db->from('activereviews ar')->join('games', 'gameID');
        $this->db->where('reviewID', $id);

        $query = $this->db->get();

        // print_r($this->db->last_query());  

        return $query->result();
    }
}
?>
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Load in your Models below.
        $this->load->model('CommentsModel');
    }

    public function returnComments($id = null) {
		//Get comments for specified review
        $results = $this->CommentsModel->getComments($id);

		// adapt the header so the response matches the JSON format.
		header('Content-Type: application/json');

        // Display the comments as a json array
		echo json_encode($results);
	}

	public function sendComment($id = NULL) {
		// Retrieve the input post from jQuery/VueJS
		$comment = $this->input->post();
        // Send comment to model to save to db
        $this->CommentsModel->postComment($id, $comment['username'], $comment['comment']);
	}
  
}

?>
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Consider if it would be best to autoload some of the helpers from here.
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');
        $this->load->helper('my_helper');
        
        $this->load->library('session');

        // Load in your Models below.
        $this->load->model('HomeModel');
        
        // Consider creating new Models for different functionality.
        $this->load->library('image_lib');
    }

    public function index()
    {
        // Store user information
        $data['user'] = $this->session->loggedInUser;
        
        if(!empty($data['user'])) {
            $data['username'] = $this->session->username;
            $data['adminText'] = 'Enable Admin';
            if ($this->session->admin) $data['adminText'] = 'Disable Admin';
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = 'Games Reviews';

        // active nav
        $data['reviews'] = 'active';

        // Get the data from our Home Model.
        $data['result'] = $this->HomeModel->getLatestReviews();

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">alert("Successfully Logged Out")</script>';
        }
        
        //Load the view and send the data accross.
        $this->load->template('Home', $data, false);
    }

    public function reviewedGames()
    {
        // Store user information
        $data['user'] = $this->session->loggedInUser;
        
        if(!empty($data['user'])) {
            $data['username'] = $this->session->username;
            $data['adminText'] = 'Enable Admin';
            if ($this->session->admin) $data['adminText'] = 'Disable Admin';
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = 'Reviewed Games';

        // active nav
        $data['games'] = 'active';
        
        // Get the data from our Home Model.
        $data['result'] = $this->HomeModel->getReviewedGames();

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">alert("Successfully Logged Out")</script>';
        }

        //Load the view and send the data accross.
        $this->load->template('reviewedGames', $data, false);
    }

    public function gameReviews($slug = NULL)
    {
        //Retrive data from model
        $data['result'] = $this->HomeModel->getGameReviews($slug);

        //Show 404 if no data found
        if (empty($data['result'])) {
                show_404();
        }

        // Get game title
        foreach($data['result'] as $row) {
            $game = $row->name;
            break;
        }

        // Store user information
        $data['user'] = $this->session->loggedInUser;
        
        if(!empty($data['user'])) {
            $data['username'] = $this->session->username;
            $data['adminText'] = 'Enable Admin';
            if ($this->session->admin) $data['adminText'] = 'Disable Admin';
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = $game.' Reviews';

        // active nav
        $data['games'] = 'active';

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">alert("Successfully Logged Out")</script>';
        }

        // Load the view
        $this->load->template('home', $data, false);
    }

    public function review($slug = NULL, $id = null)
    {
        //Retrive data from model
        $data['result'] = $this->HomeModel->getReview($id);

        //Show 404 if no data found
        if (empty($data['result'])) {
                show_404();
        }

        // Get game title
        foreach($data['result'] as $row) {
            $game = $row->name;
            break;
        }

        // Store user information
        $data['user'] = $this->session->loggedInUser;
        
        if(!empty($data['user'])) {
            $data['username'] = $this->session->username;
            $data['adminText'] = 'Enable Admin';
            if ($this->session->admin) $data['adminText'] = 'Disable Admin';
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = $game.' Review';

        // active nav
        $data['reviews'] = 'active';

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">alert("Successfully Logged Out")</script>';
        }

        // Load the view
        $this->load->template('review', $data, false);
    }

    public function login() {
        if ($this->session->loggedInUser) {
            redirect(base_url());
        }
        $previousPage = $this->session->previousPage;
        $this->session->previousPage = null;
        if (!empty($this->input->post('currentPage'))) {
            $previousPage = $this->input->post('currentPage');
        }
        $username = $this->input->post('inputUsername');
        $password = $this->input->post('inputPassword');

        $data = [];

        if (!empty($username) && !empty($password)) {
            $credentialsCheck = $this->HomeModel->checkCredentials($username, $password);
            if (!empty($credentialsCheck)) {
                foreach ($credentialsCheck as $row) {
                    $this->session->darkmode = boolval($row->enableDarkMode);
                    $this->session->admin = boolval($row->isAdmin);
                break;
                }
                $this->session->loggedInUser = true;
                $this->session->username = $username;
                redirect($previousPage);
            }
            else {
                $data['alert'] = '<script language="javascript">alert("Log In Failed. Try Again")</script>';
            }
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = 'Log In';

        // active nav
        $data['login'] = 'active';

        $this->load->template('login', $data, false);

        
        $this->session->previousPage = $previousPage;
    }

    public function logout() {
        $this->session->loggedInUser = null;
        $this->session->username = null;
        $this->session->darkmode = null;
        $this->session->admin = null;
        $previousPage = $this->input->post('currentPage');
        $this->session->set_flashdata('logout', true);
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }

    public function toggleDarkMode() {
        if ($this->session->loggedInUser) {
            $username = $this->session->username;
            if ($this->session->darkmode) {
                $this->HomeModel->setDarkmode(0, $username);
                $this->session->darkmode = false;
            }
            else {
                $this->HomeModel->setDarkmode(1, $username);
                $this->session->darkmode = true;
            }
        }
        $previousPage = $this->input->post('currentPage');
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }

    public function toggleAdmin() {
        if ($this->session->loggedInUser) {
            $username = $this->session->username;
            if ($this->session->admin) {
                $this->HomeModel->setAdmin(0, $username);
                $this->session->admin = false;
            }
            else {
                $this->HomeModel->setAdmin(1, $username);
                $this->session->admin = true;
            }
        }
        $previousPage = $this->input->post('currentPage');
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }

    public function returnComments($id = null) {
		//Get the information from a model.
        $results = $this->HomeModel->getComments($id);

		//adapt the header so the response matches the JSON format.
		header('Content-Type: application/json');

		echo json_encode($results);
	}

	public function sendComment() {
		// Retrieve the input post from jQuery/VueJS
		$newUsers = $this->input->post();

		// Responde the data back to the webpage to ensure we received the correct info
		print_r($newUsers);

		// From here we would send the data onwards to a Model for database functions.
	}
  
}
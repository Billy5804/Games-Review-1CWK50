<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Load in your Models below.
        $this->load->model('ReviewsModel');
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
        $data['result'] = $this->ReviewsModel->getReviewedGames();

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">setTimeout(function(){alert("Successfully Logged Out"); document.currentScript.remove();}, 0.2)</script>';
        }

        //Load the view and send the data accross.
        $this->load->template('reviewedGames', $data, false);
    }

    public function gameReviews($slug = NULL)
    {
        //Retrive data from model
        $data['result'] = $this->ReviewsModel->getGameReviews($slug);

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
            $data['alert'] = '<script language="javascript">setTimeout(function(){alert("Successfully Logged Out"); document.currentScript.remove();}, 0.2)</script>';
        }

        // Load the view
        $this->load->template('home', $data, false);
    }

    public function review($slug = NULL, $id = null)
    {
        //Retrive data from model
        $data['result'] = $this->ReviewsModel->getReview($id);

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
            $data['alert'] = '<script language="javascript">setTimeout(function(){alert("Successfully Logged Out"); document.currentScript.remove();}, 0.2)</script>';
        }

        // Load the view
        $this->load->template('review', $data, false);
    }

}
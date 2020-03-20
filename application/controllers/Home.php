<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Load in your Models below.
        $this->load->model('ReviewsModel');
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
        $data['result'] = $this->ReviewsModel->getLatestReviews();

        // prepare alert of logout confirmation if user has just logged out
        if ($this->session->flashdata('logout')) {
            $data['alert'] = '<script language="javascript">setTimeout(function(){alert("Successfully Logged Out"); document.currentScript.remove();}, 0.2)</script>';
        }
        
        //Load the view and send the data accross.
        $this->load->template('Home', $data, false);
    }

    public function search() {

    }

}
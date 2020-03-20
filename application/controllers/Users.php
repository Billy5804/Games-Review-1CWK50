<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Load in your Models below.
        $this->load->model('UserModel');
    }

    public function login() {
        // if the user is already logged in redirect to home
        if ($this->session->loggedInUser) {
            redirect(base_url());
        }

        // store the previous page
        $previousPage = $this->session->previousPage;
        $this->session->previousPage = null;
        if (!empty($this->input->post('currentPage'))) {
            $previousPage = $this->input->post('currentPage');
        }

        // if username/password has been posted store it
        $username = $this->input->post('inputUsername');
        $password = $this->input->post('inputPassword');

        $data = [];

        // check if both username and password were posted
        if (!empty($username) && !empty($password)) {
            // check submitted credentials with model
            $credentialsCheck = $this->UserModel->checkCredentials($username, $password);
            
            // check if the credentials were correct
            if (!empty($credentialsCheck)) {
                // store user details in session
                foreach ($credentialsCheck as $row) {
                    $this->session->darkmode = boolval($row->enableDarkMode);
                    $this->session->admin = boolval($row->isAdmin);
                break;
                }
                $this->session->loggedInUser = true;
                $this->session->username = $username;

                // go back to the last page the user was on before navigating to the login page
                redirect($previousPage);
            }
            else {
                // if login failed alert the user
                $data['alert'] = '<script language="javascript">setTimeout(function(){alert("Log In Failed. Try Again"); document.currentScript.remove();}, 0.2)</script>';
            }
        }

        // Adjust page colours for dark/light mode
        $data = array_merge($data,getColours($this->session->darkmode));

        // Change this to whatever title you wish.
        $data['title'] = 'Log In';

        // active nav
        $data['login'] = 'active';

        //Load the view and send the data accross.
        $this->load->template('login', $data, false);

        // store previous page in session
        $this->session->previousPage = $previousPage;
    }

    public function logout() {
        // clear session user details without clearing the whole session
        // so other session properties can be changed in the same request
        $this->session->loggedInUser = null;
        $this->session->username = null;
        $this->session->darkmode = null;
        $this->session->admin = null;

        // store the page the user logged out from
        $previousPage = $this->input->post('currentPage');

        // set logout to true so the next request can display a logout alert
        $this->session->set_flashdata('logout', true);

        // redirect to the previous page if known
        // if not go to home
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }

    public function userDetails() {
        // get the users details from the session
        $loggedIn = $this->session->loggedInUser;
        $username = $this->session->username;
        $admin = $this->session->admin;
        
        // adapt the header so the response matches the JSON format.
        header('Content-Type: application/json'); 

        // return users details if logged
        if ($loggedIn) {
            $userDetails = array('loggedIn' => $loggedIn, 'username' => $username, 'admin' => $admin);
            // return the users details as json
            echo json_encode($userDetails, true);
        }
        else echo json_encode(array('loggedIn' => false, 'username' => "Unregistered user"));
    }

    public function toggleDarkMode() {
        // check if a user is logged in 
        if ($this->session->loggedInUser) {
            // store the logged in users username
            $username = $this->session->username;

            // if the website is in dark mode swith to light and vice versa
            if ($this->session->darkmode) {
                // send new state to model and change session to light mode
                $this->UserModel->setDarkmode(0, $username);
                $this->session->darkmode = false;
            }
            else {
                // send new state to model and change session to dark mode
                $this->UserModel->setDarkmode(1, $username);
                $this->session->darkmode = true;
            }
        }

        // store the page the user changed the them from
        $previousPage = $this->input->post('currentPage');

        // redirect to the previous page if known
        // if not go to home
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }

    public function toggleAdmin() {
        // check if a user is logged in 
        if ($this->session->loggedInUser) {
            // store the logged in users username
            $username = $this->session->username;

            // if the user is a admin swith to normal user and vice versa
            if ($this->session->admin) {
                // send new state to model and change session to user to an normal
                $this->UserModel->setAdmin(0, $username);
                $this->session->admin = false;
            }
            else {
                // send new state to model and change session to user to an admin
                $this->UserModel->setAdmin(1, $username);
                $this->session->admin = true;
            }
        }
        
        // store the page the user changed the them from
        $previousPage = $this->input->post('currentPage');

        // redirect to the previous page if known
        // if not go to home
        if (!empty($previousPage)) {
            redirect($previousPage);
        }
        else {
            redirect(base_url());
        }
    }
  
}

?>
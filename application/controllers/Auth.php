<?php

/**
 * This Controller is used to controll the authenication of a user
 * This includes checking if they have successfully logged in or registered, to checking if they are logging out and form validation on the login forms
 */


class Auth extends CI_Controller
{
    public function view()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('dashboard');
        }

        $this->load->view('templates/header');
        $this->load->view('includes/assets');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }

    // Register user
    public function register()
    {
        $config = array(
            array('field' => 'firstname', 'label' => 'Firstname', 'rules' => 'trim|required'),
            array('field' => 'surname', 'label' => 'Surname', 'rules' => 'trim|required'),
            array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|callback_check_username_exists'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email_exists|callback_check_email_isvalid'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
            array('field' => 'passwordCheck', 'label' => 'Confirm Password', 'rules' => 'matches[password]'),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'firstname' => form_error('firstname'),
                'surname' => form_error('surname'),
                'username' => form_error('username'),
                'email' => form_error('email'),
                'password' => form_error('password'),
                'passwordCheck' => form_error('passwordCheck'),
            );
        } else {

            // Get username and password
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Register User
            $this->auth_model->register($password);

            // Log user in
            $userID = $this->auth_model->login($username, $password);

            $userData = array(
                'userID' => $userID,
                'username' => $username,
                'loggedIn' => true,
                'isAdmin' => $username == 'adminJSMP' ? true : false
            );

            $this->session->set_userdata($userData);
            $result['error'] = false;
        }
        echo json_encode($result);
    }

    //Log in user
    public function loginUser()
    {
        $config = array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'username' => form_error('username'),
                'password' => form_error('password'),
            );
        } else {

            // Get username and password
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Login user
            $userID = $this->auth_model->login($username, $password);

            if ($userID) {
                // Create session
                $userData = array(
                    'userID' => $userID,
                    'username' => $username,
                    'loggedIn' => true,
                    'isAdmin' => $username == 'adminJSMP' ? true : false
                );

                $this->session->set_userdata($userData);
                $result['error'] = false;
            } else {
                $result['error'] = true;
                $result['msg'] = array(
                    'login_failed' => 'Login is invalid',
                );
            }
        }
        echo json_encode($result);
    }

    // Log user out
    public function logout()
    {
        // Unset user data
        session_destroy();

        redirect('auth/login');
    }

    // Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
        if ($this->auth_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if ($this->auth_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email entered is valid
    public function check_email_isvalid($email)
    {
        $this->form_validation->set_message('check_email_isvalid', 'This is not a valid email address');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}

<?php

/**
 * This model is used to log a user in, add an new user or to check if the user / email already exists
 */

defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
    public function register($password)
    {
        // User data array
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'surname' => $this->input->post('surname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $password,
        );

        // Insert user
        return $this->db->insert('users', $data);
    }

    // Log user in
    public function login($username, $password)
    {
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return $result->row(0)->GUID;
        } else {
            return false;
        }
    }

    // Check username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}

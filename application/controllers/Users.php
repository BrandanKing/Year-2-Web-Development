<?php

/**
 * This Controller is used to manage what the user can do from within the questionnaire page
 * There is a function that allows the admin to search, delete and add a user. A function that is used to return the information on the user
 */


defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'user');
    }

    public function view($page = 'dashboard')
    {
        if (!file_exists(APPPATH . 'views/users/' . $page . '.php')) {
            show_404();
        }

        if (!$this->session->userdata('loggedIn')) {
            redirect('auth/login');
        }

        $this->load->view('templates/header');
        $this->load->view('includes/assets');
        $this->load->view('templates/welcomeMessage');
        $this->load->view('templates/userTable');

        // Only load the charts template to the admin
        if ($this->session->userdata('isAdmin')) {
            $this->load->view('templates/charts');
        }

        $this->load->view('users/dashboard');
        $this->load->view('templates/footer');
    }

    // Show Users
    public function showUsers()
    {
        $query =  $this->user->showUsers();
        if ($query) {
            $result['users']  = $query;
        }
        echo json_encode($result);
    }

    // Add User
    public function addUser()
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

            // Get password
            $password = $this->input->post('password');

            // Register User
            if ($this->auth_model->register($password)) {
                $result['error'] = false;
                $result['msg'] = 'User added successfully';
            }
        }
        echo json_encode($result);
    }

    // Delete User
    public function deleteUser()
    {
        $id = $this->input->post('GUID');
        if ($this->user->deleteUser($id)) {
            $msg['error'] = false;
            $msg['success'] = 'User deleted successfully';
        } else {
            $msg['error'] = true;
        }
        echo json_encode($msg);
    }

    // Update User
    public function updateUser()
    {
        $config = array(

            // User Detail Validation
            array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
            array('field' => 'firstname', 'label' => 'Firstname', 'rules' => 'trim|required'),
            array('field' => 'surname', 'label' => 'Surname', 'rules' => 'trim|required'),
            array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'),
            array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
            array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),
            array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
            array('field' => 'postcode', 'label' => 'Post Code', 'rules' => 'trim|required'),
            array('field' => 'height', 'label' => 'Height', 'rules' => 'trim|required'),
            array('field' => 'weight', 'label' => 'Weight', 'rules' => 'trim|required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email_isvalid'),
            array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'trim|required|callback_mobile_check'),
            array('field' => 'home_telephone', 'label' => 'Home Telephone', 'rules' => 'trim|callback_tel_check'),
            array('field' => 'SMS_YN', 'label' => 'sms contact', 'rules' => 'trim|required'),
            array('field' => 'email_yn', 'label' => 'email contact', 'rules' => 'trim|required'),

            // Next of kin Validation
            array('field' => 'kin_name', 'label' => 'Kin Name', 'rules' => 'trim|required'),
            array('field' => 'kin_relationship', 'label' => 'Kin Relationship', 'rules' => 'trim|required'),
            array('field' => 'kin_telephone', 'label' => 'Kin Telephone', 'rules' => 'trim|required|callback_mobile_check'),

            // Medication Validation
            array('field' => 'Medication_YN', 'label' => 'Medication Status', 'rules' => 'trim|required'),

            // Smoke Status Validation
            array('field' => 'smoke_status', 'label' => 'Smoke Status', 'rules' => 'trim|required'),

            // Alcohol Validation
            array('field' => 'response0', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response1', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response2', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response3', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response4', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response5', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response6', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response7', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response8', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'response9', 'label' => ' ', 'rules' => 'trim|required'),

            // Family Medication History Validation
            array('field' => 'has_cancer', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'has_heart_disease', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'has_stroke', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'has_other', 'label' => ' ', 'rules' => 'trim|required'),

            // Allergy Validation
            array('field' => 'allergy_details', 'label' => ' ', 'rules' => 'trim|required'),

            // Exercise Validation
            array('field' => 'exercise', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'exercise_minutes', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'exercise_days', 'label' => ' ', 'rules' => 'trim|required'),
            array('field' => 'diet', 'label' => ' ', 'rules' => 'trim|required'),
        );

        // Medication Validation
        if ($this->input->post('Medication_YN') == 'yes') {
            array_push($config, array('field' => 'Medication_1', 'label' => 'Your medication', 'rules' => 'trim|required'));
            array_push($config, array('field' => 'medication_frequency_1', 'label' => 'Your medication frequency', 'rules' => 'trim|required'));
            array_push($config, array('field' => 'medication_dosage_1', 'label' => 'Your medication dosage', 'rules' => 'trim|required'));
        }
        // Smoke Status Validation
        if ($this->input->post('smoke_status') == 'Current Smoker') {
            array_push($config, array('field' => 'smoke_type', 'label' => 'Smoke Type', 'rules' => 'trim|required'));
            array_push($config, array('field' => 'start_smoking', 'label' => 'Age you started smoking', 'rules' => 'trim|required'));
            array_push($config, array('field' => 'quit_smoking', 'label' => 'Whether or not youwant support', 'rules' => 'trim|required'));
        }

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {

            $result['error'] = true;
            foreach ($this->input->post() as $key => $val) {
                $result['msg'][$key] = form_error($key);
            }
        } else {

            $id = $this->input->post('GUID');
            $data = array();

            foreach ($this->input->post() as $key => $val) {
                $data[$key] = $val;
            }
            $data['status'] = 'pending';

            // If the smoking table exists for this user it means they have already submitted the questionnaire so run the update user model function, if the smoking table doesn't exists for that user then run the create function to create the required records within the model
            if ($this->user->doesTableExist('smoking')) {
                if ($this->user->updateUser($id, $data)) {
                    $result['error'] = false;
                    $result['success'] = 'Success';
                }
            } else {
                if ($this->user->createQuestionnaire($id, $data)) {
                    $result['error'] = false;
                    $result['success'] = 'Form Submitted';
                }
            }
        }
        echo json_encode($result);
    }

    // Validate Step
    public function validateStep($step)
    {
        if ($step == 1) :
            $config = array(
                array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                array('field' => 'firstname', 'label' => 'Firstname', 'rules' => 'trim|required'),
                array('field' => 'surname', 'label' => 'Surname', 'rules' => 'trim|required'),
                array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'),
                array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),
                array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),
                array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
                array('field' => 'postcode', 'label' => 'Post Code', 'rules' => 'trim|required'),
                array('field' => 'height', 'label' => 'Height', 'rules' => 'trim|required'),
                array('field' => 'weight', 'label' => 'Weight', 'rules' => 'trim|required'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback_check_email_isvalid'),
                array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'trim|required|callback_mobile_check'),
                array('field' => 'home_telephone', 'label' => 'Home Telephone', 'rules' => 'trim|callback_tel_check'),
                array('field' => 'SMS_YN', 'label' => 'sms contact', 'rules' => 'trim|required'),
                array('field' => 'email_yn', 'label' => 'email contact', 'rules' => 'trim|required'),

                array('field' => 'kin_name', 'label' => 'Kin Name', 'rules' => 'trim|required'),
                array('field' => 'kin_relationship', 'label' => 'Kin Relationship', 'rules' => 'trim|required'),
                array('field' => 'kin_telephone', 'label' => 'Kin Telephone', 'rules' => 'trim|required|callback_mobile_check'),
            );
        elseif ($step == 2) :
            $config = array(
                array('field' => 'Medication_YN', 'label' => 'Medication Status', 'rules' => 'trim|required'),
                array('field' => 'smoke_status', 'label' => 'Smoke Status', 'rules' => 'trim|required'),
            );
            if ($this->input->post('Medication_YN') == 'yes') {
                array_push($config, array('field' => 'Medication_1', 'label' => 'Your medication', 'rules' => 'trim|required'));
                array_push($config, array('field' => 'medication_frequency_1', 'label' => 'Your medication frequency', 'rules' => 'trim|required'));
                array_push($config, array('field' => 'medication_dosage_1', 'label' => 'Your medication dosage', 'rules' => 'trim|required'));
            }
            if ($this->input->post('smoke_status') == 'Current Smoker') {
                array_push($config, array('field' => 'smoke_type', 'label' => 'Smoke Type', 'rules' => 'trim|required'));
                array_push($config, array('field' => 'start_smoking', 'label' => 'Age you started smoking', 'rules' => 'trim|required'));
                array_push($config, array('field' => 'quit_smoking', 'label' => 'Whether or not you want support', 'rules' => 'trim|required'));
            };
        elseif ($step == 3) :
            $config = array(
                array('field' => 'response0', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response1', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response2', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response3', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response4', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response5', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response6', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response7', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response8', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'response9', 'label' => ' ', 'rules' => 'trim|required'),
            );
        elseif ($step == 4) :
            $config = array(
                array('field' => 'has_cancer', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'has_heart_disease', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'has_stroke', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'has_other', 'label' => ' ', 'rules' => 'trim|required'),

                array('field' => 'allergy_details', 'label' => ' ', 'rules' => 'trim|required'),

                array('field' => 'exercise', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'exercise_minutes', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'exercise_days', 'label' => ' ', 'rules' => 'trim|required'),
                array('field' => 'diet', 'label' => ' ', 'rules' => 'trim|required'),
            );
        endif;

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {

            $result['error'] = true;
            foreach ($this->input->post() as $key => $val) {
                $result['msg'][$key] = form_error($key);
            }
        } else {
            $result['error'] = false;
            $result['success'] = 'Success';
        }
        echo json_encode($result);
    }

    // Search Users
    public function searchUser()
    {
        $value = $this->input->post('text');
        $query =  $this->user->searchUser($value);
        if ($query) {
            $result['users'] = $query;
        }

        echo json_encode($result);
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

    // Mobile Regex Check, make sure the number is a valid UK phone number
    public function mobile_check($mobile)
    {
        $this->form_validation->set_message('mobile_check', 'This is not a valid UK phone number');
        if (preg_match('/^(\(?(0|\+44)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/', $mobile)) {
            return true;
        } else {
            return false;
        }
    }

    // Tel Regex Check, make sure the number is a valid UK landline
    public function tel_check($tel)
    {
        $this->form_validation->set_message('tel_check', 'This is not a valid UK landline');
        if (preg_match('/\s*\(?(0[1-6]{1}[0-9]{3}\)?[0-9]{6})\s*/', $tel) || !is_null($tel)) {
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

    // Get a list of all the alcohol questions
    public function getAlcoholQuestions()
    {
        $query =  $this->user->alcoholQuestions();
        if ($query) {
            $result['alcohol_questions']  = $query;
        }
        echo json_encode($result);
    }

    // Update the users status
    public function updateStatus()
    {
        $id = $this->input->post('GUID');
        $data = array(
            'status' => $this->input->post('status'),
        );

        if ($this->user->updateStatus($id, $data)) {
            $result['error'] = false;
            $result['success'] = 'Status succesfully updated';
        }
        echo json_encode($result);
    }
}

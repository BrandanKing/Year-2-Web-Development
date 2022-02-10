<?php

/**
 * This model is used to manage the data that will be submitted / returned from the database as part of the form. Whether that is updating a the questionnaire or deleting a users information if your the admin
 */

defined('BASEPATH') or exit('No direct script access allowed');
class Users_model extends CI_Model
{
    // Get the users information
    public function showUsers()
    {

        $this->db->select("users.GUID as GUID, username, title, firstname, surname, dob, gender, marital_status, address, postcode, height, weight, occupation, email, mobile, home_telephone, SMS_YN, email_yn, kin_name, kin_relationship, kin_telephone, status, smoke_status, smoke_type, start_smoking, quit_smoking, Medication_YN, Medication_1, Medication_2, Medication_3, medication_frequency_1, medication_frequency_2, medication_frequency_3, medication_dosage_1, medication_dosage_2, medication_dosage_3, has_cancer, has_heart_disease, has_stroke, has_other, allergy_details, exercise, exercise_minutes, exercise_days, diet");
        $this->db->from('users');
        $this->db->join('smoking', 'users.GUID = smoking.userid', 'LEFT outer');
        $this->db->join('medication', 'users.GUID = medication.userid', 'LEFT outer');
        $this->db->join('medical_history', 'users.GUID = medical_history.userid', 'LEFT outer');
        $this->db->join('allergies', 'users.GUID = allergies.userid', 'LEFT outer');
        $this->db->join('lifestyle', 'users.GUID = lifestyle.userid', 'LEFT outer');

        // If the user isn't the admin then only return the user that has the same ID as them, returning only their data
        if (!$this->session->userdata('isAdmin')) :
            $this->db->where('users.GUID', $this->session->userdata('userID'));
        endif;

        $this->db->order_by('GUID', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $successQuery = array();
            // Add all the alcohol responses from the users back to the query so they are then returned to the Axios call as part of all the other data about the user
            foreach ($query->result_array() as $key => $row) {
                $alcoholResponses =  $this->user->getUsersAlcoholResponse($row['GUID']);
                for ($i = 0; $i < 10; $i++) {
                    $row['response' . $i] = array_key_exists($i, $alcoholResponses) ? $alcoholResponses[$i]['response'] : null;
                    $row['response_score' . $i] = array_key_exists($i, $alcoholResponses) ? $alcoholResponses[$i]['response_score'] : null;
                }
                $successQuery[$key] = $row;
            }

            return $successQuery;
        } else {
            return false;
        }
    }

    // Get the response made by the specific user on the alcohol questions
    public function getUsersAlcoholResponse($userId)
    {
        $this->db->select("questionid, response, response_score");
        $this->db->from('users');
        $this->db->join('alcohol_responses', 'users.GUID = alcohol_responses.userid', 'LEFT outer');
        $this->db->where('users.GUID', $userId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // Get a list of all the alcohol questions and their available responses
    public function alcoholQuestions()
    {
        $this->db->select("Question, TRIM(response0) as 'response0', TRIM(response1) as 'response1', TRIM(response2) as 'response2', TRIM(response3) as 'response3', TRIM(response4) as 'response4'");
        $this->db->from('alcohol_questions');
        $this->db->join('alcohol_options', 'alcohol_questions.optionsid = alcohol_options.GUID', 'LEFT outer');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // Check to see if a certain row exists in the column for a specific user, this uses the userID in the session rather than the one passed by the post method as this will only ever be ran when a form is updated and an admin cannot update another users form only their own
    public function doesTableExist($tablename)
    {
        $this->db->where('userid', $this->session->userdata('userID'));
        $query = $this->db->get($tablename);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Update the users information and return back if their was any effected rows
    public function updateUser($id, $field)
    {
        // Break all the fields out into different variables
        $userFields = array(
            'title'             => $field['title'],
            'firstname'         => $field['firstname'],
            'surname'           => $field['surname'],
            'dob'               => $field['dob'],
            'gender'            => $field['gender'],
            'marital_status'    => $field['marital_status'],
            'address'           => $field['address'],
            'postcode'          => $field['postcode'],
            'height'            => $field['height'],
            'weight'            => $field['weight'],
            'email'             => $field['email'],
            'mobile'            => $field['mobile'],
            'home_telephone'    => $field['home_telephone'],
            'status'            => $field['status'],
            'kin_name'          => $field['kin_name'],
            'kin_relationship'  => $field['kin_relationship'],
            'kin_telephone'     => $field['kin_telephone']
        );
        $medicationFields = array(
            'userid'                    => $id,
            'Medication_YN'             => $field['Medication_YN'],
            'Medication_1'              => $field['Medication_1'],
            'medication_frequency_1'    => $field['medication_frequency_1'],
            'medication_dosage_1'       => $field['medication_dosage_1'],
            'Medication_2'              => $field['Medication_2'],
            'medication_frequency_2'    => $field['medication_frequency_2'],
            'medication_dosage_2'       => $field['medication_dosage_2'],
            'Medication_3'              => $field['Medication_3'],
            'medication_frequency_3'    => $field['medication_frequency_3'],
            'medication_dosage_3'       => $field['medication_dosage_3'],
        );
        $smokingFields = array(
            'userid'        => $id,
            'smoke_status'  => $field['smoke_status'],
            'smoke_type'    => $field['smoke_type'],
            'start_smoking' => $field['start_smoking'],
            'quit_smoking'  => $field['quit_smoking'],
        );
        $alcoholFields = array(
            'userid'    => $id,
        );
        $familyFields = array(
            'userid'            => $id,
            'has_cancer'        => $field['has_cancer'],
            'has_heart_disease' => $field['has_heart_disease'],
            'has_stroke'        => $field['has_stroke'],
            'has_other'         => $field['has_other'],
        );
        $allergyFields = array(
            'userid'            => $id,
            'allergy_details'   => $field['allergy_details'],
        );
        $exerciseFields = array(
            'userid'            => $id,
            'exercise'          => $field['exercise'],
            'exercise_minutes'  => $field['exercise_minutes'],
            'exercise_days'     => $field['exercise_days'],
            'diet'              => $field['diet'],
        );
        $rowsEffected = false;

        $this->db->where('GUID', $id);
        $this->db->update('users', $userFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->update('medication', $medicationFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->update('smoking', $smokingFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->update('allergies', $allergyFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->update('medical_history', $familyFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->update('lifestyle', $exerciseFields);

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        for ($i = 0; $i < 10; $i++) {
            $alcoholFields['response']          = $field['response' . $i];
            $alcoholFields['response_score']    = $field['response_score' . $i];

            $this->db->where('userid', $id);
            $this->db->where('questionid', $i + 1);
            $this->db->update('alcohol_responses', $alcoholFields);

            $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;
        }

        return $rowsEffected;
    }

    // Inserts the users response back into the questionnair
    public function createQuestionnaire($id, $field)
    {
        $userFields = array(
            'title'             => $field['title'],
            'firstname'         => $field['firstname'],
            'surname'           => $field['surname'],
            'dob'               => $field['dob'],
            'gender'            => $field['gender'],
            'marital_status'    => $field['marital_status'],
            'address'           => $field['address'],
            'postcode'          => $field['postcode'],
            'height'            => $field['height'],
            'weight'            => $field['weight'],
            'email'             => $field['email'],
            'mobile'            => $field['mobile'],
            'home_telephone'    => $field['home_telephone'],
            'status'            => $field['status'],
            'kin_name'          => $field['kin_name'],
            'kin_relationship'  => $field['kin_relationship'],
            'kin_telephone'     => $field['kin_telephone']
        );
        $medicationFields = array(
            'userid'                    => $id,
            'Medication_YN'             => $field['Medication_YN'],
            'Medication_1'              => $field['Medication_1'],
            'medication_frequency_1'    => $field['medication_frequency_1'],
            'medication_dosage_1'       => $field['medication_dosage_1'],
            'Medication_2'              => $field['Medication_2'],
            'medication_frequency_2'    => $field['medication_frequency_2'],
            'medication_dosage_2'       => $field['medication_dosage_2'],
            'Medication_3'              => $field['Medication_3'],
            'medication_frequency_3'    => $field['medication_frequency_3'],
            'medication_dosage_3'       => $field['medication_dosage_3'],
        );
        $smokingFields = array(
            'userid'        => $id,
            'smoke_status'  => $field['smoke_status'],
            'smoke_type'    => $field['smoke_type'],
            'start_smoking' => $field['start_smoking'],
            'quit_smoking'  => $field['quit_smoking'],
        );
        $alcoholFields = array(
            'userid' => $id,
        );
        $familyFields = array(
            'userid'            => $id,
            'has_cancer'        => $field['has_cancer'],
            'has_heart_disease' => $field['has_heart_disease'],
            'has_stroke'        => $field['has_stroke'],
            'has_other'         => $field['has_other'],
        );
        $allergyFields = array(
            'userid'            => $id,
            'allergy_details'   => $field['allergy_details'],
        );
        $exerciseFields = array(
            'userid'            => $id,
            'exercise'          => $field['exercise'],
            'exercise_minutes'  => $field['exercise_minutes'],
            'exercise_days'     => $field['exercise_days'],
            'diet'              => $field['diet'],
        );
        $this->db->where('GUID', $id);
        $this->db->update('users', $userFields);

        $this->db->insert('medication', $medicationFields);
        $this->db->insert('smoking', $smokingFields);
        $this->db->insert('allergies', $allergyFields);
        $this->db->insert('medical_history', $familyFields);
        $this->db->insert('lifestyle', $exerciseFields);

        for ($i = 0; $i < 10; $i++) {
            $alcoholFields['questionid']        = $i + 1;
            $alcoholFields['response']          = $field['response' . $i];
            $alcoholFields['response_score']    = $field['response_score' . $i];
            $this->db->insert('alcohol_responses', $alcoholFields);
        }

        return true;
    }

    // Delete a user and all their data within the DB
    public function deleteUser($id)
    {
        $rowsEffected = false;

        $this->db->where('GUID', $id);
        $this->db->delete('users');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('medication');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('smoking');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('medical_history');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('lifestyle');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('allergies');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        $this->db->where('userid', $id);
        $this->db->delete('alcohol_responses');

        $rowsEffected = $this->db->affected_rows() > 0 ? true : $rowsEffected;

        return $rowsEffected;
    }

    // Search for a user and return their information
    public function searchUser($match)
    {
        $field = array('firstname', 'surname', 'email', 'username');

        $this->db->select("users.GUID as GUID, username, title, firstname, surname, dob, gender, marital_status, address, postcode, height, weight, occupation, email, mobile, home_telephone, SMS_YN, email_yn, kin_name, kin_relationship, kin_telephone, status, smoke_status, smoke_type, start_smoking, quit_smoking, Medication_YN, Medication_1, Medication_2, Medication_3, medication_frequency_1, medication_frequency_2, medication_frequency_3, medication_dosage_1, medication_dosage_2, medication_dosage_3, has_cancer, has_heart_disease, has_stroke, has_other, allergy_details, exercise, exercise_minutes, exercise_days, diet");
        $this->db->from('users');
        $this->db->join('smoking', 'users.GUID = smoking.userid', 'LEFT outer');
        $this->db->join('medication', 'users.GUID = medication.userid', 'LEFT outer');
        $this->db->join('medical_history', 'users.GUID = medical_history.userid', 'LEFT outer');
        $this->db->join('allergies', 'users.GUID = allergies.userid', 'LEFT outer');
        $this->db->join('lifestyle', 'users.GUID = lifestyle.userid', 'LEFT outer');

        $this->db->like('concat(' . implode(',', $field) . ')', $match);
        $this->db->order_by('GUID', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // Update the status of a users form
    public function updateStatus($id, $field)
    {
        $this->db->where('GUID', $id);
        $this->db->update('users', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

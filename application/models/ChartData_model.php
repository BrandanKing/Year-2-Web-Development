<?php

/**
 * This model is used to return the data that is required to create the charts
 */

defined('BASEPATH') or exit('No direct script access allowed');
class ChartData_model extends CI_Model
{
	public function userStatus()
	{
		$this->db->select("status, count(GUID) as 'users'");
		$this->db->from('users');
		$this->db->group_by('status');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function alcoholData()
	{
		$this->db->select("Question, CAST(avg(response_score) AS DECIMAL(10,0)) as 'average_response_score'");
		$this->db->from('alcohol_responses');
		$this->db->join('alcohol_questions', 'alcohol_questions.GUID = questionid', 'inner');
		$this->db->group_by('questionid');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function smokersData()
	{
		$smokerTypes = array('Current Smoker', 'Ex-smoker', 'Never Smoked');
		$results = array();
		foreach ($smokerTypes as $smoker) {
			$this->db->reset_query();
			$this->db->select("MONTHNAME(dob) as 'month',  smoke_status, count(userid) as 'number_people'");
			$this->db->from('users');
			$this->db->join('smoking', 'users.GUID = smoking.userid', 'inner');
			$this->db->group_by('EXTRACT(MONTH FROM dob), smoke_status');
			$this->db->where('smoke_status', $smoker);
			$query = $this->db->get();

			$smokerKey = preg_replace('/\s*/', '', $smoker);
			$smokerKey = str_replace('-', '', $smokerKey);
			$smokerKey = strtolower($smokerKey);

			$results[$smokerKey] = $query->result();
		}
		return $results;
	}
	public function exerciseData()
	{
		$this->db->select("exercise_days, CAST(avg(exercise_minutes) AS DECIMAL(10,0)) as 'average_minutes_session'");
		$this->db->from('lifestyle');
		$this->db->group_by('exercise_days');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}

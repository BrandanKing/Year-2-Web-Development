<?php

/**
 * This Controller is used to controll the data that is returned to the http call to generate the charts that will be visible to the Admin
 */

defined('BASEPATH') or exit('No direct script access allowed');
class ChartData extends CI_Controller
{
	// Load in the chartdata model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('chartdata_model', 'chartdata');
	}

	// Return a number of how many users have each status
	public function userStatus()
	{
		$query['status'] =  $this->chartdata->userStatus();
		echo json_encode($query);
	}

	// Return the average score of each alcohol question
	public function averageAlcoholScore()
	{
		$query['score'] =  $this->chartdata->alcoholData();
		echo json_encode($query);
	}

	// Return the number of smokers based on what they smoke and the month they where born
	public function numberOfSmokers()
	{
		$query =  $this->chartdata->smokersData();
		echo json_encode($query);
	}

	// Get the average number of minutes per session depending on how many days the user says they exercise
	public function averageMinsPerSession()
	{
		$query['exercise'] =  $this->chartdata->exerciseData();
		echo json_encode($query);
	}
}

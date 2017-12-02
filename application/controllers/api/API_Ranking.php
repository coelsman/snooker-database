<?php
require_once 'SNK_Api.php';

class API_Ranking extends SNK_Api {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Rankings_m'));
	}

	public function get () {
		echo json_encode($this->Rankings_m->get());
	}
}
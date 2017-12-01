<?php
require_once 'SNK_Api.php';

class API_Tournament extends SNK_Api {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Seasons_m'));
	}

	public function get () {
		echo json_encode($this->Seasons_m->get());
	}
}
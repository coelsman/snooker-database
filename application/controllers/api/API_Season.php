<?php
require_once 'SNK_Api.php';

class API_Season extends SNK_Api {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Seasons_m'));
	}

	public function get () {
		echo json_encode($this->Seasons_m->get());
	}

	public function tournament ($seasonUuid = '') {
		echo json_encode($this->Seasons_m->filterTournament($seasonUuid));
	}
}
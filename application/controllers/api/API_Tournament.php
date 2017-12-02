<?php
require_once 'SNK_Api.php';

class API_Tournament extends SNK_Api {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Tournaments_m'));
	}

	public function get () {
		echo json_encode($this->Tournaments_m->get());
	}

	public function get_type () {
		echo json_encode($this->Tournaments_m->getTypes());
	}

	public function insert () {
		if ($this->input->post()) {
			$status = $this->Tournaments_m->insert($this->input->post());
		} else {
			$status = false;
		}
		echo json_encode(array(
			'status' => $status
		));
	}

	public function season ($tournamentUuid, $seasonUuid) {
		if ($tournamentUuid && $seasonUuid) {
			echo json_encode($this->Tournaments_m->detailBySeasonUuid($tournamentUuid, $seasonUuid));
		} else {
			echo json_encode(array('status' => false));
		}
	}

	public function update_season ($tournamentUuid, $seasonUuid) {
		if ($tournamentUuid && $seasonUuid && $this->input->post()) {
			echo json_encode($this->Tournaments_m->updateBySeasonUuid($tournamentUuid, $seasonUuid, $this->input->post()));
		} else {
			echo json_encode(array('status' => false));
		}
	}

	public function player ($tournamentUuid, $seasonUuid) {
		echo json_encode($this->Tournaments_m->getPlayers($tournamentUuid, $seasonUuid));
	}

	public function update_player ($tournamentUuid, $seasonUuid) {
		echo json_encode($this->Tournaments_m->updatePlayer($tournamentUuid, $seasonUuid, $this->input->post()));
	}
}
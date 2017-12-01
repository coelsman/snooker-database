<?php
require_once 'SNK_Api.php';

class API_Player extends SNK_Api {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Players_m'));
	}

	public function get () {
		// echo Uuid::uuid4()->toString();
		// die;
		echo json_encode($this->Players_m->filter());
	}

	public function detail ($uuid) {
		// echo Uuid::uuid4()->toString();
		// die;
		echo json_encode($this->Players_m->detailByUuid($uuid));
	}

	public function insert () {
		if ($this->input->post()) {
			$status = $this->Players_m->insert($this->input->post());
		} else {
			$status = false;
		}

		echo json_encode(array(
			'status' => $status
		));
	}

	public function update ($uuid) {
		if ($this->input->post()) {
			$status = $this->Players_m->update($uuid, $this->input->post());
		} else {
			$status = false;
		}

		echo json_encode(array(
			'status' => $status
		));
	}
}
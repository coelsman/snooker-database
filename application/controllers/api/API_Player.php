<?php
require_once 'SNK_Api.php';

use Ramsey\Uuid\Uuid;

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
}
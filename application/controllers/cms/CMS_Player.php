<?php
require_once 'SNK_Cms.php';

use Ramsey\Uuid\Uuid;

class CMS_Player extends SNK_Cms {
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
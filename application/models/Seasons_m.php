<?php
use Ramsey\Uuid\Uuid;

class Seasons_m extends CI_Model {
	public function __construct () {
		parent::__construct();
	}

	public function get () {
		return $this->db
			->select('uuid, name')
			->from('seasons')
			->get()->result();
	}

	public function getByUuid ($uuid) {
		return $this->db
			->from('seasons')
			->where('uuid', $this->db->escape_str($uuid))
			->get()->row();
	}

	public function getIdByUuid ($uuid) {
		$obj = $this->getByUuid($uuid);

		return $obj ? $obj->uuid : null;
	}

	public function getTournaments ($uuid) {
		$obj = $this->getByUuid($uuid);

		if ($obj) {
			$this->load->model('Tournaments_m');

			$tournaments = $this->Tournaments_m->getBySeason($obj->id);
		} else $tournaments = array();

		$obj->tournaments = $tournaments;

		return $obj;
	}
}
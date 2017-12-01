<?php
use Ramsey\Uuid\Uuid;

class Tournaments_m extends CI_Model {
	public function __construct () {
		parent::__construct();
	}

	public function get ($linkWithSeason = false) {
		return $this->db
			->select('uuid, name')
			->from('tournaments')
			->get()->result();
	}

	public function getByUuid ($uuid) {
		return $this->db
			->from('tournaments')
			->where('uuid', $this->db->escape_str($uuid))
			->get()->row();
	}

	public function getIdByUuid ($uuid) {
		$obj = $this->getByUuid($uuid);

		return $obj ? $obj->uuid : null;
	}

	public function getBySeason ($seasonId) {
		return $this->db
			->where('season_id', intval($seasonId))
			->get('tournaments')->result();
	}
}
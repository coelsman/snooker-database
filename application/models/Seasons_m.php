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

		return $obj ? $obj->id : null;
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

	public function filterTournament ($uuid) {
		$seasonId = $this->getIdByUuid($uuid);

		if ($seasonId) {
			return $this->db
				->select('T.uuid tournament_uuid, S.uuid season_uuid, TS.alias, T.name, TS.tournament_type, TS.venue')
				->from('tournaments_seasons TS')
				->join('tournaments T', 'T.id = TS.tournament_id')
				->join('seasons S', 'S.id = TS.season_id')
				->where('TS.season_id', $seasonId)
				->get()->result();
		} else return array();
	}
}
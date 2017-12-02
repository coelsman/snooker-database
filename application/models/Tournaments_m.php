<?php
use Ramsey\Uuid\Uuid;

class Tournaments_m extends CI_Model {
	public function __construct () {
		parent::__construct();

		$this->load->model(array('Seasons_m', 'Players_m'));
	}

	public function get ($linkWithSeason = false) {
		return $this->db
			->select('uuid, name')
			->from('tournaments')
			->get()->result();
	}

	public function getTypes () {
		return $this->db
			->from('tournament_types')
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

		return $obj ? $obj->id : null;
	}

	public function getBySeason ($seasonId) {
		return $this->db
			->where('season_id', intval($seasonId))
			->get('tournaments')->result();
	}

	public function getPlayers ($tournamentUuid, $seasonUuid, $getRawId = false) {
		$seasonId = $this->Seasons_m->getIdByUuid($seasonUuid);
		$tournamentId = $this->getIdByUuid($tournamentUuid);
		// $selectStr = $getRawId ? ''

		return $this->db
			->select('P.uuid player_uuid, PT.ranking_id')
			->from('players_tournaments PT')
			->join('players P', 'P.id = PT.player_id')
			->join('tournaments_seasons TS', 'PT.tournament_season_id = TS.id')
			->where('TS.tournament_id', $tournamentId)
			->where('TS.season_id', $seasonId)
			->get()->result();
	}

	public function detailBySeasonUuid ($tournamentUuid, $seasonUuid, $getRawId = false) {
		$selectStr = $getRawId ? ', TS.tournament_id, TS.season_id' : '';

		$obj = $this->db
			->select('T.uuid tournament_uuid, S.uuid season_uuid, T.name, TS.tournament_type, TS.alias, TS.venue, TS.prize_funds'.$selectStr)
			->from('tournaments T')
			->join('tournaments_seasons TS', 'T.id = TS.tournament_id')
			->join('seasons S', 'TS.season_id = S.id')
			->where('S.uuid', $this->db->escape_str($seasonUuid))
			->where('T.uuid', $this->db->escape_str($tournamentUuid))
			->get()->row();

		if ($obj) {
			$obj->prize_funds = json_decode($obj->prize_funds);
		}

		return $obj;
	}

	public function updateBySeasonUuid ($tournamentUuid, $seasonUuid, $data) {
		$obj = $this->detailBySeasonUuid($tournamentUuid, $seasonUuid, true);

		if ($obj) {
			return $this->db
				->where('tournament_id', $obj->tournament_id)
				->where('season_id', $obj->season_id)
				->update('tournaments_seasons', array(
					'tournament_type' => @intval($data['tournament_type']),
					'alias'           => @$this->db->escape_str($data['alias']),
					'venue'           => @$this->db->escape_str($data['venue']),
					'prize_funds'     => @json_encode($data['prize_funds']),
				));
		} else {
			return $this->db
				->insert('tournaments_seasons', array(
					'tournament_id'   => $this->getIdByUuid($tournamentUuid),
					'season_id'       => $this->Seasons_m->getIdByUuid($seasonUuid),
					'tournament_type' => @intval($data['tournament_type']),
					'alias'           => @$this->db->escape_str($data['alias']),
					'venue'           => @$this->db->escape_str($data['venue']),
					'prize_funds'     => @json_encode($data['prize_funds']),
				));
		}
	}

	public function insert ($data) {
		return $this->db->insert('tournaments', array(
			'uuid' => Uuid::uuid4()->toString(),
			'name' => @$this->db->escape_str($data['name'])
		));
	}

	public function getByTournamentSeasonPlayer ($tournamentUuid, $seasonUuid, $playerUuid) {
		$this->seasonId     = $this->Seasons_m->getIdByUuid($seasonUuid);
		$this->tournamentId = $this->getIdByUuid($tournamentUuid);
		$this->playerId     = $this->Players_m->getIdByUuid($playerUuid);

		return $this->db
			->from('players_tournaments PT')
			->join('players P', 'P.id = PT.player_id')
			->join('tournaments_seasons TS', 'PT.tournament_season_id = TS.id')
			->where('TS.tournament_id', $tournamentId)
			->where('TS.season_id', $seasonId)
			->where('PT.player_id', $playerId)
			->get()->row();
	}

	public function updatePlayer ($tournamentUuid, $seasonUuid, $data) {
		$objectExist = $this->getByTournamentSeasonPlayer($tournamentUuid, $seasonUuid, $data['player']);

		if (!$objectExist) {
			// return $this->db
			// 	->insert('players_tournaments', array(
			// 		'player_id' => $this->playerId,
			// 		'tournament_season_id' => $
			// 	));
		}
	}
}
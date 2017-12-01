<?php
use Ramsey\Uuid\Uuid;

class Players_m extends CI_Model {
	public function __construct () {
		parent::__construct();
	}

	public function filter () {
		return $this->db
			->from('players P')
			->join('player_profiles PP', 'P.id = PP.player_id')
			->get()->result();
	}

	public function detailByUuid ($uuid) {
		return $this->db
			->from('players P')
			->join('player_profiles PP', 'P.id = PP.player_id')
			->where('P.uuid', $this->db->escape_str($uuid))
			->get()->row();
	}

	public function insert ($data) {
		$this->db->trans_start();
		$dataPlayer = array(
			'uuid'      => Uuid::uuid4()->toString(),
			'full_name' => @$this->db->escape_str($data['full_name']),
			'avatar'    => null
		);
		$dataProfile = array(
			'nationality'     => @intval($data['nationality']),
			'year_of_birth'   => @intval($data['year_of_birth']),
			'year_of_death'   => @intval($data['year_of_death']),
			'place_of_birth'  => @$this->db->escape_str($data['place_of_birth']),
			'highest_ranking' => @intval($data['highest_ranking']),
			'century_breaks'  => @intval($data['century_breaks']),
			'retired_year'    => @intval($data['retired_year']),
			'career_status'   => @$this->db->escape_str($data['career_status'])
		);

		$this->db->insert('players', $dataPlayer);
		$dataProfile['player_id'] = $this->db->insert_id();
		$this->db->insert('player_profiles', $dataProfile);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return false;
		}  else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function update ($uuid, $data) {
		$playerObject = $this->detailByUuid($uuid);

		$this->db->trans_start();
		$dataPlayer = array(
			'full_name' => @$this->db->escape_str($data['full_name']),
			'avatar'    => null
		);
		$dataProfile = array(
			'nationality'     => @intval($data['nationality']),
			'year_of_birth'   => @intval($data['year_of_birth']),
			'year_of_death'   => @intval($data['year_of_death']),
			'place_of_birth'  => @$this->db->escape_str($data['place_of_birth']),
			'highest_ranking' => @intval($data['highest_ranking']),
			'century_breaks'  => @intval($data['century_breaks']),
			'retired_year'    => @intval($data['retired_year']),
			'career_status'   => @$this->db->escape_str($data['career_status'])
		);

		$this->db
			->where('id', $playerObject->id)
			->update('players', $dataPlayer);

		$this->db
			->where('player_id', $playerObject->id)
			->update('player_profiles', $dataProfile);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return false;
		}  else {
			$this->db->trans_commit();
			return true;
		}
	}
}
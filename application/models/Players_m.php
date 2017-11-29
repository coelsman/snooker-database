<?php
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
}
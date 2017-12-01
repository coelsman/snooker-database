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
}
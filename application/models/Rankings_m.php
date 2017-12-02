<?php
use Ramsey\Uuid\Uuid;

class Rankings_m extends CI_Model {
	public function __construct () {
		parent::__construct();
	}

	public function get () {
		return $this->db
			->from('rankings')
			->get()->result();
	}
}
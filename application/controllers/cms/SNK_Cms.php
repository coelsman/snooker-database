<?php
class SNK_Cms extends CI_Controller {
	public $data = array();
	public function __construct () {
		parent::__construct();

		$classCalling = strtolower($this->router->fetch_class());
		$methodCalling = strtolower($this->router->fetch_method());

		$this->data['breadcrumb'] = array(array(
			'title' => 'Home',
			'url' => 'admin/dashboard',
			'icon' => 'fa fa-home'
		));
	}

	public function index () {
		$this->load->view('cms/partials/main');
	}
}
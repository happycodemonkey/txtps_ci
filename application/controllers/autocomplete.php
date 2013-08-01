<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller {
	public function index()
	{
		$this->load->view('autocomplete');
	}

	public function anamod($filter = null) {
		$this->load->model('autocomplete_model');
		$filter = $this->input->post('filter');

		$rows = $this->autocomplete_model->GetAnamodColumns($filter);
		$json = array();
		foreach ($rows as $row) {
			array_push($json, $row->Field);
		}

		print json_encode($json);
	}
}

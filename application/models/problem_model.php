<?php

	class Generator_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_problems() {
			return $this->db->get('product');
		}
	}
?>

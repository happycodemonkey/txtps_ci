<?php

	class Autocomplete_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function GetAnamodColumns($filter = null) {
			if ($filter) {
				$filter = " LIKE '%" . $filter . "%'";	
			}
			
			return $this->db->query("SHOW COLUMNS FROM anamod_data" . $filter)->result();
		}

	}
?>

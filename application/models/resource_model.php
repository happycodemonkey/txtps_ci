<?php
	class Resource_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_resource($resource, $type, $key) {
			$this->db->where('resource_type', $type);
			$this->db->where('resource_id', $key);
			return $this->db->get($resource);
		}
	}
?>

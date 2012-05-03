<?php
	class Resource_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_resources_by_resource_id($resource, $type, $key) {
			$this->db->where('resource_type', $type);
			$this->db->where('resource_id', $key);
			return $this->db->get($resource);
		}

		function get_resource_by_id($resource, $key) {
			$this->db->where('id', $key);
			return $this->db->get($resource);
		}

		function add_resource($resource, $new_resource) {
			return $this->db->insert($resource, $new_resource);
		}

		function delete_resource($resource, $key) {
			return $this->db->delete($resource, array('id' => $new_resource));
		}
	}
?>

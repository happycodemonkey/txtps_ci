<?php
	class Resource_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_resources_by_reference_id($resource_type, $reference, $reference_id) {
			// resource type: image or file
			// reference type: collection, generator, or file
			$this->db->where('resource_type', $resource_type);
			$this->db->where('reference_type', $reference);
			$this->db->where('reference_id', $reference_id);
			return $this->db->get('resource');
		}

		function get_resource_by_id($resource_id) {
			$this->db->where('id', $resource_id);
			return $this->db->get('resource');
		}

		function add_resource($new_resource) {
			return $this->db->insert('resource', $new_resource);
		}

		function delete_resource($resource_id) {
			return $this->db->delete('resource', array('id' => $resource_id));
		}
	}
?>

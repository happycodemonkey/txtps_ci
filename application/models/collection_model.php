<?php
	class Collection_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function create_collection($collection_name = 'New Collection', $collection_description = 'New Collection Description') {
			$data = array(
				'name' => $collection_name,
				'description' => $collection_description
			);

			return $this->db->insert('collection', $data);
		}

		function delete_collection($collection_id) {
			return $this->db->delete('collection', array('id' => $collection_id)); 
		}

		function get_collection($collection_id = null) {
			if ($collection_id) {
				$this->db->where('id', $collection_id);
			}
			return $this->db->get('collection');
		}
	}
?>

<?php
	class Collection_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function create_collection($new_collection) {
			$this->db->insert('collection', $new_collection);
			return $this->db->select('last_insert_id() as id')->limit(1)->get('collection');
		}

		function delete_collection($collection_id) {
			return $this->db->delete('collection', array('id' => $collection_id)); 
		}

		function get_collection($collection_id = null, $limit = null) {
			if ($collection_id) {
				$this->db->where('id', $collection_id);
			}

			if ($limit) {
				$this->db->limit($limit);
			}
			return $this->db->get('collection');
		}
		
		function get_recent_collections() {
			$this->db->limit(10);
			$this->db->order_by('id', 'desc');
			return $this->db->get('collection');
		}

		function update_collection($updated_collection, $collection_id) {
			$this->db->where('id', $collection_id);
			$this->db->update('collection', $updated_collection);
			return $collection_id;
		}
	}
?>

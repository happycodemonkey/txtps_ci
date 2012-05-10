<?php

	class Generator_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_num_generators($collection_id) {
			$this->db->select('collection_id, count(distinct id) as num_gens');
			$this->db->where('collection_id', $collection_id);
			$this->db->group_by('collection_id');
			return $this->db->get('generator');
		}

		function get_generator($filter = null, $key = null, $limit = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}

			if ($limit) {
				$this->db->limit($limit);
			}
			$this->db->order_by('collection_id');
			return $this->db->get('generator');
		}

		function delete_generator($generator_id) {
			return $this->db->delete('generator', array('id' => $generator_id));
		}

		function add_generator($new_generator) {
			$this->db->insert('generator', $new_generator);
			return $this->db->select('last_insert_id() as id')->limit(1)->get('generator');
		}

		function update_generator($updated_generator, $generator_id) {
			$this->db->where('id', $generator_id);
			return $this->db->update('generator', $updated_generator);
		}
	}
?>

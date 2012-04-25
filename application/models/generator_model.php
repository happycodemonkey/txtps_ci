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

		function get_generator($filter = null, $key = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			$this->db->order_by('collection_id');
			return $this->db->get('generator');
		}

		function delete_generator($generator_id) {
			return $this->db->delete('generator', array('id' => $generator_id));
		}

		function add_generator($new_generator) {
			return $this->db->insert('generator', $new_generator);
		}

		function get_arguments($generator_id) {
			$this->db->where('generator_id', $generator_id);
			return $this->db->get('arguments');
		}
	}
?>

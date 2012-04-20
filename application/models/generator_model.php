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

		function get_generators($filter, $key) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			$this->db->order_by('collection_id');
			return $this->db->get('generator');
		}

	}
?>

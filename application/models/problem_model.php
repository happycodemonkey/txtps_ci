<?php

	class Problem_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_problem($filter = null, $key = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			} else if ($filter) {
				$this->db->where('id', $filter);
			}
			$this->db->order_by('generator_id');
			return $this->db->get('product');
		}

		function delete_problem($problem_id) {
			return $this->db->delete('product', array($id => $problem_id));
		}

		function add_problem($new_problem) {
			$this->db->insert('product', $new_problem);
			return $this->db->select('last_insert_id() as problem_id')->limit(1)->get('product');
		}

	}
?>

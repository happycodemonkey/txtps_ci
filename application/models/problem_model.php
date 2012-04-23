<?php

	class Problem_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_problems($filter = null, $key = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			$this->db->order_by('generator_id');
			return $this->db->get('product');
		}
	}
?>

<?php
	class Argument_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_generator_argument($filter = null, $key = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			return $this->db->get('arguments');
		}

		function add_generator_argument($new_argument) {
			return $this->db->insert('arguments', $new_argument);
		}

		function delete_generator_argument($argument_id) {
			return $this->db->delete('arguments', array('id'=>$argument_id));
		}

		function update_generator_argument($updated_argument, $argument_id) {
			$this->db->where('id', $argument_id);
			return $this->db->update('arguments', $updated_argument);
		}

		function add_problem_argument($new_problem_argument) {
			$this->db->insert('problem_argument', $new_problem_argument);
			return $this->db->select('last_insert_id() as problem_argument_id')->limit(1)->get('problem_argument');
		}

		function get_problem_argument($filter = null, $key = null, $filter2 = null, $key2 = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			if ($filter2 && $key2) {
				$this->db->where($filter2, $key2);
			}
			return $this->db->get('problem_argument');
		}

		function delete_problem_argument($problem_argument_id) {
			return $this->db->delete('problem_argument', array('id' => $problem_argument_id));
		}

		function update_problem_argument($updated_argument, $problem_argument_id) {
			$this->db->where('id', $problem_argument_id);
			return $this->db->update('problem_argument', $updated_argument);
		}

	}
?>

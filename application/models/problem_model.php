<?php

	class Problem_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		function get_problem($filter = null, $key = null, $limit = null) {
			if ($filter && $key) {
				$this->db->where($filter, $key);
			}
			
			if ($limit) {
				$this->db->limit($limit);
			}
			$this->db->order_by('generator_id');
			return $this->db->get('problem');
		}

		function delete_problem($problem_id) {
			return $this->db->delete('problem', array($id => $problem_id));
		}

		function add_problem($new_problem) {
			$this->db->insert('problem', $new_problem);
			return $this->db->select('last_insert_id() as id')->limit(1)->get('problem');
		}

		function update_problem($updated_problem, $problem_id) {
			$this->db->where('id', $problem_id);
			return $this->db->update('problem', $updated_problem);
		}

		function search_problem($variable, $range) {
			$this->db->select('`problem`.`id`,
				`problem`.`identifier` from `problem`
				left join `anamod_data` on `anamod_data`.`problem-id` = `problem`.`id`',
				FALSE
			);
		
			if ($range['less_than'] != '') {
				$this->db->where($variable . ' <= ', 
					(int) $range['less_than']); 
			}

			if ($range['greater_than'] != '') {
				$this->db->where($variable . ' >= ', 
					(int) $range['greater_than']); 					
			}

			$this->db->group_by('problem.identifier');

			return $this->db->get();
		}
	}
?>

<div class='site_body'>
<h1>Search Problems</h1>
<?php

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');
	echo form_open_multipart('problems/search');
	echo form_hidden('search_problems', 'yes');

	echo form_label('<b>*Problem variable:</b><br />'); 
	echo form_input('problem_variable', 
		$this->input->post('problem_variable') ?  
		$this->input->post('problem_variable') : 
		'');

	echo "<br /><br />";
	echo "<b>Select Range:</b><br />";
	echo form_label('<b>Problem variable is less than:</b><br />'); 
	echo form_input('value_less_than', 
		$this->input->post('value_less_than') ?  
		$this->input->post('value_less_than') : 
		'');
	echo "<br />";
	echo form_label('<b>AND</b>'); 
	echo form_radio('and_or', 'AND', $this->input->post('and_or') == 'AND' ? TRUE : FALSE);
	echo form_label('<b>OR</b>'); 
	echo form_radio('and_or', 'OR', $this->input->post('and_or') == 'OR' ? TRUE : FALSE);
	echo "<br />";
	echo form_label('<b>Problem variable is greater than:</b><br />'); 
	echo form_input('value_greater_than', 
		$this->input->post('value_greater_than') ?  
		$this->input->post('value_greater_than') : 
		'');

	echo "<br /><br />";
	echo form_submit('submit', 'Search Problems');
	echo form_close();

?>
<h1>Results</h1>
<?php
	if (isset($problems)) {
?>
	<table width="100%">
		<thead>
		<th align='left'>Identifier</th>
		<th align='left'>Name</th>
	`	<th align='left'>Description</th>
		<th align='left'>Value</th>
		</thead>
		<tbody>
<?php
		foreach ($problems as $problem) {
			print "<tr>";
			print "<td><a href='profile/" . $problem->id . "'>" . $problem->identifier . "</a></td>";
			print "<td>" . $problem->name . "</td>";
			print "<td>" . $problem->description . "</td>";
			print "<td>" . $problem->value . "</td>";
			print "</tr>";
		}
?>

		</tbody>
	</table>
<?php
	}
?>
</div>

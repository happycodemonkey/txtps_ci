<div class='site_body'>
<script>
$(document).ready(function() {
	function addFields() {
		var old_num = $('input[name=num_vars]').val();
		var num = parseInt($('input[name=num_vars]').val()) + 1;
		
		$('#variable_form').append($('.field_set').last().clone());
		$('.field_set').last().children().each( function() {
			if ($(this).is('input') || $(this).is('select')) {
				$(this).attr('name', $(this).attr('name').replace(old_num, num));
				$(this).val('');
			}		
		});

		$('input[name=num_vars]').val(num);
	};

	$('#add_vars').click( function() {
		addFields();		
	});
});
</script>
<h1>Search Problems</h1>
<?php

	$this->load->helper('form');
	echo form_open_multipart('problems/search');
	echo form_hidden('search_problems', 'yes');

	echo "<div id='variable_form'>";
	echo form_hidden('num_vars', $num_vars);
	
	$i = 0;
	while ($i < $num_vars) {
		$a = $i+1;
		echo "<div class='field_set'>";
		echo form_label('<b>*Problem variable:</b><br />');
		echo form_dropdown('problem_variable_' . $a, $dropdown_options);

		echo "<br /><br />";
		echo "<b>Select Range:</b><br />";
		echo form_label('<b>Problem variable is less than:</b><br />'); 
		echo form_input('value_less_than_' . $a, 
			$this->input->post('value_less_than_' . $a) ?  
			$this->input->post('value_less_than_' . $a) : 
			'');
		echo "<br />";
		echo form_label('<b>Problem variable is greater than:</b><br />'); 
		echo form_input('value_greater_than_' . $a, 
			$this->input->post('value_greater_than_' . $a) ?  
			$this->input->post('value_greater_than_' . $a) : 
			'');
		echo "<br /><br />";
		echo "</div>";

		$i++;
	}
	echo "</div>";
	
	echo form_button(array(
		'name' => 'add_vars',
		'id' => 'add_vars',
		'value' => 'true',
		'content' => 'Add Problem Variable'
	));
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
		</thead>
		<tbody>
<?php
		foreach ($problems as $problem) {
			print "<tr>";
			print "<td><a href='profile/" . $problem->id . "'>" . $problem->identifier . "</a></td>";
			print "</tr>";
		}
?>

		</tbody>
	</table>
<?php
	}
?>
</div>

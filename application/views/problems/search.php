<div class='site_body'>
<?php $this->load->helper('url'); ?>
<link type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui/jquery.ui.all.css" rel="stylesheet"></link>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.autocomplete.min.js" ></script>
<script>
$(document).ready(function() {
	$(function () {
		$("#autocomplete").autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('autocomplete/anamod'); ?>",
					data: { filter: $("#autocomplete").val() },
					dataType: "json",
					type: "POST",
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 2
		});
	});
});
</script>
<h1>Search Problems</h1>
<?php

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');
	echo form_open_multipart('problems/search');
	echo form_hidden('search_problems', 'yes');

	echo form_label('<b>*Problem variable:</b><br />');
	echo form_dropdown('problem_variable', $dropdown_options);

	echo "<br /><br />";
	echo "<b>Select Range:</b><br />";
	echo form_label('<b>Problem variable is less than:</b><br />'); 
	echo form_input('value_less_than', 
		$this->input->post('value_less_than') ?  
		$this->input->post('value_less_than') : 
		'');
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

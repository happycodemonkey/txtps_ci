<div class='site_body'>
<script type="text/javascript">
	$(document).ready( function() {
		$('#add_problem').submit( function() {
			alert('Your problem is about to be run by the generator. This process could take several minutes to complete. Closing the window will not interrupt this process. You will be emailed when it is complete.');	
		});
	});
</script>
<h2>Add A New Problem</h2>
<?php
	if (isset($saved)) {
		echo "Your problem was successfully created.";
	} else if (isset($error)) {
		echo "<h3 class='error'>" . $error . "</h3>";
	}

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	if (!isset($generator) || !isset($generator_id)) {
		print "There are no generators defined. You must <a href='/generators/add'>add one</a> before you can run a problem.";
	} else {

	$this->load->helper('form');
	echo form_open_multipart('problems/add/' . $generator_id, array('id'=>'add_problem'));
	echo form_hidden('add_problem', 'yes');
?>
	<?php echo form_label('<b>*Generator:</b>'); ?>
	<br />
	<b><?php echo $generator->name; ?></b>
	<?php echo form_hidden('generator_id', $generator_id); ?>
	<?php echo form_hidden('problem_id', $problem_id); ?>
	<br /><br />
	<?php echo form_label('<b>Description:</b>'); ?>
	<br />
	<?php echo form_textarea('problem_description', isset($problem_description) ? $problem_description : $this->input->post('problem_description')); ?>
	<br /><br />	
	<?php 
		echo form_label('<b>Arguments:</b>'); 
	?>
	<br />
	<table width='40%'>
	<?php
	foreach ($arguments as $argument) {
		if ($problem_id && isset($argument->value)) {
			$value = $argument->value;
		} else {
			$value = $argument->default_value;
		}
			echo "<tr>";
			echo "<td width='20%'>";
			if (!$argument->optional) {
				echo "*"; 
			} 
			echo form_label($argument->name) . "</td>";
			if ($argument->type == 'SELECT') {
				$arg_options = array();
				$arg_options[""] = "Select..."; 
				foreach (explode(',' , $argument->options) as $option) {
					$arg_options[trim($option,"\"")] = trim($option,"\"");
				}
				echo "<td width='10%'>(" . $argument->type . ")</td>";
				echo "<td width='10%'>" . form_dropdown($argument->id, $arg_options, $this->input->post($argument->id) ? $this->input->post($argument->id) : $value) . "</td>";
			} else {
				echo "<td width='10%'>(" . $argument->type . ")</td>";
				echo "<td width='10%'>" . form_input($argument->id, $this->input->post($argument->id) ? $this->input->post($argument->id) : $value) . "</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
	<br />
<?php
	echo form_submit('submit', 'Run Generator');
	echo form_close();
	}
?>
</div>

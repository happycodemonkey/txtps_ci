<?php
	if (isset($saved)) {
		echo "Your problem was successfully created.";
	} else if (isset($error)) {
		echo $error;
	}

	$this->load->helper('form');
	echo form_open_multipart('problems/add');
	echo form_hidden('add_problem', 'yes');
	echo form_label('<b>Name:</b>');
?>
	<br />
	<?php echo form_input('problem_name', isset($problem_name) ? $problem_name : ''); ?>
	<br /><br />
	<?php echo form_label('<b>Generator:</b>'); ?>
	<br />
	<b><?php echo $generator_name; ?></b>
	<?php echo form_hidden('generator_id', $generator_id); ?>
	<br /><br />
	<?php echo form_label('<b>Description:</b>'); ?>
	<br />
	<?php echo form_textarea('problem_description', isset($problem_description) ? $problem_description : ''); ?>
	<br /><br />	
	<?php 
		echo form_label('<b>Arguements:</b>'); 
	?>
	<br />
	<table width='30%'>
	<?php
		foreach ($arguments as $argument) {
			echo "<tr>";
			echo "<td width='20%'>" . form_label($argument->name) . "</td>";
			echo "<td width='10%'>" . form_input($argument->variable) . "</td>";
			echo "</tr>";
		}
	?>
	</table>
	<br />
<?php
	echo form_submit('submit', 'Create Generator');
	echo form_close();
?>

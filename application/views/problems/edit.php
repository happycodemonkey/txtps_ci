<?php
	if (isset($saved)) {
		echo "Your problem was successfully updated.";
	} else if (isset($error)) {
		echo $error;
	}

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');
	echo form_open_multipart('problems/edit/' . $problem->id);
	echo form_hidden('problem_id', $problem->id);
?>
	<?php echo form_label('<b>*Generator:</b>'); ?>
	<br />
	<b><?php echo $generator->name; ?></b>
	<?php echo form_hidden('generator_id', $generator->id); ?>
	<br /><br />
	<?php echo form_label('<b>Description:</b>'); ?>
	<br />
	<?php echo form_textarea('problem_description', isset($problem->description) ? $problem->description : ''); ?>
	<br /><br />	
	<?php 
		echo form_label('<b>Arguments:</b>'); 
	?>
	<br />
	<table width='40%'>
	<?php
		foreach ($arguments as $argument) {
			echo "<tr>";
			echo "<td width='20%'>";
			if (!$argument->optional) {
				echo "*"; 
			} 
			echo form_label($argument->name) . "</td>";
			echo "<td width='10%'>(" . $argument->type . ")</td>";
			echo "<td width='10%'>" . form_input($argument->id, $problem_args[$argument->id]) . "</td>";
			echo "</tr>";
		}
	?>
	</table>
	<br />
<?php
	echo form_submit('submit', 'Re-run Problem');
	echo form_close();
?>

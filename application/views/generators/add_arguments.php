<div class='site_body'>
<?php
	if (isset($saved)) {
		echo "Your arguments were successfully saved.";
	} else if (isset($error)) {
		echo $error;
	}

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');
?>
	<h2><a href='/generators/edit/<?php print $generator_id ?>'><?php print $generator_name?></a> / Arguments</h2>
	<div id='added_arguments'>
		<?php 
			foreach ($arguments as $argument) {
				print $argument->variable;
				$argument->description ? print " : " . $argument->description : print " : No description "; 
				print "&nbsp;&nbsp;<a href='/generators/delete_argument/" . $argument->id . "/" . $generator_id . "'>Delete</a>";
				print "&nbsp;&nbsp;<a href='/generators/edit_argument/" . $argument->id . "/" . $generator_id . "'>Edit</a><br />";
			}
		?>
	</div>
	<br />
	<div id='arguments'>
		<?php
			echo form_open_multipart('generators/add_arguments/' . $generator_id, array('id'=>'add_arguments'));
			echo form_hidden('add_arguments', 'yes');
			echo form_hidden('generator_id', $generator_id);
			$argument_types = array(
				'INTEGER' => 'Integer',
				'FLOAT' => 'Float',
				'DOUBLE' => 'Double',
				'STRING' => 'String',
				'SELECT' => 'Select'
			);
		?>
		<?php echo form_label('<b>*Name:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_name','id'=>'argument_name'), isset($argument_name) ? $argument_name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Optional:</b>'); ?>
		<br />
		<?php echo form_checkbox(array('name'=>'argument_optional','id'=>'argument_optional', 'value'=>1), isset($argument_optional) ? $argument_optional : '', FALSE); ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea(array('name'=>'argument_description','id'=>'argument_description'), isset($argument_description) ? $argument_description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Variable:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_variable','id'=>'argument_variable'), isset($argument_variable) ? $argument_variable : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Type:</b>'); ?>
		<br />
		<?php echo form_dropdown('argument_type', $argument_types, isset($argument_type) ? $argument_type : '', 'id="argument_type"'); ?>
		<br /><br />
		<div id='argument_select_options' style="display:none;">
			<?php echo form_label('<b>Options (comma-seperated list):</b>'); ?>
			<br />
			<?php echo form_input('argument_options', isset($argument_options) ? $argument_options : ''); ?>
			<br /><br />
		</div>
		<?php echo form_label('<b>Default:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_default','id'=>'argument_default'), isset($argument_default) ? $argument_default : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('submit', 'Add Argument');
	echo "&nbsp;&nbsp;";
	echo form_close();
	echo form_open('generators/add_arguments');
	echo form_hidden('continue', 'yes');
	echo form_hidden('generator_id', $generator_id);
	echo form_submit('submit', 'Continue');
	echo form_close();

?>
</div>

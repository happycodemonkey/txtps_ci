<?php
	if (isset($saved)) {
		echo "Your arguments were successfully saved.";
	} else if (isset($error)) {
		echo $error;
	}

	$this->load->helper('form');
	echo form_open_multipart('generators/add_arguments');
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
	<h2 class='accordian_header'>Step 2 : Arguments</h2>
	<div id='added_arguments'>

	</div>
	<div class='accordian' id='arguments'>
		<?php echo form_label('<b>Name:</b>'); ?>
		<br />
		<?php echo form_input('argument_name', isset($argument_name) ? $argument_name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea('argument_description', isset($argument_description) ? $argument_description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Variable:</b>'); ?>
		<br />
		<?php echo form_input('argument_variable', isset($argument_variable) ? $argument_variable : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Type:</b>'); ?>
		<br />
		<?php echo form_dropdown('argument_type', $argument_types, isset($argument_type) ? $argument_type : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Default:</b>'); ?>
		<br />
		<?php echo form_input('argument_default', isset($argument_default) ? $argument_default : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Options:</b>'); ?>
		<br />
		<?php echo form_input('argument_options', isset($argument_options) ? $argument_options : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_button(array('name'=>'append_argument', 'id'=>'append_argument', 'value'=>'append', 'content'=>'Add Another Argument'));
	echo "&nbsp;&nbsp;";
	echo form_submit('submit', 'Continue');
	echo form_close();

?>

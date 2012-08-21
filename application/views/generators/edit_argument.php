<div class='site_body'>
<?php
	if (isset($saved)) {
		echo "Your arguments were successfully updated.";
	} else if (isset($error)) {
		echo $error;
	}

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');

?>
	<h2><a href='/generators/edit/<?php print $generator_id ?>'><?php print $generator_name?></a> / Arguments</h2>
	<div id='argument'>
		<?php
			echo form_open_multipart('generators/edit_argument/' . $argument->id . '/' . $generator_id, array('id'=>'edit_argument'));
			echo form_hidden('edit_argument', 'yes');
			echo form_hidden('argument_id', $argument->id);
			echo form_hidden('generator_id', $generator_id);
			$argument->types = array(
				'INTEGER' => 'Integer',
				'FLOAT' => 'Float',
				'DOUBLE' => 'Double',
				'STRING' => 'String',
				'SELECT' => 'Select'
			);
		?>
		<?php echo form_label('<b>*Name:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_name','id'=>'argument_name'), isset($argument->name) ? $argument->name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Optional:</b>'); ?>
		<br />
		<?php echo form_checkbox(array('name'=>'argument_optional','id'=>'argument_optional', 'value'=>1), isset($argument->optional) ? $argument->optional : '', FALSE); ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea(array('name'=>'argument_description','id'=>'argument_description'), isset($argument->description) ? $argument->description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Variable:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_variable','id'=>'argument_variable'), isset($argument->variable) ? $argument->variable : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Type:</b>'); ?>
		<br />
		<?php echo form_dropdown('argument_type', $argument->types, isset($argument->type) ? $argument->type : '', 'id="argument_type"'); ?>
		<br /><br />
		<div id='argument_select_options' <?php $argument->type != "Select" ? print "style='display:none;'" : ""; ?> >
			<?php echo form_label('<b>Options (comma-seperated list):</b>'); ?>
			<br />
			<?php echo form_input('argument_options', isset($argument->options) ? $argument->options : ''); ?>
			<br /><br />
		</div>
		<?php echo form_label('<b>Default:</b>'); ?>
		<br />
		<?php echo form_input(array('name'=>'argument_default','id'=>'argument_default'), isset($argument->default) ? $argument->default : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('submit', 'Update Argument');
	echo form_close();

?>
</div>

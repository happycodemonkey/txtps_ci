<?php
	if (isset($saved)) {
		echo "Your generator was successfully created.";
	} else if (isset($error)) {
		echo $error;
	}

	$this->load->helper('form');
?>
	<h2 class='accordian_header'>Overview</h2>
	<div class='accordian' id='overview'>
		<?php 
		echo form_open_multipart('generators/add');
		echo form_hidden('add_generator', 'yes');
		?>
		<?php echo form_label('<b>*Name:</b>'); ?>
		<br />
		<?php echo form_input('generator_name', isset($generator_name) ? $generator_name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Collection:</b>'); ?>
		<br />
		<?php echo form_dropdown('collection_id', $options, isset($collection_id) ? $collection_id : ''); ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea('generator_description', isset($generator_description) ? $generator_description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Script:</b>'); ?>
		<br />
		<?php echo form_upload('generator_script', isset($generator_script) ? $generator_script : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('submit', 'Continue');
	echo form_close();

?>

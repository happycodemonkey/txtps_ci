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
		echo form_open_multipart('generators/edit');
		echo form_hidden('generator_id', $generator->id);
		?>
		<?php echo form_label('<b>*Name:</b>'); ?>
		<br />
		<?php echo form_input('generator_name', isset($generator->name) ? $generator->name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Collection:</b>'); ?>
		<br />
		<?php echo $collection->name; ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea('generator_description', isset($generator->description) ? $generator->description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Script:</b>'); ?>
		<br />
		<?php echo $generator->script; ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('submit', 'Update Generator');
	echo form_close();
        echo "<br /><br />";
        echo form_open('generators/add_arguments/' . $generator->id);
        echo form_submit('submit', 'Edit Arguments');
        echo form_close();
        echo form_open('generators/add_images/' . $generator->id);
        echo form_submit('submit', 'Edit Images');
        echo form_close();

?>

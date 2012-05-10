<?php
	echo validation_errors();
	$this->load->helper('form');
	echo form_open('collections/add');
	echo form_hidden('add_collection', 'yes');
	echo form_label('<b>*Name</b>');
	echo "<br />";
	echo form_input('collection_name');
	echo "<br /><br />";	
	echo form_label('<b>Description:</b>');
	echo "<br />";
	echo form_textarea('collection_description');
	echo "<br /><br />";	
	echo form_submit('submit', 'Create Collection');
	echo form_close();
?>

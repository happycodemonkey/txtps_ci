<div class='site_body'>
<?php
	echo "<h3 class='error'>" . validation_errors() . "</h3>";
	$this->load->helper('form');
	echo form_open('collections/edit/' . $collection->id);
	echo form_hidden('collection_id', $collection->id);
	echo form_label('<b>*Name:</b>');
	echo "<br />";
	echo form_input('collection_name', $collection->name ? $collection->name : '');
	echo "<br /><br />";	
	echo form_label('<b>Description:</b>');
	echo "<br />";
	echo form_textarea('collection_description', $collection->description ? $collection->description : '');
	echo "<br /><br />";	
	echo form_submit('submit', 'Update Collection');
	echo form_close();
?>
</div>

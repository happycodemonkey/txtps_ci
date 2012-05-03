<?php
	if (isset($saved)) {
		echo "Your images were successfully uploaded.";
	} else if (isset($error)) {
		echo $error;
	}

	$this->load->helper('form');
	echo form_open_multipart('generators/add_images');
	echo form_hidden('add_images', 'yes');
?>
	<h2 class='accordian_header'>Images</h2>
	<div id='added_arguments'>

	</div>
	<div class='accordian' id='images'>
		<?php echo form_label('<b>Image:</b>'); ?>
		<br />
		<?php echo form_upload('generator_image', isset($generator_image) ? $generator_image : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_button(array('name'=>'append_image', 'id'=>'append_image', 'value'=>'append', 'content'=>'Add Another Image'));
	echo "&nbsp;&nbsp;";
	echo form_submit('submit', 'Finish');
	echo form_close();

?>

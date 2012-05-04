<?php
	if (isset($saved)) {
		echo "Your images were successfully uploaded.";
	} else if (isset($error)) {
		echo $error;
	}

	$this->load->helper('form');
?>
	<h2>Images</h2>
	<div id='added_images'>
		<?php
			foreach ($images as $image) {
				print $image->name . "&nbsp;&nbsp; <a href='/generators/delete_image/" . $image->id . "/" . $generator_id . "'>Delete</a><br />";
			}
		?>
	</div>
	<div id='images'>
		<?php
			echo form_open_multipart('generators/add_images/' . $generator_id);
			echo form_hidden('add_image', 'yes');
			echo form_hidden('generator_id', $generator_id);
		?>
		<?php echo form_label('<b>Image:</b>'); ?>
		<br />
		<?php echo form_upload('generator_image', isset($generator_image) ? $generator_image : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('append_image', 'Add Image');
	echo form_close();
	echo "&nbsp;&nbsp;";
	echo form_open('generators/view');
	echo form_hidden('finish', 'yes');
	echo form_submit('submit', 'Finish');
	echo form_close();

?>

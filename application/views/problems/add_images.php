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
				print $image->name . "&nbsp;&nbsp; <a href='/problems/delete_image/" . $image->id . "/" . $problem_id . "'>Delete</a><br />";
			}
		?>
	</div>
	<div id='images'>
		<?php
			echo form_open_multipart('problems/add_images/' . $problem_id);
			echo form_hidden('add_image', 'yes');
			echo form_hidden('problem_id', $problem_id);
		?>
		<?php echo form_label('<b>Image:</b>'); ?>
		<br />
		<?php echo form_upload('problem_image', isset($problem_image) ? $problem_image : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('append_image', 'Add Image');
	echo form_close();
	echo "&nbsp;&nbsp;";
	echo form_open('problems/profile/' . $problem_id);
	echo form_submit('submit', 'Done');
	echo form_close();

?>

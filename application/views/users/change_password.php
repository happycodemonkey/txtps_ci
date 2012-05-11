<?php
	if (isset($success)) {
		print $success;
	} else if (isset($error)) {
		print $error;
	}

	echo "<h2 class='error'>" . validation_errors() . "</h2>";
?>

<h2>Change your password</h2>
<?php
	$this->load->helper('form');
	echo form_open('users/change_password');
	echo form_label('<b>*Password</b>');
	echo "<br />";
	echo form_password('password');
	echo "<br /><br />";
	echo form_label('<b>*Retype Password</b>');
	echo "<br />";
	echo form_password('retype');
	echo "<br /><br />";
	echo form_submit('submit', 'Update your password');
	echo form_close();
?>

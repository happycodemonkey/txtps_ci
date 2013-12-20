<div class='site_body'>
<h2>Register</h2>
<?php
	if (isset($errors)) {
		foreach($errors as $error) {
			print "<h3 class='error'>" . $error . "</h3>";
		}
	}
	if (isset($success)) {
		print "<h3 class='success'>" . $success . "</h3>";
	}

	print "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');

	echo form_open('users/register');
	echo form_label('<b>First Name</b>');
	echo "<br />";
	echo form_input('first_name');
	echo "<br /><br />";
	echo form_label('<b>Last Name</b>');
	echo "<br />";
	echo form_input('last_name');
	echo "<br /><br />";
	echo form_label('<b>Email</b>');
	echo "<br />";
	echo form_input('username');
	echo "<br /><br />";
	echo form_label('<b>Password</b>');
	echo "<br />";
	echo form_password('password');
	echo "<br /><br />";
	echo form_label('<b>Retype Password</b>');
	echo "<br />";
	echo form_password('retype_password');
	echo "<br /><br />";
	echo form_submit('submit', 'Register');
	echo form_close();
?>
</div>

<div class='site_body'>
<?php
	$this->load->helper('form');

	echo form_open('users/login');
	echo form_label('<b>Email</b>');
	echo "<br />";
	echo form_input('username');
	echo "<br /><br />";
	echo form_label('<b>Password</b>');
	echo "<br />";
	echo form_password('password');
	echo "<br /><br />";
	echo form_submit('submit', 'Login');
	echo form_close();
?>
</div>

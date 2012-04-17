<?php
	$this->load->helper('form');

	echo "<h2>Contact us</h2>";
	echo form_open('pages/contact/send');
	echo form_label('<b>Your Email</b>');
	echo "<br />";
	echo form_input('from_email');
	echo "<br /><br />";	
	echo form_label('<b>Subject</b>');
	echo "<br />";
	echo form_input('subject');
	echo "<br /><br />";	
	echo form_label('<b>Message</b>');
	echo "<br />";
	echo form_textarea('message');
	echo "<br /><br />";	
	echo form_submit('submit', 'Send message');
	echo form_close();
?>

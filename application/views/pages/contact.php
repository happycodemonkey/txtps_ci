<div class='site_body'>
<h2>Contact us</h2>
<?php
	echo validation_errors();

	$this->load->helper('form');
	$this->load->helper('recaptchalib');

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
	echo recaptcha_get_html("6Lf8mOsSAAAAAP6Y7NasphiVpaou0-g1Dehn67NV");
	echo form_submit('submit', 'Send message');
	echo form_close();
?>

</div>

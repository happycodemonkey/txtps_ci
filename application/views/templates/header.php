<html>
<head>
<?php
	$this->load->helper('asset'); #modified asset helper
	echo js_asset('jquery-1.7.2.min.js');
	echo js_asset('site.js');
	echo css_asset('site.css');

	$this->load->library('ion_auth');
?>
<title>TxTPS - Texas Test Problem Server</title>
</head>
<body>
<div class="header_menu">
	<a href="http://www.tacc.utexas.edu"><?php echo image_asset('tacc_s.png'); ?></a>
	<a href="/pages/view/about">About</a>
	<a href="/pages/contact">Contact</a>
	<a href="/pages/view/help">Help</a>
<?php 
	if ($this->ion_auth->logged_in()) {
		$user = $this->ion_auth->user()->row();
		echo $user->email;
	} else {
		echo " <a href='/users/login'>Login</a> ";
		echo " <a href='/users/register'>Register</a> ";
	}
?>
</div>
<a href="/pages/view/home">
<?php echo image_asset('TxTPS_s.png'); ?>
</a>
<h2>Texas Test Problem Server</h2>
<ul id="nav">
	<li>
		<a href="#">Create</a>
		<ul>
			<li><a href="#">Collections</a></li>
			<li><a href="#">Generators</a></li>
			<li><a href="#">Finite Element</a></li>
			<li><a href="#">Matrix Market</a></li>
			<li><a href="#">Very Large</a></li>
		</ul>
		<div class="clear"></div>
	</li>
	<li>
		<a href="#">Research</a>
		<ul>
			<li><a href="#">Stored Problems</a></li>
			<li><a href="#">File Formats</a></li>
			<li><a href="#">Using TxTPS</a></li>
			<li><a href="#">Software</a></li>
		</ul>
		<div class="clear"></div>
	</li>
	<li>
		<a href="#">Explore</a>
		<ul>
			<li><a href="/pages/view/about">About TxTPS</a></li>
			<li><a href="/pages/contact">Contact Us</a></li>
			<li><a href="#">News</a></li>
			<li><a href="/pages/view/faq">FAQ</a></li>
		</ul>
		<div class="clear"></div>
	</li>
</ul>
<div class="clear"></div>
<hr />

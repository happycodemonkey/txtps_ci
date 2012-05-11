<html>
<head>
<?php
	$this->load->helper('asset'); #modified asset helper
	echo js_asset('jquery-1.7.2.min.js');
	echo js_asset('site.js');
	echo js_asset('MathJax/MathJax.js?config=default');
	echo css_asset('site.css');

	$this->load->library('ion_auth');
?>
<title>TxTPS - Texas Test Problem Server</title>
</head>
<body>
<div class="header_menu">
	<a href="http://www.tacc.utexas.edu"><?php echo image_asset('tacc_s.png'); ?></a>
<?php 
	if ($this->ion_auth->logged_in()) {
		$user = $this->ion_auth->user()->row();
		echo $user->email;
		if ($this->ion_auth->is_admin()) {
			echo " (Admin) ";
		}
		echo " <a href='/users/logout'>Logout</a> ";
		echo " <a href='/users/change_password'>Change Password</a> ";
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
		<a href="/problems/menu">Create</a>
		<ul>
			<li><a href="/collections/view">Collections</a></li>
			<li><a href="/generators/view">Generators</a></li>
			<li><a href="/problems/view">Stored Problems</a></li>
		</ul>
		<div class="clear"></div>
	</li>
	<li>
		<a href="/pages/view/help_menu">Help</a>
		<ul>
			<li><a href="/pages/view/formats">File Formats</a></li>
			<li><a href="#">Using TxTPS</a></li>
			<li><a href="#">Software</a></li>
		</ul>
		<div class="clear"></div>
	</li>
	<li>
		<a href="/pages/view/about_menu">About</a>
		<ul>
			<li><a href="/pages/view/about">About TxTPS</a></li>
			<li><a href="/pages/contact">Contact Us</a></li>
			<li><a href="/pages/view/faq">FAQ</a></li>
		</ul>
		<div class="clear"></div>
	</li>
<?php if ($this->ion_auth->is_admin()) : ?>
	<li>
		<a href="/pages/view/admin_menu">Admin</a>
		<ul>
			<li><a href="/users/manage">Users</a></li>
		</ul>
		<div class="clear"></div>
	</li>
<?php endif; ?>
</ul>
<div class="clear"></div>
<hr />

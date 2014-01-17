<html>
<head>
<?php
	$this->load->helper('asset'); #modified asset helper
	echo js_asset('jquery-1.7.2.min.js');
	echo js_asset('site.js');
	echo js_asset('MathJax/MathJax.js?config=default');
	echo css_asset('stylesheets/site.css');

	$this->load->library('ion_auth');
?>
<title>TxTPS - Texas Test Problem Server</title>
</head>
<body>
<div id='header'>
	<div id='top_header'>
		<div id='user_links'>
		<?php 
			if ($this->ion_auth->logged_in()) {
				$user = $this->ion_auth->user()->row();
				echo $user->email;
				if ($this->ion_auth->is_admin()) {
					echo " (Admin) ";
				}
				echo "<br />";
				echo " <a href='/users/logout'><b>Logout</b></a>  | ";
				echo " <a href='/users/change_password'><b>Change Password</b></a> ";
				echo "<br />";
				echo "<a href='https://lists.tacc.utexas.edu/mailman/listinfo/txtps-announce'>Sign up for the mailing list</a>";
			} else {
				echo "<br />";
				echo " <a href='/users/login'><b>Login</b></a>  | ";
				echo " <a href='/users/register'><b>Register</b></a> ";
			}
		?>
		</div>
		<div id='top_header_text'><h1 id='header_title'>Welcome to the <br />Texas Test Problem Server</h1></div>
		<div id='txtps_header_image'><a href="/pages/view/home"><?php echo image_asset('TxTPS_s.png'); ?></a></div>
	</div>
	<div id='header_menu'>
		<ul id="nav">
			<li>
				<a href="/problems/menu">Create</a>
				<ul>
					<li><a href="/collections/view">Collections</a></li>
					<li><a href="/generators/view">Generators</a></li>
					<li><a href="/problems/view">Stored Problems</a></li>
					<li><a href="/problems/search">Search</a></li>
				</ul>
				<div class="clear"></div>
			</li>
			<li>
				<a href="/pages/view/help_menu">Help</a>
				<ul>
					<li><a href="/pages/view/about">About TxTPS</a></li>
					<li><a href="/pages/view/formats">File Formats</a></li>
					<li><a href="/pages/view/faq">FAQ</a></li>
					<li><a href="/pages/contact">Contact Us</a></li>
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
	</div>
	<div class="clear"></div>
</div>

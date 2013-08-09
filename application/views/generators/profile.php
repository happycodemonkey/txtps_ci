<div class='site_body'>
<?php
	print "<h1 class='accordian_header'><a href='/collections/profile/" . $generators->collection_id . "'>" . $collections->name . "</a> / " . $generators->name . "</h1>";
	print "<h2>Description</h2>";
	print $generators->description;
	print "<h2>Images</h2>";
	if (count($images) == 0) {
		print "There are no images for this generator.";	
	} else {
		$this->load->helper('asset');
		foreach ($images as $image) {
			print image_asset('resource/' . $image->name);
		}
	}

	print "<h2 class='accordian_header'>Arguments</h2>";

	if ($this->ion_auth->is_admin()) {
		print "<a href='/generators/add_arguments/" . $generators->id . "'>Add an argument</a><br /><br />";
	}	

	print "<div class='accordian'>";
	foreach ($arguments as $argument) {
		print $argument->name . ": " . $argument->description . "<br />";
	}
	print "</div>";

	print "<h2 class='accordian_header'>Problems</h2>";
	
	if ($this->ion_auth->logged_in()) {
		print "<a href='/problems/add/" . $generators->id . "'>Generate a problem</a><br /><br />";
	
	}

	if (count($problems) == 0) {
		print "There are no problems for this generator."; 
	} else {
		print "<div class='accordian'>";
		foreach ($problems as $problem) {
			print "<a href='/problems/profile/" . $problem->id . "'>" . $problem->identifier . "</a><br />";
		}
		print "</div>";
	}
?>
</div>

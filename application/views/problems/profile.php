<?php
	print "<h2>";
	print "<h2 class='accordian_header'><a href='/collections/profile/" . $collections->id . "'>" . $collections->name . "</a> / <a href='/generators/profile/" . $problems->generator_id . "'>" . $generators->name . "</a> / " . $problems->identifier . "</h2>";
	print $problems->description;
	print "</h2><h3>Generator Description</h3>";
	print $generators->description;
	print "<h3>Images</h3>";
	print "<a href='/problems/add_images/" . $problems->id . "'>Add an image</a><br /><br />";

	if (empty($images)) {
		print "There are no images for this problem.";
	} else {
		foreach ($images as $image) {
			print $image->name . "&nbsp;&nbsp;<a href='/problems/delete_image/" . $image->id . "/" . $problems->id . "'>Delete</a><br />";
		}
	}
	
	print "<h3>Arguments</h3>";


	foreach ($arguments as $key => $value) {
		print $key . " = " . $value . "<br />";
	}

	print "<h3>Files</h3>";

	if (empty($files)) {
		print "There are no files for this problem.";
	} else {
		foreach ($files as $file) {
			//load
		}
	}

?>


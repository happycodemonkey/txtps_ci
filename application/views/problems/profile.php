<?php
	print "<h2>";
	print "<h2 class='accordian_header'><a href='/collections/profile/" . $collections->id . "'>" . $collections->name . "</a> / <a href='/generators/profile/" . $problems->generator_id . "'>" . $generators->name . "</a> / " . $problems->identifier . "</h2>";
	print "</h2><h3>Generator Description</h3>";
	print $generators->description;
	print "<h3>Images</h3>";


	if (empty($images)) {
		print "There are no images for this problem.";
	} else {
		foreach ($images as $image) {
			//load
		}
	}
	
	print "<h3>Arguments</h3>";


	foreach (explode(",", trim($problems->arguments, "{}")) as $arguments) {
		$value_pair = explode(":", $arguments);
		print trim($value_pair[0], '"') . " = " . trim($value_pair[1], '"') . "<br />";
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


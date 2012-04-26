<?php
	foreach ($generators as $generator) {
		print "<h1 class='accordian_header'><a href='/collections/view/" . $generator->collection_id . "'>" . $collections[$generator->collection_id] . "</a> / " . $generator->name . "</h1>";
		print "<a href='/problems/add/" . $generator->id . "'>Add a problem</a><br /><br />";
		print "<h2>Description</h2>";
		print $generator->description;
		print "<h2>Images</h2>";
		if (count($images) == 0) {
			print "There are no images for this generator.";	
		} else {
			foreach ($images as $image) {
				print "<img src='" . $image_path . $image->name . "' />";	
			}
		}
		print "<h2 class='accordian_header'>Problems</h2>";
		if (count($problems) == 0) {
			print "There are no problems for this generator."; 
		} else {
			print "<div class='accordian'>";
			foreach ($problems as $problem) {
				print $problem->identifier . "<br />";
			}
			print "</div>";
		}
	}
?>

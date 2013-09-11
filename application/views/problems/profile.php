<div class='site_body'>
<?php
	print "<h2>";
	print "<h2 class='accordian_header'><a href='/collections/profile/" . $collections->id . "'>" . $collections->name . "</a> / <a href='/generators/profile/" . $problems->generator_id . "'>" . $generators->name . "</a> / " . $problems->identifier . "</h2>";
	print $problems->description;
	print "</h2><h3>Generator Description</h3>";
	print str_replace("\n", "<br />", $generators->description);
	
	print "<h3>Arguments</h3>";


	foreach ($arguments as $key => $value) {
		print $key . " = " . $value . "<br />";
	}

	print "<h3>Generator Errors</h3>";

	if (!empty($error_file)) {
		foreach ($error_file as $file) {
			print "<pre>" . htmlspecialchars(file_get_contents("assets/data/files/problems/" . $problems->id . "/public/" . $file)) . "</pre>"; 
		}
	}

	print "<h3>Files</h3>";

	if (empty($files)) {
		print "There are no files for this problem.";
	} else {
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				print "<a target='_blank' href='/problems/download/" . $problems->id . "/" . $file . "'>" . $file . "</a><br />";
			}
		}
	}

	if (!empty($pngs)) {
		foreach ($pngs as $file) {
			print "<img src='/assets/data/files/problems/" . $problems->id . "/public/" . $file . "' />";
		}
	}

	if (!empty($pdfs)) {
		foreach ($pdfs as $file) {
			print "<object data='/assets/data/files/problems/" . $problems->id . "/public/" . $file . "' type='application/pdf' width='100%' height='100%'>";
			print "<embed src='/assets/data/files/problems/" . $problems->id . "/public/" . $file . "' type='application/pdf' width='100%' height='100%'>";
			print "</object><br />";
		}
	}

?>
</div>

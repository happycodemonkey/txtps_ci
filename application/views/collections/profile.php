<div class='site_body'>
<?php

	print "<h1>" . $collections->name . "</h1>";
	print $collections->description;

	if ($this->ion_auth->is_admin()) {
		print "<br /><br />";
		print "<a href='/generators/add/" . $collections->id . "'>Add a generator</a>";
	}

	print "<h2>Generators</h2>";
	
	if (count($generators) == 0) {
		print "There are no generators for this collection.";
	} else {
		foreach ($generators as $generator) {
			print "<b><a href='/generators/profile/" . $generator->id . "'>" . $generator->name . "</a></b>";
			print "<br />";
		}
	}
?>
</div>

<?php
	if (isset($collection)) {
		print "<h1>Generators in " . $collection[0]->name . "</h2>"; 
		foreach ($generators->result() as $generator) {
			print "<h2><a href='/generators/view/id/" . $generator->id . "'>" . $generator->name . "</a></h2>";
			print $generator->description;
		}
	} else {
		foreach ($generators->result() as $generator) {
			print "<h2 class='accordian_header'>" . $generator->name . "</h2>";
			print "<a href='/problems/add/" . $generator->id . "'>Add a problem</a><br /><br />";
			if (count($problems->result()) == 0) {
				print "There are no problems for this generator."; 
			} else {
				print "<div class='accordian'>";
				foreach ($problems->result() as $problem) {
					print $problem->identifier . "<br />";
				}
				print "</div>";
			}
		}
	}
	
?>

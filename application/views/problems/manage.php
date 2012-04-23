<?php
	$current_generator = 0;
	foreach ($problems->result() as $problem) {
		if ($current_generator != $problem->generator_id && array_key_exists($problem->generator_id, $generators)) {
			$current_generator = $problem->generator_id;

			print "<br />";
			print "<h2>" . $generators[$problem->generator_id] . "</h2>";
			print $problem->identifier;
		}
	}
?>

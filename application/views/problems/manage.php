<h1>Problems Management</h1>

<a href="/generators/view">Go to a generator</a> to add a problem

<h2>Existing Problems</h2>

<?php
	$current_generator = 0;
	foreach ($problems->result() as $problem) {
		if ($current_generator != $problem->generator_id && array_key_exists($problem->generator_id, $generators)) {
			if ($current_generator != 0) {
				print "</div>";
			}
			
			$current_generator = $problem->generator_id;
			$generator = $generators[$problem->generator_id];

			print "<h2 class='accordian_header'>" . $collections[$generator[1]] . " : " . $generator[0] . "</h2>";
			print "<div class='accordian'>";
		}

		print "<table width=50%><tr>";
		print "<td>" . $problem->identifier . "</td>";
		print "<td width=10%><a href='/problems/view/" . $problem->id . "'>View</a></td>";
		print "<td width=10%><a href='/problems/edit/" . $problem->id . "'>Edit</a></td>";
		print "<td width=10%><a href='/problems/delete/" . $problem->id . "'>Delete</a></td>";
		print "</tr></table>";
	}
?>

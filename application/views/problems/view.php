<h1>Problems</h1>

<?php if ($this->ion_auth->logged_in()) : ?>
<a href="/generators/view">Go to a generator</a> to add a problem
<?php endif; ?>
<?php
	$current_generator = 0;
	foreach ($problems as $problem) {
		if ($current_generator != $problem->generator_id && array_key_exists($problem->generator_id, $generators)) {
			if ($current_generator != 0) {
				print "</div>";
			}
			
			$current_generator = $problem->generator_id;
			$generator = $generators[$problem->generator_id];

			print "<h2 class='accordian_header'>" . $collections[$generator[1]] . " / " . $generator[0] . "</h2>";
			print "<div class='accordian'>";
		}

		print "<table width=50%><tr>";
		if ($this->ion_auth->is_admin()) {
			print "<td>" . $problem->identifier . "</td>";
			print "<td width=10%><a href='/problems/profile/" . $problem->id . "'>View</a></td>";
			print "<td width=10%><a href='/problems/edit/" . $problem->id . "'>Edit</a></td>";
			print "<td width=10%><a href='/problems/delete/" . $problem->id . "'>Delete</a></td>";
		} else {
			print "<td><a href='/problems/profile/" . $problem->id . "'>" . $problem->identifier . "</a></td>";
		}
		print "</tr></table>";
	}
?>

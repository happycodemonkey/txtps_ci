<h1>Generator Management</h1>

<a href="/generators/add">Add a new generator</a>

<h2>Existing Generators</h2>

<?php
	$current_collection = 0;
	foreach ($generators->result() as $generator) {
		if ($current_collection != $generator->collection_id && array_key_exists($generator->collection_id, $collections)) {
			if ($current_collection != 0) {
				print "</div>";
			}

			$current_collection = $generator->collection_id;

			print "<span class='accordian_header'><h2>" . $collections[$generator->collection_id] . "</h2></span>";
			print "<div class='accordian'>";
		}
		print "<table width=50%><tr>";
		print "<td>" . $generator->name . "</td>";
		print "<td width=10%><a href='/generators/view/id/" . $generator->id . "'>View</a></td>";
		print "<td width=10%><a href='/generators/edit/" . $generator->id . "'>Edit</a></td>";
		print "<td width=10%><a href='/generators/delete/" . $generator->id . "'>Delete</a></td>";
		print "</tr></table>";
	}
?>

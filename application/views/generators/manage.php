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
		print "<table><tr>";
		print "<td>" . $generator->name . "</td>";
		print "<td><a href='/generators/view/id/" . $generator->id . "'>View</a></td>";
		print "<td><a href='/generators/delete/" . $generator->id . "'>Delete</a></td>";
		print "<td><a href='/generators/edit/" . $generator->id . "'>Edit</a></td>";
		print "</tr></table>";
	}
?>

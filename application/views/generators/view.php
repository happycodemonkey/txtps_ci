<h1>Generators</h1>

<?php if($this->ion_auth->is_admin()) : ?>
<a href="/generators/add">Add a new generator</a>
<?php endif; ?>

<?php
	$current_collection = 0;
	foreach ($generators as $generator) {
		if ($current_collection != $generator->collection_id && array_key_exists($generator->collection_id, $collections)) {
			if ($current_collection != 0) {
				print "</div>";
			}

			$current_collection = $generator->collection_id;

			print "<span class='accordian_header'><h2>" . $collections[$generator->collection_id] . "</h2></span>";
			print "<div class='accordian'>";
		}
		print "<table width=50%><tr>";
		if ($this->ion_auth->is_admin()) {
			print "<td>" . $generator->name . "</td>";
			print "<td width=10%><a href='/generators/profile/" . $generator->id . "'>View</a></td>";
			print "<td width=10%><a href='/generators/edit/" . $generator->id . "'>Edit</a></td>";
			print "<td width=10%><a href='/generators/delete/" . $generator->id . "'>Delete</a></td>";
		} else {
			print "<td><a href='/generators/profile/" . $generator->id . "'>" . $generator->name . "</a></td>";
		}
		print "</tr></table>";
	}
?>


<table width=50%>
<?php
	$current_collection = 0;
	foreach ($generators->result() as $generator) {
		if ($current_collection != $generator->collection_id && array_key_exists($generator->collection_id, $collections)) {

			$current_collection = $generator->collection_id;

			print "<tr colspan=3 class='accordian_header'><td><b>" . $collections[$generator->collection_id] . "</b></td></tr>";
		}
		print "<tr>";
		print "<td>" . $generator->name . "</td>";
		print "<td><a href='/generators/view/id/" . $generator->id . "'>View</a></td>";
		print "<td><a href='/generators/delete/" . $generator->id . "'>Delete</a></td>";
		print "<td><a href='/generators/edit/" . $generator->id . "'>Edit</a></td>";
		print "</tr>";
	}
?>
</table>

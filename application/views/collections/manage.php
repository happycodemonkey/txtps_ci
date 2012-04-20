<h2>Collection Management</h2>

<a href="/collections/add">Create a new collection</a>

<h3>Existing Collections</h3>
<table width=80%>
<tr>
	<td><b>Collection name</b></td>
	<td><b>Number of Generators</b></td>
	<td colspan=3><b>Actions</b></td>
</tr>
<?php
	foreach ($collections as $id => $name) {
		print "<tr>";
		print "<td>" . $name . "</td>";
		print "<td><a href='/generators/view/collection_id/" . $id . "'>";
		if (count($generators[$id]) != 0) {
			print $generators[$id][0]->num_gens;
		} else {
			print "0";
		}
		print "</a></td>";
		print "<td><a href='/collections/view/" . $id . "'>View</a></td>";
		print "<td><a href='/collections/edit/" . $id . "'>Edit</a></td>";
		print "<td><a href='/collections/delete/" . $id . "'>Delete</a></td>";
		print "</tr>";
	}
?>
</table>

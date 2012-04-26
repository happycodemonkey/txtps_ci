<h1>Collections</h1>

<a href="/collections/add">Create a new collection</a>

<table width=80%>
<tr>
	<td><b>Collection name</b></td>
	<td><b>Number of Generators</b></td>
	<?php if ($this->ion_auth->is_admin()) : ?>
	<td colspan=3><b>Actions</b></td>
	<?php endif; ?>
</tr>
<?php
	foreach ($collections as $id => $name) {
		print "<tr>";
		if ($this->ion_auth->is_admin()) {
			print "<td>" . $name . "</td>";
		} else {
			print "<td><a href='/collections/view/" . $id . "'>" . $name . "</a></td>";
		}
		print "<td><a href='/generators/view/collection_id/" . $id . "'>";
		if (count($generators[$id]) != 0) {
			print $generators[$id][0]->num_gens;
		} else {
			print "0";
		}
		print "</a></td>";
		if ($this->ion_auth->is_admin()) {
			print "<td><a href='/collections/view/" . $id . "'>View</a></td>";
			print "<td><a href='/collections/edit/" . $id . "'>Edit</a></td>";
			print "<td><a href='/collections/delete/" . $id . "'>Delete</a></td>";
		}
		print "</tr>";
	}
?>
</table>

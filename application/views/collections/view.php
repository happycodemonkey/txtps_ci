<div class='site_body'>
<h1>Collections</h1>

<?php if ($this->ion_auth->is_admin()) : ?>
<a href="/collections/add">Create a new collection</a>
<?php endif; ?>

<table>
<?php
	foreach ($collections as $collection) {
		print "<tr>";
		if ($this->ion_auth->is_admin()) {
			print "<td>" . $collection->name . "</td>";
		} else {
			print "<td><a href='/collections/profile/" . $collection->id . "'>" . $collection->name . "</a></td>";
		}
		if ($this->ion_auth->is_admin()) {
			print "<td><a href='/collections/profile/" . $collection->id . "'>View</a></td>";
			print "<td><a href='/collections/edit/" . $collection->id . "'>Edit</a></td>";
			print "<td><a href='/collections/delete/" . $collection->id . "'>Delete</a></td>";
		}
		print "</tr>";
	}
?>
</table>
</div>

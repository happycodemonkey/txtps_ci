<h2>
<?php
	print "<a href='/collections/view/" . $collection->id . "'>" . $collection->name . "</a> / <a href='/generators/view/id/" . $generator->id . "'>" . $generator->name . "</a> / " . $problem->identifier;
?>
</h2>

<h3>Generator Description</h3>

<?php
	print $generator->description;
?>

<h3>Images</h3>

<?php

	if (empty($images)) {
		print "There are no images for this problem.";
	} else {
		foreach ($images as $image) {
			//load
		}
	}
?>

<h3>Arguments</h3>

<?php
	foreach (explode(",", trim($problem->arguments, "{}")) as $arguments) {
		$value_pair = explode(":", $arguments);
		print trim($value_pair[0], '"') . " = " . trim($value_pair[1], '"') . "<br />";
	}
?>

<h3>Files</h3>

<?php

	if (empty($files)) {
		print "There are no files for this problem.";
	} else {
		foreach ($files as $file) {
			//load
		}
	}
?>

<h2>Welcome to the Test Problem Server</h2>

<h3 class='accordian_header'>Recent Problems:</h3>
<div class='accordian'>
<?php
	foreach ($recent_problems as $recent_problem) {
		print "<a href='/problems/profile/" . $recent_problem->id . "'>" . $recent_problem->identifier . "</a><br />";
	}
?>
</div>

<h3 class='accordian_header'>Recent Generators:</h3>
<div class='accordian'>
<?php
	foreach ($recent_generators as $recent_generator) {
		print "<a href='/generators/profile/" . $recent_generator->id . "'>" . $recent_generator->name . "</a><br />";
	}
?>
</div>

<h3 class='accordian_hearder'>Recent Collections:</h3>
<div class='accordian'>
<?php
	foreach ($recent_collections as $recent_collection) {
		print "<a href='/collections/profile/" . $recent_collection->id . "'>" . $recent_collection->name . "</a><br />";
	}
?>
</div>


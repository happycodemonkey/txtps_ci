<div id='home_wrapper' class='site_body'>
<div id='recent_problems'>
	<h2>Recent Problems:</h2>
	<?php
		$i = 0;
		foreach ($recent_problems as $recent_problem) {
			$class = $i%2==0 ? "even" : "odd";
			print "<div class='problem $class'><a href='/problems/profile/" . $recent_problem->id . "'>" . $recent_problem->identifier . "</a></div><br />";
			$i++;
		}
		
		if (empty($recent_problems)) {
			print "<div class='problem'>There are no problems defined. <a href='/problems/add'>Add one!</a></div>";
		}
	?>
</div>

<div id='recent_generators'>
	<h2>Recent Generators:</h2>
	<?php
		$i = 0;
		foreach ($recent_generators as $recent_generator) {
			$class = $i%2==0 ? "even" : "odd";
			print "<div class='generator $class'><a href='/generators/profile/" . $recent_generator->id . "'>" . $recent_generator->name . "</a></div><br />";
			$i++;
		}

		if (empty($recent_generators)) {
			print "<div class='generator'>There are no generators defined. <a href='/generators/add'>Add one!</a></div>";
		}
	?>
</div>

<div id='recent_collections'>
	<h2>Recent Collections:</h2>
	<?php
		$i = 0;
		foreach ($recent_collections as $recent_collection) {
			$class = $i%2==0 ? "even" : "odd";
			print "<div class='collection $class'><a href='/collections/profile/" . $recent_collection->id . "'>" . $recent_collection->name . "</a></div><br />";
			$i++;
		}
		
		if (empty($recent_collections)) {
			print "<div class='collection'>There are no collections defined. <a href='/collections/add'>Add one!</a></div>";
		}
	?>
</div>
</div>


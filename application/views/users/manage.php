<?php
	$this->load->library('ion_auth');


	echo "<table>";

	foreach ($this->ion_auth->users()->result() as $user) {
		echo "<tr>";
		echo "<td>" . $user->email . "</td>";
			echo "<td><a href='/users/manage/admin/" . $user->id . "'>";
		if (!$this->ion_auth->in_group('admin', $user->id)) {
			echo "Grant Admin";
		} else {
			echo "Revoke Admin";
		}
		echo "</a></td>";
		echo "<td><a href='/users/manage/delete/" . $user->id . "'>Delete</a></td>";
		echo "</tr>";
	}

	echo "</table>";
?>

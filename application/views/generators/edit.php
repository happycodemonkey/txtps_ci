<div class='site_body'>
<h1>Edit Generator <?php print $generator->name; ?></h1>
<?php
	if (isset($saved)) {
		echo "Your generator was successfully created.";
	} else if (isset($error)) {
		echo $error;
	}

	echo "<h3 class='error'>" . validation_errors() . "</h3>";

	$this->load->helper('form');
?>
	<h2 class='accordian_header'>Overview</h2>
	<div class='accordian' id='overview'>
		<?php 
		echo form_open_multipart('generators/edit');
		echo form_hidden('generator_id', $generator->id);
		?>
		<?php echo form_label('<b>*Name:</b>'); ?>
		<br />
		<?php echo form_input('generator_name', isset($generator->name) ? $generator->name : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Collection:</b>'); ?>
		<br />
		<?php echo $collection->name; ?>
		<br /><br />
		<?php echo form_label('<b>Description:</b>'); ?>
		<br />
		<?php echo form_textarea('generator_description', isset($generator->description) ? $generator->description : ''); ?>
		<br /><br />
		<?php echo form_label('<b>*Script:</b>'); ?>
		<br />
		<?php echo form_input('generator_script', isset($generator->script) ? $generator->script : ''); ?>
		<br /><br />
	</div>
<?php	
	echo form_submit('submit', 'Update Generator');
	echo form_close();
        echo "<br /><br />";
?>
        <div id='added_arguments'>
                <?php 
			print "<b><a href='/generators/add_arguments/" . $generator->id . "'>Add Arguments</a></b>";
			print "<br /><br />";
                        foreach ($arguments as $argument) {
                                print $argument->variable;
                                $argument->description ? print " : " . $argument->description : print " : No description "; 
                                print "&nbsp;&nbsp;<a href='/generators/delete_argument/" . $argument->id . "/" . $generator->id . "/edit'>Delete</a>";
                                print "&nbsp;&nbsp;<a href='/generators/edit_argument/" . $argument->id . "/" . $generator->id . "'>Edit</a><br />";
                        }
                ?>
        </div>
</div>

<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') createSubForm();
else {
	$sql = buildSubQuery($_POST['sub_name'], $_POST['sub_description']);
	
	// check if the query went through
	if (!$conn->query($sql)) echo 'Adding subject was unsuccessful.';
	else {
		echo 'New subject was added.';
	}
}

include 'footer.php';
?>
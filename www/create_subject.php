<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	if ($_SESSION['signed_in'] == true) {
		if ($_SESSION['user_level'] > 1) 
			createSubForm();
		else echo 'You do not have the authority to create Subjects.';
	}
	else echo 'You must be logged in to add Subjects.';
}
else {
	$sql = buildSubQuery($_POST['sub_name'], $_POST['sub_description']);
	
	// check if the query went through
	if (!$conn->query($sql)) echo 'Adding subject was unsuccessful.';
	else echo 'New subject was added.<META http-equiv="refresh" content="1;URL=index.php">';
}

include 'footer.php';
?>
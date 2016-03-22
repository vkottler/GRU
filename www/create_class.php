<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	if ($_SESSION['signed_in'] == true) {
		if ($_SESSION['user_level'] > 0) 
			createClassForm();
		else echo 'You do not have the authority to create Classes.';
	}
	else echo 'You must be logged in to add Classes.';
}
else {
	$sql = buildClassQuery($_POST['class_name'], $_POST['class_description'], $_POST['subject_id'], $_SESSION['user_id']);
	
	// check if the query went through
	if (!$conn->query($sql)) echo 'Adding subject was unsuccessful.';
	else echo 'New class was added.<META http-equiv="refresh" content="1;URL=index.php">';
}

include 'footer.php';
?>
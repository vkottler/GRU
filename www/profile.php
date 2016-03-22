<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

// don't allow people to manipulate URL to edit other people's profiles
if ($_SESSION['logged_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] != $_SESSION['user_id']) {
	printf("Your ID: %d ID for page: %d", $_GET['id'], $_SESSION['user_id']);
	echo 'You can only edit your own profile!';
}

// editting your own profile
else if ($_SESSION['loggedin'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] == $_SESSION['user_id']) {
	echo 'Viewing/editting your profile.';
}

//viewing someone's profile
else {
	echo 'Viewing someone else\'s profile.';
}

include 'footer.php';
?>
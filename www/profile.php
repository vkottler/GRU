<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

// don't allow people to manipulate URL to edit other people's profiles
if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] != $_SESSION['user_id']) {
	echo 'You can only edit your own profile!';
}

// editting your own profile
else if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] == $_SESSION['user_id']) {
	
	echo $_SESSION['user_fname'] .' '. $_SESSION['user_lname'].'<br>';
	echo $_SESSION['user_name'].'<br>';
	echo $_SESSION['user_email'].'<br>';
	echo $_SESSION['user_pass'].'<br>';
	echo $_SESSION['user_level'];
	
	
}

//viewing someone's profile
else {
	echo 'Viewing someone else\'s profile.';
}

include 'footer.php';
?>
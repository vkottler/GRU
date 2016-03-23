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
	$sql = 'SELECT * FROM `forumData`.`users` WHERE user_id='.$id;
	$result = $conn->query($sql);
	$data = $result->fetch_row();

	
	echo "Name: ".$data[1] .' '. $data[2].'<br>';
	echo "Username: ".$data[3].'<br>';
	echo "Email: ".$data[6].'<br>';
	echo "Password: ".$data[5].'<br>';
	echo "Level: ".$data[7].'<br> <a> Edit</a>';
	
	
}

//viewing someone's profile
else {
	echo 'Viewing someone else\'s profile.';
}

include 'footer.php';
?>
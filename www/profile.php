<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

$sql = 'SELECT * FROM `forumData`.`users` WHERE user_id='.$_GET['id'];
$result = $conn->query($sql);
$data = $result->fetch_row();

// if we get here, user is trying to update their profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo 'You cannot update your profile at this time. It is being implemented very soon!<br><br>';
}

// don't allow people to manipulate URL to edit other people's profiles
if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] != $_SESSION['user_id']) {
	echo 'You can only edit your own profile!';
}

// editting your own profile
else if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] == $_SESSION['user_id']) {
	
	echo '<form action="" method="post">';
	
	echo "Name: ".$data[1].' '. $data[2].' <span id="name"><input type="button" value="Edit" onClick="changeAttribute(\'name\', \'profileForm\')"></span><br>';
	echo "Username: ".$data[3].' '. '	   <span id="username"><input type="button" value="Edit" onClick="changeAttribute(\'username\', \'profileForm\')"></span><br>';
	echo "Email: ".$data[6].' '. '		   <span id="email"><input type="button" value="Edit" onClick="changeAttribute(\'email\', \'profileForm\')"></span><br>';
	echo '								   <span id="password"><input type="button" value="Change Password" onClick="changeAttribute(\'password\', \'profileForm\')"></span><br>';
	echo "Level: ".$data[8];
	
	echo '<br><br><div id="profileForm" style="display:none"><input type="submit" value="Update Fields"></div></form>';
}

//viewing someone's profile
else {
	echo "Name: ".$data[1] .' '. $data[2].' '. '<br>';
	echo "Username: ".$data[3].' '. '<br>';
	echo "Email: ".$data[6].' '. '<br>';
	echo "Level: ".$data[8];
}

include 'footer.php';
?>
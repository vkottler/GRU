<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

$sql = 'SELECT * FROM `forumData`.`users` WHERE user_id='.$_GET['id'];
$result = $conn->query($sql);
$data = $result->fetch_row();

// don't allow people to manipulate URL to edit other people's profiles
if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] != $_SESSION['user_id']) {
	echo 'You can only edit your own profile!';
}

// editting your own profile
else if ($_SESSION['signed_in'] == true && strcmp($_GET['view'],"edit") == 0 && $_GET['id'] == $_SESSION['user_id']) {
echo "<script>
		function displayTextBox(){
		document.write('<input type=\"text\" name=\"firstname\">');
}
		</script>";
	echo "Name: ".$data[1] .' '. $data[2].' '. '<input type="submit" value="Edit" onClick="displayTextBox()"><br>';
	echo "Username: ".$data[3].' '. '<a href="JavaScript:void(0)" onClick="displayTextBox()">Edit</a><br>';
	echo "Email: ".$data[6].' '. '<input type="submit" value="Edit"><br>';
	echo '<input type="submit" value="Change Password"> <br>';
	echo "Level: ".$data[8];
	
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
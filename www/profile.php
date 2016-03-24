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
		function changeName(){
		document.getElementById('name').innerHTML='<input type=\"text\"> <input type=\"submit\" value=\"Change\" onClick=\"\">';
}
		function changeUsername(){
		document.getElementById('username').innerHTML='<input type=\"text\"> <input type=\"submit\" value=\"Change\" onClick=\"\">';
}
		function changeEmail(){
		document.getElementById('email').innerHTML='<input type=\"text\"> <input type=\"submit\" value=\"Change\" onClick=\"\">';
}
		function changePassword(){
		document.getElementById('password').innerHTML='<input type=\"text\"> <input type=\"submit\" value=\"Change\" onClick=\"\">';
}
		</script>";

	echo "Name: ".$data[1].' '. $data[2].'<div id="name"><input type="submit" value="Edit" onClick="changeName()"><div>';
	echo "Username: ".$data[3].' '. '<div id="username"><input type="submit" value="Edit" onClick="changeUsername()"><div>';
	echo "Email: ".$data[6].' '. '<div id="email"><input type="submit" value="Edit" onClick="changeEmail()"><div>';
	echo '<div id="password"><input type="submit" value="Change Password" onClick="changePassword()"><div>';
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
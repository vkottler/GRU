<?php
//connect.php
$servername = 'localhost';
$username   = 'root';
$password   = 'wizard83';
//$database   = 'forumData';

$conn = new mysqli($servername, $username, $password);
 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>

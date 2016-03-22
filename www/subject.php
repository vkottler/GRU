<?php
include 'connect.php';
include 'header.php';

if (isset($_GET['id'])) {
	printf("You are looking at information for Subject %d.", $_GET['id']);
}
else {
	echo 'No Subject specified.';
}


include 'footer.php';
?>
<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if (isset($_GET['id'])) {
	printf("You are looking at information for Class %d.", $_GET['id']);
}
else {
	echo 'No Class specified.';
}

include 'footer.php';
?>
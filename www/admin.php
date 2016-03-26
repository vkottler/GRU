<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if ($_SESSION['user_level'] < 3) echo 'You are not an admin!<META http-equiv="refresh" content="1;URL=index.php">';
else {
	echo 'You are viewing the admin page.';
}

include 'footer.php';
?>
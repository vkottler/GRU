<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') createSubForm();
else {
	echo var_dump($_POST);
}

include 'footer.php';
?>
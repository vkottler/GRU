<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if (isset($_GET['id'])) {
	$classData = getClassData($_GET['id']);
	if ($classData->num_rows != 1) {
		echo 'Class not found';
	}
	else {
		$data = $classData->fetch_row();
		echo var_dump($data);
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
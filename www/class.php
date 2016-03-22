<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if (isset($_GET['id'])) {
	$classData = $conn->query(getClassData($_GET['id']));
	if ($classData->num_rows != 1) {
		echo 'Class not found.';
	}
	else {
		$data = $classData->fetch_row();
		echo '<h2>'.$data[1].'</h2>';
		echo $data[2];
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
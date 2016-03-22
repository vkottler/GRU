<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h2>Class</h2>';

if (isset($_GET['id'])) {
	$classData = $conn->query(getClassData($_GET['id']));
	if ($classData->num_rows != 1) {
		echo 'Class not found.';
	}
	else {
		$data = $classData->fetch_row();
		echo '<h3>'.$data[1].'</h3>';
		echo $data[2];
		echo '<br><br>Added by: '.userFullNameFromID($data[4]);
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
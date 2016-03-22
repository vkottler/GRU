<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if (isset($_GET['id'])) {
	$subjectData = $conn->query(getData("subject", $_GET['id']));
	if ($subjectData->num_rows != 1) echo 'Subject not found.';
	else {
		$data = $subjectData->fetch_row();
		echo '<h2>'.$data[1].'</h2><hr><br>';
		echo $data[2];
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
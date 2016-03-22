<?php
include 'connect.php';
include 'header.php';

if (isset($_GET['id'])) {
	$subjectData = getData("subject", $_GET['id']);
	if ($subjectData->num_rows != 1) {
		echo 'Subject not found.';
	}
	else {
		$data = $subjectData->fetch_row();
		echo var_dump($data);
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
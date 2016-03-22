<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h2>Subject</h2><hr>';

if (isset($_GET['id'])) {
	$subjectData = $conn->query(getData("subject", $_GET['id']));
	if ($subjectData->num_rows != 1) echo 'Subject not found.';
	else {
		$data = $subjectData->fetch_row();
		echo '<h3>'.$data[1].'</h3><br>';
		echo $data[2];
	}
}
else echo 'No Class specified.';


include 'footer.php';
?>
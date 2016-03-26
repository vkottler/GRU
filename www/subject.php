<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

if (isset($_GET['id'])) {
	$subjectData = $conn->query(getData("subject", $_GET['id']));
	if ($subjectData->num_rows != 1) echo 'Subject not found.';
	else {
		$data = $subjectData->fetch_row();
		echo '<h2>'.$data[1].'</h2>';
		echo $data[2].'<br><hr><br>';
		$sql = 'SELECT * FROM `forumData`.`classes` WHERE `class_sub`='.$_GET['id'];
		$result = $conn->query($sql);
		if (!$result) echo 'We could not search for classes for this subject at this time.';
		else if ($result->num_rows == 0) echo 'This subject doesn\'t have any classes yet!';
		else {
			$num_rows = $result->num_rows;
			echo '<table>';
			for ($i = 0; $i < $num_rows; $i++) {
				$data2 = $result->fetch_row();
				echo '<tr><td><a href="class.php?id='.$data2[0].'">'.$data2[1].'</a></td><td>'.$data2[2].'</td></tr>';
			}
			echo '</table>';
		}
	}
}
else showAllSubjects();

include 'footer.php';
?>
<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h2>Class</h2>';

if (isset($_GET['id'])) {
	$classData = $conn->query(getClassData($_GET['id']));
	if ($classData->num_rows != 1) echo 'Class not found.';
	else {
		$data = $classData->fetch_row();
		echo '<h3>'.$data[1].'</h3><br>';
		echo $data[2].'<input type="button" value="Edit Description" onClick="javascript:revealForm("classDescription")" style="display:inline-block;">"';
		echo '<div id="classDescription" style="display:none">Hello!</div>';
		echo '<br><br>Added by: '.userFullNameFromID($data[4]);
	}
}
else echo 'No Class specified.';

include 'footer.php';
?>
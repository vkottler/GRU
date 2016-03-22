<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h2>Class</h2>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo var_dump($_POST);
}

else {
if (isset($_GET['id'])) {
	$classData = $conn->query(getClassData($_GET['id']));
	if ($classData->num_rows != 1) echo 'Class not found.';
	else {
		$data = $classData->fetch_row();
		echo '<h3>'.$data[1].'</h3><br>';
		
		$jsArg1 = "'classDescription'";
		$jsArg2 = "'currDescription'";
		
		$classForm = '<form action="" method="post">
		              <textarea name="new_description">'.$data[2].'</textarea><br>
		              <input type="submit" value="Submit">
		              </form>';
		
		echo '<div id="currDescription">'.$data[2].'<input type="button" value="Edit Description" onClick="javascript:showClassDescForm('.$jsArg1.', '.$jsArg2.')" style="display:inline-block;"></div>';
		echo '<div id="classDescription" style="display:none">'.$classForm.'</div>';
		echo '<br><br>Added by: '.userFullNameFromID($data[4]);
	}
}
else echo 'No Class specified.';
}

include 'footer.php';
?>
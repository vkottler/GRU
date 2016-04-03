<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

$fourSpaces = "&nbsp;&nbsp;&nbsp;&nbsp;";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = "UPDATE `forumData`.`classes` SET `class_description`='".$_POST['new_description']."'
			WHERE `class_id`=".$_POST['curr_id'];
	$result = $conn->query($sql);
	if (!$result) echo 'Uh oh. Something went wrong!';
	else echo 'Class Description has been updated.<br><br>';
}

if (isset($_GET['id'])) {
	$classData = $conn->query(getClassData($_GET['id']));
	if ($classData->num_rows != 1) echo 'Class not found.';
	else {
		$data = $classData->fetch_row();
		echo '<h2>'.$data[1].'</h2>';
		
		$jsArg1 = "'classDescription'";
		$jsArg2 = "'currDescription'";
		
		$classForm = '<form action="" method="post">
		              <textarea name="new_description">'.$data[2].'</textarea><br>
		              <input type="hidden" name="curr_id" value='.$_GET['id'].'>
		              <input type="submit" value="Submit">
		              </form>';
		
		echo '<div id="currDescription">'.$data[2].$fourSpaces.'<input type="button" value="Edit Description" onClick="javascript:showClassDescForm('.$jsArg1.', '.$jsArg2.')" style="display:inline-block;"></div>
                <br><i>Added by: '.userFullNameFromID($data[4]).'</i><br><hr><br>';
        echo'<div id="addTopic"><input type="button" value="New Topic" onClick="javascipt:addTopic()></div>';
		echo '<div id="classDescription" style="display:none">'.$classForm.'</div>';
	}
}
else echo 'No Class specified.';

include 'footer.php';
?>
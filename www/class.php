<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

$fourSpaces = "&nbsp;&nbsp;&nbsp;&nbsp;";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // updating description    
    if (isset($_POST['new_description'])) {
	    $sql = "UPDATE `forumData`.`classes` SET `class_description`='".$_POST['new_description']."'
			WHERE `class_id`=".$_POST['curr_id'];
	    $result = $conn->query($sql);
	    if (!$result) echo 'Uh oh. Something went wrong!';
	    else echo 'Class Description has been updated.<br><br>';
    }

    // adding a post
    else if (isset($_POST['postTitle'])) {
        if (strcmp($_POST['postTitle'], "") == 0 || strcmp($_POST['questionContent'], "") == 0) {
            echo 'You can\'t add an unnamed or empty question!';
        }
        else {
            $sql = buildPostQuery($_POST['postTitle'], $_POST['questionContent'], $_SESSION['user_id'], $_SESSION['curr_class']);
            $conn->query($sql);
            echo 'Your post was added.<br><br>';
        }
    }
}

if (isset($_GET['id']) || isset($_SESSION['curr_class'])) {
    if (isset($_GET['id'])) $_SESSION['curr_class'] = $_GET['id'];
	$classData = $conn->query(getClassData($_SESSION['curr_class']));
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
		echo '<div id="classDescription" style="display:none">'.$classForm.'</div>';

        echo showPosts($_SESSION['curr_class']);

        if ($_SESSION['signed_in'] == true) echo'<div id="addPost"><input type="button" value="New Post" onClick="javascipt:addPostForm(\'show\')"></div>';
	}
}
else echo 'No Class specified.';

include 'footer.php';
?>
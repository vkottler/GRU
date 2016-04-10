<?php

$fourSpaces = "&nbsp;&nbsp;&nbsp;&nbsp;";

function signInForm() {
	echo '<form method="post" action="">
           Username: <input type="text" name="user_name" /><br>
           Password: <input type="password" name="user_pass"><br>
         <input type="submit" value="Sign in" />
         </form>';
}

function createSubForm() {
	echo '<form method="post" action="">
		  Subject: <input type="text" name="sub_name" /><br><br>
		  Description:<br><textarea name="sub_description" /></textarea><br><br>
		  <input type="submit" value="Add Subject" />
		  </form>';
}

function createClassForm() {
	global $conn;
	echo '<form method="post" action="">
		  Name: <input type="text" name="class_name"><br><br>
		  Description:<br><textarea name="class_description"></textarea><br><br>
		  Subject: <select name="subject_id">';
		  $result = $conn->query("SELECT * FROM `forumData`.`subject`;");
		  $num_rows = $result->num_rows;
		  for ($i = 0; $i < $num_rows; $i++) {
		  	  $data = $result->fetch_row();
		      echo '<option value='.$data[0];
		      if ($data[0] == $_GET['id']) echo ' selected="selected"';
		      echo '>';
		      echo $data[1].'</option>';
		  }
		  echo '</select><br><br>
		  <input type="submit" value="Submit">
		  </form>';
}

function signupForm() {
	echo '<table style="width:50%">';
	echo '<form method="post" action="">
    	<tr><td>First name:</td><td><input type="text" name="user_fname"></td></tr>
    	<tr><td>Last name:</td><td><input type="text" name="user_lname"></td></tr>
        <tr><td>Username:</td><td><input type="text" id="user_name" name="user_name" onKeyUp="checkUname(\'user_name\', \'uname_feedback\')" /><span id="uname_feedback"></span></td></tr>
        <tr><td>Password:</td><td><input type="password" name="user_pass" id="user_pass" onKeyUp="checkPW(\'user_pass\', \'pw_feedback\')"><span id="pw_feedback">(cannot be empty)</span></td></tr>
        <tr><td>Password again:</td><td><input type="password" name="user_pass_check"></td></tr>
        <tr><td>E-mail:</td><td><input type="email" name="user_email"></td></tr>
		<tr><td colspan=2></td></tr>
        <tr><td><input type="submit" value="Sign Up"></td><td></td></tr>
     </form>';
	echo '</table>';
}

function getAllUsernames() {
	$retval = array();
	global $conn;
	$sql = "SELECT `user_name` FROM `forumData`.`users`;";
	$result = $conn->query($sql);
	$num_rows = $result->num_rows;
	$retval[0] = $num_rows;
	for ($i = 1; $i < $num_rows + 1; $i++) {
		$data = $result->fetch_row();
		$retval[$i] = $data[0];
	}
	return $retval;
}

function buildSubQuery($name, $description) {
	$sql = 'INSERT INTO `forumData`.`subject` (`subject_name`, `subject_description`)
			VALUES ("'.$name.'", "'.$description.'")';
	return $sql;
}

function buildClassQuery($name, $description, $subject, $user) {
	$sql = 'INSERT INTO `forumData`.`classes` (`class_name`, `class_description`, `class_sub`, `class_by`, `class_date`)
			VALUES ("'.$name.'", "'.$description.'", '.$subject.', '.$user.', NOW())';
	return $sql;
}

function buildPostQuery($title, $content, $user, $class) {
    $sql = 'INSERT INTO `forumData`.`posts` (`post_by`, `post_class`, `post_content`, `post_title`, `post_date`)
            VALUES ('.$user.', '.$class.', "'.$content.'", "'.$title.'", NOW())';
    return $sql;
}

function buildSignupQuery($fname, $lname, $uname, $pass, $email) {
	$sql = "INSERT INTO `forumData`.`users` (`user_fname`,`user_lname`,`user_name`,`user_pass`,`user_email`,`user_date`,`user_level`)
                VALUES ('" .$fname. "', '".$lname."', '".$uname."', '" .sha1($pass). "', '" .$email. "', NOW(), 0)";
	return $sql;
}

function buildSigninQuery($uname, $pass) {
	$sql = "SELECT `user_id`,`user_fname`,`user_level` FROM `forumData`.`users`
            WHERE `user_name` LIKE ('" .$uname. "')
            AND `user_pass` LIKE ('".sha1($pass)."')";
	return $sql;
}

function showAllSubjects() {
	global $conn;
	$fourSpaces = '&nbsp;&nbsp;&nbsp;&nbsp;';
	$sql = "SELECT * FROM `forumData`.`subject`;";
	$result = $conn->query($sql);
	if (!$result) echo 'Subjects cannot be viewed at this time.';
	else {
		$num_rows = $result->num_rows;
		if ($num_rows == 0) echo 'No Subjects have been created yet!';
		else {
			echo '<table>';
			echo '<tr>';
			echo '<td><h2 style="display:inline-block;">Subject</h2>&nbsp;&nbsp;&nbsp;&nbsp;
					<form action="create_subject.php" style="display:inline-block;"><input type="submit" value="Create New"></form></td>';
			echo '<td><b>Description</b></td>';
			echo '</tr>';
			echo '<tr><td colspan="2"><hr></td></tr>';
			for ($i = 0; $i < $num_rows; $i++) {
				$data = $result->fetch_row();
				echo '<tr>';
					echo '<td class="leftpart">';
						echo '<h3 style="display:inline-block;"><a href="subject.php?id='.$data[0].'">'.$data[1].'</a></h3>&nbsp;&nbsp;&nbsp;&nbsp;
								<form action="create_class.php" method="get" style="display:inline-block;"><input type="hidden" name="id" value='.$data[0].'><input type="submit" value="Add Class"></form>';
					echo '</td>';
					echo '<td class="rightpart">';
						echo $data[2];
					echo '</td>';
				echo '</tr>';
				$result2 = $conn->query("SELECT * FROM `forumData`.`classes` WHERE `class_sub`=".$data[0]);
				$num_rows2 = $result2->num_rows;
				if ($num_rows2 == 0) echo '<tr><td>No classes yet!</td><td></td></tr>';
				else {
					for ($j = 0; $j < $num_rows2; $j++) {
						$data2 = $result2->fetch_row();
						echo '<tr>';
						echo '<td>'.$fourSpaces.'<a href="class.php?id='.$data2[0].'">'.$data2[1].'</a></td><td>'.$data2[2].'</td>';
						echo '</tr>';
					}
				}
			}
			echo '</table>';
		}
	}
}

function getData($table, $index) {
	$sql = 'SELECT * FROM `forumData`.`'.$table.'` WHERE '.$table.'_id='.$index;
	return $sql;
}

function getClassData($index) {
	$sql = 'SELECT * FROM `forumData`.`classes` WHERE class_id='.$index;
	return $sql;
}

function userFullNameFromID($id) {
	global $conn;
	$sql = 'SELECT * FROM `forumData`.`users` WHERE user_id='.$id;
	$result = $conn->query($sql);
	if ($result->num_rows != 1) return "";
	else {
		$data = $result->fetch_row();
		return $data[1].' '.$data[2];
	}
}
function showPosts($classID) {
    global $conn;
    global $fourSpaces;
    $result = $conn->query("SELECT * FROM `forumData`.`posts` WHERE `post_class`=".$classID.";");
    $num_rows = $result->num_rows;
    if ($num_rows == 0) {
        echo 'No posts!';
        return;
    }
    for ($i = 0; $i < $num_rows; $i++) {
        $data = $result->fetch_row();
        $date = date_create($data[3]);
		$date = date_format($date, "m/d/Y");
        echo 'Post '.$data[0].': '.($i + 1).'<br>';
        echo $fourSpaces.'Content: '.$data[2].'<br>';
        echo $fourSpaces.'By: '.userFullNameFromID($data[5]).' at '.$date;
    }
}

?>

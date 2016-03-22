<?php

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
		      echo '<option ';
		      if ($data[0] = $_GET['id']) echo 'selected';
		      echo ' value='.$data[0].'>'.$data[1].'</option>';
		  }
		  echo '</select><br><br>
		  <input type="submit" value="Submit">
		  </form>';
}

function signupForm() {
	echo '<form method="post" action="">
    	First name: <input type="text" name="user_fname" /><br>
    	Last name: <input type="text" name="user_lname" /><br>
        Username: <input type="text" name="user_name" /><br>
        Password: <input type="password" name="user_pass"><br>
        Password again: <input type="password" name="user_pass_check"><br>
        E-mail: <input type="email" name="user_email"><br><br>
        <input type="submit" value="Sign Up" />
     </form>';
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
				$result2 = $conn->query("SELECT * FROM `forumData`.`classes` WHERE `class_sub`='.$data[0].'");
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

?>

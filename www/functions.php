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
	$sql = "SELECT * FROM `forumData`.`subject`;";
	$result = $conn->query($sql);
	if (!$result) echo 'Subjects cannot be viewed at this time.';
	else {
		$num_rows = $result->num_rows;
		echo 'Number of rows: '.var_dump($num_rows);
		if ($num_rows == 0) echo 'No Subjects have been created yet!';
		else {
			//echo '<table>';
			for ($i = 0; $i < $num_rows; $i++) {
				$data = $result->fetch_row();
				echo var_dump($data).'<br>';
				//echo '<tr>';
				//	echo '<td class="leftpart">';
				//		echo '<h3><a href="category.php?id='.$data[0].'">'.$data[1].'</a></h3>';
				//	echo '</td>';
				//	echo '<td class="rightpart">';
				//		echo $data[2];
				//	echo '</td>';
				//echo '</tr>';
			}
			//echo '</table>';
		}
	}
}

?>
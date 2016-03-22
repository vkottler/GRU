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
		  Subject: <input type="text" name="sub_name" /><br>
		  Description:<br><textarea name="sub_description" /></textarea><br>
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

?>
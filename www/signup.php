<?php
// signup.php
include 'connect.php';
include 'header.php';

echo '<h3>Sign up for GRU</h3>';

if (isset ( $_SESSION ['signed_in'] ) && $_SESSION ['signed_in'] == true) {
	echo 'You are already signed up! You can <a href="signout.php">sign out</a> if you want.';
} 

else {
	
	if ($_SERVER ['REQUEST_METHOD'] != 'POST') {
		/*
		 * the form hasn't been posted yet, display it
		 * note that the action="" will cause the form to post to the same page it is on
		 */
		echo '<form method="post" action="">
    	First name: <input type="text" name="first_name" /><br>
    	Last name: <input type="text" name="last_name" /><br>
        Username: <input type="text" name="user_name" /><br>
        Password: <input type="password" name="user_pass"><br>
        Password again: <input type="password" name="user_pass_check"><br>
        E-mail: <input type="email" name="user_email"><br><br>
        <input type="submit" value="Sign Up" />
     </form>';
	} 
	else {
		/*
		 * so, the form has been posted, we'll process the data in three steps:
		 * 1. Check the data
		 * 2. Let the user refill the wrong fields (if necessary)
		 * 3. Save the data
		 */
		$errors = array (); /* declare the array for later use */
		
		if (isset ( $_POST ['user_name'] )) {
			// the user name exists
			if (! ctype_alnum ( $_POST ['user_name'] ))
				$errors [] = 'The username can only contain letters and digits.';
			if (strlen ( $_POST ['user_name'] ) > 30)
				$errors [] = 'The username cannot be longer than 30 characters.';
		} else
			$errors [] = 'The username field must not be empty.';
		
		if (isset ( $_POST ['user_pass'] )) {
			if ($_POST ['user_pass'] != $_POST ['user_pass_check'])
				$errors [] = 'The two passwords did not match.';
		}
		else
			$errors [] = 'The password field cannot be empty.';
		
		if (! empty ( $errors )) { 
			/*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
			echo 'Uh-oh.. a couple of fields are not filled in correctly..';
			echo '<ul>';
			foreach ( $errors as $key => $value) /* walk through the array so all the errors get displayed */
      		echo '<li>' . $value . '</li>'; /* this generates a nice error list */
			echo '</ul><br>';
		} 
		else {
			// the form has been posted without, so save it
			// notice the use of mysql_real_escape_string, keep everything safe!
			// also notice the sha1 function which hashes the password
			$sql = "INSERT INTO
                    `forumData`.`users` (`user_fname`,`user_lname`,`user_name`,user_email`,`user_date`,`user_level`)
                VALUES ('" .$_POST ['user_fname']. "', '".$_POST['user_lname']."', '".$_POST['user_name']."'
                       '" . sha1 ( $_POST ['user_pass'] ) . "', '" .$_POST ['user_email']. "', NOW(), 0)";
			
			if (! $conn->query ( $sql )) {
				// something went wrong, display the error
				echo 'Something went wrong while registering. Please try again later.<br>';
				echo $sql;
				// echo $conn->error; //debugging purposes, uncomment when needed
			} 
			else {
				echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
				$_SESSION['logged_in'] = true;
				$_SESSION['user_fname'] = $_POST['user_fname'];
			}
		}
	}
}

if ($_SESSION['signed_in']) { ?>
<script type="text/javascript">
var name = "<?php echo $_SESSION['user_fname']; ?>";
document.getElementById('userbar').innerHTML = "Hello " + name + ". Not you? <a href='signout.php'>Sign out</a>";
</script>
<?php } 

include 'footer.php';
?>

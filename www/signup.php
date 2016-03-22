<?php
// signup.php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h3>Sign up for GRU</h3>';

if (isset ( $_SESSION ['signed_in'] ) && $_SESSION ['signed_in'] == true) {
	echo 'You are already signed in. You can <a href="signout.php">sign out</a> if you want.';
} 

else {
	if ($_SERVER ['REQUEST_METHOD'] != 'POST') signupForm();
	else {
		
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
			$sql = buildSignupQuery($_POST['user_fname'], $_POST['user_lname'], $_POST['user_name'], $_POST['user_pass'], $_POST['user_email']);
			if (!$conn->query($sql)) echo 'Something went wrong while registering. Please try again later.<br>';
			 
			else {
				echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
				$_SESSION['signed_in'] = true;
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

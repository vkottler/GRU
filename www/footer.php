</div><!-- content -->
</div><!-- wrapper -->
<div id="footer">Created by the Software Development Club</div>
</body>
<?php 
if (isset($_SESSION['signed_in'])) 
	$userbar = 'Hello '.$_SESSION['user_fname'].'. Not you? <a href="signout.php">Sign out</a>';
else 
	$userbar = '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
?>
</html>
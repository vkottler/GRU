<?php

include 'connect.php';
include 'header.php';
include 'functions.php';
 
echo '<h3>Sign in to GRU</h3>';
 
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    echo 'You are already signed in. You can <a href="signout.php">sign out</a> if you want.';

else {
    if($_SERVER['REQUEST_METHOD'] != 'POST') signInForm();
    else {
        $errors = array(); /* declare the array for later use */
         
        if(!isset($_POST['user_name']))
            $errors[] = 'The username field must not be empty.';
         
        if(!isset($_POST['user_pass']))
            $errors[] = 'The password field must not be empty.';
         
        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
        {
            echo 'Uh-oh.. a couple of fields are not filled in correctly..';
            echo '<ul>';
            foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
                echo '<li>' . $value . '</li>'; /* this generates a nice error list */
            echo '</ul>';
        }
        else {
        	
            $sql = buildSigninQuery($_POST['user_name'], $_POST['user_pass']);
            
            if(!$result = $conn->query($sql)) echo 'Something went wrong while attempting to sign in. Please try again later.<br>';
         
            else {
                if ($result->num_rows == 0) {
                    echo 'You have supplied a wrong user/password combination. Please try again.<br>';
                    signInForm(); // show form again so they can try again
                }
                else {
                    $_SESSION['signed_in'] = true;
                    
                    $row = $result->fetch_row();
                    
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    $_SESSION['user_id']    = $row[0];
                    $_SESSION['user_fname']  = $row[1];
                    $_SESSION['user_level'] = $row[2];
                    echo 'Welcome, ' . $_SESSION['user_fname'] . '. <a href="profile.php?id='.$_SESSION['user_id'].'&view=edit">Edit your profile.</a>';
                    echo '<META http-equiv="refresh" content="5;URL=index.php">';
                    $result->close();
                }
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

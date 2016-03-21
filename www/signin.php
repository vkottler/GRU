<?php

function signInForm() {
	echo '<form method="post" action="">
           Username: <input type="text" name="user_name" />
           Password: <input type="password" name="user_pass">
         <input type="submit" value="Sign in" />
         </form>';
}

//signin.php
include 'connect.php';
include 'header.php';
 
echo '<h3>Sign in to GRU</h3>';
 
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in. You can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST') signInForm();
    else
    {
        /* so, the form has been posted, we'll process the data in three steps:
            1.  Check the data
            2.  Let the user refill the wrong fields (if necessary)
            3.  Varify if the data is correct and return the correct response
        */
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
        else
        {
            //the form has been posted without errors, so save it
            //notice the use of mysql_real_escape_string, keep everything safe!
            //also notice the sha1 function which hashes the password
            $sql = "SELECT `user_id`,`user_fname`,`user_level`
                    FROM `forumData`.`users`
                    WHERE `user_name` LIKE ('" .($_POST['user_name']). "')
                    AND `user_pass` LIKE ('" . sha1($_POST['user_pass']) . "')";           
            if(!$result = $conn->query($sql)) {
                //something went wrong, display the error
            	echo 'Something went wrong while attempting to sign in. Please try again later.<br>';
            	//echo $conn->error; //debugging purposes, uncomment when needed
            }
            else {
                //the query was successfully executed, there are 2 possibilities
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong
                if ($result->num_rows == 0) {
                    echo 'You have supplied a wrong user/password combination. Please try again.<br>';
                    signInForm();
                }
                else
                {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                    
                    $row = $result->fetch_row();
                    
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    $_SESSION['user_id']    = $row[0];
                    $_SESSION['user_fname']  = $row[1];
                    $_SESSION['user_level'] = $row[2];
                    echo 'Welcome, ' . $_SESSION['user_fname'] . '. <a href="index.php">Proceed to the forum overview</a>.';
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

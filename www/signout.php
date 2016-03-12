<?php
//include 'connect.php';
//include 'header.php';
session_start();
session_destroy();
session_unset();
//$_SESSION['user_id']    = null;
//$_SESSION['user_name']  = null;
//$_SESSION['user_level'] = null;
//$_SESSION['signed_in']	= false;
echo '<META http-equiv="refresh" content="0;URL=index.php">';

//include 'footer.php';

?>
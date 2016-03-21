<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<?php session_start(); $userbar = ""; ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>GRU</title>
    <link rel="stylesheet" href="css/gru_style.css" type="text/css">
</head>
<body>
<h1>GRU</h1>
    <div id="wrapper">
    <div id="menu">
        <a class="item" href="index.php">Home</a> -
        <a class="item" href="create_subject.php">Add a Subject</a> -
        <a class="item" href="create_class.php">Add a Class</a>
        <!--  - <a class="item" href="signin.php">Sign In</a> - -->
        <!-- <a class="item" href="signup.php">Sign Up</a> -->
        <div id="userbar">
        <?php 
        if (isset($_SESSION['signed_in'])) 
			echo 'Hello '.$_SESSION['user_fname'].'. Not you? <a href="signout.php">Sign out</a>';
		else 
			echo '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
		?>
        </div>
    </div>
        <div id="content">

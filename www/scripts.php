
<script type="text/javascript" style="display:none">

var shown = 0;

// get the usernames from a php array to a javascript array
// this is a pretty neat bit of code and it is worth understanding
// how this is possible
<?php $usernames = getAllUsernames(); ?>
var usernames = [<?php 

	for ($i = 1; $i < $usernames[0] + 1; $i++) {
		if ($i == $usernames[0]) echo '"'.$usernames[$i].'"';
		else echo '"'.$usernames[$i].'", ';
	}
	
?>];

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeHTMLback(id, form) { 
	if (id === 'password') document.getElementById(id).innerHTML = '<input type="button" value="Change Password" onclick="changeAttribute(\''+id+'\', \''+form+'\')">';
	else document.getElementById(id).innerHTML = '<input type="button" value="Edit" onclick="changeAttribute(\'' + id + '\', \'' + form + '\')">';
	shown--;
	if (shown == 0) hideForm(form);
}

function changeAttribute(id, form) {
	var newHTML;
	if (id === 'name') newHTML = '<br>First: <input type="text"><br>Last: <input type="text"><br><input type="button" value="Hide" onclick="changeHTMLback(\''+id+'\', \''+form+'\')">';
	else if (id === 'password') { 
		newHTML = '<table style="width:30%"><tr><td>New Password:</td>' + 
			'<td><input type="password"></td></tr>' + 
			'<tr><td>Confirm:</td><td><input type="password"></td></tr>' + 
			'<tr><td></td><td><input type="button" value="Hide" onclick="changeHTMLback(\'' + id + '\', \'' + form + '\')"></td></tr></table>';
	}
	else newHTML = '<input type="text"> <input type="button" value="Hide" onclick="changeHTMLback(\'' + id + '\', \'' + form + '\')">';
	document.getElementById(id).innerHTML = newHTML;
	revealForm(form);
	shown++;
}

function showClassDescForm(divShow, divHide) {
	revealForm(divShow);
	<?php if ($_SESSION['user_level'] > 1) { ?>
    hideForm(divHide);
	<?php } else { ?>
	document.getElementById(divShow).innerHTML = "<b>You don't have the authority to do that!</b>";
	document.getElementById(divShow).style.color = "red";
	<?php } ?>
}

function checkPW(id, toChange) {
	var toCheck = document.getElementById(id).value;
	var message = "";
	if (toCheck.length > 0 && toCheck.length >= 5) message = "";
	else if (toCheck.length > 0 && toCheck.length < 5) {
		message = "Passord too short!";
		document.getElementById(toChange).style.color = "red";
	}
	else { 
		message = "(cannot be empty)";
		document.getElementById(toChange).style.color = "black";
	}
	document.getElementById(toChange).innerHTML = message;
}

function checkUname(id, toChange) {
	var toCheck = document.getElementById(id).value;

	// field is empty
	if (toCheck === "") {
		document.getElementById(toChange).innerHTML = "";
		return;
	}

	// field not yet long enough to check
	else if (toCheck.length < 5) {
		document.getElementById(toChange).innerHTML = "Username too short!";
		document.getElementById(toChange).style.color = "red";
		return;
	}

	// field too long
	else if (toCheck.length > 15) {
		document.getElementById(toChange).innerHTML = "Username too long!";
		document.getElementById(toChange).style.color = "red";
		return;
	}
	
	var result = false;

	// compare current string to all usernames
	for (i = 0; i < <?php echo $usernames[0]; ?>; i++) {
		if (usernames[i] === toCheck) result = true;
	}

	// if found show message
	if (result) {
		document.getElementById(toChange).innerHTML = "Username taken!";
		document.getElementById(toChange).style.color = "red";
	}

	// if available show message
	else {
		document.getElementById(toChange).innerHTML = "Username available!";
		document.getElementById(toChange).style.color = "green";
	}
}
    function addPost(){
        document.getElementById("addPost").innerHTML='<form method="post" action="">Title: <input type="text"><br>Question: <br><textarea name="question"><br><?php addPost()?><input type="submit" value="Submit"></form>';
    }
</script>

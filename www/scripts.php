
<script type="text/javascript">

var shown = 0;

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
	<?php $usernames = getAllUsernames(); ?>
	var usernames = [
	<?php 
		for ($i = 1; $i < $usernames[0] + 1; $i++) {
			if ($i == $usernames[0]) echo '"'.$usernames[$i].'"';
			else echo '"'.$usernames[$i].'", ';
		}
	?>
	];

	for (i = 0; i < <?php echo $usernames[0]; ?>; i++) {
		if (usernames[i] === toCheck) result = true;
	}
	if (result) {
		document.getElementById(toChange).innerHTML = "Username taken!";
		document.getElementById(toChange).style.color = "red";
	}
	else {
		document.getElementById(toChange).innerHTML = "Username available!";
		document.getElementById(toChange).style.color = "green";
	}
}

</script>


<script type="text/javascript">

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeHTMLback(id, oldHTML) { document.getElementById(id).innerHTML = oldHTML; }

function changeName(form) {
	var oldHTML = document.getElementById('name').innerHTML;
	var newHTML = '<br>First: <input type="text"><br>Last: <input type="text"><br><input type="button" value="Hide" onClick="changeHTMLback(\'name\', \'' 
		+ oldHTML + '\')">';
	document.getElementById('name').innerHTML = newHTML;
	revealForm(form);
}

function changeUsername(form) {
	var oldHTML = document.getElementById('username').innerHTML;
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'username\', \''
		+ oldHTML + '\')">';
	document.getElementById('username').innerHTML = newHTML;
	revealForm(form);
}
	
function changeEmail(form) {
	var oldHTML = document.getElementById('email').innerHTML;
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'email\', \''
		+ oldHTML + '\')">';
	document.getElementById('email').innerHTML = newHTML;
	revealForm(form);
}
	
function changePassword(form) {
	var oldHTML = document.getElementById('password').innerHTML;
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'password\', \''
		+ oldHTML + '\')">';
	document.getElementById('password').innerHTML = newHTML;
	revealForm(form);
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

</script>

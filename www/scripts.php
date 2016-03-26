
<script type="text/javascript">

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeName(form) {
	document.getElementById('name').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
	revealForm(form);
}

function changeUsername(form) {
	document.getElementById('username').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
	revealForm(form);
}
	
function changeEmail(form) {
	document.getElementById('email').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
	revealForm(form);
}
	
function changePassword(form) {
	document.getElementById('password').innerHTML = 'Password: <input type="text"> <input type="submit" value="Change" onClick="">';
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

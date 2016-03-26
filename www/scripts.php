
<script type="text/javascript">

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeName() {
	document.getElementById('name').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
}

function changeUsername() {
	document.getElementById('username').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
}
	
function changeEmail() {
	document.getElementById('email').innerHTML = '<input type="text"> <input type="submit" value="Change" onClick="">';
}
	
function changePassword() {
	document.getElementById('password').innerHTML = 'Password: <input type="text"> <input type="submit" value="Change" onClick="">';
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


<script type="text/javascript">

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeHTMLback(id) { 
	document.getElementById(id).innerHTML = '<input type="" value= "" onclick="">';
}


function changeAttribute(id, form) {
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(' + id + ')">';
	document.getElementById(id).innerHTML = newHTML;
	revealForm(form);
}
function changeName(form) {
	var newHTML = '<br>First: <input type="text"><br>Last: <input type="text"><br><input type="button" value="Hide" onClick="changeHTMLback(\'name\')">';
	document.getElementById('name').innerHTML = newHTML;
	revealForm(form);
}

function changeUsername(form) {
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'username\')">';
	document.getElementById('username').innerHTML = newHTML;
	revealForm(form);
}
	
function changeEmail(form) {
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'email\')">';
	document.getElementById('email').innerHTML = newHTML;
	revealForm(form);
}
	
function changePassword(form) {
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'password\')">';
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

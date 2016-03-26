
<script type="text/javascript">

var shown = 0;

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeHTMLback(id, form) { 
	if (id === password) document.getElementById(id).innerHTML = '<input type="button" value="Change Password" onclick="changeAttribute(\''+id+'\', \''+form+'\')">';
	document.getElementById(id).innerHTML = '<input type="button" value="Edit" onclick="changeAttribute(\'' + id + '\', \'' + form + '\')">';
	shown--;
	if (shown == 0) hideForm(form);
}

function changeAttribute(id, form) {
	var newHTML;
	if (id === name) newHTML = 'First: <input type="text"><br>Last: <input type="text"><br><input type="button" value="Hide" onclick="changeHTMLback(\''+id+'\', \''+form+'\')">';
	else if (id === password) newHTML = '<input type="text"> <input type="password" value="Hide" onclick="changeHTMLback(\'' + id + '\', \'' + form + '\')">';
	newHTML = '<input type="text"> <input type="button" value="Hide" onclick="changeHTMLback(\'' + id + '\', \'' + form + '\')">';
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

</script>

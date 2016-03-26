
<script type="text/javascript">

function revealForm(divName) { document.getElementById(divName).style.display = "block"; }
function hideForm(divName) { document.getElementById(divName).style.display = "none"; }

function changeHTMLback(id, form) { 
	document.getElementById(id).innerHTML = '<input type="button" value= "Edit" onclick="changeAttribute(\'' + id + '\', \'' + form + '\')">';
}

function changeAttribute(id, form) {
	var newHTML = '<input type="text"> <input type="button" value="Hide" onClick="changeHTMLback(\'' + id + '\', \'' + form + '\')">';
	document.getElementById(id).innerHTML = newHTML;
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

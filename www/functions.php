<?php
function createSubForm() {
	echo '<form method="post" action="">
		  Subject: <input type="text" name="sub_name" /><br>
		  Description: <textarea name="sub_description" /></textarea><br>
		  <input type="submit" value="Add Subject" />
		  </form>';
}
?>
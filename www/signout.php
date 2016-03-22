<?php
session_start();
session_destroy();
session_unset();
echo '<META http-equiv="refresh" content="0;URL=index.php">';
?>
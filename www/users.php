<?php
include 'connect.php';
include 'header.php';
include 'functions.php';

echo '<h2>All Users</h2><hr><br>';
echo '<table>';

$sql = "SELECT * FROM `forumData`.`users`;";
$result = $conn->query($sql);
if (!$result) echo 'No users can be displayed at this time.';
else {
	$num_rows = $result->num_rows;
	for ($i = 0; $i < $num_rows; $i++) {
		$data = $result->fetch_row();
		$date = date_create($data[3]);
		$date = date_format($date, "Y/m/d");
		echo '<tr>';
		echo '<td><a href="profile.php?id='.$data[0].'">'.$date.'</a></td>';
		echo '<td>Joined: '.$data[7].'</td>';
		echo '</tr>';
	}
}

echo '</table>';
include 'footer.php';
?>
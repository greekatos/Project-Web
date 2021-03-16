
<?php
session_start();
include 'debug.php';

$client_id = $_SESSION['client_id'];

$result0 = mysqli_query($db,"SELECT dates_times FROM harfiles WHERE user_id='$client_id' ORDER BY har_id DESC LIMIT 1");

$result1 = mysqli_query($db,"SELECT count(har_id) FROM harfiles WHERE user_id='$client_id' GROUP BY user_id");

while ($row0 = $result0->fetch_assoc()){
	echo json_encode($row0['dates_times']);
}
echo '<br><br>The numbers of uploads are:';
while($row1 = $result1->fetch_assoc()){
	echo json_encode($row1['count(har_id)']);
}



?>


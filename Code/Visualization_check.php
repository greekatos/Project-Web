
<?php
	session_start();
	
	include 'debug.php';
	
	$client_id = $_SESSION['client_id'];
	$result = "SELECT entries_serverIPaddress FROM hardata WHERE user_id = '$client_id' AND (Rs_Content_Type like '%html%' OR Rs_Content_Type like '%javascript%' OR Rs_Content_Type like '%php%' OR Rq_Content_Type like '%html%' OR Rq_Content_Type like '%javascript%' OR Rq_Content_Type like '%php%')";
	$result = mysqli_query($db,$result);
	
	while($row = mysqli_fetch_array($result)){
		$array []=$row['entries_serverIPaddress'];		
	}	
	echo json_encode($array);
?>

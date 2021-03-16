<?php
	session_start();
	
	include 'debug.php';
	
	
	$result = "SELECT entries_serverIPaddress,user_id FROM hardata";
	$result = mysqli_query($db,$result);
	
	while($row = mysqli_fetch_array($result)){
		$array []=$row;

	}	
	
	echo json_encode($array);
?>
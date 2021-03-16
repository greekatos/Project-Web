<?php
	session_start();
	
	include 'debug.php';
	
	
	
	$result = mysqli_query($db,"SELECT user_id,latitude,longitude FROM harfiles GROUP BY latitude,longitude,user_id");
	
	while($row = mysqli_fetch_array($result)){
		$array []=$row;		
	}	
	
	echo json_encode($array);
?>
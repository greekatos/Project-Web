<?php
	session_start();
	include 'debug.php';
	
	$average = mysqli_query($db,"SELECT Rs_Content_Type,Rs_Cache_Control,Rs_Last_Modified,Rs_Expires,Rq_Cache_Control from hardata");	
	
	while($row = mysqli_fetch_array($average)){
		$row_average[] = $row;
	}
	
	echo json_encode($row_average);
	
?>
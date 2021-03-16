<?php
	session_start();
	include 'debug.php';
	
	$average = mysqli_query($db,"SELECT entries_timings, entries_startedDate from hardata");	
	
	while($row = mysqli_fetch_array($average)){
		$row_average[] = $row;
	}
	
	echo json_encode($row_average);
	
?>
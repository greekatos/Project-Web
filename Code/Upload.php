<?php
	session_start();
	
	function alertBox($message) { 
		
		echo "<script>alert('$message');</script>"; 
	} 
	
	include 'debug.php';
	
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		
		$harfile = $_POST["arapis"];
		$array = json_decode($harfile, true);	
		$client_id = $_SESSION['client_id'];
		$IP = $_POST["arap"];
		$array_ip = json_decode($IP,true);
		
		
		
		//IP address analyze	
		$IP_address = $array_ip[0];
		$IP_latitude= $array_ip[1];
		$IP_longitude= $array_ip[2];
		$IP_ISP= $array_ip[3];
		
		//date, time and day
		$my_date = date("Y-m-d H:i:s");
		$day = date('l',strtotime($my_date));
		
		//harfiles insert
		$result = "INSERT INTO harfiles(user_id, IP, ISP, latitude,longitude,dates_times,day) VALUES ('$client_id', '$IP_address','$IP_ISP','$IP_latitude','$IP_longitude','$my_date','$day')";		
		mysqli_query($db,$result);
		
		
		//Get har_id 
		$har_id = mysqli_query($db,"SELECT har_id FROM harfiles ORDER BY har_id DESC LIMIT 1");
		$har_id = mysqli_fetch_assoc($har_id);
		$har_id = $har_id['har_id'];
		
		
		foreach($array['FINAL_entries'] as $key => $data){
			$response_value_content_type = "null";
			$response_value_cache_control = "null";
			$response_value_pragma = "null";
			$response_value_expires = "null";
			$response_value_age = "null";
			$response_value_last_modified = "null";
			$request_value_content_type = "null";
			$request_value_cache_control = "null";
			$request_value_pragma = "null";
			$request_value_host = "null";
			
			foreach($data['response']['header'] as $value){
				
				
				if($value['name'] == "content-type" || $value['name'] == "Content-Type"){
					$response_value_content_type = $value['value'];
					}else if($value['name'] == "cache-control" || $value['name'] == "Cache-Control"){
					$response_value_cache_control = $value['value'];
					}else if($value['name'] == "pragma" || $value['name'] == "Pragma"){
					$response_value_pragma = $value['value'];
					}else if($value['name'] == "expires" || $value['name'] == "Expires"){
					$response_value_expires = $value['value'];
					}else if($value['name'] == "age" || $value['name'] == "Age" ){
					$response_value_age = $value['value'];
					}else if($value['name'] == "last-modified" || $value['name'] == "Last-Modified"){
					$response_value_last_modified = $value['value'];
				}
			}
			foreach($data['request']['header'] as $value){
	
				if($value['name'] == "content-type" || $value['name'] == "Content-Type"){
					$request_value_content_type = $value['value'];
					}else if($value['name'] == "cache-control" || $value['name'] == "Cache-Control"){
					$request_value_cache_control = $value['value'];
					}else if($value['name'] == "pragma" || $value['name'] == "Pragma"){
					$request_value_pragma = $value['value'];
					}else if($value['name'] == "host" || $value['name'] == "Host"){
					$request_value_host = $value['value'];
				}
			}
			mysqli_query($db,"INSERT INTO hardata(har_id, entries_serverIPaddress, entries_startedDate, entries_timings, user_id, request_method, request_urls, Rq_Content_Type, Rq_Cache_Control, 	Rq_Pragma, Rq_Host, response_Status, response_Status_Text, Rs_Content_Type, Rs_Cache_Control, Rs_Pragma, Rs_Expires, Rs_Age, Rs_Last_Modified) VALUES('$har_id', '".$data['serverIPAddresss']."', '".$data['startedDateTimee']."', '".$data['waitTimings']."', '$client_id', '".$data['request']['methods']."', '".$data['request']['url']."', '$request_value_content_type', '$request_value_cache_control', '$request_value_pragma', '$request_value_host', '".$data['response']['StatusResult']."', '".$data['response']['StatusTextResult']."', '$response_value_content_type', '$response_value_cache_control', '$response_value_pragma', '$response_value_expires', '$response_value_age', '$response_value_last_modified')");
			
			
		}
	
			alertBox("Insertion done");
			header("Location:index.php");
	}
	
?>


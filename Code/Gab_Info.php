<?php
	session_start();	
	include 'debug.php';
	
	$result_a = mysqli_query($db,"SELECT count(*) as Total_users FROM users");
	$result_a = mysqli_fetch_array($result_a);
		
	$result_b = mysqli_query($db,"SELECT count(case WHEN request_method = 'CONNECT' then 1 end) as request_CONNECT, count(case WHEN request_method = 'DELETE' then 1 end) as request_DELETE, count(case WHEN request_method = 'GET' then 1 end) as request_GET, count(case WHEN request_method = 'HEAD' then 1 end) as request_HEAD, count(case WHEN request_method = 'OPTIONS' then 1 end) as request_OPTIONS, count(case WHEN request_method = 'PATCH' then 1 end) as request_PATCH, count(case WHEN request_method = 'POST' then 1 end) as request_POST, count(case WHEN request_method = 'PUT' then 1 end) as request_PUT, count(case WHEN request_method = 'TRACE' then 1 end) as request_TRACE FROM hardata");
	$result_b = mysqli_fetch_array($result_b);
		
	$result_c = mysqli_query($db,"SELECT count(case WHEN response_Status = '0' then 1 end) as response_0, 
	count(case WHEN response_Status = '100' then 1 end) as response_100,
	count(case WHEN response_Status = '101' then 1 end) as response_101,
	count(case WHEN response_Status = '103' then 1 end) as response_103,
	count(case WHEN response_Status = '200' then 1 end) as response_200,
	count(case WHEN response_Status = '201' then 1 end) as response_201,
	count(case WHEN response_Status = '202' then 1 end) as response_202,
	count(case WHEN response_Status = '203' then 1 end) as response_203,
	count(case WHEN response_Status = '204' then 1 end) as response_204,
	count(case WHEN response_Status = '205' then 1 end) as response_205,
	count(case WHEN response_Status = '206' then 1 end) as response_206,
	count(case WHEN response_Status = '300' then 1 end) as response_300,
	count(case WHEN response_Status = '301' then 1 end) as response_301,
	count(case WHEN response_Status = '302' then 1 end) as response_302,
	count(case WHEN response_Status = '303' then 1 end) as response_303,
	count(case WHEN response_Status = '304' then 1 end) as response_304,
	count(case WHEN response_Status = '307' then 1 end) as response_307,
	count(case WHEN response_Status = '308' then 1 end) as response_308,
	count(case WHEN response_Status = '400' then 1 end) as response_400,
	count(case WHEN response_Status = '401' then 1 end) as response_401,
	count(case WHEN response_Status = '402' then 1 end) as response_402,
	count(case WHEN response_Status = '403' then 1 end) as response_403,
	count(case WHEN response_Status = '404' then 1 end) as response_404,
	count(case WHEN response_Status = '405' then 1 end) as response_405,
	count(case WHEN response_Status = '406' then 1 end) as response_406,
	count(case WHEN response_Status = '407' then 1 end) as response_407,
	count(case WHEN response_Status = '408' then 1 end) as response_408,
	count(case WHEN response_Status = '409' then 1 end) as response_409,
	count(case WHEN response_Status = '410' then 1 end) as response_410,
	count(case WHEN response_Status = '411' then 1 end) as response_411,
	count(case WHEN response_Status = '412' then 1 end) as response_412,
	count(case WHEN response_Status = '413' then 1 end) as response_413,
	count(case WHEN response_Status = '414' then 1 end) as response_414,
	count(case WHEN response_Status = '415' then 1 end) as response_415,
	count(case WHEN response_Status = '416' then 1 end) as response_416,
	count(case WHEN response_Status = '417' then 1 end) as response_417,
	count(case WHEN response_Status = '418' then 1 end) as response_418,
	count(case WHEN response_Status = '422' then 1 end) as response_422,
	count(case WHEN response_Status = '425' then 1 end) as response_425,
	count(case WHEN response_Status = '426' then 1 end) as response_426,
	count(case WHEN response_Status = '428' then 1 end) as response_428,
	count(case WHEN response_Status = '429' then 1 end) as response_429,
	count(case WHEN response_Status = '431' then 1 end) as response_431,
	count(case WHEN response_Status = '451' then 1 end) as response_451,
	count(case WHEN response_Status = '500' then 1 end) as response_500,
	count(case WHEN response_Status = '501' then 1 end) as response_501,
	count(case WHEN response_Status = '502' then 1 end) as response_502,
	count(case WHEN response_Status = '503' then 1 end) as response_503,
	count(case WHEN response_Status = '504' then 1 end) as response_504,
	count(case WHEN response_Status = '505' then 1 end) as response_505,
	count(case WHEN response_Status = '506' then 1 end) as response_506,
	count(case WHEN response_Status = '507' then 1 end) as response_507,
	count(case WHEN response_Status = '508' then 1 end) as response_508,
	count(case WHEN response_Status = '510' then 1 end) as response_510,
	count(case WHEN response_Status = '511' then 1 end) as response_511
	FROM hardata");
	$result_c = mysqli_fetch_array($result_c);
	
	$result_d = mysqli_query($db,"SELECT count(DISTINCT(request_urls)) as unique_urls from hardata");
	$result_d = mysqli_fetch_array($result_d);
	
	$result_e = mysqli_query($db,"SELECT count(DISTINCT(ISP)) as unique_ISP FROM harfiles");
	$result_e = mysqli_fetch_array($result_e);
	
	//$result_f1 = mysqli_query($db,"SELECT entries_startedDate from hardata");
	//$result_f1 = mysqli_fetch_array($result_f1);
	
	
	$result = array_merge($result_a, $result_b,$result_c,$result_d,$result_e);
	
	
	echo json_encode($result);
?>
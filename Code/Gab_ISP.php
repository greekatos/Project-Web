<?php
session_start();

include 'debug.php' ;

$result_content_type= mysqli_query($db,"SELECT hardata.entries_timings,harfiles.ISP FROM hardata INNER JOIN harfiles ON hardata.har_id = harfiles.har_id");
while ($row=mysqli_fetch_array($result_content_type)){
    $array_cont [] = $row; 
}

echo json_encode($array_cont);
?>
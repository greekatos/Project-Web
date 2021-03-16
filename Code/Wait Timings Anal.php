<!DOCTYPE html>
<script scr="jquery-3.5.1.min (1).js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<html>
	<head>
		<title>User Information</title>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			
			html {
			background-color: #56baed;
			}
			
			body {
			margin:0;
			font-family: Arial, Helvetica, sans-serif;
			}
			
			.topnav {
			overflow:hidden;
			font-size:30px;
			background-color:#f2f2f2;
			-webkit-box-shadow: 0 10px 30px 0 
			rgba(95,186,233,0.4);
			box-shadow: 0 30px 40px 0 rgba(0,0,0,0.3);
			-webkit-border-radius: 5px 5px 5px 5px;
			border-radius: 5px 5px 5px 5px;
			margin: 5px 7px 40px 7px;
			
			}
			
			.topnav a{
			float: rght;
			color:#999999;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 17px;
			}
			
			.topnav a:hover {
			background-color:#b3b3cc;
			color: black;
			}
			
			.topnav a.active {
			background-color: #47476b;
			color: white;
			}
			
			.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 16px;
			font-size: 16px;
			border: none;
			}
			
			.dropdown {
			position: relative;
			display: inline-block;
			}
			
			.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f1f1f1;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
			}
			
			.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			}
			
			.dropdown-content a:hover {background-color: #ddd;}
			
			.dropdown:hover .dropdown-content {display: block;}
			
			.dropdown:hover .dropbtn {background-color: #3e8e41;}
			
		</style>
	</head>
	<body>
		
		
		<div class="topnav">
			<a href="index_admin.php">Home</a>
			<a href="Information.php">Informations</a>
			<a class="active" href="Wait Timings Anal.php">Wait Timings Anal</a>				
			<a href="Headers_Anal.php">Headers Anal</a>
			<a href="Visualization_admin.php">Visualization</a>
			<a href="logout.php">Logout</a>
		</div>
		
		<div class = "container">
			<canvas id = "lineChart" width="400" height="200" aria-label="Hello ARIA World" role="img"></canvas>
		</div>
		
		<div class="dropdown">
			<button class="dropbtn">Dropdown</button>
			<div class="dropdown-content">
				<a href="Wait Timings Anal_Content_type.php">Content-Type</a>
				<a href="Wait Timings Anal_Day.php">Day</a>
				<a href="Wait Timings Anal_Method.php">Method</a>
				<a href="Wait Timings Anal_ISP.php">ISP</a>
			</div>
		</div>
		
		<script>
			
			function Getaverage(){
				return $.ajax({
					url:"Gab_Anal.php",
					dataType:"json",
					success:function(array){
						return array;
					}
				});
			}
			
			var average_array = Getaverage();
			
			average_array.done(average_representation);
			
			
			
			function average_representation(){
				
				var total = 0;
				var time_0 = [];
				var time_1 = [];
				var time_2 = [];
				var time_3 = [];
				var time_4 = [];
				var time_5 = [];
				var time_6 = [];
				var time_7 = [];
				var time_8 = [];
				var time_9 = [];
				var time_10 = [];
				var time_11 = [];
				var time_12 = [];
				var time_13 = [];
				var time_14 = [];
				var time_15 = [];
				var time_16 = [];
				var time_17 = [];
				var time_18 = [];
				var time_19 = [];
				var time_20 = [];
				var time_21 = [];
				var time_22 = [];
				var time_23 = [];
				var time = ['00:00', '01:00','02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'];
				var average = [];
				
				console.log(average_array.responseJSON)
				
				
				
				function find_average(array) {//Average
					var i = 0, sum = 0, len = array.length;
					if(array.length == 0){
						return 0;
						}
					while (i < len) {
						sum = sum + array[i++];
					}
					return sum / len;
				}
				
				for(var i=0; i<average_array.responseJSON.length; i++){
					
					
					if(average_array.responseJSON[i][1].substr(11,2) == 00){
						
						time_0.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if (average_array.responseJSON[i][1].substr(11,2) == 01){
						
						time_1.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 02){
						
						time_2.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 03){
						
						time_3.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 04){
						
						time_4.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 05){
						
						time_5.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 06){
						
						time_6.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 07){
						
						time_7.push(Number(average_array.responseJSON[i][0]));
						
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 08){
						
						time_8.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 09){
						
						time_9.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 10){
						
						time_10.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 11){
						
						time_11.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 12){
						
						time_12.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 13){
						
						time_13.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 14){
						
						time_14.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 15){
						
						time_15.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 16){
						
						time_16.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 17){
						
						time_17.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 18){
						
						time_18.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 19){
						
						time_19.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 20){
						
						time_20.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 21){
						
						time_21.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 22){
						
						time_22.push(Number(average_array.responseJSON[i][0]));
						
						
						}else if(average_array.responseJSON[i][1].substr(11,2) == 23){
						
						time_23.push(Number(average_array.responseJSON[i][0]));
						
						
					}
					
				}

				var average_0 = find_average(time_0);
				var average_1 = find_average(time_1);
				var average_2 = find_average(time_2);
				var average_3 = find_average(time_3);
				var average_4 = find_average(time_4);
				var average_5 = find_average(time_5);
				var average_6 = find_average(time_6);
				var average_7 = find_average(time_7);
				var average_8 = find_average(time_8);
				var average_9 = find_average(time_9);
				var average_10 = find_average(time_10);
				var average_11 = find_average(time_11);
				var average_12 = find_average(time_12);
				var average_13 = find_average(time_13);
				var average_14 = find_average(time_14);
				var average_15 = find_average(time_15);
				var average_16 = find_average(time_16);
				var average_17 = find_average(time_17);
				var average_18 = find_average(time_18);
				var average_19 = find_average(time_19);
				var average_20 = find_average(time_20);
				var average_21 = find_average(time_21);
				var average_22 = find_average(time_22);
				var average_23 = find_average(time_23);

				average.push(average_0);
				average.push(average_1);
				average.push(average_2);
				average.push(average_3);
				average.push(average_4);
				average.push(average_5);
				average.push(average_6);
				average.push(average_7);
				average.push(average_8);
				average.push(average_9);
				average.push(average_10);
				average.push(average_11);
				average.push(average_12);
				average.push(average_13);
				average.push(average_14);
				average.push(average_15);
				average.push(average_16);
				average.push(average_17);
				average.push(average_18);
				average.push(average_19);
				average.push(average_20);
				average.push(average_21);
				average.push(average_22);
				average.push(average_23);
				
				
				for(var i=0;i<average.length;i++){
					if(typeof(average[i]) === 'undefined'){
						console.log("I am in"+i);
						average[i] = 0;
					}
				}
				
				
				
				const CHART = document.getElementById("lineChart").getContext('2d');
				
				
				let lineChart = new Chart(CHART,{
					type:'line',
					data:{
						labels:time,
						datasets:[{
							label:'Timings',
							data:average,
							backgroundColor:'yellow',
							borderWidth:1,
							borderColor:'#777',
							hoverBorderWidth:3,
							hoverBorderColor:'#000'
						}]
						
					}
				})
			}
		</script>
	</body>
</html>
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
				<a href="Wait Timings Anal.php">Timings</a>
				<a href="Wait Timings Anal_Content_type.php">Content Type</a>
				<a href="Wait Timings Anal_Method.php">Method</a>
				<a href="Wait Timings Anal_ISP.php">ISP</a>
			</div>
		</div>
		<script type="text/javascript">
			
			function Getday(){
				return $.ajax({
					url:"Gab_Anal.php",
					dataType:"json",
					success:function(array){
						return array;
					}
				});
			}
			
			var day_array = Getday();
			
			day_array.done(day_representation);
			
			function day_representation(){
				
				console.log(day_array.responseJSON);
				var day_time = [];
				var array = [];
				var day_average = [];
				var DAYS = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
				var Monday_avg = [];
				var Tuesday_avg = [];
				var Wednesday_avg = [];
				var Thursday_avg = [];
				var Friday_avg = [];
				var Saturday_avg = [];
				var Sunday_avg = [];
				
				
				
				
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
				
				function getDay(date) {//Function to get the Day of the Week 
					var days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
					var d = new Date(date);
					return d && days[d.getDay()];
				}
				
				for(var i=0; i<day_array.responseJSON.length;i++){//Pairnoyme tin imera apo oli tin imerominia kai stin isotita kataxoroyme ton arithmo apo entries timings ston kathe pinaka tis imeras
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Monday"){
						Monday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Tuesday"){
						Tuesday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Wednesday"){
						Wednesday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Thursday"){
						Thursday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Friday"){
						Friday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Saturday"){
						Saturday_avg.push(Number(day_array.responseJSON[i][0]));
					}
					if(getDay(day_array.responseJSON[i][1].substr(0,10)) == "Sunday"){
						Sunday_avg.push(Number(day_array.responseJSON[i][0]));
					}
	
				}
				
				//Ipologizoume ton meso oro kathe meras
				var Monday = find_average(Monday_avg);
				var Tuesday = find_average(Tuesday_avg);
				var Wednesday = find_average(Wednesday_avg);
				var Thursday = find_average(Thursday_avg);
				var Friday = find_average(Friday_avg);
				var Saturday = find_average(Saturday_avg);
				var Sunday = find_average(Sunday_avg);
				
				
				//Kataxoroume toys mesous orous imerasw sto day_time
				day_time.push(Monday);
				day_time.push(Tuesday);
				day_time.push(Wednesday);
				day_time.push(Thursday);
				day_time.push(Friday);
				day_time.push(Saturday);
				day_time.push(Sunday);
				
				
				console.log(day_time);
				
				const CHART = document.getElementById("lineChart").getContext('2d');
				
				
				let lineChart = new Chart(CHART,{
					type:'line',
					data:{
						labels:DAYS,
						datasets:[{
							label:'Timings',
							data:day_time,
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
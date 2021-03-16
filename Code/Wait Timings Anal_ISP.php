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
				<a href="Wait Timings Anal_Day.php">Day</a>
			</div>
		</div>
		<script type="text/javascript">
			function GetISP(){
				return $.ajax({
					url:"Gab_ISP.php",
					dataType:"json",
					success:function(array){
						return array;
					}
				});
			}
			
			var ISP_array = GetISP();

			
			ISP_array.done(ISP_representation);
			
			function ISP_representation(){
				console.log(ISP_array.responseJSON);
				
				var ISPs = [];
				var array = [];
				var ISP_average = [];

				
				function find_average(array) {//Average
					var i = 0, sum = 0, len = array.length;
					while (i < len) {
						sum = sum + array[i++];
					}
					return sum / len;
				}
				
				
				
				
				for(var i=0;i<ISP_array.responseJSON.length;i++){//Prosthetei tous paroxous aptin select 
					ISPs.push(ISP_array.responseJSON[i][1]);
					}
				
				
				const unique = [...new Set(ISPs)];//Vriskei tous monadikous paroxous
				
				for(var i=0;i<unique.length;i++){//Dimioiurgei pinakes tosous osous tous monadikous providers
					array[i] =[];
					}
				
				for(var i=0;i<array.length;i++){//Ean einai idies oi isp tou monadikou me tou arxikou tote kataxorei ta timings ston array panta se morfi arithmoy
					for(var j=0;j<ISP_array.responseJSON.length;j++){
						if(ISP_array.responseJSON[j][1] == unique[i]){
							array[i].push(Number(ISP_array.responseJSON[j][0]));
						}
					}
					ISP_average.push(find_average(array[i]));//Ipologizei ton meso oro touarrau kai ton kataxorei ston pinaka ISP_average
				}
				
				console.log(ISP_average);
				
				const CHART = document.getElementById("lineChart").getContext('2d');
				
				
				let lineChart = new Chart(CHART,{
					type:'bar',
					data:{
						labels:unique,
						datasets:[{
							label:'Timings',
							data:ISP_average,
							backgroundColor:'yellow',
							borderWidth:1,
							borderColor:'#777',
							hoverBorderWidth:3,
							hoverBorderColor:'#000'
						}]
						
					}
				});
			}
			
			</script>
		</body>
</html>
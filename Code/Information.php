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
			
			
		</style>
	</head>
	<body>
		
		
		<div class="topnav">
			<a href="index_admin.php">Home</a>
			<a class="active" href="Information.php">Informations</a>
			<a href="Wait Timings Anal.php">Wait Timings Anal</a>				
			<a href="Headers_Anal.php">Headers Anal</a>
			<a href="Visualization_admin.php">Visualization</a>
			<a href="logout.php">Logout</a>
		</div>
		
		<div class = "container">
			<canvas id = "myChart" width="400" height="200" aria-label="Hello ARIA World" role="img"></canvas>
		</div>
		<script>
			
			var number = 0;
			var Labels=[];
			var Data = [];
			
			function Getarray(){
				return $.ajax({
					url:"Gab_info.php",
					dataType:"json",
					success: function(array){
						return array;
					}
				});
			}			
			let array = Getarray();
			array.done(representation);
			
			
			function representation(){				
				const The_result = array.responseJSON;
				The_result_array = Object.entries(The_result);
				
				function isNumeric(number){
					return !isNaN(number)
				}
				
				number = The_result_array.length;
				
				for (var i=0; i<number; i++){
					if(isNumeric(The_result_array[0][0]) == true){
						The_result_array.shift();
					}
				}
				
				number = The_result_array.length;
				
				for(var j=0; j<The_result_array.length; j++){
					if(The_result_array[j][1] === "0"){
						The_result_array.splice(j,1);
						j--;
					}
				}
				
				
				let myChart = document.getElementById('myChart').getContext('2d');
				
				Chart.defaults.global.defaultFontFamily = 'Lato';
				Chart.defaults.global.defaultFontSize = 18;
				Chart.defaults.global.defaultFontColor = '#777';
				
				for(var i=0; i<The_result_array.length; i++){
					Labels.push(The_result_array[i][0]);
					Data.push(The_result_array[i][1]);
				}
				
				console.log(Labels);
				console.log(Data);
				
				
				let massPopChart = new Chart(myChart, {					
					type:'bar',//bar,horizontalBar,pie,line, doughnut,radar, polarArea
					data:{
						
						labels:Labels,
						datasets:[{
							label:'Population',
							data:Data,
							backgroundColor:'yellow',
							borderWidth:1,
							borderColor:'#777',
							hoverBorderWidth:3,
							hoverBorderColor:'#000'
						}]
					},
					options:{
						title:{
							display:true,
							text:'Diagram of the users data',
							fontSize:25
						},
						legend:{
							display:false,
							position:'right',
							labels:{
								fontColor:'#000'
							}
						},
						layout:{
							padding:{
								left:50,
								right:0,
								bottom:0,
								top:0
							}
						},
						tooltips:{
							enabled:true
						}
					}
				});
			}
			
			
		</script>
		
	</body>
</html>	
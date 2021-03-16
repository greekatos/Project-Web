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
			<canvas id = "lineChart" width="500" height="400" aria-label="Hello ARIA World" role="img"></canvas>
		</div>
		
		<div class="dropdown">
			<button class="dropbtn">Dropdown</button>
			<div class="dropdown-content">
				<a href="Wait Timings Anal.php">Timings</a>
				<a href="Wait Timings Anal_Day.php">Day</a>
				<a href="Wait Timings Anal_Method.php">Method</a>
				<a href="Wait Timings Anal_ISP.php">ISP</a>
			</div>
		</div>
		<script type="text/javascript">
			
			function Getcontent(){
				return $.ajax({
					url:"Gab_Content_type.php",
					dataType:"json",
					success:function(array){
						return array;
					}
				});
			}
			
			var cont_array = Getcontent();
			
			cont_array.done(cont_representation);
			
			
			
			
			function cont_representation(){
				var cont_average = [];
				var types = [];
				var array = [];
				var matched = [];
				var matched_1 = [];
				var a =[];
				
				function find_average(array) {//Average
					var i = 0, sum = 0, len = array.length;
					while (i < len) {
						sum = sum + array[i++];
					}
					return sum / len;
				}
				
				
				
				for(var i=0; i<cont_array.responseJSON.length;i++){
					types.push(cont_array.responseJSON[i][1]);
				}			
				
				const unique = [... new Set(types)];

				console.log(unique);	
				const regex = /\/(\w+)((-|\.)*(\w+))*/;// Pairnei to meta apo to /(backslash) kai pernei kai tin peripotsi na exei pavla
				
				
				
				for(var i=0;i<unique.length;i++){	
					if(unique[i] !== "null"){
						a = unique[i].match(regex);
						matched[i] = a[0];	//Kataxorei ston pinaka matched to stoixeio path poy theloyme (px /png)			
					}
				}
				
				console.log(matched);

				for(var j=0;j<types.length;j++){
					if(types[j] !== "null"){
						matched_1[j] = types[j].match(regex);//Pairnei ta stoixeia toy pinaka types aptin select kai pairnei to path poy theloume (px. /html)
					}
				}
				

				matched = matched.filter(Boolean);//I filter kovei ta kena stoixeia ta undefined toy pinaka logo tou null apo ti Database
				matched_1 = matched_1.filter(Boolean);
				

				for(var i=0;i<matched.length;i++){//Ftiaxnoume antistoixoys pinakes me ta monadika paths
					array[i] = [];
				}
				
				for(var i=0;i<matched.length;i++){
					for(var j=0;j<matched_1.length;j++){
						if((matched_1[j][0] == matched[i]) == true){
							array[i].push(Number(cont_array.responseJSON[j][0]));//Sigrinoume toys 2 pinakes kai vriskoyme to plithos toy kathe path
						}
					}
					cont_average.push(find_average(array[i]));
				}

				
				
				const CHART = document.getElementById("lineChart").getContext('2d');
				
				
				let lineChart = new Chart(CHART,{
					type:'line',
					data:{
						labels:matched,
						datasets:[{
							label:'Timings',
							data:cont_average,
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
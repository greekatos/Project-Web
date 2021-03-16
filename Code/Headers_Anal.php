<!DOCTYPE html>
<script scr="jquery-3.5.1.min (1).js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>HOME PAGE </title>
		
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
			<a href="Information.php">Informations</a>
			<a href="Wait Timings Anal.php">Wait Timings Anal</a>				
			<a class="active" href="Headers_Anal.php">Headers Anal</a>
			<a href="Visualization_admin.php">Visualization</a>
			<a href="logout.php">Logout</a>
		</div>
		<div>
			<canvas id="chart" width="400" height="100"></canvas>			
		</div>
		
		<div id="container"></div>
		<p>
			<input id="clickMe" type="button" value="clickme" onclick="doFunction();" />
		</p>
	</body>
	
	<script type="text/javascript">
		
		
		function Getcache(){
			return $.ajax({
				url:"Gab_Cache_control.php",
				dataType:"json",
				success: function(array){
					return array;
				}
			});		
		}
		
		let array_cache = Getcache();
		
		array_cache.done(cache_representation);
		
		function cache_representation(){
			
			console.log(array_cache.responseJSON);
			var TTL = [];
			var times = [];
			var Data_array = [];
			const regex = /(\/)(\w+)((-|\.)*(\w+))*/;
			var match = [];
			var value = [];
			var values = [];
			var min_max = [];
			var data_value = [];			
			var count_value = [];
			var Count = 0;
			var count_public = 0;
			var count_private = 0;
			var count_no_cache = 0;
			var count_no_store = 0;
			var cacheability_directive = [];
			
			
			
			
			for(var i=0;i<array_cache.responseJSON.length;i++){
				if(array_cache.responseJSON[i][1].includes("max-age")){
					var matches = array_cache.responseJSON[i][1].match(/max-age=(\d+\.*\d+)/);//Pairnoyme tin timi tou max age gia kathe entry\
					console.log(matches);
					if(matches !== null){
						var replaced = matches[1].replace(".", "");
						console.log(replaced);
						TTL.push([parseInt(replaced), array_cache.responseJSON[i][0]]);
						console.log(TTL);
					}
					}else if(array_cache.responseJSON[i][2] !== "null" && array_cache.responseJSON[i][3] !== "null"){
					var a = new Date(array_cache.responseJSON[i][2]);
					var b = new Date(array_cache.responseJSON[i][3]);
					var diff = Math.abs(a.getTime() - b.getTime())/1000;
					TTL.push([diff, array_cache.responseJSON[i][0]]);
					}else if(array_cache.responseJSON[i][4].includes("max-age")){
					var matches_rq = array_cache.responseJSON[i][4].match(/max-age=(\d+\.*\d+)/);
					if(matches !== null){
						var replaced_rq = matches_rq[1].replace(".", "");
						TTL.push([parseInt(replaced), array_cache.responseJSON[i][0]]);
					}
				}
				
				
				if(array_cache.responseJSON[i][1].includes("public")  ||array_cache.responseJSON[i][4].includes("public")){
					count_public++;
					
					if(array_cache.responseJSON[i][0] !== "null"){
						cacheability_directive.push([array_cache.responseJSON[i][1],array_cache.responseJSON[i][0]]);
					}
				} 
				
				if(array_cache.responseJSON[i][1].includes("private")  ||array_cache.responseJSON[i][4].includes("private")){
					count_private++;
					
					if(array_cache.responseJSON[i][0] !== "null"){
						cacheability_directive.push([array_cache.responseJSON[i][1],array_cache.responseJSON[i][0]]);
					}
				} 
				
				if(array_cache.responseJSON[i][1].includes("no-cache")  ||array_cache.responseJSON[i][4].includes("no-cache")){
					count_no_cache++;
					
					if(array_cache.responseJSON[i][0] !== "null"){
						cacheability_directive.push([array_cache.responseJSON[i][1],array_cache.responseJSON[i][0]]);
					}
				} 
				
				if(array_cache.responseJSON[i][1].includes("no-store")  ||array_cache.responseJSON[i][4].includes("no-store")){
					count_no_store++;
					
					if(array_cache.responseJSON[i][0] !== "null"){
						cacheability_directive.push([array_cache.responseJSON[i][1],array_cache.responseJSON[i][0]]);
					}
				}
				
				if(array_cache.responseJSON[i][0] !== "null"){
					Count++;
					}
			}
			
			console.log(cacheability_directive);
			console.log(Count);
			console.log(count_no_cache);
			console.log(count_no_store);
			console.log(count_private);
			console.log(count_public);
			
			for(var i=0;i<cacheability_directive.length;i++){
				//cacheability_directive[i] = cacheability_directive[i].match(regex)[0];
				}
				
			var unique_cachable = [...new Set(cacheability_directive)];
			
			console.log(unique_cachable);

				
			for(var i=0;i<TTL.length;i++){
				match[i] = TTL[i][1].match(regex)[0];
				match[i] = match[i].substring(1);
			}
			const unique = [...new Set(match)];
			
			console.log(unique);
			
			
			for(var i=0;i<unique.length;i++){
				value[i]=[];
			}
			
			
			for(var i=0;i<TTL.length;i++){
				for(var j=0;j<unique.length;j++){
					if((match[i] == unique[j]) == true){
						value[j].push(TTL[i][0]);
					}
				}
			}
			
			
			
			for(var i=0;i<value.length;i++){
				min_max[i] = find_min_max(value[i]);
				data_value[i] = presentation_bar(min_max[i][0],min_max[i][1]);
			}
			
			
			
			
			
			function find_min_max(array){
				for(var i=0;i<array.length;i++){
					var min = Math.min.apply(Math,array);
					var max = Math.max.apply(Math,array);
				}
				return [min,max+1];
			}
			
			function presentation_bar(Min,Max){
				let a = (Max-Min)/10;
				let data_array = [[Min,Min+a],[Min+a,Min+2*a],[Min+2*a,Min+3*a],[Min+3*a,Min+4*a],[Min+4*a,Min+5*a],[Min+5*a,Min+6*a],[Min+6*a,Min+7*a],[Min+7*a,Min+8*a],[Min+8*a,Min+9*a],[Min+9*a,Min+10*a]];						
				return data_array;
			}
			
			
			
			
			function present(array,Big_array){
				var count = [];	
				for(var j=0;j<array.length;j++){
					count[j]=0;
					for(var i=0;i<Big_array.length;i++){							
						if(Big_array[i][0]>=array[j][0] && Big_array[i][0] <= array[j][1]){
							count[j]+= 1;
						}
					}
				}
				return count;
			}
			
			function present_1(array_1,Big_array_1){
				var count_1 = [];
				for(var j=0;j<Big_array_1.length;j++){
					count_1[j]=0;
					for(var i=0;i<array_1.length;i++){
						if(array_1[i]>=Big_array_1[j][0] && array_1[i]<=Big_array_1[j][1]){
							count_1[j]+=1;
						}
					}
				}
				return count_1;
			}
			
			for(var i=0;i<TTL.length;i++){
				times.push(TTL[i][0]);
				var min = Math.min.apply(Math,times);
				var max = Math.max.apply(Math,times);
			}
			
			
			
			Data_array = presentation_bar(min,max);
			for(var i=0;i<data_value.length;i++){
				count_value[i] = present_1(value[i],Data_array);
			}
			count_array = present(Data_array,TTL);
			console.log(count_array);
			console.log(count_value);
			console.log(Data_array);
			
			const CHART = document.getElementById("chart").getContext('2d');
			
			
			let chart = new Chart(CHART,{
				type:'bar',
				data:{
					labels:Data_array,
					datasets:[{
						label:[],
						data: count_array,
						backgroundColor:'yellow',
						borderWidth:1,
						borderColor:'#777',
						hoverBorderWidth:3,
						hoverBorderColor:'#000'
					}]
					
				}
			})
			
			
			
			function trannos() {//functions gia checkboxes
				for(var i=0;i<unique.length;i++){
					var checkbox = document.createElement('input');
					checkbox.type = 'checkbox';
					checkbox.id =  i;
					checkbox.name = unique[i];
					checkbox.value = 'car';
					
					var label = document.createElement('label');
					label.htmlFor = 'car';
					label.appendChild(document.createTextNode(unique[i]));
					
					var br = document.createElement('br');
					
					var container = document.getElementById('container');
					container.appendChild(checkbox);
					container.appendChild(label);
					container.appendChild(br);
					
				}
			}
			trannos();
			
			document.getElementById("clickMe").onclick = function () {
				var Final =[0,0,0,0,0,0,0,0,0,0];
				var cb = [];
				for(var i=0;i<unique.length;i++){
					cb[i] = document.getElementById(i);
					//console.log(cb[i].checked);
					if(cb[i].checked == true){
						for(var j=0;j<Final.length;j++){
							//console.log(count_array);
							Final[j] += count_value[i][j];
						}
						
					}
				}
				//console.log(Final);
				chart.data.datasets[0].data = Final;
				chart.update();
			};
			
			
		}
		
	</script>
	
</body>
</html>																									
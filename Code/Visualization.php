<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"><!--eisagwgi leaflet css -->
<script type="text/javascript" src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script><!-- eisagwgi js bibliothikis -->
<script scr="jquery-3.5.1.min (1).js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>
<html>
	<head>
		<title>User Visualization</title>
		
	</head>
	<body>
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
            <a href="index.php">Home</a>
            <a href="arapis.html">Download-Upload .har File</a>
            <a href="Profile Management.php">Profile Management</a>
            <a class="active"  href="Visualization.php">Visualization</a>
            <a href="logout.php">Logout</a>
			
		</div>
		
		
		<div class="Bro">
			<style>
				.Bro{
				overflow:hidden;
				font-size:100%;
				height:100%;
				background-color:#f2f2f2;
				-webkit-box-shadow: 0 10px 30px 0 
				rgba(95,186,233,0.4);
				box-shadow: 0 30px 40px 0 rgba(0,0,0,0.3);
				-webkit-border-radius: 5px 5px 5px 5px;
				border-radius: 5px 5px 5px 5px;
				margin: 5px 7px 40px 7px;
				}
			</style>
			<div id= "mapid"></div>
			
			
		</body>
	</html>
	
	<style type="text/css">
		#mapid { height: 880px; width: 88%; align: "center"; };
	</style>
	
	<script type="text/javascript">
		
		let mymap = L.map(mapid).setView([0,0], 1);//edw einai o xartis  
		
		let mapurl ='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
		
		let mapatr = 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
		
		let map= new L.TileLayer(mapurl, {attribution: mapatr});//TileLayer tou xarti 
		
		mymap.addLayer(map);//prosthetw to tilelayer sto xarti 
		
		function Getarray(){
			return $.ajax({
				url:"Visualization_check.php",
				dataType:"json",
				success: function(array){
					return array;
				}
			});		
		}
		
		
		let array = Getarray();//this is the returned array from select 
		console.log(array);
		
		array.done(filter);
		
		
		function filter(){
			var location =[];
			var lat_array=[];
			var long_array=[];
			var count_array=[];  
			var result=[];
			const unique =[... new Set(array.responseJSON)];
			
			for(var i=0 in array.responseJSON){
				result.push([array.responseJSON[i]]);		
			}
			
			console.log(result);
			
			const index = unique.indexOf("");
			if (index > -1){//Na mathw giati douleuei auto apaloifi kenwn
				unique.splice(index,1);
			}
			
			for(var i=0;i<unique.length;i++){//Bgazw ta [] apo tis ipv6
				if(unique[i].charAt(0) == "["){
					unique[i] = unique[i].substring(1,unique[i].length-1);
				}
			}
			
			//get longitude,latitude
			function longlat(address){
				$.ajaxSetup({async:false});
				$.get('https://ipapi.co/'+address+'/json' ,function(data){
					ret_lat = data.latitude;
					ret_long = data.longitude;
				});
				return [ret_lat,ret_long];
			}
			
			console.log(unique);
			for(var i=0;i<unique.length;i++){
				let LL = longlat(unique[i]);
				location.push(LL);
			}
			
			function isNumeric(number){
				return !isNaN(number)
			}
			
			
			for(var i=0; i<location.length;i++){//Apaloifi twn sign up
				if(isNumeric(location[i][0]) == false){
					location.splice(i,1);
					unique.splice(i,1);
					console.log("I am in:"+(i+1));
				}
			}
			
			for(var i=0; i<location.length;i++){//Apaloifi twn null 
				if(location[i][0] == null){
					location.splice(i,1);
					unique.splice(i,1);
					console.log("I am in null:"+(i+1));
				}
			}
			console.log(location);
			
			for(var i=0;i<location.length;i++){//Dimiourgoume monodiastata arrays apo to location gia tis sintetagmenes
				lat_array.push(location[i][0]);
				long_array.push(location[i][1]);
				
			};
			function getOccurrence(array, value) {//Count the different IP's 
				var counter = 0;
				array.forEach((v) => (v == value && counter++));
				if(counter == 0){
					return counter = 1;
					}else{
					return counter;
				}
			}
			
			for(var i=0; i<unique.length;i++){
				var count= getOccurrence(result,unique[i]);
				count_array.push(count);
				
			}
			
			let testData = {//Creates the JSON Objects data for the heatmap
				max: Math.max(... count_array),
				data: []	
			};
			console.log(count_array);
			
			for(var i=0;i<location.length;i++){
				
				let data ={
					lat:lat_array[i],
					lng:long_array[i],
					count:count_array[i]
				}
				testData.data.push(data);
				
			};
			console.log(testData);
			let cfg={ //Configures the heatmap 
				
				"radius": 40,
				"maxOpacity": 0.8,
				"scaleRadius": false,
				"useLocalExtrema": false,
				latField: 'lat',
				lngField:'lng',
				valueField:'count'
			};
			
			
			let heatmapLayer =  new HeatmapOverlay(cfg);
			
			mymap.addLayer(heatmapLayer);
			heatmapLayer.setData(testData);//Adds the data to the heatmap
			
		} 
		/*for(var i=0;i<location.length;i++){//Dimiourgoume monodiastata arrays apo to location gia tis sintetagmenes
		lat_array.push(location[i][0]);
		long_array.push(location[i][1]);
		};
		
		
		
		for(var i=0;i<location.length;i++){
		marker(location[i][0],location[i][1]);
		}
		}*/
		
	</script>
	

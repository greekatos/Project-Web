<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"><!--eisagwgi leaflet css -->
<script type="text/javascript" src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script><!-- eisagwgi js bibliothikis -->
<script scr="jquery-3.5.1.min (1).js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>

<html>
	<head>
		<title>Admin Visualization</title>
		
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
			<a href="index_admin.php">Home</a>
			<a href="Information.php">Informations</a>
			<a href="Wait Timings Anal.php">Wait Timings Anal</a>				
			<a href="Headers_Anal.php">Headers Anal</a>
			<a class="active" href="Visualization_admin.php">Visualization</a>
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
		
		let mymap = L.map(mapid).setView([38.2462420, 21.7350847], 16);//edw einai o xartis  
		
		let mapurl ='https://tile.openstreetmap.org/{z}/{x}/{y}.png';
		
		let mapatr = 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
		
		let map= new L.TileLayer(mapurl, {attribution: mapatr});//TileLayer tou xarti 
		
		mymap.addLayer(map);//prosthetw to tilelayer sto xarti 
		
		function Getnewarray(){
			return $.ajax({
				url:"Visualization_admin_check.php",
				dataType:"json",
				success: function(array){
					return array;
				}
			});		
		}
		
		
		let array = Getnewarray();//this is the returned array from select 
		
		
		array.done(filter);
		
		
		function filter(){
			console.log(array.responseJSON);
			var location = [];
			var latlngs = [];
			var polyline;
			var count = [];
			var IP = [];
			var counter = 0;
			
			
			function multiDimensionalUnique(arr) {
				var uniques = [];
				var itemsFound = {};
				for(var i = 0, l = arr.length; i < l; i++) {
					var stringified = JSON.stringify(arr[i]);
					if(itemsFound[stringified]) { continue; }
					uniques.push(arr[i]);
					itemsFound[stringified] = true;
				}
				return uniques;
			}
			
			
			var dimos = multiDimensionalUnique(array.responseJSON);
			
			
			
			
			for(var i=0;i<dimos.length;i++){
				if(dimos[i][0] == ""){
					dimos.splice(i,1);
				}
				if(dimos[i][0].charAt(0) == "["){
					dimos[i][0] = dimos[i][0].substring(1,dimos[i][0].length-1);
				}
			}
			
			
			console.log(dimos);
			
			function longlat(address){
				$.ajaxSetup({async:false});
				$.get('https://ipapi.co/'+address+'/json' ,function(data){
					ret_lat = data.latitude;
					ret_long = data.longitude;
				});
				return [ret_lat,ret_long];
			}
			
			
			for(var i=0;i<dimos.length;i++){
				let LL = longlat(dimos[i][0]);
				LL.push(dimos[i][1]);
				location.push(LL);
			}
			
			function isNumeric(number){
				return !isNaN(number)
			}
			
			
			for(var i=0; i<location.length;i++){//Apaloifi twn sign up
				if(isNumeric(location[i][0]) == false){
					location.splice(i,1);
					dimos.splice(i,1);
					console.log("I am in:"+(i+1));
				}
			}
			
			for(var i=0; i<location.length;i++){//Apaloifi twn null 
				if(location[i][0] == null){
					location.splice(i,1);
					dimos.splice(i,1);
					console.log("I am in null:"+(i+1));
				}
			}
			
			
			
			console.log(dimos);
			console.log(location);
			
			function getOccurrence(array, value) {//Poses fores iparxei kati se ena array
				var count = 0;
				array.forEach((v) => (v === value && count++));
				return count;
			}
			
			
			for(var i=0;i<array.responseJSON.length;i++){
				IP.push(array.responseJSON[i][0]);
			}
			
			for(var i=0;i<dimos.length;i++){
				count[i] = getOccurrence(IP,dimos[i][0]);
			}	
			
			console.log(count);
			
			function marker(lat,longi,Id){//eisagwgi markers	
				var marker1 = L.marker([lat,longi], {userId:Id});
				marker1.addTo(mymap);
				marker1.bindPopup("User:" +Id);
				return marker1
			}		
			
			
			
			function Getusers(){
				return $.ajax({
					url:"Gab_User_Coordinates.php",
					dataType:"json",
					success: function(array){
						return array;
					}
				});		
			}
			
			var users_array = Getusers();
			
			users_array.done(user_representation);
			
			function user_representation(){
				console.log(users_array.responseJSON);
				
				function markeruser(lat,longi,Id){	//marker user's
					var marker2 = L.marker([lat,longi], {userId:Id});
					marker2.addTo(mymap);
					marker2.bindPopup("User location:" +Id);
					return marker2;
				}	
				
				
				function getRandomColor() {
					var letters = '0123456789ABCDEF';
					var color = '#';
					for (var i = 0; i < 6; i++) {
						color += letters[Math.floor(Math.random() * 16)];
					}
					return color;
				}
				
				for(var i=0;i<users_array.responseJSON.length;i++){//paxos grammwn kai sximatismos grammwn
					markeruser(users_array.responseJSON[i][1],users_array.responseJSON[i][2],users_array.responseJSON[i][0]);
					console.log(markeruser(users_array.responseJSON[i][1],users_array.responseJSON[i][2],users_array.responseJSON[i][0]));
					for(var j=0;j<location.length;j++){
						if(markeruser(users_array.responseJSON[i][1],users_array.responseJSON[i][2],users_array.responseJSON[i][0]).options.userId == marker(location[j][0],location[j][1],location[j][2]).options.userId){
							latlngs.push(markeruser(users_array.responseJSON[i][1],users_array.responseJSON[i][2],users_array.responseJSON[i][0]).getLatLng());
							latlngs.push(marker(location[j][0],location[j][1],location[j][2]).getLatLng());
							var polyline = L.polyline(latlngs);
							var Style = {
								fillColor: getRandomColor(),
								color: getRandomColor(),
								weight:count[j]/5 
							};
							polyline.setStyle(Style).addTo(mymap);
							latlngs = [];
						}
					}
				}	
			}
		} 
		
		
	</script>
	
	
	

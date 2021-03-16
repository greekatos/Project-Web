<DOCTYPE html>
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
				<a class="active" href="index_admin.php">Home</a>
				<a href="Information.php">Informations</a>
				<a href="Wait Timings Anal.php">Wait Timings Anal</a>				
				<a href ="Headers_Anal.php">Headers Anal</a>
				<a href="Visualization_admin.php">Visualization</a>
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
				<h1>Admin Only</h1>
				<h3>What is a HAR File?</h3>
				<p>HAR, short for HTTP Archive, is a format used for tracking information between a web browser and a website. A HAR file is primarily used for identifying performance issues, such as bottlenecks and slow load times, and page rendering problems. The HAR file keeps track of each resource loaded by the browser along with timing information for each resource.</p>
				<img src="har.jpg">
			</div>
			
			
		</body>
	</html>	
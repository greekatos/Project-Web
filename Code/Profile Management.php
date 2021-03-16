<DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>PROFILE MANAGEMENT</title>
	<script src="jquery-3.5.1.min (1).js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>            
	<script type="text/javascript" src="Profile_Management_check.js"></script>

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
			<a href="arapis.html?newversion">Download-Upload .har File</a>
			<a class="active" href="Profile Management.php">Profile Management</a>
			<a href="Visualization.php">Visualization</a>
			<a href="logout.php">Logout</a>
		  </div>


       <div class="Bro">
	   <link rel="stylesheet" href="log.css">
	   <div class="wrapper fadeInDown">
		<div id="formContent">
		<div class="container">
	
	   <h1>Profile Management</h1>
		
		
		  <form action="" method="" accept-charset="utf-8">
                
                
                
                
                <div>
                    
                    <label for="username"> </label>
                    <input type="text" class="form-control" name="username_PM" placeholder="Username..." required>
                    
                </div>
                
                <div>
                    
                    <label for="password"></label>
                    <input type="password" class="form-control" name="password_old" placeholder="Old password..." required>                
                    
                </div>
                
                <div>
                    
                    <label for="password"></label>
                    <input type="password" class="form-control" name="password_1_PM" placeholder="Password..." required>                
                    
                </div>
                
                <div>
                    
                    <label for="password"></label>
                    <input type="password" class="form-control" name="password_2_PM" placeholder="ConfirmPassword..." required>                                
                    
                </div>
                
               <button type="submit"  name="reg_user_PM" onclick = "profile_manage()">Submit</button>
                
               
                
                
            </form>    
            
   
        
        <p>The last update was in:<?php include 'Profile Management values.php' ?></p>
    </body>
	
       
</body>
</html>
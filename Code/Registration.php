<!DOCTYPE html>
	<html>
		<head>
			<title>LOOK I AM AJAX</title>
			<link rel="stylesheet" href="log.css">
			<script scr="jquery-3.5.1.min (1).js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
			
			
			<script type="text/javascript" src="Registration_check.js?newversion"></script>
		</head>
		<body>
			<div class="wrapper fadeInDown">     <div id="formContent">     <div class="container">
				<div class="container">
					
					<div class="header">
						
						<h2>Register</h2>
						
					</div>
					
					<form action="" method="" accept-charset="utf-8">
						
						
						
						
						<div>
							
							<label for="username"> </label>
							<input type="text" class="form-control" name="username" placeholder="Username..." required>
							
						</div>
						
						<div>
						
							<label for="email"></label>
							<input type="email" class="form-control" name="email" placeholder="Email..." required>
							
						</div>
						
						<div>
							
							<label for="password"></label>
							<input type="password" class="form-control" name="password_1" placeholder="Password..." required>				
							
						</div>
						<div>
							
							<label for="password"></label>
							<input type="password" class="form-control" name="password_2" placeholder="ConfirmPassword..." required>								
							
						</div>
						
						<button type="submit" name="reg_user" onclick = "register_user()" >Submit</button>
						<div id="formFooter">
							<p>Already a user?<a href="login.php"><b><br>Log in</b></a></p>
						</div>
						
						
						
					</form>
					
					
					
				</div>
			</div>
			</div>
			</div>
		</body>
	</html>											
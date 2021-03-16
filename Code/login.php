<?php include('LoginBackend.php') ?>

<DOCTYPE html>
	<html>
		<head>
			<title>Log In</title>
			<link rel="stylesheet" href="log.css">
		</head>
		<body>
			<div class="wrapper fadeInDown">     <div id="formContent">     <div class="container">
				<div class="container">
					
					<div class="header">
						
						<h2>Login In</h2>
						
					</div>
					
					<form action="login.php" method="post" accept-charset="utf-8">
						
						
						<div>
							
							<label for="username"> </label>
							<input type="text" name="username" class="form-control" placeholder="Username..."required>
							
						</div>
						
						
						
						<div>
							
							<label for="password"></label>
							<input type="password" name="password" class="form-control" placeholder="Password..." required>				
							
						</div>
						
						
						<button type="submit" name="login_user"> Log In </button>
						<div id="formFooter">
							<p>Not a user?<a href="Registration.php"><b><br>Register Here</b></a></p>
						</div>
						
					</form>
					
				</div>
			</div>
			</div>
			</div>
		</body>
	</html>		
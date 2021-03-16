<?php
	session_start();
	
	function alertBox($message) { 
		
		echo "<script>alert('$message');</script>"; 
	} 
	
	
	
	//connect to db	
	include 'debug.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$Lusername=$_POST["username"];	
		$Lpassword1=$_POST["password"];	   
		$username= mysqli_real_escape_string($db,$Lusername);
		$password= mysqli_real_escape_string($db,$Lpassword1);
		
		
		//Get User's id 
		$login = "SELECT UsersId FROM users WHERE Usersusername = '$username' ";
		$login_result = mysqli_query($db,$login);
		$lr = mysqli_fetch_array($login_result);
		$client_id = $lr['UsersId'];
		$_SESSION['client_id'] = $client_id;
		
		
		//check pass and do the login 
		$query = "SELECT * FROM users WHERE Usersusername ='$username' ";// AND Userspwd='$passwordHash'	
		$result = mysqli_query($db, $query);
		$numRows=mysqli_num_rows($result);//number of rows returned
		
		
		if ($numRows === 1){
			$row = mysqli_fetch_assoc($result);//fetch a result row as an associative array
			if(password_verify($password,$row['Userspwd'])){
				$_SESSION['loggedin'] = true;
				$_SESSION['Id'] = $login;			
				$role_result = mysqli_query($db,"SELECT role_id FROM user_roles WHERE user_id = '$client_id'");
				$role = mysqli_fetch_array($role_result);
				if($role['role_id'] == 0){					
					header('location:index.php');
				}
				else{
					header('location:index_admin.php');
				}
			}
			else{
				alertBox("Wrong password. Type the right one");
				echo "Wrong password. Type the right one";
			}
			
			
		}else
		{
			alertBox("No User found. You must Register first dude!!!");
			echo "No User found. You must Register first dude!!!";
		}
	}
?>
<?php
	
	
	session_start();	
	
	function alertBox($message) { 
		
		echo "<script>alert('$message');</script>"; 
	} 
	
	include 'debug.php';
	
	$Uusername=$_POST["username"];
	$Upassword1=$_POST["password"];
	$Upassword_old =$_POST["old_password"]; 
	$Users_Id = $_SESSION['client_id'];
	
	$return = mysqli_query($db,"SELECT Userspwd from users WHERE UsersId ='$Users_Id'");
	
	//Edw pairnw to palio password
	if(mysqli_num_rows($return)>0){
		while($row = mysqli_fetch_assoc($return)){//fetch a result row as an associative array 
			$pass = $row['Userspwd'];
		}
	}
	
	
	//cleanup for db:
    $username = mysqli_real_escape_string($db, $Uusername);
    $password_1 = mysqli_real_escape_string($db, $Upassword1);
	$password_old = mysqli_real_escape_string($db,$Upassword_old);
	
	
	
	
	$user_check="SELECT Usersusername FROM users WHERE Usersusername = '$username'";
	$rslt = mysqli_query($db,$user_check);
	
	
	
	
	if(mysqli_num_rows($rslt) === 0){
		if(password_verify($password_old,$pass)){
			alertBox("The old password is correct");
			$pwd= password_hash($password_1,PASSWORD_DEFAULT);
			$result = "UPDATE users SET Usersusername = '$username', Userspwd='$pwd' WHERE UsersId ='$Users_Id'"; 
			mysqli_query($db,$result);//performs a query on the database
			echo 1;
		}
		else{
			echo 2;
		}
	}
	else{
		echo 3;
	}
	
	//An iparxei mysqli_num_rows kai einai to idio username pali tha mporei na kanei update 
?>
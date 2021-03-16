<?php
	
	
	session_start();
	
	/*class Checker {
		private static $instance = null;
		
		private function __construct(){}
		
		public static function getInstance()
		{
		if (self::$instance == null) 
		{
		self::$instance = new Checker();
		}
		
		return self::$instance;
		}
		
		public function checkPass($password){
		
		if(strLen($password) < 8){
		return False;
		}
		
		$stringArray = str_split($password);
		
		$digitFlag = False;
		$symbolFlag = False;
		$upperFlag = False;
		
		foreach($stringArray as $letter){
		
		if(is_numeric($letter)){
		$digitFlag = True;			
		}
		
		//Preg perform a regular expression match
		if(preg_match('/[A-Z]/',$letter)){
		
		$upperFlag = True;			
		}
		$letterOrd = ord($letter);
		
		if(($letterOrd >= 33 && $letterOrd <= 47) ||
		($letterOrd >= 58 && $letterOrd <= 64) || 
		($letterOrd >= 91 && $letterOrd <= 96) ||
		($letterOrd >= 123 && $letterOrd <= 126)){
		
		$symbolFlag = True;			
		}
		
		if ($digitFlag == True && $symbolFlag == True && $upperFlag == True){
		return True;
		}
		
		}
		
		
		return False;
		
		}
		
		
	}*/
	
	function alertBox($message) { 
		
		echo "<script>alert('$message');</script>"; 
	} 
	
	
	/*session_start();
		
		$count = '1';
		echo $count;
		
		$data = array();
		
		$checker= Checker::getInstance();
		
		
		
		
	if ($_SERVER["REQUEST_METHOD"]==="POST"){*/
	
	
	
	
	
	
	//connect to db	
	include 'debug.php';
	
	$Uusername=$_POST["username"];
	$Uemail=$_POST["email"];
	$Upassword1=$_POST["password"];
	
	
	//cleanup for db:
    $username = mysqli_real_escape_string($db, $Uusername);// escape string before passing it to query.
    $email = mysqli_real_escape_string($db, $Uemail);//strip in characters that can be read by sqli
    $password_1 = mysqli_real_escape_string($db, $Upassword1);
    
	
	//check db for existing user or email
	$user_check="SELECT Usersusername,Usersemail FROM users WHERE Usersusername = '$username' or Usersemail = '$email'" ;
	$rslt = mysqli_query($db,$user_check);
	$exist = mysqli_num_rows($rslt);
	
	
	if(mysqli_num_rows($rslt) != 0){
		echo 1;
		}else{
		$pwd= password_hash($password_1,PASSWORD_DEFAULT);
		$result = "INSERT into users(Usersusername,Usersemail,Userspwd) VALUES ('$username','$email','$pwd')";
		mysqli_query($db,$result);//gia na ginei to insert stin db
		mysqli_query($db,"INSERT INTO roles VALUES('0','client')");
		$result_1 = mysqli_query($db,"SELECT UsersId from users WHERE Usersusername = '$username'");
		while($row = mysqli_fetch_array($result_1)){//Mporei na ginei kai kalitera
			$array [] = $row['UsersId'];
		}
	    mysqli_query($db,"INSERT INTO user_roles VALUES('$array[0]','0')");	
		echo 0;	
	}	
	/*alertBox("There is a username or email already registered. Change that USERNAME OR EMAIL!!!");
		
		}elseif($password_1 != $password_2){
		alertBox("Passwords must match brooo!!!");
		
		}elseif(checker::checkPass($password_1) != 1){
	alertBox("Passwords must contain at least one number, one symbol, one capital letter and be more than 8 characters");*/
	
	
	
	//check for spaces
?>


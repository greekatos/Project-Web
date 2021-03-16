
function register_user(){
	
	function checker(pass){
		
		if(pass.length<8){	
			return false;								
		}
		
		let stringArray = pass.split("");
		
		let digitFlag = false;
		let symbolFlag = false;
		let upperFlag = false;
		
		
		
		
		for(var j=0;j<stringArray.length;j++){
			
			if(!isNaN(stringArray[j]) === true){	
				digitFlag = true;
			}
			
			
			if(stringArray[j].match(/[A-Z]/)){
				upperFlag = true;
			}
			
			var ascString = stringArray[j].charCodeAt();				
			
			if((ascString >=33 && ascString <=47) || (ascString >=58 && ascString <=64) || (ascString >=91 && ascString <=96) || (ascString >=123 && ascString<=126)){	
				symbolFlag = true;
			}
			
			if(digitFlag == true && upperFlag ==true && symbolFlag == true){
				return true;
			}
		}
		
		return false;
	}
	
	let username =  $("input[name=username]").val();
	let email =  $("input[name=email]").val();
	let password =  $("input[name=password_1]").val();
	let confirm_password = $("input[name=password_2]").val();
		
	if(password !== confirm_password){
		alert("Passwords must match brooo!!!");
		}else if(checker(password) != true){
		alert("Passwords must contain at least one number, one symbol, one capital letter and be more than 8 characters");
		}else{	
		
		
		
		$("input[name=username]").val();
		$("input[name=email]").val();
		$("input[name=password_1]").val();
		
		const request = $.ajax({
			url: "Gab.php",
			type: "POST",
			dataType: "text",
			data: {username: username, password: password,email:email}			
		});
		
		request.done(onSuccessRegister);
		request.fail("Couldnt register the user");
		
		
		
		
		event.preventDefault();
	}
	
	function kalimera(){
		alert("Hello World");
	}
	
	function onSuccessRegister(responseText){
		console.log(responseText);
		if(responseText == 0){
			console.log("I am in ");
			alert("Successful Registration");
			window.location.assign("login.php");
			}else{
			alert("There is a username or email already registered. Change that USERNAME OR EMAIL!!!");
		}
	}
}	
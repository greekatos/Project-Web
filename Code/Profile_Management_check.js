
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

function profile_manage(){
	
	let username =  $("input[name=username_PM]").val();
	let password =  $("input[name=password_1_PM]").val();
	let confirm_password = $("input[name=password_2_PM]").val();
	let old_password = $("input[name=password_old]").val();
	
	
	if(password !== confirm_password){
		alert("Passwords must match brooo!!!");
		}else if(checker(password) != true){
		alert("Passwords must contain at least one number, one symbol, one capital letter and be more than 8 characters");
		}else{	
		
		$("input[name=username_PM]").val();
		$("input[name=password_old]").val();
		$("input[name=password_1_PM]").val();
		
		
		const req = $.ajax({
			url: "Gab_PM.php",
			type: "POST",
			dataType: "text",
			data: {username: username, password: password,old_password:old_password}
		});
		
		req.done(onSuccessManage);
		req.fail("Couldnt change the user");
		
		
		event.preventDefault();
	}
}

function done(){
	alert("KALIMERA");
}
function onSuccessManage(responseText){
	console.log(responseText);
	if(responseText == 2){
		console.log(responseText);
		console.log("Eimai sto lathos password");
		alert("You typed wrong your old password");
		window.location.assign("Profile Management.php");
	}
	else if(responseText == 3){
		console.log(responseText);
		console.log("Eimai sto proiparxonta user");
		alert("This username already exists");
		window.location.assign("Profile Management.php");
	}
	else{
		console.log(responseText);
		console.log("Eimai sto if");
		alert("Successful Change of Information");
		window.location.assign("index.php");
	}
}
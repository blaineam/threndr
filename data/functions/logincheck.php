<?php
	
	
		//check if brute force is true
		if(isset($_SESSION["bruteforcer"])&&$_SESSION["bruteforcer"]==true){
			//check if brute force timeout has been reached
			if(isset($_SESSION["timeout"])&&$_SESSION["timeout"]<=time()){
				//remove brute force lockout
				$_SESSION["bruteforcer"]=false;
				$brute = false;
			}else{
				$brute = true;
			}
			//check if there have been 3 or more login attmepts
		}elseif(isset($_SESSION["loginattempts"])&&$_SESSION["loginattempts"]>=3){
			//setup brute force lockout and rebuild timer
			$_SESSION["bruteforcer"]=true;
			$_SESSION["timeout"]=time() + (30*60);
	$brute = true;
		}else{
	$brute = false;
		}
			//check if usercredentials were passed on the login page and user is not brute
	if(!empty($cleanpost)&&$path_info['call_parts'][0]=="login"&&!$brute){
		//get passed values
		$_SESSION["ran"]="3";
		extract($cleanpost);
		//check if user exists in database
		$dbcq="SELECT * FROM customers WHERE email = '".$email."'";
		$dbchecker = $mysqli->query($dbcq);  
		
		if(mysqli_num_rows($dbchecker)>0){
			
			while($row = mysqli_fetch_array($dbchecker)){
				//check if password is valid
				if(password_verify($password, $row["password"])){
				//log customer in and reset login attempts counter
				$_SESSION["userid"]= $row["id"];
				$_SESSION["loginattempts"]=0;
				}else{
					//add new login attempt and send to error page
					$_SESSION["loginattempts"]=$_SESSION["loginattempts"]+1;
			
			$_SESSION["error"] = "The provided credentials were incorrect. Please ensure you typed everything correctly.";
			header("Location: /error");
			exit();
				}
				
				
			}
			
			//user is logged in direct to home page
			header("Location: /home");
			exit();
		}else{
			//display generic login error message
			$_SESSION["error"] = "The provided credentials were incorrect. Please ensure you typed everything correctly.";
			header("Location: /error");
			exit();
		}
		//check if user was already logged in
	}elseif(!empty($_SESSION["userid"])){
$login = true;
	}else{
$login = false;
	}

	
	
	
	?>
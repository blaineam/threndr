<?php
	
	//include site-wide dependencies
	include "../dependencies.php";
	//check if user is logged in
	if($login){
		//extract clean passed values
		extract($cleanpost);
		//check that passed values are not empty
		if(!empty($productid)&&!empty($title)&&!empty($description)&&!empty($rating)){
			
			//add review to database
			$dbiq="INSERT INTO reviews (productid, title, description, rating, customerid) VALUES ('".$productid."', '".$title."', '".$description."', '".$rating."', '".$_SESSION['userid']."')";
			$dbinserter = $mysqli->query($dbiq); 
			//reload the product page
			header("Location: /product/$productid");
			exit();
			
			}

	}else{
		//display error of in access
		$_SESSION["error"]="You do not have access to this tool";
		header("Location: /error");
		exit();
	}
	
	?>
<?php
	//check if customer is logged in
	if($login){
		//check if customer has admin status in the database
		$dbcq="SELECT * FROM customers WHERE id = ".$_SESSION["userid"]." AND admin = 'true'";
		$dbchecker = $mysqli->query($dbcq);  
		if(mysqli_num_rows($dbchecker)>0){
			
			$admin =  true;
		}else{
			
			$admin =  false;
		}
	}else{
		
		$admin =  false;
	}
	

	
	
	?>
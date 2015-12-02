<?php
	//check if user is an admin
if($admin){
	//check for passed value
	if(!empty($path_info['call_parts'][2])){
		//escape passed value
		$productid = $mysqli->real_escape_string($path_info['call_parts'][2]);
		//find products by passed value
		$dbcq="SELECT * FROM products WHERE id = ".$productid;
		$dbchecker = $mysqli->query($dbcq);  
			if(mysqli_num_rows($dbchecker)>=1){
					//delte product from database
					$dbiq="DELETE FROM products WHERE id = ".$productid;
					$dbinserter = $mysqli->query($dbiq); 
					//delete product reviews from database
					$dbiq="DELETE FROM reviews WHERE productid = ".$productid;
					$dbinserter = $mysqli->query($dbiq); 
					//reload the products list
				echo "<script> window.location.href = '/admin';</script>";
				exit();

			}else{
				//display error of invalid product id
				$_SESSION["error"]="Invalid Product Id. Please try again.";
				echo "<script> window.location.href = '/error';</script>";
				exit();
				
			}
		
	}else{
		//display error of unset product id
		$_SESSION["error"]="Product Id was not set. Please try again.";
		echo "<script> window.location.href = '/error';</script>";
		exit();
	}
	
}else{
	//display error of in access
	$_SESSION["error"]="You do not have access to this page.";
	echo "<script> window.location.href = '/error';</script>";
	exit();
	
}



?>
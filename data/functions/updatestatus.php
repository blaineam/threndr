<?php
	
	//includes site-wide dependencies
	include "../dependencies.php";
	//checks if admin
	if($admin){
		//extract passed values
		extract($cleanpost);
		//check if passed values are empty
		if(!empty($orderid)&&!empty($status)){
			//check if item is shipped
			if($status=="Shipped"){
				//update status and include any passed tracking number
				$updatecond = "UPDATE orders SET status='Shipped', trackingnumber='".$trackingnumber."' WHERE id = ".$orderid;
			}else{
				//update status
				$updatecond = "UPDATE orders SET status='".$status."' WHERE id = ".$orderid;
			}
			
			$dbupdater = $mysqli->query($updatecond);
			//reload the admin orders page
			header("Location: /admin/orders");
			exit();
			
		}
		
		}
	
	
	?>
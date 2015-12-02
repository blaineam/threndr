<?php
	//include site-wide dependencies
	include $_SERVER['DOCUMENT_ROOT'] . "/data/dependencies.php";
	//extract clean passed values
	extract($cleanpost);
	//delcare conditioner
$exists = false;
	//check if cart cookie is set
	if(!empty($_COOKIE['cart'])){
		//process cart cookie
		$cookie = $_COOKIE['cart'];
		$cookie = stripslashes($cookie);
		$savedCartArray = json_decode($cookie, true);	
		foreach($savedCartArray as $array){
			//check if passed prodct is in cart already
			if($array[0]==$productid){
				//check if passed size is in cart already
				if($array[2]==$size){
					//update conditioner
					$exists = true;
					
				}
			}
	}
	
	}
	//check if product and its size are already in the cart
	if($exists==false){
		//check if a valid cart exists
	if(!empty($savedCartArray)){
		//append product and its size to end of cart
		array_push($savedCartArray, [$productid, 1, $size]);
		$json = json_encode($savedCartArray);
	}else{
		//create new cart with passed product and size
		$cart[]=[$productid, 1, $size];
		$json = json_encode($cart);
	}	
	
	//set cookie to last for 1 year
	setcookie('cart', $json, time() + (86400 * 30 * 365), "/");
	
	}
	//redirect user to their cart
	header("Location: /cart");
	exit();
	?>
	
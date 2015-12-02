<?php
	//include site-wide depencendies
	include "../../data/dependencies.php";
	//extract cleaned passed values
	extract($cleanpost);
	
		//process cart cookie
$cookie = $_COOKIE['cart'];
$cookie = stripslashes($cookie);
$savedCartArray = json_decode($cookie, true);
//declare default value for array index
$index=0;
	foreach($savedCartArray as $array){
		//declare vales based on internal array and passed values
		$productid = $array[0];
		$size = $array[2];
		$selectedpost = "qu".$productid."size".$size;
		//check if user posted input from previous string
		if(!empty($_POST[$selectedpost])){
			//update cart product quantity
			$savedCartArray[$index][1] = $_POST[$selectedpost];
		}elseif($_POST[$selectedpost]=='0'){
				//remove cart product
				unset($savedCartArray[$index]);
			}
		//increment array index
		$index=$index+1;
	}
	//re-encode array and re-save cookie
	$json = json_encode($savedCartArray);
	setcookie('cart', $json, time() + (86400 * 30 * 365), "/");
	//reload the cart page
	header("Location: /cart");
	exit();
	
	
	?>
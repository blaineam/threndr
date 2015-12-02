<?php
	
	//include site-wide dependencies
	include "../dependencies.php";
	//extract cleaned post values
	extract($cleanpost);
	//check for empty values
	if(!empty($name)&&!empty($phonenumber)&&!empty($email)&&!empty($password)&&!empty($mailingaddress)&&!empty($mailingcity)&&!empty($mailingstate)&&!empty($mailingzip)&&!empty($billingaddress)&&!empty($billingcity)&&!empty($billingstate)&&!empty($billingzip)&&!empty($cardnumber)&&!empty($nameoncard)&&!empty($cardexpiration)&&!empty($cvvcode)&&!empty($paymenttypehidden)){
		//check database for existing customers
		$dbcq="SELECT * FROM customers WHERE email = '".$email."'";
		$dbchecker = $mysqli->query($dbcq);  
		if(mysqli_num_rows($dbchecker)==0){
			//hash passed password
			$passwordhash = password_hash($password, PASSWORD_BCRYPT);
			//insert customers values into the customers table
			$dbiq="INSERT INTO customers (email, password, name, phonenumber) VALUES('".$email."', '".$passwordhash."', '".$name."', '".$phonenumber."')";
			$dbinserter = $mysqli->query($dbiq); 
			//get id from inserted customer
			$userid = $mysqli->insert_id;
			//login customer
			$login=true;
			$_SESSION["userid"]= $userid;
		}else{
			while($row = mysqli_fetch_array($dbchecker)){
				//validate the customer's authority
				if(password_verify($password, $row["password"])){
					//login customer
					$_SESSION["userid"]= $row["id"];
					$userid = $row["id"];
					$login = true;
				
				}else{
					//send customer to an error screen with following error
					$_SESSION["error"]="You have an account and entered the wrong password; please go back and try again.";
					header("Location: /error");
					exit();
				}
				
			}
		}
		
		
		//insert passed order details to order database table
		
			$dbiq="INSERT INTO orders (customerid, date, projectedshipmentdate, status, totalprice, shippingcost, subtotal, mailingstreet, mailingstreet2, mailingcity, mailingstate, mailingzip, billingstreet, billingstreet2, billingcity, billingstate, billingzip, cardexpiration, cardnumber, ccvcode, paymenttype, nameoncard) VALUES(".$userid.", NOW(), NOW() + INTERVAL 3 DAY, 'Preparing for Shipment', '".$total."', '".$shipping."', '".$subtotal."', '".$mailingaddress."', '".$mailingaddressline2."', '".$mailingcity."', '".$mailingstate."', '".$mailingzip."', '".$billingaddress."', '".$billingaddressline2."', '".$billingcity."', '".$billingstate."', '".$billingzip."', '".$cardexpiration."', '".$cardnumber."', '".$cvvcode."', '".$paymenttypehidden."', '".$nameoncard."')";
			$dbinserter = $mysqli->query($dbiq);
			//obtain order id from insert command
			$orderid=$mysqli->insert_id;
			
			
			//retrieve cart cookie
$cookie = $_COOKIE['cart'];
//clean and format cart data
$cookie = stripslashes($cookie);
$savedCartArray = json_decode($cookie, true);	
//check if cart actually has data
if(!empty($savedCartArray)){
//repeat for every value in cart
foreach($savedCartArray as $var){
	
		//select product details from current cart item
		$dbcq="SELECT * FROM products WHERE id = ".$var[0];
		$dbchecker = $mysqli->query($dbcq); 
		while($row = mysqli_fetch_array($dbchecker)){
			//update inventory based on current cart item's quantity, size and id
			switch($var[2]){
				case 'xs':
					$dbiq="UPDATE productinventory SET XS = XS - ".$var[1]." WHERE productid =  ".$var[0]."";
					$dbinserter = $mysqli->query($dbiq); 
					break;
				case 's':
					$dbiq="UPDATE productinventory SET S = S - ".$var[1]." WHERE productid =  ".$var[0]."";
					$dbinserter = $mysqli->query($dbiq); 
					break;
				case 'm':
					$dbiq="UPDATE productinventory SET M = M - ".$var[1]." WHERE productid =  ".$var[0]."";
					$dbinserter = $mysqli->query($dbiq); 
					break;
				case 'l':
					$dbiq="UPDATE productinventory SET L = L - ".$var[1]." WHERE productid =  ".$var[0]."";
					$dbinserter = $mysqli->query($dbiq); 
					break;
				case 'xl':
					$dbiq="UPDATE productinventory SET XL = XL - ".$var[1]." WHERE productid =  ".$var[0]."";
					$dbinserter = $mysqli->query($dbiq); 
					break;
				
				
			}
			
			
			
			
			}
			
			//add cart item to ordered products record for the database
			$dbiq="INSERT INTO orderedproducts (orderid, productid, orderquantity, productsize) VALUES(".$orderid.", ".$var[0].", ".$var[1].", '".$var[2]."')";
			$dbinserter = $mysqli->query($dbiq); 
			
			
			}
			//delete current cart data
			unset($_COOKIE['cart']);
				//redirect to orders tracking page
				header("Location: /orders");
				exit();
			
			}else{
				//redirect to cart as it was empty
				header("Location: /cart");
				exit();
			}
		
		
	}else{
		//redirect to order as user could ot be authenticated
		header("Location: /order");
		exit();
	}
	
	
	
	
	?>
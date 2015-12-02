<?php
	//process cart cookie
$cookie = $_COOKIE['cart'];
$cookie = stripslashes($cookie);
$savedCartArray = json_decode($cookie, true);	
//check if cart has data
if(!empty($savedCartArray)){
	//output the cartupdate form header
echo '<form id="cartupdater" method="post" action="/business/functions/updatecart.php">';
//repeat for each item in cart
foreach($savedCartArray as $var){
	
		//select product details from current cart item
		$dbcq="SELECT * FROM products WHERE id = ".$var[0];
		$dbchecker = $mysqli->query($dbcq); 
		while($row = mysqli_fetch_array($dbchecker)){
			//calculate subtotal of cart items
			$subtotal = $subtotal + (floatval($row['price']) * $var[1]);
			//display cart item
			?>
			
				<div class="cartitem">
					<p><a href="/product/<?php echo $row['id']; ?>"><img src="/<?php echo $row['graphic']; ?>.jpg" width="30px" height="40px" /></a></p>
					<b><a href="/product/<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></b>
					<p><?php echo strtoupper($var[2]); ?></p>
					<p><?php echo $row['price']; ?></p>
					<input type="text" class="cartproductid" name="qu<?php echo $row['id']; ?>size<?php echo $var[2]; ?>" value="<?php echo $var[1]; ?>">
					<span class="removeitem">X</span>
				</div>
			<?php
			
			
		}
	
}
//setup subtotal value for use of the submit order form
$_SESSION['subtotal']=$subtotal;
//output remaining actions and details for the card page
echo '<input type="submit" value="Update Cart"></form>';
echo "<h2>Subtotal: $".$subtotal."</h2>";
echo '<a href="/order">Finalize Order</a>';
}else{
	//display message that their card is empty
	echo '<h1>Your cart is empty.</h1>';
}


	?>
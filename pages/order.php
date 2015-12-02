<?php
//check for calculated subtotal generated from the cart page so that we know the user got here by the intended method
if(!empty($_SESSION['subtotal'])){
	//calcualte variables for the form
	$subtotal = floatval($_SESSION['subtotal']);
	$tax = number_format($subtotal*0.0725, 2, '.', '');
	$shipping = 15.00;
	$total = $subtotal + $tax + $shipping;
	
	?>
	<noscript><meta http-equiv="refresh" content="0; url=https://threndr.com/error"></noscript>
	<form id="finalorderform" name="finealorderform" method="post" action="/data/functions/submitorder.php">
		
		<label for="name">Name: </label><input id="name" type="text" name="name" value=""><br />
		<label for="phonenumber">Phone Number: </label><input id="phonenumber" type="text" name="phonenumber" value=""><br />
		<label for="email">Email Address: </label><input id="email" type="text" name="email" value=""><br />
		<label for="password">Password: </label><input id="password" type="password" name="password" value=""><br />
		<label for="confirmpassword">Confirm Password: </label><input id="confirmpassword" type="password" name="confirmpassword" value=""><br />
		<label for="mailingaddress">Mailing Address: </label><input id="mailingaddress" type="text" name="mailingaddress" value=""><br />
		<label for="mailingaddressline2">Mailing Address Line 2: </label><input id="mailingaddressline2" type="text" name="mailingaddressline2" value=""><br />
		<label for="mailingcity">Mailing City: </label><input id="mailingcity" type="text" name="mailingcity" value=""><br />
		<label for="mailingstate">Mailing State: </label><input id="mailingstate" type="text" name="mailingstate" value=""><br />
		<label for="mailingzip">Mailing Zip Code: </label><input id="mailingzip" type="text" name="mailingzip" value=""><br />
		<hr />
		<span id="sameasmailing">Same As Mailing Address</span><br />
		<label for="billingaddress">Billing Address: </label><input id="billingaddress" type="text" name="billingaddress" value=""><br />
		<label for="billingaddressline2">Billing Address Line 2: </label><input id="billingaddressline2" type="text" name="billingaddressline2" value=""><br />
		<label for="billingcity">Billing City: </label><input id="billingcity" type="text" name="billingcity" value=""><br />
		<label for="billingstate">Billing State: </label><input id="billingstate" type="text" name="billingstate" value=""><br />
		<label for="billingzip">Billing Zip Code: </label><input id="billingzip" type="text" name="billingzip" value=""><br />
		<hr />
		<label for="cardnumber">Credit Card Number: </label><input id="cardnumber" type="text" name="cardnumber" value=""><br />
		<label for="nameoncard">Name On Card: </label><input id="nameoncard" type="text" name="nameoncard" value=""><br />
		<label for="cardexpiration">Expiration Date: </label><input id="cardexpiration" type="text" name="cardexpiration" value=""><br />
		<label for="cvvcode">Security Code: </label><input id="cvvcode" type="text" name="cvvcode" value=""><br />
		
		<label for="paymenttype">Payment Type: </label>
		<select name="paymenttype" id="paymenttype">
			<option value="">Select One</option>
			<option value="visa">Visa</option>
			<option value="mastercard">MasterCard</option>
			<option value="amex">American Express</option>
			<option value="discover">Discover</option>
		</select>
		<br />
		<hr />
		<br />
		<span id="subtotal">Subtotal: $<?php echo $subtotal; ?></span>
		<br />
		<span id="tax">Tax: $<?php echo $tax; ?></span>
		<br />
		<span id="shipping">Shipping: $<?php echo $shipping; ?></span>
		<br />
		<span id="total">Total: $<?php echo $total; ?></span>
		<br />
		<hr />
		<br />
		<input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
		<input type="hidden" name="shipping" value="<?php echo $shipping; ?>">
		<input type="hidden" name="total" value="<?php echo $total; ?>">
		<input type="hidden" id="paymenttypehidden" name="paymenttypehidden" value="">
		<input type="submit" value="Submit Order">
	</form>
	
	
	<?php
	
	
	}else{
		//display error message that cart is empty
		$_SESSION["error"]="Your cart is empty.";
		header("Location: /error");
		exit();
	}
	
	
	?>
	
	
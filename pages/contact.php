<form id="contactform" name="contactform" method="post" action="/business/functions/contact.php">
	<input type="hidden" name="customerid" value="<?php if(!empty($_SESSION['userid'])){ echo $_SESSION['userid']; }else{ echo 'unset'; } ?>">
	<label for="email">Email</label><input id="email" type="text" name="email" value=""><br /><br />
	<label for="subject">Subject</label><input id="subject" type="text" name="subject" value=""><br /><br />
	<textarea form="contactform" name="message" placeholder="How may we help you?"></textarea><br /><br />
	<input type="submit" value="Send">
</form>
<br />
<br />
<br />
<br />
<h2>Return Policy:</h2>
<br />
<p>Threndr has a firm return policy that the customer's/user must understand in order to improve their buying experience. We accept any exchange or return of items up to thirty days after making a purchase at our online store. The reason we follow this policy is because if a customer wants  to exchange an  item for another we bare the shipping cost to send it to the customer. Upon returning a product the customer must include the packaging  slip that states when the item was purchased. This makes it easier for Threndr to address any request for exchange or returned items. Most importantly you are only allowed to exchange an item for another item that cost the same amount as the previously purchased item because Threndr is paying for shipping for the exchanged item.  </p>
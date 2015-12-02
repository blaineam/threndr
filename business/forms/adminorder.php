<?php
		//displays order and customer data based on passed url value
		$orderid = $mysqli->real_escape_string($path_info['call_parts'][2]);
		$dbcq="SELECT * FROM orders JOIN customers ON orders.customerid = customers.id WHERE orders.id =".$orderid." ORDER BY date DESC";
		$dbchecker = $mysqli->query($dbcq);  
			
			while($row = mysqli_fetch_array($dbchecker)){
				
	?>
	
	<div class="orderitem">
		<p>Order Date: <?php echo date("M j Y", strtotime($row['date'])); ?></p>
		<p><a href="/admin/orders">Address: <?php echo $row['name']."<br />".$row['email']."<br />".$row['mailingstreet']."<br />".$row['mailingstreet2']."<br />".$row['mailingcity']."<br />".$row['mailingstate']."<br />".$row['mailingzip']."<br />"; ?></a></p>
		<p>Shipment Date: <?php echo date("M j Y", strtotime($row['shipdate'])); ?></p>
		<b>Status: <br />
		<form action="/data/functions/updatestatus.php" method="post">
			<input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
			<select name="status">
				<option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
				<option value="Denied">Denied</option>
				<option value="Preparing for Shipment">Preparing for Shipment</option>
				<option value="Backordered">Backordered</option>
				<option value="Shipped">Shipped</option>
				<option value="Canceled">Canceled</option>
			</select><br />
			<input type="text" name="trackingnumber" value="<?php echo $row['trackingnumber']; ?>" placeholder="Tracking Number">
			<input type="submit" value="Update">
		</form>
		</b>
		<p>Total: $<?php echo $row['totalprice']; ?></p>
	</div>
	<?php
		}
		//displays products in specefied order
		$dbcq="SELECT * FROM orderedproducts JOIN products ON orderedproducts.productid = products.id WHERE orderid = ".$orderid;
		$dbchecker = $mysqli->query($dbcq); 
		while($row = mysqli_fetch_array($dbchecker)){
			?>
			
				<div class="cartitem">
					<p><a href="/product/<?php echo $row['products.id']; ?>"><img src="/<?php echo $row['graphic']; ?>.jpg" width="30px" height="40px" /></a></p>
					<b><a href="/product/<?php echo $row['products.id']; ?>"><?php echo $row['title']; ?></a></b>
					<p><?php echo strtoupper($row['productsize']); ?></p>
					<p><?php echo $row['orderquantity']; ?></p>
				</div>
			<?php
			
			
		}
		
		?>
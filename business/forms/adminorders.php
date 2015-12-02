<?php
		// display all order details showing newest first with individual forms for updating each order
		$dbcq="SELECT * FROM orders ORDER BY date DESC";
		$dbchecker = $mysqli->query($dbcq);  
			
			while($row = mysqli_fetch_array($dbchecker)){
				
	?>
	
	<div class="orderitem">
		<p>Order Date: <?php echo date("M j Y", strtotime($row['date'])); ?></p>
		<p><a href="/admin/orders/<?php echo $row['id']; ?>">Address: <?php echo $row['mailingstreet']."<br />".$row['mailingstreet2']."<br />".$row['mailingcity']."<br />".$row['mailingstate']."<br />".$row['mailingzip']."<br />"; ?></a></p>
		<p>Shipment Date: <?php echo date("M j Y", strtotime($row['shipdate'])); ?></p>
		<b>Status: <br />
		<form action="/data/functions/updatestatus.php" method="post">
			<input type="hidden" name="orderid" value="<?php echo $row['id']; ?>">
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
		?>
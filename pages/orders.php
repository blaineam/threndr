<?php
		//find order details for a customer and display them
		$dbcq="SELECT * FROM orders WHERE customerid =".$_SESSION["userid"]." ORDER BY date DESC";
		$dbchecker = $mysqli->query($dbcq);  
			
			while($row = mysqli_fetch_array($dbchecker)){
				
	?>
	
	<div class="orderitem">
		<p>Order Date: <?php echo date("M j Y", strtotime($row['date'])); ?></p>
		<p>Projected Shipment Date: <?php echo date("M j Y", strtotime($row['projectedshipmentdate'])); ?></p>
		<p>Shipment Date: <?php echo date("M j Y", strtotime($row['shipdate'])); ?></p>
		<b>Status: <?php echo $row['status']; 
			if(!empty($row['trackingnumber'])&&$row['status']=="Shipped"){ echo "<br />Tracking Number: ".$row['trackingnumber']; } ?></b>
		<p>Total: $<?php echo $row['totalprice']; ?></p>
	</div>
	<?php
		}
		?>
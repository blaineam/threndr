
		<div id="adminproductlist">
	
	<?php
		
		//select and display all products for admin
		$dbcq="SELECT * FROM products JOIN productinventory ON products.id = productinventory.productid";
		$dbchecker = $mysqli->query($dbcq);  
			
			while($row = mysqli_fetch_array($dbchecker)){
		
		?>
		
		<div class="adminproductlistitem">
			<p><a href="/product/<?php echo $row['productid']; ?>"><img src="/<?php echo $row['graphic']; ?>.jpg" width="30px" height="40px" /></a></p>
			<p>price: $<?php echo $row['price']; ?></p>
			<p><a href="/product/<?php echo $row['productid']; ?>">Name: <?php echo $row['title']; ?></a></p>
			<p>Sizes: <?php echo "XS:".$row['XS']." S:".$row['S']." M:".$row['M']." L:".$row['L']." XL:".$row['XL']; ?></p>
			<a href="/admin/edit/<?php echo $row['productid']; ?>">Edit</a>
			<a href="/admin/delete/<?php echo $row['productid']; ?>" onclick="return confirm('Are You sure you want to delete this product? This cannot be undone!');">Delete</a>
		</div>
		<br />
		<br />
		
	<?php
		}
		
		?>
		
		
		
		
			
		</div>
		
<div id="slider">
	<ul>
        <li id="slide1"></li>
        <li id="slide2"></li>
        <li id="slide3"></li>
        <li id="slide4"></li>
    </ul>
</div>
<div id="featuredproducts">
	<?php 
		//display featured products from the database
		$dbcq="SELECT * FROM products WHERE featured = 'yes'";
		$dbchecker = $mysqli->query($dbcq);
				
			while($row = mysqli_fetch_array($dbchecker)){
		?>
	<a class="featuredproduct" href="product/<?php echo $row['id']; ?>">
		<img src="/<?php echo $row['graphic']; ?>.jpg" alt="<?php echo $row['title']; ?> Product Image" />
		<p><?php //echo shortened desciption
			echo strlen($row['description']) > 100 ? substr($row['description'],0,100)."..." : $row['description']; ?></p>
	</a>
		<?php
			}
		?>
</div>
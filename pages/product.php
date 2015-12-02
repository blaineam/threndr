<?php
	
	//check if product id was sent
	if(!empty($path_info['call_parts'][1])){
		//declare product id variable from cleaned value
		$productid = $mysqli->real_escape_string($path_info['call_parts'][1]);
		//select product from database
		$dbcq="SELECT * FROM products WHERE id = ".$productid;
		$dbchecker = $mysqli->query($dbcq);  
			//check if product exists in databse
			if(mysqli_num_rows($dbchecker)>=1){
				
				while($row = mysqli_fetch_array($dbchecker)){
	
	
					//get available inventory values of selected product
		$idbcq="SELECT * FROM productinventory WHERE productid = ".$productid;
		$idbchecker = $mysqli->query($idbcq);
				
				while($irow = mysqli_fetch_array($idbchecker)){
					$extrasmall = intval($irow['XS']);
					$small = intval($irow['S']);
					$medium = intval($irow['M']);
					$large = intval($irow['L']);
					$extralarge = intval($irow['XL']);
	
				}
				
				//get rating value from database
		$idbcq="SELECT (SUM(rating)/COUNT(id)) AS ratingsaverage FROM reviews WHERE productid = ".$productid;
		$idbchecker = $mysqli->query($idbcq);
				
				while($irow = mysqli_fetch_array($idbchecker)){
					if(!empty($irow['ratingsaverage'])){
						
					$rating=intval($irow['ratingsaverage']);
					}else{
						$rating='5';
					}
	
				}
	
	
	?>
	<div id="productdetails">
	<img src="/<?php echo $row['graphic']; ?>.jpg">
	<div id="detailsbox">
		
		<div id="details">
		<h2 id="producttitle"><?php echo $row['title']; ?></h2>
		<p id="productdescription"><?php echo $row['description']; ?></p>
		<p id="producttype"><?php echo $row['type']; ?></p><p><?php echo $rating; ?>/5 &#9733;'s</p>
		<p id="productgender"><?php echo $row['gender']; ?> item</p>
		<h3 id="productprice">$<?php echo $row['price']; ?></h3>
		<form id="addtocart" method="post" action="/business/functions/addtocart.php">
			<input type="hidden" name="productid" value="<?php echo $productid; ?>">
			<?php if($extrasmall>0||$small>0||$medium>0||$large>0||$extralarge>0){
			?>
			
			<select name="size">
				<?php if($extrasmall>0){ ?><option value="xs">XS</option><?php } ?>
				<?php if($small>0){ ?><option value="s">S</option><?php } ?>
				<?php if($medium>0){ ?><option value="m">M</option><?php } ?>
				<?php if($large>0){ ?><option value="l">L</option><?php } ?>
				<?php if($extralarge>0){ ?><option value="xl">XL</option><?php } ?>
			<input type="submit" value="Add to Cart">
			<?php }else{ echo "<p>Current Out of Stock</p>"; } ?> 
			</form>
		</div>
	<?php
		
		}
		
		}else{
			//display error of invalid product id
			$_SESSION["error"]="Invalid Product Id. Please try again.";
				echo "<script> window.location.href = '/error';</script>";
				exit();
				
		}
		}else{
			//display error of unset product id
		$_SESSION["error"]="Product Id was not set. Please try again.";
		echo "<script> window.location.href = '/error';</script>";
		exit();
		}
	//verify that product id is set
	if(!empty($productid)){
		//display review container
		echo '<div id="reviewsbox">';
		//check if customer is logged in
		if($login){
			//check if customer has bought item and it was shipped and then display product review form
			
		$dbcq="SELECT * FROM orderedproducts as op JOIN orders as o ON o.id = op.orderid WHERE o.status = 'Shipped' AND o.customerid = ".intval($_SESSION['userid'])."  AND op.productid = ".$productid;
		$dbchecker = $mysqli->query($dbcq); 
		if(mysqli_num_rows($dbchecker)>0){
			//check if user has already written a review
		$dbcq="SELECT * FROM reviews WHERE customerid = ".intval($_SESSION['userid'])."  AND productid = ".$productid;
		$dbchecker = $mysqli->query($dbcq); 
		if(mysqli_num_rows($dbchecker)==0){
			
			
			?>
			<form name="reviewform" id="reviewform" method="post" action="/data/functions/addreview.php">
				<input type="hidden" name="productid" value="<?php echo $productid; ?>">
				Your Rating: 
				<input type="radio" id="1star" name="rating" value="1"> 1
				<input type="radio" id="2star" name="rating" value="2"> 2
				<input type="radio" id="3star" name="rating" value="3"> 3
				<input type="radio" id="4star" name="rating" value="4"> 4
				<input type="radio" id="5star" name="rating" value="5"> 5
				<br />
				<input type="text" name="title" placeholder="Review Title">
				<br />
				<textarea form="reviewform" name="description" placeholder="Type your review here"></textarea>
				<br />
				<input type="submit" value="Submit Review">
			</form>
			
			<?php
		}
		}
		}else{
			//let customers know they need to sign int to post a review
			echo '<p id="reviewnotice"> Sign in to write a review.</p>';
		}
		
		//display reviews from the database
		
		$dbcq="SELECT * FROM reviews WHERE productid = ".$productid;
		$dbchecker = $mysqli->query($dbcq);  
		while($row = mysqli_fetch_array($dbchecker)){
			?>
			<div class="review">
				<h3><?php echo $row['title']; ?></h3>
				<p><?php echo strip_tags($row['description']); ?></p>
			</div>
			<?php
		}
		echo '</div></div></div>';
	}
	
	?>
	
	
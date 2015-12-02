<?php
	//verify customer is an admin
if($admin){
	//check for passed values
	if(!empty($path_info['call_parts'][2])){
		//declare values from cleaned passed values
		$productid = $mysqli->real_escape_string($path_info['call_parts'][2]);
		//obtain and set default input vales from passed product id form the database
		$dbcq="SELECT * FROM products WHERE id = ".$productid;
		$dbchecker = $mysqli->query($dbcq);  
			if(mysqli_num_rows($dbchecker)>=1){
				
				while($row = mysqli_fetch_array($dbchecker)){
					
					$_SESSION["editporductid"] = $productid;
				
					echo "<h1>".$_SESSION["error"]."</h1>";
	
	
					//declare inventory quantities of specefied sized from the database
		$idbcq="SELECT * FROM productinventory WHERE productid = ".$productid;
		$idbchecker = $mysqli->query($idbcq);
				
				while($irow = mysqli_fetch_array($idbchecker)){
					$extrasmall = $irow['XS'];
					$small = $irow['S'];
					$medium = $irow['M'];
					$large = $irow['L'];
					$extralarge = $irow['XL'];
	
				}
	
	
	?>
<form id="addproductform" name="addproductform" action="/data/functions/editproduct.php" method="post" enctype="multipart/form-data">
	<label for="type">Type: </label>
	<select name="type" id="type">
		<option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
		<option value="shirt">shirt</option>
		<option value="jacket">jacket</option>
		<option value="pants">pants</option>
		<option value="shorts">shorts</option>
		<option value="dress">dress</option>
		<option value="skirt">skirt</option>
	</select>
<br />
<br />
	<label for="title">Title</label><input id="title" type="text" name="title" value="<?php echo $row['title']; ?>">
<br />
<br />
	<label for="price">Price</label><input id="price" type="text" name="price" value="<?php echo $row['price']; ?>">
<br />
<br />
	<label for="extrasmall">XS: </label><input id="extrasmall" type="text" name="extrasmall" value="<?php echo $extrasmall; ?>">
	<label for="small">S: </label><input id="small" type="text" name="small" value="<?php echo $small; ?>">
	<label for="medium">M: </label><input id="medium" type="text" name="medium" value="<?php echo $medium; ?>">
	<label for="large">L: </label><input id="large" type="text" name="large" value="<?php echo $large; ?>">
	<label for="extralarge">XL: </label><input id="extralarge" type="text" name="extralarge" value="<?php echo $extralarge; ?>">
<br />
<br />
	<label for="description">Description: </label>
	<textarea form="addproductform" name="description" id="description" placeholder="Please Type description here">
	<?php echo $row['description']; ?>
	</textarea>
<br />
<br />
<label for="graphic">Product Image: </label><br />
	<img src="/<?php echo $row['graphic']; ?>.jpg" width="300" height="400" /><br />
	<input type="file" name="graphic" id="graphic">
<br />
<br />
<label for="agegroup">Age Group?</label>
	<select name="agegroup" id="agegroup">
		<option value="<?php echo $row['agegroup']; ?>"><?php echo $row['agegroup']; ?></option>
		<option value="adult">adult</option>
		<option value="teen">teen</option>
		<option value="child">child</option>
	</select>
<br />
<br />
<label for="gender">Which Gender?</label>
	<select name="gender" id="gender">
		
		<option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
		<option value="male">male</option>
		<option value="female">female</option>
		<option value="neutral">neutral</option>
	</select>
<br />
<br />
<label for"featured">Is product featured?</label>
	<select name="featured" id="featured">
		
		<option value="<?php echo $row['featured']; ?>"><?php echo $row['featured']; ?></option>
		
		<option value="yes">yes</option>
		<option value="no">no</option>
	</select>
<br />
<br />
<input type="hidden" name="productid" value="<?php echo $productid; ?>">
	<input type="submit">
</form>


<?php
	
	
	
				}
			}else{
				//display error of invalid product id
				
				$_SESSION["error"]="Invalid Product Id. Please try again.";
				echo "<script> window.location.href = '/error';</script>";
				exit();
				
			}
		
	}else{
		//display error of product id not set
		
		$_SESSION["error"]="Product Id was not set. Please try again.";
		echo "<script> window.location.href = '/error';</script>";
		exit();
	}
	
}else{
	//display error of in access
	$_SESSION["error"]="You do not have access to this page.";
	echo "<script> window.location.href = '/error';</script>";
	exit();
	
}



?>
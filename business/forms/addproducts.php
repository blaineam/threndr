<?php
	
	echo "<h1>".$_SESSION["error"]."</h1>";
	
	?>
<form id="addproductform" name="addproductform" action="/data/functions/addproduct.php" method="post" enctype="multipart/form-data">
	<select name="type">
		<option value="">Select Type</option>
		<option value="shirt">shirt</option>
		<option value="jacket">jacket</option>
		<option value="pants">pants</option>
		<option value="shorts">shorts</option>
		<option value="dress">dress</option>
		<option value="skirt">skirt</option>
		<option value="shoes">shoes</option>
	</select>
<br />
<br />
	<label for="title">Title</label><input id="title" type="text" name="title" value="">
<br />
<br />
	<label for="price">Price</label><input id="price" type="text" name="price" value="0.00">
<br />
<br />
	<label for="extrasmall">XS: </label><input id="extrasmall" type="text" name="extrasmall" value="0">
	<label for="small">S: </label><input id="small" type="text" name="small" value="0">
	<label for="medium">M: </label><input id="medium" type="text" name="medium" value="0">
	<label for="large">L: </label><input id="large" type="text" name="large" value="0">
	<label for="extralarge">XL: </label><input id="extralarge" type="text" name="extralarge" value="0">
<br />
<br />
	<textarea form="addproductform" name="description" placeholder="Please Type description here">
	</textarea>
<br />
<br />
	<input type="file" name="graphic" id="graphic">
<br />
<br />
	<select name="agegroup" id="agegroup">
		<option value="">Select Age Group</option>
		<option value="adult">adult</option>
		<option value="child">child</option>
		<option value="baby">baby</option>
	</select>
<br />
<br />
	<select name="gender">
		
		<option value="">Select Gender</option>
		<option value="male">male</option>
		<option value="female">female</option>
		<option value="neutral">neutral</option>
	</select>
<br />
<br />
	<select name="featured">
		
		<option value="">Is product featured?</option>
		
		<option value="yes">yes</option>
		<option value="no">no</option>
	</select>
<br />
<br />
	<input type="submit">
</form>
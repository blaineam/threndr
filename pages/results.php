
<div id="featuredproducts">
<?php 
		//build query from cleaned passed value from search form
		$query = $mysqli->real_escape_string($path_info['query_vars']['q']);
		//search the products database table for any relevancy of the passsed value
		$dbcq="SELECT * FROM products WHERE title LIKE '%".$query."%'";
		$dbchecker = $mysqli->query($dbcq);
		if(mysqli_num_rows($dbchecker)){
			while($row = mysqli_fetch_array($dbchecker)){
				//display products matching passed value
		?>
	<a class="featuredproduct" href="/product/<?php echo $row['id']; ?>">
		<img src="/<?php echo $row['graphic']; ?>.jpg" alt="<?php echo $row['title']; ?> Product Image" />
		<p><?php echo strlen($row['description']) > 100 ? substr($row['description'],0,100)."..." : $row['description']; ?></p>
	</a>
		<?php
			}
			}else{
				//display error message of no results found from search
				$_SESSION['error']="No Results found, feel free to browse threndr to find what you're looking for.";
				header("Location: /error");
				exit();
			}
		?>
		
</div>
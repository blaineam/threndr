
<div id="featuredproducts">
<?php 
		//switch the selection criteria based on the first url passed value
		switch($path_info['call_parts'][1]){
			case 'mens':
				$sortstring = " gender = 'male' AND agegroup='adult'";
				break;
			case 'womens':
				$sortstring = " gender = 'female' AND agegroup='adult'";
				break;
			case 'childrens':
				$sortstring = " agegroup='child'";
				break;
		}
		//modify the selection criteria based on the second url passed value
		switch($path_info['call_parts'][2]){
			case 'shirts':
				$sortstring .= " AND type='shirt'";
				break;
			case 'skirts':
				$sortstring .= " AND type='skirt'";
				break;
			case 'shorts':
				$sortstring .= " AND type='shorts'";
				break;
			case 'pants':
				$sortstring .= " AND type='pants'";
				break;
			case 'dresses':
				$sortstring .= " AND type='dress'";
				break;
			case 'jackets':
				$sortstring .= " AND type='jacket'";
				break;
		}
		
		//selct and display products based on the search criteria
		$dbcq="SELECT * FROM products WHERE $sortstring";
		$dbchecker = $mysqli->query($dbcq);
				
			while($row = mysqli_fetch_array($dbchecker)){
		?>
	<a class="featuredproduct" href="/product/<?php echo $row['id']; ?>">
		<img src="/<?php echo $row['graphic']; ?>.jpg" alt="<?php echo $row['title']; ?> Product Image" />
		<p><?php echo strlen($row['description']) > 100 ? substr($row['description'],0,100)."..." : $row['description']; ?></p>
	</a>
		<?php
			}
		?>
</div>